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

 
                            
                <div class="jv_card">
                    <!-- Header -->
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
                                <div class="po-controls">
                                    <div class="po-controls-right">
                                        <button class="po-btn">
                                            <span><i class="fa-regular fa-file"></i></span>
                                            Exportar CSV
                                        </button>
                                    </div>
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

                        <p class="jv_subtitle" id="jv_customerCount">
                            <?= $total_vendedores ?> Registro de Vendas encontrados
                        </p>
                    </div>

                    <!-- Table -->
                    <div class="jv_card-content">
                        <div class="jv_table-container">
                            <table class="jv_table">
                                <thead>
                                    <tr class="jv_table-header">
                                        <th class="jv_checkbox-col">
                                            <input type="checkbox" id="jv_selectAll" class="jv_checkbox">
                                        </th>
                                        <th class="jv_name">Vendedor</th>
                                        <th class="jv_banguela">Produt/Serviço</th>
                                        <th class="jv_data">Valor da Venda</th>
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
                                                <td class="jv_table-action">
                                                    <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </button>
                                                    <form class="jv_dropdown" method="GET" action="">
                                                        <button type="submit" name="visualizar" value="<?= htmlspecialchars($vend['id']) ?>" class="jv_dropdown-item">
                                                            <i class="fas fa-eye"></i> Visualizar
                                                        </button>
                                                        <div class="jv_dropdown-separator"></div>
                                                        <button type="button" onclick="abrirPopup('../../VIEW/pop-up/pop-up_remover.php','Cadastro de Vendedores')" class="jv_dropdown-item jv_danger">
                                                            <i class="fas fa-trash"></i> Remover
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
<!-- 
                            <div class="ym_area-select">
                                <div class="ym_select" onclick="mostrar_categorias()">
                                    <p class="ym_categoria-select">Último mês</p>
                                    <p class="ym_seta-categoria">></p>
                                </div> 
                                
                                
                                <div class="ym_options">
                                    <a class="ym_link-option" onclick="trocar_categoria()"> Último trimestre</a>
                                    <a class="ym_link-option" onclick="trocar_categoria(0,1)"> Último ano</a>
                                </div>
                                
                            </div> -->


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
    <script src="../../PUBLIC/JS/.js"></script>
    <script src="../../PUBLIC/JS/script-select.js"></script>
</body>
</html>
