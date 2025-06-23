<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../PUBLIC/css/style_menu.css">
</head>
<body>
    <div class="jp_hamburger-menu">
        <div class="jp_hamburger-line"></div>
        <div class="jp_hamburger-line"></div>
        <div class="jp_hamburger-line"></div>
    </div>  

    <div class="jp_overlay"></div>

    <!-- Sidebar -->
    <aside class="jp_sidebar">
        <div class="jp_logo">
            <img src="../../PUBLIC/img/img_logo.png" alt="Logo">
        </div>
        <nav>
            <ul>
                <button onclick= "window.location.href='../../VIEW/adm/vcl-dashboard-adm.php'" data-page="dashboard"><li> <img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/grid.svg"> Dashboard </li></button>
    
                <button onclick= "window.location.href='../../VIEW/adm/produtos-tudo.php'"   data-page="catalogo"><li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/box.svg" alt=""> Catálogo</li></button>

                <button onclick= "window.location.href=''"   data-page="clientes"><li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/users.svg" alt=""> Clientes</button></li>

                <button onclick= "window.location.href='../../VIEW/adm/lista-vendedores-adm.php'"   data-page="vendedores"><li> <img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/user.svg" alt=""> Vendedores</li></button>

                <button onclick= "window.location.href='../../VIEW/adm/vendas-adm.php'" data-page="vendas"><li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/shopping-cart.svg" alt=""> Vendas</li></button>

                <button onclick= "window.location.href='../../VIEW/adm/Rel.php'" data-page="relatorios"><li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/file-text.svg" alt=""> Relatórios</li></button>

                <button onclick= "window.location.href='../../VIEW/adm/Cupom_adm.php'" data-page="cupons"><li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/tag.svg" alt=""> Cupons</li></button>
            </ul>
        </nav>
        <div class="jp_bottom-menu">
            <ul>
                <li><button onclick= "window.location.href='../../VIEW/adm/ajustes-informaçoes-adm.php'"  data-page="ajustes"><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/settings.svg" alt=""> Ajustes</button></li>
                <li><button onclick= "window.location.href='../../VIEW/paginas-iniciais/landing_page.php'" data-page="sair"><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/log-out.svg" alt=""> Sair</button></li>
            </ul>
        </div>
    </aside>
    
    <script src="/projeto_agro_plants_now1/PUBLIC/JS/script.js"></script>
</body>
</html>

