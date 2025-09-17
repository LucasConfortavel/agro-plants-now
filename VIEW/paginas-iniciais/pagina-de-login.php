<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id'], $_SESSION['email'], $_SESSION['tipo'])) {
    if ($_SESSION['tipo'] == 'admin') {  
        header("Location: ../adm/dashboard-adm.php");
        exit;
    } elseif ($_SESSION['tipo'] == 'vendedor') {
        header("Location: ../vend/dashboard_vendedor.php");
        exit;
    }
}

$error = isset($_GET['error']) ? $_GET['error'] : '';

include "../../INCLUDE/Menu_superior.php";
include "../../INCLUDE/vlibras.php";


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de login</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pagina-de-login.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu_superior.css">
</head>

<body>    
    <!-- pop-up -->
    <div class="ym_popup-overlay">
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
                
                <?php if (!empty($error)): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error); ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="../../CONTROLLER/login.php">
                    <div class="lc_area-inputs">
                        <input type="email" class="jc_input-field" name="email" placeholder="E-mail" required>
                        <input type="password" class="jc_input-field" name="senha" placeholder="Senha" required>
                    </div>
                    <div class="lc_area-links">
                        <a onclick="abrirPopup('../pop-up/pop-up-email-recuperar-senha.php','Informe seu e-mail para a recuperação de senha')" class="jc_forgot-password">Esqueceu sua senha?</a>
                    </div>
                    <input type="submit" class="jc_login-btn" value="Iniciar Sessão">
                </form>
            </div>
        </div>
    </section>
</body>
</html>

<script src="../../PUBLIC/JS/script-menu-superior.js"></script>
<script src="../../PUBLIC/JS/script-pop-up.js"></script>
<script src="../../PUBLIC/JS/script-carregamento.js"></script>