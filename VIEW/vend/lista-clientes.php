<?php
include "../../INCLUDE/Menu_vend.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gerenciamento de Clientes</title>
<link rel="stylesheet" href="../../PUBLIC/css/lista-clientes.css">
<link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
<link rel="stylesheet" href="../../PUBLIC/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
/* Paginação */
.paginacao { text-align:center; margin-top:20px; }
.paginacao a, .paginacao strong { display:inline-block; padding:6px 12px; margin:2px; border:1px solid #ccc; border-radius:6px; text-decoration:none; color:#333; font-size:14px; }
.paginacao strong { background:#45734B; color:#fff; }
.paginacao a:hover { background:#f3f3f3; }

/* Tabela */
.table { width:100%; border-collapse:collapse; }
.table th, .table td { padding:12px 16px; border-bottom:1px solid #ddd; vertical-align:middle; }
.table th:first-child, .table td:first-child { text-align:left; }
.table td:last-child { text-align:center; }
.table tbody tr:hover { background:#f9fafb; }

/* Cliente */
.jv_customer-info { display:flex; align-items:center; gap:12px; }
.jv_avatar { width:40px; height:40px; border-radius:50%; background:#45734b; display:flex; justify-content:center; align-items:center; color:white; font-weight:600; font-size:14px; }
.jv_customer-details h4 { margin:0; font-weight:500; color:#111827; }
.jv_customer-details p { margin:0; font-size:14px; color:#6b7280; }

/* Menu três pontinhos */
.menu-btn { background:none; border:none; cursor:pointer; font-size:16px; color:#6b7280; }
.menu-btn:hover { color:#111827; }
.dropdown-menu { display:none; position:absolute; background:#fff; border:1px solid #e5e7eb; border-radius:6px; box-shadow:0 10px 15px -3px rgba(0,0,0,0.1); z-index:1000; min-width:140px; padding:4px 0; }
.dropdown-item { padding:8px 16px; cursor:pointer; font-size:14px; color:#374151; display:flex; align-items:center; gap:8px; transition:0.2s; }
.dropdown-item:hover { background:#f3f4f6; }
.dropdown-item.danger { color:#dc2626; }
.dropdown-item.danger:hover { background:#fef2f2; }
</style>
</head>
<body>

<main class="jp_main-content">
<div class="container">
<div class="card">

<!-- Header -->
<div class="card-header">
<div class="header-content">
<div class="title-section">
<h1 class="title"><div class="title-bar"></div>Lista de Clientes</h1>
<p class="subtitle"><?php //echo $total_clientes; ?>10 clientes encontrados</p>
</div>
<div class="actions">
<button class="btn btn-primary">
<i class="fas fa-plus"></i>
<a onclick="abrirPopup('../../VIEW/pop-up/cadastroPessoas.php','Cadastro de Cliente')">Cadastrar Clientes</a>
</button>
</div>
</div>
<div class="search-section">
<div class="search-container">
<i class="fas fa-search search-icon"></i>
<input type="text" id="searchInput" placeholder="Pesquisar por nome ou email..." class="search-input">
</div>
</div>
</div>

<!-- Table -->
<div class="card-content">
<div class="table-container">
<table class="table">
<thead>
<tr class="table-header">
<th>Nome</th>
<th>Data de cadastro</th>
<th>Total de Compras</th>
<th>Valor Gasto</th>
<th></th>
</tr>
</thead>
<tbody id="customerTableBody">

        <tr>
            <td>
                <div class="jv_customer-info">
                    <div class="jv_avatar">'.$iniciais.'</div>
                    <div class="jv_customer-details">
                        <h4>'.$nome.'</h4>
                        <p>'.$email.'</p>
                    </div>
                </div>
            </td>
            <td>'.$data.'</td>
            <td style="text-align:center;">'.$totalCompras.'</td>
            <td><span class="jv_amount">R$ '.number_format($valorGasto,2,",",".").'</span></td>
            <td style="text-align:center;">
                <button class="menu-btn" onclick="showDropdown(event, '.$row['id'].')">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
            </td>
        </tr>

        <!-- <tr><td colspan="5" style="text-align:center;">Nenhum cliente encontrado</td></tr> -->

    </tbody>
</table>
</div>

<!-- Paginação -->
<div class="paginacao">
<?php 
// if ($pagina > 1) echo "<a href='?pagina=".($pagina-1)."'>&laquo; Anterior</a>";
// for ($i=1;$i<=$totalPaginas;$i++){
//     if($i==$pagina) echo "<strong>$i</strong>";
//     else echo "<a href='?pagina=$i'>$i</a>";
// }
// if($pagina<$totalPaginas) echo "<a href='?pagina=".($pagina+1)."'>Próxima &raquo;</a>";
?>
</div>
</div>
</div>
</div>
</main>

<!-- Dropdown menu -->
<div id="dropdownMenu" class="dropdown-menu">
<div class="dropdown-item" data-action="view"><i class="fas fa-eye"></i> Visualizar</div>
<div class="dropdown-item" data-action="edit"><i class="fas fa-edit"></i> Editar</div>
<div class="dropdown-item danger" data-action="delete"><i class="fas fa-trash-alt"></i> Excluir</div>
</div>

<script src="../../PUBLIC/JS/script.js"></script>
<script src="../../PUBLIC/JS/script-pop-up.js"></script>
<script src="../../PUBLIC/JS/lista_clientes.js"></script>
</body>
</html>
