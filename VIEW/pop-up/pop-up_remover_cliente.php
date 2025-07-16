
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação para remover Cliente CPF</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up-cadastroPessoas.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
</head>
<body>
    <form action="" method="post" class="ym_form-pop-up">
        <div class="ym_area-input">
            <p class="ym_titulo-input" id="ym_titulo-cpf-cnpj">CPF/CNPJ*</p>
            <input class="ym_input-form" maxlength="15" id="ym_input-cpf-cnpj" name="cpf/cnpj" type="text" placeholder="CPF/CNPJ" oninput="teste()" >
        </div>

        <input class="ym_btn-remover" name="adicionar" type="submit" value="Remover cliente">
    </form>  


</body>
</html>

<script>

    function teste(){
        var ym_area_input = document.getElementById('ym_titulo-cpf-cnpj');
        var input = document.getElementById('ym_input-cpf-cnpj');
        var valor = input.value.length;

        if(valor<11 || valor<15){
            cpf_cnpj = 'CPF/CNPJ*';
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