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
                    'titulo' => "Estoque baixo: {$produto['nome']}",
                    'setor'  => "Produtos",
                    'data'   => date("d/m/Y"),
                    'quantidade' => $produto['quantidade']
                ];
            }
        }
    }

    // Mensagens simuladas com email
    $mensagens = [
        [
            'nome' => 'Maria Santos',
            'telefone' => '6799191-9191',
            'titulo' => "fazenda.esperanca@gmail.com",
            'setor' => "Vendas", 
            'data' => date("d/m/Y"),
            'mensagem' => "Bom dia! precisamos renovar nosso estoque de fertilizantes para a safra de soja. att"
        ],
        [
            'nome' => 'Luiz inácio',
            'telefone' => '6799191-1919',
            'titulo' => "cooperativa.verde@hotmail.com", 
            'setor' => "Comercial",
            'data' => date("d/m/Y"),
            'mensagem' => "Prezados, Nossa cooperativa esta com problemas de pragas nas lavouras de milho, precisamos urgentemente de defensivos agrícolas."
        ]
    ];

    // Escolher qual mostrar
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
        
        /* Estilo simplificado para mensagem */
        .mensagem-completa {
            background: transparent;
            border: none;
            padding: 0;
            margin: 0;
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
        }
        
        .jv_customer-details h4 {
            font-weight: 600;
            color: #666; 
            margin-bottom: 5px;
        }
        
        /* CORREÇÃO: Apenas o ícone de email fica redondo */
        .jv_avatar.email-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%; /* Isso garante que seja perfeitamente redondo */
            display: flex;
            align-items: center;
            justify-content: center;
            background: #45734B;
            font-size: 16px;
            flex-shrink: 0; /* Impede que distorça */
        }
        
        /* O ícone de atenção (estoque) mantém o formato original */
        .jv_avatar:not(.email-avatar) {
            /* Mantém o estilo original do arquivo CSS */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            /* Não aplica border-radius, width e height fixos */
        }
        
        /* Garantir que o container mantenha a proporção */
        .jv_customer-info {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        /* POPUP MÍNIMO */
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
        }

        .popup-email-content {
            background: white;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            padding: 20px;
        }

        .popup-email-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .popup-email-close {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: #666;
        }

        .email-detalhes {
            line-height: 1.5;
        }

        .email-detalhes div {
            margin-bottom: 10px;
        }

        .mensagem-clicavel {
            cursor: pointer;
        }
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
                                    <th class="jv_date">Título</th>
                                    <th class="jv_total_comp">Setor</th>
                                    <th class="jv_valor_gast">Data</th>
                                    <th class="jv_valor_gast">Qtd.</th>
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
                                                             onclick="abrirPopupEmail('<?= htmlspecialchars($item['titulo']) ?>', '<?= htmlspecialchars($item['setor']) ?>', '<?= $item['data'] ?>', `<?= htmlspecialchars($item['mensagem']) ?>`)">
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
                                        <td><?= htmlspecialchars($item['setor']) ?></td>
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
                                    <td colspan="5" style="text-align: center; height: 49.7vh;">
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

    <!-- POPUP MÍNIMO -->
    <div id="popupEmail" class="popup-email">
        <div class="popup-email-content">
            <div class="popup-email-header">
                <h3>Detalhes do Email</h3>
                <button class="popup-email-close" onclick="fecharPopupEmail()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="email-detalhes">
                <div><strong>De:</strong> <span id="popupRemetente"></span></div>
                <div><strong>Setor:</strong> <span id="popupSetor"></span></div>
                <div><strong>Data:</strong> <span id="popupData"></span></div>
                <div><strong>Mensagem:</strong></div>
                <div id="popupMensagem" style="background: #f5f5f5; padding: 10px; border-radius: 4px; margin-top: 5px;"></div>
            </div>
        </div>
    </div>

    <script src="../../PUBLIC/JS/script-pop-up.js"></script>
    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/script-clientes-adm.js"></script>
    
    <script>
        // Funções do popup de email
        function abrirPopupEmail(titulo, setor, data, mensagem) {
            document.getElementById('popupRemetente').textContent = titulo;
            document.getElementById('popupSetor').textContent = setor;
            document.getElementById('popupData').textContent = data;
            document.getElementById('popupMensagem').textContent = mensagem;
            document.getElementById('popupEmail').style.display = 'flex';
        }

        function fecharPopupEmail() {
            document.getElementById('popupEmail').style.display = 'none';
        }

        // Fechar clicando fora
        document.getElementById('popupEmail').addEventListener('click', function(e) {
            if (e.target === this) fecharPopupEmail();
        });
    </script>
</body>
</html>
