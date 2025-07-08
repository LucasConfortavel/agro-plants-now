const notificacao = document.getElementsByClassName('ym_area-notificacao')[0];
notificacao.addEventListener('click', () => {
    notificacao.classList.toggle('active');
    $('.jp_notification-icon').find('i').toggleClass('fa-xmark');
});