<?php
include "../../INCLUDE/Menu_adm.php";
include "../../INCLUDE/vlibras.php";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/catalogo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <!-- pop-up -->
    <div class="ym_popup-overlay" >
        <div class="ym_popup-content">
            <div class="ym_area-superior-popup"></div>
            <div class="ym_conteudo-popup"></div>
        </div>
    </div>

    <main class="jp_main-content">

        <?php $nome_produto = 'Nome do produto'; $imagem_produto = '../../PUBLIC/img/img_produto.png';?>
        <?php $nome_produto = 'Nome do produto'; $imagem_produto2 = '../../PUBLIC/img/img_o-que-fazemos.png';?>
        
            <section class="ym_sectionProdutos">
    
                <h1 class="ym_titulo">Catálogo - Produtos</h1>

                <div class="ym_categorias">
                    
                    <div class="ym_area-input-pesquisa">
                        <a href="" class="ym_lupa"><i class="fa-solid fa-magnifying-glass"></i></a>
                        <input  type="text" placeholder="Pesquise por algo no catálogo" class="ym_produtoPesquisa">    
                    </div>    
                    
                    
                    <div class="ym_area-select">
                        <div class="ym_select" onclick="mostrar_categorias()">
                            <p class="ym_categoria-select">Produto</p>
                            <p class="ym_seta-categoria">></p>
                        </div>
                        
                        
                        <div class="ym_options">
                            <a href="catalogo-tudo.php" class="ym_link-option"><i class="fa-solid fa-cube"></i> todos</a>
                            <a href="catalogo-servicos.php" class="ym_link-option"><i class="fa-solid fa-users-gear"></i> serviço</a>
                        </div>
                    </div>
                    <a class="ym_btn-add" onclick="abrirPopup('../../VIEW/pop-up/pop-up-add-produto.php','Cadastro de produto')" >+</a>
                </div>
                
                <div class="ym_titulo-produtos">
                    <p class="ym_textoArea">Inoculantes microbianos</p>
                    <a class="ym_textoLink">Ver Mais</a>
                </div>
                    
                    <div class="ym_areaProdutos">
                        <div class="ym_todos-produtos">
                            <?php for($i=0; $i < 20; $i++){echo'
                                <div class="ym_cardProduto">
                                    <div class="ym_img-placeholder">
                                        <img src="'. $imagem_produto .'" alt="umg-produto" class="ym_img">
                                        <div class="ym_img-label">
                                            <span>Bioestimulante</span>
                                        </div>
                                        <i class="fa-solid fa-trash-can ym_delete-icon"></i>
                                    </div>
                                    <p class="ym_nomeProduto">'. $nome_produto .'</p>
                                    <p class="ym_preco">R$ 120,00</p>
                                    <p class="ym_descricao">Estimula o crescimento e a produtividade das plantas.</p>
                                    <a href="sobre_prod_adm.php" class="ym_linkProduto ym_btn-padrao">Veja mais</a>
                                </div>';}
                                ?>
                        </div>
                        
                        <?php echo'
                        <div class="ym_btn-slide-area">
                            <button class="ym_btn-slide ym_slideBack" onclick="slideBack('.$i.',0)"> < </button>
                            <button class="ym_btn-slide ym_slideGo" onclick="slideGo('.$i.',0)"> > </button>
                        </div>'
                        ?>
                        
                    </div>
                




                <div class="ym_titulo-produtos">
                    <p class="ym_textoArea">Bioestimulantes</p>
                    <a class="ym_textoLink">Ver Mais</a>
                </div>

                <div class="ym_areaProdutos">
                        <div class="ym_todos-produtos">
                            <?php for($i=0; $i < 20; $i++){echo'
                                <div class="ym_cardProduto">
                                    <div class="ym_img-placeholder">
                                        <img src="'. $imagem_produto .'" alt="umg-produto" class="ym_img">
                                        <div class="ym_img-label">
                                            <span>Bioestimulante</span>
                                        </div>
                                        <i class="fa-solid fa-trash-can ym_delete-icon"></i>
                                    </div>
                                    <p class="ym_nomeProduto">'. $nome_produto .'</p>
                                    <p class="ym_preco">R$ 120,00</p>
                                    <p class="ym_descricao">Estimula o crescimento e a produtividade das plantas.</p>
                                    <a href="#" class="ym_linkProduto ym_btn-padrao">Veja mais</a>
                                </div>';}
                                ?>
                        </div>
                        
                        <?php echo'
                        <div class="ym_btn-slide-area">
                            <button class="ym_btn-slide ym_slideBack" onclick="slideBack('.$i.',1)"> < </button>
                            <button class="ym_btn-slide ym_slideGo" onclick="slideGo('.$i.',1)"> > </button>
                        </div>'
                        ?>
                        
                    </div>

            </section>
    </main>


</body>
</html>

<script src="../../PUBLIC/JS/script-select.js"></script>
<script src="../../PUBLIC/JS/script-pop-up.js"></script>
<script src="../../PUBLIC/JS/script-catalogo.js"></script>
