<?php

include "../../INCLUDE/Menu_adm.php";
include "../../INCLUDE/btn-notificacao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações de Venda</title>
    <link rel="stylesheet" href="../../PUBLIC/css/venda-info.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <main class="jp_main-content">
        <div class="back-button">
            <a href="vendas-adm.php" class="ym_link-volta"> <i class="fa-solid fa-arrow-left"></i> </a>
        </div>
        <div class="P_cart-table">
            <div class="P_table-header">
                <div class="P_header-produto">Produto</div>
                <div class="P_header-preco">Preço</div>   
                <div class="P_header-quantidade">Quantidade</div>
                <div class="P_header-total">Total</div>
            </div>

            <div class="P_cart-item">
                <div class="P_item-remove">
                    <button class="P_remove-button">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="P_item-produto">
                    <div class="P_product-image"></div>
                    <span>Produto</span>
                </div>
                <div class="P_item-preco">R$1000</div>
                <div class="P_item-quantidade">
                    <button class="P_quantity-button" id="menos">−</button>
                    <span class="P_quantity-value" id="valor">1</span>
                    <button class="P_quantity-button" id="mais">+</button>
                </div>
                <div class="P_item-total">R$1000</div>
            </div>
        </div>

        <div class="P_cart-summary">
            <div class="P_coupon-section">
                <div class="P_coupon-icon">
                    <i class="fa-solid fa-ticket"></i>
                </div>
                <input type="text" placeholder="Cupom" class="coupon-input">
                <a class="P_apply-button" href="../../pop-up/pop-up-cupon_Adicionar.php">Aplicar</a>
            </div>

            <div class="P_details-section">
                <h3>Detalhes</h3>
                
                <div class="P_detail-row">
                    <span>Subtotal</span>
                    <span class="P_price">R$1000</span>
                </div>
                
                <div class="P_detail-row">
                    <span>Desconto</span>
                    <span class="P_price discount">R$0</span>
                </div>
                
                <div class="P_divider"></div>
                
                <div class="P_detail-row total-row">
                    <span>Total</span>
                    <span class="P_price total">R$1000</span>
                </div>
            </div>

        </div>

        <div class="P_customer-info">
            <div class="P_customer-details">
                <div class="P_customer-label">Cliente</div>
                <div class="P_customer-name">
                    Rafael Germinari
                    <button class="P_edit-button">
                        <i class="P_fa-solid fa-pen"></i>
                    </button>
                </div>
                <div class="P_customer-date">
                    <div>Data de criação</div>
                    <div>16/08</div>
                </div>
            </div>
            
            <div class="P_action-buttons">
                <button class="P_trash-button">
                    <i class="P_fa-regular fa-trash-can"></i>
                </button>
                <a class="P_generate-link-button" href="../../pop-up-link.php">
                    Gerar link de venda
                </a>
            </div>
        </div>
    </main>

    <script src="../../PUBLIC/JS/script-info_vendas.js"></script>
</body>
</html>
