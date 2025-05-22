<?php
include "../../INCLUDE/Menu_adm.php";
include "../../INCLUDE/btn-notificacao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agro Plants NOW</title>
    <link rel="stylesheet" href="../../PUBLIC/css/venda-info.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <main class="jp_main-content">
        <div class="back-button">
            <a href="vendas-adm.php" class="ym_link-volta"> <i class="fa-solid fa-arrow-left"></i> </a>
        </div>

        <div class="cart-table">
            <div class="table-header">
                <div class="header-produto">Produto</div>
                <div class="header-preco">Preço</div>
                <div class="header-quantidade">Quantidade</div>
                <div class="header-total">Total</div>
            </div>

            <div class="cart-item">
                <div class="item-remove">
                    <button class="remove-button">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="item-produto">
                    <div class="product-image"></div>
                    <span>Produto</span>
                </div>
                <div class="item-preco">R$1000</div>
                <div class="item-quantidade">
                    <button class="quantity-button" id="menos">−</button>
                    <span class="quantity-value" id="valor">1</span>
                    <button class="quantity-button" id="mais">+</button>
                </div>
                <div class="item-total">R$1000</div>
            </div>
        </div>

        <div class="cart-summary">
            <div class="coupon-section">
                <div class="coupon-icon">
                    <i class="fa-solid fa-ticket"></i>
                </div>
                <input type="text" placeholder="Cupom" class="coupon-input">
                <button class="apply-button">Aplicar</button>
            </div>

            <div class="details-section">
                <h3>Detalhes</h3>
                
                <div class="detail-row">
                    <span>Subtotal</span>
                    <span class="price">R$1000</span>
                </div>
                
                <div class="detail-row">
                    <span>Desconto</span>
                    <span class="price discount">R$0</span>
                </div>
                
                <div class="divider"></div>
                
                <div class="detail-row total-row">
                    <span>Total</span>
                    <span class="price total">R$1000</span>
                </div>
            </div>

        </div>

        <div class="customer-info">
            <div class="customer-details">
                <div class="customer-label">Cliente</div>
                <div class="customer-name">
                    Rafael Germinari
                    <button class="edit-button">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                </div>
                <div class="customer-date">
                    <div>Data de criação</div>
                    <div>16/08</div>
                </div>
            </div>
            
            <div class="action-buttons">
                <button class="trash-button">
                    <i class="fa-regular fa-trash-can"></i>
                </button>
                <button class="generate-link-button">
                    <a href="../pop-up/pop-up-link.php">Gerar link de venda</a>
                </button>
            </div>
        </div>
    </main>

    <script src="../../PUBLIC/JS/script-info_vendas.js"></script>
</body>
</html>
