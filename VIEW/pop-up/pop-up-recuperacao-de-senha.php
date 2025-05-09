<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de recuperação de senha</title>
    <link rel="stylesheet" href="../../PUBLIC/css/recuperacao-de-senha.css"> 
</head>
<body>
    <main class="jp_main-content">

        <section class="jc_login-section">
            <div class="jc_center-box">
                <p>Insira o código enviado</p>
                <p>Insira o código que enviamos para o e-mail XXXXXXXX. Se você não receber o e-mail, verifique a pasta de spam ou tente novamente.</p>
                <form action="recuperacao-de-senha.php" method="POST"> 
                    <input type="text" class="jc_input-field" name="codigo" placeholder="Código" required> 
                    <button type="submit" class="jc_login-btn">Avançar</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>