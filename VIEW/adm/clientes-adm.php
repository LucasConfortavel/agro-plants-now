<?php
$clientes = [
    ['id' => 1, 'nome' => 'Rafael Germinari', 'data_cadastro' => '12/08'],
    ['id' => 2, 'nome' => 'Calebe Lemos', 'data_cadastro' => '12/08'],
    ['id' => 3, 'nome' => 'Ederson Costa', 'data_cadastro' => '12/08'],
    ['id' => 4, 'nome' => 'Enilda Rosa', 'data_cadastro' => '12/08'],
    ['id' => 5, 'nome' => 'Thiago Almeida', 'data_cadastro' => '12/08'],
    ['id' => 6, 'nome' => 'Pamela Ferreira', 'data_cadastro' => '12/08'],
    ['id' => 7, 'nome' => 'João Silva', 'data_cadastro' => '13/08'],
    ['id' => 8, 'nome' => 'Maria Santos', 'data_cadastro' => '13/08'],
    ['id' => 9, 'nome' => 'Pedro Oliveira', 'data_cadastro' => '14/08'],
    ['id' => 10, 'nome' => 'Ana Costa', 'data_cadastro' => '14/08'],
    ['id' => 11, 'nome' => 'Carlos Pereira', 'data_cadastro' => '15/08'],
    ['id' => 12, 'nome' => 'Lucia Fernandes', 'data_cadastro' => '15/08'],
    ['id' => 13, 'nome' => 'Roberto Lima', 'data_cadastro' => '16/08'],
    ['id' => 14, 'nome' => 'Sandra Martins', 'data_cadastro' => '16/08'],
    ['id' => 15, 'nome' => 'Fernando Rocha', 'data_cadastro' => '17/08'],
    ['id' => 16, 'nome' => 'Carla Souza', 'data_cadastro' => '17/08'],
    ['id' => 17, 'nome' => 'Marcos Ribeiro', 'data_cadastro' => '18/08'],
    ['id' => 18, 'nome' => 'Patricia Gomes', 'data_cadastro' => '18/08']
];

$itens_por_pagina = 6;
$total_clientes = count($clientes);
$total_paginas = ceil($total_clientes / $itens_por_pagina);

include '../../INCLUDE/Menu_adm.php';

$BP = '../../INCLUDE/ME';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Clientes</title>
    <link rel="stylesheet" href="../../PUBLIC/css/lista-vendedores-adm.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/clientes-adm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body>
    <main class="jp_main-content">
        <div class="sab-engloba-tudo">
            <section class="ym_section">

                <div class="ym_area-barra-pesquisa">
                    <div class="ls_pesquisa-barra">
                        <input type="text" placeholder="Pesquise por um vendedor">
                        <img src="../../PUBLIC/img/img_lupa.png" alt="lupa">
                    </div>
                </div>

                <div class="ym_area-btn-superior">
                    <a href="../../VIEW/pop-up/pop-up_remover_vendedor.php" class="ym_btn-superior">Remover vendedor</a>
                    <a href="../../VIEW/pop-up/cadastrar_vendedor.php" class="ym_btn-superior">Cadastrar vendedor</a>
                </div>



            <div class="jc_table-container">
                <table class="jc_tabela-clientes">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data de cadastro</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="clientes-tbody">
                    </tbody>
                </table>

                <div class="jc_paginacao">
                    <button id="btn-prev" class="jc_btn-paginacao" onclick="paginaAnterior()">←</button>
                    <div id="numeros-paginacao"></div>
                    <button id="btn-next" class="jc_btn-paginacao" onclick="proximaPagina()">→</button>
                </div>
            </div>

        </div>
        </div> 
    
    

    </main>
    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/clientes-adm.js"></script>

</body>
</html>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="clientes-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <main class="jp_main-content">
        <div class="jc_content">

            <div class="jc_table-container">
                <table class="jc_tabela-clientes">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data de cadastro</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="clientes-tbody">
                    </tbody>
                </table>
            </div>

            <!-- Paginação movida para fora do container -->
            <div class="jc_paginacao">
                <button id="btn-prev" class="jc_btn-paginacao" onclick="paginaAnterior()">←</button>
                <div id="numeros-paginacao"></div>
                <button id="btn-next" class="jc_btn-paginacao" onclick="proximaPagina()">→</button>
            </div>

        </div>
    </main>

    <script src="clientes-script.js"></script>
</body>
</html>
