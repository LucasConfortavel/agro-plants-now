<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Senha</title>
    <link rel="stylesheet" href="../../PUBLIC/css/criar-senha.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
</head>
<body>            
    <form method="POST" class="jc_form">
        <input type="password" class="ym_input-form" placeholder="Nova Senha" required>
        <input type="password" class="ym_input-form" placeholder="Confirme sua Senha" required>
        <a onclick="abrirPopup('../pop-up/pop-up-senha-alterada-sucesso.php','Senha alterada com sucesso!')" class="ym_btn-padrao">Confirmar</a>
    </form>
</body>
</html>

<script src="../../PUBLIC/JS/script-pop-up.js"></script>
