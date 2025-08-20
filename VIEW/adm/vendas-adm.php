<?php
    include "../../INCLUDE/Menu_adm.php";
    require_once "../../DB/connect.php";

    // Configuração da paginação
    $registros_por_pagina = 4; // Número de itens por página
    $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $offset = ($pagina_atual - 1) * $registros_por_pagina;
    
    // Consulta com paginação
    $sql = "SELECT * FROM venda LIMIT $offset, $registros_por_pagina";
    $result = mysqli_query($con, $sql);
    
    // Consulta para contar o total de registros
    $sql_count = "SELECT COUNT(*) as total FROM venda";
    $result_count = mysqli_query($con, $sql_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $total_vendas = $row_count['total'];
    $total_paginas = ceil($total_vendas / $registros_por_pagina);
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
                                <p class="subtitle" id="customerCount"><?php echo $total_vendas;?> vendas encontrados</p>
                            </div>
                            
                            
                            <div class="actions">
                                <button class="btn btn-danger" id="removeSelected" style="display: none;">
                                    <i class="fa-solid fa-trash-can"></i>Remover (<span id="selectedCount">0</span>)
                                </button>
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    <a onclick="abrirPopup('../../VIEW/pop-up/cadastroVenda-adm.php','Cadastro de vendas')">Cadastrar Venda</a>
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
                                    <?php 
                                    
                                    if($result){
                                        while($row = mysqli_fetch_assoc($result)){
                                            $id = $row['id'];
                                            $vendedor_id = $row['id_vendedor'];
                                            
                                            $sql_vendedor = mysqli_query($con,'SELECT * FROM usuario WHERE tipo = "vendedor" and id = '.$vendedor_id.'');
                                            
                                            $dado_vendedor = mysqli_fetch_assoc($sql_vendedor);

                                            $vendedor_nome = $dado_vendedor['nome'];

                                            $vendedor_email = $dado_vendedor['email'];

                                            $total = $row['total'];
                                            $data = $row['data_venda'];   

                                            echo'
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="checkbox customer-checkbox" 
                                                            data-customer-id='.$id.'>
                                                    </td>
                                                    <td>
                                                        <div class="customer-info">
                                                            <div class="avatar">
                                                                YM
                                                            </div>
                                                            <div class="customer-details">
                                                                <h4>'.$vendedor_nome.'</h4>
                                                                <p>'.$vendedor_email.'</p>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        Comprador
                                                    </td>

                                                    <td>'.$data.'</td>
                                                
                                                    <td>
                                                        <span class="amount">'.$total.'</span>
                                                    </td>
                                                    <td>
                                                        <button class="menu-btn" onclick="showDropdown(event, '.$id.')">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            ';}} else {
                                                echo '<tr><td colspan="5" style="text-align: center; height: 49.7vh;">Nenhum vendedor encontrado</td></tr>';
                                            }
                                    ?>
                                 </tbody> 
                            </table>
                        </div>

                        <!-- Paginação -->
                        <div class="jp_page-navigation">
                            <?php if($pagina_atual > 1): ?>
                                <a href="?pagina=<?php echo $pagina_atual - 1; ?>" class="jp_page-arrow">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            <?php endif; ?>

                            <?php 
                            $inicio = max(1, $pagina_atual - 2);
                            $fim = min($total_paginas, $pagina_atual + 2);
                            
                            for ($i = $inicio; $i <= $fim; $i++): ?>
                                <a href="?pagina=<?php echo $i; ?>" class="jp_page-number <?php echo $i == $pagina_atual ? 'active' : ''; ?>">
                                    <?php echo $i; ?>
                                </a>
                            <?php endfor; ?>

                            <?php if($pagina_atual < $total_paginas): ?>
                                <a href="?pagina=<?php echo $pagina_atual + 1; ?>" class="jp_page-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            <?php endif; ?>
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
    <script src="../../PUBLIC/JS/vendas-adm.js"></script>
    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/script-pop-up.js"></script>

</body>
</html>