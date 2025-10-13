<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Vendedor</title>
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up-cadastrar_vendedor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="eze-container">
        <div class="eze-tab-header">
            <button class="eze-tab-button eze-active" id="cliente-tab">Cadastrar Vendedor</button>
            <!-- <button class="eze-tab-button" id="documento-tab">Foto de Perfil</button> -->
        </div>

        <form action="#" method="post" class="ym_form-pop-up">
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
                    <div class="eze-form-group">
                        <div class="eze-form-label-group">
                            <label class="eze-label-text">Senha</label>
                            <span class="eze-required">*</span>
                        </div>
                        <input type="password" class="ym_input-padrao" name="senha" placeholder="Senha" required>
                    </div>
                </div>

                <div class="eze-form-row">
                    <div class="eze-form-group">
                        <div class="eze-form-label-group">
                            <label class="eze-label-text">Data de nascimento</label>
                            <span class="eze-required">*</span>
                        </div>
                        <input type="date" class="ym_input-padrao" name="data_nasc" required>
                    </div>

                    <div class="eze-form-group">
                        <div class="eze-form-label-group">
                            <label class="eze-label-text">CPF</label>
                            <span class="eze-required">*</span>
                        </div>
                        <input type="text" class="ym_input-padrao" name="CPF" placeholder="CPF ou CNPJ" required>
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
                    <button  class="eze-add-button" name="adicionar" onclick="prosseguir()">Prosseguir</button>
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
                    <span>Clique para adicionar foto de perfil</span>
                </div>

                <div class="eze-form-row">
                    <div class="eze-form-group">
                        <div class="eze-form-label-group">
                            <label class="eze-label-text">CEP</label>
                            <span class="eze-required">*</span>
                        </div>
                        <input type="text" class="ym_input-padrao" name="cep" placeholder="Digite o CEP" required>
                    </div>
                </div>

                <div class="eze-button-container">
                    <button type="submit" name="adicionar" class="eze-add-button eze-add-button2 eze-add-documento">Cadastrar vendedor</button>
                </div>
                <div class="eze-button-container">
                    <button class="eze-add-button" onclick="retornar()" style="gap: 5px;"><i class="fa-solid fa-arrow-left"></i>Voltar</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        area2 = document.getElementById("documento-content");
        area2.style.display = "none";

        btn = document.getElementsByClassName("eze-add-button")[0];

        function prosseguir(){
            area1 = document.getElementById("cliente-content");
            area2 = document.getElementById("documento-content");

            area1.style.animation = "sumir 0.5s ease";

            setTimeout(() => {
                area1.style.display = "none";
            }, 500);

            area2.style.animation = "aparecer 0.5s ease";

            setTimeout(() => {
                area2.style.display = "block";
            }, 500);
        }

        function retornar(){
            area1 = document.getElementById("cliente-content");
            area2 = document.getElementById("documento-content");

            area2.style.animation = "sumir 0.5s ease";

            setTimeout(() => {
                area2.style.display = "none";
            }, 500);

            area1.style.animation = "aparecer 0.5s ease";

            setTimeout(() => {
                area1.style.display = "block";
            }, 500);
        }
    </script>
</body>
</html>
