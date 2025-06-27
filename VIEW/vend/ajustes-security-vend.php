<?php

include "../../INCLUDE/Menu_vend.php";


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../../PUBLIC/css/ajustes-vend.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">

</head>
<body>

<main class="jp_main-content">
            <header class="jp_profile-header">
                <div class="jp_profile-info">
                    <img src="../../PUBLIC/img/img_user.png" alt="Profile" class="jp_profile-pic">
                    <div class="profile-text">
                        <h2>Nome vendedor</h2>
                        <p>Vendedor@gmail.com</p>
                    </div>
                </div>
                <div class="jp_role">Vendedor</div>
            </header>

            <div class="jp_content">
                <nav class="jp_tabs">
                    <a href="ajustes-informaçoes-vend.php" class="jp_tab">Informações</a>
                    <a href="ajustes-segurity-vend.php" class="jp_tab jp_active">Segurança</a>
                </nav>

                <div class="jp_info-section">
                    <div class="jp_section-header">
                        <h3>Senhas & segurança</h3>
                    </div>

                    <form class="jp_security-form" onsubmit="redirectToHome(event)">
                        <div class="jp_password-section">
                            <div class="jp_password-group">
                                <label>Senha atual</label>
                                <input type="password" value="************" class="ym_input-padrao" readonly>
                            </div>

                            <div class="jp_password-group">
                                <label>Criar nova senha</label>
                                <input type="password" placeholder="Coloque a senha atual" class="ym_input-padrao">
                            </div>

                            <div class="jp_password-group">
                                <label>Confirmar senha</label>
                                <input type="password" placeholder="Nova senha" class="ym_input-padrao">
                            </div>
                        </div>

                        <div class="jp_form-actions">
                            <button type="submit" class="jp_btn-update">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script>
    function redirectToHome(event) {
        event.preventDefault(); 
        window.location.href = 'ajustes-informaçoes-vend.php'
    }
    </script>

    <div class="jp_overlay"></div>
    <script src="../../PUBLIC/js/script-ajustes.js"></script>
</body>
</html>