<?php
include "../../INCLUDE/Menu_adm.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendas</title>
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/vendas-adm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body>  
    <main class="jp_main-content">
        <h1 class="ym_titulo">Lista de Vendas</h1> 
        <section class="ym_section">
            
            <div class="ym_area-barra-pesquisa">
                <div class="ls_pesquisa-barra">
                    <input type="text" placeholder="Pesquise por um vendedor">
                    <img src="../../PUBLIC/img/img_lupa.png" alt="lupa">
                </div>
            </div>
            
            <div class="ym_area-btn-superior">
                <a href="../../VIEW/pop-up/cadastroVenda-Fisica.php" class="ym_btn-superior ym_btn-padrao">Cadastrar venda</a>
            </div>
            
            <div class="ym_area-table">

            <table class="ym_tabela">

                <thead class="ym_thead">
                    <tr class="ym_tr">
                        <th class="ym_th" style="color:white;">Vendedor</th>
                        <th class="ym_th" style="color:white;">Comprador</th>
                        <th class="ym_th" style="color:white;">Data de cadastro</th>
                        <th class="ym_th" style="color:white;">Total</th>
                        <th class="ym_th"></th>
                    </tr>
                        
                    
                </thead>

                <tbody class="ym_tbody">

                    <?php
                        echo'
                        <tr class="ym_tr">
                            <td class="ym_td">Ederson Costa</td>
                            <td class="ym_td">José Farmer</td>
                            <td class="ym_td">16/08</td>
                            <td class="ym_td">R$ 100,00</td>
                            <td class="ym_td "><a href="../../VIEW/adm/venda-info-adm.php"<i class="fa-solid fa-circle-info"></i></a></td>
                        </tr>
                        ';
                    ?>

                </tbody>
                </table>
    
            </div>

        </section>
    
    

    </main>
</body>
</html>

<script src="../../PUBLIC/JS/script.js"></script>
