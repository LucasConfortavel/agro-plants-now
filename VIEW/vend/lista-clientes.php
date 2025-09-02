<?php
include "../../INCLUDE/Menu_vend.php";
require_once __DIR__ . "/../../DB/Database.php";

// Criar conexão com o banco
$db = new Database();
$conn = $db->getConexao();

try {
    $sql = "SELECT c.id, c.nome, c.email, c.data_cadastro,
                   COUNT(v.id) AS total_compras,
                   IFNULL(SUM(v.total),0) AS valor_gasto
            FROM clientes c
            LEFT JOIN vendas v ON c.id = v.cliente_id
            GROUP BY c.id
            ORDER BY c.data_cadastro DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total_clientes = count($clientes);
} catch (PDOException $e) {
    die("Erro ao buscar clientes: " . $e->getMessage());
}
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
.table td:last-child { text-align:center; }

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
<p class="subtitle"><?= $total_clientes ?> clientes encontrados</p>
</div>
<div class="actions">
<button class="btn btn-primary" onclick="abrirPopup('../../VIEW/pop-up/cadastroPessoas.php','Cadastro de Cliente')">
<i class="fas fa-plus"></i> Cadastrar Clientes
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

<?php if($total_clientes>0): ?>
    <?php foreach($clientes as $row): 
        $iniciais = strtoupper(substr($row['nome'],0,2));
        $data = date('d/m/Y', strtotime($row['data_cadastro']));
    ?>
    <tr>
        <td>
            <div class="jv_customer-info">
                <div class="jv_avatar"><?= $iniciais ?></div>
                <div class="jv_customer-details">
                    <h4><?= htmlspecialchars($row['nome']) ?></h4>
                    <p><?= htmlspecialchars($row['email']) ?></p>
                </div>
            </div>
        </td>
        <td><?= $data ?></td>
        <td style="text-align:center;"><?= $row['total_compras'] ?></td>
        <td>R$ <?= number_format($row['valor_gasto'],2,",",".") ?></td>
        <td style="text-align:center;">
            <button class="menu-btn" onclick="showDropdown(event, <?= $row['id'] ?>)">
                <i class="fas fa-ellipsis-h"></i>
            </button>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="5" style="text-align:center;">Nenhum cliente encontrado</td></tr>
<?php endif; ?>

</tbody>
</table>
</div>

<!-- Paginação -->
<div class="paginacao">
<!-- Aqui você pode colocar a lógica de paginação -->
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

<script>
let currentOpenDropdown = null;

function showDropdown(event, id) {
    event.stopPropagation();
    const menu = document.getElementById('dropdownMenu');

    if(currentOpenDropdown === id && menu.style.display==='block'){
        menu.style.display='none';
        currentOpenDropdown = null;
        return;
    }

    const rect = event.currentTarget.getBoundingClientRect();
    menu.style.display='block';
    menu.style.left = rect.left + window.scrollX - 50 + 'px';
    menu.style.top = rect.bottom + window.scrollY + 5 + 'px';
    currentOpenDropdown = id;

    menu.querySelectorAll('.dropdown-item').forEach(item=>{
        item.onclick = () => {
            alert(`${item.dataset.action} - ID ${id}`);
            menu.style.display='none';
            currentOpenDropdown = null;
        };
    });
}

document.addEventListener('click', () => {
    document.getElementById('dropdownMenu').style.display='none';
    currentOpenDropdown = null;
});
</script>

<script src="../../PUBLIC/JS/script.js"></script>
<script src="../../PUBLIC/JS/script-pop-up.js"></script>
<script src="../../PUBLIC/JS/lista_clientes.js"></script>
</body>
</html>
