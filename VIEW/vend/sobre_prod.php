<?php
include "../../INCLUDE/Menu_vend.php";
include "../../INCLUDE/vlibras.php";


require_once '../../CONTROLLER/ProdutoController.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: catalogo-tudo.php');
    exit;
}

$id_produto = $_GET['id'];

$produtoController = new ProdutoController();
$produto = $produtoController->mostrar($id_produto);

if (isset($produto['error'])) {
    header('Location: catalogo-tudo.php?error=' . urlencode($produto['error']));
    exit;
}

$imagemPadrao = '../../PUBLIC/img/img_produto.webp';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Produto - <?php echo htmlspecialchars($produto['nome']); ?></title>
    <link rel="stylesheet" href="../../PUBLIC/css/sobre_prod.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
</head>
<body>

    <main class="jp_main-content">
        <div>
            <section class="gs_product-container">
                
                <div class="gs_area-img">
                    <img src="<?php echo $imagemPadrao; ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>" class="gs_product-image">
                    <div class="gs_area-img-select">
                        <img src="<?php echo $imagemPadrao; ?>" alt="Imagem 1" class="gs_product-image-select" id="gs_img-select1">
                        <img src="<?php echo $imagemPadrao; ?>" alt="Imagem 2" class="gs_product-image-select" id="gs_img-select2">
                        <img src="<?php echo $imagemPadrao; ?>" alt="Imagem 3" class="gs_product-image-select" id="gs_img-select3">
                    </div>
                </div>

                <div class="gs_product-info">
                    <div class="gs_names">
                        <p class="gs_label">Nome</p>
                        <p class="gs_value"><?php echo htmlspecialchars($produto['nome']); ?></p>
                    </div>

                    <div class="gs_names">
                        <p class="gs_label">Categoria</p>
                        <p class="gs_value">Produto</p>
                    </div>

                    <div class="gs_names">
                        <p class="gs_label">Preço</p>
                        <p class="gs_value">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                    </div>

                    <div class="gs_names">
                        <p class="gs_label">Estoque</p>
                        <p class="gs_value"><?php echo htmlspecialchars($produto['quantidade']); ?> unidades</p>
                    </div>
                    
                    <div class="gs_names">
                        <p class="gs_label">Reservado</p>
                        <p class="gs_value"><?php echo htmlspecialchars($produto['reservado']); ?> unidades</p>
                    </div>
                    
                    <div class="gs_names gs_desc">
                        <p class="gs_label">Descrição</p>
                        <p class="gs_value gs_desc"><?php echo htmlspecialchars($produto['descricao'] ?? 'Sem descrição disponível.'); ?></p>
                    </div>

                    <div class="ym_area-btn">
                        <a href="venda-info-vend.php?produto_id=<?php echo $produto['id']; ?>" class="ym_btn-padrao">Comprar</a>
                        <a href="catalogo-tudo.php" class="ym_btn-padrao">Voltar</a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/script-sobre-prod.js"></script>
</body>
</html>