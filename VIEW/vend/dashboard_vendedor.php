<?php
require_once '../../INCLUDE/verificarLogin.php';
include "../../INCLUDE/Menu_vend.php";
include "../../INCLUDE/vlibras.php";
include "../../CONTROLLER/VendaController.php";
include "../../CONTROLLER/clienteController.php";

$user_id = $_SESSION['id'] ?? null;
$venda_control = new VendaController(); 
$cliente_control = new ClienteController(); 

$vendas_usuario = $venda_control->index($user_id);
$total_vendido = 0;
$numero_vendas = 0;


foreach ($vendas_usuario as $venda) {
    $total_vendido += $venda['total'];
    $numero_vendas += 1;
} 

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Vendedor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../PUBLIC/css/dashboard-vend.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
</head>
<body>
    <main class="jp_main-content">
        <h1 class="ym_titulo">Dashboard</h1> 

        <div class="jp_metrics-row">
            <div class="jp_metric-box jp_metric-green">
                <div class="jp_metric-header">
                    <div class="jp_metric-title">Total Vendido</div>
                    <div class="jp_metric-badge">22.0%</div>
                </div>
                <div class="jp_metric-value">R$<?= $total_vendido?></div>
            </div>
            <div class="jp_metric-box jp_metric-blue">
                <div class="jp_metric-header">
                    <div class="jp_metric-title">Número de Vendas</div>
                    <div class="jp_metric-badge">22.0%</div>
                </div>
                <div class="jp_metric-value"><?= $numero_vendas;?></div>
            </div>
            <div class="jp_metric-box jp_metric-orange">
                <div class="jp_metric-header">
                    <div class="jp_metric-title">Total de Comissões</div>
                    <div class="jp_metric-badge">22.0%</div>
                </div>
                <div class="jp_metric-value">R$<?php echo number_format(($total_vendido/10),2,',','.');?></div>
            </div>
        </div>

        <div class="jp_sales-container">
        <div class="jp_sales-header">Últimas vendas</div>
        <table class="jp_sales-list">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Quantidade de itens por página
                    $limite = 5;

                    // Página atual (pega da URL, se não tiver assume 1)
                    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

                    // Calcula o offset
                    $offset = ($pagina - 1) * $limite;

                    // Total de vendas
                    $total_vendas = count($vendas_usuario);

                    // Fatia apenas as vendas da página atual
                    $vendas_pagina = array_slice($vendas_usuario, $offset, $limite);

                    // Exibe vendas da página
                    foreach ($vendas_pagina as $venda) {
                        echo '
                        <tr>
                            <td>'.$cliente_control->mostrar($venda['id_cliente'])['nome'].'</td>
                            <td>'.date('d/m/Y', strtotime($venda['data_venda'])).'</td>
                            <td class="jp_sales-value">R$ '.$venda['total'].'</td>
                        </tr>';
                    }
                ?>  
            </tbody>
            </table>

        <!-- Paginação -->
        <div class="jp_pagination">
            <?php
                $total_paginas = ceil($total_vendas / $limite);

                // Botão Anterior (seta esquerda)
                if ($pagina > 1) {
                    echo '<a class="jp_arrow" href="?pagina='.($pagina - 1).'"><i class="fas fa-arrow-left"></i></a>';
                }

                // Números das páginas
                for ($i = 1; $i <= $total_paginas; $i++) {
                    $classe = ($i == $pagina) ? 'style="font-weight:bold;"' : '';
                    echo '<a '.$classe.' href="?pagina='.$i.'">'.$i.'</a>';
                }

                // Botão Próximo (seta direita)
                if ($pagina < $total_paginas) {
                    echo '<a class="jp_arrow" href="?pagina='.($pagina + 1).'"><i class="fas fa-arrow-right"></i></a>';
                }
            ?>
        </div>


        </div>


        <div class="jp_bottom-section">
            <!-- <div class="jp_clients-panel">
                <div class="jp_clients-header">Clientes fixados</div>
                <div class="jp_clients-list">
                    <div class="jp_client-item">
                        <div class="jp_client-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="jp_client-name">Rafael Germinari</div>
                    </div>
                    <div class="jp_client-item">
                        <div class="jp_client-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="jp_client-name">Rafael Germinari</div>
                    </div>
                    <div class="jp_client-item">
                        <div class="jp_client-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="jp_client-name">Rafael Germinari</div>
                    </div>
                </div>
            </div> -->

            <div class="jp_chart-panel">
                <div class="jp_chart-header">
                    <div class="jp_chart-title-area">
                        <div class="jp_chart-title">Vendas por Mês</div>
                        <div class="jp_chart-subtitle">-2% por mês</div>
                    </div>
                    <div class="jp_chart-filters">
                        
                        <div class="ym_area-select">
                            <div class="ym_select" onclick="mostrar_categorias()">
                                <p class="ym_categoria-select">Produtos </p>
                                <p class="ym_seta-categoria">></p>
                            </div>
                            
                            
                            <div class="ym_options">
                                <a class="ym_link-option" onclick="trocar_categoria()"></i> Serviços</a>
                            </div>
                            
                        </div>
                        
                        <div class="ym_area-select">
                            <div class="ym_select" onclick="mostrar_categorias(1)">
                                <p class="ym_categoria-select" >Último mês</p>
                                <p class="ym_seta-categoria">></p>
                            </div>
                            
                            
                            <div class="ym_options">
                                <a class="ym_link-option" onclick="trocar_categoria(1,1)" > Últimos anos</a>
                            </div>
                            
                        </div>

                    </div>
                </div>
                <div class="jp_chart-area">
                    <canvas id="vendorSalesChart" class="jp_chart"></canvas>
                </div>
            </div>
        </div>
    </main>
    <script src="../../PUBLIC/JS/script-dashboard-vend.js"></script>
    <script src="../../PUBLIC/JS/script-select.js"></script>
</body>
</html>
