<?php
    include "../../CONTROLLER/UsuarioController.php";
    include "../../INCLUDE/Menu_adm.php";
    include "../../INCLUDE/vlibras.php";
    require_once "../../INCLUDE/verificarLogin.php"; 
    include "../../INCLUDE/alertas.php";


    $controler_user = new UsuarioController();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['adicionar'])){
            $usuario = $controler_user->criar("vendedor");
            print_r($usuario);

            if($usuario == 1){
                $_SESSION['alerta'] =  '<script> exibirAlerta("Vendedor cadastrado com sucesso","sucesso"); </script>';
            }elseif($usuario == "Já existe um usuário cadastrado com este email."){
                $_SESSION['alerta'] = '<script> exibirAlerta("Já existe um vendedor cadastrado com este email"); </script>';
            }elseif($usuario['error'] == "Você precisa ter pelo menos 18 anos para se cadastrar."){
                $_SESSION['alerta'] = '<script> exibirAlerta("Você precisa ter pelo menos 18 anos para se cadastrar"); </script>';
            }else{
                $_SESSION['alerta'] = '<script> exibirAlerta("Não foi possível cadastrar o vendedor","error"); </script>';
            }

        }

        if (isset($_POST['alter_status'])){
            $user_id = $_SESSION['id'] ?? null;
            $usuario = $controler_user->mostrar($user_id);
            $id = $_POST['id'];
            $vendedor = $controler_user->mostrar($id);
            $senha = $_POST['alter_status'];

            if($usuario["senha"] == $senha){
                if($vendedor['status'] == "ATIVADO"){
                    $vendedor = $controler_user->desativar($id);
                    if($vendedor == 1){
                        $_SESSION['alerta'] = '<script> exibirAlerta("Vendedor desativado com sucesso","sucesso"); </script>';
                    }else{
                        $_SESSION['alerta'] = '<script> exibirAlerta("Não foi possível desativar o Vendedor","error"); </script>';
                    }
                }else{
                    $vendedor = $controler_user->ativar($id);
                    if($vendedor == 1){
                        $_SESSION['alerta'] = '<script> exibirAlerta("Vendedor ativado com sucesso","sucesso"); </script>';
                    }else{
                        $_SESSION['alerta'] = '<script> exibirAlerta("Não foi possível ativar o Vendedor","error"); </script>';
                    }
                }
                
            }else{
                $_SESSION['alerta'] = '<script> exibirAlerta("Senha incorreta","error"); </script>';
            }
        }

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;

    }


    if (isset($_GET['visualizar'])){
        $id = $_GET['visualizar'];
        $usuario = $controler_user->mostrar($id);
        header('Location: info-edit-adm.php?id=' . $id . "&usuario=" . $usuario['tipo']);
        exit;
    } 
    
    $usuarios = $controler_user->index("vendedor");

    $total_vendedores = count($usuarios);

    $limite = 4;
    $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    if ($pagina_atual < 1) $pagina_atual = 1;
    $offset = ($pagina_atual - 1) * $limite;

    $total_paginas = ($total_vendedores > 0) ? ceil($total_vendedores / $limite) : 1;

    $usuarios = array_slice($usuarios, $offset, $limite);

    if(isset($_SESSION['alerta'])){
        echo($_SESSION['alerta']);
        unset($_SESSION['alerta']);
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
    <link rel="stylesheet" href="../../PUBLIC/css/global-tema.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

    <!-- pop-up -->
    <div class="ym_popup-overlay" >
        <div class="ym_popup-content">
            <div class="ym_area-superior-popup"></div>
            <div class="ym_conteudo-popup"></div>
        </div>
    </div>

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
                                <button type="button" class="ym_btn-padrao" onclick="abrirPopup('../../VIEW/pop-up/cadastrar_vendedor.php','Cadastro de Vendedores')">
                                    <i class="fas fa-plus"></i>
                                    <span>Cadastrar Vendedor</span>
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
                                    <th class="jv_data">Data de Nascimento</th>
                                    <th class="jv_data">Status</th>
                                    <th class="jv_actions-col"></th>
                                </tr>
                            </thead>
                            <tbody id="jv_customerTableBody">
                                <?php if (count($usuarios) === 0): ?>
                                    <tr>
                                        <td colspan="5" style="text-align:center; padding: 2rem;">
                                            Nenhum vendedor nesta página.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($usuarios as $vend): ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="jv_checkbox customer-checkbox" data-customer-id="<?= htmlspecialchars($vend['id']) ?>">
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
                                            <td><?= htmlspecialchars($vend['status']) ?></td>
                                            <td class="jv_table-action">
                                                <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <form class="jv_dropdown" method="GET" action="">
                                                    <button type="submit" name="visualizar" value="<?= htmlspecialchars($vend['id']) ?>" class="jv_dropdown-item">
                                                        <i class="fas fa-eye"></i> Visualizar
                                                    </button>
                                                    <div class="jv_dropdown-separator"></div>
                                                    <?php
                                                        if($vend['status'] == "ATIVADO"){
                                                            echo'
                                                            <button type="button" onclick="abrirPopup(\'../../VIEW/pop-up/pop-up_remover.php?id=' . htmlspecialchars($vend['id']) . '\', \'Cadastro de Vendedores\')" class="jv_dropdown-item jv_danger">
                                                                <i class="fa-solid fa-ban"></i> Desativar
                                                            </button>';
                                                        }else{
                                                            echo'
                                                            <button type="button" onclick="abrirPopup(\'../../VIEW/pop-up/pop-up_remover.php?id=' . htmlspecialchars($vend['id']) . '\', \'Cadastro de Vendedores\')" class="jv_dropdown-item jv_acess">
                                                                <i class="fa-solid fa-power-off"></i> Ativar
                                                            </button>';
                                                        }
                                                    ?>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- Paginação -->
        <?php if ($total_paginas > 1): ?>
            <div class="jv_page-navigation">
                <?php if ($pagina_atual > 1): ?>
                    <a href="?pagina=<?= $pagina_atual - 1 ?>" class="jv_page-arrow">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                <?php endif; ?>

                <?php
                if ($total_paginas <= 3) {
                    $inicio = 1;
                    $fim = $total_paginas;
                } else {
                    if ($pagina_atual <= 2) {
                        $inicio = 1;
                        $fim = 3;
                    } elseif ($pagina_atual >= $total_paginas - 1) {
                        $inicio = $total_paginas - 2;
                        $fim = $total_paginas;
                    } else {
                        $inicio = $pagina_atual - 1;
                        $fim = $pagina_atual + 1;
                    }
                }

                for ($i = $inicio; $i <= $fim; $i++): ?>
                    <a href="?pagina=<?= $i ?>" 
                    class="jv_page-number <?= $i == $pagina_atual ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($pagina_atual < $total_paginas): ?>
                    <a href="?pagina=<?= $pagina_atual + 1 ?>" class="jv_page-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>



        <!-- <a class="ym_mobile-td" onclick="abrirPopup('../pop-up/informacoes_vendedor.php','Informações do vendedor')">
            <i class="fa-solid fa-circle-info"></i>
        </a> -->

        <script src="../../PUBLIC/JS/script-lista-vendedores.js"></script>
        <script src="../../PUBLIC/JS/script-pop-up.js"></script>
        <script src="../../PUBLIC/JS/script-tema.js"></script>
</main>
</body>
</html>