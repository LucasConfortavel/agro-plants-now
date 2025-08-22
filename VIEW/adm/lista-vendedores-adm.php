<?php
    include "../../INCLUDE/Menu_adm.php";
    require_once "../../DB/connect.php";
 
    $sql_show = "SELECT * FROM usuario WHERE tipo = 'vendedor'";
    $result_show = mysqli_query($con,$sql_show);
    $total_vendedores = mysqli_num_rows($result_show);
 
    if(isset($_POST['adicionar'])){
        $nome = $_POST['nome'];
        $data_nasc = $_POST['data_nasc'];
        $email = $_POST['email'];
        $cpf_cnpj = $_POST['cpf_cnpj'];  
        $senha = $_POST['senha'];
        $tipo = "vendedor";
 
        $sql_create = "INSERT INTO usuario (nome,data_nasc,email,CPF,senha,tipo) VALUES ('$nome','$data_nasc','$email','$cpf_cnpj','$senha','$tipo')";
       
        $result_create = mysqli_query($con,$sql_create);
 
 
        if(!$result_create){
            echo'<script>alert("Não foi possível cadastrar")</script>';
        }else{
            echo'<script>alert("Cliente Cadastrado")</script>';
        }}
    
    $registros_por_pagina = 4;
    $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $offset = ($pagina_atual - 1) * $registros_por_pagina;
    
    if(isset($_POST['pesquisar'])){
        $pesquisa = $_POST['pesquisa'];
        $sql = "SELECT * FROM usuario WHERE tipo = 'vendedor' and (email LIKE CONCAT('%', '".$pesquisa."', '%') OR nome LIKE CONCAT('%', '".$pesquisa."', '%') ) LIMIT $offset, $registros_por_pagina";
    }else{
        $sql = "SELECT * FROM usuario WHERE tipo = 'vendedor' LIMIT $offset, $registros_por_pagina";
    }

    $result = mysqli_query($con, $sql);
    
    $sql_count = "SELECT COUNT(*) as total FROM usuario WHERE tipo = 'vendedor'";
    $result_count = mysqli_query($con, $sql_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $total_vendedores = $row_count['total'];
    $total_paginas = ceil($total_vendedores / $registros_por_pagina);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Vendedores</title>
    <link rel="stylesheet" href="../../PUBLIC/css/lista-vendedores-adm.css">
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
        <div class="jv_container">
            <div class="jv_card">
                <!-- Header -->
                <div class="jv_card-header">
                    <div class="jv_header-content">
                        <div class="jv_title-section">
                            <h1 class="jv_title">
                                <div class="jv_title-bar"></div>
                                Vendedores
                            </h1>
                            <p class="jv_subtitle" id="jv_customerCount"><?php echo $total_vendedores; ?> vendedores encontrados</p>
                        </div>
                        
                        <div class="jv_actions">
                            <div>
                                <button class="jv_btn jv_btn-danger" id="jv_removeSelected" style="display: none;">
                                    <i class="fa-solid fa-trash-can"></i>Remover (<span id="jv_selectedCount">0</span>)
                                </button>
                            </div>
                            <div>
                                <button class="jv_btn jv_btn-primary" onclick="abrirPopup('../../VIEW/pop-up/cadastrar_vendedor.php','Cadastro de Vendedores')" >

                                    <i class="fas fa-plus"></i>
                                    <a>Cadastrar Vendedor</a>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <form method="POST" action="#" class="jv_search-section">
                        <div class="jv_search-container">
                            <button  type="submit" class="ym_area-icon-pesquisa" name="pesquisar">
                                <i class="fas fa-search search-icon"></i>
                            </button>
                            
                            <input type="text" name="pesquisa" id="jv_searchInput" placeholder="Pesquisar por nome ou email" class="jv_search-input">
                        </div>
                    </form>
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
                                    <th class="jv_banguela">Telefone</th>
                                    <th class="jv_data">Data de Cadastro</th>
                                    <th class="jv_actions-col"></th> 
                                </tr>
                            </thead>
                            <tbody id="jv_customerTableBody"> 
                                <?php
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)){
                                        $id = $row['id'];
                                        $nome = $row['CPF'];
                                        $email = $row['email'];
                                        $telefone = $row['telefone'];
                                        $dataCadastro = $row['data_nasc'];

                                        echo '<tr>

                                            <td>
                                                <input type="checkbox" class="jv_checkbox customer-checkbox" data-customer-id='.$id.'>
                                            </td>
                                            <td>
                                                <div class="jv_customer-info">
                                                    <div class="jv_avatar">
                                                    PR
                                                    </div>
                                                    <div class="jv_customer-details">
                                                        <h4>'.$nome.'</h4>
                                                        <p>'.$email.'</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class = "jv_bangas">'.$telefone.'</td>
                                            <td>'.$dataCadastro.'</td>
                                            <td>
                                                <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <div id="jv_dropdownMenu" class="jv_dropdown" style="display:none;">
                                                    <button class="jv_dropdown-item">
                                                        <i class="fas fa-eye"></i>
                                                        Visualizar Detalhes
                                                    </button>
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
                                        </tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="5" style="text-align: center; height: 49.7vh;">Nenhum vendedor encontrado</td></tr>';
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
                    <div id="jv_emptyState" class="jv_empty-state" style="display: none;">
                        <i class="fas fa-search empty-icon"></i>
                        <h3>Nenhum Vendedor encontrado</h3>
                        <p>Tente ajustar os termos de pesquisa</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dropdown Menu Template -->
        <!-- <div id="jv_dropdownMenu" class="jv_dropdown-menu" style="display: none;">
            <div class="jv_dropdown-item" data-action="view">
                <i class="fas fa-eye"></i>
                Visualizar Detalhes
            </div>
            <div class="jv_dropdown-item" data-action="edit">
                <i class="fas fa-edit"></i>
                Editar Vendedor
            </div>
            <div class="jv_dropdown-separator"></div>
            <div class="jv_dropdown-item danger" data-action="delete">
                <i class="fas fa-trash"></i>
                Remover Vendedor
            </div>
        </div> -->

        <script>
            
        </script>

<a class="ym_mobile-td" onclick="abrirPopup('../pop-up/informacoes_vendedor.php','Informações do vendedor')">
    <i class="fa-solid fa-circle-info"></i>
</a>

</main>
    <script src="../../PUBLIC/JS/script-lista-vendedores.js"></script>
    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/script-pop-up.js"></script>
</body>
</html>