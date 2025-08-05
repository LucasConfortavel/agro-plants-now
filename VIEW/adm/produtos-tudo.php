<?php
include "../../INCLUDE/Menu_adm.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Geral</title>
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/produtos-adm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <a class="ym_btn-add">
        <p>+</p>
    </a>

    <main class="jp_main-content">

        <?php $nome_produto = 'Nome do produto'; $imagem_produto = '../../PUBLIC/img/img_produto.png';?>
        <?php $nome_produto = 'Nome do produto'; $imagem_produto2 = '../../PUBLIC/img/img_o-que-fazemos.png';?>
        
            <section class="ym_sectionProdutos">
    
                <h1 class="ym_titulo">Catálogo - Geral</h1>

                <div class="ym_categorias">
                    
                    <input  type="text" placeholder="Pesquise por algo no catálogo" class="ym_produtoPesquisa">    
                    
                    <div class="ym_area-select">
                        <div class="ym_select" onclick="mostrar_categorias()">
                            <p class="ym_categoria-select">Todos</p>
                            <p class="ym_seta-categoria">></p>
                        </div>
                        
                        <div class="ym_options">
                            <a href="produtos_adm.php" class="ym_link-option"><i class="fa-solid fa-building-wheat"></i> produto</a>
                            <a href="servicos_adm.php" class="ym_link-option"><i class="fa-solid fa-users-gear"></i> serviço</a>
                        </div>
                    </div>
                </div>

                    <div class="ym_areaProdutos">
                    
                            <p class="ym_textoArea">Todos os produtos</p>

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
                
                        <p class="ym_textoArea">Inoculantes microbianos</p>

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
                    
                    <p class="ym_textoArea">Todos os serviços</p>

            <div class="ym_areaProdutos">
                <p class="ym_textoArea">Bioestimulantes</p>
                
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

            </div>
            <div class="ym_areaProdutos">
                
                <p class="ym_textoArea">Extensionista Rural</p>

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

            </div>

                </div>

            </section>
    </main>


</body>
</html>

<script src="../../PUBLIC/JS/script.js"></script>

<script>
    function mostrar_categorias(){
        let option = document.getElementsByClassName("ym_options")[0];
        let seta = document.getElementsByClassName("ym_seta-categoria")[0];
        let option_area = document.getElementsByClassName("ym_options")[0];

        if (window.getComputedStyle(option).display == 'none'){
            option.style.display = 'flex';
            seta.style.animation = 'ym_mostrar-options ease 0.4s';
            seta.style.transform = 'rotate(-90deg)';
            option_area.style.animation = 'ym_mostrar-options-area ease 0.4s';
        }
        else{
            seta.style.animation = 'ym-sumir-options ease 0.4s';
            seta.style.transform = 'rotate(90deg)';
            option_area.style.animation = 'ym-sumir-options-area ease 0.4s';
            setTimeout(() => {
                option.style.display = 'none';
            }, 390);
        }
    }

</script>
