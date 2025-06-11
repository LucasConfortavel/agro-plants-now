<?php
    if(isset($_POST['cadastrar'])){
        header("location:../adm/lista-vendedores-adm.php");
    }

?>


<!DOCTYPE html>
<html lang="pt-BR"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Vendedor</title>
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up-cadastrar_vendedor.css">
</head>
<body>
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
                </div>
                
                <div class="gs_linha-formulario">
                    <div class="gs_grupo-formulario">
                        <label class="gs_legenda">*Data de Nascimento</label>
                        <input type="date" name="data_nascimento" class="gs_entrada" required>
                    </div>
                    <div class="gs_grupo-formulario">
                        <label class="gs_legenda">E-mail</label>
                        <input type="email" name="email" class="gs_entrada" placeholder="E-mail">
                    </div>
                </div>
                
                <div class="gs_grupo-formulario">
                    <label class="gs_legenda">*CPF</label>
                    <input type="text" name="cpf" class="gs_entrada" placeholder="CPF" required>
                </div>
                <input class="gs_botao" type="submit" name="cadastrar" value="Cadastrar Vendedor">
                
                
                
            </form>
        </div>
    </div>
</body>
</html>     