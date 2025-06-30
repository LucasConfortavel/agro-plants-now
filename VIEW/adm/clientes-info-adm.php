<?php

include "../../INCLUDE/Menu_adm.php";

// include "../btn/btn-notificaçao.php";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../PUBLIC/css/clientes-info.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/btn-notificacao.css">

  
</head>
<body>
    <main class="jp_main-content">
        
        <input  class="er_pesquisa" type="text" name="search" id="search" placeholder="pesquise por um cliente"> <a href="" class="er_search-img"><img src="../../PUBLIC/img/lupa.png" alt=""></a></p>
        
        <div class="er-box">
            <div class="er_nao-questione">
                <a href="#"><img class="er_seta"  src="../../PUBLIC/img/Frame (3).svg" alt=""></a>

                <div class="er-box-img"> <img class="er_user" src="../../PUBLIC/img/SVGRepo_iconCarrier (2).svg" alt=""></div>
                
                <p class="er_user-name">Calebe Lemos</p>
                <p class="er_user-date">Cadastrado em 12/08/2024</p>
            </div> 
            
            <form class="er_form" action="">
                <div class="er_wrap-input1">
                    <span class="er_email">E-mail</span>
                    <input class="er_input-email" type="email" name="email" id="">
                    <hr>
                </div>
                <div class="er_wrap-input2 ">
                    <span class="er_fone">Telefone</span>
                    <input class="er_input-fone" type="text" name="fone" id="">
                    <hr>
                </div>
                <div class="er_wrap-input3">
                    <span class="er_cpf">Cpf</span>
                    <input class="er_input-cpf" type="text" name="cpf" id="">
                    <hr  >
                </div>
                <div class="er_wrap-input4">
                    <span class="er_date">Data de Nascimento</span>
                    <input class="er_input-date" type="date" name="data" id="">
                    <hr class="hr4">
                </div>
                

            </form>

            <button class="er_btn-fixado ym_btn-padrao"><a href="">Fixado</a></button> 
                
           
            
        </div>
    </main>
</body>
</html>