<?php
    include "../../INCLUDE/Menu_vend.php";
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Vendedores</title>
    <link rel="stylesheet" href="../../PUBLIC/css/lista-clientes.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
 
    <main class="jp_main-content">
        <div class="container">
            <div class="card">
                <!-- Header -->
                <div class="card-header">
                    <div class="header-content">
                        <div class="title-section">
                            <h1 class="title">
                                <div class="title-bar"></div>
                                Lista de Clientes
                            </h1>
                            <p class="subtitle" id="customerCount">0 clientes encontrados</p>
                        </div>
                        <div class="actions">
                            <button class="btn btn-primary" onclick="abrirPopup('../../VIEW/pop-up/cadastroVenda-adm.php','Cadastro de clientes')">
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
                                    <th style="text-align:left; color:black;">Nome</th>
                                    <th style="text-align:left; color:black;">Status</th>
                                    <th style="text-align:center; color:black;">Data de cadastro</th>
                                    <th style="text-align:center; color:black;">Total de Compras</th>                                        
                                    <th style="text-align:right; color:black;">Valor Gasto</th>    
                                    <th class="actions-col"></th>                                    
                                </tr>
                            </thead>
                            <tbody id="customerTableBody"></tbody>
                        </table>
                    </div>

                    <!-- Empty State -->
                    <div id="emptyState" class="empty-state" style="display: none;">
                        <i class="fas fa-search empty-icon"></i>
                        <h3>Nenhuma venda encontrada</h3>
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
                Editar Venda
            </div>
            <div class="dropdown-separator"></div>
            <div class="dropdown-item danger" data-action="delete">
                <i class="fas fa-trash"></i>
                Remover Venda
            </div>
        </div>
        
    </main>
    
    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/script-pop-up.js"></script>
    <script src="../../PUBLIC/JS/lista_clientes.js"></script>

</body>
</html>
