<?php
require_once __DIR__ . '/../MODEL/CarrinhoModel.php';
require_once __DIR__ . '/../MODEL/CarrinhoItensModel.php';
require_once __DIR__ . '/../MODEL/PedidoModel.php';
require_once __DIR__ . '/../MODEL/PedidoItensModel.php';

class CarrinhoController {
    private $carrinho;
    private $carrinhoItens;
    private $pedido;        // ← ADICIONAR
    private $pedidoItens;   // ← ADICIONAR

    public function __construct() {
        $this->carrinho = new CarrinhoModel();
        $this->carrinhoItens = new CarrinhoItensModel();
        $this->pedido = new PedidoModel();           // ← ADICIONAR
        $this->pedidoItens = new PedidoItensModel(); // ← ADICIONAR
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
                // Cria novo carrinho e retorna os dados completos dele
                $novoCarrinho = $this->criarCarrinho($id_cliente);
                if (isset($novoCarrinho['id'])) {
                    $stmt = $this->carrinho->lerUmPorId($novoCarrinho['id']);
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                } else {
                    throw new Exception("Erro ao criar carrinho");
                }
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function adicionarItem($id_carrinho, $id_produto, $quantidade) {
        try {
            if ($this->carrinhoItens->itemExiste($id_carrinho, $id_produto)) {
                // Pega o item atual para conferir quantidade
                $itemAtual = $this->carrinhoItens->lerPorCarrinhoEProduto($id_carrinho, $id_produto);
                $novaQuantidade = $itemAtual['quantidade'] + $quantidade;

                // Atualiza para a nova quantidade somada
                $this->carrinhoItens->id_carrinho = $id_carrinho;
                $this->carrinhoItens->id_produto = $id_produto;
                $this->carrinhoItens->quantidade = $novaQuantidade;

                // Atualiza quantidade diretamente no item, não somar mais no query
                if ($this->carrinhoItens->atualizarQuantidadeExata($id_carrinho, $id_produto, $novaQuantidade)) {
                    $this->carrinho->atualizarValorTotal($id_carrinho);
                    return ['success' => 'Quantidade atualizada no carrinho'];
                } else {
                    throw new Exception("Erro ao atualizar quantidade no carrinho");
                }
            } else {
                // Cria novo item normalmente
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

    /**
     * Cria um pedido a partir dos itens do carrinho
     * @param int $id_cliente ID do cliente
     * @param int $id_vendedor ID do vendedor que está criando o pedido
     * @param string $status Status inicial do pedido (padrão: 'PAGO')
     * @return array Resultado da operação
     */
    public function criarPedidoDoCarrinho($id_cliente, $id_vendedor, $status = 'PAGO') {
        try {
            // Buscar carrinho do cliente
            $carrinho = $this->obterCarrinho($id_cliente);
            
            if (!$carrinho || isset($carrinho['error'])) {
                throw new Exception("Carrinho não encontrado");
            }

            $id_carrinho = $carrinho['id'];
            
            // Buscar itens do carrinho
            $itens = $this->listarItens($id_carrinho);
            
            if (empty($itens) || isset($itens['error'])) {
                throw new Exception("Carrinho vazio. Adicione produtos antes de criar o pedido.");
            }

            // Calcular total
            $total = $carrinho['valor_total'];

            // Criar pedido - Status dinâmico
            $this->pedido->data_pedido = date('Y-m-d H:i:s');
            $this->pedido->id_cliente = $id_cliente;
            $this->pedido->id_vendedor = $id_vendedor;
            $this->pedido->id_cupom = null;
            $this->pedido->status = $status; // Status agora é dinâmico
            $this->pedido->total = $total;

            // Tenta criar com método sem cupom primeiro
            if (method_exists($this->pedido, 'criarSemCupom')) {
                $criado = $this->pedido->criarSemCupom();
            } else {
                // Fallback: usar método normal mas garantir id_cupom é null
                $this->pedido->id_cupom = null;
                $criado = $this->pedido->criar();
            }

            if (!$criado) {
                throw new Exception("Erro ao criar pedido");
            }

            $id_pedido = $this->pedido->id;

            // Adicionar itens ao pedido
            foreach ($itens as $item) {
                $this->pedidoItens->id_pedido = $id_pedido;
                $this->pedidoItens->id_produto = $item['id_produto'];
                $this->pedidoItens->quantidade = $item['quantidade'];
                $this->pedidoItens->preco_unitario = $item['preco_unitario'];
                $this->pedidoItens->total_item = $item['preco_unitario'] * $item['quantidade'];

                if (!$this->pedidoItens->criar()) {
                    throw new Exception("Erro ao adicionar item ao pedido");
                }
            }

            // Limpar carrinho após criar pedido
            $this->limparCarrinho($id_carrinho);

            return [
                'success' => 'Pedido criado com sucesso!',
                'id_pedido' => $id_pedido,
                'total' => $total,
                'status' => $status
            ];

        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Verifica se o carrinho tem itens
     */
    public function carrinhoTemItens($id_cliente) {
        try {
            $carrinho = $this->obterCarrinho($id_cliente);
            if (!$carrinho || isset($carrinho['error'])) {
                return false;
            }

            $itens = $this->listarItens($carrinho['id']);
            return !empty($itens) && !isset($itens['error']);
        } catch (Exception $e) {
            return false;
        }
    }
}
?>