<?php


include "../../INCLUDE/Menu_vend.php";
include "../../INCLUDE/btn-notificacao.php";



$clientes = [];

for ($i = 1; $i <= 200; $i++) {
    $nomes = ["Paulo", "Jose", "Maria", "Carlos", "Ana", "Roberto", "Juliana", "Fernando", "Beatriz", "Ricardo",
              "Camila", "Gustavo", "Larissa", "Thiago", "Patricia", "Lucas", "Vanessa", "Felipe", "Bruna", "Renato",
              "Isabela", "Eduardo", "Carla", "Leonardo", "Tatiane", "Anderson", "Sabrina", "Vinicius", "Raquel", "Cristiane",
              "Diego", "Helena", "Alexandre", "Natalia", "Rodrigo", "Amanda", "Gabriel", "Daniela", "Luciano", "Marcelo",
              "Elaine", "Ricardo", "Roberta", "Felipe", "Claudia", "Bruno", "Daniele", "Rafael", "Priscila", "Adriano"];

    $sobrenomes = ["Rojas", "Farmer", "Silva", "Mendes", "Oliveira", "Santos", "Costa", "Lima", "Souza", "Alves",
                   "Martins", "Pereira", "Nunes", "Fernandes", "Duarte", "Rocha", "Lima", "Costa", "Mendes", "Ferreira",
                   "Nogueira", "Andrade", "Souza", "Ribeiro", "Lopes", "Ferreira", "Cardoso", "Vasconcelos", "Ribeiro", "Duarte",
                   "Albuquerque", "Neves", "Cunha", "Almeida", "Castro", "Figueiredo", "Martins", "Barbosa", "Monteiro", "Ramos"];

    $nomeCompleto = $nomes[array_rand($nomes)] . " " . $sobrenomes[array_rand($sobrenomes)];
    $dataCadastro = str_pad(rand(1, 31), 2, '0', STR_PAD_LEFT) . "/" . str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT);
    $dataNascimento = str_pad(rand(1, 31), 2, '0', STR_PAD_LEFT) . "/" . str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT) . "/" . rand(1970, 2000);
    $telefone = "(" . rand(11, 99) . ") " . rand(90000, 99999) . "-" . rand(1000, 9999);
    $email = strtolower(str_replace(" ", ".", $nomeCompleto)) . "@email.com";
    $cpf = rand(100, 999) . "." . rand(100, 999) . "." . rand(100, 999) . "-" . rand(10, 99);

    $clientes[] = [
        'id' => $i,
        'nome' => $nomeCompleto,
        'data_cadastro' => $dataCadastro,
        'data_nascimento' => $dataNascimento,
        'telefone' => $telefone,
        'email' => $email,
        'cpf' => $cpf
    ];
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
if (!empty($search)) {
    $clientes = array_filter($clientes, function($cliente) use ($search) {
        return stripos($cliente['nome'], $search) !== false;
    });
}

$itemsPerPage = 8;
$currentPage = max((int)($_GET['page'] ?? 1), 1);
$totalPages = max(ceil(count($clientes) / $itemsPerPage), 1);
$paginatedClientes = array_slice($clientes, ($currentPage - 1) * $itemsPerPage, $itemsPerPage);

$searchParam = isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Clientes</title>
    <link rel="stylesheet" href="../../PUBLIC/css/lista-clientes.css">
</head>
<body>
    <div class="jp_hamburger-menu">
        <div class="jp_hamburger-line"></div>
        <div class="jp_hamburger-line"></div>
        <div class="jp_hamburger-line"></div>
    </div>

    <div class="jp_container">
      

        <div class="jp_main-content">
 
            <div class="jp_header">
                <div></div>
                
                <form action="" method="GET" class="jp_search-container">
                    <input type="text" name="search" placeholder="Pesquise por um cliente" value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </form>
                
                <button class="jp_button" id="cadastrarClienteBtn">Cadastrar cliente</button>
            </div>

            <div class="jp_table-container">
                <table class="jp_table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nome</th>
                            <th>Data de cadastro</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($paginatedClientes as $cliente): ?>
                        <tr data-id="<?php echo $cliente['id']; ?>">
                            <td>
                                <div class="jp_avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['data_cadastro']); ?></td>
                            <td></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="jp_pagination">
                <?php if ($totalPages > 1): ?>
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?php echo ($currentPage - 1); ?><?php echo $searchParam; ?>" 
                           class="jp_pagination-nav" aria-label="página anterior">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </a>
                    <?php else: ?>
                        <span class="jp_pagination-nav jp_pagination-disabled" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </span>
                    <?php endif; ?>
                    
                    <a href="?page=1<?php echo $searchParam; ?>" 
                       class="<?php echo $currentPage == 1 ? 'active' : ''; ?>">
                        1
                    </a>
                    
                    <?php
                    $pagesToShow = 2;
                    $startPage = max(2, $currentPage - $pagesToShow);
                    $endPage = min($totalPages - 1, $currentPage + $pagesToShow);
                    
                    if ($startPage > 2): ?>
                        <span class="jp_pagination-ellipsis">...</span>
                    <?php endif;
                    
                    for ($i = $startPage; $i <= $endPage; $i++): ?>
                        <a href="?page=<?php echo $i; ?><?php echo $searchParam; ?>" 
                           class="<?php echo $currentPage == $i ? 'active' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor;
                    
                    if ($endPage < $totalPages - 1): ?>
                        <span class="jp_pagination-ellipsis">...</span>
                    <?php endif;
                    
                    if ($totalPages > 1): ?>
                        <a href="?page=<?php echo $totalPages; ?><?php echo $searchParam; ?>" 
                           class="<?php echo $currentPage == $totalPages ? 'active' : ''; ?>">
                            <?php echo $totalPages; ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?php echo ($currentPage + 1); ?><?php echo $searchParam; ?>" 
                           class="jp_pagination-nav" aria-label="próxima página">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                    <?php else: ?>
                        <span class="jp_pagination-nav jp_pagination-disabled" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </span>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div id="addClienteModal" class="jp_modal">
        <div class="jp_modal-content jp_modal-new">
            <h2>Cadastro de cliente</h2>
            <form id="addClienteForm">
                <div class="jp_form-row">
                    <div class="jp_form-group">
                        <label>*Obrigatório</label>
                        <input type="text" id="nome" name="nome" placeholder="Nome" required>
                    </div>
                    <div class="jp_form-group">
                        <label>*Utilize seu número com código de área (ex: 11 99999-9999)</label>
                        <input type="tel" id="telefone" name="telefone" placeholder="Telefone">
                    </div>
                </div>
                <div class="jp_form-row">
                    <div class="jp_form-group">
                        <label>*Obrigatório</label>
                        <input type="text" id="data_nascimento" name="data_nascimento" placeholder="Data de nascimento" required>
                    </div>
                    <div class="jp_form-group">
                        <label>*Obrigatório</label>
                        <input type="email" id="email" name="email" placeholder="E-mail" required>
                    </div>
                </div>
                <div class="jp_form-row">
                    <div class="jp_form-group">
                        <label>*Obrigatório</label>
                        <input type="text" id="cpf" name="cpf" placeholder="CPF" required>
                    </div>
                    <div class="jp_form-actions-right">
                        <button type="submit" class="jp_button jp_button-cadastrar">Cadastrar cliente</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="../../PUBLIC/JS/script-lista-clientes.js"></script>
</body>
</html>