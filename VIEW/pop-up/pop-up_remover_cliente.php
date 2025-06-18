<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up_remover_cliente.css">
    <title>Adicionar Produto</title>
</head>
<body>
    <div class="sab_container">
        <div class="sab_tab-header">
            <button class="sab_tab-button sab_active" id="sab_clientefisico-tab">Pessoa física</button>
            <button class="sab_tab-button" id="sab_juridico-tab">Pessoa júridica</button>
        </div>
        <div id="sab_fisico-content" class="sab_form-section">
            <form>
                <div class="sab_form-row">
                    <div class="sab_form-group">
                        <div class="sab_form-label-group">
                            <span class="sab_required">*</span>
                            <label class="sab_label-text">Obrigatório</label>
                        </div>
                        <input type="text" class="sab_form-control" placeholder="CPF">
                    </div>
                </div>
            </form>
            
            <div class="sab_button-container sab_button-container2">
                <a class="sab_add-button" href="conf_remover_cliente.php">Avançar</a>

            </div>
        </div>
        
        <div id="juridico-content" class="sab_form-section">

            <form>
                <div class="sab_form-row">
                    <div class="sab_form-group">
                        <div class="sab_form-label-group">
                            <span class="sab_required">*</span>
                            <label class="sab_label-text">Obrigatório</label>
                        </div>
                        <input type="text" class="sab_form-control" placeholder="CNPJ">
                    </div>
                </div>
            </form>
            
            <div class="sab_button-container sab_button-container2">
                <a class="sab_add-button" href="conf_remover_cliente(cnpj).php">Avançar</a>

            
        </div>
    </div>
    <script src="../../PUBLIC/JS/pop-up_remover_cliente.js"></script>
</body>
</html>