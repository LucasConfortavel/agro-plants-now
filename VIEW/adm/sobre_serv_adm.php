<?php
include "../../INCLUDE/Menu_adm.php";
include "../../INCLUDE/vlibras.php";
require_once '../../CONTROLLER/ServicoController.php';
require_once '../../CONTROLLER/CategoriaController.php';

$servicoController = new ServicoController();
$categoriaController = new CategoriaController();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $servico = $servicoController->mostrar($id);
    
    if (isset($servico['error'])) {
        $error = $servico['error'];
    } else {
        $nome = $servico['nome'];
        $preco = $servico['preco'];
        $descricao = $servico['descricao'];
        $foto = $servico['foto'];
        $id_cat = $servico['id_cat'];
        
        $categoria = $categoriaController->mostrar($id_cat);
        $categoria_nome = isset($categoria['error']) ? 'Categoria não encontrada' : $categoria['nome'];
    }
} else {
    $error = "Nenhum serviço selecionado.";
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
        <?php if (isset($error)): ?>
            <div class="ym-alert ym-alert-error"><?php echo $error; ?></div>
            <a href="catalogo-tudo.php" class="ym_btn-padrao">Voltar</a>
        <?php else: ?>
        <section class="gs_product-container">

            <div class="gs_area-img">
                <img src="../../PUBLIC/img/<?php echo !empty($foto) ? $foto : 'img_servico.webp'; ?>" alt="<?php echo htmlspecialchars($nome); ?>" class="gs_product-image">
                <div class="gs_area-img-select">
                    <img src="../../PUBLIC/img/<?php echo !empty($foto) ? $foto : 'img_servico.webp'; ?>" alt="<?php echo htmlspecialchars($nome); ?>" class="gs_product-image-select">
                    <img src="../../PUBLIC/img/<?php echo !empty($foto) ? $foto : 'img_servico.webp'; ?>" alt="<?php echo htmlspecialchars($nome); ?>" class="gs_product-image-select">
                    <img src="../../PUBLIC/img/<?php echo !empty($foto) ? $foto : 'img_servico.webp'; ?>" alt="<?php echo htmlspecialchars($nome); ?>" class="gs_product-image-select">
                </div>
            </div>

            <div class="gs_product-info">
                <div class="gs_names">
                    <p class="gs_label">Nome</p>
                    <p class="gs_value"><?php echo htmlspecialchars($nome); ?></p>
                </div>

                <div class="gs_names">
                    <p class="gs_label">Categoria</p>
                    <p class="gs_value"><?php echo htmlspecialchars($categoria_nome); ?></p>
                </div>

                <div class="gs_names">
                    <p class="gs_label">Preço</p>
                    <p class="gs_value">R$ <?php echo number_format($preco, 2, ',', '.'); ?></p>
                </div>
                
                <div class="gs_names gs_desc">
                    <p class="gs_label">Descrição</p>
                    <p class="gs_value gs_desc"><?php echo htmlspecialchars($descricao); ?></p>
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