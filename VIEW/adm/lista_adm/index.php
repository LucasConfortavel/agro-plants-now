<?php
// array de vendedores para teste
$vendedores = [];

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

    $vendedores[] = [
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
    $vendedores = array_filter($vendedores, function($vendedor) use ($search) {
        return stripos($vendedor['nome'], $search) !== false;
    });
}

// paginacao
$itemsPerPage = 8;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$totalPages = ceil(count($vendedores) / $itemsPerPage);
$paginatedVendedores = array_slice($vendedores, ($currentPage - 1) * $itemsPerPage, $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Vendedores</title>
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
                <button class="jp_button jp_button-remove" id="removeVendedorBtn">Remover vendedor</button>
                
                <form action="" method="GET" class="jp_search-container">
                    <input type="text" name="search" placeholder="Pesquise por um vendedor" value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </form>
                
                <button class="jp_button" id="cadastrarVendedorBtn">Cadastrar vendedor</button>
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
                    <?php foreach ($paginatedVendedores as $vendedor): ?>
                    <tr data-id="<?php echo $vendedor['id']; ?>">
                        <td>
                            <div class="jp_avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($vendedor['nome']); ?></td>
                        <td><?php echo htmlspecialchars($vendedor['data_cadastro']); ?></td>
                        <td>
                            <div class="jp_info-icon" onclick="showVendedorInfo(<?php echo $vendedor['id']; ?>)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                </svg>
                            </div>
                        </td>
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

    <!-- modal para adicionar um novo vendedor -->
    <div id="addVendedorModal" class="jp_modal">
        <div class="jp_modal-content jp_modal-new">
            <h2>Cadastro de vendedor</h2>
            <form id="addVendedorForm">
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
                        <button type="submit" class="jp_button jp_button-cadastrar">Cadastrar vendedor</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- modal para remover um vendedor -->
    <div id="removeVendedorModal" class="jp_modal">
        <div class="jp_modal-content jp_modal-new">
            <h2>Remover vendedor</h2>
            <form id="removeVendedorForm">
                <div class="jp_form-group">
                    <label>*Obrigatório</label>
                    <input type="text" id="cpf_remover" name="cpf_remover" placeholder="CPF" required>
                </div>
                <div class="jp_form-actions-center">
                    <button type="submit" class="jp_button jp_button-apagar">Avançar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- modal para informacoes do vendedor -->
    <div id="vendedorInfoModal" class="jp_modal">
        <div class="jp_modal-content jp_modal-new jp_modal-info">
            <div class="jp_modal-back">
                <button id="closeInfoModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </button>
            </div>
            <div class="jp_info-header">
                <div class="jp_info-avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
            </div>
            <div id="vendedorInfoContent" class="jp_info-content">
                <!-- conteudo vai ser populado dinamicamente -->
            </div>
            <div class="jp_info-actions">
                <button type="button" class="jp_button jp_button-remover" id="removeVendedorInfoBtn">Remover</button>
            </div>
        </div>
    </div>

    <!-- modal para confirmação de remoção de vendedor -->
    <div id="successRemovalModal" class="jp_modal">
        <div class="jp_modal-content jp_modal-new">
            <h2>Vendedor removido</h2>
            <div class="jp_success-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <div class="jp_success-message">
                <p>O vendedor foi removido com sucesso.</p>
                <p id="removedVendedorCPF" class="jp_removed-cpf"></p>
            </div>
            <div class="jp_form-actions-center">
                <button type="button" class="jp_button" id="closeSuccessModal">Fechar</button>
            </div>
        </div>
    </div>

    <script>
        // alternar menu lateral ao clicar no menu hamburguer
        document.querySelector('.jp_hamburger-menu').addEventListener('click', function() {
            this.classList.toggle('active');
            document.querySelector('.jp_sidebar').classList.toggle('active');
        });

        // funcionalidade do modal para adicionar vendedor
        const addModal = document.getElementById('addVendedorModal');
        const addBtn = document.getElementById('cadastrarVendedorBtn');
        const addVendedorForm = document.getElementById('addVendedorForm');

        addBtn.addEventListener('click', () => {
            addModal.style.display = 'block';
        });

        addVendedorForm.addEventListener('submit', (e) => {
            e.preventDefault();
            // em uma aplicacao real, voce enviaria esses dados para o servidor
            // para este exemplo, vamos apenas mostrar um alerta e fechar o modal
            alert('Vendedor cadastrado com sucesso!');
            addModal.style.display = 'none';
            addVendedorForm.reset();
        });

        // funcionalidade do modal para remover vendedor
        const removeModal = document.getElementById('removeVendedorModal');
        const removeBtn = document.getElementById('removeVendedorBtn');
        const removeVendedorForm = document.getElementById('removeVendedorForm');
        const successRemovalModal = document.getElementById('successRemovalModal');
        const closeSuccessModal = document.getElementById('closeSuccessModal');
        const removedVendedorCPF = document.getElementById('removedVendedorCPF');

        removeBtn.addEventListener('click', () => {
            removeModal.style.display = 'block';
        });

        removeVendedorForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const cpf = document.getElementById('cpf_remover').value;
            
            if (!cpf) {
                alert('Por favor, informe o CPF do vendedor a ser removido.');
                return;
            }
            
            // em uma aplicacao real, voce enviaria esses dados para o servidor
            // para este exemplo, vamos mostrar o modal de sucesso em vez do alerta
            removeModal.style.display = 'none';
            
            // Mostrar o CPF no modal de sucesso
            removedVendedorCPF.textContent = `CPF: ${cpf}`;
            
            // Exibir o modal de sucesso
            successRemovalModal.style.display = 'block';
            
            // Resetar o formulário
            removeVendedorForm.reset();
        });

        // Fechar o modal de sucesso
        closeSuccessModal.addEventListener('click', () => {
            successRemovalModal.style.display = 'none';
        });

        // funcionalidade do modal para informacoes do vendedor
        const infoModal = document.getElementById('vendedorInfoModal');
        const closeInfoModal = document.getElementById('closeInfoModal');
        const removeVendedorInfoBtn = document.getElementById('removeVendedorInfoBtn');
        const vendedorInfoContent = document.getElementById('vendedorInfoContent');

        function showVendedorInfo(id) {
            // em uma aplicacao real, voce buscaria os detalhes do vendedor do servidor
            // para este exemplo, vamos usar os dados de teste
            const vendedor = <?php echo json_encode($vendedores); ?>.find(v => v.id === id);
            
            if (vendedor) {
                vendedorInfoContent.innerHTML = `
                    <div class="jp_info-row">
                        <div class="jp_info-group">
                            <label>Nome</label>
                            <p>${vendedor.nome}</p>
                        </div>
                        <div class="jp_info-group">
                            <label>Data de nascimento</label>
                            <p>${vendedor.data_nascimento}</p>
                        </div>
                    </div>
                    <div class="jp_info-row">
                        <div class="jp_info-group">
                            <label>E-mail</label>
                            <p>${vendedor.email}</p>
                        </div>
                        <div class="jp_info-group">
                            <label>Telefone</label>
                            <p>${vendedor.telefone}</p>
                        </div>
                    </div>
                    <div class="jp_info-row">
                        <div class="jp_info-group">
                            <label>CPF</label>
                            <p>${vendedor.cpf}</p>
                        </div>
                    </div>
                `;
                infoModal.style.display = 'block';
            }
        }

        closeInfoModal.addEventListener('click', () => {
            infoModal.style.display = 'none';
        });

        removeVendedorInfoBtn.addEventListener('click', () => {
            infoModal.style.display = 'none';
            
            // Obter o CPF do vendedor
            const cpfElement = document.querySelector('#vendedorInfoContent .jp_info-group:last-child p');
            if (cpfElement) {
                const cpf = cpfElement.textContent;
                
                // Mostrar o CPF no modal de sucesso
                removedVendedorCPF.textContent = `CPF: ${cpf}`;
                
                // Exibir o modal de sucesso diretamente
                successRemovalModal.style.display = 'block';
            }
        });

        // fechar modais ao clicar fora
        window.addEventListener('click', (e) => {
            if (e.target === addModal) {
                addModal.style.display = 'none';
            }
            if (e.target === removeModal) {
                removeModal.style.display = 'none';
            }
            if (e.target === infoModal) {
                infoModal.style.display = 'none';
            }
            if (e.target === successRemovalModal) {
                successRemovalModal.style.display = 'none';
            }
        });

        // tornar as linhas da tabela clicaveis para mostrar informacoes do vendedor
        document.querySelectorAll('.jp_table tbody tr').forEach(row => {
            row.addEventListener('click', (e) => {
                // nao acionar se clicar no icone de informacao (este possui seu proprio manipulador)
                if (!e.target.closest('.jp_info-icon')) {
                    const id = parseInt(row.getAttribute('data-id'));
                    showVendedorInfo(id);
                }
            });
        });
    </script>
</body>
</html>
