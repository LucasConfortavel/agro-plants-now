<?php
include "../../INCLUDE/Menu_adm.php";
include "../../INCLUDE/vlibras.php";
require_once '../../CONTROLLER/SobreServicoController.php';

$sobreServicoController = new SobreServicoController();
$dados = [];

if (isset($_GET['id'])) {
    $dados = $sobreServicoController->carregarServico($_GET['id']);
} else {
    $dados = ['success' => false, 'error' => 'Nenhum serviço selecionado.'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Serviço</title>
    <link rel="stylesheet" href="../../PUBLIC/css/sobre_prod.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
</head>
<body>

    <main class="jp_main-content">
        <?php if (!$dados['success']): ?>
            <div class="ym-alert ym-alert-error"><?php echo $dados['error']; ?></div>
            <a href="catalogo-tudo.php" class="ym_btn-padrao">Voltar</a>
        <?php else: 
            $servico = $dados['servico'];
            $categoria_nome = $dados['categoria_nome'];
        ?>
        <section class="gs_product-container">

            <div class="gs_area-img">
                <img src="../../PUBLIC/img/<?php echo !empty($servico['foto']) ? $servico['foto'] : 'img_servico.webp'; ?>" alt="<?php echo htmlspecialchars($servico['nome']); ?>" class="gs_product-image">
                <div class="gs_area-img-select">
                    <img src="../../PUBLIC/img/<?php echo !empty($servico['foto']) ? $servico['foto'] : 'img_servico.webp'; ?>" alt="<?php echo htmlspecialchars($servico['nome']); ?>" class="gs_product-image-select">
                    <img src="../../PUBLIC/img/<?php echo !empty($servico['foto']) ? $servico['foto'] : 'img_servico.webp'; ?>" alt="<?php echo htmlspecialchars($servico['nome']); ?>" class="gs_product-image-select">
                    <img src="../../PUBLIC/img/<?php echo !empty($servico['foto']) ? $servico['foto'] : 'img_servico.webp'; ?>" alt="<?php echo htmlspecialchars($servico['nome']); ?>" class="gs_product-image-select">
                </div>
            </div>

            <div class="gs_product-info">
                <div class="gs_names">
                    <p class="gs_label">Nome</p>
                    <p class="gs_value"><?php echo htmlspecialchars($servico['nome']); ?></p>
                </div>

                <div class="gs_names">
                    <p class="gs_label">Categoria</p>
                    <p class="gs_value"><?php echo htmlspecialchars($categoria_nome); ?></p>
                </div>

                <div class="gs_names">
                    <p class="gs_label">Preço</p>
                    <p class="gs_value">R$ <?php echo number_format($servico['preco'], 2, ',', '.'); ?></p>
                </div>
                
                <div class="gs_names gs_desc">
                    <p class="gs_label">Descrição</p>
                    <p class="gs_value gs_desc"><?php echo htmlspecialchars($servico['descricao']); ?></p>
                </div>

                <div class="ym_area-btn">
                    <a href="catalogo-tudo.php" class="ym_btn-padrao">Voltar</a>
                </div>
            </div>
        </section>
        <?php endif; ?>
    </main>

    <script src="../../PUBLIC/JS/script-sobre-prod.js"></script>
</body>
</html>