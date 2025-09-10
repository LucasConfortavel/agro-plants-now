<?php
include "../../INCLUDE/Menu_vend.php";
include "../../CONTROLLER/ClienteController.php";

$cliente_control = new ClienteController();
$clientes = $cliente_control->index();
$total_clientes = count($clientes);

// Paginação
$limite = 4;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $limite;
$total_paginas = ceil($total_clientes / $limite);

// Slice para limitar os clientes exibidos
$clientes = array_slice($clientes, $offset, $limite);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cliente_control->criarCliente();
    unset($_POST);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="../../PUBLIC/css/lista-clientes.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>


<main class="jp_main-content">
    <h1 class="ym_titulo">Clientes</h1>

    <div class="jv_container">
        <div class="jv_card">
            <!-- Header -->
            <div class="jv_card-header">
                <div class="jv_header-content">
                    <form method="POST" action="#" class="jv_search-section">
                        <div class="jv_search-container">
                            <button type="submit" class="ym_area-icon-pesquisa" name="pesquisar">
                                <i class="fas fa-search search-icon"></i>
                            </button>
                            <input type="text" name="pesquisa" id="jv_searchInput" placeholder="Pesquisar por nome ou email..." class="jv_search-input">
                        </div>
                    </form>
                </div>

                <p class="jv_subtitle" id="jv_customerCount">
                    <?= $total_clientes ?> clientes encontrados
                </p>
            </div>

            <!-- Table -->
            <div class="jv_card-content">
                <div class="jv_table-container">
                    <table class="jv_table">
                        <thead>
                            <tr class="jv_table-header">
                                <th class="jv_name">Nome</th>
                                <th class="jv_date">Data de Nascimento</th>
                                <th class="jv_total_comp">Telefone</th>
                                <th class="jv_valor_gast">CPF/CNPJ</th>
                            </tr>
                        </thead>
                        <tbody id="jv_customerTableBody">
                            <?php if ($total_clientes > 0): ?>
                                <?php foreach ($clientes as $cliente): ?>
                                    <tr>
                                        <td>
                                            <div class="jv_customer-info">
                                                <div class="jv_avatar">
                                                    <?= strtoupper(substr($cliente['nome'], 0, 2)) ?>
                                                </div>
                                                    <div class="jv_customer-details">
                                                        <h4><?= htmlspecialchars($cliente['nome']) ?></h4>
                                                        <p><?= htmlspecialchars($cliente['email']) ?></p>
                                                    </div>
                                            </div>
                                        </td>
                                        <td><?= date("d/m/Y", strtotime($cliente['data_nasc'])) ?></td>
                                        <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                                        <td><?= htmlspecialchars($cliente['CPF'] ?? $cliente['CNPJ']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" style="text-align: center; height: 49.7vh;">Nenhum cliente encontrado</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Paginação -->
    <div class="jv_page-navigation">
        <?php if($pagina_atual > 1): ?>
            <a href="?pagina=<?= $pagina_atual - 1 ?>" class="jv_page-arrow">
                <i class="fas fa-arrow-left"></i>
            </a>
        <?php endif; ?>

        <?php
        $inicio = max(1, $pagina_atual - 2);
        $fim = min($total_paginas, $pagina_atual + 2);
        for ($i = $inicio; $i <= $fim; $i++): ?>
            <a href="?pagina=<?= $i ?>" class="jv_page-number <?= $i == $pagina_atual ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if($pagina_atual < $total_paginas): ?>
            <a href="?pagina=<?= $pagina_atual + 1 ?>" class="jv_page-arrow">
                <i class="fas fa-arrow-right"></i>
            </a>
        <?php endif; ?>
    </div>

    <script src="../../PUBLIC/JS/lista_clientes.js"></script>
    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/script-pop-up.js"></script>

</main>
</body>
</html>
