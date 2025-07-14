<?php
    if(isset($_POST['adicionar'])){
        header("location:../../VIEW/adm/vendas-adm.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Venda - PJ</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up-cadastroVenda.css">
</head>
<body>
    <div class="ym_pop-up">

        <div class="ym_superior-pop-up">
            <a class="ym_pop-up-select ym_pessoa-fisica" onclick="abrirPopup('../../VIEW/pop-up/cadastroVenda-Fisica.php')" style="background-color: #c9c9c9; border-left: 2px solid rgb(190, 190, 190); border-bottom: 2px solid rgb(190, 190, 190); border-radius: 0px 0px 10px 0px; cursor: pointer;">Pessoa Física</a>
            <a class="ym_pop-up-select ym_pessoa-juridica" >Pessoa Jurídica</a>
        </div>

        <form action="" method="post" class="ym_form-pop-up">
            
            <div class="ym_area-input">
                <p class="ym_input-aviso-obrigatorio">*obrigatório</p>
                <input class="ym_pop-up-input" type="text" placeholder="CNPJ" oninput="ym_Validacao()">
            </div>
            <div class="ym_area-input">
                <p class="ym_input-aviso-obrigatorio">*obrigatório</p>
                <input class="ym_pop-up-input" name="valor" type="text" placeholder="Valor" value="0,00$" oninput="ym_Validacao()">
            </div>

            <div class="ym_area-btn-submit">
                <input class="ym_pop-up-btn-submit"  name="adicionar" type="submit" value="Avançar">
            </div>


        </form>

    </div>

<script>
    
    function ym_Validacao(){
        const ym_inputs = document.querySelectorAll(".ym_pop-up-input");
        const ym_msg = document.querySelectorAll(".ym_input-aviso-obrigatorio");
        
        if(ym_inputs[0].value.length<1){
            setError(0);
        }
        else{
            removeError(0);
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