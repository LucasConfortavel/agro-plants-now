<?php
    require_once "../../DB/connect.php";


    if(isset($_POST['adicionar'])){
        $nome = $_POST['nome'];
        $data_nasc = $_POST['data_nasc'];
        $email = $_POST['email'];
        $cpf_cnpj = $_POST['cpf_cnpj'];  
        
        $sql = "INSERT INTO cliente (nome,data_nasc,email,CPF) VALUES ('$nome','$data_nasc','$email','$cpf_cnpj')";

        $result_create = mysqli_query($con,$sql);

        if(!$result_create){
            echo'<script>alert("Não foi possível cadastrar")</script>';
        }else{
            echo'<script>alert("Cliente Cadastrado")</script>';
        }

    }

    // if(isset($_POST['adicionar'])){
    //     header("location:../../VIEW/adm/clientes-adm.php");
    // }

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
        <form action="" method="post" class="ym_form-pop-up">

            <div class="ym_area-input">
                <p class="ym_titulo-input">Nome*</p>
                <input class="ym_input-form" name="nome" type="text" placeholder="Nome">
            </div>

            <div class="ym_area-input">
                <p class="ym_titulo-input">Data de nascimento*</p>
                <input class="ym_input-form" name="data_nasc" type="date">
            </div>
            <div class="ym_area-input">
                <p class="ym_titulo-input">Email*</p>
                <input class="ym_input-form" name="email" type="text" placeholder="E-mail">
            </div>
            <div class="ym_area-input">
                <p class="ym_titulo-input" id="ym_titulo-cpf-cnpj">CPF/CNPJ*</p>
                <input class="ym_input-form" maxlength="15" id="ym_input-cpf-cnpj" name="cpf_cnpj" type="text" placeholder="CPF/CNPJ" oninput="teste()" >
            </div>

            <input class="ym_btn-padrao" name="adicionar" type="submit" value="Cadastrar cliente">

        </form>        
</body>
</html>

<script>

    function teste(){
        var ym_area_input = document.getElementById('ym_titulo-cpf-cnpj');
        var input = document.getElementById('ym_input-cpf-cnpj');
        var valor = input.value.length;

        if(valor<11 || valor<15){
            cpf_cnpj = 'cpf_cnpj*';
            ym_area_input.innerHTML = `<p class="ym_titulo-input">${cpf_cnpj}</p>`;
        }
        if(valor==11){
            cpf_cnpj = 'CPF*';
            ym_area_input.innerHTML = `<p class="ym_titulo-input">${cpf_cnpj}</p>`;
        }

        if(valor==15){
            cpf_cnpj = 'CNPJ*';
            ym_area_input.innerHTML = `<p class="ym_titulo-input">${cpf_cnpj}</p>`;
        }

        console.log(valor);
    }
</script>