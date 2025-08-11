<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pagina-senha.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
</head>
<body>
 
    <div class="jc_form-container">
        <input type="email" class="ym_input-form" placeholder="E-mail" required>
        <a type="submit" onclick="abrirPopup('../pop-up/pop-up-recuperacao-de-senha.php','Recuperar senha')" class="ym_btn-padrao">Avançar</a>
    </div>
 
    <script>
       
        document.getElementById('mobile-menu').addEventListener('click', function() {
            document.getElementById('nav-list').classList.toggle('active');
        });
    </script>
</body>
</html>