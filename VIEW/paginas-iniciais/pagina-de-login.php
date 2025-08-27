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

include "../../INCLUDE/Menu_superior.php";
require_once "../../DB/Database.php";

if (isset($_POST['adicionar'])) {
    try {
        $db = new Database();
        $conn = $db->getConnection();
        
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['tipo'] = $usuario['tipo'];

            if ($usuario['tipo'] == 'admin') {  
                header("Location: ../adm/dashboard-adm.php");
                exit;
            } elseif ($usuario['tipo'] == 'vendedor') {
                header("Location: ../vend/dashboard_vendedor.php");
                exit;
            } 

        } else {
            echo "<script>
                setTimeout(() => {
                    alert('Email ou senha inválidos.');
                }, 200);
            </script>";
        }
    } catch (DatabaseConnectionException $e) {
        error_log("Erro de conexão: " . $e->getMessage());
        echo "<script>alert('Erro interno do sistema');</script>";
    } catch (PDOException $e) {
        error_log("Erro PDO: " . $e->getMessage());
        echo "<script>alert('Erro na consulta');</script>";
    }
}
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

            
                <form method="POST">
                    <div class="lc_area-inputs">
                        <input type="email" class="jc_input-field" name="email" placeholder="E-mail" required>
                        <input type="password" class="jc_input-field" name="password" placeholder="Senha" required>
                    </div>
                    <div class="lc_area-links">
                        <a onclick="abrirPopup('../pop-up/pop-up-email-recuperar-senha.php','Informe seu e-mail para a recuperação de senha')" class="jc_forgot-password">Esqueceu sua senha?</a>
                        <!-- <a onclick="abrirPopup('../pop-up/pop-up-criar-senha.php','Redefinição de senha')" class="jc_forgot-password">Redefinir senha</a> -->
                    </div>
                    <input  type="submit" class="jc_login-btn" name="adicionar" value="Iniciar Sessão" ></input>
                </form>
            </div>
            
        </div>
    </section>
</body>
</html>

<script src="../../PUBLIC/JS/script-menu-superior.js"></script>
<script src="../../PUBLIC/JS/script-pop-up.js"></script>
<script src="../../PUBLIC/JS/script-carregamento.js"></script>