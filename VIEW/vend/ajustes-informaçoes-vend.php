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
                    <a href="ajustes-informaçoes-vend.php" class="jp_tab jp_active">Informações</a>
                    <a href="ajustes-security-vend.php" class="jp_tab">Segurança</a>
                </nav>

                <div class="jp_info-section">
                    <div class="jp_section-header">

                        <h3>Informações pessoais</h3>
                        <a href="ajustes-editar-vend.php" class="jp_edit-btn">
                            <img src="../../PUBLIC/img/img_editar.png" alt="Edit">
                            Editar
                        </a>
                    </div>

                    <div class="jp_info-grid">
                        <div class="jp_info-item">

                            <label>Nome</label>
                            <p>Nome vendedor</p>
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
                            <p>Vendedor@gmail.com</p>
                        </div>
                        <div class="jp_info-item">
                            <label>Número de telefone</label>
                            <p>+55 67 99456 - 4321</p>
                        </div>
                        <div class="jp_info-item">
                            <label>Posição</label>
                            <p>Vendedor</p>
                        </div>
                        <div class="jp_info-item">
                            <label>CPF</label>
                            <p>345.357.234-14</p>
                        </div>
                    </div>


                    <div class="sab-info-vend">
                        <div class="jp_section-header">
                            <h3>Informações pessoais</h3>
                        </div>


                        <div class="jp_info-grid">
                        <div class="jp_info-item">

                            <label>Total de vendas</label>
                            <p>2050</p>
                        </div>
                        <div class="jp_info-item">
                            <label>Vendas mensais</label>
                            <p>39</p>
                        </div>
                        <div class="jp_info-item">
                            <label>Data de nascimento</label>
                            <p>10/09/2007</p>
                        </div>
                        <div class="jp_info-item">
                            <label>Taxa de Comissão</label>
                            <p>10%</p>
                        </div>
                        <div class="jp_info-item">
                            <label>Vendas trimestrais</label>
                            <p>169</p>
                        </div>
                        <div class="jp_info-item">
                            <label>Total de Comissões ganhas</label>
                            <p>R$ 193.000,00</p>
                        </div>
                        <div class="jp_info-item">
                            <label>Vendas anuais</label>
                            <p>689</p>
                        </div>
                    </div>
                    </div>
                </div>

                
                
            </div>
        </main>
    

    <div class="jp_overlay"></div>

    <script src="../../PUBLIC/js/script-ajustes.js"></script>
</body>
</html>