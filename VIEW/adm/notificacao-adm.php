<?php
include "../../INCLUDE/Menu_adm.php";
require_once "../../CONTROLLER/ProdutoController.php";

try {
    $produtoController = new ProdutoController();
    $produtos = $produtoController->index();

    $limite = 5;
    $notificacoes = [];

    if (!isset($produtos['error'])) {
        foreach ($produtos as $produto) {
            if ($produto['quantidade'] <= $limite) {
                $notificacoes[] = [
                    'titulo' => "Estoque baixo para o produto: {$produto['nome']}",
                    'setor' => "Produtos",
                    'data' => date("d/m/Y")
                ];
            }
        }
    }

    $total_notificacoes = count($notificacoes);

} catch (Exception $e) {
    error_log("Erro: " . $e->getMessage());
    $notificacoes = [];
    $total_notificacoes = 0;
}
?>
    
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Notificações</title>
    <link rel="stylesheet" href="../../PUBLIC/css/lista-vendedores-adm.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <main class="jp_main-content">
        <h1 class="ym_titulo">Lista de Notificações</h1>

        <div class="jv_container">
            <div class="jv_card">
                <div class="jv_card-content">
                    <div class="jv_table-container">
                        <table class="jv_table">
                            <thead>
                                <tr class="jv_table-header">
                                    <th class="jv_checkbox-col">
                                        <input type="checkbox" id="jv_selectAll" class="jv_checkbox">
                                    </th>
                                    <th class="jv_date">Título</th>
                                    <th class="jv_total_comp">Setor</th>
                                    <th class="jv_valor_gast">Data</th>
                                    <th class="jv_actions-col"></th> 
                                </tr>
                            </thead>
                            <tbody id="jv_customerTableBody">
                                <?php if ($total_notificacoes > 0): ?>
                                    <?php foreach ($notificacoes as $notif): ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="jv_checkbox customer-checkbox">
                                            </td>
                                            <td>
                                                <div class="jv_customer-info">
                                                    <div class="jv_avatar">
                                                        ⚠
                                                    </div>
                                                    <div class="jv_customer-details">
                                                        <h4><?= htmlspecialchars($notif['titulo']) ?></h4>
                                                        <p>Produto com estoque baixo</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= htmlspecialchars($notif['setor']) ?></td>
                                            <td><?= $notif['data'] ?></td>
                                            <td class="jv_table-action">
                                                <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <div class="jv_dropdown">
                                                    <button class="jv_dropdown-item">
                                                        <i class="fas fa-eye"></i> Visualizar
                                                    </button>
                                                    <div class="jv_dropdown-separator"></div>
                                                    <button class="jv_dropdown-item jv_danger">
                                                        <i class="fas fa-trash"></i> Remover
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" style="text-align: center; height: 49.7vh;">
                                            Nenhuma notificação encontrada
                                        </td>
                                    </tr>
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
