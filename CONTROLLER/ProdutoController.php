<?php
require_once __DIR__ . '/../MODEL/ProdutoModel.php';

class ProdutoController {
    private $produto;

    public function __construct() {
        $this->produto = new ProdutoModel();
    }

    // Listar todos os produtos
    public function index() {
        try {
            $stmt = $this->produto->lerTodos();
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $produtos;
        } catch (Exception $e) {
            $error = $e->getMessage();
            return ['error' => $error];
        }
    }

    // Listar produtos por categoria
    public function indexPorCategoria($id_categoria) {
        try {
            $stmt = $this->produto->lerPorCategoria($id_categoria);
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $produtos;
        } catch (Exception $e) {
            $error = $e->getMessage();
            return ['error' => $error];
        }
    }

    // Buscar produtos por nome
    public function buscarPorNome($nome) {
        try {
            $stmt = $this->produto->buscarPorNome($nome);
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $produtos;
        } catch (Exception $e) {
            $error = $e->getMessage();
            return ['error' => $error];
        }
    }

    // Criar um novo produto
    public function criar() {
        try {
            $this->produto->nome = $_POST['nome'];
            $this->produto->preco = $_POST['preco'];
            $this->produto->descricao = $_POST['descricao'] ?? null;
            $this->produto->quantidade = $_POST['quantidade'] ?? 0;
            $this->produto->reservado = $_POST['reservado'] ?? 0;
            $this->produto->id_cat = $_POST['id_cat'];

            if ($this->produto->criar()) {
                return ['success' => 'Produto criado com sucesso', 'id' => $this->produto->id];
            } else {
                throw new Exception("Erro ao criar produto");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            return ['error' => $error];
        }
    }

    // Mostrar detalhes de um produto
    public function mostrar($id) {
        try {
            $this->produto->id = $id;
            $produto = $this->produto->lerUm();
            
            if ($produto) {
                return $produto;
            } else {
                throw new Exception("Produto não encontrado");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            return ['error' => $error];
        }
    }

    // Atualizar um produto
    public function atualizar($id) {
        try {
            $this->produto->id = $id;
            
            // Receber dados do formulário
            $this->produto->nome = $_POST['nome'];
            $this->produto->preco = $_POST['preco'];
            $this->produto->descricao = $_POST['descricao'] ?? null;
            $this->produto->quantidade = $_POST['quantidade'];
            $this->produto->reservado = $_POST['reservado'];
            $this->produto->id_cat = $_POST['id_cat'];

            if ($this->produto->atualizar()) {
                return ['success' => 'Produto atualizado com sucesso'];
            } else {
                throw new Exception("Erro ao atualizar produto");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            return ['error' => $error];
        }
    }

    // Deletar um produto
    public function deletar($id) {
        try {
            $this->produto->id = $id;
            
            if ($this->produto->deletar()) {
                return ['success' => 'Produto deletado com sucesso'];
            } else {
                throw new Exception("Erro ao deletar produto");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            return ['error' => $error];
        }
    }

    // Atualizar estoque
    public function atualizarEstoque($id, $quantidade) {
        try {
            if ($this->produto->atualizarEstoque($id, $quantidade)) {
                return ['success' => 'Estoque atualizado com sucesso'];
            } else {
                throw new Exception("Erro ao atualizar estoque");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            return ['error' => $error];
        }
    }

    // Atualizar quantidade reservada
    public function atualizarReserva($id, $reservado) {
        try {
            if ($this->produto->atualizarReserva($id, $reservado)) {
                return ['success' => 'Reserva atualizada com sucesso'];
            } else {
                throw new Exception("Erro ao atualizar reserva");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            return ['error' => $error];
        }
    }
}