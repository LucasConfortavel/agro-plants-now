<?php
    include "../../INCLUDE/Menu_vend.php";
    include "../../DB/Database.php";
    include "../../CONTROLLER/ClienteController.php";

    $controler_user = new ClienteController();

    $cliente = $controler_user->index();
    $total_clientes = count($cliente);

    // Paginação: 5 por página
    $limite = 5; 
    $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    if ($pagina_atual < 1) $pagina_atual = 1;

    $offset = ($pagina_atual - 1) * $limite;
    $total_paginas = ceil($total_clientes / $limite);

    $usuarios = array_slice($cliente, $offset, $limite);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
        $controler_user->criarCliente();
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
                                    <th class="jv_date">Telefone</th>
                                    <th class="jv_total_comp">Data de Nascimento</th>
                                    <th class="jv_valor_gast">Valor Gasto</th>
                                </tr>
                            </thead>
                            <tbody id="jv_customerTableBody">
                                <?php if ($total_clientes > 0): ?>
                                    <?php foreach ($usuarios as $vend): ?>
                                        <tr>
                                            <td>
                                                <div class="jv_customer-info">
                                                    <div class="jv_avatar">
                                                        <?= strtoupper(substr($vend['nome'], 0, 2)) ?>
                                                    </div>
                                                    <div class="jv_customer-details">
                                                        <h4><?= htmlspecialchars($vend['nome']) ?></h4>
                                                        <p><?= htmlspecialchars($vend['email']) ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align:center;"><?= htmlspecialchars($vend['telefone']) ?></td>
                                            <td style="text-align:center;"><?= date("d/m/Y", strtotime($vend['data_nasc'])) ?></td>
                                            <td style="text-align:center;">R$ 0,00</td>
                                        </tr>
                                    <?php endforeach; ?>

                                    <!-- Completa linhas vazias até dar 5 -->
                                    <?php for ($i = count($usuarios); $i < 5; $i++): ?>
                                        <tr>
                                            <td colspan="4" style="height:70px;"></td>
                                        </tr>
                                    <?php endfor; ?>

                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" style="text-align: center; height: 350px;">
                                            Nenhum cliente encontrado
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Paginação -->
        <div class="jv_page-navigation">
            <a href="?pagina=<?= max(1, $pagina_atual - 1) ?>" class="jv_page-arrow <?= $pagina_atual == 1 ? 'disabled' : '' ?>">
                <i class="fas fa-arrow-left"></i>
            </a>

            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                <a href="?pagina=<?= $i ?>" class="jv_page-number <?= $i == $pagina_atual ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <a href="?pagina=<?= min($total_paginas, $pagina_atual + 1) ?>" class="jv_page-arrow <?= $pagina_atual == $total_paginas ? 'disabled' : '' ?>">
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <script src="../../PUBLIC/JS/lista_clientes.js"></script>
        <script src="../../PUBLIC/JS/script.js"></script>
        <script src="../../PUBLIC/JS/script-pop-up.js"></script>
    </main>
</body>
</html>
