<?php
    include "../../INCLUDE/Menu_vend.php";
    include "../../DB/Database.php";
    
    $controler_user = new UsuarioController();

    $usuarios = $controler_user->indexVend();
    $total_vendedores = count($usuarios);

    if(isset($_POST["adicionar"])){
        $controler_user->criarVendedor();
        // if($controler_user){

        // }
        unset($_POST);
    }
?>
    
<!DOCTYPE html>
<html lang="pt-br">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gerenciamento de Vendedores</title>
        <link rel="stylesheet" href="../../PUBLIC/css/lista-vendas-vend.css">
        <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
        <link rel="stylesheet" href="../../PUBLIC/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
        <!-- pop-up -->
        <div class="ym_popup-overlay">
            <div class="ym_popup-content">
                <div class="ym_area-superior-popup"></div>
                <div class="ym_conteudo-popup"></div>
            </div>
        </div>

        <main class="jp_main-content">
            <h1 class="ym_titulo">Vendas</h1>
    
            <div class="jv_container">
                <div class="jv_card">
                    <!-- Header -->
                    <div class="jv_card-header">
                        <div class="jv_header-content">
                            <form method="POST" action="#" class="jv_search-section">
                                <div class="jv_search-container">
                                    <button type="submit" class="ym_area-icon-pesquisa" name="pesquisar">
                                        <i class="fas fa-search search-icon"></i>
                                    </button>
                                    <input type="text" name="pesquisa" id="jv_searchInput" placeholder="Pesquisar por nome ou email..." class="jv_search-input">
                                </div>
                            </form>
                            
                            <div class="jv_actions">
                                <div>
                                    <button class="ym_btn-padrao" onclick="abrirPopup('../../VIEW/pop-up/cadastrar_vendedor.php','Cadastro de Vendedores')">
                                        <i class="fas fa-plus"></i>
                                        <a>Cadastrar Venda</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <p class="jv_subtitle" id="jv_customerCount">
                            <?= $total_vendedores ?> vendas encontrados
                        </p>
                    </div>
    
                    <!-- Table -->
                    <div class="jv_card-content">
                        <div class="jv_table-container">
                            <table class="jv_table">
                                <thead>
                                    <tr class="jv_table-header">
                                        <th class="jv_name">Nome</th> 
                                        <th class="jv_date">Comprador</th>
                                        <th class="jv_total_comp">Total de Compras</th>
                                        <th class="jv_valor_gast">Valor Gasto</th>
                                        <th class="jv_actions-col">Ações</th> 
                                    </tr>
                                </thead>
                                <tbody id="jv_customerTableBody">
                                    <?php if ($total_vendedores > 0): ?>
                                        <?php foreach ($vendedores as $vend): ?>
                                            <tr>
                                                <td>
                                                    <div class="jv_customer-info">
                                                        <div class="jv_avatar">
                                                            <?= strtoupper(substr($vend['nome'], 0, 2)) ?>
                                                        </div>
                                                        <div class="jv_customer-details">
                                                            <h4><?= htmlspecialchars($vend['nome']) ?></h4>
                                                            <p><?= htmlspecialchars($vend['email']) ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= htmlspecialchars($vend['telefone']) ?></td>
                                                <td><?= date("d/m/Y", strtotime($vend['data_nasc'])) ?></td>
                                                <td>
                                                    <!-- aqui você pode colocar o valor gasto se tiver no banco -->
                                                    R$ 0,00
                                                </td>
                                                <td class="jv_table-action">
                                                    <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </button>
                                                    <div class="jv_dropdown">
                                                        <button class="jv_dropdown-item">
                                                            <i class="fas fa-eye"></i> Visualizar
                                                        </button>
                                                        <div class="jv_dropdown-separator"></div>
                                                        <button class="jv_dropdown-item">
                                                            <i class="fas fa-edit"></i> Editar
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="5" style="text-align: center; height: 49.7vh;">Nenhuma venda encontrada</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Paginação -->
            <div class="jv_page-navigation">
                <a href="#" class="jv_page-arrow"><i class="fas fa-arrow-left"></i></a>
                <a href="#" class="jv_page-number active">1</a>
                <a href="#" class="jv_page-number">2</a>
                <a href="#" class="jv_page-number">3</a>
                <a href="#" class="jv_page-arrow"><i class="fas fa-arrow-right"></i></a>
            </div>
        
            <script src="../../PUBLIC/JS/script-clientes-adm.js"></script>
            <script src="../../PUBLIC/JS/script.js"></script>
            <script src="../../PUBLIC/JS/script-pop-up.js"></script>
        </main>
</body>
</html>
