<?php
include "../../INCLUDE/Menu_adm.php";
include "../../INCLUDE/btn-notificacao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produtos e Serviços</title>
    <link rel="stylesheet" href="../../PUBLIC/css/style-add-prod-serv.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">

</head>
<body>
        <!-- Main Content -->
        <main class="jp_main-content">
            <!-- PAGINA DE PRODUTOS E ICONES SUPERIOR -->
            <section class="eze-section-categorias">
                <div class="eze-categorias-busca">
                    <div class="eze-texto-categoria">
                        <h1 class="eze-h1-categoria eze-tudo">Adicionar produto e serviço</h1>
                    </div>
                    <div class="eze-area-botoes-input">
                        <a href="" class="eze-btn-link eze-link-tudo">Adicionar</a>
                        <a href="produtos.php" class="eze-btn-link eze-link-produtos">Produtos</a>
                        <a href="servicos.php" class="eze-btn-link eze-link-servicos">Serviços</a>
                    </div>
                </div>
                <section class="eze-section-produtos">
                    <div class="eze-area-produtos">
                        <!-- Exemplo de produtos -->
                        <a class="eze-card-produto">
                            <div class="eze-info-produto">
                                <img src="../../PUBLIC/img/+.png" alt="">
                            </div>
                        </a>
                        <a class="eze-card-servico">
                            <div class="eze-info-produto">
                                <img src="../../PUBLIC/img/+2.png" alt="">
                            </div>
                        </a>
                        <!-- Repetir os cards de produtos conforme necessário -->
                    </div>
                </section>
            </section> 
        </main>
    <script src="../../PUBLIC/JS/script.js"></script>
</body>
</html>