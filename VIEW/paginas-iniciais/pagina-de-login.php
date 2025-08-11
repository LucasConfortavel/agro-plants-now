<?php
require_once     "../../DB/connect.php";
include "../../INCLUDE/Menu_superior.php";

// if (isset($_POST['adicionar'])) {
//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     $email = mysqli_real_escape_string($con, $email);
//     $password = mysqli_real_escape_string($con, $password);

//     $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$password'";
//     $result = mysqli_query($con, $sql);

//     if (mysqli_num_rows($result) > 0) {
//         echo "<script>alert('Login realizado com sucesso!');</script>";  

//     } else {
//         echo "<script>alert('Email ou senha inválidos.');</script>";
//     }
// }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de login</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pagina-de-login.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu_superior.css">
</head>

<body>    

    <!-- pop-up -->
    <div class="ym_popup-overlay" >
        <div class="ym_carregamento-content"></div>
        <div class="ym_popup-content">
            <div class="ym_area-superior-popup"></div>
            <div class="ym_conteudo-popup"></div>
        </div>
    </div>

    <section class="jc_login-section">
        <div class="jc_total">

            <div class="jc_left-side">
                <h2>Agricultura de </h2>
                <h2>qualidade é aqui</h2>   
            </div>


            <div class="jc_login-box">
                <h3>Iniciar a sessão</h3> 

            
                <form action="#" method="POST">
                    <div class="lc_area-inputs">
                        <input type="email" class="jc_input-field" name="email" placeholder="E-mail" required>
                        <input type="password" class="jc_input-field" name="password" placeholder="Senha" required>
                    </div>
                    <div class="lc_area-links">
                        <a onclick="abrirPopup('../pop-up/pop-up-email-recuperar-senha.php','Informe seu e-mail para a recuperação de senha')" class="jc_forgot-password">Esqueceu sua senha?</a>
                        <!-- <a onclick="abrirPopup('../pop-up/pop-up-criar-senha.php','Redefinição de senha')" class="jc_forgot-password">Redefinir senha</a> -->
                    </div>
                    <input onclick="carregar('../vend/dashboard_vendedor.php')" type="submit" class="jc_login-btn" name="adicionar" value="Iniciar Sessão" ></input>
                </form>
                <div class="lc_area-engrenagem">
                    <a onclick="carregar('../adm/dashboard-adm.php')"><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/settings.svg" alt="" class="jc_engrenagem"></a>
                </div>
            </div>
            
        </div>
    </section>
</body>
</html>

<script src="../../PUBLIC/JS/script-menu-superior.js"></script>
<script src="../../PUBLIC/JS/script-pop-up.js"></script>
<script src="../../PUBLIC/JS/script-carregamento.js"></script>