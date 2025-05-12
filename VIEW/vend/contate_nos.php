<?php

include "../../INCLUDE/Menu_superior.php";


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agro Plants NOW</title>
    <link rel="stylesheet" href="../../PUBLIC/css/contate_nos.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu_superior.css">

</head>
<body>

    <header class="jp_header">
            <div class="jp_overlay"></div>
        </nav>
    </header>


    <section class="ls_container-contate-nos">
        <div class="ls_texto-contato">
            <div class="ls_imagens">
                <div class="ls_tell">
                    <div>
                        <img src="../../PUBLIC/img/telefone.png" alt="Telefone">
                        <p>Ligue para nós</p>
                    </div>
                    <p>+55 (67) 99999-9999</p>
                </div>

                <div class="ls_tell">
                    <div>
                        <img src="../../PUBLIC/img/localizacao.png" alt="Ponteiro">
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
    <script src="../PUBLIC/JS/script.js"></script>
</body>
</html>
