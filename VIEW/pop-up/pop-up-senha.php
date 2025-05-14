<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de senha</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pagina-senha.css">
</head>
<body>
 
    <section class="login-section">
        <div class="center-box">
            <h2 class="form-title">Informe seu endereço de e-mail</h2>
            <div class="form-container">
                <input type="email" class="input-field" placeholder="E-mail" required>
                <button type="submit" class="login-btn">Avançar</button>
            </div>
        </div>
    </section>
 
    <script>
       
        document.getElementById('mobile-menu').addEventListener('click', function() {
            document.getElementById('nav-list').classList.toggle('active');
        });
    </script>
</body>
</html>