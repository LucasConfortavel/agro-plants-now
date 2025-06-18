<?php
    include "../../INCLUDE/Menu_vend.php";
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
</head>
<body>
    <main class="jp_main-content">
        <div class="jp_content-wrapper">
            <div class="jp_top-bar">
                <div class="jp_top-bar-icons">
                    <div class="jp_notification-bell">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="jp_profile-icon">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>

            <!-- <div class="jp_action-buttons">
                <button class="jp_action-button jp_catalog-button" onclick= "window.location.href='produtos-tudo.php'"> 
                    <i class="fas fa-book"></i>
                    Catálogo
                </button>
                <button class="jp_action-button jp_sales-button" onclick= "window.location.href='lista-vendas.php'">
                    <i class="fas fa-chart-line"></i>
                    Vendas
                </button>
            </div> -->

            <div class="jp_metrics-row">
                <div class="jp_metric-box jp_metric-green">
                    <div class="jp_metric-header">
                        <div class="jp_metric-title">Total Vendido</div>
                        <div class="jp_metric-badge">22.0%</div>
                    </div>
                    <div class="jp_metric-value">R$17500</div>
                </div>
                <div class="jp_metric-box jp_metric-blue">
                    <div class="jp_metric-header">
                        <div class="jp_metric-title">Número de Vendas</div>
                        <div class="jp_metric-badge">22.0%</div>
                    </div>
                    <div class="jp_metric-value">3,342</div>
                </div>
                <div class="jp_metric-box jp_metric-orange">
                    <div class="jp_metric-header">
                        <div class="jp_metric-title">Total de Comissões</div>
                        <div class="jp_metric-badge">22.0%</div>
                    </div>
                    <div class="jp_metric-value">R$ 31,313</div>
                </div>
            </div>

            <div class="jp_sales-container">
                <div class="jp_sales-header">Últimas vendas</div>
                <table class="jp_sales-list">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Cliente</th>
                            <th>Data</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#XXXX</td>
                            <td>Luiz</td>
                            <td>02/08</td>
                            <td class="jp_sales-value">R$7500</td>
                        </tr>
                        <tr>
                            <td>#XXXX</td>
                            <td>Luiz</td>
                            <td>02/08</td>
                            <td class="jp_sales-value">R$7500</td>
                        </tr>
                        <tr>
                            <td>#XXXX</td>
                            <td>Luiz</td>
                            <td>02/08</td>
                            <td class="jp_sales-value">R$7500</td>
                        </tr>
                        <tr>
                            <td>#XXXX</td>
                            <td>Luiz</td>
                            <td>02/08</td>
                            <td class="jp_sales-value">R$7500</td>
                        </tr>
                    </tbody>
                </table>
                <div class="jp_page-navigation">
                    <div class="jp_page-number active">1</div>
                    <div class="jp_page-number">2</div>
                    <div class="jp_page-number">3</div>
                    <div class="jp_page-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>

            <div class="jp_bottom-section">
                <div class="jp_clients-panel">
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
                </div>

                <div class="jp_chart-panel">
                    <div class="jp_chart-header">
                        <div class="jp_chart-title-area">
                            <div class="jp_chart-title">Vendas por Mês</div>
                            <div class="jp_chart-subtitle">-2% por mês</div>
                        </div>
                        <div class="jp_chart-filters">
                            <div class="jp_chart-filter">
                                <span>Produto</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="jp_chart-filter">
                                <span>Último mês</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="jp_chart-area">
                        <canvas id="vendorSalesChart" class="jp_chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="/projeto_agro_plants_now1/PUBLIC/JS/script-dashboard-vend.js"></script>
</body>
</html>
