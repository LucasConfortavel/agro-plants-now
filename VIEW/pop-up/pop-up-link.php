<?php

$link = 'https://whatsapp.linkbacana.com';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copiar Link</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up-link.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <section class="ym_area-pop-up">
        <div class="ym_pop-up">
            <div class="ym_superior-pop-up">
                <h1 class='ym_titulo' style="margin-left: 10px;">O link foi criado</h1>
                <button onclick= "window.location.href='../adm/venda-info-adm.php'" class="ym_btn-pop-up" style="margin-bottom: 20px;"><img class="ym_img-icons" src="../../PUBLIC/img/img_x.png" alt="X" style="margin-left: 100px;"></button>
            </div>
            
            <div class="ym_inferior-pop-up">
                <p id="ym_link"><?php echo $link; ?></p>
                <button onclick="copiarLink()" class='ym_btn-pop-up' style="margin-left: -5px;"><i class="fa-solid fa-copy"></i></button>
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
