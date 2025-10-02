<?php
require_once '../../INCLUDE/verificarLogin.php';
include "../../INCLUDE/Menu_vend.php";
include "../../INCLUDE/vlibras.php";
include "../../CONTROLLER/VendaController.php";
include "../../CONTROLLER/clienteController.php";

$user_id = $_SESSION['id'] ?? null;
$venda_control = new VendaController(); 
$cliente_control = new ClienteController(); 

$vendas_usuario = $venda_control->index($user_id);

// FILTRO: tipo de venda
$tipo_venda = $_GET['tipo'] ?? 'todos';
if ($tipo_venda !== 'todos') {
    $vendas_usuario = array_filter($vendas_usuario, function($venda) use ($tipo_venda) {
        return $venda['tipo'] === $tipo_venda;
    });
}

$total_vendido = 0;
$numero_vendas = 0;
$data_grafico = array_fill(0, 12, 0);

foreach ($vendas_usuario as $venda) {
    $total_vendido += $venda['total'];
    $numero_vendas += 1;
    $data_venda = new DateTime($venda['data_venda']);
    $mes_index = (int)$data_venda->format("m") - 1;
    $data_grafico[$mes_index]++;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Vendedor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../PUBLIC/css/dashboard-vend.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <main class="jp_main-content">
        <h1 class="ym_titulo">Dashboard</h1> 

        <div class="jp_metrics-row">
            <div class="jp_metric-box jp_metric-green">
                <div class="jp_metric-header">
                    <div class="jp_metric-title">Total Vendido</div>
                    <div class="jp_metric-badge">22.0%</div>
                </div>
                <div class="jp_metric-value">R$<?= number_format($total_vendido, 2, ',', '.') ?></div>
            </div>
            <div class="jp_metric-box jp_metric-blue">
                <div class="jp_metric-header">
                    <div class="jp_metric-title">Número de Vendas</div>
                    <div class="jp_metric-badge">22.0%</div>
                </div>
                <div class="jp_metric-value"><?= $numero_vendas; ?></div>
            </div>
            <div class="jp_metric-box jp_metric-orange">
                <div class="jp_metric-header">
                    <div class="jp_metric-title">Total de Comissões</div>
                    <div class="jp_metric-badge">22.0%</div>
                </div>
                <div class="jp_metric-value">R$<?= number_format(($total_vendido / 10), 2, ',', '.'); ?></div>
            </div>
        </div>

        <div class="jp_sales-container">
            <div class="jp_sales-header">Últimas vendas</div>
            <table class="jp_sales-list">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Data</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $limite = 5;
                        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                        $offset = ($pagina - 1) * $limite;
                        $total_vendas = count($vendas_usuario);
                        $vendas_pagina = array_slice($vendas_usuario, $offset, $limite);

                        foreach ($vendas_pagina as $venda) {
                            echo '
                            <tr>
                                <td>' . $cliente_control->mostrar($venda['id_cliente'])['nome'] . '</td>
                                <td>' . date('d/m/Y', strtotime($venda['data_venda'])) . '</td>
                                <td class="jp_sales-value">R$ ' . number_format($venda['total'], 2, ',', '.') . '</td>
                            </tr>';
                        }
                    ?>  
                </tbody>
            </table>

            <!-- Paginação -->
            <div class="jp_pagination">
                <?php
                    $total_paginas = ceil($total_vendas / $limite);
                    $tipo_param = isset($_GET['tipo']) ? '&tipo=' . urlencode($_GET['tipo']) : '';

                    if ($pagina > 1) {
                        echo '<a class="jp_arrow" href="?pagina=' . ($pagina - 1) . $tipo_param . '"><i class="fas fa-arrow-left"></i></a>';
                    }

                    for ($i = 1; $i <= $total_paginas; $i++) {
                        $classe = ($i == $pagina) ? 'style="font-weight:bold;"' : '';
                        echo '<a ' . $classe . ' href="?pagina=' . $i . $tipo_param . '">' . $i . '</a>';
                    }

                    if ($pagina < $total_paginas) {
                        echo '<a class="jp_arrow" href="?pagina=' . ($pagina + 1) . $tipo_param . '"><i class="fas fa-arrow-right"></i></a>';
                    }
                ?>
            </div>
        </div>

        <div class="jp_bottom-section">
            <div class="jp_chart-panel">
                <div class="jp_chart-header">
                    <div class="jp_chart-title-area">
                        <div class="jp_chart-title">Vendas por Mês</div>
                    </div>

                    <!-- Filtro de Tipo de Venda -->
                    <form method="GET" class="ym_area-select">
                        <label for="tipo" style="font-weight:bold;">Tipo de Venda:</label>
                        <select name="tipo" id="tipo" onchange="this.form.submit()">
                            <option value="todos" <?= (!isset($_GET['tipo']) || $_GET['tipo'] == 'todos') ? 'selected' : '' ?>>Todos</option>
                            <option value="produto" <?= (isset($_GET['tipo']) && $_GET['tipo'] == 'produto') ? 'selected' : '' ?>>Produto</option>
                            <option value="servico" <?= (isset($_GET['tipo']) && $_GET['tipo'] == 'servico') ? 'selected' : '' ?>>Serviço</option>
                        </select>
                    </form>
                </div>

                <canvas id="grafico_vend" width="700" height="250"></canvas>
            </div>
        </div>
    </main>

    <script>
        window.data_grafico = <?php echo json_encode($data_grafico); ?>;
    </script>
    <script src="../../PUBLIC/JS/script-dashboard-vend.js"></script>
    <script src="../../PUBLIC/JS/script-select.js"></script>
</body>
</html>
