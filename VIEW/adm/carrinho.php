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

// Conexão PDO para gerenciar pedidos
$pdo = new PDO("mysql:host=192.168.22.9;dbname=143p2;charset=utf8", "turma143p2", "sucesso@143");

// Criar novo pedido (quando o anterior foi finalizado)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['novo_pedido'])) {
    // Calcular total atual do carrinho
    $itens_temp = $carrinhoCtrl->listarItens($id_carrinho);
    $catalogo_temp = $catalogoCtrl->carregarCatalogoProdutos();
    $produtos_temp = $catalogo_temp['produtos'] ?? [];
    
    $produtosIndexados_temp = [];
    foreach ($produtos_temp as $p) {
        $produtosIndexados_temp[$p['id']] = $p;
    }
    
    $total_pedido = 0;
    foreach ($itens_temp as $item_temp) {
        $produto_temp = $produtosIndexados_temp[$item_temp['id_produto']] ?? null;
        $preco = $item_temp['preco_unitario'] ?? ($produto_temp['preco'] ?? 0);
        $total_pedido += $preco * $item_temp['quantidade'];
    }
    
    // Criar novo pedido
    $stmt = $pdo->prepare("INSERT INTO pedidos (id_cliente, status, data_pedido, total) VALUES (?, 'PENDENTE', NOW(), ?)");
    if ($stmt->execute([$id_cliente, $total_pedido])) {
        $_SESSION['alerta'] = '<script>exibirAlerta("Novo pedido criado com sucesso!","sucesso");</script>';
        header("Location: " . $_SERVER['PHP_SELF'] . "?id_cliente=$id_cliente&nome=" . urlencode($nome_cliente));
        exit;
    }
}

// Buscar pedido do cliente
$stmt = $pdo->prepare("SELECT id, status FROM pedidos WHERE id_cliente = ? ORDER BY data_pedido DESC LIMIT 1");
$stmt->execute([$id_cliente]);
$pedido = $stmt->fetch(PDO::FETCH_ASSOC);
$status_pedido = $pedido['status'] ?? 'PENDENTE';
$id_pedido = $pedido['id'] ?? null;

// Atualizar status do pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar_status'])) {
    $novo_status = $_POST['atualizar_status'];
    
    if ($id_pedido) {
        $stmt = $pdo->prepare("UPDATE pedidos SET status = ? WHERE id = ?");
        if ($stmt->execute([$novo_status, $id_pedido])) {
            $_SESSION['alerta'] = '<script>exibirAlerta("Status atualizado para ' . $novo_status . '!","sucesso");</script>';
            header("Location: " . $_SERVER['PHP_SELF'] . "?id_cliente=$id_cliente&nome=" . urlencode($nome_cliente));
            exit;
        }
    }
}

// Gerar link de pagamento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['gerar_link'])) {
    // Criar ou atualizar pedido
    if (!$id_pedido) {
        $stmt = $pdo->prepare("INSERT INTO pedidos (id_cliente, status, data_pedido, valor_total) VALUES (?, 'PENDENTE', NOW(), ?)");
        $stmt->execute([$id_cliente, $total ?? 0]);
        $id_pedido = $pdo->lastInsertId();
    }
    
    // Gerar link de pagamento (você pode customizar este link)
    $link_pagamento = "https://seusite.com/pagamento?pedido=" . $id_pedido . "&cliente=" . $id_cliente;
    
    $_SESSION['link_pagamento'] = $link_pagamento;
    $_SESSION['mostrar_qrcode'] = true;
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

// Exibir alertas
if(isset($_SESSION['alerta'])){
    echo($_SESSION['alerta']);
    unset($_SESSION['alerta']);
}

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
    <style>
        .qrcode-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        
        .qrcode-modal.active {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .qrcode-content {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            max-width: 400px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .qrcode-content h3 {
            margin-bottom: 20px;
            color: #333;
        }
        
        .qrcode-content canvas {
            margin: 20px 0;
        }
        
        .qrcode-link {
            word-break: break-all;
            background: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
            margin: 15px 0;
            font-size: 12px;
        }
        
        .qrcode-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }
        
        .qrcode-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .btn-copiar {
            background-color: #4CAF50;
            color: white;
        }
        
        .btn-fechar {
            background-color: #666;
            color: white;
        }
        
        .btn-nova-venda {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }
    </style>
</head>
<body>

<!-- Modal QR Code -->
<div id="qrcodeModal" class="qrcode-modal <?= isset($_SESSION['mostrar_qrcode']) ? 'active' : '' ?>">
    <div class="qrcode-content">
        <h3>Link de Pagamento</h3>
        <div id="qrcode"></div>
        <?php if (isset($_SESSION['link_pagamento'])): ?>
            <div class="qrcode-link">
                <?= htmlspecialchars($_SESSION['link_pagamento']) ?>
            </div>
        <?php endif; ?>
        <div class="qrcode-buttons">
            <button class="btn-copiar" onclick="copiarLink()">
                <i class="fa-solid fa-copy"></i> Copiar Link
            </button>
            <button class="btn-fechar" onclick="fecharModal()">
                <i class="fa-solid fa-times"></i> Fechar
            </button>
        </div>
    </div>
</div>

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

                    <div class="atualizar_status">
                        <form method="POST" style="width: 100%;">
                            <button type="submit" name="gerar_link" class="P_checkout-button">
                                <i class="fa-solid fa-qrcode"></i>
                                Gerar Link de Pagamento
                            </button>
                        </form>
                        
                        <form method="POST" style="width: 100%;">
                            <?php 
                            if ($status_pedido === 'FINALIZADO') {
                                // Pedido finalizado - permitir criar novo
                                echo '<button type="submit" name="novo_pedido" class="P_checkout-button btn-nova-venda">';
                                echo '<i class="fa-solid fa-plus-circle"></i>';
                                echo ' Criar Nova Venda';
                                echo '</button>';
                            } else {
                                // Pedido em andamento - botões de progressão
                                $proximo_status = '';
                                $texto_botao = '';
                                $icone_botao = '';
                                
                                switch($status_pedido) {
                                    case 'PENDENTE':
                                        $proximo_status = 'PAGO';
                                        $texto_botao = 'Confirmar Pagamento';
                                        $icone_botao = 'fa-dollar-sign';
                                        break;
                                    case 'PAGO':
                                        $proximo_status = 'ENVIADO';
                                        $texto_botao = 'Marcar como Enviado';
                                        $icone_botao = 'fa-truck';
                                        break;
                                    case 'ENVIADO':
                                        $proximo_status = 'FINALIZADO';
                                        $texto_botao = 'Finalizar Venda';
                                        $icone_botao = 'fa-check-circle';
                                        break;
                                    default:
                                        $proximo_status = 'PAGO';
                                        $texto_botao = 'Atualizar Pedido';
                                        $icone_botao = 'fa-sync';
                                }
                                
                                echo '<button type="submit" name="atualizar_status" value="' . $proximo_status . '" class="P_checkout-button">';
                                echo '<i class="fa-solid ' . $icone_botao . '"></i>';
                                echo ' ' . $texto_botao;
                                echo '</button>';
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        // Gerar QR Code se o modal estiver ativo
        <?php if (isset($_SESSION['mostrar_qrcode']) && isset($_SESSION['link_pagamento'])): ?>
        document.addEventListener('DOMContentLoaded', function() {
            new QRCode(document.getElementById("qrcode"), {
                text: "<?= $_SESSION['link_pagamento'] ?>",
                width: 256,
                height: 256,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });
        });
        <?php 
            unset($_SESSION['mostrar_qrcode']);
            unset($_SESSION['link_pagamento']);
        endif; 
        ?>
        
        function copiarLink() {
            const link = document.querySelector('.qrcode-link').textContent.trim();
            navigator.clipboard.writeText(link).then(function() {
                alert('Link copiado para a área de transferência!');
            });
        }
        
        function fecharModal() {
            document.getElementById('qrcodeModal').classList.remove('active');
        }
        
        // Fechar modal ao clicar fora
        document.getElementById('qrcodeModal').addEventListener('click', function(e) {
            if (e.target === this) {
                fecharModal();
            }
        });
    </script>
    <script src="../../PUBLIC/JS/script-info_vendas.js"></script>
    <script src="../../PUBLIC/JS/script-tema.js"></script>

</body>
</html>