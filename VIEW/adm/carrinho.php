<?php
require_once "../../CONTROLLER/CarrinhoController.php";
require_once "../../CONTROLLER/CatalogoController.php";
require_once "../../CONTROLLER/ProdutoController.php";
require_once "../../CONTROLLER/CupomController.php";
require_once "../../INCLUDE/alertas.php";
include "../../INCLUDE/vlibras.php";
include "../../INCLUDE/Menu_adm.php";

$carrinhoCtrl = new CarrinhoController();
$catalogoCtrl = new CatalogoController();
$produtoCtrl  = new ProdutoController();
$cupom  = new CupomController();

if (!isset($_GET['id_cliente']) && !isset($_GET['nome'])) {
    die("Cliente não informado");
}

$id_cliente = $_GET['id_cliente'];
$nome_cliente = $_GET['nome'];

$carrinho = $carrinhoCtrl->obterCarrinho($id_cliente);
$id_carrinho = $carrinho['id'] ?? null;
$carrinhoItens = new CarrinhoItensModel();
$carrinhoItens->removerDuplicatas($id_carrinho);

if (!$id_carrinho) {
    die("Erro ao obter carrinho");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_quantity') {
    header('Content-Type: application/json');
    
    error_log(" Recebendo requisição de atualização de quantidade");
    error_log(" POST data: " . print_r($_POST, true));
    
    $id_item = $_POST['id_item'] ?? null;
    $nova_quantidade = $_POST['quantidade'] ?? null;
    
    error_log(" ID Item: " . $id_item);
    error_log(" Nova Quantidade: " . $nova_quantidade);
    
    if ($id_item && $nova_quantidade && $nova_quantidade > 0) {
        try {
            if (!method_exists($carrinhoCtrl, 'atualizarQuantidade')) {
                error_log(" ERRO: Método atualizarQuantidade não existe no CarrinhoController");
                echo json_encode(['success' => false, 'error' => 'Método atualizarQuantidade não implementado']);
                exit;
            }
            
            $resultado = $carrinhoCtrl->atualizarQuantidade($id_item, $nova_quantidade);
            error_log(" Resultado da atualização: " . ($resultado ? 'true' : 'false'));
            
            if ($resultado) {
                $itens = $carrinhoCtrl->listarItens($id_carrinho);
                $itemAtualizado = null;
                
                foreach ($itens as $item) {
                    if ($item['id'] == $id_item) {
                        $itemAtualizado = $item;
                        break;
                    }
                }
                
                if ($itemAtualizado) {
                    $totalItem = $itemAtualizado['preco_unitario'] * $itemAtualizado['quantidade'];
                    
                    $subtotal = 0;
                    foreach ($itens as $item) {
                        $subtotal += $item['preco_unitario'] * $item['quantidade'];
                    }
                    
                    error_log(" Sucesso! Total item: " . $totalItem . ", Subtotal: " . $subtotal);
                    
                    echo json_encode([
                        'success' => true,
                        'total_item' => number_format($totalItem, 2, ',', '.'),
                        'subtotal' => number_format($subtotal, 2, ',', '.'),
                        'total' => number_format($subtotal, 2, ',', '.')
                    ]);
                } else {
                    error_log(" ERRO: Item não encontrado após atualização");
                    echo json_encode(['success' => false, 'error' => 'Item não encontrado']);
                }
            } else {
                error_log(" ERRO: Falha ao atualizar quantidade no banco");
                echo json_encode(['success' => false, 'error' => 'Erro ao atualizar quantidade']);
            }
        } catch (Exception $e) {
            error_log(" EXCEÇÃO: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        error_log(" ERRO: Dados inválidos - ID: $id_item, Qtd: $nova_quantidade");
        echo json_encode(['success' => false, 'error' => 'Dados inválidos']);
    }
    exit;
}

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remover_item'])) {
    $id_item = $_POST['remover_item'];
    $carrinhoCtrl->removerItem($id_item);
    echo '<script>exibirAlerta("Item removido do carrinho!","sucesso");</script>';
}

$itens = $carrinhoCtrl->listarItens($id_carrinho);
$catalogo = $catalogoCtrl->carregarCatalogoProdutos();
$produtos = $catalogo['produtos'] ?? [];

$produtosIndexados = [];
foreach ($produtos as $p) {
    $produtosIndexados[$p['id']] = $p;
}

$subtotal = 0;
foreach ($itens as &$item) {
    $produto = $produtosIndexados[$item['id_produto']] ?? null;
    
    $item['preco_unitario'] = $item['preco_unitario'] ?? ($produto['preco'] ?? 0);
    $subtotal += $item['preco_unitario'] * $item['quantidade'];
}
unset($item);

$cupons = $cupom->index();

$cupom_selecionado = null;
$cupom_valor = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cupom_id'])) {
    $cupom_id = $_POST['cupom_id'];
    
    foreach ($cupons as $c) {
        if ($c['id'] == $cupom_id) {
            $cupom_selecionado = $c;
            break;
        }
    }
}

if ($cupom_selecionado) {
    $cupom_valor = $cupom_selecionado['valor'];
} 

$desconto = 0;
if (!empty($cupom_valor)) {
    $desconto = $subtotal * ($cupom_valor / 100);
}

$total = $subtotal - $desconto;
if ($total < 0) $total = 0;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gerenciamento de carrinho de compras do cliente">
    <title>Carrinho - <?= htmlspecialchars($nome_cliente) ?></title>
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/venda-info-adm.css">
    <link rel="stylesheet" href="../../PUBLIC/css/global-tema.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<main class="jp_main-content">
        <div class="back-button">
            <a href="clientes-adm.php" class="ym_link-volta"> 
                <i class="fa-solid fa-arrow-left"></i>
                <span>Voltar</span>
            </a>
        </div>

        <div class="P_customer-info">
            <div class="P_customer-card">
                <div class="P_customer-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="P_customer-details">
                    <div class="P_customer-label">Cliente</div>
                    <div class="P_customer-name"><?= htmlspecialchars($nome_cliente) ?></div>
                </div>
            </div>
        </div>

        <div class="P_main-container">
            <div class="P_cart-section">
                <div class="P_section-header">
                    <h2>Itens do Carrinho</h2>
                    <span class="P_items-count"><?= count($itens) ?> <?= count($itens) === 1 ? 'item' : 'itens' ?></span>
                </div>
                    <div class="P_table-header">
                        <div class="P_header-id">ID</div>
                        <div class="P_header-produto">Produto</div>
                        <div class="P_header-preco">Preço</div>
                        <div class="P_header-quantidade">Qtd</div>
                        <div class="P_header-total">Total</div>
                        <div class="P_header-actions"></div>
                    </div>

                <div class="P_cart-table">

                    <?php foreach ($itens as $item): 
                        $produto = $produtosIndexados[$item['id_produto']] ?? null;
                        $nomeProduto = $produto['nome'] ?? 'Produto';
                        $fotoProduto = !empty($produto['foto']) ? $produto['foto'] : 'img_produto.webp';
                        $caminhoImagem = "../../PUBLIC/img/" . htmlspecialchars($fotoProduto);
                        if (!$produto) continue;

                        $precoUnitario = $item['preco_unitario'];
                        $quantidade = $item['quantidade'];
                        $totalItem = $precoUnitario * $quantidade;
                    ?>
                    <div class="P_cart-item" data-id-item="<?= $item['id'] ?>">
                        <div class="P_item-id">#<?= htmlspecialchars($item['id']) ?></div>
                        <div class="P_item-produto">
                            <div class="P_product-image">
                                <img src="<?= $caminhoImagem ?>" alt="Imagem de <?= htmlspecialchars($nomeProduto) ?>">
                            </div>
                            <span class="P_product-name"><?= htmlspecialchars($produto['nome']) ?></span>
                        </div>
                        <div class="P_item-preco">R$ <?= number_format($precoUnitario, 2, ',', '.') ?></div>
                        <div class="P_item-quantidade">
                            <div class="P_quantity-control">
                                <button class="P_qty-btn" onclick="decreaseQty(this)">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                                <input type="number" value="<?= $quantidade ?>" min="1" class="P_qty-input" readonly>
                                <button class="P_qty-btn" onclick="increaseQty(this)">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="P_item-total">R$ <?= number_format($totalItem, 2, ',', '.') ?></div>
                        <div class="P_item-actions">
                            <form method="post">
                                <input type="hidden" name="remover_item" value="<?= $item['id'] ?>">
                                <button class="P_trash-button" type="submit">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>

                <div class="P_add-product-section">
                    <h3>Adicionar Produto</h3>
                    <form class="P_add-product-form" method="post">
                        <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($id_cliente) ?>">
                        <div class="P_form-group">
                            <label for="produto">Produto</label>
                            <select id="produto" name="id_produto" required class="P_select-input">
                                <option value="">Selecione um produto</option>
                                <?php foreach ($produtos as $produto): ?>
                                    <option value="<?= $produto['id'] ?>">
                                        <?= htmlspecialchars($produto['nome']) ?> – R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="P_form-group">
                            <label for="quantidade">Quantidade</label>
                            <input type="number" id="quantidade" name="quantidade" value="1" min="1" class="P_number-input" required>
                        </div>
                        <button type="submit" class="P_add-button">
                            <i class="fa-solid fa-plus"></i>
                            Adicionar ao Carrinho
                        </button>
                    </form>
                </div>
            </div>

            <div class="P_summary-section">
                <div class="P_summary-card">
                    <h3>Resumo do Pedido</h3>
                    
                    <div class="P_coupon-section">
                        <form method="post">
                            <label for="cupom_id">Selecionar Cupom de Desconto</label>
                            <select id="cupom_id" name="cupom_id" class="P_select-input">
                                <option value="">Nenhum cupom</option>
                                <?php foreach ($cupons as $c): ?>
                                    <option value="<?= $c['id'] ?>" <?= (isset($cupom_selecionado) && $cupom_selecionado['id'] == $c['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($c['codigo']) ?> — <?= $c['valor'] ?>%
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="P_apply-coupon-btn">Aplicar</button>
                        </form>
                    </div>

                    <script>
                            function aplicarCupom() {
                            var cupom = document.getElementById('cupom').value;
                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "processar_cupom.php", true); // Rota para processar o cupom
                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            xhr.onload = function() {
                                if (xhr.status == 200) {
                                    var resposta = JSON.parse(xhr.responseText);
                                    if (resposta.success) {
                                        // Atualiza o subtotal e o total com o desconto
                                        document.getElementById('summary-discount').textContent = '- R$ ' + resposta.desconto;
                                        document.getElementById('summary-total').textContent = 'R$ ' + resposta.total;
                                    } else {
                                        alert('Erro ao aplicar cupom: ' + resposta.error);
                                    }
                                } else {
                                    alert('Erro de conexão');
                                }
                            };
                            xhr.send("cupom=" + encodeURIComponent(cupom));
                        }
                    </script>

                    <div class="P_divider"></div>

                    <div class="P_summary-details">
                        <div class="P_detail-row">
                            <span class="P_detail-label">Subtotal</span>
                            <span class="P_detail-value" id="summary-subtotal">R$ <?= number_format($subtotal, 2, ',', '.') ?></span>
                        </div>
                        <div class="P_detail-row">
                            <span class="P_detail-label">Desconto</span>
                            <span class="P_detail-value P_discount" id="summary-discount">- R$ <?= number_format($desconto, 2, ',', '.') ?></span>
                        </div>
                        <div class="P_divider-thin"></div>
                        <div class="P_detail-row P_total-row">
                            <span class="P_detail-label">Total</span>
                            <span class="P_detail-value P_total" id="summary-total">R$ <?= number_format($total, 2, ',', '.') ?></span>
                        </div>
                    </div>

                    <button class="P_checkout-button">
                        <i class="fa-solid fa-link"></i>
                        Gerar Link de Pagamento
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script src="../../PUBLIC/JS/script-info_vendas.js"></script>
    <script src="../../PUBLIC/JS/script-tema.js"></script>

</body>
</html>
