<?php

$link = 'https://whatsapp.linkbacana.com';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copiar Texto</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up-link.css">
</head>

<body>
    <section class="ym_area-pop-up">
        <div class="ym_pop-up">
            <div class="ym_superior-pop-up">
                <h1 class='ym_titulo'>O link foi criado</h1>
                <button class="ym_btn-pop-up" style="margin-bottom: 20px;"><img clas="ym_img-icons" src="../../PUBLIC/img/fecha.png" alt=""></button>
            </div>
            
            <div class="ym_inferior-pop-up">
                <p id="ym_link"><?php echo $link; ?></p>
                <button onclick="copiarLink()" class='ym_btn-pop-up'><img clas="ym_img-icons" src="../../PUBLIC/img/copiar.png" alt=""></button>
            </div>
            
        </div>
    </section>

    <script>
        function copiarLink() {
            var texto = document.getElementById("ym_link").innerText;
            navigator.clipboard.writeText(texto)
        }
    </script>
</body>

</html>
