<?php
include "../../INCLUDE/Menu_adm.php";
include "../../CONTROLLER/ClienteController.php";
include "../../INCLUDE/vlibras.php";


$cliente_control = new ClienteController();
$clientes = $cliente_control->index();
$total_clientes = count($clientes);

if(!empty($_GET)){
    if (isset($_GET['visualizar'])){
        $id = $_GET['visualizar'];
        $cliente = $cliente_control->mostrar($id);
        header('Location: info-edit-adm.php?id=' . $id . '&usuario=cliente');

    } elseif (isset($_GET['remover'])){
        $id = $_GET['remover'];
        $cliente = $cliente_control->deletar($id);
        header('Location: ' . $_SERVER['PHP_SELF']);
    }
}

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
    <title>Gerenciamento de Clientes</title>
    <link rel="stylesheet" href="../../PUBLIC/css/clientes-adm.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/global-tema.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<!-- Pop-up -->
<div class="ym_popup-overlay">
    <div class="ym_popup-content">
        <div class="ym_area-superior-popup"></div>
        <div class="ym_conteudo-popup"></div>
    </div>
</div>

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

                    <div class="jv_actions">
                        <div>
                            <button class="ym_btn-remover" id="jv_removeSelected" style="display: none;">
                                <i class="fa-solid fa-trash-can"></i>
                                Remover (<span id="jv_selectedCount">0</span>)
                            </button>
                        </div>
                        <div>
                            <button class="ym_btn-padrao" onclick="abrirPopup('../../VIEW/pop-up/cadastroPessoas.php','Cadastro de Pessoas')">
                                <i class="fas fa-plus"></i>
                                <a>Cadastrar Cliente</a>
                            </button>
                        </div>
                    </div>
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
                                <th class="jv_checkbox-col">
                                    <input type="checkbox" id="jv_selectAll" class="jv_checkbox">
                                </th>
                                <th class="jv_name">Nome</th>
                                <th class="jv_date">Data de Nascimento</th>
                                <th class="jv_total_comp">Telefone</th>
                                <th class="jv_valor_gast">CPF/CNPJ</th>
                                <th class="jv_actions-col"></th>
                            </tr>
                        </thead>
                        <tbody id="jv_customerTableBody">
                            <?php if ($total_clientes > 0): ?>
                                <?php foreach ($clientes as $cliente): ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="jv_checkbox customer-checkbox" data-customer-id="<?= $cliente['id'] ?>">
                                        </td>
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
                                        <td class="jv_table-action">
                                            <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <form class="jv_dropdown">
                                                <button class="jv_dropdown-item" type="submit" name="visualizar" value="<?= htmlspecialchars($cliente['id'])?>">
                                                    <i class="fas fa-eye"></i> Visualizar
                                                </button>
                                                <div class="jv_dropdown-separator"></div>
                                                <button class="jv_dropdown-item jv_danger" type="submit" name="remover" value="<?= htmlspecialchars($cliente['id'])?>">
                                                    <i class="fas fa-trash"></i> Remover
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" style="text-align: center; height: 49.7vh;">Nenhum cliente encontrado</td></tr>
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

    <script src="../../PUBLIC/JS/script-clientes-adm.js"></script>
    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/script-pop-up.js"></script>
    <script src="../../PUBLIC/JS/script-tema.js"></script>

</main>
</body>
</html>