<?php
    include "../../INCLUDE/Menu_adm.php";
    require_once "../../DB/connect.php";
    
    // Configuração da paginação
    $registros_por_pagina = 4; // Número de itens por página
    $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $offset = ($pagina_atual - 1) * $registros_por_pagina;
    
    // Consulta com paginação
    $sql = "SELECT * FROM cliente LIMIT $offset, $registros_por_pagina";
    $result = mysqli_query($con, $sql);

    
    // Consulta para contar o total de registros
    $sql_count = "SELECT COUNT(*) as total FROM cliente";
    $result_count = mysqli_query($con, $sql_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $total_clientes = $row_count['total'];
    $total_paginas = ceil($total_clientes / $registros_por_pagina);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Clientes</title>
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
                                <p class="jv_subtitle" id="jv_customerCount"><?php echo $total_clientes?> clientes encontrados</p>
                            </div>
                            
                            
                            <div class="jv_actions">
                                <button class="jv_btn jv_btn-danger" id="jv_removeSelected" style="display: none;">
                                    <i class="fa-solid fa-trash-can"></i>Remover (<span id="jv_selectedCount">0</span>)
                                </button>                                
<<<<<<< Updated upstream
                                <button class="jv_btn btn-primary" onclick="abrirPopup('../../VIEW/pop-up/cadastroPessoas.php','Cadastro de clientes')">
=======
                                <button class="jv_btn jv_btn-primary">
>>>>>>> Stashed changes
                                    <i class="fas fa-plus"></i>
                                    <p>Cadastrar Cliente</p>
                                </button>
                            </div>
                        </div>
                        
                        <div class="jv_search-section">
                            <div class="jv_search-container">
                                <i class="fas fa-search jv_search-icon"></i>
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
                                            <input type="checkbox" id="jv_selectAll" class="jv_checkbox">
                                        </th>
                                        <th class="jv_name">Nome</th> 
                                        <th class="jv_date">Data de Cadastro</th>
                                        <th class="jv_total_comp">Total de Compras</t>
                                        <th class="jv_valor_gast">Valor Gasto</th>
                                        <th class="jv_actions-col"></th> 
                                    </tr>
                                </thead>
                                <tbody id="jv_customerTableBody"> 
                                <?php 
                                if($result && mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $id= $row['id'];
                                        $nome= $row['nome'];
                                        $email= $row['email'];
                                        $telefone= $row['telefone'];
                                        $data = $row['data_nasc'];                                 
                                        

                                        echo'
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="jv_checkbox customer-checkbox" data-customer-id='.$id.'>
                                                </td>
                                                <td>
                                                    <div class="jv_customer-info">
                                                        <div class="jv_avatar">
                                                            YM
                                                        </div>
                                                        <div class="jv_customer-details">
                                                            <h4> '.$nome.' </h4>
                                                            <p> '.$email.' </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> '.$data.' </td>
                                                <td>
                                                    <div class="jv_purchase-info">
                                                        <span class="jv_purchase-count">10</span>
                                                        <span class="jv_purchase-label">compras</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="jv_amount">1.200,00</span>
                                                </td>
                                                <td>
                                                    <button class="jv_menu-btn" onclick="showDropdown(event, '.$id.')">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        ';}
                                    } else {

                                        echo '<tr><td colspan="6" style="text-align: center;">Nenhum cliente encontrado</td></tr>';


                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Paginação -->
                        <div class="jv_page-navigation">
                            <?php if($pagina_atual > 1): ?>
                                <a href="?pagina=<?php echo $pagina_atual - 1; ?>" class="jv_page-arrow">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            <?php endif; ?>

                            <?php 
                            $inicio = max(1, $pagina_atual - 2);
                            $fim = min($total_paginas, $pagina_atual + 2);
                            
                            for ($i = $inicio; $i <= $fim; $i++): ?>
                                <a href="?pagina=<?php echo $i; ?>" class="jv_page-number <?php echo $i == $pagina_atual ? 'active' : ''; ?>">
                                    <?php echo $i; ?>
                                </a>
                            <?php endfor; ?>

                            <?php if($pagina_atual < $total_paginas): ?>
                                <a href="?pagina=<?php echo $pagina_atual + 1; ?>" class="jv_page-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            <?php endif; ?>
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
            <div id="jv_dropdownMenu" class="jv_dropdown-menu" style="display: none;">
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
        </div> 
        
        
    </main>
    <script src="../../PUBLIC/JS/script-clientes-adm.js"></script>
    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/script-pop-up.js"></script>

</body>
</html>