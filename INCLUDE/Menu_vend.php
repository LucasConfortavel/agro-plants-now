

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
</head>
<body>
    <div class="jp_hamburger-menu">
        <div class="jp_hamburger-line"></div>
        <div class="jp_hamburger-line"></div>
        <div class="jp_hamburger-line"></div>
    </div>

        <!-- Sidebar -->
        <aside class="jp_sidebar">
            <div class="jp_logo">
                <img src="../../PUBLIC/img/img_logo.png" alt="Logo">
            </div>
            <nav>
                <ul>
                    <button onclick= "window.location.href='../../VIEW/vend/dashboard_vendedor.php'"><li class="jp_active"><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/grid.svg" alt=""> Dashboard</li></button> 

                    <button onclick= "window.location.href='../../VIEW/vend/produtos-tudo.php'"><li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/box.svg" alt=""> Catálogo</li></button> 

                    <button onclick= "window.location.href='../../VIEW/vend/lista-clientes.php'"><li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/users.svg" alt=""> Clientes</li></button>

                    <button onclick= "window.location.href='../../VIEW/vend/lista-vendas.php'"><li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/shopping-cart.svg" alt=""> Vendas</li></button> 

                    <button onclick= "window.location.href='../../VIEW/vend/Cupom_vendedor.php'"><li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/tag.svg" alt=""> Cupons</li></button> 
                </ul>
            </nav>
            <div class="jp_bottom-menu">
                <ul>
                    <button onclick= "window.location.href='../../VIEW/vend/ajustes-informaçoes-vend.php'"><li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/settings.svg" alt=""> Ajustes</li></button>

                    <button onclick= "window.location.href='../../VIEW/paginas-iniciais/landing_page.php'"><li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/log-out.svg" alt=""> Sair</li></button>
                </ul>
            </div>
        </aside>
    </div>

    <script src="../PUBLIC/JS/script.js"></script>

</body>
</html>
