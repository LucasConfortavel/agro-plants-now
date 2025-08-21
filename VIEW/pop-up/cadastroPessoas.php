<?php
    require_once "../../DB/connect.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Pessoa Física</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up-cadastroPessoas.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
</head>
<body>

    <div class="eze-container">
        <div class="eze-tab-header">
            <button class="eze-tab-button eze-active" id="cliente-tab">Cadastrar Clientes</button>
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
                            <label class="eze-label-text">Email</label>
                            <span class="eze-required">*</span>
                        </div>
                        <input type="email" class="ym_input-padrao" name="email" placeholder="Email" required>
                    </div>
                </div>

                <div class="eze-form-row">
                    <div class="eze-form-group">
                        <div class="eze-form-label-group">
                            <label class="eze-label-text">Data de nascimento</label>
                            <span class="eze-required">*</span>
                        </div>
                        <input type="date" class="ym_input-padrao" name="data" required>
                    </div>

                    <div class="eze-form-group">
                        <div class="eze-form-label-group">
                            <label class="eze-label-text">CPF/CNPJ</label>
                            <span class="eze-required">*</span>
                        </div>
                        <input type="text" class="ym_input-padrao" name="CPF/CNPJ" placeholder="CPF ou CNPJ" required>
                    </div>

                </div>

                <div class="eze-form-row">
                    <div class="eze-form-group">
                        <div class="eze-form-label-group">
                            <label class="eze-label-text">Telefone</label>
                            <span class="eze-required">*</span>
                        </div>
                        <input type="tel" class="ym_input-padrao" name="telefone" placeholder="Número de Telefone" required>
                    </div>
                </div>

                <div class="eze-button-container">
                    <button type="submit" class="eze-add-button" name="adicionar">Cadastrar Clientes</button>
                    <p class="eze-help-text"><span class="eze-required">*</span>Campos obrigatórios</p>
                </div>
            </div>

        </form>
    </div>

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

    </script>
</body>
</html>
