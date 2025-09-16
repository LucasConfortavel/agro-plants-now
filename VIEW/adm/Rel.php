<?php
include "../../INCLUDE/Menu_adm.php";
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
    <link rel="stylesheet" href="../../PUBLIC/css/Rel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>

    <main class="jp_main-content">
        <div class="po-container">
            <h1 class="ym_titulo" >Relatório de Vendas</h1>

            <nav class="tabs-nav">
                    <button class="po-tab-btn po-active" data-tab="sales">Vendas</button>
                    <button class="po-tab-btn" data-tab="commissions">Comissões</button>
                </div>
            </nav>

            <div class="po-card">


                <div class="po-card-content">
                    <div class="po-controls">
                        <h3 id="po-table-title">Registro de Vendas</h3>
                        <div class="po-controls-right">
                            <button class="po-btn">
                                <span><i class="fa-regular fa-file"></i></span>
                                Exportar CSV
                            </button>

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

                    <div class="po-table-container">
                        <table class="po-table" id="po-data-table">
                            <thead id="po-table-head">

                            </thead>
                            <tbody id="po-table-body">
                            </tbody>
                        </table>
                    </div>

                    <div class="po-pagination">
                        <button class="po-page-btn po-active" data-page="1">1</button>
                        <button class="po-page-btn" data-page="2">2</button>
                        <button class="po-page-btn" data-page="3">3</button>
                        <button class="po-page-btn" id="po-next-btn">→</button>
                    </div>
                </div>
            </div>

            <div class="po-charts-grid">
                <div class="po-card">
                    <div class="po-card-content">
                        <div class="po-chart-header">
                            <h3 id="po-chart-title">Gráfico de vendas</h3>
                            <div class="po-controls-right">
                                <div class="ym_area-select">
                                    <div class="ym_select" onclick="mostrar_categorias(1)">
                                        <p class="ym_categoria-select">Último mês</p>
                                        <p class="ym_seta-categoria">></p>
                                    </div>
                                    
                                    
                                    <div class="ym_options">
                                        <a class="ym_link-option" onclick="trocar_categoria(1,2)"> Último trimestre</a>
                                        <a class="ym_link-option" onclick="trocar_categoria(1,3)"> Último ano</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="po-chart-container">
                            <canvas id="po-main-chart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="po-card">
                    <div class="po-stats-content">
                        <div class="po-progress-circle">
                            <canvas id="po-progress-chart" width="128" height="128"></canvas>
                            <div class="po-progress-text">60%</div>
                        </div>
                        <p style="font-size: 0.875rem; color: #6b7280; font-weight: 500; margin-bottom: 1rem;">Taxa de aumento</p>
                        
                        <div class="po-mini-chart" id="po-mini-chart">
                        </div>
                        
                        <p style="font-size: 0.875rem; color: #6b7280; font-weight: 500;">Agosto</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../../PUBLIC/JS/Rel.js"></script>
    <script src="../../PUBLIC/JS/script-select.js"></script>
</body>
</html>
