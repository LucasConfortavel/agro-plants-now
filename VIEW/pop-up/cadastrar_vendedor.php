<?php

    // if(isset($_POST['adicionar'])){

    //     $nome = $_POST['nome'];
    //     $data_nasc = $_POST['data_nasc'];
    //     $cpf = $_POST['cpf'];
    //     $telefone = $_POST['telefone'];
    //     $email = $_POST['email'];
        
    //     $sql = "INSERT INTO";

    //     $result_create = mysqli_query($conn,$sql);

    //     if(!$result_create){
    //         echo'<script>alert("Não foi possível cadastrar")</script>';
    //     }

    // }

    if(isset($_POST['adicionar'])){
        header("location:../../VIEW/adm/lista-vendedores-adm.php");
    }

?>

<!-- ESSE POP UP AINDA NÃO LINKA PQ O YURI JÁ  FEZ ELE CONECTAR AUTOMATICAMENTE COM O BACKEND, OU SEJA, SÓ VAI FUNCIONAR QUANDO O BACKEND FUNCIONAR TAMBÉM -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Vendedor</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up-cadastrar_vendedor.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
</head>
<body>

    <div class="gs_pop-up">
        
        <div class="gs_superior-pop-up">
            <h1 class="ym_titulo">Cadastrar vendedor</h1>
        </div>

        <form action="" method="post" class="gs_form-pop-up">

            <div class="gs_area-input">
                <p class="gs_input-aviso-obrigatorio">*obrigatório</p>
                <input class="ym_input-padrao" name="nome" type="text" placeholder="Nome" oninput="gs_Validacao(this)">
            </div>
            <div class="gs_area-input">
                <p class="gs_input-aviso">Coloque pelo menos uma dessas informações(E-mail, Telefone)</p>
                <input class="ym_input-padrao" name="telefone" type="text" placeholder="Telefone">
            </div>
            <div class="gs_area-input">
                <p class="gs_input-aviso-obrigatorio">*obrigatório</p>
                <input class="ym_input-padrao" name="data_nasc" type="text" placeholder="Data de nascimento" oninput="gs_Validacao(this)">
            </div>
            <div class="gs_area-input">
                <input class="ym_input-padrao" name="email" type="text" placeholder="E-mail">
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
                <input class="gs_pop-up-btn-submit" name="adicionar" type="submit" value="Cadastrar Vendedor">
            </div>



        </form>

    </div>

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
