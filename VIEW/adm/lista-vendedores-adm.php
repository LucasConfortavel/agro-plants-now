<?php
    include "../../INCLUDE/Menu_adm.php";
    include "../../CONTROLLER/UsuarioController.php";

    $controler_user = new UsuarioController();

    $usuarios = $controler_user->indexVend();
    $total_vendedores = count($usuarios);


    // try {
    //     $db = new Database();
    //     $conn = $db->getConexao();
   
    //     // Pesquisa
    //     $pesquisa = "";
    //     if (isset($_POST['pesquisar']) && !empty($_POST['pesquisa'])) {
    //         $pesquisa = "%" . $_POST['pesquisa'] . "%";
    //         $sql = "SELECT * FROM usuario
    //                 WHERE tipo = 'vendedor'
    //                 AND (nome LIKE :pesquisa OR email LIKE :pesquisa)";
    //         $stmt = $conn->prepare($sql);
    //         $stmt->bindParam(':pesquisa', $pesquisa);
    //     } else {
    //         $sql = "SELECT * FROM usuario WHERE tipo = 'vendedor'";
    //         $stmt = $conn->prepare($sql);
    //     }
   
    //     $stmt->execute();
    //     $vendedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     $total_vendedores = count($vendedores);
   
    // } catch (DatabaseConnectionException $e) {
    //     error_log("Erro de conexão: " . $e->getMessage());
    //     $vendedores = [];
    //     $total_vendedores = 0;
    // } catch (PDOException $e) {
    //     error_log("Erro PDO: " . $e->getMessage());
    //     $vendedores = [];
    //     $total_vendedores = 0;
    // }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gerenciamento de Vendedores</title>
        <link rel="stylesheet" href="../../PUBLIC/css/lista-vendedores-adm.css">
        <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
        <link rel="stylesheet" href="../../PUBLIC/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
        <main class="jp_main-content">
            <h1 class="ym_titulo">Vendedores</h1>
    
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
                                    <button class="ym_btn-remover" id="jv_removeSelected" style="display: none;">
                                        <i class="fa-solid fa-trash-can"></i>
                                        Remover (<span id="jv_selectedCount">0</span>)
                                    </button>
                                </div>
                                <div>
                                    <button class="ym_btn-padrao" onclick="abrirPopup('../../VIEW/pop-up/cadastrar_vendedor.php','Cadastro de Vendedores')">
                                        <i class="fas fa-plus"></i>
                                        <a>Cadastrar Vendedor</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <p class="jv_subtitle" id="jv_customerCount">
                                <?= $total_vendedores ?> vendedores encontrados
                        </p>

                    </div>
    
                    <!-- Table -->
                    <div class="jv_card-content">
                        <div class="jv_table-container">
                            <table class="jv_table">
                                <thead>
                                    <tr class="jv_table-header">
                                        <th class="jv_checkbox-col">
                                            <input type="checkbox" id="jv_selectAll" class="jv_checkbox">
                                        </th>
                                        <th class="jv_name">Nome</th>
                                        <th class="jv_banguela">Telefone</th>
                                        <th class="jv_data">Data de Cadastro</th>
                                        <th class="jv_actions-col"></th>
                                    </tr>
                                </thead>
                                <tbody id="jv_customerTableBody">
                                        <?php foreach ($usuarios as $vend): ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="jv_checkbox customer-checkbox" data-customer-id="<?= $vend['id'] ?>">
                                                </td>
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
                                                        <div class="jv_dropdown-separator"></div>
                                                        <button class="jv_dropdown-item jv_danger">
                                                            <i class="fas fa-trash"></i> Remover
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    

   
    
                    <!-- Paginação -->
                    <div class="jv_page-navigation">
                        <!-- <?php// if($pagina_atual > 1): ?> -->
                            <a href="?pagina=<?php// echo $pagina_atual - 1; ?>" class="jv_page-arrow">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        <?php// endif; ?>

                        <?php 
                        // $inicio = max(1, $pagina_atual - 2);
                        // $fim = min($total_paginas, $pagina_atual + 2);
                        
                        // for ($i = $inicio; $i <= $fim; $i++): ?>
                            <a href="?pagina=<?php// echo $i; ?>" class="jv_page-number <?php// echo $i == $pagina_atual ? 'active' : ''; ?>">
                                1<?php// echo $i; ?>
                            </a>
                        <?php// endfor; ?>
                        <?php 
                        // $inicio = max(1, $pagina_atual - 2);
                        // $fim = min($total_paginas, $pagina_atual + 2);
                        
                        // for ($i = $inicio; $i <= $fim; $i++): ?>
                            <a href="?pagina=<?php// echo $i; ?>" class="jv_page-number <?php// echo $i == $pagina_atual ? 'active' : ''; ?>">
                                2<?php// echo $i; ?>
                            </a>
                        <?php// endfor; ?>
                        <?php 
                        // $inicio = max(1, $pagina_atual - 2);
                        // $fim = min($total_paginas, $pagina_atual + 2);
                        
                        // for ($i = $inicio; $i <= $fim; $i++): ?>
                            <a href="?pagina=<?php// echo $i; ?>" class="jv_page-number <?php// echo $i == $pagina_atual ? 'active' : ''; ?>">
                                3<?php// echo $i; ?>
                            </a>
                        <?php// endfor; ?>
                        

                        <?php// if($pagina_atual < $total_paginas): ?>
                            <a href="?pagina=<?php// echo $pagina_atual + 1; ?>" class="jv_page-arrow">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        <?php// endif; ?>
                    </div>

                    <!-- Empty State -->
                    <div id="jv_emptyState" class="jv_empty-state" style="display: none;">
                        <i class="fas fa-search empty-icon"></i>
                        <h3>Nenhum Vendedor encontrado</h3>
                        <p>Tente ajustar os termos de pesquisa</p>
                    </div>
                </div>
            </div>
        </div>


        <script>
            
        </script>

    <a class="ym_mobile-td" onclick="abrirPopup('../pop-up/informacoes_vendedor.php','Informações do vendedor')">
        <i class="fa-solid fa-circle-info"></i>
    </a>

    </main>
        <script src="../../PUBLIC/JS/script-lista-vendedores.js"></script>
        <script src="../../PUBLIC/JS/script.js"></script>
        <script src="../../PUBLIC/JS/script-pop-up.js"></script>
</body>
</html>