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
<body>

    <div class="ym_box-notificacao">
        <div class="ym_area-notificacao">
            <div class="jp_header-icons">
                <div class="jp_notification-icon">
                    <i class="fas fa-bell sino" onclick="teste()"></i>
                </div>
                <div class="jp_user-icon">
                    <i class="fas fa-user"></i>
                </div>    
            </div>

            <div class="ym_notificacao-item">
            </div>

        </div>
    </div>
    
        
</body>
</html>

<script>
    
    function teste(){
        console.log("teste");
        let item_not = document.getElementsByClassName('ym_notificacao-item')[0];
        console.log(item_not)
        item_not.style.display="flex";

    }

</script>