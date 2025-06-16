<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Vendedor</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up-cadastrar_vendedor.css">
</head>
<body>
<<<<<<< HEAD
    <div class="gs_popup">
        <div class="gs_popup-conteudo">
            <h2 class="gs_titulo">Cadastro de Vendedor</h2>
            <form method="POST" class="gs_formulario">
                               
                <div class="gs_linha-formulario">
                    <div class="gs_grupo-formulario">
                        <label class="gs_legenda">*Nome</label>
                        <input type="text" name="nome" class="gs_entrada" placeholder="Nome" required>
                    </div>
                    <div class="gs_grupo-formulario">
                        <label class="gs_legenda">Telefone</label>
                        <input type="tel" name="telefone" class="gs_entrada" placeholder="Telefone">
                    </div>
=======
    <section class="gs_area-pop-up">
        <div class="gs_pop-up">
            
            <div class="gs_superior-pop-up">
                <a class="gs_cadastrar-vend">Cadastrar vendedor</a>
            </div>

            <form action="" method="post" class="gs_form-pop-up">

                <div class="gs_area-input">
                    <p class="gs_input-aviso-obrigatorio">*obrigatório</p>
                    <input class="gs_pop-up-input" name="nome" type="text" placeholder="Nome" oninput="gs_Validacao(this)">
>>>>>>> 892787b51c021dd06e7ccf2392efbd1e2dfb9da0
                </div>
                <div class="gs_area-input">
                    <p class="gs_input-aviso">Coloque pelo menos uma dessas informações(E-mail, Telefone)</p>
                    <input class="gs_pop-up-input" name="telefone" type="text" placeholder="Telefone">
                </div>
                <div class="gs_area-input">
                    <p class="gs_input-aviso-obrigatorio">*obrigatório</p>
                    <input class="gs_pop-up-input" name="data_nasc" type="text" placeholder="Data de nascimento" oninput="gs_Validacao(this)">
                </div>
                <div class="gs_area-input">
                    <input class="gs_pop-up-input" name="email" type="text" placeholder="E-mail">
                </div>
                <div class="gs_area-input">
                    <p class="gs_input-aviso-obrigatorio">*obrigatório</p>
                    <input class="gs_pop-up-input" name="cpf" type="text" placeholder="CPF" oninput="gs_Validacao(this)">
                </div>

                <div class="gs_area-btn-submit">
                    <input class="gs_pop-up-btn-submit" name="adicionar" type="submit" value="Cadastrar Vendedor">
                </div>

            </form>

            <form action="" method="post" class="gs_form-pop-up gs_form-mobile">

                <div class="gs_area-input">
                    <p class="gs_input-aviso-obrigatorio">*obrigatório</p>
                    <input class="gs_pop-up-input" name="nome" type="text" placeholder="Nome" oninput="gs_Validacao(this)">
                </div>

                <div class="gs_area-input">
                    <p class="gs_input-aviso-obrigatorio">*obrigatório</p>
                    <input class="gs_pop-up-input" name="data_nasc" type="text" placeholder="Data de nascimento" oninput="gs_Validacao(this)">
                </div>

                <div class="gs_area-input">
                    <p class="gs_input-aviso-obrigatorio">*obrigatório</p>
                    <input class="gs_pop-up-input" name="cpf" type="text" placeholder="CPF" oninput="gs_Validacao(this)">
                </div>

                <div class="gs_area-input">
                    <p class="gs_input-aviso">Coloque pelo menos uma dessas informações(Telefone, E-mail)</p>
                    <input class="gs_pop-up-input" name="telefone" type="text" placeholder="Telefone">
                </div>
                
                <div class="gs_area-input">
                    <input class="gs_pop-up-input" name="email" type="text" placeholder="E-mail">
                </div>

                <div class="gs_area-btn-submit">
                    <input class="gs_pop-up-btn-submit" name="adicionar" type="submit" value="Cadastrar cliente">
                </div>

            </form>

        </div>
    </section>

<script>
    function gs_Validacao(inputElement) {
        const parentDiv = inputElement.closest(".gs_area-input");
        const aviso = parentDiv.querySelector(".gs_input-aviso-obrigatorio");

        if (inputElement.value.trim().length < 1) {
            aviso.style.display = "block";
        } else {
            aviso.style.display = "none";
        }
    }
</script>

</body>
</html>
