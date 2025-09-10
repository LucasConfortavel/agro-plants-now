<?php
include "../../INCLUDE/Menu_adm.php";
require_once "../../DB/Database.php";
include "../../CONTROLLER/MensagensController.php";

$controler_msg = new MessageController();

// Processar ações GET
$action_handled = false;
if (!empty($_GET)) {
    if (isset($_GET['visualizar'])) {
        $id = $_GET['visualizar'];
        $mensagem = $controler_msg->mostrar($id);
        $action_handled = true;
        header('Location: info-message.php?id=' . $id);
        exit;
    } elseif (isset($_GET['remover'])) {
        $id = $_GET['remover'];
        $controler_msg->deletar($id);
        $action_handled = true;
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

$mensagens = $controler_msg->index();
$total_mensagens = count($mensagens);

// Paginação
$limite = 4;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina_atual < 1) $pagina_atual = 1;
$offset = ($pagina_atual - 1) * $limite;
$total_paginas = ($total_mensagens > 0) ? ceil($total_mensagens / $limite) : 1;
$mensagens = array_slice($mensagens, $offset, $limite);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Mensagens</title>
    <link rel="stylesheet" href="../../PUBLIC/css/lista-vendedores-adm.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
<main class="jp_main-content">
    <h1 class="ym_titulo">Lista de Mensagens</h1>

    <div class="jv_container">
        <div class="jv_card">
            <div class="jv_card-header">
                <div class="jv_header-content">
                    <form method="POST" action="#" class="jv_search-section">
                        <!-- Se quiser adicionar busca, aqui -->
                    </form>
                </div>
            </div>

            <div class="jv_card-content">
                <div class="jv_table-container">
                    <table class="jv_table">
                        <thead>
                        <tr class="jv_table-header">
                            <th class="jv_checkbox-col">
                                <input type="checkbox" id="jv_selectAll" class="jv_checkbox">
                            </th>
                            <th class="jv_date">Nome</th>
                            <th class="jv_total_comp">Email</th>
                            <th class="jv_valor_gast">Mensagem</th>
                            <th class="jv_actions-col"></th>
                        </tr>
                        </thead>
                        <tbody id="jv_customerTableBody">
                        <?php if ($total_mensagens > 0): ?>
                            <?php foreach ($mensagens as $msg): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="jv_checkbox customer-checkbox" data-id="<?= $msg['id'] ?>">
                                    </td>
                                    <td><?= htmlspecialchars($msg['nome']) ?></td>
                                    <td><?= htmlspecialchars($msg['email']) ?></td>
                                    <td><?= htmlspecialchars(substr($msg['mensagem'], 0, 50)) ?>...</td>
                                    <td class="jv_table-action">
                                        <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="jv_dropdown">
                                            <a href="?visualizar=<?= $msg['id'] ?>" class="jv_dropdown-item">
                                                <i class="fas fa-eye"></i> Visualizar
                                            </a>
                                            <div class="jv_dropdown-separator"></div>
                                            <a href="?remover=<?= $msg['id'] ?>" class="jv_dropdown-item jv_danger">
                                                <i class="fas fa-trash"></i> Remover
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" style="text-align: center; height: 49.7vh;">Nenhuma mensagem encontrada</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="../../PUBLIC/JS/script-pop-up.js"></script>
<script src="../../PUBLIC/JS/script.js"></script>
</body>
</html>