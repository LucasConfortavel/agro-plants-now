<?php
include "../../INCLUDE/Menu_vend.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Venda</title>
    <link rel="stylesheet" href="../../PUBLIC/css/lista-vendas-vend.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Paginação */
        .paginacao {
            margin: 20px 0;
            display: flex;
            justify-content: center;
            gap: 8px;
        }
        .paginacao a, .paginacao strong {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            font-size: 14px;
            text-decoration: none;
            color: #374151;
            transition: all 0.2s;
        }
        .paginacao a:hover {
            background: #45734b;
            color: white;
            border-color: #45734b;
        }
        .paginacao strong {
            background: #45734b;
            color: white;
            border-color: #45734b;
        }

        /* Dropdown */
        .dropdown-menu {
            position: absolute;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            box-shadow: 0 6px 12px -3px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            min-width: 140px;
            padding: 2px 0;
        }
        .dropdown-item {
            padding: 6px 12px;
            font-size: 13px;
            cursor: pointer;
        }
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
                        <h1 class="title">
                            <div class="title-bar"></div>
                            Vendas
                        </h1>
                        <p class="subtitle" id="customerCount">10 vendas registradas</p>
                    </div>

                    <div class="actions">
                        <button class="btn btn-danger" id="removeSelected" style="display:none;">
                            <i class="fa-solid fa-trash-can"></i>
                            Remover (<span id="selectedCount">0</span>)
                        </button>

                        <button class="btn btn-primary" onclick="abrirPopup('../../VIEW/pop-up/cadastroVenda-vend.php','Cadastro de clientes')">
                            <i class="fas fa-plus"></i> Cadastrar Venda
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
                            <tr>
                                <td>
                                    <div class="customer-info">
                                        <div class="avatar">AB</div>
                                        <div class="customer-details">
                                            <h4>Alex Barros</h4>
                                            <p>alex@email.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td>João Silva</td>
                                <td>01/09/2025 14:30</td>
                                <td><span class="amount">R$ 150,00</span></td>
                                <td>
                                    <button class="menu-btn" onclick="showDropdown(event, 1)">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Paginação -->
                <div class="paginacao">
                    <strong>1</strong>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">&raquo;</a>
                </div>
            </div>

        </div>
    </div>
</main>

<!-- Dropdown menu -->
<div id="dropdownMenu" class="dropdown-menu" style="display:none;">
    <div class="dropdown-item" data-action="view"><i class="fas fa-eye"></i> Visualizar</div>
    <div class="dropdown-item" data-action="edit"><i class="fas fa-edit"></i> Editar</div>
    <div class="dropdown-item danger" data-action="delete"><i class="fas fa-trash-alt"></i> Excluir</div>
</div>

<script>
let currentOpenDropdown = null;

function showDropdown(event, id) {
    event.stopPropagation();
    const menu = document.getElementById('dropdownMenu');

    if(currentOpenDropdown === id && menu.style.display === 'block'){
        menu.style.display = 'none';
        currentOpenDropdown = null;
        return;
    }

    const rect = event.currentTarget.getBoundingClientRect();
    menu.style.display = 'block';
    menu.style.left = rect.left + window.scrollX - 50 + 'px';
    menu.style.top = rect.bottom + window.scrollY + 5 + 'px';
    currentOpenDropdown = id;

    menu.querySelectorAll('.dropdown-item').forEach(item => {
        item.onclick = () => {
            alert(`${item.dataset.action} - ID ${id}`);
            menu.style.display = 'none';
            currentOpenDropdown = null;
        }
    });
}

document.addEventListener('click', () => {
    document.getElementById('dropdownMenu').style.display = 'none';
    currentOpenDropdown = null;
});
</script>

<script src="../../PUBLIC/JS/script.js"></script>
<script src="../../PUBLIC/JS/script-pop-up.js"></script>
<script src="../../PUBLIC/JS/lista-vendas.js"></script>
</body>
</html>
