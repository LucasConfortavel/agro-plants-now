<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up-add-servico.css">
    <title>Adicionar Serviço</title>
</head>
<body>
    <div class="eze_container">
        <div class="eze_tab-header">
            <button class="eze_tab-button eze_active" id="produto-tab">Adicionar Serviço</button>
            <button class="eze_tab-button" id="imagem-tab">Imagem do Serviço</button>
        </div>
        
        <div id="produto-content" class="eze_form-section">
            <form>
                <div class="eze_form-row">
                    <div class="eze_form-group">
                        <div class="eze_form-label-group">
                            <span class="eze_required">*</span>
                            <label class="eze_label-text">Obrigatório</label>
                        </div>
                        <input type="text" class="eze_form-control" placeholder="Nome">
                    </div>
                    <div class="eze_form-group">
                        <div class="eze_form-label-group">
                            <span class="eze_required">*</span>
                            <label class="eze_label-text">Obrigatório</label>
                        </div>
                        <input type="text" class="eze_form-control" placeholder="R$ 00,00">
                    </div>
                </div>
                <div class="eze_form-row">
                    <div class="eze_form-group">
                        <div class="eze_form-label-group">
                            <span class="eze_required">*</span>
                            <label class="eze_label-text">Obrigatório</label>
                        </div>
                        <input type="text" class="eze_form-control eze_form-control2" placeholder="Categoria">
                    </div>
                </div>
            </form>
            
            <div class="eze_button-container eze_button-container2">
                <button type="button" class="eze_add-button"onclick= "window.location.href='../adm/add-prod-serv.php'">Adicionar produto</button>
                <p class="eze_help-text">Adicione a imagem do produto antes de</p>
                <p class="eze_help-text">adicioná-lo.</p>
            </div>
        </div>
        
        <div id="imagem-content" class="eze_form-section">
            <div class="eze_image-placeholder">
                <div class="eze_placeholder-icon">
                    <img src="../../PUBLIC/img/img_add-img.png" alt="">
                </div>
                <span>Imagem</span>
            </div>
            
            <div class="eze_button-container">
                <button type="button" class="eze_add-button">Adicionar imagem</button>
            </div>
        </div>
    </div>
    <script src="../../PUBLIC/JS/pop-up-add-prod-serv.js"></script>
</body>
</html>