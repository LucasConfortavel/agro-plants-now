<?php
    include "../../INCLUDE/Menu_adm.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Administrador</title>
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style-add-prod-serv.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonvcous" referrerpolicy="no-referrer" />
</head>
<body>

    <main class="jp_main-content">
        
        <?php $nome_produto = 'Nome do produto'; $imagem_produto = '../../PUBLIC/img/img_produto.png';?>

        <section class="vc_sectionProdutos">

            <h1 class="vc_titulo">Adicionar Produtos e Serviços</h1>

            <div class="vc_categorias">

                <input type="text" placeholder="Pesquise por algo no catálogo" class="vc_produtoPesquisa-mobile">   

                <div class="vc_links">
                    <a href="produtos-tudo.php" class="vc_linkCategoria ym_btn-padrao">Tudo</a>
                    <a href="produtos_administrador.php" class="vc_linkCategoria ym_btn-padrao">Produtos</a>
                    <a href="servico_adm.php" class="vc_linkCategoria ym_btn-padrao">Serviços</a>
                    <a href="add-prod-serv.php" class="vc_linkCategoria ym_btn-padrao" style="background-color: #45734B; color: white; cursor: auto;">Adicionar</a>  
                </div>

                <input type="text" placeholder="Pesquise por algo no catálogo" class="vc_produtoPesquisa">
            </div>

            <section class="vc-section-produtos">
                <div class="vc-area-produtos">
                    <a href="../../VIEW/pop-up/pop-up-add-produto.php" class="vc-card-produto">
                        <div class="vc-info-produto">
                            <img src="../../PUBLIC/img/img_adicionar-produto.png" alt="">
                        </div>
                        </a>
                    <a href="../../VIEW/pop-up/pop-up-add-servico.php" class="vc-card-servico">
                        <div class="vc-info-produto">
                            <img src="../../PUBLIC/img/img_adicionar-servico.png" alt="">
                        </div>
                    </a>
                </div>
            </section>

        </section>
    </main>

</body>
</html>

<script src="../../PUBLIC/JS/script.js"></script>

