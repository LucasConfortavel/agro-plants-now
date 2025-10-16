<?php
require_once "../../CONTROLLER/CarrinhoController.php";
require_once "../../CONTROLLER/CatalogoController.php";
require_once "../../CONTROLLER/ProdutoController.php";
require_once "../../INCLUDE/alertas.php";
include "../../INCLUDE/vlibras.php";
include "../../INCLUDE/Menu_adm.php";

$carrinhoCtrl = new CarrinhoController();
$catalogoCtrl = new CatalogoController();
$produtoCtrl  = new ProdutoController();

if (!isset($_GET['id_cliente']) && !isset($_GET['nome'])) {
    die("Cliente não informado");
}

$id_cliente = $_GET['id_cliente'];
$nome_cliente = $_GET['nome'];

// Busca ou cria carrinho
$carrinho = $carrinhoCtrl->obterCarrinho($id_cliente);
$id_carrinho = $carrinho['id'] ?? null;
$carrinhoItens = new CarrinhoItensModel();
$carrinhoItens->removerDuplicatas($id_carrinho);

if (!$id_carrinho) {
    die("Erro ao obter carrinho");
}

// Adicionar produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produto'])) {
    $id_produto = $_POST['id_produto'];
    $quantidade = $_POST['quantidade'] ?? 1;

    $produto = $produtoCtrl->mostrar($id_produto);
    $preco_unitario = $produto['preco'] ?? 0;

    $resultado = $carrinhoCtrl->adicionarItem($id_carrinho, $id_produto, $quantidade);

    if (isset($resultado['success'])) {
        echo '<script>exibirAlerta("Produto adicionado ao carrinho!","sucesso");</script>';
    } else {
        echo '<script>exibirAlerta("Erro: '.$resultado['error'].'","error");</script>';
    }
}

// Remover item
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remover_item'])) {
    $id_item = $_POST['remover_item'];
    $carrinhoCtrl->removerItem($id_item);
    echo '<script>exibirAlerta("Item removido do carrinho!","sucesso");</script>';
}

// Carregar dados
$itens = $carrinhoCtrl->listarItens($id_carrinho);
$catalogo = $catalogoCtrl->carregarCatalogoProdutos();
$produtos = $catalogo['produtos'] ?? [];

// Calcular totais
$subtotal = 0;
foreach ($itens as &$item) {
    $produto = array_filter($produtos, fn($p) => $p['id'] == $item['id_produto']);
    $produto = array_values($produto)[0] ?? null;

    $item['preco_unitario'] = $item['preco_unitario'] ?? ($produto['preco'] ?? 0);
    $subtotal += $item['preco_unitario'] * $item['quantidade'];
}

$desconto = 0;
$total = $subtotal;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho do Cliente</title>
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/venda-info-administrador.css">
    <link rel="stylesheet" href="../../PUBLIC/css/global-tema.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .P_product-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
            margin-right: 10px;
            background-color: #f0f0f0;
        }

        .P_product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .P_item-produto {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .P_trash-button {
            border: none;
            background: none;
            color: red;
            cursor: pointer;
            font-size: 16px;
        }

        .P_trash-button:hover {
            color: darkred;
        }
    </style>
</head>
<body>

<main class="jp_main-content">
    <div class="back-button">
        <a href="clientes-adm.php" class="ym_link-volta"> <i class="fa-solid fa-arrow-left"></i> </a>
    </div>

    <div class="P_customer-info">
        <div class="P_customer-details">
            <div class="P_customer-label">Cliente</div>
            <div class="P_customer-name"><?= htmlspecialchars($nome_cliente) ?></div>
        </div>
    </div>

    <div class="P_cart-table">
        <div class="P_table-header">
            <div class="P_header-id">ID</div>
            <div class="P_header-produto">Produto</div>
            <div class="P_header-preco">Preço</div>   
            <div class="P_header-quantidade">Quantidade</div>
            <div class="P_header-total">Total</div>
        </div>

        <?php if (!empty($itens)): ?>
            <?php
                $produtosIndexados = [];
                foreach ($produtos as $p) {
                $produtosIndexados[$p['id']] = $p;
                }
            ?>
            <?php foreach ($itens as $item): ?>
                <?php
                    $produto = $produtosIndexados[$item['id_produto']] ?? null;
                    $nomeProduto = $produto['nome'] ?? 'Produto';
                    $fotoProduto = !empty($produto['foto']) ? $produto['foto'] : 'img_produto.webp';
                    $caminhoImagem = "../../PUBLIC/img/" . htmlspecialchars($fotoProduto);
                ?>
                <div class="P_cart-item">
                    <div class="P_item-id"><?= htmlspecialchars($item['id_produto']) ?></div>
                    <div class="P_item-produto">
                        <div class="P_product-image">
                            <img src="<?= $caminhoImagem ?>" alt="Imagem de <?= htmlspecialchars($nomeProduto) ?>">
                        </div>
                        <span><?= htmlspecialchars($nomeProduto) ?></span>
                    </div>
                    <div class="P_item-preco">R$<?= number_format($item['preco_unitario'], 2, ',', '.') ?></div>
                    <div class="P_item-quantidade"><?= htmlspecialchars($item['quantidade']) ?></div>
                    <div class="P_item-total">
                        R$<?= number_format($item['preco_unitario'] * $item['quantidade'], 2, ',', '.') ?>
                        <form method="post" style="display:inline">
                            <input type="hidden" name="remover_item" value="<?= $item['id'] ?>">
                            <button class="P_trash-button" type="submit">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="padding:20px;">Nenhum item no carrinho.</p>
        <?php endif; ?>
    </div>

    <div class="P_cart-summary">
        <div class="P_details-section">
            <h3>Resumo</h3>
            <div class="P_detail-row">
                <span>Subtotal</span>
                <span class="P_price">R$<?= number_format($subtotal, 2, ',', '.') ?></span>
            </div>
            <div class="P_detail-row">
                <span>Desconto</span>
                <span class="P_price discount">R$<?= number_format($desconto, 2, ',', '.') ?></span>
            </div>
            <div class="P_divider"></div>
            <div class="P_detail-row total-row">
                <span>Total</span>
                <span class="P_price total">R$<?= number_format($total, 2, ',', '.') ?></span>
            </div>
        </div>
    </div>

    <div class="P_cart-summary">
        <form method="post" class="P_coupon-section" style="margin-top:20px;">
            <select name="id_produto" required class="P_coupon-input">
                <option value="">Selecione um produto</option>
                <?php foreach ($produtos as $p): ?>
                    <option value="<?= $p['id'] ?>">
                        <?= htmlspecialchars($p['nome']) ?> — R$ <?= number_format($p['preco'], 2, ',', '.') ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="quantidade" value="1" min="1" class="P_coupon-input" required>
            <button type="submit" class="P_apply-button">Adicionar Produto</button>
        </form>
    </div>

    <div class="back-button-mobile">
        <a href="clientes-adm.php" class="ym_link-volta2"> <i class="fa-solid fa-arrow-left"></i> </a>
    </div>
</main>

<script src="../../PUBLIC/JS/script-pop-up.js"></script>
<script src="../../PUBLIC/JS/script-tema.js"></script>
</body>
</html>
