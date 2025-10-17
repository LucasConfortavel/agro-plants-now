<?php
require_once '../../INCLUDE/verificarLogin.php';
include "../../INCLUDE/Menu_vend.php";
include "../../INCLUDE/vlibras.php";
require_once '../../CONTROLLER/SobreProdutoController.php';

$sobreProdutoController = new SobreProdutoController();
$dados = [];

if (isset($_GET['id'])) {
    $dados = $sobreProdutoController->carregarProduto($_GET['id']);
} else {
    $dados = ['success' => false, 'error' => 'Nenhum produto selecionado.'];
}

$successMessage = $_GET['success'] ?? '';
$errorMessage = $_GET['error'] ?? '';
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
        <?php if ($successMessage): ?>
            <div class="ym-alert ym-alert-success"><?php echo htmlspecialchars($successMessage); ?></div>
        <?php endif; ?>
        
        <?php if ($errorMessage): ?>
            <div class="ym-alert ym-alert-error"><?php echo htmlspecialchars($errorMessage); ?></div>
        <?php endif; ?>

        <?php if (!$dados['success']): ?>
            <div class="ym-alert ym-alert-error"><?php echo $dados['error']; ?></div>
            <a href="catalogo-tudo.php" class="ym_btn-padrao">Voltar</a>
        <?php else: 
            $produto = $dados['produto'];
            $categoria_nome = $dados['categoria_nome'];
            $imagemPrincipal = !empty($produto['foto']) ? '../../PUBLIC/img/' . $produto['foto'] : '../../PUBLIC/img/img_produto.webp';
        ?>
        <section class="gs_product-container">

            <div class="gs_area-img">
                <img src="<?php echo $imagemPrincipal; ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>" class="gs_product-image">
                <div class="gs_area-img-select">
                    <img src="<?php echo $imagemPrincipal; ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?> - Vista 1" class="gs_product-image-select">
                    <img src="<?php echo $imagemPrincipal; ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?> - Vista 2" class="gs_product-image-select">
                    <img src="<?php echo $imagemPrincipal; ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?> - Vista 3" class="gs_product-image-select">
                </div>
            </div>

            <div class="gs_product-info">
                <div class="gs_names">
                    <p class="gs_label">Nome</p>
                    <p class="gs_value"><?php echo htmlspecialchars($produto['nome']); ?></p>
                </div>

                <div class="gs_names">
                    <p class="gs_label">Categoria</p>
                    <p class="gs_value"><?php echo htmlspecialchars($categoria_nome); ?></p>
                </div>

                <div class="gs_names">
                    <p class="gs_label">Preço</p>
                    <p class="gs_value">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                </div>

                <div class="gs_names">
                    <p class="gs_label">Estoque Disponível</p>
                    <p class="gs_value"><?php echo htmlspecialchars($produto['quantidade']); ?> unidades</p>
                </div>
                
                <div class="gs_names">
                    <p class="gs_label">Reservado</p>
                    <p class="gs_value"><?php echo htmlspecialchars($produto['reservado']); ?> unidades</p>
                </div>

                <div class="gs_names">
                    <p class="gs_label">Disponível para Venda</p>
                    <p class="gs_value"><?php echo htmlspecialchars($produto['quantidade'] - $produto['reservado']); ?> unidades</p>
                </div>
                
                <div class="gs_names gs_desc">
                    <p class="gs_label">Descrição</p>
                    <p class="gs_value gs_desc"><?php echo htmlspecialchars($produto['descricao'] ?? 'Sem descrição disponível.'); ?></p>
                </div>

                <div class="ym_area-btn">
                    <?php if (($produto['quantidade'] - $produto['reservado']) > 0): ?>
                        <a href="venda-info-vend.php?produto_id=<?php echo $produto['id']; ?>" class="ym_btn-padrao ym_btn-comprar">
                            <i class="fa-solid fa-cart-shopping"></i> Comprar
                        </a>
                    <?php else: ?>
                        <button class="ym_btn-padrao ym_btn-indisponivel" disabled>
                            <i class="fa-solid fa-ban"></i> Indisponível
                        </button>
                    <?php endif; ?>
                    <a href="catalogo-tudo.php" class="ym_btn-padrao ym_btn-voltar">
                        <i class="fa-solid fa-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>
        </section>
        <?php endif; ?>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
    <script src="../../PUBLIC/JS/script-sobre-prod.js"></script>
</body>
</html>