<?php

include "../../INCLUDE/Menu_adm.php";


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="../../PUBLIC/css/ajustes-adm.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
</head>
<body>
        <main class="jp_main-content">
                <header class="jp_profile-header">
                <div class="jp_profile-info">
                    <img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/user.svg" alt="Profile" class="jp_profile-pic">
                    <div class="profile-text">
                        <h2>José Farmer</h2>
                        <p>JoseFarmer_Reidoagro@gmail.com</p>
                    </div>
                </div>
                <div class="jp_role">Administrador</div>
            </header>

            <div class="jp_content">
                <nav class="jp_tabs">
                    <a href="informaçoes_adm.html" class="jp_tab jp_active">Informações</a>
                    <a href="ajustes-security-adm.php" class="jp_tab">Segurança</a>
                </nav>

                <div class="jp_info-section">
                    <div class="jp_section-header">
                        <h3>Informações pessoais</h3>
                    </div>

                    <form class="jp_edit-form" onsubmit="redirectToHome(event)">
                        <div class="jp_info-grid">
                            <div class="jp_info-item">
                                <label>Nome</label>
                                <input type="text" value="José Farmer" disabled class="jp_form-input disabled">
                            </div>
                            <div class="jp_info-item">
                                <label>Idade</label>
                                <input type="text" value="39" disabled class="jp_form-input disabled">
                            </div>
                            <div class="jp_info-item">
                                <label>Data de nascimento</label>
                                <input type="text" value="10/09/2007" disabled class="jp_form-input disabled">
                            </div>
                            <div class="jp_info-item">
                                <label>E-mail</label>
                                <input type="email" placeholder="Digite seu e-mail" class="jp_form-input">
                            </div>
                            <div class="jp_info-item">
                                <label>Número de telefone</label>
                                <input type="tel" placeholder="Digite seu telefone" class="jp_form-input">
                            </div>
                            <div class="jp_info-item">
                                <label>Posição</label>
                                <input type="text" value="Administrador" disabled class="jp_form-input disabled">
                            </div>
                            <div class="jp_info-item">
                                <label>CPF</label>
                                <input type="text" value="345.367.234-14" disabled class="jp_form-input disabled">
                            </div>
                        </div>
                        <div class="jp_form-actions">
                            <button type="submit" class="jp_btn-update">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    
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