<?php
include "../../INCLUDE/Menu_adm.php";
include "../../INCLUDE/alertas.php";
include "../../CONTROLLER/ClienteController.php";
include "../../CONTROLLER/CarrinhoController.php";
include "../../CONTROLLER/PedidoController.php";
include "../../INCLUDE/vlibras.php";
require_once "../../INCLUDE/verificarLogin.php"; 

$cliente_control = new ClienteController();
$carrinho_control = new CarrinhoController();
$pedido_control = new PedidoController();

$status_filtro = isset($_GET['status']) ? $_GET['status'] : '';

if ($status_filtro) {
    $clientes = $cliente_control->filtrarPorStatusPedido($status_filtro);
} else {
    $clientes = $cliente_control->indexComStatusPedidos();
}

$total_clientes = count($clientes);

$limite = 4;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $limite;
$total_paginas = ceil($total_clientes / $limite);
$clientes_paginados = array_slice($clientes, $offset, $limite);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome']) && !isset($_POST['finalizar_pedido']) && !isset($_POST['criar_pedido'])) {
    $criar_cliente = $cliente_control->criarCliente();

    if ($criar_cliente == 1) {
        $_SESSION['alerta'] = '<script> exibirAlerta("Cliente cadastrado com sucesso","sucesso"); </script>';
    } elseif ($criar_cliente == "Já existe um usuário cadastrado com este email.") {
        $_SESSION['alerta'] = '<script> exibirAlerta("Já existe um usuário cadastrado com este email"); </script>';
    } else {
        $_SESSION['alerta'] = '<script> exibirAlerta("Não foi possível cadastrar o cliente","error"); </script>';
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['criar_pedido'])) {
    $id_cliente = $_POST['criar_pedido'];
    $id_vendedor = $_SESSION['id'];
    
    $status_inicial = 'PENDENTE';
    
    $resultado = $carrinho_control->criarPedidoDoCarrinho($id_cliente, $id_vendedor, $status_inicial);
    
    if (isset($resultado['success'])) {
        $_SESSION['alerta'] = '<script> exibirAlerta("' . $resultado['success'] . '","sucesso"); </script>';
    } else {
        $mensagem_erro = $resultado['error'];
        if (strpos($mensagem_erro, 'Estoque insuficiente') !== false) {
            $mensagem_erro = "Erro: Estoque insuficiente para alguns produtos. Verifique as quantidades disponíveis.";
        }
        $_SESSION['alerta'] = '<script> exibirAlerta("' . $mensagem_erro . '","error"); </script>';
    }
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['finalizar_pedido'])) {
    $id_pedido = $_POST['finalizar_pedido'];
    
    $pedido_info = $pedido_control->mostrar($id_pedido);
    
    if (isset($pedido_info['error'])) {
        $_SESSION['alerta'] = '<script> exibirAlerta("Pedido não encontrado","error"); </script>';
    } else {
        $resultado = $pedido_control->atualizarStatus($id_pedido, 'FINALIZADO');
        
        if (isset($resultado['success'])) {
            $_SESSION['alerta'] = '<script> exibirAlerta("Pedido finalizado com sucesso!","sucesso"); </script>';
        } else {
            $_SESSION['alerta'] = '<script> exibirAlerta("Erro ao finalizar pedido","error"); </script>';
        }
    }
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if(!empty($_GET)){
    if (isset($_GET['visualizar'])){
        $id = $_GET['visualizar'];
        header('Location: info-edit-adm.php?id=' . $id . '&usuario=cliente');
        exit;
    } elseif (isset($_GET['remover'])){
        $id = $_GET['remover'];
        $cliente = $cliente_control->deletar($id);
        if($cliente == 1){
            $_SESSION['alerta'] = '<script> exibirAlerta("Cliente deletado com sucesso","sucesso"); </script>';
        } else {
            $_SESSION['alerta'] = '<script> exibirAlerta("Não foi possível deletar o cliente","error"); </script>';
        }
        header("Location: clientes-adm.php");
        exit;
    }
}

if(isset($_SESSION['alerta'])){
    echo($_SESSION['alerta']);
    unset($_SESSION['alerta']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Clientes</title>
    <link rel="stylesheet" href="../../PUBLIC/css/clientes-adm.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/global-tema.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<div class="ym_popup-overlay">
    <div class="ym_popup-content">
        <div class="ym_area-superior-popup"></div>
        <div class="ym_conteudo-popup"></div>
    </div>
</div>

<main class="jp_main-content">
    <h1 class="ym_titulo">Clientes</h1>

    <div class="jv_container">
        <div class="jv_card">
            <div class="jv_card-header">
                <div class="jv_header-content">
                    <div class="jv_search-section">
                        <div class="jv_search-container">
                            <button class="ym_area-icon-pesquisa">
                                <i class="fas fa-search search-icon"></i>
                            </button>
                            <input type="text" id="jv_searchInput" placeholder="Pesquisar por nome ou email..." class="jv_search-input">
                        </div>
                    </div>

                    <div class="jv_actions">
                        <div>
                            <!-- <button class="ym_btn-remover" id="jv_removeSelected">
                                <i class="fa-solid fa-trash-can"></i>
                                Remover (<span id="jv_selectedCount">0</span>)
                            </button> -->
                        </div>
                        <div>
                            <button class="ym_btn-padrao" onclick="abrirPopup('../../VIEW/pop-up/cadastroPessoas.php','Cadastro de Pessoas')">
                                <i class="fas fa-plus"></i>
                                <a>Cadastrar Cliente</a>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="separar">
                    <p class="jv_subtitle" id="jv_customerCount">
                        <?= $total_clientes ?> clientes encontrados
                    </p>

                    <div class="select-wrapper">            
                        <div class="custom-select" id="customSelect">
                            <div class="select-trigger">
                                <span class="select-value"><?= $status_filtro ?: 'Todos' ?></span>
                                <div class="select-arrow"></div>
                            </div>
                            
                            <div class="select-options">
                                <div class="select-option <?= $status_filtro === '' ? 'selected' : '' ?>" data-value="">Todos</div>
                                <div class="select-option <?= $status_filtro === 'PAGO' ? 'selected' : '' ?>" data-value="PAGO">Pago</div>
                                <div class="select-option <?= $status_filtro === 'ENVIADO' ? 'selected' : '' ?>" data-value="ENVIADO">Enviado</div>
                                <div class="select-option <?= $status_filtro === 'FINALIZADO' ? 'selected' : '' ?>" data-value="FINALIZADO">Finalizado</div>
                                <div class="select-option <?= $status_filtro === 'PENDENTE' ? 'selected' : '' ?>" data-value="PENDENTE">Pendente</div>
                            </div>
                        </div>

                        <select name="status" class="native-select" id="nativeSelect">
                            <option value="">Todos</option>
                            <option value="PAGO" <?= $status_filtro === 'PAGO' ? 'selected' : '' ?>>Pago</option>
                            <option value="ENVIADO" <?= $status_filtro === 'ENVIADO' ? 'selected' : '' ?>>Enviado</option>
                            <option value="FINALIZADO" <?= $status_filtro === 'FINALIZADO' ? 'selected' : '' ?>>Finalizado</option>
                            <option value="PENDENTE" <?= $status_filtro === 'PENDENTE' ? 'selected' : '' ?>>Pendente</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="jv_card-content">
                <div class="jv_table-container">
                    <table class="jv_table">
                        <thead>
                            <tr class="jv_table-header">
                                <!-- <th class="jv_checkbox-col">
                                    <input type="checkbox" id="jv_selectAll" class="jv_checkbox">
                                </th> -->
                                <th class="jv_name">Nome</th>
                                <th class="jv_date">Data</th>
                                <th class="jv_total_comp">Status do Pedido</th>
                                <th class="jv_valor_gast"></th>
                                <th class="jv_actions-col"></th>
                            </tr>
                        </thead>
                        <tbody id="jv_customerTableBody">
                            <?php if ($total_clientes > 0): ?>
                                <?php foreach ($clientes_paginados as $cliente): ?>
                                    <?php
                                        $ultimoPedido = null;
                                        $pedidoStmt = $pedido_control->indexPorCliente($cliente['id']);
                                        $pedidos = is_array($pedidoStmt) ? $pedidoStmt : [];
                                        
                                        if (!empty($pedidos) && !isset($pedidos['error'])) {
                                            usort($pedidos, function($a, $b) {
                                                return strtotime($b['data_pedido']) - strtotime($a['data_pedido']);
                                            });
                                            $ultimoPedido = $pedidos[0];
                                        }
                                        
                                        $status = $ultimoPedido ? $ultimoPedido['status'] : 'SEM PEDIDOS';
                                        $id_pedido = $ultimoPedido ? $ultimoPedido['id'] : null;
                                        
                                        $carrinhoTemItens = $carrinho_control->carrinhoTemItens($cliente['id']);

                                        switch ($status) {
                                            case 'PAGO':
                                                $progress = 40;
                                                $icone = '<i class="fas fa-dollar-sign"></i>';
                                                break;
                                            case 'ENVIADO':
                                                $progress = 50;
                                                $icone = '<i class="fas fa-truck"></i>';
                                                break;
                                            case 'ENTREGUE':
                                                $progress = 75;
                                                $icone = '<i class="fas fa-box-open"></i>';
                                                break;
                                            case 'FINALIZADO':
                                                $progress = 100;
                                                $icone = '<i class="fas fa-check-circle"></i>';
                                                break;
                                            case 'PENDENTE':
                                                $progress = 25;
                                                $icone = '<i class="fas fa-clock"></i>';
                                        }
                                    ?>
                                    <tr>
                                        <!-- <td>
                                            <input type="checkbox" class="jv_checkbox customer-checkbox" data-customer-id="<?= $cliente['id'] ?>">
                                        </td> -->
                                        <td>
                                            <div class="jv_customer-info">
                                                <div class="jv_avatar">
                                                    <?= strtoupper(substr($cliente['nome'], 0, 2)) ?>
                                                </div>
                                                <div class="jv_customer-details">
                                                    <h4><?= htmlspecialchars($cliente['nome']) ?></h4>
                                                    <p><?= htmlspecialchars($cliente['email']) ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p><?= htmlspecialchars($cliente['data_nasc']) ?></p>
                                        </td>
                                        <td>
                                            <?php if ($status !== 'SEM PEDIDOS'): ?>
                                                <div class="jv_status-wrapper">
                                                    <div class="jv_progress-bar">
                                                        <div class="jv_progress <?= strtolower($status) ?>" 
                                                            style="width: <?= $progress ?>%;"></div>
                                                    </div>
                                                    <span class="jv_status-label">
                                                        <?= $icone ?>
                                                        <?= $status ?>
                                                    </span>
                                                
                                                </div>
                                            <?php else: ?>
                                                <small class="ym_small">Nenhum pedido</small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                               
                                        </td>
                                        <td class="jv_table-action">
                                            <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <form class="jv_dropdown" method="GET" action="">
                                                <button type="submit" name="visualizar" value="<?= htmlspecialchars($cliente['id']) ?>" class="jv_dropdown-item">
                                                    <i class="fas fa-eye"></i> Visualizar
                                                </button>
                                                <div class="jv_dropdown-separator"></div>
                                                <button class="jv_dropdown-item jv_danger" type="submit" name="remover" value="<?= htmlspecialchars($cliente['id'])?>">
                                                    <i class="fas fa-trash"></i> Remover
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td class="ym_td" colspan="6">Nenhum cliente encontrado</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php if ($total_paginas > 1): ?>
    <div class="jv_page-navigation">
        <?php if ($pagina_atual > 1): ?>
            <a href="?pagina=<?= $pagina_atual - 1 ?><?= $status_filtro ? '&status=' . $status_filtro : '' ?>" class="jv_page-arrow">
                <i class="fas fa-arrow-left"></i>
            </a>
        <?php endif; ?>

        <?php
        // Lógica para mostrar no máximo 3 números na paginação
        if ($total_paginas <= 3) {
            $inicio = 1;
            $fim = $total_paginas;
        } else {
            if ($pagina_atual <= 2) {
                $inicio = 1;
                $fim = 3;
            } elseif ($pagina_atual >= $total_paginas - 1) {
                $inicio = $total_paginas - 2;
                $fim = $total_paginas;
            } else {
                $inicio = $pagina_atual - 1;
                $fim = $pagina_atual + 1;
            }
        }

        for ($i = $inicio; $i <= $fim; $i++): ?>
            <a href="?pagina=<?= $i ?><?= $status_filtro ? '&status=' . $status_filtro : '' ?>" 
               class="jv_page-number <?= $i == $pagina_atual ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($pagina_atual < $total_paginas): ?>
            <a href="?pagina=<?= $pagina_atual + 1 ?><?= $status_filtro ? '&status=' . $status_filtro : '' ?>" class="jv_page-arrow">
                <i class="fas fa-arrow-right"></i>
            </a>
        <?php endif; ?>
    </div>
<?php endif; ?>


</main>

<script>
    const customSelect = document.getElementById('customSelect');
    const selectTrigger = customSelect.querySelector('.select-trigger');
    const selectOptions = customSelect.querySelector('.select-options');
    const selectValue = customSelect.querySelector('.select-value');
    const options = customSelect.querySelectorAll('.select-option');
    const nativeSelect = document.getElementById('nativeSelect');

    selectTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        selectTrigger.classList.toggle('active');
        selectOptions.classList.toggle('active');
    });

    options.forEach(option => {
        option.addEventListener('click', function() {
            options.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            const value = this.getAttribute('data-value');
            const text = this.textContent;
            selectValue.textContent = text;
            nativeSelect.value = value;
            selectTrigger.classList.remove('active');
            selectOptions.classList.remove('active');
            
            const url = new URL(window.location.href);
            if (value && value !== "") {
                url.searchParams.set('status', value);
            } else {
                url.searchParams.delete('status');
            }
            url.searchParams.delete('pagina');
            window.location.href = url.toString();
        });
    });

    document.addEventListener('click', function(e) {
        if (!customSelect.contains(e.target)) {
            selectTrigger.classList.remove('active');
            selectOptions.classList.remove('active');
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            selectTrigger.classList.remove('active');
            selectOptions.classList.remove('active');
        }
    });

    // Native select change (mobile)
    nativeSelect.addEventListener('change', function() {
        const value = this.value;
        const url = new URL(window.location.href);

        if (value && value !== "") {
            url.searchParams.set('status', value);
        } else {
            url.searchParams.delete('status');
        }
        url.searchParams.delete('pagina');
        window.location.href = url.toString();
    });
</script>

<script src="../../PUBLIC/JS/script-clientes-adm.js"></script>
<script src="../../PUBLIC/JS/script.js"></script>
<script src="../../PUBLIC/JS/script-pop-up.js"></script>
<script src="../../PUBLIC/JS/script-tema.js"></script>

</main>
</body>
</html>