<?php
require_once "../../DB/Database.php"; 
require_once "../../INCLUDE/verificarLogin.php"; 

$user_id = $_SESSION['id'] ?? null;

$db = new Database();
$conn = $db->getConexao();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_info'])) {
    $stmt = $conn->prepare('
        UPDATE usuario 
        SET nome = ?, email = ?, telefone = ?, cpf = ?, cep = ?, data_nasc = ?
        WHERE id = ?
    ');
    $stmt->execute([
        $_POST['nome'],
        $_POST['email'],
        $_POST['telefone'],
        $_POST['cpf'],
        $_POST['cep'],
        $_POST['data_nasc'],
        $user_id
    ]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_password'])) {
    $stmt = $conn->prepare("SELECT senha FROM usuario WHERE id = ?");
    $stmt->execute([$user_id]);
    $senhaAtual = $stmt->fetchColumn();

    if ($_POST['senha_atual'] === $senhaAtual && $_POST['nova_senha'] === $_POST['confirmar_senha']) {
        $stmt = $conn->prepare("UPDATE usuario SET senha = ? WHERE id = ?");
        $stmt->execute([$_POST['nova_senha'], $user_id]);
    }
}

$stmt = $conn->prepare('
    SELECT nome, email, tipo, telefone, cpf, cep, data_nasc, foto
    FROM usuario 
    WHERE id = ?
');
$stmt->execute([$user_id]);
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

include "../../INCLUDE/Menu_vend.php";
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações do Perfil</title>
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/ajustes-adm.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <main class="jp_main-content">
        <div class="page-header">
            <h1 class="page-title">Configurações do Perfil</h1>
        </div>

        <header class="profile-header">
            <div class="profile-info">
                <div class="profile-pic-container">
                    <?php if ($user_data['foto']): ?>
                        <img src="<?= $user_data['foto'] ?>" alt="Foto de Perfil" class="profile-pic">
                    <?php else: ?>
                        <span class="profile-placeholder">Foto de Perfil</span>
                    <?php endif; ?>
                </div>
                <div class="profile-text">
                    <h2><?php echo htmlspecialchars($user_data['nome']); ?></h2>
                    <p><?php echo htmlspecialchars($user_data['email']); ?></p>
                    <span class="last-login">Último acesso: Hoje às 14:30</span>
                </div>
            </div>
            <div class="profile-badges">
                <div class="role-badge"><?php echo htmlspecialchars($user_data['tipo'] === 'admin' ? 'Administrador' : $user_data['tipo']); ?></div>
                <div class="status-badge online">Online</div>
            </div>
        </header>

        <nav class="tabs-nav">
            <button class="tab-btn active" data-tab="personal">
                <i class="fas fa-user"></i> Informações Pessoais
            </button>
            <button class="tab-btn" data-tab="notifications">
                <i class="fas fa-bell"></i> Notificações
            </button>
            <button class="tab-btn" data-tab="preferences">
                <i class="fas fa-palette"></i> Preferências
            </button>
        </nav>

        <div class="tab-content active" id="personal">
    <div class="content-card">
        <div class="card-header">
            <h3><i class="fas fa-user-edit"></i> Informações Pessoais</h3>
            <button type="button" class="btn-edit" onclick="enableEdit('personal')">
                <i class="fas fa-edit"></i> Editar
            </button>
        </div>
        <form id="personalForm" class="form-grid" method="POST">
            <input type="hidden" name="update_info" value="1">
            <div class="form-group">
                <label>Nome Completo</label>
                <input type="text" name="nome" value="<?php echo htmlspecialchars($user_data['nome']); ?>" readonly>
            </div>
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" readonly>
            </div>
            <div class="form-group">
                <label>Telefone</label>
                <input type="tel" name="telefone" value="<?php echo htmlspecialchars($user_data['telefone']); ?>" readonly>
            </div>
            <div class="form-group">
                <label>Data de Nascimento</label>
                <input type="date" name="data_nasc" value="<?php echo htmlspecialchars($user_data['data_nasc']); ?>" readonly>
            </div>
            <div class="form-group">
                <label>CPF</label>
                <input type="text" name="cpf" value="<?php echo htmlspecialchars($user_data['cpf']); ?>" readonly>
            </div>
            <div class="form-group">
                <label>Tipo (Cargo)</label>
                <input type="text" value="<?php echo htmlspecialchars($user_data['tipo'] === 'admin' ? 'Administrador' : $user_data['tipo']); ?>" readonly disabled>
            </div>
            <div class="form-group full-width">
                <label>CEP</label>
                <input type="text" name="cep" value="<?php echo htmlspecialchars($user_data['cep']); ?>" readonly>
            </div>
            <div class="form-actions" style="display: none;">
                <button type="button" class="btn-cancel" onclick="cancelEdit('personal')">Cancelar</button>
                <button type="submit" class="btn-save">Salvar</button>
            </div>
        </form>
    </div>
</div>


        <div class="tab-content" id="notifications">
            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-bell"></i> Configurações de Notificação</h3>
                </div>
                
                <div class="notification-section">
                    <h4>Notificações por E-mail</h4>
                    <div class="notification-item">
                        <div class="notification-info">
                            <label>Relatórios Semanais</label>
                            <span>Resumo semanal das atividades</span>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="notification-item">
                        <div class="notification-info">
                            <label>Alertas de Segurança</label>
                            <span>Notificações sobre atividades suspeitas</span>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content" id="preferences">
            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-palette"></i> Preferências do Sistema</h3>
                </div>
                
                <div class="preference-section">
                    <h4>Aparência</h4>
                    <div class="theme-selector">
                        <div class="theme-option" data-theme="light">
                            <div class="theme-preview light">
                                <div class="preview-header"></div>
                                <div class="preview-content"></div>
                            </div>
                            <label class="tema">Claro</label>
                        </div>
                        <div class="theme-option active" data-theme="dark">
                            <div class="theme-preview dark">
                                <div class="preview-header"></div>
                                <div class="preview-content"></div>
                            </div>
                            <label class="tema">Escuro</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="toast-container"></div>

    <script>
        const themeOptions = document.querySelectorAll('.theme-option');
        const body = document.body;

        const savedTheme = localStorage.getItem('theme') || 'dark';
        applyTheme(savedTheme);

        themeOptions.forEach(option => {
            if (option.dataset.theme === savedTheme) {
                option.classList.add('active');
            } else {
                option.classList.remove('active');
            }
        });

        themeOptions.forEach(option => {
            option.addEventListener('click', () => {
                const selectedTheme = option.dataset.theme;
                
                body.classList.add('theme-transitioning');
                
                setTimeout(() => {
                    applyTheme(selectedTheme);
                    body.classList.remove('theme-transitioning');
                }, 50);

                themeOptions.forEach(opt => opt.classList.remove('active'));
                option.classList.add('active');

                localStorage.setItem('theme', selectedTheme);
                
                showToast(`Tema ${getThemeName(selectedTheme)} aplicado com sucesso!`, 'success');
            });
        });

        function applyTheme(theme) {
            body.classList.remove('dark-theme', 'light-theme');
            
            if (theme === 'dark') {
                body.classList.add('dark-theme');
            } else if (theme === 'light') {
                body.classList.add('light-theme');
            }
        }

        function getThemeName(theme) {
            switch(theme) {
                case 'dark': return 'Escuro';
                case 'light': return 'Claro';
                default: return 'Escuro';
            }
        }
    </script>

    <script src="../../PUBLIC/JS/script-ajustes-adm.js"></script>
</body>
</html>
