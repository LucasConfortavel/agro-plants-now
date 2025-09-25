<?php
require_once __DIR__ . '/../DB/Database.php';

class VendaModel {
    private $conn;
    private $table_name = "venda";

    public $id;
    public $data_venda;
    public $id_pedido;
    public $id_vendedor;
    public $id_cliente;
    public $total;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConexao();
    }

    public function criar() {
        $query = "INSERT INTO " . $this->table_name . " 
                 SET nome=:nome, email=:email,telefone=:telefone, CPF=:CPF,  CNPJ=:CNPJ, data_nasc=:data_nasc";
        $stmt = $this->conn->prepare($query);

        // sanitização dos dados
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->CPF = htmlspecialchars(strip_tags($this->CPF));
        $this->CNPJ = htmlspecialchars(strip_tags($this->CNPJ));
        $this->data_nasc = htmlspecialchars(strip_tags($this->data_nasc));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":CPF", $this->CPF);
        $stmt->bindParam(":CNPJ", $this->CNPJ);
        $stmt->bindParam(":data_nasc", $this->data_nasc);

        try {
            if ($stmt->execute()) {
                $this->id = $this->conn->lastInsertId();
                return true;
            }
        } catch (PDOException $e) {
            error_log("Erro ao criar usuário: " . $e->getMessage());
            
            // verificar se e violação de email ou CPF unico
            if ($e->getCode() == 23000) {
                if (strpos($e->getMessage(), 'email') !== false) {
                    throw new Exception("Já existe um usuário cadastrado com este email.");
                } elseif (strpos($e->getMessage(), 'CPF') !== false) {
                    throw new Exception("Já existe um usuário cadastrado com este CPF.");
                }
                } elseif (strpos($e->getMessage(), 'CNPJ') !== false) {
                    throw new Exception("Já existe um usuário cadastrado com este CNPJ.");
                }
            }
            
            throw new Exception("Erro ao criar usuário: " . $e->getMessage());
        

        return false;
    }

    public function lerUm() {
        $query = "select " . $this->$table_name . ".*,
                usuario.nome AS nome_vendedor, usuario.email AS email_vendedor, usuario.telefone AS telefone_vendedor, usuario.CPF AS CPF_vendedor, usuario.data_nasc AS data_nasc_vendedor,
                cliente.nome AS nome_cliente, cliente.email AS email_cliente, cliente.telefone AS telefone_cliente, cliente.CPF AS CPF_cliente, cliente.CNPJ AS CNPJ_cliente, cliente.data_nasc AS data_nasc_cliente  from venda
                inner join usuario on venda.id_vendedor = usuario.id 
                inner join cliente on venda.id_cliente = cliente.id" . " WHERE venda.id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public function lerTodos() {
        $query = "select " . $this->$table_name . ".*,
                usuario.nome AS nome_vendedor, usuario.email AS email_vendedor, usuario.telefone AS telefone_vendedor, usuario.CPF AS CPF_vendedor, usuario.data_nasc AS data_nasc_vendedor,
                cliente.nome AS nome_cliente, cliente.email AS email_cliente, cliente.telefone AS telefone_cliente, cliente.CPF AS CPF_cliente, cliente.CNPJ AS CNPJ_cliente, cliente.data_nasc AS data_nasc_cliente  from venda
                inner join usuario on venda.id_vendedor = usuario.id 
                inner join cliente on venda.id_cliente = cliente.id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function lerEspecifico($filtro) {
        $query = "select " . $this->$table_name . ".*,
                usuario.nome AS nome_vendedor, usuario.email AS email_vendedor, usuario.telefone AS telefone_vendedor, usuario.CPF AS CPF_vendedor, usuario.data_nasc AS data_nasc_vendedor,
                cliente.nome AS nome_cliente, cliente.email AS email_cliente, cliente.telefone AS telefone_cliente, cliente.CPF AS CPF_cliente, cliente.CNPJ AS CNPJ_cliente, cliente.data_nasc AS data_nasc_cliente  from venda
                inner join usuario on venda.id_vendedor = usuario.id 
                inner join cliente on venda.id_cliente = cliente.id" . " WHERE id_vendedor = " .$filtro;        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

}