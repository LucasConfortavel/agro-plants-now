<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up-add-produto.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <title>Adicionar Produto</title>
</head>
<body>
    <div class="eze-container">
        <div class="eze-tab-header">
            <button class="eze-tab-button eze-active" id="produto-tab">Adicionar Produto</button>
            <button class="eze-tab-button" id="imagem-tab">Imagem do Produto</button>
        </div>
        <div id="produto-content" class="eze-form-section">
            <form>
                <div class="eze-form-row">
                    <div class="eze-form-group">
                        <div class="eze-form-label-group">
                            <span class="eze-required">*</span>
                            <label class="eze-label-text">Obrigatório</label>
                        </div>
                        <input type="text" class="ym_input-padrao" placeholder="Nome">
                    </div>
                    <div class="eze-form-group">
                        <div class="eze-form-label-group">
                            <span class="eze-required">*</span>
                            <label class="eze-label-text">Obrigatório</label>
                        </div>
                        <input type="text" class="ym_input-padrao" placeholder="Quantidade">
                    </div>
                </div>
                
                <div class="eze-form-row">
                    <div class="eze-form-group">
                        <div class="eze-form-label-group">
                            <span class="eze-required">*</span>
                            <label class="eze-label-text">Obrigatório</label>
                        </div>
                        <input type="text" class="ym_input-padrao" placeholder="Categoria">
                    </div>
                    <div class="eze-form-group">
                        <div class="eze-form-label-group">
                            <span class="eze-required">*</span>
                            <label class="eze-label-text">Obrigatório</label>
                        </div>
                        <input type="text" class="ym_input-padrao" placeholder="R$ 00,00">
                    </div>
                </div>
            </form>
            
            <div class="eze-button-container eze-button-container2">
                <button type="button" class="eze-add-button">Adicionar produto</button>
                <p class="eze-help-text">Adicione a imagem do produto antes de</p>
                <p class="eze-help-text">adicioná-lo.</p>
            </div>
        </div>
        
        <div id="imagem-content" class="eze-form-section">
            <div class="eze-image-placeholder">
                <div class="eze-placeholder-icon">
                    <img src="../../PUBLIC/img/img_add-img.png" alt="">
                </div>
                <span>Imagem</span>
            </div>
            
            <div class="eze-button-container">
                <button type="button" class="eze-add-button eze-add-button2 eze-add-imagem">Adicionar imagem</button>
            </div>
        </div>
    </div>
    <script src="../../PUBLIC/JS/pop-up-add-prod-serv.js"></script>
</body>
</html>