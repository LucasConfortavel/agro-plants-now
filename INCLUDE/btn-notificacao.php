<?php
require_once "../../DB/Database.php";
require_once "../../CONTROLLER/NotificacaoController.php";

$notificacaoCtrl = new NotificacaoController();
$notificacoes = $notificacaoCtrl->listarNotificacoes(5);

$alertas = [];

if (!isset($notificacoes['error']) && is_array($notificacoes)) {
    foreach ($notificacoes as $notificacao) {
        $alertas[] = [
            "mensagem" => "<b>" . htmlspecialchars($notificacao['titulo']) . "</b><br>" . nl2br(htmlspecialchars($notificacao['assunto'])),
            "hora"     => date("H:i", strtotime($notificacao['horario_criacao']))
        ];
    }
}

$alertasVisiveis = array_slice($alertas, 0, 2);
$totalNotificacoes = $notificacaoCtrl->contarNotificacoes();
?>

<div class="ym_box-notificacao">
    <div class="ym_area-notificacao">
        <div class="ym_area-icons">
            <div class="jp_notification-icon">
                <i class="fas fa-bell ym_icon-sino"></i>
            </div>

            <div class="ym_indicador-notificacoes">
                <p class="ym_p"><?= $totalNotificacoes ?></p>
            </div>

            <div class="ym_titulo-notficacoes">
                <p class="ym_p">Suas notificações</p>
            </div>
        </div>

        <div class="ym_notificacoes">
            <?php if (!empty($alertasVisiveis)): ?>
                <?php foreach ($alertasVisiveis as $alerta): ?>
                    <div class="ym_notificacao-item">
                        <p class="ym_p"><?= $alerta['mensagem'] ?></p>
                        <p class="ym_p"><?= $alerta['hora'] ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="ym_notificacao-item">
                    <p class="ym_p">Nenhuma notificação</p>
                </div>
            <?php endif; ?>

            <div class="vc_ver-mais">
                <a class="vc_not-more" href="../../VIEW/adm/notificacao-adm.php">Ver Mais...</a>
            </div>
        </div>
    </div>
</div>

<script>
const notificacao = document.getElementsByClassName('ym_area-notificacao')[0];
if (notificacao) {
    notificacao.addEventListener('click', () => {
        notificacao.classList.toggle('active');
        const icon = notificacao.querySelector('.jp_notification-icon i');
        if (icon) {
            icon.classList.toggle('fa-xmark');
        }
    });
}
</script>