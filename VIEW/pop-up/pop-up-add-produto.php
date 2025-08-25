<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up-add-produto.css">
</head>
<body>
    <div class="eze-container">
        <div class="eze-tab-header">
            <button class="eze-tab-button eze-active" id="cliente-tab">Adicionar produto</button>
            <button class="eze-tab-button" id="documento-tab">Imagem</button>
        </div>

        <form action="" method="post" class="ym_form-pop-up">
            <div id="cliente-content" class="eze-form-section active">
                <div class="eze-form-row">
                    <div class="eze-form-group">
                        <div class="eze-form-label-group">
                            <label class="eze-label-text">Nome</label>
                            <span class="eze-required">*</span>
                        </div>
                        <input type="text" class="ym_input-padrao" name="nome" placeholder="Nome completo" required>
                    </div>
                </div>

                <div class="eze-form-row">
                    <div class="eze-form-group">
                        <div class="eze-form-label-group">
                            <label class="eze-label-text">Categoria</label>
                            <span class="eze-required">*</span>
                        </div>

                        <div class="ym_area-select">
                            <div class="ym_select" onclick="mostrar_categorias()">
                                <p class="ym_categoria-select">Produto</p>
                                <p class="ym_seta-categoria">></p>
                            </div>
                            
                            
                            <div class="ym_options">
                                <a class="ym_link-option" onclick="trocar_categoria()"></i> Serviço</a>
                            </div>
                            
                        </div>

                    </div>

                    <div class="eze-form-group">
                        <div class="eze-form-label-group">
                            <label class="eze-label-text">Preço</label>
                            <span class="eze-required">*</span>
                        </div>
                        <input type="text" class="ym_input-padrao" name="preco" placeholder="R$ 0,00" required>
                    </div>
                </div>

                <div class="eze-form-group">
                    <div class="eze-form-label-group">
                        <label class="eze-label-text">Descrição</label>
                        <span class="eze-required">*</span>
                    </div>
                    <textarea class="ym_input-padrao ym_textarea" name="descricao" placeholder="Escreva algo sobre o produto" style="resize: none;"></textarea>
                </div>

                <div class="eze-button-container eze-button-container2">
                    <button type="submit" class="eze-add-button" name="adicionar">Adicionar produto</button>
                    <p class="eze-help-text"><span class="eze-required">*</span>Campos obrigatórios</p>
                </div>
            </div>

            <div id="documento-content" class="eze-form-section">
                <input type="file" id="imageInput" accept="image/*" style="display: none;">
                
                <div class="eze-image-placeholder ym_input-padrao" id="imagePreview">
                    <div class="eze-placeholder-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14,2 14,8 20,8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10,9 9,9 8,9"></polyline>
                        </svg>
                    </div>
                    <span>Clique para adicionar imagem</span>
                </div>

                <div class="eze-button-container">
                    <button type="button" class="eze-add-button eze-add-button2 eze-add-documento">Adicionar Imagem</button>
                </div>
            </div>
        </form>
    </div>
    
    <script src="../../PUBLIC/JS/script-select.js"></script>
    <script>
        function switchTab(activeTabId, activeContentId) {
            document.querySelectorAll('.eze-tab-button').forEach(btn => {
                btn.classList.remove('eze-active');
            });
            
            document.querySelectorAll('.eze-form-section').forEach(section => {
                section.classList.remove('active');
            });
            
            document.getElementById(activeTabId).classList.add('eze-active');
            document.getElementById(activeContentId).classList.add('active');
        }

        document.getElementById('cliente-tab').addEventListener('click', () => {
            switchTab('cliente-tab', 'cliente-content');
        });

        document.getElementById('documento-tab').addEventListener('click', () => {
            switchTab('documento-tab', 'documento-content');
        });

        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const addImageBtn = document.querySelector('.eze-add-documento');

        imagePreview.addEventListener('click', () => {
            imageInput.click();
        });

        addImageBtn.addEventListener('click', () => {
            imageInput.click();
        });

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" style="max-width: 100%; max-height: 200px; object-fit: contain; border-radius: 8px;">
                        <span style="margin-top: 10px; display: block;">Clique para trocar a imagem</span>
                    `;
                    imagePreview.style.cursor = 'pointer';
                };
                reader.readAsDataURL(file);
            }
        });

        document.querySelector('input[name="preco"]').addEventListener('input', function(e) {
            let valor = e.target.value.replace(/\D/g, '');
            valor = (valor / 100).toFixed(2) + '';
            valor = valor.replace(".", ",");
            valor = valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            e.target.value = 'R$ ' + valor;
        });

    </script>
</body>
</html>
