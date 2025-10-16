<?php
require_once '../../INCLUDE/verificarLogin.php';
include "../../INCLUDE/Menu_adm.php";
include "../../INCLUDE/vlibras.php";
require_once '../../CONTROLLER/SobreProdutoController.php';

$sobreProdutoController = new SobreProdutoController();
$dados = [];

if (isset($_GET['id'])) {
    $dados = $sobreProdutoController->carregarProduto($_GET['id']);
} else {
    $dados = ['success' => false, 'error' => 'Nenhum produto selecionado.'];
}
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
    <link rel="stylesheet" href="../../PUBLIC/css/global-tema.css">
</head>
<body>

    <main class="jp_main-content">
        <?php if (!$dados['success']): ?>
            <div class="ym-alert ym-alert-error"><?php echo $dados['error']; ?></div>
            <a href="catalogo-tudo.php" class="ym_btn-padrao">Voltar</a>
        <?php else: 
            $produto = $dados['produto'];
            $categoria_nome = $dados['categoria_nome'];
        ?>
        <section class="gs_product-container">

            <div class="gs_area-img">
                <img src="../../PUBLIC/img/<?php echo !empty($produto['foto']) ? $produto['foto'] : 'img_produto.webp'; ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>" class="gs_product-image">
            
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
                    <p class="gs_label">Estoque</p>
                    <p class="gs_value"><?php echo $produto['quantidade']; ?> unidades</p>
                </div>
                
                <div class="gs_names gs_desc">
                    <p class="gs_label">Descrição</p>
                    <p class="gs_value gs_desc"><?php echo htmlspecialchars($produto['descricao']); ?></p>
                </div>

                <div class="ym_area-btn">
                    <a href="catalogo-tudo.php" class="ym_btn-padrao">Voltar</a>
                </div>
            </div>
        </section>
        <?php endif; ?>
    </main>

    <script src="../../PUBLIC/JS/script-sobre-prod.js"></script>
    <script src="../../PUBLIC/JS/script-tema.js"></script>
</body>
</html>