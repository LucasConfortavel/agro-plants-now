<?php
include "../../INCLUDE/Menu_vend.php";
require_once "../../DB/Database.php"; 
require_once "../../INCLUDE/verificarLogin.php"; 
include "../../INCLUDE/vlibras.php";
include "../../INCLUDE/alertas.php";

$user_id = $_SESSION['id'] ?? null;

$db = new Database();
$conn = $db->getConexao();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_info'])) {
    $stmt = $conn->prepare('
        UPDATE usuario 
        SET nome = ?, email = ?, telefone = ?, cpf = ?, cep = ?, data_nasc = ?
        WHERE id = ?
    ');
    $atualizar = $stmt->execute([
        $_POST['nome'],
        $_POST['email'],
        $_POST['telefone'],
        $_POST['cpf'],
        $_POST['cep'],
        $_POST['data_nasc'],
        $user_id
    ]);

    if($atualizar == 1){
        $_SESSION['alerta'] = '<script> exibirAlerta("Informações atualizadas com sucesso","sucesso"); </script>';
    }else{
        $_SESSION['alerta'] = '<script> exibirAlerta("Não foi possível atualizadar as informações","sucesso"); </script>';
    }
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

// NOVO: Processar upload de foto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_photo'])) {
    require_once '../../CONTROLLER/ImageController.php';
    $imageController = new ImageController();

    if (!empty($_FILES['foto']['name'])) {
        $uploadResult = $imageController->upload($_FILES['foto'], 'user_');
        
        if ($uploadResult['success']) {
            // Primeiro, buscar a foto atual para deletar se não for a padrão
            $stmt = $conn->prepare("SELECT foto FROM usuario WHERE id = ?");
            $stmt->execute([$user_id]);
            $fotoAtual = $stmt->fetchColumn();
            
            // Deletar foto antiga se não for a padrão
            if ($fotoAtual && $fotoAtual !== 'default_user.jpg') {
                $imageController->delete($fotoAtual);
            }
            
            // Atualizar no banco
            $stmt = $conn->prepare("UPDATE usuario SET foto = ? WHERE id = ?");
            $stmt->execute([$uploadResult['filename'], $user_id]);
            
            $_SESSION['alerta'] = '<script> exibirAlerta("Foto atualizada com sucesso","sucesso"); </script>';
        } else {
            $_SESSION['alerta'] = '<script> exibirAlerta("Erro ao fazer upload da imagem: ' . $uploadResult['error'] . '","erro"); </script>';
        }
    } else {
        $_SESSION['alerta'] = '<script> exibirAlerta("Selecione uma imagem para upload","erro"); </script>';
    }
}

$stmt = $conn->prepare('
    SELECT nome, email, tipo, telefone, cpf, cep, data_nasc, foto
    FROM usuario 
    WHERE id = ?
');
$stmt->execute([$user_id]);
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

// Definir foto padrão se não tiver
if (empty($user_data['foto'])) {
    $user_data['foto'] = 'default_user.jpg';
}

if(isset($_SESSION['alerta'])){
    echo($_SESSION['alerta']);
    unset($_SESSION['alerta']);
}
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
                <div class="profile-pic-area">
                    <div class="profile-pic-container">
                        <?php if ($user_data['foto']): ?>
                            <img src="../../PUBLIC/img/<?= $user_data['foto'] ?>" alt="Foto de Perfil" class="profile-pic">
                        <?php else: ?>
                            <span class="profile-placeholder">Foto de Perfil</span>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn-change-photo" onclick="openPhotoModal()">
                        <i class="fas fa-camera"></i> Alterar Foto
                    </button>
                </div>
                <div class="profile-text">
                    <h2><?php echo htmlspecialchars($user_data['nome']); ?></h2>
                    <p><?php echo htmlspecialchars($user_data['email']); ?></p>
                    <span class="last-login">Último acesso: Hoje às 14:30</span>
                </div>
            </div>
            <div class="profile-badges">
                <div class="role-badge"><?php echo htmlspecialchars($user_data['tipo'] === 'admin' ? 'Administrador' : 'Vendedor'); ?></div>
                <div class="status-badge online">Online</div>
            </div>
        </header>

        <nav class="tabs-nav">
            <button class="tab-btn active" data-tab="personal">
                <i class="fas fa-user"></i> Informações Pessoais
            </button>
            <button class="tab-btn" data-tab="photo">
                <i class="fas fa-camera"></i> Foto do Perfil
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
                        <input type="text" value="<?php echo htmlspecialchars($user_data['tipo'] === 'admin' ? 'Administrador' : 'Vendedor'); ?>" readonly disabled>
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

        <!-- NOVA ABA: Foto do Perfil -->
        <div class="tab-content" id="photo">
            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-camera"></i> Foto do Perfil</h3>
                </div>
                <div class="photo-upload-section">
                    <div class="current-photo">
                        <h4>Foto Atual</h4>
                        <div class="photo-preview">
                            <?php if ($user_data['foto']): ?>
                                <img src="../../PUBLIC/img/<?= $user_data['foto'] ?>" alt="Foto Atual" class="current-photo-img">
                            <?php else: ?>
                                <div class="no-photo">Sem foto</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <form id="photoForm" method="POST" enctype="multipart/form-data" class="photo-upload-form">
                        <input type="hidden" name="update_photo" value="1">
                        <div class="form-group">
                            <label for="foto">Selecionar Nova Foto</label>
                            <input type="file" id="foto" name="foto" accept="image/*" class="file-input">
                            <small>Formatos permitidos: JPG, PNG, GIF, WEBP. Tamanho máximo: 5MB</small>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn-save">Upload da Foto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Restante do código permanece igual -->
        <div class="tab-content" id="notifications">
            <!-- ... conteúdo existente ... -->
        </div>

        <div class="tab-content" id="preferences">
            <!-- ... conteúdo existente ... -->
        </div>
    </main>

    <div id="toast-container"></div>

    <script>
        // Função para abrir modal de foto (opcional)
        function openPhotoModal() {
            document.querySelector('[data-tab="photo"]').click();
        }

        // Script do tema permanece igual
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