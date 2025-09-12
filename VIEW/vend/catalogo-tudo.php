<?php
include "../../INCLUDE/Menu_vend.php";

require_once '../../CONTROLLER/ProdutoController.php';
require_once '../../CONTROLLER/ServicoController.php';

$produtoController = new ProdutoController();
$servicoController = new ServicoController();

$produtos = $produtoController->index();
$servicos = $servicoController->index();

$erroProdutos = isset($produtos['error']);
$erroServicos = isset($servicos['error']);

$imagemPadrao = '../../PUBLIC/img/img_produto.png';
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

    <main class="jp_main-content">
        <section class="ym_sectionProdutos">
            <h1 class="ym_titulo">Catálogo - Geral</h1>

            <div class="ym_categorias">
                <div class="ym_area-input-pesquisa">
                    <a href="" class="ym_lupa"><i class="fa-solid fa-magnifying-glass"></i></a>
                    <input type="text" placeholder="Pesquise por algo no catálogo" class="ym_produtoPesquisa" id="inputPesquisa">    
                </div>  
                
                <div class="ym_area-select">
                    <div class="ym_select" onclick="mostrar_categorias()">
                        <p class="ym_categoria-select">Todos</p>
                        <p class="ym_seta-categoria">></p>
                    </div>
                    
                    <div class="ym_options">
                        <a href="catalogo-produtos.php" class="ym_link-option"><i class="fa-solid fa-building-wheat"></i> produto</a>
                        <a href="catalogo-servicos.php" class="ym_link-option"><i class="fa-solid fa-users-gear"></i> serviço</a>
                    </div>
                </div>
            </div>
            
            <p class="ym_textoArea">Principais produtos</p>
                
            <div class="ym_areaProdutos">
                <?php if ($erroProdutos): ?>
                    <div class="ym_erro">
                        Erro ao carregar produtos: <?php echo $produtos['error']; ?>
                    </div>
                <?php else: ?>
                    <div class="ym_todos-produtos" id="produtos-container">
                        <?php 
                        $contadorProdutos = 0;
                        foreach ($produtos as $produto): 
                            $contadorProdutos++;
                        ?>
                            <div class="ym_cardProduto">
                                <div class="ym_img-placeholder">
                                    <img src="<?php echo $imagemPadrao; ?>" alt="img-produto" class="ym_img">
                                    <div class="ym_img-label">
                                        <span><?php echo htmlspecialchars($produto['nome']); ?></span>
                                    </div>
                                </div>
                                <p class="ym_nomeProduto"><?php echo htmlspecialchars($produto['nome']); ?></p>
                                <p class="ym_preco">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                                <p class="ym_descricao"><?php echo htmlspecialchars($produto['descricao'] ?? 'Sem descrição'); ?></p>
                                <a href="sobre_prod.php?id=<?php echo $produto['id']; ?>" class="ym_linkProduto ym_btn-padrao">Veja mais</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <?php if ($contadorProdutos > 0): ?>
                    <div class="ym_btn-slide-area">
                        <button class="ym_btn-slide ym_slideBack" onclick="slideBack(<?php echo $contadorProdutos; ?>, 0)"> < </button>
                        <button class="ym_btn-slide ym_slideGo" onclick="slideGo(<?php echo $contadorProdutos; ?>, 0)"> > </button>
                    </div>
                    <?php else: ?>
                    <p class="ym_sem-itens">Nenhum produto encontrado.</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <p class="ym_textoArea">Principais serviços</p>
                
            <div class="ym_areaProdutos">
                <?php if ($erroServicos): ?>
                    <div class="ym_erro">
                        Erro ao carregar serviços: <?php echo $servicos['error']; ?>
                    </div>
                <?php else: ?>
                    <div class="ym_todos-produtos" id="servicos-container">
                        <?php 
                        $contadorServicos = 0;
                        foreach ($servicos as $servico): 
                            $contadorServicos++;
                        ?>
                            <div class="ym_cardProduto">
                                <div class="ym_img-placeholder">
                                    <img src="<?php echo $imagemPadrao; ?>" alt="img-servico" class="ym_img">
                                    <div class="ym_img-label">
                                        <span><?php echo htmlspecialchars($servico['nome']); ?></span>
                                    </div>
                                </div>
                                <p class="ym_nomeProduto"><?php echo htmlspecialchars($servico['nome']); ?></p>
                                <p class="ym_preco">R$ <?php echo number_format($servico['preco'], 2, ',', '.'); ?></p>
                                <p class="ym_descricao"><?php echo htmlspecialchars($servico['descricao'] ?? 'Sem descrição'); ?></p>
                                <a href="sobre_serv.php?id=<?php echo $servico['id']; ?>" class="ym_linkProduto ym_btn-padrao">Veja mais</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <?php if ($contadorServicos > 0): ?>
                    <div class="ym_btn-slide-area">
                        <button class="ym_btn-slide ym_slideBack" onclick="slideBack(<?php echo $contadorServicos; ?>, 1)"> < </button>
                        <button class="ym_btn-slide ym_slideGo" onclick="slideGo(<?php echo $contadorServicos; ?>, 1)"> > </button>
                    </div>
                    <?php else: ?>
                    <p class="ym_sem-itens">Nenhum serviço encontrado.</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>

<script src="../../PUBLIC/JS/script.js"></script>
<script src="../../PUBLIC/JS/script-catalogo.js"></script>