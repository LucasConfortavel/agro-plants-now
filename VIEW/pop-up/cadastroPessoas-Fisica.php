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
        header("location:../../VIEW/adm/clientes-adm.php");
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Pessoa Física</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up-cadastroPessoas.css">
</head>
<body>
    <div class="ym_pop-up">

        <div class="ym_superior-pop-up">
            <a class="ym_pop-up-select ym_pessoa-fisica">Pessoa Física</a>
            <a class="ym_pop-up-select ym_pessoa-juridica" style="background-color: #c9c9c9; border-left: 2px solid rgb(190, 190, 190); border-bottom: 2px solid rgb(190, 190, 190); border-radius: 0px 0px 0px 10px; cursor: pointer; " onclick="abrirPopup('../../VIEW/pop-up/cadastroPessoas-Juridica.php')" >Pessoa Jurídica</a>
            
        </div>

        <form action="" method="post" class="ym_form-pop-up">

            <div class="ym_area-input">
                <p class="ym_input-aviso-obrigatorio">*obrigatório</p>
                <input class="ym_pop-up-input" name="nome" type="text" placeholder="Nome" oninput="ym_Validacao(0,0)">
            </div>
            <div class="ym_area-input">
                <p class="ym_input-aviso">Coloque pelo menos uma dessas informações(E-mail, Telefone)</p>
                <input class="ym_pop-up-input" name="telefone" type="text" placeholder="Telefone">
            </div>
            <div class="ym_area-input">
                <p class="ym_input-aviso-obrigatorio">*obrigatório</p>
                <input class="ym_pop-up-input" name="data_nasc" type="text" placeholder="Data de nascimento" oninput="ym_Validacao(2,1)" >
            </div>
            <div class="ym_area-input">
                <input class="ym_pop-up-input" name="email" type="text" placeholder="E-mail">
            </div>
            <div class="ym_area-input">
                <p class="ym_input-aviso-obrigatorio">*obrigatório</p>
                <input class="ym_pop-up-input" name="cpf" type="text" placeholder="CPF" oninput="ym_Validacao(4,2)" >
            </div>

            <div class="ym_area-btn-submit">
                <input class="ym_pop-up-btn-submit" name="adicionar" type="submit" value="Cadastrar cliente">
            </div>


        </form>

        <form action="" method="post" class="ym_form-pop-up ym_form-mobile">

            <div class="ym_area-input">
                <p class="ym_input-aviso-obrigatorio">*obrigatório</p>
                <input class="ym_pop-up-input" name="nome" type="text" placeholder="Nome" oninput="ym_Validacao(5,3)">
            </div>

            <div class="ym_area-input">
                <p class="ym_input-aviso-obrigatorio">*obrigatório</p>
                <input class="ym_pop-up-input" name="data_nasc" type="text" placeholder="Data de nascimento" oninput="ym_Validacao(6,4)" >
            </div>

            <div class="ym_area-input">
                <p class="ym_input-aviso-obrigatorio">*obrigatório</p>
                <input class="ym_pop-up-input" name="cpf" type="text" placeholder="CPF" oninput="ym_Validacao(7,5)" >
            </div>

            <div class="ym_area-input">
                <p class="ym_input-aviso">Coloque pelo menos uma dessas informações(Telefone, E-mail)</p>
                <input class="ym_pop-up-input" name="telefone" type="text" placeholder="Telefone">
            </div>
            
            <div class="ym_area-input">
                <input class="ym_pop-up-input" name="email" type="text" placeholder="E-mail">
            </div>
            

            <div class="ym_area-btn-submit">
                <input class="ym_pop-up-btn-submit" name="adicionar" type="submit" value="Cadastrar cliente">
            </div>


        </form>

    </div>


<script>

    function ym_Validacao(ym_index_input,ym_index_msg){
        const ym_inputs = document.querySelectorAll(".ym_pop-up-input");
        const ym_msg = document.querySelectorAll(".ym_input-aviso-obrigatorio");
        
        if(ym_inputs[ym_index_input].value.length<1){
            setError(ym_index_msg);
        }
        else{
            removeError(ym_index_msg);
        }
        function setError(index){
            ym_msg[index].style.display = "block";
        }

        function removeError(index){
            ym_msg[index].style.display='none';
        }

    }

</script>
</body>
</html>