<?php
    include "../../CONTROLLER/ClienteController.php";
    include "../../CONTROLLER/UsuarioController.php";
    include "../../INCLUDE/Menu_adm.php";
    include "../../INCLUDE/vlibras.php";


    $controler_cliente = new ClienteController();
    $controler_usuario = new UsuarioController();

    if(isset($_GET['id'])){
        $id=$_GET["id"];
        $tipo_user = $_GET["usuario"];
        
        if($tipo_user=="cliente"){
            $usuario = $controler_cliente->mostrar($id);
            $dataNascimento = new DateTime($usuario['data_nasc']);
            if(empty($usuario['CPF'])){
                $CPF_CNPJ = "CNPJ";
                $limite  = 14;

            }
            else{
                $CPF_CNPJ = "CPF";
                $limite  = 11;

            }
        } elseif($tipo_user=="vendedor"){
            $usuario = $controler_usuario->mostrar($id);
            $dataNascimento = new DateTime($usuario['data_nasc']);
            $CPF_CNPJ = "CPF";
            $limite  = 11;
        }
        

        $hoje = new DateTime();
        

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($tipo_user=="cliente"){
                $controler_cliente->atualizar($id);
                // echo $controler_cliente->atualizar($id);
            
            } elseif($tipo_user=="vendedor"){
                $controler_usuario->atualizar($id);
                // echo $controler_usuario->atualizar($id);
            }

            header("Refresh:0");
            exit;
        }

    }


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../../PUBLIC/css/info-edit.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

        <main class="jp_main-content">

            <h1 class="ym_titulo">Informações</h1>
            
            <div class="ym_area-info">
                <header class="jp_profile-header" style=" width: 97%;">
                    <div class="jp_profile-info">
                        <img src="../../PUBLIC/img/img_user.png" alt="Profile" class="jp_profile-pic">
                        
                        <div class="profile-text">
                            <h2><?= $usuario['nome']?></h2>
                            <p><?= $usuario['email']?></p>
                        </div>
                    </div>
                    <div class="jp_role"><?=$tipo_user?></div>
                </header>

            
                <div class="jp_content">
                    <nav class="jp_tabs">
                        <h3>Informações pessoais</h3>
                        <button class="ym_btn-editar ym_btn-padrao" onclick="edit()">Editar <i class="fa-solid fa-pen-to-square"></i> </button>
                        <button class="ym_btn-remover" onclick="location.reload();">Cancelar <i class="fa-solid fa-ban"></i> </button>

                    </nav>

                    <div class="jp_info-section">
                        <form action='#' method="POST" class="jp_info-grid">
                            <div class="jp_info-item">
                                <label>Nome</label>
                                <p><?= $usuario['nome']?></p>
                                <input class="ym_input-info" name="nome" type="text" value=<?= $usuario['nome']?>>
                            </div>
                            <div class="jp_info-item">
                                <label>Idade</label>
                                <span><?=$hoje->diff($dataNascimento)->y?></span>
                            </div>
                            <div class="jp_info-item">
                                <label>Data de nascimento</label>
                                <p><?= $dataNascimento->format('d/m/Y')?></p>
                                <input class="ym_input-info" name="data_nasc" type="date" value=<?=$usuario['data_nasc']?>>
                            </div>
                            <div class="jp_info-item">
                                <label>E-mail</label>
                                <p><?= $usuario['email']?></p>
                                <input class="ym_input-info" name="email" type="text" value=<?= $usuario['email']?>>
                            </div>
                            <div class="jp_info-item">
                                <label>Número de telefone</label>
                                <p><?= $usuario['telefone']?></p>
                                <input class="ym_input-info" name="telefone" type="text" value=<?= $usuario['telefone']?>>
                            </div>
                            <div class="jp_info-item">
                                <label>Posição</label>
                                <span id="ym_tipo"><?= $tipo_user?></span>
                            </div>
                            <div class="jp_info-item">
                                <label><?= $CPF_CNPJ?></label>
                                <p><?= $usuario[$CPF_CNPJ]?></p>
                                <input class="ym_input-info" name=<?= $CPF_CNPJ?>  maxlength=<?= $limite ?> type="text" value=<?= $usuario[$CPF_CNPJ]?>>
                            </div>
                            <?php
                            if($tipo_user=="vendedor"){
                                echo'
                                <div class="jp_info-item">
                                    <label>CEP</label>
                                    <p>' . $usuario['cep'] . '</p>
                                    <input class="ym_input-info" name="cep" type="text"  maxlength="8" value=' . $usuario['cep'] . '>
                                </div>';
                            }
                            
                            ?>

                            <button class="ym_btn-salvar ym_btn-padrao">Salvar <i class="fa-solid fa-floppy-disk"></i> </button>


                        </form>
                    </div>
                </div>
            </div>
        </main>
    

    <script src="../../PUBLIC/JS/script.js"></script>
    <script src="../../PUBLIC/JS/script-info-edit.js"></script>

</body>
</html>