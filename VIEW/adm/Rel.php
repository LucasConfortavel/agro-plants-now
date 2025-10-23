<?php
include "../../INCLUDE/Menu_adm.php";
include "../../CONTROLLER/UsuarioController.php";
include "../../CONTROLLER/ProdutoController.php";
include "../../CONTROLLER/VendaController.php";  
include "../../CONTROLLER/ClienteController.php";
include "../../CONTROLLER/ComissaoController.php";
include "../../INCLUDE/vlibras.php";
 
$controler_user = new UsuarioController();
$produto_item   = new ProdutoController();
$usuario_control = new UsuarioController();
$cliente_control = new ClienteController();
$venda_control   = new VendaController();  
$comissao_control = new ComissaoController();

$comissoes = $comissao_control->index(); 
$vendas = $venda_control->index();
$total_vendas = count($vendas);

$pdo = new PDO("mysql:host=192.168.22.9;dbname=143p2;charset=utf8", "turma143p2", "sucesso@143");

$stmt = $pdo->query("SELECT status, COUNT(*) as total FROM pedidos GROUP BY status");
$status_pedidos_raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

 
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
 
    $vendas_paginadas = array_slice($vendas, $offset, $limite);


    $total_comissoes = count($comissoes);
    $limite_comissoes = 4;
    $pagina_atual_comissoes = isset($_GET['pagina_comissoes']) ? (int)$_GET['pagina_comissoes'] : 1;
    if ($pagina_atual_comissoes < 1) $pagina_atual_comissoes = 1;
    $offset_comissoes = ($pagina_atual_comissoes - 1) * $limite_comissoes;

    $total_paginas_comissoes = ($total_comissoes > 0) ? ceil($total_comissoes / $limite_comissoes) : 1;

    $comissoes_paginadas = array_slice($comissoes, $offset_comissoes, $limite_comissoes);
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
                    <button class="po-tab-btn po-active" data-tab="sales"> <p>Vendas</p></button>
                    <button class="po-tab-btn" data-tab="commissions"><p>Comissões</p></button>
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
                                        <div>
                                            <button type="button" class="po-btn" id="exportarCsvBtn">
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
                                            <th class="jv_date">Data</th>
                                            <th class="jv_name"><p>Vendedor</p></th>
                                            <th class="jv_name_cli">Cliente</th>
                                            <th class="jv_valor_gast">Valor Gasto</th>
                                            <th class="jv_actions-col"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="jv_customerTableBody">
                                        <?php if ($total_vendas > 0): ?>
                                            <?php foreach ($vendas_paginadas as $venda):   
                                                $vendedor = $usuario_control->mostrar($venda["id_vendedor"]);  
                                                $cliente = $cliente_control->mostrar($venda["id_cliente"]);
                                                
                                            ?>
                                                <tr>
                                                    <td><?= date("d/m/Y", strtotime($venda['data_venda'])) ?></td>
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
                        </div>
                    </div>
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
                                   
                        <!-- comissao -->

                        
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
                <button class="po-tab-btn" data-tab="sales"><p>Vendas</p></button>
                <button class="po-tab-btn" data-tab="commissions"><p>Comissões</p></button>
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
                                    <div>
                                        <button type="button" class="po-btn" id="exportarCsvComissoesBtn">
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
                        </div>
 
                        <p class="jv_subtitle" id="jv_customerCount">
                            <?= $total_vendas ?> vendedores encontrados
                        </p>
                </div>
 
                <div class="jv_card-content">
                    <div class="jv_table-container">
                        <table class="jv_table">
                            <thead>
                                <tr class="jv_table-header">
                                    <th class="jv_date">Data</th>
                                    <th class="jv_banguela">Vendedor</th>
                                    <th class="jv_name_cli">Cliente</th>
                                    <th class="jv_valor_venda">Valor de Venda</th>
                                    <th class="jv_comissao"><p>Comissao</p></th>
                                    <th class="jv_banguela">Valor da Comissao</th>
                                    <th class="jv_actions-col"></th>
                                </tr>
                            </thead>
                            <tbody id="jv_customerTableBody">
                                <?php if ($total_vendas > 0  ): ?>
                                    <?php foreach ($comissoes_paginadas as $comissao): ?>
                                        <?php 
                                            $vendedor = $usuario_control->mostrar($venda['id_vendedor']);
                                            $cliente  = $cliente_control->mostrar($venda['id_cliente']);
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y", strtotime($venda['data_venda'])) ?></td>
                                            <td>
                                                <div class="jv_customer-info">
                                                    <div class="jv_avatar"> <?= strtoupper(substr($vendedor['nome'] ?? '', 0, 2)) ?> </div>
                                                    <div class="jv_customer-details">
                                                        <h4><?= htmlspecialchars($vendedor['nome'] ?? '-') ?></h4>
                                                        <p><?= htmlspecialchars($vendedor['email'] ?? '-') ?></p>
                                                    </div>
                                                </div>
                                            </td> 
                                            <td><?= htmlspecialchars($cliente['nome'] ?? '-') ?></td>
                                            <td><?= 'R$ ' . number_format($venda['total'] ?? 0, 2, ',', '.') ?></td>
                                            <td>
                                                <span class="badge-comissao">
                                                    <?= htmlspecialchars($comissao['percentual'] ?? 0) . '%' ?>
                                                </span>
                                            </td>

                                            <td><?= 'R$ ' . number_format($comissao['valor'] ?? 0, 2, ',', '.') ?></td>
                                            <td class="jv_table-action">
                                                <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <form class="jv_dropdown" method="GET" action="">
                                                    <button type="submit" name="visualizar" value="<?= htmlspecialchars($comissao['id']) ?>" class="jv_dropdown-item">
                                                        <i class="fas fa-eye"></i> Visualizar
                                                    </button>
                                                    <div class="jv_dropdown-separator"></div>
                                                    <button type="button" onclick="abrirPopup('../../VIEW/pop-up/pop-up_remover.php?id=<?= htmlspecialchars($comissao['id'])?>','Remover Comissão')" class="jv_dropdown-item jv_danger">
                                                        <i class="fa-solid fa-ban"></i> Remover
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
                           
                <div class="jv_page-navigation">
                    <?php if ($pagina_atual_comissoes > 1): ?>
                        <a href="?pagina_comissoes=<?= $pagina_atual_comissoes - 1 ?>" class="jv_page-arrow">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    <?php endif; ?>

                    <?php
                    $inicio = max(1, $pagina_atual_comissoes - 2);
                    $fim = min($total_paginas_comissoes, $pagina_atual_comissoes + 2);
                    for ($i = $inicio; $i <= $fim; $i++): ?>
                        <a href="?pagina_comissoes=<?= $i ?>" class="jv_page-number <?= $i == $pagina_atual_comissoes ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($pagina_atual_comissoes < $total_paginas_comissoes): ?>
                        <a href="?pagina_comissoes=<?= $pagina_atual_comissoes + 1 ?>" class="jv_page-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            </div>
 
            <div class="po-charts-grid">
                <div class="po-card">
                    <h3>Gasto com Comissões</h3>
                    <div class="ym_areaselect_com">
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
$status_pedidos = [
    "PAGO" => 0,
    "ENVIADO" => 0,
    "FINALIZADO" => 0
];

$total_pedidos = 0;
foreach ($status_pedidos_raw as $status) {
    $status_nome = strtoupper(trim($status['status']));
    $quantidade = (int)$status['total'];
    
    if (isset($status_pedidos[$status_nome])) {
        $status_pedidos[$status_nome] = $quantidade;
    }
    $total_pedidos += $quantidade;
}

if ($total_pedidos == 0) {
    $status_pedidos = [
        "PAGO" => 0.001,
        "ENVIADO" => 0.001,
        "FINALIZADO" => 0.001
    ];
} else {
    $status_pedidos = array_filter($status_pedidos, function($value) {
        return $value > 0;
    });
}

$colors_status = [];
$status_colors_map = [
    "PAGO" => "#107a10ff",
    "ENVIADO" => "#125d12ff",
    "FINALIZADO" => "#27db36ff",
];

foreach (array_keys($status_pedidos) as $status) {
    $colors_status[] = $status_colors_map[$status] ?? "rgba(69,115,75,0.5)";
}

$vendas_mensais = array_fill(0, 12, 0);

foreach ($vendas as $venda) {
    $data = $venda['data'] ?? $venda['data_venda'] ?? null;
    $total = isset($venda['total']) ? (float)$venda['total'] : 0;

    if ($data) {
        $mes = (int) date("n", strtotime($data)) - 1;
        $vendas_mensais[$mes] += $total;
    }
}

$max_venda = max($vendas_mensais);
$colors_vendas = array_map(fn($v) => $v == $max_venda ? "#27db36ff" : "#107a10ff", $vendas_mensais);

$comissoes_vendedor = array_fill(0, 12, 0);
$comissoes_dist = ["Fixas" => 0, "Variáveis" => 0];

foreach ($vendas as $comissao) {
    $data = $comissao['data'] ?? $comissao['data_venda']  ?? null;
    $mes = ($data && strtotime($data) !== false) ? ((int)date("n", strtotime($data)) - 1) : (int)date("n") - 1;

    $valor = 0;
    if (isset($comissao['valor'])) $valor = (float)$comissao['valor'];
    elseif (isset($comissao['valor'])) $valor = (float)$comissao['valor'];
    elseif (isset($comissao['valor'], $comissao['percentual']))
        $valor = (float)$comissao['valor'] * ((float)$comissao['percentual'] / 100);

    $comissoes_vendedor[$mes] += $valor > 0 ? $valor : 0.001;

    $tipo = $comissao['valor'] ?? 'Fixas';
    if (isset($comissoes_dist[$tipo])) $comissoes_dist[$tipo] += $valor > 0 ? $valor : 0.001;
}

foreach ($comissoes_dist as $key => $value) if ($value==0) $comissoes_dist[$key]=0.001;
?>

<script>
document.addEventListener("DOMContentLoaded", () => {
    new Chart(document.getElementById("sales-bar-chart"), {
        type: "bar",
        data: {
            labels: ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"],
            datasets: [{
                label: "Vendas (R$)",
                data: <?= json_encode($vendas_mensais) ?>,
                backgroundColor: <?= json_encode(value: $colors_vendas) ?>,
                borderRadius: 8,
                borderWidth: 1,
                
            }]
        },
        options: {
            plugins: {
                legend: { display: false },
                tooltip: { 
                    callbacks: { 
                        label: ctx => "R$ " + ctx.raw.toLocaleString("pt-BR", {minimumFractionDigits: 2}) 
                    } 
                }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    ticks: { callback: v => "R$ " + v.toLocaleString("pt-BR") }, 
                    grid: { color: "rgba(0,0,0,0.05)" } 
                },
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
            plugins: {
                legend: { 
                    position: "bottom", 
                    labels: { font: { size: 13 } } 
                },
                tooltip: { 
                    callbacks: { 
                        label: function(ctx) {
                            const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                            const value = ctx.raw;
                            const percentage = ((value / total) * 100).toFixed(1);
                            return ctx.label + ": " + value + " (" + percentage + "%)";
                        }
                    } 
                }
            }
        }
    });

    new Chart(document.getElementById("comm-line-chart"), {
        type: "line",
        data: {
            labels: ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"],
            datasets: [{
                label: "Gasto com Comissões (R$)",
                data: <?= json_encode(array_values($comissoes_vendedor)) ?>,
                backgroundColor: "rgba(44, 171, 54, 0.23)",
                borderColor: "#27db36ff",
                borderWidth: 3,
                fill: true,
                tension: 0.1,
                pointBackgroundColor: "#27db36ff",
                pointRadius: 6
            }]
        },
        options: {
            plugins: {
                legend: { labels: { font: { size: 14 } } },
                tooltip: { 
                    callbacks: { 
                        label: ctx => "R$ " + ctx.raw.toLocaleString("pt-BR",{minimumFractionDigits:2}) 
                    } 
                }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    ticks: { callback: v => "R$ " + v.toLocaleString("pt-BR",{minimumFractionDigits:2}) }, 
                    grid: { color: "rgba(0,0,0,0.05)" } 
                },
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
                backgroundColor: ["#107a10ff","#27db36ff"],
                borderColor: "#fff",
                borderWidth: 2,
                hoverOffset: 12
            }]
        },
        options: {
            plugins: {
                legend: { 
                    position: "bottom", 
                    labels: { font: { size: 13 } } 
                },
                tooltip: { 
                    callbacks: { 
                        label: ctx => ctx.label + ": R$ " + ctx.raw.toLocaleString("pt-BR") 
                    } 
                }
            }
        }
    });
});


document.addEventListener("DOMContentLoaded", function() {
    // --- EXPORTAR CSV DE VENDAS ---
    const botaoVendas = document.getElementById("exportarCsvBtn");
    if (botaoVendas) {
        botaoVendas.addEventListener("click", function() {
            exportarTabelaCsv(".tab-content#sales-tab-content .jv_table", "relatorio_vendas.csv");
        });
    }

    // --- EXPORTAR CSV DE COMISSÕES ---
    const botaoComissoes = document.getElementById("exportarCsvComissoesBtn");
    if (botaoComissoes) {
        botaoComissoes.addEventListener("click", function() {
            exportarTabelaCsv(".tab-content#commissions-tab-content .jv_table", "relatorio_comissoes.csv");
        });
    }

    // --- FUNÇÃO GENÉRICA ---
    function exportarTabelaCsv(seletorTabela, nomeArquivo) {
        const tabela = document.querySelector(seletorTabela);
        if (!tabela) {
            alert("Tabela não encontrada!");
            return;
        }

        let linhas = tabela.querySelectorAll("tr");
        let csv = [];

        linhas.forEach(linha => {
            let colunas = linha.querySelectorAll("th, td");
            let linhaCsv = [];

            colunas.forEach(celula => {
                let texto = celula.innerText.replace(/\n/g, " ").replace(/,/g, "");
                linhaCsv.push('"' + texto.trim() + '"');
            });

            csv.push(linhaCsv.join(","));
        });

        let csvString = csv.join("\n");
        let blob = new Blob([csvString], { type: "text/csv;charset=utf-8;" });
        let link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = nomeArquivo;
        link.click();
    }
});

</script>

meowl
<script src="../../PUBLIC/JS/script-lista-vendedores.js"></script>
<script src="../../PUBLIC/JS/script-tabs.js"></script>
<script src="../../PUBLIC/JS/script-select.js"></script>
<script src="../../PUBLIC/JS/script-relatorio.js"></script>
<script src="../../PUBLIC/JS/script-tema.js"></script>



</body>
</html>