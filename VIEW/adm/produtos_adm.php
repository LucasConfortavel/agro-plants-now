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
    <link rel="stylesheet" type="text/css" href="../../PUBLIC/css/produtos-adm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <main class="jp_main-content">
        
        <?php $nome_produto = 'Nome do produto'; $imagem_produto = '../../PUBLIC/img/img_produto.png';?>

        <section class="ym_sectionProdutos">

            <h1 class="ym_titulo">Catálogo - Produtos</h1>

            <div class="ym_categorias">

                <input type="text" placeholder="Pesquise por algo no catálogo" class="ym_produtoPesquisa-mobile">   

                <div class="ym_links">
                    <a href="produtos-tudo.php" class="ym_linkCategoria ym_btn-padrao">Tudo</a>
                    <a href="produtos_adm.php" class="ym_linkCategoria ym_btn-padrao" style="background-color: #45734B; color: white; cursor: auto;">Produtos</a>
                    <a href="servicos_adm.php" class="ym_linkCategoria ym_btn-padrao">Serviços</a>
                    <a href="add-prod-serv.php" class="ym_linkCategoria ym_btn-padrao">Adicionar</a>  
                </div>

                <input type="text" placeholder="Pesquise por algo no catálogo" class="ym_produtoPesquisa">
            </div>

            <div class="ym_areaProdutos">
                <p class="ym_textoArea">Inoculantes microbianos</p>
                <div class="ym_produtos">

                    <div class="ym_cardProduto">
                        <div class="ym_img-placeholder">
                            <img src="../../PUBLIC/img/img_produto.png?height=100&width=100" class="ym_img">
                            <div class="ym_img-label">
                                <span>Fertilizante</span>
                            </div>
                            <i class="fa-solid fa-trash-can ym_delete-icon"></i>
                        </div>
                        <p class="ym_nomeProduto">Fertilizante Orgânico</p>
                        <p class="ym_preco">R$ 75,50</p>
                        <p class="ym_descricao">Fertilizante orgânico de alta qualidade para todas as culturas.</p>
                        <a href="#" class="ym_linkProduto ym_btn-padrao">Veja mais</a>
                    </div>

                    <div class="ym_cardProduto">
                        <div class="ym_img-placeholder">
                            <img src="/placeholder.svg?height=100&width=100" alt="YURI Falta imagem" class="ym_img">
                            <div class="ym_img-label">
                                <span>Bioestimulante</span>
                            </div>
                            <i class="fa-solid fa-trash-can ym_delete-icon"></i>
                        </div>
                        <p class="ym_nomeProduto">Bioestimulante Líquido</p>
                        <p class="ym_preco">R$ 120,00</p>
                        <p class="ym_descricao">Estimula o crescimento e a produtividade das plantas.</p>
                        <a href="#" class="ym_linkProduto ym_btn-padrao">Veja mais</a>
                    </div>

                    <div class="ym_cardProduto">
                        <div class="ym_img-placeholder">
                            <img src="/placeholder.svg?height=100&width=100" alt="YURI Falta imagem" class="ym_img">
                            <div class="ym_img-label">
                                <span>Bioestimulante</span>
                            </div>
                            <i class="fa-solid fa-trash-can ym_delete-icon"></i>
                        </div>
                        <p class="ym_nomeProduto">Bioestimulante Líquido</p>
                        <p class="ym_preco">R$ 120,00</p>
                        <p class="ym_descricao">Estimula o crescimento e a produtividade das plantas.</p>
                        <a href="#" class="ym_linkProduto ym_btn-padrao">Veja mais</a>
                    </div>

                    <div class="ym_cardProduto">
                        <div class="ym_img-placeholder">
                            <img src="/placeholder.svg?height=100&width=100" alt="YURI Falta imagem" class="ym_img">
                            <div class="ym_img-label">
                                <span>Bioestimulante</span>
                            </div>
                            <i class="fa-solid fa-trash-can ym_delete-icon"></i>
                        </div>
                        <p class="ym_nomeProduto">Bioestimulante Líquido</p>
                        <p class="ym_preco">R$ 120,00</p>
                        <p class="ym_descricao">Estimula o crescimento e a produtividade das plantas.</p>
                        <a href="#" class="ym_linkProduto ym_btn-padrao">Veja mais</a>
                    </div>

                    <div class="ym_cardProduto">
                        <div class="ym_img-placeholder">
                            <img src="/placeholder.svg?height=100&width=100" alt="YURI Falta imagem" class="ym_img">
                            <div class="ym_img-label">
                                <span>Bioestimulante</span>
                            </div>
                            <i class="fa-solid fa-trash-can ym_delete-icon"></i>
                        </div>
                        <p class="ym_nomeProduto">Bioestimulante Líquido</p>
                        <p class="ym_preco">R$ 120,00</p>
                        <p class="ym_descricao">Estimula o crescimento e a produtividade das plantas.</p>
                        <a href="#" class="ym_linkProduto ym_btn-padrao">Veja mais</a>
                    </div>


                </div>
            </div>

            <div class="ym_areaProdutos">
                <p class="ym_textoArea">Bioestimulantes</p>
                <div class="ym_produtos">

                    <div class="ym_cardProduto">
                        <div class="ym_img-placeholder">
                            <img src="/placeholder.svg?height=100&width=100" alt="CADE AS IMAGENS YURI?" class="ym_img">
                            <div class="ym_img-label">
                                <span>Enraizador</span>
                            </div>
                            <i class="fa-solid fa-trash-can ym_delete-icon"></i>
                        </div>
                        <p class="ym_nomeProduto">Enraizador Potente</p>
                        <p class="ym_preco">R$ 85,00</p>
                        <p class="ym_descricao">Promove o desenvolvimento robusto do sistema radicular.</p>
                        <a href="#" class="ym_linkProduto ym_btn-padrao">Veja mais</a>
                    </div>
                    
                    <div class="ym_cardProduto">
                        <div class="ym_img-placeholder">
                            <img src="/placeholder.svg?height=100&width=100" alt="CADE AS IMAGENS YURI?" class="ym_img">
                            <div class="ym_img-label">
                                <span>Enraizador</span>
                            </div>
                            <i class="fa-solid fa-trash-can ym_delete-icon"></i>
                        </div>
                        <p class="ym_nomeProduto">Enraizador Potente</p>
                        <p class="ym_preco">R$ 85,00</p>
                        <p class="ym_descricao">Promove o desenvolvimento robusto do sistema radicular.</p>
                        <a href="#" class="ym_linkProduto ym_btn-padrao">Veja mais</a>
                    </div>

                </div>
            </div>
        </section>
    </main>

</body>
</html>

<script src="../../PUBLIC/JS/script.js"></script>
