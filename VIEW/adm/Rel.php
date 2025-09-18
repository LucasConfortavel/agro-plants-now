<?php
include "../../INCLUDE/Menu_adm.php";
 include "../../CONTROLLER/UsuarioController.php";
 include "../../INCLUDE/vlibras.php";

    $controler_user = new UsuarioController();

    // POST: criar vendedor
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $teste = $controler_user->criar();
        print_r($teste);
        // header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    $action_handled = false;

    if(!empty($_GET)){
        if (isset($_GET['visualizar'])){
            $id = $_GET['visualizar'];
            $usuario = $controler_user->mostrar($id);
            $action_handled = true;
            header('Location: info-edit-adm.php?id=' . $id . "&usuario=" . $usuario['tipo']);

        } elseif (isset($_GET['remover'])){
            $id = $_GET['remover'];
            $usuario = $controler_user->deletar($id);
            $action_handled = true;
            header('Location: ' . $_SERVER['PHP_SELF']);
        }
    }
    
    $usuarios = $controler_user->index();

    $total_vendedores = count($usuarios);

    $limite = 4;
    $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    if ($pagina_atual < 1) $pagina_atual = 1;
    $offset = ($pagina_atual - 1) * $limite;

    $total_paginas = ($total_vendedores > 0) ? ceil($total_vendedores / $limite) : 1;

    $usuarios = array_slice($usuarios, $offset, $limite);
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Vendas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/lista-vendedores-adm.css">
    <link rel="stylesheet" href="../../PUBLIC/css/relatorio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>

    
<main class="jp_main-content">
    <div class="tab-content" id="sales-tab-content" style="display:block;">
        <div class="po-container">
            <h1 class="ym_titulo">Relatório de Vendas</h1>

                <nav class="tabs-nav">
                    <button class="po-tab-btn po-active" data-tab="sales">Vendas</button>
                    <button class="po-tab-btn" data-tab="commissions">Comissões</button>
                </nav>
            
            <div class="po-card">
                <div class="jv_card">
                <div class="jv_card-header">
                    <div class="jv_header-content">
                        <form method="POST" action="#" class="jv_search-section">
                            <div class="jv_search-container">
                                <button type="submit" class="ym_area-icon-pesquisa" name="pesquisar">
                                    <i class="fas fa-search search-icon"></i>
                                </button>
                                <input type="text" name="pesquisa" id="jv_searchInput" placeholder="Pesquisar por nome ou email..." class="jv_search-input">
                            </div>
                        </form>

                        <div class="jv_actions">
                            <div>
                                <button class="ym_btn-remover" id="jv_removeSelected" style="display: none;">
                                    <i class="fa-solid fa-trash-can"></i>
                                    Remover (<span id="jv_selectedCount">0</span>)
                                </button>
                            </div>
                            <div>
                                <button type="button" class="ym_btn-padrao" onclick="abrirPopup('../../VIEW/pop-up/cadastrar_vendedor.php','Cadastro de Vendedores')">
                                    <i class="fas fa-plus"></i>
                                    <span>Cadastrar Vendedor</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <p class="jv_subtitle" id="jv_customerCount">
                        <?= $total_vendedores ?> vendedores encontrados
                    </p>
                </div>

                <div class="jv_card-content">
                    <div class="jv_table-container">
                        <table class="jv_table">
                            <thead>
                                <tr class="jv_table-header">
                                    <th class="jv_checkbox-col">
                                        <input type="checkbox" id="jv_selectAll" class="jv_checkbox">
                                    </th>
                                    <th class="jv_name">Nome</th>
                                    <th class="jv_banguela">Telefone</th>
                                    <th class="jv_data">Data de Nascimento</th>
                                    <th class="jv_data">Status</th>
                                    <th class="jv_actions-col"></th>
                                </tr>
                            </thead>
                            <tbody id="jv_customerTableBody">
                                <?php if (count($usuarios) === 0): ?>
                                    <tr>
                                        <td colspan="5" style="text-align:center; padding: 2rem;">
                                            Nenhum vendedor nesta página.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($usuarios as $vend): ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="jv_checkbox customer-checkbox" data-customer-id="<?= htmlspecialchars($vend['id']) ?>">
                                            </td>
                                            <td>
                                                <div class="jv_customer-info">
                                                    <div class="jv_avatar">
                                                        <?= strtoupper(substr($vend['nome'], 0, 2)) ?>
                                                    </div>
                                                    <div class="jv_customer-details">
                                                        <h4><?= htmlspecialchars($vend['nome']) ?></h4>
                                                        <p><?= htmlspecialchars($vend['email']) ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= htmlspecialchars($vend['telefone']) ?></td>
                                            <td><?= date("d/m/Y", strtotime($vend['data_nasc'])) ?></td>
                                            <td><?= htmlspecialchars($vend['status']) ?></td>
                                            <td class="jv_table-action">
                                                <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <form class="jv_dropdown" method="GET" action="">
                                                    <button type="submit" name="visualizar" value="<?= htmlspecialchars($vend['id']) ?>" class="jv_dropdown-item">
                                                        <i class="fas fa-eye"></i> Visualizar
                                                    </button>
                                                    <div class="jv_dropdown-separator"></div>
                                                    <button type="button" onclick="abrirPopup('../../VIEW/pop-up/pop-up_remover.php?id=<?= htmlspecialchars($vend['id'])?>','Cadastro de Vendedores')" class="jv_dropdown-item jv_danger">
                                                        <i class="fa-solid fa-ban"></i> Desativar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
            <div class="po-charts-grid">
                <div class="po-card">
                    <h3>Vendas por mês</h3>
                    <canvas id="sales-bar-chart"></canvas>
                </div>
                <div class="po-card">
                    <h3>Status dos pedidos</h3>
                    <canvas id="sales-pie-chart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-content" id="commissions-tab-content" style="display:none;">
        <div class="po-container">
            <h1 class="ym_titulo">Relatório de Comissões</h1>

                            <nav class="tabs-nav">
                                <button class="po-tab-btn po-active" data-tab="sales">Vendas</button>
                                <button class="po-tab-btn" data-tab="commissions">Comissões</button>
                            </nav>
            
            <div class="po-card">
                <div class="jv_card">
                <div class="jv_card-header">
                    <div class="jv_header-content">
                        <form method="POST" action="#" class="jv_search-section">
                            <div class="jv_search-container">
                                <button type="submit" class="ym_area-icon-pesquisa" name="pesquisar">
                                    <i class="fas fa-search search-icon"></i>
                                </button>
                                <input type="text" name="pesquisa" id="jv_searchInput" placeholder="Pesquisar por nome ou email..." class="jv_search-input">
                            </div>
                        </form>

                        <div class="jv_actions">
                            <div>
                                <button class="ym_btn-remover" id="jv_removeSelected" style="display: none;">
                                    <i class="fa-solid fa-trash-can"></i>
                                    Remover (<span id="jv_selectedCount">0</span>)
                                </button>
                            </div>
                            <div>
                                <button type="button" class="ym_btn-padrao" onclick="abrirPopup('../../VIEW/pop-up/cadastrar_vendedor.php','Cadastro de Vendedores')">
                                    <i class="fas fa-plus"></i>
                                    <span>Cadastrar Vendedor</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <p class="jv_subtitle" id="jv_customerCount">
                        <?= $total_vendedores ?> vendedores encontrados
                    </p>
                </div>

                <div class="jv_card-content">
                    <div class="jv_table-container">
                        <table class="jv_table">
                            <thead>
                                <tr class="jv_table-header">
                                    <th class="jv_checkbox-col">
                                        <input type="checkbox" id="jv_selectAll" class="jv_checkbox">
                                    </th>
                                    <th class="jv_name">Nome</th>
                                    <th class="jv_banguela">Telefone</th>
                                    <th class="jv_data">Data de Nascimento</th>
                                    <th class="jv_data">Status</th>
                                    <th class="jv_data">Status</th>
                                    <th class="jv_data">Status</th>
                                    <th class="jv_actions-col"></th>
                                </tr>
                            </thead>
                            <tbody id="jv_customerTableBody">
                                <?php if (count($usuarios) === 0): ?>
                                    <tr>
                                        <td colspan="5" style="text-align:center; padding: 2rem;">
                                            Nenhum vendedor nesta página.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($usuarios as $vend): ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="jv_checkbox customer-checkbox" data-customer-id="<?= htmlspecialchars($vend['id']) ?>">
                                            </td>
                                            <td>
                                                <div class="jv_customer-info">
                                                    <div class="jv_avatar">
                                                        <?= strtoupper(substr($vend['nome'], 0, 2)) ?>
                                                    </div>
                                                    <div class="jv_customer-details">
                                                        <h4><?= htmlspecialchars($vend['nome']) ?></h4>
                                                        <p><?= htmlspecialchars($vend['email']) ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= htmlspecialchars($vend['telefone']) ?></td>
                                            <td><?= date("d/m/Y", strtotime($vend['data_nasc'])) ?></td>
                                            <td><?= htmlspecialchars($vend['status']) ?></td>
                                            <td class="jv_table-action">
                                                <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <form class="jv_dropdown" method="GET" action="">
                                                    <button type="submit" name="visualizar" value="<?= htmlspecialchars($vend['id']) ?>" class="jv_dropdown-item">
                                                        <i class="fas fa-eye"></i> Visualizar
                                                    </button>
                                                    <div class="jv_dropdown-separator"></div>
                                                    <button type="button" onclick="abrirPopup('../../VIEW/pop-up/pop-up_remover.php?id=<?= htmlspecialchars($vend['id'])?>','Cadastro de Vendedores')" class="jv_dropdown-item jv_danger">
                                                        <i class="fa-solid fa-ban"></i> Desativar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>

            <div class="po-charts-grid">
                <div class="po-card">
                    <h3>Comissões por vendedor</h3>
                    <canvas id="comm-bar-chart"></canvas>
                </div>
                <div class="po-card">
                    <h3>Distribuição de comissões</h3>
                    <canvas id="comm-doughnut-chart"></canvas>
                </div>
            </div>
        </div>
    </div>

</main>

<?php
$vendas_mensais = [1200, 1900, 3000, 500, 2000, 3000]; 
$status_pedidos = ["Concluído" => 45, "Pendente" => 10, "Cancelado" => 5];

$comissoes_vendedor = ["João" => 1500, "Maria" => 2500, "Carlos" => 1800];
$comissoes_dist = ["Fixas" => 40, "Variáveis" => 60];
?>

<script>
document.addEventListener("DOMContentLoaded", () => {
    new Chart(document.getElementById("sales-bar-chart"), {
        type: "bar",
        data: {
            labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun"],
            datasets: [{
                label: "Vendas (R$)",
                data: <?= json_encode($vendas_mensais) ?>,
                backgroundColor: "#469851ff"
            }]
        }
    });

    new Chart(document.getElementById("sales-pie-chart"), {
        type: "pie",
        data: {
            labels: <?= json_encode(array_keys($status_pedidos)) ?>,
            datasets: [{
                data: <?= json_encode(array_values($status_pedidos)) ?>,
                backgroundColor: ["#358e40ff", "#ff9800", "#f44336"]
            }]
        }
    });

    new Chart(document.getElementById("comm-bar-chart"), {
        type: "bar",
        data: {
            labels: <?= json_encode(array_keys($comissoes_vendedor)) ?>,
            datasets: [{
                label: "Comissões (R$)",
                data: <?= json_encode(array_values($comissoes_vendedor)) ?>,
                backgroundColor: "#4cb059ff"
            }]
        }
    });

    new Chart(document.getElementById("comm-doughnut-chart"), {
        type: "doughnut",
        data: {
            labels: <?= json_encode(array_keys($comissoes_dist)) ?>,
            datasets: [{
                data: <?= json_encode(array_values($comissoes_dist)) ?>,
                backgroundColor: ["#45734b", "#17e332ff"]
            }]
        }
    });
});
</script>


<script src="../../PUBLIC/JS/script-tabs.js"></script>
<script src="../../PUBLIC/JS/script-select.js"></script>
<script src="../../PUBLIC/JS/script-relatorio.js"></script>
</body>
</html>
