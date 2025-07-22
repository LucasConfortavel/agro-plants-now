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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../PUBLIC/css/lista-clientes.css">
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
        <h1 class="ym_titulo">Lista de Clientes</h1>
        <section class="ym_section">

            <div class="ym_area-barra-pesquisa">
                <div class="ls_pesquisa-barra">
                    <input type="text" placeholder="Pesquise por um Cliente">
                    <img src="../../PUBLIC/img/img_lupa.png" alt="lupa">
                </div>
            </div>

            <div class="ym_area-btn-superior">
                <a onclick="abrirPopup('../../VIEW/pop-up/cadastroPessoas.php','Cadastro de clientes')" class="ym_btn-superior ym_btn-padrao">Cadastrar Cliente</a>
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

                </div>
                
    </main>
    
    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="clientes-script.js"></script>
    <script src="../../PUBLIC/JS/script-pop-up.js"></script>

</body>
</html>