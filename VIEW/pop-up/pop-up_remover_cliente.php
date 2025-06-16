<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up_remover_cliente.css">
    <title>Adicionar Produto</title>
</head>
<body>
    <div class="sab-container">
        <div class="sab-tab-header">
            <button class="sab-tab-button sab-active" id="clientefisico-tab">Pessoa física</button>
            <button class="sab-tab-button" id="juridico-tab">Pessoa júridica</button>
        </div>
        <div id="fisico-content" class="sab-form-section">
            <form>
                <div class="sab-form-row">
                    <div class="sab-form-group">
                        <div class="sab-form-label-group">
                            <span class="sab-required">*</span>
                            <label class="sab-label-text">Obrigatório</label>
                        </div>
                        <input type="text" class="sab-form-control" placeholder="CPF">
                    </div>
                </div>
            </form>
            
            <div class="sab-button-container sab-button-container2">
                <a class="sab-add-button" href="conf_remover_cliente.php">Avançar</a>
            </div>
        </div>
        
        <div id="juridico-content" class="sab-form-section">

            <form>
                <div class="sab-form-row">
                    <div class="sab-form-group">
                        <div class="sab-form-label-group">
                            <span class="sab-required">*</span>
                            <label class="sab-label-text">Obrigatório</label>
                        </div>
                        <input type="text" class="sab-form-control" placeholder="CNPJ">
                    </div>
                </div>
            </form>
            
            <div class="sab-button-container sab-button-container2">
                <a class="sab-add-button" href="conf_remover_cliente(cnpj).php">Avançar</a>
            </div>
            
        </div>
    </div>
    <script src="../../PUBLIC/JS/pop-up_remover_cliente.js"></script>
</body>
</html>