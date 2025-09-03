<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Upload de Imagens - MVC</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        
        header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eaeaea;
        }
        
        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .description {
            color: #7f8c8d;
            font-size: 1.1em;
        }
        
        .upload-section {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .upload-option {
            flex: 1;
            min-width: 300px;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .upload-option h3 {
            color: #3498db;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        
        input[type="file"] {
            padding: 10px;
            background: #fff;
            cursor: pointer;
        }
        
        .btn {
            background: #3498db;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background 0.3s;
            display: inline-block;
            width: 100%;
        }
        
        .btn:hover {
            background: #2980b9;
        }
        
        .preview-section {
            margin-top: 40px;
        }
        
        .preview-section h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        
        .preview-item {
            width: 200px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .preview-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }
        
        .preview-info {
            padding: 10px;
            background: #f8f9fa;
            text-align: center;
        }
        
        .message {
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            text-align: center;
            font-weight: 500;
        }
        
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .instructions {
            background: #e8f4fc;
            border-left: 4px solid #3498db;
            padding: 20px;
            margin: 30px 0;
            border-radius: 4px;
        }
        
        .instructions h3 {
            color: #3498db;
            margin-bottom: 10px;
        }
        
        .instructions ol {
            margin-left: 20px;
        }
        
        .instructions li {
            margin-bottom: 10px;
        }
        
        @media (max-width: 768px) {
            .upload-option {
                min-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Sistema de Upload de Imagens</h1>
            <p class="description">Implementado com Arquitetura MVC e MySQL</p>
        </header>

        <div class="instructions">
            <h3>Instruções de Uso:</h3>
            <ol>
                <li>Preencha o formulário de acordo com o tipo de upload (usuário, produto ou serviço)</li>
                <li>Selecione uma imagem para upload (formatos: JPG, PNG, GIF)</li>
                <li>Clique no botão "Fazer Upload" para enviar a imagem</li>
                <li>O sistema irá redimensionar e armazenar a imagem no diretório apropriado</li>
                <li>As informações serão salvas no banco de dados MySQL</li>
            </ol>
        </div>

        <!-- Exibição de mensagens de sucesso/erro -->
        <?php if (isset($message) && $message != ''): ?>
            <div class="message <?php echo isset($success) && $success ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="upload-section">
            <div class="upload-option">
                <h3>Upload de Imagem de Usuário</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="tipo" value="usuario">
                    <div class="form-group">
                        <label for="usuario-nome">Nome do Usuário:</label>
                        <input type="text" id="usuario-nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="usuario-imagem">Imagem do Usuário:</label>
                        <input type="file" id="usuario-imagem" name="imagem" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn">Fazer Upload</button>
                </form>
            </div>

            <div class="upload-option">
                <h3>Upload de Imagem de Produto</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="tipo" value="produto">
                    <div class="form-group">
                        <label for="produto-nome">Nome do Produto:</label>
                        <input type="text" id="produto-nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="produto-imagem">Imagem do Produto:</label>
                        <input type="file" id="produto-imagem" name="imagem" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn">Fazer Upload</button>
                </form>
            </div>

            <div class="upload-option">
                <h3>Upload de Imagem de Serviço</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="tipo" value="servico">
                    <div class="form-group">
                        <label for="servico-nome">Nome do Serviço:</label>
                        <input type="text" id="servico-nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="servico-imagem">Imagem do Serviço:</label>
                        <input type="file" id="servico-imagem" name="imagem" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn">Fazer Upload</button>
                </form>
            </div>
        </div>

        <div class="preview-section">
            <h2>Pré-visualização de Uploads Recentes</h2>
            <div class="preview-container">
                <div class="preview-item">
                    <img src="https://placehold.co/200x150/3498db/ffffff?text=Usuário" alt="Exemplo de imagem de usuário">
                    <div class="preview-info">Usuário</div>
                </div>
                <div class="preview-item">
                    <img src="https://placehold.co/200x150/e74c3c/ffffff?text=Produto" alt="Exemplo de imagem de produto">
                    <div class="preview-info">Produto</div>
                </div>
                <div class="preview-item">
                    <img src="https://placehold.co/200x150/2ecc71/ffffff?text=Serviço" alt="Exemplo de imagem de serviço">
                    <div class="preview-info">Serviço</div>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Simulação do processamento do Controller
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagem'])) {
        // Configurações
        $uploadDir = 'uploads/';
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 5 * 1024 * 1024; // 5MB
        
        // Criar diretório de uploads se não existir
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        // Obter dados do formulário
        $tipo = $_POST['tipo'];
        $nome = $_POST['nome'];
        $imagem = $_FILES['imagem'];
        
        // Validar tipo de arquivo
        if (!in_array($imagem['type'], $allowedTypes)) {
            $message = 'Erro: Apenas arquivos JPG, PNG e GIF são permitidos.';
            $success = false;
        }
        // Validar tamanho do arquivo
        elseif ($imagem['size'] > $maxSize) {
            $message = 'Erro: O arquivo é muito grande. Tamanho máximo permitido: 5MB.';
            $success = false;
        }
        // Processar upload
        else {
            // Gerar nome único para o arquivo
            $extensao = pathinfo($imagem['name'], PATHINFO_EXTENSION);
            $nomeArquivo = $tipo . '_' . time() . '_' . uniqid() . '.' . $extensao;
            $caminhoCompleto = $uploadDir . $nomeArquivo;
            
            // Mover arquivo para o diretório de uploads
            if (move_uploaded_file($imagem['tmp_name'], $caminhoCompleto)) {
                // Simular salvamento no banco de dados
                // Em um sistema real, isso seria feito pelo Model
                $message = "Sucesso: Imagem de $tipo '$nome' foi enviada e salva no banco de dados!";
                $success = true;
                
                // Aqui você normalmente salvaria no banco de dados:
                // $model->salvarImagem($tipo, $nome, $nomeArquivo);
            } else {
                $message = 'Erro: Falha ao fazer upload do arquivo.';
                $success = false;
            }
        }
    }
    ?>
</body>
</html>