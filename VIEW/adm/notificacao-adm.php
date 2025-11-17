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

    // Mensagens de exemplo para teste
    $mensagens_exemplo = [
        [
            'titulo' => "Orçamento para Sementes de Soja - Safra 2024",
            'data' => "15/03/2024 14:30",
            'mensagem' => "Prezados, gostaria de solicitar um orçamento para sementes de soja para a próxima safra. Necessitamos de aproximadamente 2.000 kg para plantio em 200 hectares. Por favor, enviem valores com detalhes sobre: variedades disponíveis, taxa de germinação, tratamento industrial incluído, condições de pagamento (possibilidade de parcelamento), prazo de entrega e descontos para compra acima de 1.500 kg. Também precisamos de informações sobre assistência técnica e garantias. Aguardo retorno para fecharmos o pedido ainda esta semana.",
            'nome' => "Carlos Eduardo Silva",
            'email' => "carlos.fazenda@agrobrasil.com.br",
            'id' => 'exemplo1'
        ],
        [
            'titulo' => "Problemas com Pragas - Urgente",
            'data' => "18/03/2024 09:15", 
            'mensagem' => "Bom dia, estamos enfrentando uma infestação severa de lagartas nas lavouras de milho. Já tentamos alguns defensivos sem sucesso. Precisamos urgentemente de recomendação técnica e produtos eficazes para controle. A área afetada é de aproximadamente 150 hectares com danos visíveis em 40% da plantação. Solicitamos: visita técnica emergencial, amostras para análise, orçamento para defensivos específicos e plano de aplicação. A situação é crítica e precisamos de resposta imediata para evitar perdas maiores na produção.",
            'nome' => "Ana Paula Rodrigues",
            'email' => "ana.rodrigues@cooperativaverde.com",
            'id' => 'exemplo2'
        ],
        [
            'titulo' => "Renovação de Contrato - Fertilizantes Anuais",
            'data' => "20/03/2024 16:45",
            'mensagem' => "Caro fornecedor, venho por meio deste renovar nosso contrato anual de fertilizantes. Para 2024 precisamos de: 500 toneladas de NPK 08-28-16, 300 toneladas de ureia, 200 toneladas de superfosfato simples e 150 toneladas de cloreto de potássio. Solicitamos proposta comercial com: preços atualizados, cronograma de entregas trimestrais, condições de pagamento (60/90 dias), garantia de qualidade dos produtos e suporte técnico para aplicação. Também gostaríamos de discutir possíveis melhorias no mix de produtos baseado em análise de solo recente.",
            'nome' => "Roberto Almeida Santos", 
            'email' => "roberto.santos@agroforte.com.br",
            'id' => 'exemplo3'
        ]
    ];

    
    if ($filtro === 'mensagens') {
        $dados = !empty($notificacoes_contato) ? $notificacoes_contato : $mensagens_exemplo;
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
        max-height: 60px;
        overflow-y: hidden;
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
                                                                '<?= htmlspecialchars(addslashes($item['email']), ENT_QUOTES) ?>', 
                                                                '<?= htmlspecialchars(addslashes($item['data']), ENT_QUOTES) ?>', 
                                                                `<?= htmlspecialchars(addslashes($item['mensagem']), ENT_QUOTES) ?>`,
                                                                '<?= htmlspecialchars(addslashes($item['nome']), ENT_QUOTES) ?>'
                                                             )">
                                                            <h4><?= htmlspecialchars($item['titulo']) ?></h4>
                                                            <div class="conteudo-mensagem">
                                                                <?php
                                                                $mensagem_abreviada = $item['mensagem'];
                                                                if (strlen($mensagem_abreviada) > 100) {
                                                                    $mensagem_abreviada = substr($mensagem_abreviada, 0, 100) . '...';
                                                                }
                                                                echo nl2br(htmlspecialchars($mensagem_abreviada));
                                                                ?>
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
                                                <button class="jv_dropdown-item remover-btn" onclick="removerNotificacao(<?= is_numeric($item['id']) ? $item['id'] : "'{$item['id']}'" ?>)">
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
                    <h3>📧 Detalhes da Mensagem</h3>
                    <button class="popup-email-close" onclick="fecharPopupEmail()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="popup-email-body">
                    <div class="email-info-grid">
                        <div class="info-item">
                            <span class="info-label">Nome do Remetente</span>
                            <span class="info-value" id="popupNome"></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value" id="popupRemetente"></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Data e Hora</span>
                            <span class="info-value" id="popupData"></span>
                        </div>
                    </div>
                    
                    <div class="mensagem-container">
                        <span class="mensagem-label">Mensagem Recebida</span>
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
                // Se for um ID de exemplo, apenas recarrega a página
                if (typeof id === 'string' && id.startsWith('exemplo')) {
                    alert('Esta é uma mensagem de exemplo e não pode ser removida.');
                    return;
                }
                window.location.href = '?remover=' + id + '&filtro=<?= $filtro ?>';
            }
        }
        
        function abrirPopupEmail(email, data, mensagem, nome) {
            const decodeHTML = (html) => {
                const txt = document.createElement('textarea');
                txt.innerHTML = html;
                return txt.value;
            };

            document.getElementById('popupNome').textContent = decodeHTML(nome);
            document.getElementById('popupRemetente').textContent = decodeHTML(email);
            document.getElementById('popupData').textContent = decodeHTML(data);
            document.getElementById('popupMensagem').textContent = decodeHTML(mensagem);
            document.getElementById('popupEmail').style.display = 'flex';
            
            document.body.style.overflow = 'hidden';
        }

        function fecharPopupEmail() {
            document.getElementById('popupEmail').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        document.getElementById('popupEmail').addEventListener('click', function(e) {
            if (e.target === this) {
                fecharPopupEmail();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                fecharPopupEmail();
            }
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