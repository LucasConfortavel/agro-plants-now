<?php
include "../../INCLUDE/Menu_vend.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agro Plants NOW</title>
    <link rel="stylesheet" href="../../PUBLIC/css/vendas-adm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <main class="jp_main-content">

        <section class="ym_section">
            <div class="ym_area-notificacoes">
                <div class="ym_notificacoes">
                    <btn class="ym_sino"><img src="../../PUBLIC/css/img/Frame.svg" alt=""></btn>
                    <a href="" class="ym_perfil"><img src="/projeto_agro_plants_now1/PUBLIC/img/user.svg" alt=""></a>
                </div>
            </div>

            <input class="ym_pesquisa" type="text" placeholder="Pesquise por um vendedor">

            <div class="ym_area-btn-superior">
                <a href="" class="ym_btn-superior">Cadastrar venda</a>
            </div>

            <div class="ym_area-table">
                <table class="ym_tabela">

                    <thead class="ym_thead">
                        <tr class="ym_tr">
                            <th class="ym_th" style="color:white;">Nome</th>
                            <th class="ym_th" style="color:white;">Data de Cadastro</th>
                            <th class="ym_th"></th>
                    </thead>

                    <tbody class="ym_tbody">

                        <?php
                            echo'
                            <tr class="ym_tr">
                                <td class="ym_td">12/08</td>
                                <td class="ym_td">12/08</td>
                                <td class="ym_td"><a href=""><img src="/projeto_agro_plants_now1/PUBLIC/img/Frame.png" alt=""></a></td>
                            </tr>
                            ';
                        ?>

                    </tbody>
                </table>
            </div>

        </section>
    </main>

</body>
</html>