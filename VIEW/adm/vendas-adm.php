<?php
    include "../../INCLUDE/Menu_adm.php";
    include "../../CONTROLLER/VendaController.php";
    include "../../CONTROLLER/UsuarioController.php";
    include "../../CONTROLLER/ClienteController.php";

    $venda_control = new VendaController(); 
    $vendas = $venda_control->index();
    $usuario_control = new UsuarioController();
    $cliente_control = new clienteController();
    $total = sizeof($vendas);
?>
    
<!DOCTYPE html>
<html lang="pt-br">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gerenciamento de Vendedores</title>
        <link rel="stylesheet" href="../../PUBLIC/css/vendas-adm.css">
        <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
        <link rel="stylesheet" href="../../PUBLIC/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
        <!-- pop-up -->
        <div class="ym_popup-overlay">
            <div class="ym_popup-content">
                <div class="ym_area-superior-popup"></div>
                <div class="ym_conteudo-popup"></div>
            </div>
        </div>

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
                            </div>
                        </div>
                        
                        <p class="jv_subtitle" id="jv_customerCount">
                                <?= $total ?> vendas encontrados
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
                                        <th class="jv_name">Nome</th> 
                                        <th class="jv_date">Cliente</th>
                                        <th class="jv_valor_gast">Valor Gasto</th>
                                        <th class="jv_actions-col"></th> 
                                    </tr>
                                </thead>
                                <tbody id="jv_customerTableBody">
                                    <?php if ($total > 0): ?>
                                        <?php foreach ($vendas as $venda):     $vendedor = $usuario_control->mostrar($venda["id_vendedor"]);  $cliente = $cliente_control->mostrar($venda["id_cliente"])?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="jv_checkbox customer-checkbox" data-customer-id="<?= $venda['id'] ?>">
                                                </td>
                                                <td>
                                                    <?= $vendedor['nome'] ?> 
                                                </td>
                                                <td><?= $cliente['nome'] ?></td>
                                                <td><?='R$' .  htmlspecialchars($venda['total']) ?></td>
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
                                        <tr><td colspan="5" style="text-align: center; height: 49.7vh;">Nenhum venda encontrada</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

                        <!-- Paginação -->
                        <div class="jv_page-navigation">
                            <?php //if($pagina_atual > 1): ?>
                                <a href="?pagina=<?php echo $pagina_atual - 1; ?>" class="jv_page-arrow">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            <?php //endif; ?>

                            <?php
                            // $inicio = max(1, $pagina_atual - 2);
                            // $fim = min($total_paginas, $pagina_atual + 2);
                            
                            // for ($i = $inicio; $i <= $fim; $i++): ?>
                                <a href="?pagina=<?php// echo $i; ?>" class="jv_page-number <?php //echo $i == $pagina_atual ? 'active' : ''; ?>">
                                    1<?php// echo $i; ?>
                                </a>
                            <?php// endfor; ?>
                            <a href="?pagina=<?php// echo $i; ?>" class="jv_page-number <?php //echo $i == $pagina_atual ? 'active' : ''; ?>">
                                    2<?php// echo $i; ?>
                                </a>
                            <?php// endfor; ?>
                            <a href="?pagina=<?php// echo $i; ?>" class="jv_page-number <?php //echo $i == $pagina_atual ? 'active' : ''; ?>">
                                    3<?php// echo $i; ?>
                                </a>
                            <?php// endfor; ?>

                            <?php //if($pagina_atual < $total_paginas): ?>
                                <a href="?pagina=<?php// echo $pagina_atual + 1; ?>" class="jv_page-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            <?php //endif; ?>
                        </div>
                        


        
                    <script src="../../PUBLIC/JS/script-clientes-adm.js"></script>
                    <script src="../../PUBLIC/JS/script.js"></script>
                    <script src="../../PUBLIC/JS/script-pop-up.js"></script>



        </main>



        



</body>
</html>