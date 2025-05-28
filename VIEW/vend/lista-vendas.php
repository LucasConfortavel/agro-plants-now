<?php

include "../../INCLUDE/Menu_vend.php";


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Vendas</title>
    <link rel="stylesheet" href="../../PUBLIC/css/lista-vendas-vend.css">
</head>
<body>
    <main class="jp_main-content">
        <div class="container">
            <?php
            // Configuração da paginação
            $itens_por_pagina = 8;
            $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
            $inicio = ($pagina - 1) * $itens_por_pagina;
    
            // Exemplo de array de clientes (substituir por dados do banco)
            $clientes = array(
                array("nome" => "Rafael Germinari", "data" => "12/08", "code" => 123, "state" => "null"),
                array("nome" => "Calebe Lemos", "data" => "12/08", "code" => 123, "state" => "null"),
                array("nome" => "Nome Cliente 3", "data" => "00/00", "code" => 123, "state" => "null"),
                array("nome" => "Nome Cliente 4", "data" => "00/00", "code" => 123, "state" => "null"),
                array("nome" => "Nome Cliente 5", "data" => "00/00", "code" => 123, "state" => "null"),
                array("nome" => "Nome Cliente 6", "data" => "00/00", "code" => 123, "state" => "null"),
                array("nome" => "Nome Cliente 7", "data" => "00/00", "code" => 123, "state" => "null"),
                array("nome" => "Nome Cliente 8", "data" => "00/00", "code" => 123, "state" => "null"),
                array("nome" => "Nome Cliente 9", "data" => "00/00", "code" => 123, "state" => "null")
            );
    
            // Total de paginas
            $total_clientes = count($clientes);
            $total_paginas = ceil($total_clientes / $itens_por_pagina);
            ?>
    
            <div class="header-row">
                <span class="header-code">Código</span>
                <span class="header-nome">Nome</span>
                <span class="header-data">Data de cadastro</span>
                <span class="header-state">Estado</span>
            </div>
    
            <div class="lista-clientes">
                <?php
                // Loop atraves dos clientes
                foreach(array_slice($clientes, $inicio, $itens_por_pagina) as $cliente): ?>
                    <div class="cliente-row">
                        <div class="cliente-info">
                            <span class="code header-edit"><?php echo $cliente['code']?></span>
                            <span class="nome header-edit"><?php echo $cliente['nome']; ?></span>
                            <span class="data header-edit"><?php echo $cliente['data']; ?></span>
                            <span class="state header-edit"><?php echo $cliente['state']?></span>
                        </div>
                        <div class="info-icon">
                            <span><img src="../../PUBLIC/img/Frame.svg" alt=""></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
    
            <div class="paginacao">
                <?php
                $max_links = 3;
                $start_link = max($pagina - floor($max_links/2), 1);
                $end_link = min($start_link + $max_links - 1, $total_paginas);
    
                // Seta para a esquerda
                if($pagina > 1): ?>
                    <a href="?pagina=<?php echo $pagina - 1; ?>" class="prev">←</a>
                <?php endif;
    
                // Primeira pagina e reticencias a esquerda
                if($start_link > 1): ?>
                    <a href="?pagina=1">1</a>
                    <?php if($start_link > 2): ?>
                        <span class="ellipsis">...</span>
                    <?php endif;
                endif;
    
                // Links das paginas
                for($i = $start_link; $i <= $end_link; $i++): ?>
                    <a href="?pagina=<?php echo $i; ?>" class="<?php echo $i == $pagina ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor;
    
                // Última página e reticências a direita
                if($end_link < $total_paginas):
                    if($end_link < $total_paginas - 1): ?>
                        <span class="ellipsis">...</span>
                    <?php endif; ?>
                    <a href="?pagina=<?php echo $total_paginas; ?>"><?php echo $total_paginas; ?></a>
                <?php endif;
    
                // Seta para a direita
                if($pagina < $total_paginas): ?>
                    <a href="?pagina=<?php echo $pagina + 1; ?>" class="next">→</a>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>