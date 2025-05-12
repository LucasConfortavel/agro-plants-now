<?php

include "../../INCLUDE/Menu_adm.php";


?>

<main class="jp_main-content">

</main>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Página de Vendas</title>
  <link rel="stylesheet" href="../../PUBLIC/css/venda-info-adm.css" />
  <link rel="stylesheet" href="../../PUBLIC/css/menu-venda-info-adm.css" />
</head>

<body>

  <!-- <main class="jp_main-content"> -->
  
    <header class="er_notificacao_cabecario">   
        <div class="er_area-notificacao">
            <a class="er_link-notificacao"  href="#"><img class="er_img-notificacao" src="../../PUBLIC/img/Frame.svg" alt=""></a>
            <a class="er_link-usuario" href="#"><img class="er_img-usuario" src="../../PUBLIC/img/user.svg" alt=""></a>                    
        </div>
    </header>
    
        <div class="jp_container">
            <aside class="jp_sidebar">
            <div class="jp_logo">
                <img src="../../PUBLIC/img/mobile-logo 2.svg" alt="Logo">
            </div>
            <nav>
                <ul>
                <li class="jp_active"><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/grid.svg" alt=""> Dashboard</li>
                <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/box.svg" alt=""> Catálogo</li>
                <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/users.svg" alt=""> Clientes</li>
                <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/user.svg" alt=""> Vendedores</li>
                <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/shopping-cart.svg" alt=""> Vendas</li>
                <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/file-text.svg" alt=""> Relatórios</li>
                <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/tag.svg" alt=""> Cupons</li>
                </ul>
            </nav>
            <footer class="jp_bottom-menu">
                <ul>
                <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/settings.svg" alt=""> Ajustes</li>
                <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/log-out.svg" alt=""> Sair</li>
                </ul>
            </footer>
            </aside>


        

            <main class="jp_main-content">
                <section class="corpo-jv">
                    <header class="corpo1-jv">
                    <button class="funcionalidade">
                        <img class="furia_da_noite" src="../../PUBLIC/img/Frame (3).svg" alt="">
                    </button>
                    <div class="presidio-jv">
                        <span class="Produto-jv">Produto</span>
                        <span class="preco-jv">Preço</span>
                        <span class="Quantidade-jv">Quantidade</span>
                        <span class="total-jv">Total</span>
                    </div>
                    </header>

                    <article class="corpo1-jv">
                    <button class="funcionalidade">
                        <img class="banguela" src="../../PUBLIC/img/Frame (2).svg" alt="">
                    </button>
                    <div class="soliena-jv">
                        <span class="Produtoo-jv">Produto</span>
                        <span class="valor-jv">R$1000</span>
                        <div class="barra-jv">
                        <button class="adicionar-jv">-</button>
                        <span>1</span>
                        <button class="adicionar-jv">+</button>
                        </div>
                        <span class="valor1-jv">R$1000</span>
                        <!-- <button class="funcionalidade">
                            <img class="oi" src="../img/Frame (6).svg" alt=""> 
                        </button> -->
                    </div>
                    </article>

                    <section class="barra_direita-jv">
                    <form class="forma-jv">
                        <button class="funcionalidade">
                        <img class="eneas" src="../../PUBLIC/img/Frame (4).svg" alt="">
                        </button>
                        <input type="text" name="cupom" id="cupom" class="cupom-input" placeholder="   Cupom">
                        <button type="submit" class="sally-jv">Aplicar</button>
                    </form>

                    <div class="barra_detalhes-jv">
                        <strong class="wiliam_bonner">Detalhes</strong>
                    </div>

                    <div class="formato-jv">
                        <div><span class="Subtotal-jv">Subtotal</span> <span class="valor3-jv">R$1000</span></div>
                        <div><span class="desconto-jv">Desconto</span> <span class="valor4-jv">R$0</span></div>
                    </div>

                    <hr class="linha-jv">

                    <div class="espaço-jv">
                        <div class="espaço2-jv">
                        <span class="cor-jv">Total</span>
                        <strong class="cor1-jv">R$1000</strong>
                        <div class="botao-jv">
                            <button class="gerar_link-jv">Gerar link de venda</button>
                        </div>
                        </div>
                    </div>
                    </section>

                    <section class="forma2-jv">
                    <div class="forma3-jv">
                        <div class="ceta-jv">
                        <button class="funcionalidade"> 
                        <img src="../../PUBLIC/img/Frame (6).svg" alt="">
                        </button>
                        </div>
                        <hr>
                        <div class="venice-jv">
                        <button class="funcionalidade">
                            <img src="../../PUBLIC/img/Frame (5).svg" alt="">
                        </button>
                        </div>
                        <div class="cliente-jv">
                        <span class="terios">Cliente</span>
                        </div>
                        <div class="Cliente-jv">
                        <span class="pessoa-jv">
                            Sonic the hedgehog
                            <button class="funcionalidade">
                            <img class="wisper" src="../../PUBLIC/img/SVGRepo_iconCarrier (1).svg" alt="Editar">
                            </button>
                        </span>
                        </div>
                        <span class="data-jv">Data de criação</span>
                        <p class="dia-jv">23/07</p>
                    </div>
                    </section>
                </section>
            </main>
        </div>

        <script src="script.js"></script>
        <div class="icone-canto-direito">
            <button class="funcionalidade">
            <img src="../../PUBLIC/img/" alt="">
            </button>
        </div>
 </main>
</body>
</html>