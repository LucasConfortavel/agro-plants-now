<?php

include "../../INCLUDE/Menu_adm.php";


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../../PUBLIC/css/ajustes-adm.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
</head>
<body>

<main class="jp_main-content">
            <header class="jp_profile-header">
                <div class="jp_profile-info">
                    <img src="../../PUBLIC/img/img_user.png" alt="Profile" class="jp_profile-pic">
                    <div class="profile-text">
                        <h2>José Farmer</h2>
                        <p>JoseFarmer_Reidoagro@gmail.com</p>
                    </div>
                </div>
                <div class="jp_role">Administrador</div>
            </header>

            <div class="jp_content">
                <nav class="jp_tabs">
                    <a href="ajustes-informaçoes-adm.php" class="jp_tab">Informações</a>
                    <a href="ajustes-security-adm.php" class="jp_tab jp_active">Segurança</a>
                </nav>

                <div class="jp_info-section">
                    <div class="jp_section-header">
                        <h3>Senhas & segurança</h3>
                    </div>

                    <form class="jp_security-form" onsubmit="redirectToHome(event)">
                        <div class="jp_password-section">
                            <div class="jp_password-group">
                                <label>Senha atual</label>
                                <input type="password" value="************" class="jp_form-input" readonly>
                            </div>

                            <div class="jp_password-group">
                                <label>Criar nova senha</label>
                                <input type="password" placeholder="Coloque a senha atual" class="jp_form-input">
                            </div>

                            <div class="jp_password-group">
                                <label>Confirmar senha</label>
                                <input type="password" placeholder="Nova senha" class="jp_form-input">
                            </div>
                        </div>

                        <div class="jp_form-actions">
                            <input type="submit" class="jp_btn-update ym_btn-padrao" value="Atualizar"></input>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script>
    function redirectToHome(event) {
        event.preventDefault(); 
        window.location.href = 'ajustes-informaçoes-adm.php'
    }
    </script>

    <div class="jp_overlay"></div>
    <script src="../../PUBLIC/js/script-ajustes.js"></script>
    <script src="../../PUBLIC/JS/script.js"></script>

</body>
</html>