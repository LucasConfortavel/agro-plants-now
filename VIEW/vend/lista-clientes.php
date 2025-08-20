<?php
    include "../../INCLUDE/Menu_vend.php";
    require_once "../../DB/connect.php";
    
    $sql = 'SELECT * FROM cliente';
    $result = mysqli_query($con, $sql);
    $total_clientes = mysqli_num_rows($result);
?>
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
                                    <th style="text-align:center; color:black;">Data de cadastro</th>
                                    <th style="text-align:center; color:black;">Total de Compras</th>                                        
                                    <th style="text-align:right; color:black;">Valor Gasto</th>    
                                </tr>
                            </thead>
                            <tbody id="customerTableBody">
                                <?php 
                                if($result){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $id= $row['id'];
                                        $nome= $row['nome'];
                                        $email= $row['email'];
                                        $telefone= $row['telefone'];
                                        $data = $row['data_nasc'];                                 
                                        

                                        echo'
                                            <tr>
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

                                            </tr>
                                        ';}
                                    } else {
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
