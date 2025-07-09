<?php

include "../../INCLUDE/Menu_vend.php";


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Produto</title>
    <link rel="stylesheet" href="../../PUBLIC/css/venda-info-vend.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <main class="jp_main-content">
        <div class="responsividade">
            <div class="back-button">
            <a href="lista-vendas.php" class="ym_link-volta"> <i class="fa-solid fa-arrow-left"></i> </a>
            </div>

            <div class="P_cart-table">
                <div class="P_table-header">
                    <div class="P_header-produto">Produto</div>
                    <div class="P_header-preco">Preço</div>   
                    <div class="P_header-quantidade">Quantidade</div>
                    <div class="P_header-total">Total</div>
                </div>

                <div class="P_cart-item">
                
                    <div class="P_item-produto">
                        <div class="P_product-image"></div>
                        <span>Produto</span>
                    </div>
                    <div class="P_item-preco">R$1000</div>
                    <div class="P_item-quantidade">
                        <span class="P_quantity-value" id="valor">1</span>
                    </div>
                    <div class="P_item-total">R$1000</div>
                </div>
            </div>

            <div class="P_cart-summary">

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
                    </div>
                    <div class="P_customer-date">
                        <div>Data de criação</div>
                        <div>16/08</div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="../../PUBLIC/JS/script-info_vendas.js"></script>
</body>
</html>