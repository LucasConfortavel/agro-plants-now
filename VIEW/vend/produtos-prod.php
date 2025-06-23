<?php
include "../../INCLUDE/Menu_vend.php";
include "../../INCLUDE/btn-notificacao.php";?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Itens</title>
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/produtos-vendedor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <main class="jp_main-content">
        
        <?php $nome_produto = 'Nome do produto'; $imagem_produto = '../../PUBLIC/img/img_produto.png';?>

        <section class="ym_sectionProdutos">

            <h1 class="ym_titulo">Produtos</h1>

            <div class="ym_categorias">

                <input type="text" placeholder="Pesquise por algo no catálogo" class="ym_produtoPesquisa-mobile">   

                <div class="ym_links">
                    <a href="produtos-tudo.php" class="ym_linkCategoria">Tudo</a>
                    <a href="produtos-prod.php" class="ym_linkCategoria" style="background-color: #45734B; color: white; cursor: auto;">Produtos</a>
                    <a href="produtos-servicos.php" class="ym_linkCategoria">Serviços</a>
                </div>

                <input type="text" placeholder="Pesquise por algo no catálogo" class="ym_produtoPesquisa">    
            </div>

            <div class="ym_areaProdutos">
                
                <p class="ym_textoArea">Inoculantes microbianos</p>

                <div class="ym_produtos">
                    <?php
                        echo'
                                <div class="ym_cardProduto">
                                    <img src=" ' . $imagem_produto . '" alt="produto" class="ym_img">
                                    <p class="ym_nomeProduto">' .  $nome_produto .'</p>
                                    <a href="../../VIEW/vend/sobre_prod.php" class="ym_linkProduto">Veja mais</a>
                                </div>
                        ';
                    ?>
                </div>

            </div>

            <div class="ym_areaProdutos">
                <p class="ym_textoArea">Bioestimulantes</p>
                
                <div class="ym_produtos">
                    <?php
                            echo'
                                    <div class="ym_cardProduto">
                                        <img src=" ' . $imagem_produto . '" alt="produto" class="ym_img">
                                        <p class="ym_nomeProduto">' .  $nome_produto .'</p>
                                        <a href="../../VIEW/vend/sobre_prod.php" class="ym_linkProduto">Veja mais</a>
                                    </div>
                                    ';
                                    ?>
                </div>

            </div>

        </section>
    </main>

</body>
</html>

<script src="../../PUBLIC/JS/script.js"></script>
