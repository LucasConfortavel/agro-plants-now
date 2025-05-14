<?php
    include "../../INCLUDE/Menu_adm.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Vendas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../PUBLIC/css/vcl-dashboard-style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
</head>
<body>
    <!-- <div class="jp_sidebar-placeholder"></div> -->

    <main class="jp_main-content">
        <div class="jp_header">
            <div class="jp_header-icons">
                <div class="jp_notification-icon">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="jp_user-icon">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>

        <div class="jp_cards-container">
            <div class="jp_card">
                <div class="jp_card-header">
                    <div class="jp_card-title">Total Vendido</div>
                    <div class="jp_card-indicator">22.0%</div>
                </div>
                <div class="jp_card-value">R$17500</div>
            </div>
            <div class="jp_card">
                <div class="jp_card-header">
                    <div class="jp_card-title">Produtos Vendidos</div>
                    <div class="jp_card-indicator">22.0%</div>
                </div>
                <div class="jp_card-value">3,342</div>
            </div>
            <div class="jp_card">
                <div class="jp_card-header">
                    <div class="jp_card-title">Vendedores Ativos</div>
                    <div class="jp_card-indicator">22.0%</div>
                </div>
                <div class="jp_card-value">3,342</div>
            </div>
            <div class="jp_card">
                <div class="jp_card-header">
                    <div class="jp_card-title">Cliente Cadastrado</div>
                    <div class="jp_card-indicator">22.0%</div>
                </div>
                <div class="jp_card-value">3,342</div>
            </div>
        </div>

        <div class="jp_sales-section">
            <div class="jp_sales-title">Últimas vendas</div>
            <table class="jp_sales-table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Vendedor</th>
                        <th>Cliente</th>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Comissão</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#XXXX</td>
                        <td>Rafael</td>
                        <td>Calebe</td>
                        <td>02/08</td>
                        <td class="jp_value-column">R$7500</td>
                        <td class="jp_commission-column">R$750 (10%)</td>
                    </tr>
                    <tr>
                        <td>#XXXX</td>
                        <td>Rafael</td>
                        <td>Celebe</td>
                        <td>02/08</td>
                        <td class="jp_value-column">R$7500</td>
                        <td class="jp_commission-column">R$750 (10%)</td>
                    </tr>
                    <tr>
                        <td>#XXXX</td>
                        <td>Rafael</td>
                        <td>Calebe</td>
                        <td>02/08</td>
                        <td class="jp_value-column">R$7500</td>
                        <td class="jp_commission-column">R$750 (10%)</td>
                    </tr>
                    <tr>
                        <td>#XXXX</td>
                        <td>Rafael</td>
                        <td>Calebe</td>
                        <td>02/08</td>
                        <td class="jp_value-column">R$7500</td>
                        <td class="jp_commission-column">R$750 (10%)</td>
                    </tr>
                </tbody>
            </table>
            <div class="jp_pagination">
                <div class="jp_pagination-item active">1</div>
                <div class="jp_pagination-item">2</div>
                <div class="jp_pagination-item">3</div>
                <div class="jp_pagination-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        <div class="jp_chart-section">
            <div class="jp_chart-header">
                <div class="jp_chart-title-container">
                    <div class="jp_chart-title">Vendas por Mês</div>
                    <div class="jp_chart-indicator">-2% por mês</div>
                </div>
                <div class="jp_chart-filters">
                    <div class="jp_filter-select">
                        Produto <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="jp_filter-select">
                        Último mês <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
            <div class="jp_chart-container">
                <div class="jp_chart-y-axis">
                    <div class="jp_chart-y-label">600</div>
                    <div class="jp_chart-y-label">500</div>
                    <div class="jp_chart-y-label">400</div>
                    <div class="jp_chart-y-label">300</div>
                    <div class="jp_chart-y-label">200</div>
                    <div class="jp_chart-y-label">0</div>
                </div>
                <canvas id="salesChart" class="jp_chart-canvas"></canvas>
            </div>
            <div class="jp_chart-x-axis">
                <div class="jp_chart-x-label">0</div>
                <div class="jp_chart-x-label">5</div>
                <div class="jp_chart-x-label">10</div>
                <div class="jp_chart-x-label">15</div>
                <div class="jp_chart-x-label">20</div>
                <div class="jp_chart-x-label">25</div>
                <div class="jp_chart-x-label">30</div>
            </div>
        </div>
    </main>

    <script src="/projeto_agro_plants_now1/PUBLIC/JS/script-dashboard-adm-vcl.js"></script>
</body>
</html>
