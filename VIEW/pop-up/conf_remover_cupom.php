<?php
    if(isset($_POST['remover'])){
        header("location:../adm/lista-vendedores-adm.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação para remover Vendedor</title>
    <link rel="stylesheet" href="../../PUBLIC/css/conf-remover.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
</head>
<body>
    <div class="ym_card">
        <h1 class="ym_titulo">Deseja remover este cupom?</h1>
        <div class="ym_area-btn">
            <button onclick="fecharPopup()" class="ym_btn-padrao">Cancelar</button>
            <button onclick="fecharPopup()" class="ym_btn-remover">Remover</button>
        </div>
    </div>
</body>
</html>

<script src="../../PUBLIC/JS/script-pop-up.js"></script>