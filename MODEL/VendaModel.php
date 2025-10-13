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
                 SET data_venda=:data_venda, id_pedido=:id_pedido, id_vendedor=:id_vendedor, 
                     id_cliente=:id_cliente, total=:total";

        $stmt = $this->conn->prepare($query);

        $this->data_venda = htmlspecialchars(strip_tags($this->data_venda));
        $this->id_pedido = htmlspecialchars(strip_tags($this->id_pedido));
        $this->id_vendedor = htmlspecialchars(strip_tags($this->id_vendedor));
        $this->id_cliente = htmlspecialchars(strip_tags($this->id_cliente));
        $this->total = htmlspecialchars(strip_tags($this->total));

        $stmt->bindParam(":data_venda", $this->data_venda);
        $stmt->bindParam(":id_pedido", $this->id_pedido);
        $stmt->bindParam(":id_vendedor", $this->id_vendedor);
        $stmt->bindParam(":id_cliente", $this->id_cliente);
        $stmt->bindParam(":total", $this->total);

        try {
            if ($stmt->execute()) {
                $this->id = $this->conn->lastInsertId();
                return true;
            }
        } catch (PDOException $e) {
            error_log("Erro ao criar venda: " . $e->getMessage());
            throw new Exception("Erro ao criar venda: " . $e->getMessage());
        }

        return false;
    }

    public function lerUm() {
        $query = "SELECT v.*, 
                         u.nome AS nome_vendedor, u.email AS email_vendedor, 
                         u.telefone AS telefone_vendedor, u.CPF AS CPF_vendedor, 
                         u.data_nasc AS data_nasc_vendedor,
                         c.nome AS nome_cliente, c.email AS email_cliente, 
                         c.telefone AS telefone_cliente, c.CPF AS CPF_cliente, 
                         c.CNPJ AS CNPJ_cliente, c.data_nasc AS data_nasc_cliente,
                         p.data_pedido, p.status as status_pedido
                  FROM " . $this->table_name . " v
                  INNER JOIN usuario u ON v.id_vendedor = u.id 
                  INNER JOIN cliente c ON v.id_cliente = c.id 
                  LEFT JOIN pedidos p ON v.id_pedido = p.id
                  WHERE v.id = ? LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->data_venda = $row['data_venda'];
            $this->id_pedido = $row['id_pedido'];
            $this->id_vendedor = $row['id_vendedor'];
            $this->id_cliente = $row['id_cliente'];
            $this->total = $row['total'];
        }

        return $row;
    }

    public function lerTodos() {
        $query = "SELECT v.*, 
                         u.nome AS nome_vendedor, 
                         c.nome AS nome_cliente,
                         p.data_pedido, p.status as status_pedido
                  FROM " . $this->table_name . " v
                  INNER JOIN usuario u ON v.id_vendedor = u.id 
                  INNER JOIN cliente c ON v.id_cliente = c.id 
                  LEFT JOIN pedidos p ON v.id_pedido = p.id
                  ORDER BY v.data_venda DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function lerPorVendedor($id_vendedor) {
        $query = "SELECT v.*, 
                         u.nome AS nome_vendedor, 
                         c.nome AS nome_cliente,
                         p.data_pedido, p.status as status_pedido
                  FROM " . $this->table_name . " v
                  INNER JOIN usuario u ON v.id_vendedor = u.id 
                  INNER JOIN cliente c ON v.id_cliente = c.id 
                  LEFT JOIN pedidos p ON v.id_pedido = p.id
                  WHERE v.id_vendedor = ? 
                  ORDER BY v.data_venda DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_vendedor);
        $stmt->execute();

        return $stmt;
    }

    public function lerPorCliente($id_cliente) {
        $query = "SELECT v.*, 
                         u.nome AS nome_vendedor, 
                         c.nome AS nome_cliente,
                         p.data_pedido, p.status as status_pedido
                  FROM " . $this->table_name . " v
                  INNER JOIN usuario u ON v.id_vendedor = u.id 
                  INNER JOIN cliente c ON v.id_cliente = c.id 
                  LEFT JOIN pedidos p ON v.id_pedido = p.id
                  WHERE v.id_cliente = ? 
                  ORDER BY v.data_venda DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_cliente);
        $stmt->execute();

        return $stmt;
    }

    public function atualizar() {
        $query = "UPDATE " . $this->table_name . " 
                 SET data_venda=:data_venda, id_pedido=:id_pedido, id_vendedor=:id_vendedor, 
                     id_cliente=:id_cliente, total=:total 
                 WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $this->data_venda = htmlspecialchars(strip_tags($this->data_venda));
        $this->id_pedido = htmlspecialchars(strip_tags($this->id_pedido));
        $this->id_vendedor = htmlspecialchars(strip_tags($this->id_vendedor));
        $this->id_cliente = htmlspecialchars(strip_tags($this->id_cliente));
        $this->total = htmlspecialchars(strip_tags($this->total));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":data_venda", $this->data_venda);
        $stmt->bindParam(":id_pedido", $this->id_pedido);
        $stmt->bindParam(":id_vendedor", $this->id_vendedor);
        $stmt->bindParam(":id_cliente", $this->id_cliente);
        $stmt->bindParam(":total", $this->total);
        $stmt->bindParam(":id", $this->id);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar venda: " . $e->getMessage());
            throw new Exception("Erro ao atualizar venda: " . $e->getMessage());
        }
    }

    public function deletar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao deletar venda: " . $e->getMessage());
            throw new Exception("Erro ao deletar venda: " . $e->getMessage());
        }
    }

    public function vendaExistePorPedido($id_pedido) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE id_pedido = ?";
        $stmt = $this->conn->prepare($query);
        
        $id_pedido = htmlspecialchars(strip_tags($id_pedido));
        $stmt->bindParam(1, $id_pedido);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }


    public function relatorioVendasPorPeriodo($data_inicio, $data_fim, $id_vendedor = null) {
        $query = "SELECT v.*, 
                         u.nome AS nome_vendedor, 
                         c.nome AS nome_cliente
                  FROM " . $this->table_name . " v
                  INNER JOIN usuario u ON v.id_vendedor = u.id 
                  INNER JOIN cliente c ON v.id_cliente = c.id 
                  WHERE v.data_venda BETWEEN ? AND ?";
        
        if ($id_vendedor) {
            $query .= " AND v.id_vendedor = ?";
        }
        
        $query .= " ORDER BY v.data_venda DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $data_inicio);
        $stmt->bindParam(2, $data_fim);
        
        if ($id_vendedor) {
            $stmt->bindParam(3, $id_vendedor);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalVendasPorVendedor($id_vendedor = null, $periodo = null) {
        $query = "SELECT u.nome, SUM(v.total) as total_vendas, COUNT(v.id) as qtd_vendas
                  FROM " . $this->table_name . " v
                  INNER JOIN usuario u ON v.id_vendedor = u.id";
        
        $whereConditions = [];
        $params = [];
        
        if ($id_vendedor) {
            $whereConditions[] = "v.id_vendedor = ?";
            $params[] = $id_vendedor;
        }
        
        if ($periodo) {
            $whereConditions[] = "v.data_venda >= DATE_SUB(NOW(), INTERVAL ? DAY)";
            $params[] = $periodo;
        }
        
        if (!empty($whereConditions)) {
            $query .= " WHERE " . implode(" AND ", $whereConditions);
        }
        
        $query .= " GROUP BY v.id_vendedor, u.nome";
        
        $stmt = $this->conn->prepare($query);
        
        foreach ($params as $index => $param) {
            $stmt->bindParam($index + 1, $param);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function estatisticasGerais() {
        $query = "SELECT 
                    COUNT(*) as total_vendas,
                    SUM(total) as faturamento_total,
                    AVG(total) as ticket_medio,
                    MIN(total) as menor_venda,
                    MAX(total) as maior_venda
                  FROM " . $this->table_name;
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function vendasPorMes($ano = null) {
        if (!$ano) {
            $ano = date('Y');
        }
        
        $query = "SELECT 
                    MONTH(data_venda) as mes,
                    COUNT(*) as total_vendas,
                    SUM(total) as faturamento_mensal
                  FROM " . $this->table_name . " 
                  WHERE YEAR(data_venda) = ?
                  GROUP BY MONTH(data_venda)
                  ORDER BY mes";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $ano);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>