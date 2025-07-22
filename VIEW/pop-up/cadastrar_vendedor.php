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

        <form action="" method="post" class="gs_form-pop-up">

            <div class="gs_area-input">
                <p class="ym_titulo-input">Nome*</p>
                <input class="ym_input-form" name="nome" type="text" placeholder="Nome" oninput="gs_Validacao(this)">
            </div>

            <div class="gs_area-input">
                <p class="ym_titulo-input">CPF*</p>
                <input class="ym_input-form" name="cpf" type="text" placeholder="CPF" oninput="gs_Validacao(this)">
            </div>

            <div class="gs_area-input">
                <p class="ym_titulo-input">Data de nascimento*</p>
                <input class="ym_input-form" name="data_nasc" type="date" placeholder="Data de nascimento" oninput="gs_Validacao(this)">
            </div>

            <div class="gs_area-input">
                <p class="ym_titulo-input">Email*</p>
                <input class="ym_input-form" name="email" type="email" placeholder="Email">
            </div>
            
            <div class="gs_area-input" id="ym_input-senha">
                <p class="ym_titulo-input">Senha*</p>
                <input class="ym_input-form" name="senha" type="password" placeholder="Senha">
            </div>
            
            <input class="ym_btn-padrao" name="adicionar" type="submit" value="Cadastrar Vendedor">

        </form>

    </div>

</body>
</html>
