<?php
include "../../INCLUDE/Menu_adm.php";
require_once "../../CONTROLLER/ProdutoController.php";
include "../../INCLUDE/vlibras.php";

$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 'estoque';

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

   
    $mensagens = [
        [
            'titulo' => "fazenda.esperanca@gmail.com",
            'data' => date("d/m/Y"),
            'mensagem' => "Bom dia! precisamos renovar nosso estoque de fertilizantes para a safra de soja. att",
            'nome' => "Luiz Inácio"
        ],
        [
            'titulo' => "cooperativa.verde@hotmail.com", 
            'data' => date("d/m/Y"),
            'mensagem' => "Prezados, Nossa cooperativa esta com problemas de pragas nas lavouras de milho, precisamos urgentemente de defensivos agrícolas.",
            'nome' => "Maria Santos"
        ],
        [
        'titulo' => "agroforte@outlook.com",
        'data' => date("d/m/Y"),
        'mensagem' => "Olá equipe, tudo bem? Gostaria de solicitar um orçamento detalhado para sementes de algodão destinadas à próxima safra. Nossa necessidade é de aproximadamente 500 kg para o plantio em uma área de 50 hectares. Também gostaria de saber sobre os prazos de entrega, disponibilidade do produto, formas e condições de pagamento, além de possíveis descontos para compra em maior volume. Agradeço desde já pela atenção e aguardo o retorno para alinharmos o pedido.",
        'nome' => "Carlos Eduardo"
    ]
];

    

 
    $dados = ($filtro === 'mensagens') ? $mensagens : $notificacoes;
    $total_itens = count($dados);

} catch (Exception $e) {
    error_log("Erro: " . $e->getMessage());
    $dados = [];
    $total_itens = 0;
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
    .jv_filter-select {
        padding: 8px 12px;
        border: 1px solid rgba(58, 98, 64, 0.5); 
        border-radius: 4px;
        margin-left: 10px;
        background-color: white;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        font-size: 14px;
    }
    
    .jv_filter-select:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(58, 98, 64, 0.1);
    }
    
    .mensagem-completa {
        background: transparent;
        border: none;
        padding: 0;
        margin: 0;
        width: 100%;
        cursor: pointer;
    }
    
    .conteudo-mensagem {
        background: transparent;
        padding: 0;
        border: none;
        margin-top: 8px;
        max-height: 120px;
        overflow-y: auto;
        line-height: 1.4;
        font-size: 14px;
        color: #666;
        word-wrap: break-word;
    }
    
    .jv_customer-details h4 {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        font-size: 15px;
        line-height: 1.3;
    }
    
    .jv_avatar.email-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%; 
        display: flex;
        align-items: center;
        justify-content: center;
        background: #45734B;
        color: white;
        font-size: 16px;
        flex-shrink: 0;
        margin-top: 2px;
    }
    
    .jv_avatar:not(.email-avatar) {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
  
    .jv_customer-info {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        width: 100%;
    }

    .jv_customer-details {
        flex: 1;
        min-width: 0;
    }

    
    .jv_table tbody tr {
        height: 80px;
    }

    .jv_table tbody td {
        vertical-align: top;
        padding: 12px 8px;
    }

    .jv_checkbox-col {
        vertical-align: middle;
    }

    .setor-col {
        vertical-align: middle;
        color: #666;
        font-size: 15px; 
        font-weight: 500;
    }

    .jv_table td:nth-child(4) {
        vertical-align: middle;
        color: #666;
        font-size: 13px;
    }

    .popup-email {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        font-family: 'Poppins', sans-serif;
    }

    .popup-email-content {
        background: white;
        border-radius: 12px;
        width: 90%;
        max-width: 700px;
        max-height: 85vh;
        display: flex;
        flex-direction: column;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .popup-email-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        border-bottom: 1px solid #e0e0e0;
        background: #f8f9fa;
        border-radius: 12px 12px 0 0;
    }

    .popup-email-header h3 {
        margin: 0;
        color: #333;
        font-size: 18px;
        font-weight: 600;
    }

    .popup-email-close {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: #666;
        padding: 5px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .popup-email-close:hover {
        background: #f0f0f0;
        color: #333;
    }

    .popup-email-body {
        padding: 25px;
        flex: 1;
        overflow-y: auto;
    }

    .email-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-weight: 500;
        color: #555;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .info-value {
        color: #333;
        font-size: 14px;
        font-weight: 400;
    }

    .mensagem-container {
        margin-top: 20px;
    }

    .mensagem-label {
        font-weight: 500;
        color: #555;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .mensagem-conteudo {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid #3a6240;
        max-height: 300px;
        overflow-y: auto;
        line-height: 1.6;
        font-size: 14px;
        white-space: pre-wrap;
        word-wrap: break-word;
    }

    .mensagem-clicavel {
        cursor: pointer;
    }

    .mensagem-conteudo::-webkit-scrollbar {
        width: 6px;
    }

    .mensagem-conteudo::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .mensagem-conteudo::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    .mensagem-conteudo::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    .setor-col {
        display: table-cell;
    }
    
    <?php if ($filtro === 'mensagens'): ?>
    .setor-col {
        display: none;
    }
    <?php endif; ?>
</style>
</head>
<body>
    <main class="jp_main-content">
        <h1 class="ym_titulo">Lista de Notificações</h1>

        <div class="jv_container">
            <div class="jv_card">
                <div class="jv_card-header">
                    <div class="jv_header-content">
                        <form method="POST" action="#" class="jv_search-section">
                            <div class="jv_search-container">
                                <button type="submit" class="ym_area-icon-pesquisa" name="pesquisar">
                                    <i class="fas fa-search search-icon"></i>
                                </button>
                                <input type="text" name="pesquisa" id="jv_searchInput" placeholder="Pesquisar por nome..." class="jv_search-input">
                            </div>
                        </form>

                        <div class="jv_actions">
                            <div>
                                <select class="jv_filter-select" onchange="window.location.href = '?filtro=' + this.value">
                                    <option value="estoque" <?= $filtro === 'estoque' ? 'selected' : '' ?>>Estoque</option>
                                    <option value="mensagens" <?= $filtro === 'mensagens' ? 'selected' : '' ?>>Mensagens</option>
                                </select>
                                
                                <button class="ym_btn-remover" id="jv_removeSelected" style="display: none;">
                                    <i class="fa-solid fa-trash-can"></i>
                                    Remover (<span id="jv_selectedCount">0</span>)
                                </button>
                            </div>
                        </div>
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
                                    <th class="jv_date">Título</th>
                                    <?php if ($filtro === 'estoque'): ?>
                                        <th class="jv_total_comp setor-col">Setor</th>
                                    <?php endif; ?>
                                    <th class="jv_valor_gast">Data</th>
                                    <th class="jv_actions-col"></th> 
                                </tr>
                            </thead>
                            <tbody id="jv_customerTableBody">
                            <?php if ($total_itens > 0): ?>
                                <?php foreach ($dados as $index => $item): ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="jv_checkbox customer-checkbox" data-customer-id="<?= $index ?>">
                                        </td>
                                        <td>
                                            <div class="jv_customer-info">
                                                <div class="jv_avatar <?= $filtro === 'mensagens' ? 'email-avatar' : '' ?>">
                                                    <?= $filtro === 'estoque' ? '⚠' : '📧' ?>
                                                </div>
                                                <div class="jv_customer-details">
                                                    <?php if ($filtro === 'mensagens'): ?>
                                                        <div class="mensagem-completa mensagem-clicavel" 
                                                             onclick="abrirPopupEmail(
                                                                '<?= htmlspecialchars($item['titulo']) ?>', 
                                                                '<?= $item['data'] ?>', 
                                                                `<?= htmlspecialchars($item['mensagem']) ?>`,
                                                                '<?= htmlspecialchars($item['nome']) ?>'
                                                             )">
                                                            <h4><?= htmlspecialchars($item['titulo']) ?></h4>
                                                            <div class="conteudo-mensagem">
                                                                <?= nl2br(htmlspecialchars($item['mensagem'])) ?>
                                                            </div>
                                                        </div>
                                                    <?php else: ?>
                                                        <h4><?= htmlspecialchars($item['titulo']) ?></h4>
                                                        <p>Produto com estoque baixo</p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <?php if ($filtro === 'estoque'): ?>
                                            <td class="setor-col"><?= htmlspecialchars($item['setor']) ?></td>
                                        <?php endif; ?>
                                        <td><?= $item['data'] ?></td>
                                        <td class="jv_table-action">
                                            <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="jv_dropdown">
                                                <button class="jv_dropdown-item jv_danger">
                                                    <i class="fas fa-trash"></i> Remover
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="<?= $filtro === 'estoque' ? '5' : '4' ?>" style="text-align: center; height: 49.7vh;">
                                        Nenhum item encontrado
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

   
    <div id="popupEmail" class="popup-email">
        <div class="popup-email-content">
            <div class="popup-email-header">
                <h3>Detalhes do Email</h3>
                <button class="popup-email-close" onclick="fecharPopupEmail()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="popup-email-body">
                <div class="email-info-grid">
                    <div class="info-item">
                        <span class="info-label">De:</span>
                        <span class="info-value" id="popupRemetente"></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nome:</span>
                        <span class="info-value" id="popupNome"></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Data:</span>
                        <span class="info-value" id="popupData"></span>
                    </div>
                </div>
                
                <div class="mensagem-container">
                    <span class="mensagem-label">Mensagem:</span>
                    <div class="mensagem-conteudo" id="popupMensagem"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../PUBLIC/JS/script-pop-up.js"></script>
    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/script-clientes-adm.js"></script>
    
    <script>
        
        function abrirPopupEmail(titulo, data, mensagem, nome) {
            document.getElementById('popupRemetente').textContent = titulo;
            document.getElementById('popupNome').textContent = nome;
            document.getElementById('popupData').textContent = data;
            document.getElementById('popupMensagem').textContent = mensagem;
            document.getElementById('popupEmail').style.display = 'flex';
        }

        function fecharPopupEmail() {
            document.getElementById('popupEmail').style.display = 'none';
        }

        
        document.getElementById('popupEmail').addEventListener('click', function(e) {
            if (e.target === this) fecharPopupEmail();
        });
    </script>
</body>
</html>