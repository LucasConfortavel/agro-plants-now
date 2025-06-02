<?php
    include "../../INCLUDE/Menu_adm.php";
    include "../../INCLUDE/btn-notificacao.php"
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Administrador</title>
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style-add-prod-serv.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonvcous" referrerpolicy="no-referrer" />
</head>
<body>

    <main class="jp_main-content">
        
        <?php $nome_produto = 'Nome do produto'; $imagem_produto = '../../PUBLIC/img/produto.png';?>

        <section class="vc_sectionProdutos">

            <h1 class="vc_titulo">Adicionar Produtos e Serviços</h1>

            <div class="vc_categorias">

                <input type="text" placeholder="Pesquise por algo no catálogo" class="vc_produtoPesquisa-mobile">   

                <div class="vc_links">
                    <a href="produtos-tudo.php" class="vc_linkCategoria">Tudo</a>
                    <a href="produtos_administrador.php" class="vc_linkCategoria">Produtos</a>
                    <a href="servico_adm.php" class="vc_linkCategoria">Serviços</a>
                    <a href="add-prod-serv.php" class="vc_linkCategoria" style="background-color: #45734B; color: white; cursor: auto;">Adicionar</a>  
                </div>

                <input type="text" placeholder="Pesquise por algo no catálogo" class="vc_produtoPesquisa">
            </div>

            <section class="vc-section-produtos">
                <div class="vc-area-produtos">
                    <a href="../../VIEW/pop-up/pop-up-add-produto.php" class="vc-card-produto">
                        <div class="vc-info-produto">
                            <img src="../../PUBLIC/img/+.png" alt="">
                        </div>
                        </a>
                    <a href="../../VIEW/pop-up/pop-up-add-servico.php" class="vc-card-servico">
                        <div class="vc-info-produto">
                            <img src="../../PUBLIC/img/+2.png" alt="">
                        </div>
                    </a>
                </div>
            </section>

        </section>
    </main>

</body>
</html>

<script src="../../PUBLIC/JS/script.js"></script>

