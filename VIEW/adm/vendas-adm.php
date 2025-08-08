<?php
    include "../../INCLUDE/Menu_adm.php";
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
        <div class="container">
                <div class="card">
                    <!-- Header -->
                    <div class="card-header">
                        <div class="header-content">
                            <div class="title-section">
                                <h1 class="title">
                                    <div class="title-bar"></div>
                                    Vendas
                                </h1>
                                <p class="subtitle" id="customerCount">5 clientes encontrados</p>
                            </div>
                            
                            
                            <div class="actions">
                                <button class="btn btn-danger" id="removeSelected" style="display: none;">
                                    <i class="fa-solid fa-trash-can"></i>Remover (<span id="selectedCount">0</span>)
                                </button>
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Cadastrar Cliente
                                </button>
                            </div>
                        </div>
                        
                        <div class="search-section">
                            <div class="search-container">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" id="searchInput" placeholder="Pesquisar por nome ou email..." class="search-input">
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="card-content">
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr class="table-header">
                                        <th class="checkbox-col">
                                            <input type="checkbox" id="selectAll" class="checkbox">
                                        </th>
                                        <th style="color:black;"id="banguela">Vendedor</th>
                                        <th style="color:black;"id="banguela">Comprador</th>
                                        <th style="color:black;">Data de cadastro</th>
                                        <th style="color:black;">Total</th>                                        
                                        <th class="actions-col"></th> 
                                </thead>
                                <tbody id="customerTableBody"> 
                                    <!-- Customers will be inserted here by JavaScript  -->
                                 </tbody> 
                            </table>
                        </div>

                        <!-- Empty State -->
                        <div id="emptyState" class="empty-state" style="display: none;">
                            <i class="fas fa-search empty-icon"></i>
                            <h3>Nenhum cliente encontrado</h3>
                            <p>Tente ajustar os termos de pesquisa</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dropdown Menu Template -->
            <div id="dropdownMenu" class="dropdown-menu" style="display: none;">
                <div class="dropdown-item" data-action="view">
                    <i class="fas fa-eye"></i>
                    Visualizar Detalhes
                </div>
                <div class="dropdown-item" data-action="edit">
                    <i class="fas fa-edit"></i>
                    Editar Cliente
                </div>
                <div class="dropdown-separator"></div>
                <div class="dropdown-item danger" data-action="delete">
                    <i class="fas fa-trash"></i>
                    Remover Cliente
                </div>
            </div>

            <script src="../../PUBLIC/JS/vendas-adm.js"></script>
                           



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
                                        