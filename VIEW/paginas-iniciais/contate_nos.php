<?php
include "../../INCLUDE/Menu_adm.php";
require_once "../../CONTROLLER/NotificacaoController.php";
include "../../INCLUDE/vlibras.php";

$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 'estoque';

try {
    $notificacaoCtrl = new NotificacaoController();
    
    $todas_notificacoes = $notificacaoCtrl->listarNotificacoes(100);
    
    $notificacoes_estoque = [];
    $notificacoes_contato = [];

    if (!isset($todas_notificacoes['error'])) {
        foreach ($todas_notificacoes as $notificacao) {
            if (strpos($notificacao['titulo'], 'Estoque Baixo') !== false) {
                $notificacoes_estoque[] = [
                    'titulo' => $notificacao['titulo'],
                    'setor' => "Produtos",
                    'data' => date("d/m/Y", strtotime($notificacao['horario_criacao'])),
                    'id' => $notificacao['id'],
                    'assunto' => $notificacao['assunto']
                ];
            } else if (strpos($notificacao['titulo'], 'Novo Contato') !== false) {
                $dados = json_decode($notificacao['assunto'], true);
                
                if ($dados && isset($dados['tipo']) && $dados['tipo'] === 'contato') {
                    $notificacoes_contato[] = [
                        'titulo' => $notificacao['titulo'],
                        'data' => date("d/m/Y H:i", strtotime($notificacao['horario_criacao'])),
                        'mensagem' => $dados['mensagem'] ?? '',
                        'nome' => $dados['nome'] ?? '',
                        'email' => $dados['email'] ?? '',
                        'id' => $notificacao['id']
                    ];
                } else {
                    $assunto = $notificacao['assunto'];
                    $linhas = explode("\n", $assunto);
                    $nome = '';
                    $email = '';
                    $mensagem = '';
                    $capturando_mensagem = false;
                    
                    foreach ($linhas as $linha) {
                        $linha = trim($linha);
                        
                        if (strpos($linha, 'De:') !== false) {
                            if (preg_match('/De:\s*([^(]+)\s*\(([^)]+)\)/', $linha, $matches)) {
                                $nome = trim($matches[1]);
                                $email = trim($matches[2]);
                            }
                        } else if (strpos($linha, 'Mensagem:') !== false) {
                            $capturando_mensagem = true;
                        } else if ($capturando_mensagem && !empty($linha)) {
                            $mensagem .= $linha . "\n";
                        }
                    }
                    
                    $notificacoes_contato[] = [
                        'titulo' => $notificacao['titulo'],
                        'data' => date("d/m/Y H:i", strtotime($notificacao['horario_criacao'])),
                        'mensagem' => trim($mensagem),
                        'nome' => $nome,
                        'email' => $email,
                        'id' => $notificacao['id']
                    ];
                }
            }
        }
    }

    if ($filtro === 'mensagens') {
        $dados = $notificacoes_contato;
    } else {
        $dados = $notificacoes_estoque;
    }

    $total_itens = count($dados);

} catch (Exception $e) {
    error_log("Erro: " . $e->getMessage());
    $dados = [];
    $total_itens = 0;
}

if (isset($_GET['remover'])) {
    $id_remover = $_GET['remover'];
    $notificacaoCtrl->deletarNotificacao($id_remover);
    header("Location: notificacao-adm.php?filtro=" . $filtro);
    exit;
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
        .jv_dropdown-item.remover-btn {
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            padding: 8px 12px;
            cursor: pointer;
            color: #dc3545;
        }
        
        .jv_dropdown-item.remover-btn:hover {
            background-color: #f8f9fa;
        }

        .mensagem-clicavel {
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .mensagem-clicavel:hover {
            background-color: rgba(0,0,0,0.02);
            border-radius: 4px;
        }

        .conteudo-mensagem {
            max-height: 2.4em;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .popup-email {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .popup-email-content {
            background: white;
            border-radius: 8px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
        }

        .popup-email-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .popup-email-header h3 {
            margin: 0;
            color: #333;
        }

        .popup-email-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #666;
        }

        .popup-email-body {
            padding: 20px;
        }

        .email-info-grid {
            display: grid;
            gap: 15px;
            margin-bottom: 20px;
        }

        .info-item {
            display: grid;
            grid-template-columns: 100px 1fr;
            gap: 10px;
        }

        .info-label {
            font-weight: 600;
            color: #666;
        }

        .info-value {
            color: #333;
        }

        .mensagem-container {
            border-top: 1px solid #e0e0e0;
            padding-top: 15px;
        }

        .mensagem-label {
            font-weight: 600;
            color: #666;
            display: block;
            margin-bottom: 10px;
        }

        .mensagem-conteudo {
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            color: #333;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .email-avatar {
            font-size: 24px;
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
                                <input type="text" name="pesquisa" id="jv_searchInput" placeholder="Pesquisar..." class="jv_search-input">
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
                                            <input type="checkbox" class="jv_checkbox customer-checkbox" data-customer-id="<?= $item['id'] ?>">
                                        </td>
                                        <td>
                                            <div class="jv_customer-info">
                                                <div class="jv_avatar <?= $filtro === 'mensagens' ? 'email-avatar' : '' ?>">
                                                    <?= $filtro === 'estoque' ? '⚠️' : '📧' ?>
                                                </div>
                                                <div class="jv_customer-details">
                                                    <?php if ($filtro === 'mensagens'): ?>
                                                        <div class="mensagem-completa mensagem-clicavel" 
                                                             onclick="abrirPopupEmail(
                                                                '<?= htmlspecialchars($item['email'], ENT_QUOTES) ?>', 
                                                                '<?= htmlspecialchars($item['data'], ENT_QUOTES) ?>', 
                                                                `<?= htmlspecialchars($item['mensagem'], ENT_QUOTES) ?>`,
                                                                '<?= htmlspecialchars($item['nome'], ENT_QUOTES) ?>'
                                                             )">
                                                            <h4><?= htmlspecialchars($item['titulo']) ?></h4>
                                                            <div class="conteudo-mensagem">
                                                                <?= nl2br(htmlspecialchars($item['mensagem'])) ?>
                                                            </div>
                                                        </div>
                                                    <?php else: ?>
                                                        <h4><?= htmlspecialchars($item['titulo']) ?></h4>
                                                        <p><?= htmlspecialchars($item['assunto'] ?? 'Produto com estoque baixo') ?></p>
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
                                                <button class="jv_dropdown-item remover-btn" onclick="removerNotificacao(<?= $item['id'] ?>)">
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
                            <span class="info-label">Nome:</span>
                            <span class="info-value" id="popupNome"></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email:</span>
                            <span class="info-value" id="popupRemetente"></span>
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
    </main>

    <script src="../../PUBLIC/JS/script-pop-up.js"></script>
    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/script-clientes-adm.js"></script>
    
    <script>
        function removerNotificacao(id) {
            if (confirm('Tem certeza que deseja remover esta notificação?')) {
                window.location.href = '?remover=' + id + '&filtro=<?= $filtro ?>';
            }
        }
        
        function abrirPopupEmail(email, data, mensagem, nome) {
            document.getElementById('popupRemetente').textContent = email;
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

        function toggleDropdown(button) {
            const dropdown = button.nextElementSibling;
            const allDropdowns = document.querySelectorAll('.jv_dropdown');
            
            allDropdowns.forEach(d => {
                if (d !== dropdown) {
                    d.style.display = 'none';
                }
            });
            
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.jv_menu-btn') && !e.target.closest('.jv_dropdown')) {
                document.querySelectorAll('.jv_dropdown').forEach(d => {
                    d.style.display = 'none';
                });
            }
        });
    </script>
</body>
</html>