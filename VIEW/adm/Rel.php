<?php
include "../../INCLUDE/Menu_adm.php";
include "../../CONTROLLER/UsuarioController.php";
include "../../CONTROLLER/ProdutoController.php";
include "../../CONTROLLER/VendaController.php";  
include "../../CONTROLLER/ClienteController.php";
include "../../INCLUDE/vlibras.php";
 
$controler_user = new UsuarioController();
$produto_item   = new ProdutoController();
$usuario_control = new UsuarioController();
$cliente_control = new ClienteController();
$venda_control   = new VendaController();  
 
$vendas = $venda_control->index();
$total_vendas = count($vendas);
 
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
 
    $produto_item = new ProdutoController();
 
    // POST: criar vendedor
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $teste_prod = $produto_item->criar();
        print_r($teste_prod);
        // header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
 
    $action_handled = false;
 
   
    $produtos = $produto_item->index();
 
    $total_vendas = count($vendas);
 
    $limite = 4;
    $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    if ($pagina_atual < 1) $pagina_atual = 1;
    $offset = ($pagina_atual - 1) * $limite;
 
    $total_paginas = ($total_vendas > 0) ? ceil($total_vendas / $limite) : 1;
 
    $usuarios = array_slice($vendas, $offset, $limite);
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
    <link rel="stylesheet" href="../../PUBLIC/css/global-tema.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 
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
                        <input type="text" name="pesquisa" id="jv_searchInput" placeholder="Pesquisar por nome ou cliente..." class="jv_search-input">
                    </div>
                </form>
 
                <div class="jv_actions">
                    <div>    
                        <div>
                            <button type="button" class="po-btn" onclick="abrirPopup('../../VIEW/pop-up/cadastrar_vendedor.php','Cadastro de Vendedores')">
                                <span><i class="fa-regular fa-file"></i></span>
                                Exportar CSV
                            </button>
                        </div>
 
                        <div class="ym_area-select">
                            <div class="ym_select" onclick="mostrar_categorias()">
                                <p class="ym_categoria-select">Último mês</p>
                                <p class="ym_seta-categoria">></p>
                            </div>
                                   
                                   
                            <div class="ym_options">
                                <a class="ym_link-option" onclick="trocar_categoria()"> Último trimestre</a>
                                <a class="ym_link-option" onclick="trocar_categoria(0,1)"> Último ano</a>
                            </div>
                                   
                        </div>
                    </div>    
                </div>
            </div>
 
            <p class="jv_subtitle" id="jv_customerCount">
                <?= $total_vendas ?> <?= $total_vendas == 1 ? 'venda encontrada' : 'vendas encontradas' ?>
            </p>
        </div>
 
        <!-- Tabela de Vendas -->
        <div class="jv_card-content">
            <div class="jv_table-container">
                <table class="jv_table">
                    <thead>
                        <tr class="jv_table-header">
                            <th class="jv_checkbox-col">
                                <input type="checkbox" id="jv_selectAll" class="jv_checkbox">
                            </th>
                            <th class="jv_date">Data</th>
                            <th class="jv_name"><p>Vendedor</p></th>
                            <th class="jv_name_cli">Cliente</th>
                            <th class="jv_valor_gast">Valor Gasto</th>
                            <th class="jv_actions-col"></th>
                        </tr>
                    </thead>
                    <tbody id="jv_customerTableBody">
                        <?php if ($total_vendas > 0): ?>
                            <?php foreach ($vendas as $venda):    
                                $vendedor = $usuario_control->mostrar($venda["id_vendedor"]);  
                                $cliente = $cliente_control->mostrar($venda["id_cliente"]);
                            ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="jv_checkbox customer-checkbox" data-customer-id="<?= $venda['id'] ?>">
                                    </td>
                                    <td><?= date("d/m/Y", strtotime($cliente['data_nasc'])) ?></td>
                                    <td>
                                        <div class="jv_customer-info">
                                            <div class="jv_avatar">
                                                <?= strtoupper(substr($vendedor['nome'] ?? '', 0, 2)) ?>
                                            </div>
                                            <div class="jv_customer-details">
                                                <h4><?= htmlspecialchars($vendedor['nome'] ?? '-') ?></h4>
                                                <p><?= htmlspecialchars($vendedor['email'] ?? '-') ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($cliente['nome'] ?? '-') ?></td>
                                    <td><?= 'R$ ' . number_format($venda['total'], 2, ',', '.') ?></td>
                                    <td class="jv_table-action">
                                        <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <form class="jv_dropdown">
                                            <button class="jv_dropdown-item" type="submit" name="visualizar" value="<?= htmlspecialchars($venda['id'])?>">
                                                <i class="fas fa-eye"></i> Visualizar
                                            </button>
                                            <div class="jv_dropdown-separator"></div>
                                            <button class="jv_dropdown-item jv_danger" type="submit" name="remover" value="<?= htmlspecialchars($venda['id'])?>">
                                                <i class="fas fa-trash"></i> Remover
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" style="text-align: center; height: 49.7vh;">Nenhuma venda encontrada</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 
<!-- Paginação -->
<div class="jv_page-navigation">
    <?php if($pagina_atual > 1): ?>
        <a href="?pagina=<?= $pagina_atual - 1 ?>" class="jv_page-arrow">
            <i class="fas fa-arrow-left"></i>
        </a>
    <?php endif; ?>
 
    <?php
    $inicio = max(1, $pagina_atual - 2);
    $fim = min($total_paginas, $pagina_atual + 2);
    for ($i = $inicio; $i <= $fim; $i++): ?>
        <a href="?pagina=<?= $i ?>" class="jv_page-number <?= $i == $pagina_atual ? 'active' : '' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>
 
    <?php if($pagina_atual < $total_paginas): ?>
        <a href="?pagina=<?= $pagina_atual + 1 ?>" class="jv_page-arrow">
            <i class="fas fa-arrow-right"></i>
        </a>
    <?php endif; ?>
</div>
 
            </div>
            <div class="po-charts-grid">
                <div class="po-card">
                    <h3>Vendas por mês</h3>
                    <div class="ym_areaselect">
                        <div class="ym_select" onclick="mostrar_categorias(1)">
                            <p class="ym_categoria-select">Último mês</p>
                            <p class="ym_seta-categoria">></p>
                        </div>
                                   
                                   
                        <div class="ym_options">
                            <a class="ym_link-option" onclick="trocar_categoria(0)"> Último trimestre</a>
                            <a class="ym_link-option" onclick="trocar_categoria(0,1)"> Último ano</a>
                        </div>
                    </div>
                   
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
                                <button class="po-tab-btn" data-tab="sales">Vendas</button>
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
                                <button type="button" class="po-btn" onclick="abrirPopup('../../VIEW/pop-up/cadastrar_vendedor.php','Cadastro de Vendedores')">
                                    <span><i class="fa-regular fa-file"></i></span>
                                    Exportar CSV
                                </button>
                            </div>
 
                            <div class="ym_area-select">
                                <div class="ym_select" onclick="mostrar_categorias(2)">
                                    <p class="ym_categoria-select">Último mês</p>
                                    <p class="ym_seta-categoria">></p>
                                </div>
                                   
                                   
                                <div class="ym_options">
                                    <a class="ym_link-option" onclick="trocar_categoria()"> Último trimestre</a>
                                    <a class="ym_link-option" onclick="trocar_categoria(0,1)"> Último ano</a>
                                </div>
                                   
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
                                    <th class="jv_name">Data</th>
                                    <th class="jv_banguela">Vendedor</th>
                                    <th class="jv_data">Produto/Serviço</th>
                                    <th class="jv_data">Valor de Venda</th>
                                    <th class="jv_comissao">Comissao</th>
                                    <th class="jv_banguela">Valor da Comissao</th>
                                    <th class="jv_status">status</th>
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
                           
                        <div class="jv_page-navigation">
                            <?php if ($pagina_atual > 1): ?>
                                <a href="?pagina=<?= $pagina_atual - 1 ?>" class="jv_page-arrow">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            <?php endif; ?>
 
                            <?php
                            $inicio = max(1, $pagina_atual - 2);
                            $fim = min($total_paginas, $pagina_atual + 2);
                            for ($i = $inicio; $i <= $fim; $i++): ?>
                                <a href="?pagina=<?= $i ?>" class="jv_page-number <?= $i == $pagina_atual ? 'active' : '' ?>">
                                    <?= $i ?>
                                </a>
                            <?php endfor; ?>
 
                            <?php if ($pagina_atual < $total_paginas): ?>
                                <a href="?pagina=<?= $pagina_atual + 1 ?>" class="jv_page-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            <?php endif; ?>
                        </div>
 
                        <a class="ym_mobile-td" onclick="abrirPopup('../pop-up/informacoes_vendedor.php','Informações do vendedor')">
                            <i class="fa-solid fa-circle-info"></i>
                        </a>
            </div>
            </div>
 
           
 
            <div class="po-charts-grid">
                <div class="po-card">
                    <h3>Gasto com Comissões</h3>
                    <div class="ym_areaselect">
                        <div class="ym_select" onclick="mostrar_categorias(3)">
                            <p class="ym_categoria-select">Último mês</p>
                            <p class="ym_seta-categoria">></p>
                        </div>
                                   
                                   
                        <div class="ym_options">
                            <a class="ym_link-option" onclick="trocar_categoria(0)"> Último trimestre</a>
                            <a class="ym_link-option" onclick="trocar_categoria(0,1)"> Último ano</a>
                        </div>
                    </div>
                    <canvas id="comm-line-chart"></canvas>
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
$vendas_mensais = [1200, 1900, 2100, 500, 2000, 3000, 1200, 1900, 2100, 500, 5000, 4000];
$status_pedidos = ["Concluído" => 45, "Pendente" => 10, "Cancelado" => 5];
$comissoes_vendedor = [0, 0, 0, 0, 0, 0, 0, 3000, 0, 0, 00, 0];
$comissoes_dist = ["Fixas" => 40, "Variáveis" => 60];
 
$max_venda = max($vendas_mensais);
$colors_vendas = [];
foreach ($vendas_mensais as $v) {
    $colors_vendas[] = $v == $max_venda ? "#45734b" : "rgba(36, 146, 51, 0.5)";
}
 
$colors_status = ["#45734b", "rgba(69,115,75,0.7)", "rgba(69,115,75,0.4)"];
?>
 
 
<script>
document.addEventListener("DOMContentLoaded", () => {
 
    new Chart(document.getElementById("sales-bar-chart"), {
        type: "bar",
        data: {
            labels: ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Agos","Set","Oct","Nov","Dec"],
            datasets: [{
                label: "Vendas (R$)",
                data: <?= json_encode($vendas_mensais) ?>,
                backgroundColor: <?= json_encode($colors_vendas) ?>,
                borderRadius: 8,
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: { display: false },
                tooltip: { callbacks: { label: ctx => "R$ " + ctx.raw.toLocaleString("pt-BR") } }
            },
            scales: {
                y: { beginAtZero: true, ticks: { callback: v => "R$ " + v }, grid: { color: "rgba(0,0,0,0.05)" } },
                x: { grid: { display: false } }
            }
        }
    });
 
    new Chart(document.getElementById("sales-pie-chart"), {
        type: "pie",
        data: {
            labels: <?= json_encode(array_keys($status_pedidos)) ?>,
            datasets: [{
                data: <?= json_encode(array_values($status_pedidos)) ?>,
                backgroundColor: <?= json_encode($colors_status) ?>,
                borderColor: "#fff",
                borderWidth: 2,
                hoverOffset: 12
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: "bottom", labels: { font: { size: 13 } } },
                tooltip: { callbacks: { label: ctx => ctx.label + ": " + ctx.raw + "%" } }
            }
        }
    });
 
    new Chart(document.getElementById("comm-line-chart"), {
        type: "line",
        data: {
            labels: ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Agos","Set","Oct","Nov","Dec"],
            datasets: [{
                label: "Gasto com Comissões (R$)",
                data: <?= json_encode(array_values($comissoes_vendedor)) ?>,
                backgroundColor: "rgba(69,115,75,0.2)",
                borderColor: "#45734b",
                borderWidth: 3,
                fill: true,
                tension: 0.3,
                pointBackgroundColor: "#45734b",
                pointRadius: 6
            }]
        },
        options: {
            plugins: {
                legend: { labels: { font: { size: 14 } } },
                tooltip: {
                    callbacks: {
                        label: ctx => "R$ " + ctx.raw.toLocaleString("pt-BR")
                    }
                }
            },
            scales: {
                y: { beginAtZero: true, ticks: { callback: v => "R$ " + v }, grid: { color: "rgba(0,0,0,0.05)" } },
                x: { grid: { display: false } }
            }
        }
    });
 
        new Chart(document.getElementById("comm-doughnut-chart"), {
        type: "doughnut",
        data: {
            labels: <?= json_encode(array_keys($comissoes_dist)) ?>,
            datasets: [{
                data: <?= json_encode(array_values($comissoes_dist)) ?>,
                backgroundColor: ["#45734b","#17e33293"],
                borderColor: "#fff",
                borderWidth: 2,
                hoverOffset: 12
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: "bottom", labels: { font: { size: 13 } } },
                tooltip: { callbacks: { label: ctx => ctx.label + ": " + ctx.raw + "%" } }
            }
        }
    });
 
});
 
 
</script>
 
<script src="../../PUBLIC/JS/script-lista-vendedores.js"></script>
<script src="../../PUBLIC/JS/script-tabs.js"></script>
<script src="../../PUBLIC/JS/script-select.js"></script>
<script src="../../PUBLIC/JS/script-relatorio.js"></script>
<script src="../../PUBLIC/JS/script-tema.js"></script>
</body>
</html>