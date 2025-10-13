<?php
require_once __DIR__ . '/../MODEL/VendaModel.php';
require_once __DIR__ . '/../MODEL/PedidoModel.php';
require_once __DIR__ . '/../MODEL/PedidoItensModel.php';

class VendaController {
    private $venda;
    private $pedido;
    private $pedidoItens;

    public function __construct() {
        $this->venda = new VendaModel();
        $this->pedido = new PedidoModel();
        $this->pedidoItens = new PedidoItensModel();
    }

    public function index($filtro = null) {
        try {
            if ($filtro) {
                $stmt = $this->venda->lerPorVendedor($filtro);
            } else {
                $stmt = $this->venda->lerTodos();
            }
            
            $vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $vendas;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function indexPorCliente($id_cliente) {
        try {
            $stmt = $this->venda->lerPorCliente($id_cliente);
            $vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $vendas;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function criar() {
        try {
            if ($this->venda->vendaExistePorPedido($_POST['id_pedido'])) {
                throw new Exception("Já existe uma venda registrada para este pedido.");
            }

            $this->venda->data_venda = date('Y-m-d H:i:s');
            $this->venda->id_pedido = $_POST['id_pedido'];
            $this->venda->id_vendedor = $_POST['id_vendedor'];
            $this->venda->id_cliente = $_POST['id_cliente'];
            $this->venda->total = $_POST['total'];

            if ($this->venda->criar()) {
                $this->pedido->atualizarStatus($_POST['id_pedido'], 'PAGO');
                
                return ['success' => 'Venda criada com sucesso', 'id' => $this->venda->id];
            } else {
                throw new Exception("Erro ao criar venda");
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function criarVendaDoPedido($id_pedido, $id_vendedor) {
        try {
            if ($this->venda->vendaExistePorPedido($id_pedido)) {
                throw new Exception("Já existe uma venda registrada para este pedido.");
            }

            $this->pedido->id = $id_pedido;
            $pedido = $this->pedido->lerUm();
            
            if (!$pedido) {
                throw new Exception("Pedido não encontrado");
            }

            $this->venda->data_venda = date('Y-m-d H:i:s');
            $this->venda->id_pedido = $id_pedido;
            $this->venda->id_vendedor = $id_vendedor;
            $this->venda->id_cliente = $pedido['id_cliente'];
            $this->venda->total = $pedido['total'];

            if ($this->venda->criar()) {
                $this->pedido->atualizarStatus($id_pedido, 'PAGO');
                
                return ['success' => 'Venda criada com sucesso', 'id' => $this->venda->id];
            } else {
                throw new Exception("Erro ao criar venda");
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function mostrar($id) {
        try {
            $this->venda->id = $id;
            $venda = $this->venda->lerUm();
            
            if ($venda) {
                if ($venda['id_pedido']) {
                    $stmt = $this->pedidoItens->lerTodosPorPedido($venda['id_pedido']);
                    $itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $venda['itens'] = $itens;
                }
                
                return $venda;
            } else {
                throw new Exception("Venda não encontrada");
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function atualizar($id) {
        try {
            $this->venda->id = $id;
            
            $this->venda->data_venda = $_POST['data_venda'];
            $this->venda->id_pedido = $_POST['id_pedido'];
            $this->venda->id_vendedor = $_POST['id_vendedor'];
            $this->venda->id_cliente = $_POST['id_cliente'];
            $this->venda->total = $_POST['total'];

            if ($this->venda->atualizar()) {
                return ['success' => 'Venda atualizada com sucesso'];
            } else {
                throw new Exception("Erro ao atualizar venda");
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function deletar($id) {
        try {
            $this->venda->id = $id;
            
            $venda = $this->venda->lerUm();
            
            if ($this->venda->deletar()) {
                if ($venda && $venda['id_pedido']) {
                    $this->pedido->atualizarStatus($venda['id_pedido'], 'FINALIZADO');
                }
                
                return ['success' => 'Venda deletada com sucesso'];
            } else {
                throw new Exception("Erro ao deletar venda");
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function relatorioVendasPorPeriodo($data_inicio, $data_fim, $id_vendedor = null) {
        try {
            $vendas = $this->venda->relatorioVendasPorPeriodo($data_inicio, $data_fim, $id_vendedor);
            return $vendas;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function totalVendasPorVendedor($id_vendedor = null, $periodo = null) {
        try {
            $resultados = $this->venda->totalVendasPorVendedor($id_vendedor, $periodo);
            return $resultados;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function estatisticasGerais() {
        try {
            $estatisticas = $this->venda->estatisticasGerais();
            return $estatisticas;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function vendasPorMes($ano = null) {
        try {
            $vendas = $this->venda->vendasPorMes($ano);
            return $vendas;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
?>