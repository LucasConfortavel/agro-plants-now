<?php
include "../../INCLUDE/vlibras.php";
include "../../INCLUDE/Menu_adm.php";
include "../../CONTROLLER/VendaController.php";
include "../../CONTROLLER/ClienteController.php";
include "../../CONTROLLER/UsuarioController.php";

$controler_venda = new VendaController(); 
$controler_cliente = new ClienteController();
$controler_usuario = new UsuarioController();

$venda = $cliente = $usuario = null;
$itens = [];

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $venda = $controler_venda->mostrar($id);
    $itens_venda = $controler_venda->listarItensDaVenda($id);


    if ($venda) {
        $cliente = $controler_cliente->mostrar($venda['id_cliente']);
        $usuario = $controler_usuario->mostrar($venda['id_vendedor']);
        $itens = $controler_venda->listarItensDaVenda($id); // Você precisa ter este método no controller
    } else {
        echo "<script>alert('Venda não encontrada.'); window.location.href='vendas-adm.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID inválido.'); window.location.href='vendas-adm.php';</script>";
    exit;
}

// Cálculo do subtotal
$subtotal = array_reduce($itens, function($carry, $item) {
    return $carry + ($item['preco_unitario'] * $item['quantidade']);
}, 0);

$desconto = 0; // Pode ser dinâmico se houver
$total = $venda['total'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações de Venda</title>
    <link rel="stylesheet" href="../../PUBLIC/css/venda-info-administrador.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>     
<body>
    <!-- pop-up -->
    <div class="ym_popup-overlay">
        <div class="ym_popup-content">
            <div class="ym_area-superior-popup"></div>
            <div class="ym_conteudo-popup"></div>
        </div>
    </div>
    <main class="jp_main-content">
        <div class="back-button">
            <a href="vendas-adm.php" class="ym_link-volta"> <i class="fa-solid fa-arrow-left"></i> </a>
        </div>

        <div class="P_customer-info">
            <div class="P_customer-details">
                <div class="P_customer-label">Cliente</div>
                <div class="P_customer-name"><?= htmlspecialchars($cliente['nome']) ?></div>
                <div class="P_customer-date">
                    <div>Data de criação</div>
                    <div><?= htmlspecialchars($venda['data_venda']) ?></div>
                </div>
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

            <?php foreach ($itens_venda as $item): ?>
                <div class="P_cart-item">
                    <div class="P_item-id"><?= htmlspecialchars($item['id_produto']) ?></div>
                    <div class="P_item-produto">
                        <div class="P_product-image"></div>
                        <span><?= htmlspecialchars($item['nome_produto']) ?></span>
                    </div>
                    <div class="P_item-preco">R$<?= number_format($item['preco_unitario'], 2, ',', '.') ?></div>
                    <div class="P_item-quantidade">
                        <span class="P_quantity-value"><?= $item['quantidade'] ?></span>
                    </div>
                    <div class="P_item-total">
                        R$<?= number_format($item['preco_unitario'] * $item['quantidade'], 2, ',', '.') ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="P_cart-summary">
            <div class="P_details-section">
                <h3>Detalhes</h3>
                <div class="P_detail-row">
                    <span>Subtotal</span>
                    <span class="P_price">R$<?= number_format($subtotal, 2, ',', '.'); ?></span>
                </div>
                <div class="P_detail-row">
                    <span>Desconto</span>
                    <span class="P_price discount">R$<?= number_format($desconto, 2, ',', '.'); ?></span>
                </div>
                <div class="P_divider"></div>
                <div class="P_detail-row total-row">
                    <span>Total</span>
                    <span class="P_price total">R$<?= number_format($total, 2, ',', '.'); ?></span>
                </div>
                <div class="P_detail-row status-row">
                    <span>Status da Compra</span>  
                    <span class="P_price total"><?= htmlspecialchars($venda['status']); ?></span>
                </div>
            </div>
        </div>

        <div class="back-button-mobile">
            <a href="vendas-adm.php" class="ym_link-volta2"> <i class="fa-solid fa-arrow-left"></i> </a>
        </div>
    </main>

    <script src="../../PUBLIC/JS/script-info_vendas.js"></script>
    <script src="../../PUBLIC/JS/script-pop-up.js"></script>
</body>
</html>
