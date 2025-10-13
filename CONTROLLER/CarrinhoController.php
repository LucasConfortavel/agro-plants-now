<?php
require_once __DIR__ . '/../MODEL/CarrinhoModel.php';
require_once __DIR__ . '/../MODEL/CarrinhoItensModel.php';

class CarrinhoController {
    private $carrinho;
    private $carrinhoItens;

    public function __construct() {
        $this->carrinho = new CarrinhoModel();
        $this->carrinhoItens = new CarrinhoItensModel();
    }

    public function criarCarrinho($id_cliente) {
        try {
            $this->carrinho->id_cliente = $id_cliente;
            $this->carrinho->valor_total = 0;

            if ($this->carrinho->criar()) {
                return ['success' => 'Carrinho criado com sucesso', 'id' => $this->carrinho->id];
            } else {
                throw new Exception("Erro ao criar carrinho");
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function obterCarrinho($id_cliente) {
        try {
            $stmt = $this->carrinho->lerPorCliente($id_cliente);
            $carrinho = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($carrinho) {
                return $carrinho;
            } else {
                return $this->criarCarrinho($id_cliente);
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function adicionarItem($id_carrinho, $id_produto, $quantidade) {
        try {
            if ($this->carrinhoItens->itemExiste($id_carrinho, $id_produto)) {
                if ($this->carrinhoItens->atualizarQuantidade($id_carrinho, $id_produto, $quantidade)) {
                    $this->carrinho->atualizarValorTotal($id_carrinho);
                    return ['success' => 'Item atualizado no carrinho'];
                } else {
                    throw new Exception("Erro ao atualizar item no carrinho");
                }
            } else {
                $this->carrinhoItens->id_carrinho = $id_carrinho;
                $this->carrinhoItens->id_produto = $id_produto;
                $this->carrinhoItens->quantidade = $quantidade;

                if ($this->carrinhoItens->criar()) {
                    $this->carrinho->atualizarValorTotal($id_carrinho);
                    return ['success' => 'Item adicionado ao carrinho'];
                } else {
                    throw new Exception("Erro ao adicionar item ao carrinho");
                }
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function removerItem($id_item) {
        try {
            $this->carrinhoItens->id = $id_item;
            $item = $this->carrinhoItens->lerUm();
            if ($item) {
                if ($this->carrinhoItens->deletar()) {
                    $this->carrinho->atualizarValorTotal($item['id_carrinho']);
                    return ['success' => 'Item removido do carrinho'];
                } else {
                    throw new Exception("Erro ao remover item do carrinho");
                }
            } else {
                throw new Exception("Item não encontrado");
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function atualizarQuantidadeItem($id_item, $quantidade) {
        try {
            $this->carrinhoItens->id = $id_item;
            $this->carrinhoItens->quantidade = $quantidade;

            if ($this->carrinhoItens->atualizar()) {
                $item = $this->carrinhoItens->lerUm();
                $this->carrinho->atualizarValorTotal($item['id_carrinho']);
                return ['success' => 'Quantidade atualizada'];
            } else {
                throw new Exception("Erro ao atualizar quantidade");
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function listarItens($id_carrinho) {
        try {
            $stmt = $this->carrinhoItens->lerTodosPorCarrinho($id_carrinho);
            $itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $itens;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function calcularValorTotal($id_carrinho) {
        try {
            $total = $this->carrinho->calcularValorTotal($id_carrinho);
            return ['valor_total' => $total];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function limparCarrinho($id_carrinho) {
        try {
            if ($this->carrinhoItens->deletarPorCarrinho($id_carrinho)) {
                $this->carrinho->atualizarValorTotal($id_carrinho);
                return ['success' => 'Carrinho limpo'];
            } else {
                throw new Exception("Erro ao limpar carrinho");
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function deletarCarrinho($id_carrinho) {
        try {
            $this->carrinho->id = $id_carrinho;
            
            if ($this->carrinho->deletar()) {
                return ['success' => 'Carrinho deletado com sucesso'];
            } else {
                throw new Exception("Erro ao deletar carrinho");
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
?>