<?php
include "../../INCLUDE/Menu_vend.php";
require_once "../../DB/connect.php";

// 1. Página atual
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$limite = 4;
$inicio = ($pagina - 1) * $limite;

// 2. Buscar registros limitados
$sql = "SELECT * FROM venda LIMIT $inicio, $limite";
$result = mysqli_query($con, $sql);

// 3. Total de registros
$sqlTotal = "SELECT COUNT(*) as total FROM venda";
$totalResult = mysqli_query($con, $sqlTotal);
$totalRow = mysqli_fetch_assoc($totalResult);
$total_vendas = $totalRow['total'];

$totalPaginas = ceil($total_vendas / $limite);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gerenciamento de Venda</title>
<link rel="stylesheet" href="../../PUBLIC/css/lista-vendas-vend.css">
<link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
<link rel="stylesheet" href="../../PUBLIC/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    /* estilo da paginação */
    .paginacao {margin-top:20px; text-align:center;}
    .paginacao a, .paginacao strong {display:inline-block;padding:6px 12px;margin:2px;border:1px solid #ccc;border-radius:6px;text-decoration:none;color:#333;font-size:14px;}
    .paginacao strong {background:#45734B;color:#fff;}
    .paginacao a:hover {background:#f3f3f3;}

    /* Avatar verde */
    .avatar {width:40px;height:40px;border-radius:50%;background:#45734B;display:flex;align-items:center;justify-content:center;color:white;font-weight:600;font-size:14px;margin-right:12px;}

    .menu-btn { background:none; border:none; cursor:pointer; font-size:16px; color:#6b7280; }
    .menu-btn:hover { color:#111827; }
    .dropdown-menu { display:none; position:absolute; background:#fff; border:1px solid #e5e7eb; border-radius:6px; box-shadow:0 10px 15px -3px rgba(0,0,0,0.1); z-index:1000; min-width:140px; padding:4px 0; }
    .dropdown-item { padding:8px 16px; cursor:pointer; font-size:14px; color:#374151; display:flex; align-items:center; gap:8px; transition:0.2s; }
    .dropdown-item:hover { background:#f3f4f6; }
    .dropdown-item.danger { color:#dc2626; }
    .dropdown-item.danger:hover { background:#fef2f2; }
</style>
    
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
            <h1 class="title"><div class="title-bar"></div>Vendas</h1>
            <p class="subtitle" id="customerCount"><?php echo $total_vendas; ?> vendas registradas</p>
        </div>
        <div class="actions">
            <button class="btn btn-danger" id="removeSelected" style="display:none;">
                <i class="fa-solid fa-trash-can"></i> Remover (<span id="selectedCount">0</span>)
            </button>
            <button class="btn btn-primary">
                <i class="fas fa-plus"></i>
                <a onclick="abrirPopup('../../VIEW/pop-up/cadastroVenda-vend.php','Cadastro de clientes')">Cadastrar Venda</a>
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
    <th>Vendedor</th>
    <th>Comprador</th>
    <th>Data de cadastro</th>
    <th>Total</th>
    <th></th>
</tr>
</thead>
<tbody id="customerTableBody">
<?php
if($result && mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $vendedor_id = $row['id_vendedor'];

        $sql_vendedor = mysqli_query($con,'SELECT * FROM usuario WHERE tipo = "vendedor" and id = '.$vendedor_id);
        $dado_vendedor = mysqli_fetch_assoc($sql_vendedor);

        $vendedor_nome = $dado_vendedor['nome'];
        $vendedor_email = $dado_vendedor['email'];

        $total = $row['total'];
        $data = $row['data_venda'];

        echo '
        <tr>
            <td>
                <div class="customer-info">
                    <div class="avatar">'.substr($vendedor_nome,0,2).'</div>
                    <div class="customer-details">
                        <h4>'.$vendedor_nome.'</h4>
                        <p>'.$vendedor_email.'</p>
                    </div>
                </div>
            </td>
            <td>Comprador</td>
            <td>'.$data.'</td>
            <td><span class="amount">R$ '.$total.'</span></td>
            <td>
                <button class="menu-btn">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
            </td>
        </tr>
        ';
    }
} else {
    echo '<tr><td colspan="5" style="text-align:center;height:49.7vh;">Nenhuma venda encontrada</td></tr>';
}
?>
</tbody>
</table>
</div>

<!-- Paginação -->
<div class="paginacao">
<?php
if ($pagina > 1) {echo "<a href='?pagina=".($pagina-1)."'>&laquo; Anterior</a>";}
for ($i = 1; $i <= $totalPaginas; $i++) {
    if ($i == $pagina) {echo "<strong>$i</strong>";} else {echo "<a href='?pagina=$i'>$i</a>";}
}
if ($pagina < $totalPaginas) {echo "<a href='?pagina=".($pagina+1)."'>Próxima &raquo;</a>";}
?>
</div>
</div>

</div>
</div>
</main>

<script src="../../PUBLIC/JS/script.js"></script>
<script src="../../PUBLIC/JS/script-pop-up.js"></script>
</body>
</html>
