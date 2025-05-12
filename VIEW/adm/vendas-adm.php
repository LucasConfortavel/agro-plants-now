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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body>  
    <main class="jp_main-content">
        <div class="sab-engloba-tudo">
            <section class="ym_section">
                <div class="ym_area-notificacoes">
                    <div class="ym_notificacoes">
                        <btn class="ym_sino"><img src="../../PUBLIC/img/sino.svg" alt=""></btn>
                        <a href="" class="ym_perfil"><img src="../../PUBLIC/img/user.svg" alt=""></a>
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
                                    <th class="ym_th" style="color:white;">Código</th>
                                    <th class="ym_th" style="color:white;">Porcentagem</th>
                                    <th class="ym_th" style="color:white;">Data</th>
                                
                                    <th class="ym_th" style="color:white;">Estado</th>
                                    <th class="ym_th"></th>
                                <tr>
                                
                            </thead>

                            <tbody class="ym_tbody">

                                <?php
                                    echo'
                                    <tr class="ym_tr">
                                        <td class="ym_td">#paulorojas100</td>
                                        <td class="ym_td sb_td">100%</td>
                                        <td class="ym_td">16/08</td>
                                        <td class="ym_td">Ativo</td>
                                        <td class="ym_td "><a href=""><i class="fa-solid fa-circle-minus sab_color"></i></a></td>
                                    </tr>
                                    ';
                                ?>

                            </tbody>
                        </table>
                
                    </div>
            </section>
        </div> 
    
    

    </main>
</body>
</html>

<script src="../../PUBLIC/JS/script.js"></script>
