<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../PUBLIC/css/pop-up_remover_vendedor.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <title>Adicionar Serviço</title>
</head>
<body>
    <div class="ym_area-pop-up">
        <div class="ym_area-titulo">
            <h1 class="ym_titulo">Remover vendedor</h1>
        </div>

        <form class="sab_form" action="../adm/lista-vendedores-adm.php" method="post">
            <div class="ym_input-area">
                <label class="sab_label-text"><span class="sab_required">*</span>Obrigatório</label>
                <input type="text" class="ym_input-padrao" placeholder="CPF">
            </div>

            <input type="submit" class="ym_btn-remover"  value="Remover">    
        </form>
    </div>
</body>
</html>