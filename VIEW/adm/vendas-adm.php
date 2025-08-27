<?php
    include "../../INCLUDE/Menu_adm.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Vendas</title>
    <link rel="stylesheet" href="../../PUBLIC/css/vendas-adm.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body>


    <!-- pop-up -->
    <div class="ym_popup-overlay" >
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

                            <p class="jv_subtitle" id="jv_customerCount">10 vendas encontrados</p>
                            
                            
                            <div class="jv_actions">
                                <div>
                                    <button class="jv_btn jv_btn-danger" id="jv_removeSelected" style="display: none;">
                                        <i class="fa-solid fa-trash-can"></i>Remover (<span id="jv_selectedCount">0</span>)
                                    </button>
                                </div>
                                <div>
                                    <button class="jv_btn jv_btn-primary" onclick="abrirPopup('../../VIEW/pop-up/cadastroVenda-adm.php','Cadastro de vendas')" >
                                        <i class="fas fa-plus"></i>
                                        <p>Cadastrar Venda</p>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="jv_search-section">
                            <div class="jv_search-container">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" id="jv_searchInput" placeholder="Pesquisar por nome ou email..." class="jv_search-input">
                            </div>
                        </div>
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
                                        <th style="color:black;"id="jv_banguela">Vendedor</th>
                                        <th style="color:black;"id="jv_banguela">Comprador</th>
                                        <th style="color:black;">Data de cadastro</th>
                                        <th style="color:black;">Total</th>                                        
                                        <th class="jv_actions-col"></th> 
                                </thead>
                                <tbody id="jv_customerTableBody"> 

                                    <tr>
                                        <td>
                                            <input type="checkbox" class="jv_checkbox customer-checkbox" 
                                                data-customer-id='.$id.'>
                                        </td>
                                        <td>
                                            <div class="jv_customer-info">
                                                <div class="jv_avatar">
                                                    YM
                                                </div>
                                                <div class="jv_customer-details">
                                                    <h4>Vendedor</h4>
                                                    <p>vendedor@gmail.com</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            Comprador
                                        </td>

                                        <td>12/05/25</td>
                                    
                                        <td>
                                            <span class="jv_amount">R$ 100,00</span>
                                        </td>
                                        <td>
                                            <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div id="jv_dropdownMenu" class="jv_dropdown">
                                                <button class="jv_dropdown-item">
                                                    <i class="fas fa-eye"></i>
                                                    Visualizar  
                                                </button>
                                                <div class="jv_dropdown-separator"></div>
                                                <button class="jv_dropdown-item">
                                                    <i class="fas fa-edit"></i>
                                                    Editar
                                                </button>
                                                <div class="jv_dropdown-separator"></div>
                                                <button class="jv_dropdown-item danger">
                                                    <i class="fas fa-trash"></i>
                                                    Remover
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                 </tbody> 
                            </table>
                        </div>

                        <!-- Paginação
                        <div class="jv_page-navigation">
                            <?php if($pagina_atual > 1): ?>
                                <a href="?pagina=<?php //echo $pagina_atual - 1; ?>" class="jv_page-arrow">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            <?php endif; ?>

                            <?php 
                                // $inicio = max(1, $pagina_atual - 2);
                                // $fim = min($total_paginas, $pagina_atual + 2);
                                
                                // for ($i = $inicio; $i <= $fim; $i++):
                             ?>
                                <a href="?pagina=<?php echo $i; ?>" class="jv_page-number <?php echo $i == $pagina_atual ? 'active' : ''; ?>">
                                    <?php //echo $i; ?>
                                </a>
                            <?php //endfor; ?>

                            <?php //if($pagina_atual < $total_paginas): ?>
                                <a href="?pagina=<?php //echo $pagina_atual + 1; ?>" class="jv_page-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            <?php //endif; ?>
                        </div> -->

                        <!-- Empty State -->
                        <div id="emptyState" class="jv_empty-state" style="display: none;">
                            <i class="fas fa-search empty-icon"></i>
                            <h3>Nenhuma venda encontrada</h3>
                            <p>Tente ajustar os termos de pesquisa</p>
                        </div>
                    </div>
                </div>
            </div>




    </main>
    <script src="../../PUBLIC/JS/vendas-adm.js"></script>
    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/script-pop-up.js"></script>

</body>
</html>