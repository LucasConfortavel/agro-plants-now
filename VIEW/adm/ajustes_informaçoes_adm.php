<?php
include "../../INCLUDE/Menu_vend.php";
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../PUBLIC/css/ajustes.css">
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
                <a href="segurity.html" class="jp_tab">Segurança</a>
            </nav>

            <div class="jp_info-section">
                <div class="jp_section-header">

                    <h3>Informações pessoais</h3>
                    <a href="editar.html" class="jp_edit-btn">
                        <img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/edit.svg" alt="Edit">
                        Editar
                    </a>
                </div>

                <div class="jp_info-grid">
                    <div class="jp_info-item">

                        <label>Nome</label>
                        <p>José Farmer</p>
                    </div>
                    <div class="jp_info-item">
                        <label>Idade</label>
                        <p>39</p>
                    </div>
                    <div class="jp_info-item">
                        <label>Data de nascimento</label>
                        <p>10/09/2007</p>
                    </div>
                    <div class="jp_info-item">
                        <label>E-mail</label>
                        <p>JoseFarmer_Reidoagro@gmail.com</p>
                    </div>
                    <div class="jp_info-item">
                        <label>Número de telefone</label>
                        <p>+55 67 99456 - 4321</p>
                    </div>
                    <div class="jp_info-item">
                        <label>Posição</label>
                        <p>Administrador</p>
                    </div>
                    <div class="jp_info-item">
                        <label>CPF</label>
                        <p>345.357.234-14</p>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>
