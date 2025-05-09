<?php

include "../../INCLUDE/Menu_superior.php";


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de senha</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pagina-senha.css">
</head>
<body>
    <header class="menu-container-sup">
        <div class="header-content">
            <nav class="nav-bar-menu">
                <img class="logo" src="../../PUBLIC/img/logo_agro.png 1.png" alt="Logo Agro Plants NOW">
                <div class="menu-toggle" id="mobile-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul class="nav-list" id="nav-list">
                    <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Sobre-nós</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Contate-nos</a></li>
                </ul>
            </nav>
            <button class="btn-button-padrao">Login</button>
        </div>
    </header>
 
    <section class="login-section">
        <div class="center-box">
            <h2 class="form-title">Informe seu endereço de e-mail</h2>
            <div class="form-container">
                <input type="email" class="input-field" placeholder="E-mail" required>
                <button type="submit" class="login-btn">Avançar</button>
            </div>
        </div>
    </section>
 
    <script>
       
        document.getElementById('mobile-menu').addEventListener('click', function() {
            document.getElementById('nav-list').classList.toggle('active');
        });
    </script>
</body>
</html>