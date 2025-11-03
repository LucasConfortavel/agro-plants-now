<?php
include "../../CONTROLLER/ProdutoController.php";
include "../../CONTROLLER/MensagensController.php";
include "../../INCLUDE/verificarLogin.php";

$produtoController = new ProdutoController();
$produtosBaixoEstoque = $produtoController->produtoNotificacoes();


$alertas = [];

// Produtos
foreach ($produtosBaixoEstoque as $produto) {
    $alertas[] = [
        "tipo" => "produto",
        "mensagem" => "<b>Estoque baixo:</b> " . htmlspecialchars($produto['nome']) . 
                      " (Quantidade: " . htmlspecialchars($produto['quantidade']) . ")",
        "hora" => date("H:i")
    ];
}

$mensagemController = new MessageController();
$ultimasMensagens = $mensagemController->index();

// if (!is_array($ultimasMensagens)) {
//     $ultimasMensagens = [];
// }
// print_r($ultimasMensagens);

// Mensagens
foreach ($ultimasMensagens as $mensagens) {
    $alertas[] = [
        "tipo" => "mensagem",
        "mensagem" => "<b>Nova mensagem:</b> " . htmlspecialchars($mensagens['nome']) .
                      " - " . htmlspecialchars($mensagens['email']),
        "hora" => date("H:i")
    ];
}

$alertasVisiveis = !empty($alertas) ? array_slice($alertas, 0, 5) : [];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificações</title>

    <link rel="stylesheet" 
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="../PUBLIC/css/btn-notificacao.css">

</head>
<body>
    <div class="ym_box-notificacao">
        <div class="ym_area-notificacao">
            <div class="ym_area-icons">
                <div class="jp_notification-icon">
                    <i class="fas fa-bell ym_icon-sino"></i>
                    <div class="ym_indicador-notificacoes">
                        <p class="ym_p"><?= count($alertasVisiveis) ?></p>
                    </div>
                </div>
                <div class="ym_titulo-notficacoes">
                    <p class="ym_p">Suas notificações</p>
                </div>
            </div>

            <div class="ym_notificacoes" style="max-height:300px; overflow-y:auto; padding-top: 20px;">
                <?php if (!empty($alertasVisiveis)): ?>
                    <?php foreach ($alertasVisiveis as $alerta): ?>
                        <div class="ym_notificacao-item <?= $alerta['tipo'] ?>">
                            <p class="ym_p"><?= $alerta['mensagem'] ?></p>  
                            <p class="ym_p hora"><?= $alerta['hora'] ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="ym_notificacao-item">
                        <p class="ym_p">Nenhuma notificação no momento</p>
                    </div>
                <?php endif; ?>
                <div class="vc_ver-mais">
                    <a class="vc_not-more" href="../../VIEW/adm/notificacao-adm.php">Ver Mais...</a>
                </div>
            </div>
        </div>
    </div>

    <script src="../../PUBLIC/JS/script_btn-notificacao.js"></script>
</body>
</html>
