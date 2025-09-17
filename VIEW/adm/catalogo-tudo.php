<?php
    include "../../INCLUDE/Menu_adm.php";   
    include "../../INCLUDE/vlibras.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="../../PUBLIC/css/catalogo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        
            <section class="ym_sectionProdutos">
    
                <h1 class="ym_titulo">Catálogo - Geral</h1>

                <div class="ym_categorias">
                    
                    <div class="ym_area-input-pesquisa">
                        <a href="" class="ym_lupa"><i class="fa-solid fa-magnifying-glass"></i></a>
                        <input  type="text" placeholder="Pesquise por algo no catálogo" class="ym_produtoPesquisa">    
                    </div>  
                    
                    
                    <div class="ym_area-select">
                        <div class="ym_select" onclick="mostrar_categorias()">
                            <p class="ym_categoria-select">Todos</p>
                            <p class="ym_seta-categoria">></p>
                        </div>
                        
                        
                        <div class="ym_options">
                            <a href="catalogo-produtos.php" class="ym_link-option"><i class="fa-solid fa-building-wheat"></i> produto</a>
                            <a href="catalogo-servicos.php" class="ym_link-option"><i class="fa-solid fa-users-gear"></i> serviço</a>
                        </div>
                        
                    </div>
                    
                    <a class="ym_btn-add" onclick="abrirPopup('../../VIEW/pop-up/pop-up-add-produto.php','Cadastro de produto')" >+</a>
                </div>
                
                <p class="ym_textoArea">Principais produtos</p>
                    
                    <div class="ym_areaProdutos">
                        <div class="ym_todos-produtos">
                           
                            <div class="ym_cardProduto">
                                <div class="ym_img-placeholder">
                                    <img src="'. $imagem.'" alt="img-produto" class="ym_img">
                                    <div class="ym_img-label">
                                        <span>Bioestimulante</span>
                                    </div>
                                    <form action="#" method="get" class="ym_form-remover">
                                        <button type="submit" name="remover" value='.$id.'>
                                            <i class="fa-solid fa-trash-can ym_delete-icon"></i>
                                        </button>
                                    </form>
                                </div>

                                <p class="ym_nomeProduto">'. $nome .'</p>
                                <p class="ym_preco">R$ '.$preco.'</p>
                                <p class="ym_descricao">'.$descricao.'</p>
                                <a href="sobre_prod_adm.php" class="ym_linkProduto ym_btn-padrao">Veja mais</a>
                            </div>
                        </div>
                        
                        <div class="ym_btn-slide-area">
                            <button class="ym_btn-slide ym_slideBack" onclick="slideBack('.mysqli_num_rows($result).',0)"> < </button>
                            <button class="ym_btn-slide ym_slideGo" onclick="slideGo('.mysqli_num_rows($result).',0)"> > </button>
                        </div>
                        
                    </div>
                    
                    
                    
                    
                    
                    <p class="ym_textoArea">Principais serviços</p>
                    
                    
                    <div class="ym_areaProdutos">
                        <div class="ym_todos-produtos">

                            <div class="ym_cardProduto">
                                <div class="ym_img-placeholder">
                                    <img src="'. $imagem.'" alt="img-produto" class="ym_img">
                                    <div class="ym_img-label">
                                        <span>Bioestimulante</span>
                                    </div>
                                    <i class="fa-solid fa-trash-can ym_delete-icon"></i>
                                </div>
                                <p class="ym_nomeProduto">'. $nome .'</p>
                                <p class="ym_preco">R$ '.$preco.'</p>
                                <p class="ym_descricao">'.$descricao.'</p>
                                <a href="sobre_prod_adm.php " class="ym_linkProduto ym_btn-padrao">Veja mais</a>
                            </div>

                        </div>
                        
                        <div class="ym_btn-slide-area">
                            <button class="ym_btn-slide ym_slideBack" onclick="slideBack('.mysqli_num_rows($result).',1)"> < </button>
                            <button class="ym_btn-slide ym_slideGo" onclick="slideGo('.mysqli_num_rows($result).',1)"> > </button>
                        </div>
                        
                    </div>

            </section>
    </main>


</body>
</html>

<?php

// if(mysqli_num_rows($result) < 5){

//     echo"<script>
//         var area1 = document.getElementsByClassName('ym_btn-slide-area')[0];
//         area1.style.display = 'none'; 
//         var area2 = document.getElementsByClassName('ym_btn-slide-area')[1];
//         area2.style.display = 'none';
//     </script>";
// }

?>

<script src="../../PUBLIC/JS/script-select.js"></script>
<script src="../../PUBLIC/JS/script-pop-up.js"></script>
<script src="../../PUBLIC/JS/script-catalogo.js"></script>
<?php

    // if(isset($_GET['remover'])){
    //     echo "<script> abrirPopup('../../VIEW/pop-up/conf_remover_produto.php','Deseja remover este produto?') </script>";    
    // }

    // if (isset($_POST['cancelar'])){
    //     echo "<script> location.href = 'catalogo-tudo.php'; </script>";
    // }
    
    // if (isset($_POST['confirmar'])){
    //     $id = $_GET['remover'];
    //     $sql = 'DELETE FROM produtos WHERE id = '.$id.'';
    //     mysqli_query($con, $sql);
    //     echo "<script> location.href = 'catalogo-tudo.php'; </script>";
    // }

?>