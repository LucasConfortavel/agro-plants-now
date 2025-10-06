<?php
    include "../../INCLUDE/Menu_adm.php";
    include "../../INCLUDE/btn-notificacao.php";
    include "../../CONTROLLER/ProdutoController.php";
    include "../../INCLUDE/vlibras.php";
    include "../../CONTROLLER/VendaController.php";
    include "../../CONTROLLER/ClienteController.php";
    include "../../CONTROLLER/UsuarioController.php";

    $produtoController = new ProdutoController();
    $produtos = $produtoController->index();
    
    $limite = 5;
    $alertas = [];
    
    if (!isset($produtos['error'])) {
        foreach ($produtos as $produto) {
            if ($produto['quantidade'] <= $limite) {
                $alertas[] = "O produto <b>{$produto['nome']}</b> está com apenas <b>{$produto['quantidade']}</b> unidades restantes!";
            }
        }
    }

    $venda_control = new VendaController();
    $vendas_totais = $venda_control->index();
    $total_vendido = 0;
    $numero_vendas = 0;

    $data_grafico = [0,0,0,0,0,0,0,0,0,0,0,0];

    foreach ($vendas_totais as $venda) {
        $total_vendido += $venda['total'];
        $numero_vendas += 1;
        $data_venda = new DateTime($venda['data_venda']);
        for ($i=0; $i <= 12; $i++) { 
            if($data_venda->format("m") == $i){
                $data_grafico[$i-1] = $data_grafico[$i-1] + 1;
            }
        }
    } 

    $cliente_control = new ClienteController();
    $clientes_totais = $cliente_control->index();
    $total_de_clientes = count($clientes_totais);

    
    $vendedores_control = new UsuarioController();
    $vendedores_totais = $vendedores_control->index('vendedor');
    $TotalVendedor = count($vendedores_totais);


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Vendas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../PUBLIC/css/dashboard-adm.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <main class="jp_main-content">
      
        <h1 class="ym_titulo">Dashboard</h1> 


        <div class="jp_cards-container">
            <div class="jp_card">
                <div class="jp_card-header">
                    <div class="jp_card-title">Total Vendido</div>
                    <div class="jp_card-indicator">22.0%</div>
                </div>
                <div class="jp_card-value">R$<?= $total_vendido?></div>
            </div>
            <div class="jp_card">
                <div class="jp_card-header">
                    <div class="jp_card-title">Total de Pedidos</div>
                    <div class="jp_card-indicator">22.0%</div>
                </div>
                <div class="jp_card-value"><?= $numero_vendas;?></div>
            </div>
            <div class="jp_card">
                <div class="jp_card-header">
                    <div class="jp_card-title">Vendedores</div>
                    <div class="jp_card-indicator">22.0%</div>
                </div>
                <div class="jp_card-value"><?=$TotalVendedor?></div>
            </div>
            <div class="jp_card">
                <div class="jp_card-header">
                    <div class="jp_card-title">Cliente Cadastrado</div>
                    <div class="jp_card-indicator">22.0%</div>
                </div>
                <div class="jp_card-value"><?=$total_de_clientes?></div>
            </div>
        </div>

        <div class="jp_sales-section">
            <div class="jp_sales-title">Últimas vendas</div>
            <table class="jp_sales-table">
                <thead>
                    <tr class="vc_header-planilha">
                        <th>Código</th>
                        <th>Vendedor</th>
                        <th>Produtos</th>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Comissão</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Quantidade de itens por página
                        $limite = 5;

                        // Página atual (pega da URL, se não tiver assume 1)
                        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

                        // Calcula o offset
                        $offset = ($pagina - 1) * $limite;

                        // Fatia apenas as vendas da página atual
                        $vendas_pagina = array_slice($vendas_totais, $offset, $limite);

                        $total_vendas = count($vendas_totais);

                        // Exibe vendas da página
                        foreach ($vendas_pagina as $venda) {
                            // Busca cliente e vendedor
                            $cliente = $cliente_control->mostrar($venda['id_cliente']);
                            $vendedor = $vendedores_control->mostrar($venda['id_vendedor']);

                            // Calcula comissão (exemplo: 5%)
                            $comissao = $venda['total'] * 0.05;

                            echo '
                            <tr>
                                <td>'.$venda['id'].'</td>
                                <td>'.$vendedor['nome'].'</td>
                                <td>'.$cliente['nome'].'</td>
                                <td>'.date('d/m/Y', strtotime($venda['data_venda'])).'</td>
                                <td class="jp_sales-value">R$ '.number_format($venda['total'], 2, ',', '.').'</td>
                                <td class="jp_sales-value">R$ '.number_format($comissao, 2, ',', '.').'</td>
                            </tr>';
                        }
                    ?>  
                    </tbody>

            </table>
            <div class="jp_pagination">
                <?php
                    $total_paginas = ceil($total_vendas / $limite);

                    // Botão Anterior (seta esquerda)
                    if ($pagina > 1) {
                        echo '<a class="jp_arrow" href="?pagina='.($pagina - 1).'"><i class="fas fa-arrow-left"></i></a>';
                    }

                    // Números das páginas
                    for ($i = 1; $i <= $total_paginas; $i++) {
                        $classe = ($i == $pagina) ? 'style="font-weight:bold;"' : '';
                        echo '<a '.$classe.' href="?pagina='.$i.'">'.$i.'</a>';
                    }

                    // Botão Próximo (seta direita)
                    if ($pagina < $total_paginas) {
                        echo '<a class="jp_arrow" href="?pagina='.($pagina + 1).'"><i class="fas fa-arrow-right"></i></a>';
                    }
                ?>
            </div>
        </div>

        <div class="jp_chart-section">
            <div class="jp_chart-header">

                <div class="jp_chart-title-container">
                    <div class="jp_chart-title">Vendas deste ano</div>
                </div>

                <div class="jp_chart-filters">

                    <div class="ym_area-select">
                        <div class="ym_select" onclick="mostrar_categorias()">
                            <p class="ym_categoria-select">Produtos </p>
                            <p class="ym_seta-categoria">></p>
                        </div>
                        
                        
                        <div class="ym_options">
                            <a class="ym_link-option" onclick="trocar_categoria()"></i> Serviços</a>
                        </div>
                        
                    </div>
                    

                </div>
            </div>
            <canvas id="grafico_adm" width="700" height="250"></canvas>
        </div>
    </main>

    <script src="../../PUBLIC/JS/script-select.js"></script>    
    <script>
        window.data_grafico = <?php echo json_encode($data_grafico); ?>;
    </script>
    <script src="../../PUBLIC/JS/script-dashboard-adm-vcl.js"></script>

</body>
</html>
