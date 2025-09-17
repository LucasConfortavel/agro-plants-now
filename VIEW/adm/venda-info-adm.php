<?php

include "../../INCLUDE/Menu_adm.php";
include "../../CONTROLLER/VendaController.php";
include "../../CONTROLLER/ClienteController.php";
include "../../CONTROLLER/UsuarioController.php";

$controler_venda = new VendaController(); 
$controler_cliente = new ClienteController();
$controler_usuario = new UsuarioController();

if(isset($_GET['id'])){
        $id=$_GET["id"];
        $venda = $controler_venda->mostrar($id);
        $cliente = $controler_cliente->mostrar($venda['id_cliente']);
        $usuario = $controler_usuario->mostrar($venda['id_vendedor']);

}

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
    <div class="ym_popup-overlay" >
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
                <div class="P_customer-name">
                    <?= $cliente['nome']?>
                </div>
                <div class="P_customer-date">
                    <div>Data de criação</div>
                    <div><?= $venda['data_venda']?></div>
                </div>
            </div>
            
            <div class="P_action-buttons">

                <!-- <a class="ym_btn-padrao" onclick="abrirPopup('../pop-up/pop-up-link.php','O link foi criado')">

                    Gerar link de venda
                </a> -->
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

            <div class="P_cart-item">
                <div class="P_item-id">
                    <span><?= $venda["id"];?></span>
                </div>
                <!-- <div class="P_item-remove">
                    <button class="P_remove-button">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div> -->
                <div class="P_item-produto">
                    <div class="P_product-image"></div>
                    <span>Produto</span>
                </div>
                <div class="P_item-preco">R$1000</div>
                <div class="P_item-quantidade">
                    <!-- <button class="P_quantity-button" id="menos">−</button> -->
                    <span class="P_quantity-value" id="valor">1</span>
                    <!-- <button class="P_quantity-button" id="mais">+</button> -->
                </div>
                <div class="P_item-total"><?= $venda['total']?></div>
            </div>
        </div>
        
        <div class="P_cart-summary">
            <!-- <div class="P_coupon-section">
                <div class="P_coupon-icon">
                    <i class="fa-solid fa-ticket"></i>
                </div>
                <input type="text" placeholder="Cupom" class="ym_input-padrao">
                <a class="ym_btn-padrao" onclick="abrirPopup('../pop-up/pop-up_cupom_Adicionado.php','Cupom aplicado <i class=\'fa-solid fa-ticket\'></i>')">Aplicar</a>

            </div> -->

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
                    <span class="P_price total"><?= $venda['total']?></span>
                </div>
                <div class="P_detail-row status-row">
                    <span>Status da Compra</span>  
                    <span class="P_price total">Pago</span>
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
