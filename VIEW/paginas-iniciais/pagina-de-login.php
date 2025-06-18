<?php

include "../../INCLUDE/Menu_superior.php";
if(isset($_POST['adicionar'])){
    header('location:../vend/dashboard_vendedor.php');
}



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de login</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pagina-de-login.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu_superior.css">
</head>
<body>    
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
                        <input type="email" class="jc_input-field" placeholder="E-mail" required>
                        <input type="password" class="jc_input-field" placeholder="Senha" required>
                    </div>
                    <div class="lc_area-links">
                        <a href="../pop-up/pop-up-email-recuperar-senha.php" class="jc_forgot-password">Esqueceu sua senha?</a>
                        <a href="../pop-up/pop-up-criar-senha.php" class="jc_forgot-password">Redefinir senha</a>
                    </div>
                    <input type="submit" class="jc_login-btn" name="adicionar" value="Iniciar Sessão"></input>
                </form>
                <div class="lc_area-engrenagem">
                    <a href="../adm/vcl-dashboard-adm.php"><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/settings.svg" alt="" class="jc_engrenagem"></a>
                </div>
            </div>
            
        </div>
    </section>
</body>
</html>