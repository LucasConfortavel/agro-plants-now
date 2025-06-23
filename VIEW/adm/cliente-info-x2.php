<?php

include "../../INCLUDE/Menu_adm.php";



?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../PUBLIC/css/clientes-info.css">
    <link rel="stylesheet" href="../PUBLIC/css/style_menu.css">
  
</head>
<body>
    <main class="jp_main-content">
        
        <input  class="er_pesquisa-x2" type="text" name="search" id="search" placeholder="pesquise por um cliente"> <a href="" class="er_search-img"><img src="../../PUBLIC/img/lupa.png" alt=""></a>
        
        
        
        
        <div class="er-box-x2">
            <div class="er_nao-questione-x2">
                <a href="#"><img class="er_seta-x2"  src="../../PUBLIC/img/Frame (3).svg" alt=""></a>

                <div class="er-box-img-x2"> <img class="er_user-x2" src="../../PUBLIC/img/SVGRepo_iconCarrier (2).svg" alt=""></div>
                
                <p class="er_user-name-x2">Rafael Germinari</p>
                <p class="er_user-date-x2">Cadastrado em 12/08/2024</p>
            </div> 
            
            <form class="er_form-x2" action="">
                <div class="er_wrap-input-y1">
                    <span class="er_email-x2">E-mail:</span>
                    <input class="er_input-email-x2" type="email" name="email" id="">
                    <hr class="hr-x2">
                </div>
                <div class="er_wrap-input-y2 ">
                    <span class="er_fone-x2">Telefone:</span>
                    <input class="er_input-fone-x2" type="text" name="fone" id="">
                    <hr class="hr2-x2">
                </div>
                <div class="er_wrap-input-y3">
                    <span class="er_cpf-x2">Cpf:</span>
                    <input class="er_input-cpf-x2" type="text" name="cpf" id="">
                    <hr class="hr3-x2" >
                </div>
                <div class="er_wrap-input-y4">
                    <span class="er_date-x2">Data de Nascimento:</span>
                    <input class="er_input-date-x2" type="date" name="data" id="">
                    <hr class="hr4-x2">
                </div>
                

            </form>

            <button class="er_btn-fixado-x2"><a href="">Fixado</a></button> 
            
            
        </div>
    </main>
</body>
</html>