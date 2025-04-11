<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu do Vendedor</title>
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/produtos-vendedor.css">
</head>
<body>
    <div class="jp_hamburger-menu">
        <div class="jp_hamburger-line"></div>
        <div class="jp_hamburger-line"></div>
        <div class="jp_hamburger-line"></div>
    </div>

    <div class="jp_container">
        <!-- Sidebar -->
        <aside class="jp_sidebar">
            <div class="jp_logo">
                <img src="../../PUBLIC/img/logo_agro.png" alt="Logo">
            </div>
            <nav>
                <ul>
                    <li class="jp_active"><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/grid.svg" alt=""> Dashboard</li>
                    <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/box.svg" alt=""> Catálogo</li>
                    <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/users.svg" alt=""> Clientes</li>
                    <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/shopping-cart.svg" alt=""> Vendas</li>
                    <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/tag.svg" alt=""> Cupons</li>
                </ul>
            </nav>
            <div class="jp_bottom-menu">
                <ul>
                    <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/settings.svg" alt=""> Ajustes</li>
                    <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/log-out.svg" alt=""> Sair</li>
                </ul>
            </div>
        </aside>

        <?php $nome_produto = 'Nome do produto'; $imagem_produto = '../../PUBLIC/img/produto.png';?>

        <main class="ym_main">
            <section class="ym_sectionProdutos">

                <h1 class="ym_titulo">Serviços</h1>

                <div class="ym_categorias">

                    <input type="text" placeholder="Pesquise por algo no catálogo" class="ym_produtoPesquisa-mobile">   

                    <div class="ym_links">
                        <a href="produtos-tudo.php" class="ym_linkCategoria">Tudo</a>
                        <a href="produtos-prod.php" class="ym_linkCategoria">Produtos</a>
                        <a href="produtos-servicos.php" class="ym_linkCategoria" style="background-color: #45734B; color: white; cursor: auto;">Serviços</a>
                    </div>

                    <input type="text" placeholder="Pesquise por algo no catálogo" class="ym_produtoPesquisa">    
                </div>

                <div class="ym_areaProdutos">
                    
                    <p class="ym_textoArea">Extensionista Rural</p>

                    <div class="ym_produtos">
                        <?php
                            echo'
                                    <div class="ym_cardProduto">
                                        <img src=" ' . $imagem_produto . '" alt="a" class="ym_img">
                                        <p class="ym_nomeProduto">' .  $nome_produto .'</p>
                                        <a class="ym_linkProduto">Veja mais</a>
                                    </div>
                                ';
                        ?>
                    </div>

                </div>

                <div class="ym_areaProdutos">
                    <p class="ym_textoArea">Pesquisador em Biotecnologia</p>
                    

                    <div class="ym_produtos">
                        <?php
                            echo'
                                    <div class="ym_cardProduto">
                                        <img src=" ' . $imagem_produto . '" alt="a" class="ym_img">
                                        <p class="ym_nomeProduto">' .  $nome_produto .'</p>
                                        <a class="ym_linkProduto">Veja mais</a>
                                    </div>
                                    ';
                        ?>
                    </div>
                    

                </div>

            </section>
        </main>
        


    <script src="../../PUBLIC/JS/script.js"></script>

</body>
</html>
