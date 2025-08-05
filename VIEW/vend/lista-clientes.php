<?php
    include "../../INCLUDE/Menu_vend.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Clientes</title>
    
    <link rel="stylesheet" href="../../PUBLIC/css/tabela.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/lista-clientes.css">
    </head>
<body>
    <!-- pop-up -->
    <div class="ym_popup-overlay" >
        <div class="ym_popup-content">
            <div class="ym_area-superior-popup">
                <h1 class="ym_titulo-popup">Cadastro de cliente</h1>
                <p class="ym_icon-fechar" onclick="fecharPopup()">✖</p>
            </div>
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
                                Lista de Clientes
                            </h1>
                            <p class="subtitle" id="customerCount">5 clientes encontrados</p>
                        </div>
                        
                        <div class="actions">
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
    
                                    <th>Nome</th>
                                    <th>Status</th>
                                    <th>Data de Cadastro</th>
                                    <th>Total de Compras</th>
                                    <th>Valor Gasto</th>
                                    <th class="actions-col"></th>
                                </tr>
                            </thead>
                            <tbody id="customerTableBody">
                                <!-- Customers will be inserted here by JavaScript -->
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

        <script src="../../PUBLIC/JS/clientes-adm.js"></script>   
        <!-- <h1 class="ym_titulo">Lista de Clientes</h1>
        <section class="ym_section">

            <div class="ym_area-barra-pesquisa">
                <div class="ls_pesquisa-barra">
                    <input type="text" placeholder="Pesquise por um Cliente">
                    <img src="../../PUBLIC/img/img_lupa.png" alt="lupa">
                </div>
            </div>

            <div class="ym_area-btn-superior">
                <a onclick="abrirPopup('../../VIEW/pop-up/cadastroPessoas-Fisica.php')" class="ym_btn-superior ym_btn-padrao">Cadastrar Cliente</a>
            </div>
            
            <div class="ym_area-table">

                <table class="ym_tabela">

                    <thead class="ym_thead">
                        <tr class="ym_tr">
                            <th class="ym_th" style="color:white;">Nome</th>
                            <th class="ym_th" style="color:white;">Data de cadastro</th>
                            <th class="ym_th" style="color:white;">Total de compras</th>
                            
                            
                    </thead>

                    <tbody class="ym_tbody">

                        <?php
                            echo'
                            <tr class="ym_tr">
                                <td class="ym_td">Paulo Rojas</td>
                                <td class="ym_td">16/08</td>
                                <td class="ym_td">2</td>
                            </tr>
                            ';
                        ?> 

                    </tbody>
                </table>

                </div> -->
                
    </main>
    
    <!-- <script src="../../PUBLIC/JS/script.js"></script>
    <script src="clientes-script.js"></script>
    <script src="../../PUBLIC/JS/script-pop-up.js"></script> -->

</body>
</html>