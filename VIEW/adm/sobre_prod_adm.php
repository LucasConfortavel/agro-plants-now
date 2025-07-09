<?php
include "../../INCLUDE/Menu_adm.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Produto</title>
    <link rel="stylesheet" href="../../PUBLIC/css/sobre_prod.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
</head>
<body>

    <main class="jp_main-content">
        <section class="gs_product-container">

            <div class="gs_area-img">
                <img src="../../PUBLIC/img/img_produto.webp" alt="" class="gs_product-image">
                <div class="gs_area-img-select">
                    <img src="../../PUBLIC/img/img_produto.webp" alt="" class="gs_product-image-select" id="gs_img-select1">
                    <img src="../../PUBLIC/img/img_produto.webp" alt="" class="gs_product-image-select" id="gs_img-select2">
                    <img src="../../PUBLIC/img/img_produto.webp" alt="" class="gs_product-image-select" id="gs_img-select3">
                </div>
            </div>

            <div class="gs_product-info">
                <div class="gs_names">
                    <p class="gs_label">Nome</p>
                    <p class="gs_value">Forth Equilíbrio</p>
                </div>

                <div class="gs_names">
                    <p class="gs_label">Categoria</p>
                    <p class="gs_value">Produto</p>
                </div>

                <div class="gs_names">
                    <p class="gs_label">Preço</p>
                    <p class="gs_value">R$ 99,99</p>
                </div>

                <div class="gs_names">
                    <p class="gs_label">Estoque</p>
                    <p class="gs_value">50 unidades</p>
                </div>
                
                <div class="gs_names gs_desc">
                    <p class="gs_label">Descrição</p>
                    <p class="gs_value gs_desc">Você já está fazendo adubação e mesmo assim a planta não está respondendo legal? Esse adubo pode te ajudar. Ele vai complementar sua adubação principal, levando equilíbrio para o solo e proporcionando melhor absorção dos nutrientes para as suas plantas.</p>
                </div>

                <div class="ym_area-btn">
                    <a href="produtos-tudo.php" class="ym_btn-padrao">Voltar</a>
                </div>
            </div>
        </section>
    </main>

    <script src="../../PUBLIC/JS/script.js"></script>


    

</body>
</html>