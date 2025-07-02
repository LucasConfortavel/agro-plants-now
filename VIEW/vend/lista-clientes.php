<?php


include "../../INCLUDE/Menu_vend.php";
include "../../INCLUDE/btn-notificacao.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Clientes</title>
    <link rel="stylesheet" href="../../PUBLIC/css/lista-clientes.css">
    <link rel="stylesheet" href="../../PUBLIC/css/tabela.css">
    <link rel="stylesheet" href="../../PUBLIC/css/lista-vendedores-adm.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
</head>
<body>

    <main class="jp_main-content">
        <div class="sab-engloba-tudo">
            <!-- <section class="ym_section"> -->
            <h1 class="ym_titulo">Lista de Clientes</h1>
                <div class="ym_area-barra-pesquisa">
                    <div class="ls_pesquisa-barra">
                        <input type="text" placeholder="Pesquise por um Cliente">
                        <img src="../../PUBLIC/img/img_lupa.png" alt="lupa">
                    </div>
                </div>

                <div class="ym_area-btn-superior">
                    <a href="../../VIEW/pop-up/cadastrar_vendedor.php" class="ym_btn-superior">Cadastrar Cliente</a>
                </div>
                
    </main>
    <script src="../../PUBLIC/JS/script.js"></script>

    <main class="jp_main-content">

<section class="ym_section">
    <div class="ym_area-table">

        <table class="ym_tabela">

            <thead class="ym_thead">
                <tr class="ym_tr">
                    <th class="ym_th" style="color:white;">Nome</th>
                    <th class="ym_th" style="color:white;">Data</th>
                    
                    <th class="ym_th"></th>
                    <th class="ym_th"></th>
                    <th class="ym_th"></th>
                    
                    
            </thead>

            <tbody class="ym_tbody">

                <?php
                    echo'
                    <tr class="ym_tr">
                        <td class="ym_td">paulorojas100</td>
                        <td class="ym_td">16/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td "><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>

                    <tr class="ym_tr">
                        <td class="ym_td">rafaelgerminari</td>
                        <td class="ym_td">12/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">calebelemos</td>
                        <td class="ym_td">12/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">edersoncosta</td>
                        <td class="ym_td">12/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">enildarosa</td>
                        <td class="ym_td">12/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">thiagoalmeida</td>
                        <td class="ym_td">12/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">pamelaferreira</td>
                        <td class="ym_td">12/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">joaosilva</td>
                        <td class="ym_td">13/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">mariasantos</td>
                        <td class="ym_td">13/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">pedrooliveira</td>
                        <td class="ym_td">14/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">anacosta</td>
                        <td class="ym_td">14/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">carlospereira</td>
                        <td class="ym_td">15/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">luciafernandes</td>
                        <td class="ym_td">15/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">robertolima</td>
                        <td class="ym_td">16/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">sandramartins</td>
                        <td class="ym_td">16/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">fernandorocha</td>
                        <td class="ym_td">17/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">carlasouza</td>
                        <td class="ym_td">17/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">marcosribeiro</td>
                        <td class="ym_td">18/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                    <tr class="ym_tr">
                        <td class="ym_td">patriciagomes</td>
                        <td class="ym_td">18/08</td>
                        <td class="ym_td"></td>
                        <td class="ym_td"></td>
                        <td class="ym_td"><a href=""><i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>

                    ';
                ?>

            </tbody>
        </table>

    </div>
</section> 



</main>

    <script src="clientes-script.js"></script>

</body>
</html>