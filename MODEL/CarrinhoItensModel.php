<?php
require_once __DIR__ . '/../DB/Database.php';

class CarrinhoItensModel {
    private $conn;
    private $table_name = "carrinho_itens";

    public $id;
    public $id_carrinho;
    public $id_produto;
    public $quantidade;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConexao();
    }

    public function criar() {
        $query = "INSERT INTO " . $this->table_name . " 
                 SET id_carrinho=:id_carrinho, id_produto=:id_produto, quantidade=:quantidade";

        $stmt = $this->conn->prepare($query);

        $this->id_carrinho = htmlspecialchars(strip_tags($this->id_carrinho));
        $this->id_produto = htmlspecialchars(strip_tags($this->id_produto));
        $this->quantidade = htmlspecialchars(strip_tags($this->quantidade));

        $stmt->bindParam(":id_carrinho", $this->id_carrinho);
        $stmt->bindParam(":id_produto", $this->id_produto);
        $stmt->bindParam(":quantidade", $this->quantidade);

        try {
            if ($stmt->execute()) {
                $this->id = $this->conn->lastInsertId();
                return true;
            }
        } catch (PDOException $e) {
            error_log("Erro ao adicionar item ao carrinho: " . $e->getMessage());
            throw new Exception("Erro ao adicionar item ao carrinho: " . $e->getMessage());
        }

        return false;
    }

    public function lerUm() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->id_carrinho = $row['id_carrinho'];
            $this->id_produto = $row['id_produto'];
            $this->quantidade = $row['quantidade'];
        }

        return $row;
    }

    public function lerTodosPorCarrinho($id_carrinho) {
        $query = "SELECT ci.*, p.nome, p.preco, p.foto 
                  FROM " . $this->table_name . " ci 
                  INNER JOIN produtos p ON ci.id_produto = p.id 
                  WHERE ci.id_carrinho = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_carrinho);
        $stmt->execute();

        return $stmt;
    }

    public function atualizar() {
        $query = "UPDATE " . $this->table_name . " 
                 SET quantidade=:quantidade 
                 WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $this->quantidade = htmlspecialchars(strip_tags($this->quantidade));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":quantidade", $this->quantidade);
        $stmt->bindParam(":id", $this->id);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar item do carrinho: " . $e->getMessage());
            throw new Exception("Erro ao atualizar item do carrinho: " . $e->getMessage());
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
            error_log("Erro ao deletar item do carrinho: " . $e->getMessage());
            throw new Exception("Erro ao deletar item do carrinho: " . $e->getMessage());
        }
    }

    public function itemExiste($id_carrinho, $id_produto) {
        $query = "SELECT id FROM " . $this->table_name . " 
                  WHERE id_carrinho = ? AND id_produto = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_carrinho);
        $stmt->bindParam(2, $id_produto);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function atualizarQuantidade($id_carrinho, $id_produto, $quantidade) {
        $query = "UPDATE " . $this->table_name . " 
                 SET quantidade = quantidade + ? 
                 WHERE id_carrinho = ? AND id_produto = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $quantidade);
        $stmt->bindParam(2, $id_carrinho);
        $stmt->bindParam(3, $id_produto);
        return $stmt->execute();
    }

    public function deletarPorCarrinho($id_carrinho) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_carrinho = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_carrinho);
        
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao deletar itens do carrinho: " . $e->getMessage());
            throw new Exception("Erro ao deletar itens do carrinho: " . $e->getMessage());
        }
    }
}
?>