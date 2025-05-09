<?php

include "../../INCLUDE/Menu_superior.php";


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de login</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pagina-de-login.css">
</head>
<body>
   
    <header class="jc_menu-container-sup">
        <nav class="jc_nav-bar-menu">
            <img class="jc_logo" src="../../PUBLIC/img/logo_agro.png 1.png" alt="Logo Agro Plants NOW">
            <ul class="jc_nav-list">
                <li class="jc_nav-item">
                    <a href="#" class="jc_nav-link">Home</a>
                </li>
                <li class="jc_nav-item">
                    <a href="#" class="jc_nav-link">Sobre-nós</a>
                </li>
                <li class="jc_nav-item">
                    <a href="#" class="jc_nav-link">Contate-nos</a>
                </li>
            </ul>
        </nav>
        <button class="jc_btn-button-padrao">Login</button>
    </header>

    
    <section class="jc_login-section">
        <div class="jc_total">

            
            <div class="jc_left-side">
                <h2>Agricultura de </h2>
                <h2>qualidade é aqui</h2>   
            </div>

            
            <div class="jc_login-box">
                <h3>Iniciar a sessão</h3> 
                <form action="#" method="POST">
                    <input type="email" class="jc_input-field" placeholder="E-mail" required>
                    <input type="password" class="jc_input-field" placeholder="Senha" required>
                    <a href="#" class="jc_forgot-password">Esqueceu sua senha?</a>
                    <button type="submit" class="jc_login-btn">Iniciar Sessão</button>
                </form>

                

            </div>
        </div>
    </section>
</body>
</html>