<?php
    include "../../INCLUDE/Menu_adm.php";
    require_once "../../DB/Database.php";
    
    try {
        $db = new Database();
        $conn = $db->getConexao();
    
        // Pesquisa
        $pesquisa = "";
        if (isset($_POST['pesquisar']) && !empty($_POST['pesquisa'])) {
            $pesquisa = "%" . $_POST['pesquisa'] . "%";
            $sql = "SELECT * FROM usuario 
                    WHERE tipo = 'vendas' 
                    AND (nome LIKE :pesquisa OR email LIKE :pesquisa)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pesquisa', $pesquisa);
        } else {
            $sql = "SELECT * FROM usuario WHERE tipo = 'vendas'";
            $stmt = $conn->prepare($sql);
        }
    
        $stmt->execute();
        $vendedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total_vendedores = count($vendedores);
    
    } catch (DatabaseConnectionException $e) {
        error_log("Erro de conexão: " . $e->getMessage());
        $vendedores = [];
        $total_vendedores = 0;
    } catch (PDOException $e) {
        error_log("Erro PDO: " . $e->getMessage());
        $vendedores = [];
        $total_vendedores = 0;
    }
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
            <h1 class="ym_titulo">Lista de notificação</h1>
    
            <div class="jv_container">
                <div class="jv_card">
                    <!-- Header -->
                    <div class="jv_card-header">
                        <div class="jv_header-content">
                        <form method="POST" action="#" class="jv_search-section">
                          
                        </form>
                            
    
                       </div>
                        
                   
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
                                
                                        <th class="jv_date">Titúlo</th>
                                        <th class="jv_total_comp">Setor</t>
                                        <th class="jv_valor_gast">Data</th>
                                        <th class="jv_actions-col"></th> 
                                    </tr>
                                </thead>
                                <tbody id="jv_customerTableBody">
                                    <?php if ($total_vendedores > 0): ?>
                                        <?php foreach ($vendedores as $vend): ?>
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
                                    <?php else: ?>
                                        <tr><td colspan="5" style="text-align: center; height: 49.7vh;">Nenhuma notificação encontrada</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

                        <!-- Paginação
                        <div class="jv_page-navigation">
                            <?php if($pagina_atual > 1): ?>
                                <a href="?pagina=<?php //echo $pagina_atual - 1; ?>" class="jv_page-arrow">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            <?php endif; ?>

                            <?php 
                                // $inicio = max(1, $pagina_atual - 2);
                                // $fim = min($total_paginas, $pagina_atual + 2);
                                
                                // for ($i = $inicio; $i <= $fim; $i++):
                             ?>
                                <a href="?pagina=<?php echo $i; ?>" class="jv_page-number <?php echo $i == $pagina_atual ? 'active' : ''; ?>">
                                    <?php //echo $i; ?>
                                </a>
                            <?php //endfor; ?>

                            <?php //if($pagina_atual < $total_paginas): ?>
                                <a href="?pagina=<?php //echo $pagina_atual + 1; ?>" class="jv_page-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            <?php //endif; ?>
                        </div> -->

                        <!-- Empty State -->
                        <div id="emptyState" class="jv_empty-state" style="display: none;">
                            <i class="fas fa-search empty-icon"></i>
                            <h3>Nenhuma venda encontrada</h3>
                            <p>Tente ajustar os termos de pesquisa</p>
                        </div>
                    </div>
                </div>
            </div>



<script src="../../PUBLIC/JS/script-pop-up.js"></script>
<script src="../../PUBLIC/JS/script.js"></script>
