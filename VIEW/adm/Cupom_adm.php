<?php
include "../../INCLUDE/Menu_adm.php";
include "../../CONTROLLER/CupomController.php";
include "../../INCLUDE/vlibras.php";
require_once "../../INCLUDE/verificarLogin.php"; 
include "../../INCLUDE/alertas.php";

$cupom_control = new CupomController();
$cupons = $cupom_control->index();
$total_cupons = count($cupons);

$limite = 4;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina_atual < 1) $pagina_atual = 1;

$offset = ($pagina_atual - 1) * $limite;
$total_paginas = ceil($total_cupons / $limite);
$cupons = array_slice($cupons, $offset, $limite);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['criar_cupom'])) {
    $criar_cupom = $cupom_control->criarCupom();

    if($criar_cupom == 1){
        $_SESSION['alerta'] =  '<script> exibirAlerta("Cupom cadastrado com sucesso","sucesso"); </script>';
    }else{
        $_SESSION['alerta'] = '<script> exibirAlerta("Não foi possível cadastrar o Cupom","error"); </script>';
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

if(!empty($_GET)){
    if(isset($_GET['remover'])){
        $id = $_GET['remover'];
        $cupom = $cupom_control->deletar($id);

        if($cupom == 1){
            $_SESSION['alerta'] = '<script> exibirAlerta("Cupom deletado com sucesso","sucesso"); </script>';
        }else{
            $_SESSION['alerta'] = '<script> exibirAlerta("Não foi possível deletar o cupom","error"); </script>';
        }

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remover_selecionados'])) {
    $ids = $_POST['selecionados'] ?? [];
    foreach($ids as $id){
        $cupom_control->deletar($id);
    }
    $_SESSION['alerta'] = '<script> exibirAlerta("Cupons selecionados removidos com sucesso","sucesso"); </script>';
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

if(isset($_SESSION['alerta'])){
    echo($_SESSION['alerta']);
    unset($_SESSION['alerta']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Cupons</title>
    <link rel="stylesheet" href="../../PUBLIC/css/vendas-cupom-adm.css">
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
    <h1 class="ym_titulo">Cupons</h1>

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
                            <input type="text" name="pesquisa" id="jv_searchInput" placeholder="Pesquisar por código..." class="jv_search-input" oninput="Pesquisar()">
                        </div>
                    </form>

                    <div class="jv_actions">
                        <!-- BOTÃO REMOVER SELECIONADOS -->
                        <form method="POST" id="formRemoverSelecionados">
                            <input type="hidden" name="remover_selecionados" value="1">
                            <button type="submit" class="ym_btn-remover" id="jv_removeSelected" style="display: none;">
                                <i class="fa-solid fa-trash-can"></i>
                                Remover (<span id="jv_selectedCount">0</span>)
                            </button>
                        </form>

                        <div>
                            <button class="ym_btn-padrao" onclick="abrirPopup('../../VIEW/pop-up/pop-up-cadastroCupom.php','Cadastro de Cupom')">
                                <i class="fas fa-plus"></i>
                                <a>Cadastrar Cupom</a>
                            </button>
                        </div>
                    </div>
                </div>

                <p class="jv_subtitle" id="jv_customerCount">
                    <?= $total_cupons ?> <?= $total_cupons == 1 ? 'cupom encontrado' : 'cupons encontrados' ?>
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
                                <th class="jv_codigo">Código</th>
                                <th class="jv_desconto">Desconto</th>
                                <th class="jv_cadastro">Data de Cadastro</th>
                                <th class="jv_validade">Validade</th>
                            </tr>
                        </thead>
                        <tbody id="jv_customerTableBody">
                            <?php if ($total_cupons > 0): ?>
                                <?php foreach ($cupons as $cupom): ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="selecionados[]" form="formRemoverSelecionados" class="jv_checkbox customer-checkbox" value="<?= htmlspecialchars($cupom['id']) ?>">
                                        </td>
                                        <td><?= htmlspecialchars($cupom['codigo'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($cupom['valor'] ?? $cupom['desconto'] ?? '0') ?>%</td>
                                        <td><?= isset($cupom['data_emissao']) ? date("d/m/Y", strtotime($cupom['data_emissao'])) : (isset($cupom['data_criacao']) ? date("d/m/Y", strtotime($cupom['data_criacao'])) : '-') ?></td>
                                        <td><?= isset($cupom['data_validade']) ? date("d/m/Y", strtotime($cupom['data_validade'])) : (isset($cupom['validade']) ? date("d/m/Y", strtotime($cupom['validade'])) : '-') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" style="text-align: center; height: 49.7vh;">Nenhum cupom encontrado</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Paginação -->
    <div class="jv_page-navigation">
    </div>

    <script>
        const selectAllCheckbox = document.getElementById('jv_selectAll');
        const checkboxes = document.querySelectorAll('.customer-checkbox');
        const removeButton = document.getElementById('jv_removeSelected');
        const selectedCount = document.getElementById('jv_selectedCount');

        

        function updateSelectedCount() {
            const checkedBoxes = document.querySelectorAll('.customer-checkbox:checked');
            const totalSelected = checkedBoxes.length;
            selectedCount.textContent = totalSelected;
            removeButton.style.display = totalSelected > 0 ? 'inline-flex' : 'none';
        }

        selectAllCheckbox.addEventListener('change', function () {
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            updateSelectedCount();
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const allChecked = document.querySelectorAll('.customer-checkbox:checked').length === checkboxes.length;
                selectAllCheckbox.checked = allChecked;
                updateSelectedCount();
            });
        });
    </script>
    <script>
        const dados = <?php echo json_encode($cupons); ?>;
    </script>
    <script src="../../PUBLIC/JS/script-cupom.js"></script>
    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/script-pop-up.js"></script>
    <script src="../../PUBLIC/JS/script-tema.js"></script>
</main>
</body>
</html>
