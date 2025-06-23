<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- <link rel="stylesheet" href="../../PUBLIC/css/vcl-dashboard-style.css"> -->
    <link rel="stylesheet" href="../PUBLIC/css/btn-notificacao.css">
</head>

<body class="body">
    <div class="ym_area-notificacao">
        <div class="jp_header-icons">
            <div class="jp_notification-icon">
                <i class="fas fa-bell icon-notif" onclick="ym_btnNotif()"></i>
            </div>
            <div class="jp_user-icon">
                <i class="fas fa-user icon-user" onclick="ym_btnUser()"></i>
            </div>
        </div>
        <div class="ym_notification-bar">

        </div>
    </div>
</body>

</html>

<script>
    function ym_btnNotif(){
        let btn_notification = document.getElementsByTagName('icon-notif')[0];
        btn_notification.style.width=""
    }
    
    function ym_btnUser(){
        let btn_notification = document.getElementsByTagName('icon-user')[0];
    }


</script>