<?php

include "../../INCLUDE/Menu_vend.php";


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agro Plants NOW</title>
    <link rel="stylesheet" href="./global-index/index.css">
    <link rel="stylesheet" href="./css/style-contate-nos.css">
    <link rel="stylesheet" href="../PUBLIC/css/style_menu_superior.css">
</head>
<body>

<header class="jp_header">
        <!-- Início do menu -->
        <nav class="jp_nav">
            <div class="jp_logo">
                <img src="../PUBLIC/img/logo_agro.png" alt="Logo" class="jp_logo-img">
                <span class="jp_logo-text">AGRO PLANTS NOW</span>
            </div>
            
            <div class="jp_hamburger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="jp_sidebar">
                <ul class="jp_nav-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#sobre">Sobre nós</a></li>
                    <li><a href="#contato">Contate-nos</a></li>
                    <li><button class="jp_login-btn">Login</button></li>
                </ul>
            </div>
            
            <div class="jp_overlay"></div>
        </nav>
    </header>


    <section class="ls_container-contate-nos">
        <div class="ls_texto-contato">
            <div class="ls_imagens">
                <div class="ls_tell">
                    <div>
                        <img src="../imagens/Telefone.svg" alt="Telefone">
                        <p>Ligue para nós</p>
                    </div>
                    <p>+55 (67) 99999-9999</p>
                </div>

                <div class="ls_tell">
                    <div>
                        <img src="../imagens/Localização.svg" alt="Ponteiro">
                        <p>Localização</p>
                    </div>
                    <p>Rua santo dos santos, 999 Campo Grande - MS</p>
                </div>
            </div>
        </div>

        <div class="ls_container-menu">
            <p class="ls_texto-caixa">Contate-nos</p>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $nome = htmlspecialchars($_POST["nome"]);
                    $email = htmlspecialchars($_POST["email"]);
                    $mensagem = htmlspecialchars($_POST["mensagem"]);

                    // Aqui você pode salvar em banco de dados ou enviar por e-mail
                    echo "<p style='color: green;'>Mensagem enviada com sucesso!</p>";
                }
            ?>
            <form method="POST" action="">
                <div class="ls_caixas-de-texto">
                    <input type="text" name="nome" placeholder="Nome" class="ls_caixa-de-texto" required>
                    <input type="email" name="email" placeholder="E-mail" class="ls_caixa-de-texto" required>
                    <textarea name="mensagem" placeholder="Mensagem" class="ls_caixa-de-descricao" required></textarea>
                    <button type="submit" class="ls_botao">Enviar</button>
                </div>
            </form>
        </div>
    </section>

    <script src="../PUBLIC/JS/script-menu-superior.js"></script>
</body>
</html>
