<?php
    include "../../INCLUDE/Menu_vend.php";
    require_once "../../DB/Database.php";
    include "../../CONTROLLER/VendaController.php";

    $controler_venda = new VendaController();

    // pega todas as vendas
    $vendas = $controler_venda->index();
    $total_vendas = count($vendas);

    // Paginação: 5 por página
    $limite = 5; 
    $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    if ($pagina_atual < 1) $pagina_atual = 1;

    $offset = ($pagina_atual - 1) * $limite;
    $total_paginas = ceil($total_vendas / $limite);

    // fatia os resultados
    $vendas_pagina = array_slice($vendas, $offset, $limite);

    // Cadastro de nova venda (se precisar usar POST)
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
        $controler_venda->criarVenda();
        unset($_POST);
    }
?>

    
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Vendas</title>
    <link rel="stylesheet" href="../../PUBLIC/css/lista-vendas-vend.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <main class="jp_main-content">
        <h1 class="ym_titulo">Vendas</h1>

        <div class="jv_container">
            <div class="jv_card">
                <!-- Header -->
                <div class="jv_card-header">
                    <div class="jv_header-content">
                        <form method="POST" action="#" class="jv_search-section">
                            <div class="jv_search-container">
                                <button type="submit" class="ym_area-icon-pesquisa" name="pesquisar">
                                    <i class="fas fa-search search-icon"></i>
                                </button>
                                <input type="text" name="pesquisa" placeholder="Pesquisar por comprador ou vendedor..." class="jv_search-input">
                            </div>
                        </form>
                            
                        <div class="jv_actions">
                            <button class="ym_btn-padrao" onclick="abrirPopup('../../VIEW/pop-up/cadastrar_venda.php','Cadastro de Vendas')">
                                <i class="fas fa-plus"></i>
                                <a>Cadastrar Venda</a>
                            </button>
                        </div>
                    </div>
                    
                    <p class="jv_subtitle">
                        <?= $total_vendas ?> vendas encontradas
                    </p>
                </div>

                <!-- Table -->
                <div class="jv_card-content">
                    <div class="jv_table-container">
                        <table class="jv_table">
                            <thead>
                                <tr class="jv_table-header">
                                    <th class="jv_name">Vendedor</th> 
                                    <th class="jv_date">Comprador</th>
                                    <th class="jv_total_comp">Data</th>
                                    <th class="jv_valor_gast">Valor</th>
                                    <th class="jv_actions-col"></th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($total_vendas > 0): ?>
                                    <?php foreach ($vendas as $venda): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($venda['nome_vendedor']) ?></td>
                                            <td><?= htmlspecialchars($venda['comprador']) ?></td>
                                            <td><?= date("d/m/Y", strtotime($venda['data_venda'])) ?></td>
                                            <td>R$ <?= number_format($venda['valor'], 2, ',', '.') ?></td>
                                            <td class="jv_table-action">
                                                <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <div class="jv_dropdown">
                                                    <button class="jv_dropdown-item">
                                                        <i class="fas fa-eye"></i> Visualizar
                                                    </button>
                                                    <div class="jv_dropdown-separator"></div>
                                                    <button class="jv_dropdown-item">
                                                        <i class="fas fa-edit"></i> Editar
                                                    </button>
                                                    <div class="jv_dropdown-separator"></div>
                                                    <button class="jv_dropdown-item jv_danger">
                                                        <i class="fas fa-trash"></i> Remover
                                                    </button>
                                                </div>
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

        <script src="../../PUBLIC/JS/script.js"></script>
        <script src="../../PUBLIC/JS/script-pop-up.js"></script>
    </main>
</body>
</html>
