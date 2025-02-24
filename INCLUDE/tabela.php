<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agro Plants NOW</title>
    <link rel="stylesheet" href="/projeto_agro_plants_now1/PUBLIC/css/tabela.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="jp_hamburger-menu">
        <div class="jp_hamburger-line"></div>
        <div class="jp_hamburger-line"></div>
        <div class="jp_hamburger-line"></div>
    </div>

    <div class="jp_container">
        <!-- Sidebar -->
        <aside class="jp_sidebar">
            <div class="jp_logo">
                <!-- <img src="../img/logo_agro.png" alt="Logo"> -->
                <img src="/projeto_agro_plants_now1/PUBLIC/img/logo_agro.png" alt="Logo">
            </div>
            <nav>
                <ul>
                    <li class="jp_active"><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/grid.svg" alt=""> Dashboard</li>
                    <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/box.svg" alt=""> Catálogo</li>
                    <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/users.svg" alt=""> Clientes</li>
                    <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/shopping-cart.svg" alt=""> Vendas</li>
                    <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/tag.svg" alt=""> Cupons</li>
                </ul>
            </nav>
            <div class="jp_bottom-menu">
                <ul>
                    <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/settings.svg" alt=""> Ajustes</li>
                    <li><img src="https://raw.githubusercontent.com/feathericons/feather/master/icons/log-out.svg" alt=""> Sair</li>
                </ul>
            </div>
        </aside>


        <!-- Main Content -->
        <main class="jp_main-content">

            <section class="YM-section">
                <div class="YM-area-table">

                    <table class="YM-tabela">

                        <thead class="YM-thead">
                            <tr class="YM-tr">
                                <th class="YM-th" style="color:white;">Nome</th>
                                <th class="YM-th" style="color:white;">Data de Cadastro</th>
                                <th class="YM-th"></th>
                        </thead>

                        <tbody class="YM-tbody">

                            <?php
                                echo'
                                <tr class="YM-tr">
                                    <td class="YM-td">12/08</td>
                                    <td class="YM-td">12/08</td>
                                    <td class="YM-td"><a href=""><img src="../img/Frame.png" alt=""></a></td>
                                </tr>
                                ';
                            ?>

                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
    <script src="/projeto_agro_plants_now1/PUBLIC/JS/script.js"></script>
    <!-- <script src="script.js"></script> -->
</body>
</html>