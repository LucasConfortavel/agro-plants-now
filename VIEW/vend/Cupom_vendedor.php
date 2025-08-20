<?php
    include "../../INCLUDE/Menu_vend.php";
    require_once "../../DB/connect.php";
    
    $sql = 'SELECT * FROM cupom';
    $result = mysqli_query($con, $sql);
    $total_cupom = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Cupons</title>
    <link rel="stylesheet" href="../../PUBLIC/css/lista-vendas-vend.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <div class="container">
            <div class="card">
                <!-- Header -->
                <div class="card-header">
                    <div class="header-content">
                        <div class="title-section">
                            <h1 class="title">
                                <div class="title-bar"></div>
                                Cupons
                            </h1>
                            <p class="subtitle" id="customerCount">5 cupons encontrados</p>
                        </div>

                        <div class="actions">
                            <button class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                <a onclick="abrirPopup('../../VIEW/pop-up/pop-up-cadastroCupom.php','Cadastro de cupom')">Cadastrar Cupom</a>
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
                                    <th style="color:black;">Código</th>
                                    <th style="color:black;">Desconto</th>
                                    <th style="color:black;">Data de cadastro</th>
                                    <th style="color:black;">Validade</th>                                        
                                    <th class="actions-col"></th>
                                </tr>
                            </thead>
                            <tbody id="customerTableBody">
                                <?php 
                                    if($result && mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            $id= $row['id'];
                                            $codigo= $row['codigo'];
                                            $desconto= $row['valor'];
                                            $data= $row['data'];
                                            $validade = $row['validade'];   
                                    
                                            echo'
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="checkbox customer-checkbox" 
                                                            data-customer-id='.$id.'
                                                    </td>
                                                    <td>
                                                        <div class="customer-info">
                                                            <div class="avatar">
                                                                YM
                                                            </div>
                                                            <div class="customer-details">
                                                                <h4>'.$codigo.'</h4>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        '.$desconto.'
                                                    </td>
                                                    <td>'.$data.'</td>
                                                
                                                    <td>
                                                        '.$validade.'
                                                    </td>
                                                </tr>';}
                                                
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
