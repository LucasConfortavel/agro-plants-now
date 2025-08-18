<?php
    include "../../INCLUDE/Menu_adm.php";
    require_once "../../DB/connect.php";
    
    $sql = 'SELECT * FROM usuario where tipo = "vendedor"';
    $result = mysqli_query($con, $sql);
    $total_vendedores= '2';


  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Vendedores</title>
    <link rel="stylesheet" href="../../PUBLIC/css/clientes-adm.css">
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
        <div class="jv_container">
                <div class="jv_card">
                    <!-- Header -->
                    <div class="jv_card-header">
                        <div class="jv_header-content">
                            <div class="jv_title-section">
                                <h1 class="jv_title">
                                    <div class="jv_title-bar"></div>
                                    Clientes
                                </h1>
                                <p class="jv_subtitle" id="customerCount">5 clientes encontrados</p>
                            </div>
                            
                            
                            <div class="jv_actions">
                                <button class="jv_btn btn-danger" id="removeSelected" style="display: none;">
                                    <i class="fa-solid fa-trash-can"></i>Remover (<span id="selectedCount">0</span>)
                                </button>                                
                                <button class="jv_btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    <a onclick="abrirPopup('../../VIEW/pop-up/cadastroPessoas.php','Cadastro de clientes')">Cadastrar Cliente</a>
                                </button>
                            </div>
                        </div>
                        
                        <div class="jv_search-section">
                            <div class="jv_search-container">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" placeholder="Pesquisar por nome ou email.." class="jv_search-input">
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
                                            <input type="checkbox" id="selectAll" class="jv_checkbox">
                                        </th>
                                        <th class="jv_name">Nome</th> 
                                        <th class="jv_status">Status</th>
                                        <th class="jv_date">Data de Cadastro</th>
                                        <th class="jv_total_comp">Total de Compras</t>
                                        <th class="jv_valor_gast">Valor Gasto</th>
                                        <th class="jv_actions-col"></th> 
                                    </tr>
                                </thead>
                                <tbody id="customerTableBody"> 
                                    <!-- Customers will be inserted here by JavaScript -->
                            
                                </tbody>
                            </table>
                        </div>

                        <!-- Empty State -->
                        <div id="emptyState" class="jv_empty-state" style="display: none;">
                            <i class="fas fa-search empty-icon"></i>
                            <h3>Nenhum cliente encontrado</h3>
                            <p>Tente ajustar os termos de pesquisa</p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Dropdown Menu Template -->
            <div id="dropdownMenu" class="jv_dropdown-menu" style="display: none;">
                <div class="jv_dropdown-item" data-action="view">
                    <i class="fas fa-eye"></i>
                    Visualizar Detalhes
                </div>
                <div class="jv_dropdown-item" data-action="edit">
                    <i class="fas fa-edit"></i>
                    Editar Cliente
                </div>
                <div class="jv_dropdown-separator"></div>
                <div class="jv_dropdown-item danger" data-action="delete">
                    <i class="fas fa-trash"></i>
                    Remover Cliente
                </div>
            </div>
              
            <div class="jv_page-navigation">
                    <div class="jv_page-number active">1</div>
                    <div class="jv_page-number">2</div>
                    <div class="jv_page-number">3</div>
                    <div class="jv_page-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>

            <script src="../../PUBLIC/JS/clientes-adm.js"></script>
                           




                        </tbody>
                    </table>
            
                </div>
            </section>
        </div> 
       

    </main>
    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/script-pop-up.js"></script>

</body>
</html>

