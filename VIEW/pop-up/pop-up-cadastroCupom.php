<?php

if(isset($_POST['cadastrar'])){
    header("location:../adm/Cupom_adm.php");
}


?>

<!DOCTYPE html>
<html lang="ptbr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cupom</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up-cadastroCupom.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
</head>
<body>
    <form method="POST" class="ym_formulario">
        <div class="ym_area-input"> 
            <p class="ym_titulo-input">Desconto*</p>
            <input type="text" placeholder="Valor de desconto" class="ym_input-form">
        </div>  

        <div class="ym_area-input">
            <p class="ym_titulo-input">Descrição*</p>
            <input type="text" placeholder="Descrição" class="ym_input-form">
        </div>

        <div class="ym_area-input">
            <p class="ym_titulo-input">Data de validade</p>
            <input type="date" placeholder="Data de validade" class="ym_input-form">
        </div>

        <div class="ym_area-input">
            <p class="ym_titulo-input">Código*</p>
            <div class="ym_input-form">
                <button class="ym_btn-gerarcodigo"><img class="ym_btn-img" src="../../PUBLIC/img/img_add.png" alt=""></button>
                <input type="text" placeholder="Gerar código único">
            </div>
        </div>
        
        <input type="submit" class="ym_btn-padrao" name="cadastrar" value="Cadastrar cupom">
    </form>
</body>
</html>