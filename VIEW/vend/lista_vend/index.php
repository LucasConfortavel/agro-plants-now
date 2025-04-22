<?php
// array de clientes para teste
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

// funcionalidade de busca
$search = isset($_GET['search']) ? $_GET['search'] : '';
if (!empty($search)) {
    $clientes = array_filter($clientes, function($cliente) use ($search) {
        return stripos($cliente['nome'], $search) !== false;
    });
}

// paginacao
$itemsPerPage = 8;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$totalPages = ceil(count($clientes) / $itemsPerPage);
$paginatedClientes = array_slice($clientes, ($currentPage - 1) * $itemsPerPage, $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Clientes</title>
    <link rel="stylesheet" href="menu_lateral/style_menu.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="jp_hamburger-menu">
        <div class="jp_hamburger-line"></div>
        <div class="jp_hamburger-line"></div>
        <div class="jp_hamburger-line"></div>
    </div>

    <div class="jp_container">
        <!-- incluir o menu lateral -->
        <?php include 'menu_lateral/Menu_adm.php'; ?>

        <!-- conteudo principal -->
        <div class="jp_main-content">
            <div class="jp_top-bar">
                <div class="jp_notification-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                </div>
                <div class="jp_user-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
            </div>

            <div class="jp_header">
                <div></div><!-- Espaço vazio para manter o layout flexbox -->
                
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

            <div class="jp_pagination">
                <?php if ($totalPages > 1): ?>
                    <?php
                    // definir quantos numeros de pagina mostrar antes e depois da pagina atual
                    $pagesToShow = 2;
                    $showEllipsis = ($totalPages > ($pagesToShow * 2 + 1));
                    
                    // botao de pagina anterior
                    if ($currentPage > 1): ?>
                        <a href="?page=<?php echo ($currentPage - 1); ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>" 
                        class="jp_pagination-nav" aria-label="pagina anterior">
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
                    
                    <?php
                    // mostrar sempre a primeira pagina
                    ?>
                    <a href="?page=1<?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>" 
                    class="<?php echo 1 === $currentPage ? 'active' : ''; ?>">
                        1
                    </a>
                    
                    <?php
                    // calcular intervalo de paginas visiveis
                    $startPage = max(2, $currentPage - $pagesToShow);
                    $endPage = min($totalPages - 1, $currentPage + $pagesToShow);
                    
                    // mostrar reticencias apos a primeira pagina se necessario
                    if ($startPage > 2): ?>
                        <span class="jp_pagination-ellipsis">...</span>
                    <?php endif;
                    
                    // mostrar numeros de pagina
                    for ($i = $startPage; $i <= $endPage; $i++): ?>
                        <a href="?page=<?php echo $i; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>" 
                        class="<?php echo $i === $currentPage ? 'active' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor;
                    
                    // mostrar reticencias antes da ultima pagina se necessario
                    if ($endPage < $totalPages - 1): ?>
                        <span class="jp_pagination-ellipsis">...</span>
                    <?php endif;
                    
                    // mostrar sempre a ultima pagina se houver mais de uma pagina
                    if ($totalPages > 1): ?>
                        <a href="?page=<?php echo $totalPages; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>" 
                        class="<?php echo $totalPages === $currentPage ? 'active' : ''; ?>">
                            <?php echo $totalPages; ?>
                        </a>
                    <?php endif; ?>
                    
                    <!-- botao de pagina seguinte -->
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?php echo ($currentPage + 1); ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>" 
                        class="jp_pagination-nav" aria-label="proxima pagina">
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

    <!-- modal para adicionar um novo cliente -->
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

    <script>
        // alternar menu lateral ao clicar no menu hamburguer
        document.querySelector('.jp_hamburger-menu').addEventListener('click', function() {
            this.classList.toggle('active');
            document.querySelector('.jp_sidebar').classList.toggle('active');
        });

        // funcionalidade do modal para adicionar cliente
        const addModal = document.getElementById('addClienteModal');
        const addBtn = document.getElementById('cadastrarClienteBtn');
        const addClienteForm = document.getElementById('addClienteForm');

        addBtn.addEventListener('click', () => {
            addModal.style.display = 'block';
        });

        addClienteForm.addEventListener('submit', (e) => {
            e.preventDefault();
            // em uma aplicacao real, voce enviaria esses dados para o servidor
            // para este exemplo, vamos apenas mostrar um alerta e fechar o modal
            alert('Cliente cadastrado com sucesso!');
            addModal.style.display = 'none';
            addClienteForm.reset();
        });

        // fechar modais ao clicar fora
        window.addEventListener('click', (e) => {
            if (e.target === addModal) {
                addModal.style.display = 'none';
            }
        });
    </script>
</body>
</html>
