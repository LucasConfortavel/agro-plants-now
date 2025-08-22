<?php
    include "../../INCLUDE/Menu_adm.php";
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
    <title>Gerenciamento de Vendedores</title>
    <link rel="stylesheet" href="../../PUBLIC/css/vendas-adm.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body>


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
                                    Cupons
                                </h1>
                                <p class="jv_subtitle" id="jv_customerCount"><?php echo $total_cupom;?> cupons encontrados</p>
                            </div>
                            
                            
                            <div class="jv_actions">
                                <div>
                                    <button class="jv_btn jv_btn-danger" id="jv_removeSelected" style="display: none;">
                                        <i class="fa-solid fa-trash-can"></i>Remover (<span id="jv_selectedCount">0</span>)
                                    </button>
                                </div>
                                <div>
                                    <button class="jv_btn jv_btn-primary">
                                        <i class="fas fa-plus"></i>
                                        <a onclick="abrirPopup('../../VIEW/pop-up/pop-up-cadastroCupom.php','Cadastro de clientes')">Cadastrar Cupom</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="jv_search-section">
                            <div class="jv_search-container">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" id="jv_searchInput" placeholder="Pesquisar por nome ou email..." class="jv_search-input">
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
                                        <th style="color:black;"id="jv_banguela">Codigo</th>
                                        <th style="color:black;"id="jv_banguela">Desconto</th>
                                        <th style="color:black;">Data de cadastro</th>
                                        <th style="color:black;">Validade</th>                                        
                                        <th class="actions-col"></th> 
                                </thead>
                                <tbody id="jv_customerTableBody"> 
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
                                                        <input type="checkbox" class="jv_checkbox customer-checkbox" 
                                                            data-customer-id='.$id.'
                                                    </td>
                                                    <td>
                                                        <div class="jv_customer-info">
                                                            <div class="jv_avatar">
                                                                YM
                                                            </div>
                                                            <div class="jv_customer-details">
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
                                                    <td>
                                                        <button class="jv_menu-btn" onclick="showDropdown(event, '.$id.')">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </button>
                                                    </td>
                                                </tr>';}
                                                
                                            } else {
                                                echo '<tr><td colspan="5" style="text-align: center; height: 49.7vh;">Nenhum Cupom encontrado</td></tr>';
                                            }
                                ?>

                                </tbody> 
                            </table>
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
                    Editar Cupom
                </div>
                <div class="jv_dropdown-separator"></div>
                <div class="jv_dropdown-item danger" data-action="delete">
                    <i class="fas fa-trash"></i>
                    Remover Cupom
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
            
        </div> 
        
    </main>
    
    <script src="../../PUBLIC/JS/cupom-adm.js"></script>
    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/script-pop-up.js"></script>

</body>
</html>
                                        