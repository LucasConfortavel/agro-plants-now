<?php
    include "../../INCLUDE/Menu_vend.php";
    require_once "../../DB/connect.php";

    $sql = 'SELECT * FROM venda';
    $result = mysqli_query($con, $sql);
    $total_vendas = mysqli_num_rows($result);
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Venda</title>
    <link rel="stylesheet" href="../../PUBLIC/css/lista-vendas-vend.css">
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
                                <a onclick="abrirPopup('../../VIEW/pop-up/cadastroVenda-adm.php','Cadastro de clientes')">Cadastrar Venda</a>
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
                                    <th style="color:black;">Vendedor</th>
                                    <th style="color:black;">Comprador</th>
                                    <th style="color:black;">Data de cadastro</th>
                                    <th style="color:black;">Total</th>                                        
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
                                            </tr>
                                        ';}} else {
                                            echo '<tr><td colspan="5" style="text-align: center; height: 49.7vh;">Nenhum vendedor encontrado</td></tr>';
                                        }
                                ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
     
   
 
    </main>
    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/script-pop-up.js"></script>
 
</body>
</html>