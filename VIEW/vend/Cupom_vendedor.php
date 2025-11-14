<?php
include "../../INCLUDE/Menu_vend.php";
include "../../CONTROLLER/CupomController.php";
include "../../INCLUDE/vlibras.php";

$cupom_control = new CupomController();
$cupons = $cupom_control->index();

// Filtra apenas cupons válidos
$hoje = date('Y-m-d');
$cupons = array_filter($cupons, function($cupom) use ($hoje) {
    $data_validade = $cupom['data_validade'] ?? $cupom['validade'] ?? null;
    return $data_validade && $data_validade >= $hoje;
});

$total_cupons = count($cupons);


$limite = 4;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina_atual < 1) $pagina_atual = 1;

$offset = ($pagina_atual - 1) * $limite;
$total_paginas = ceil($total_cupons / $limite);

// limitar os cupons exibidos na página
$cupons = array_slice($cupons, $offset, $limite);

// Criação de cupom via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cupom_control->criarCupom();
    unset($_POST);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Cupons</title>
    <link rel="stylesheet" href="../../PUBLIC/css/cupom-vend.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<main class="jp_main-content">
    <h1 class="ym_titulo">Cupons</h1>

    <div class="jv_container">
        <div class="jv_card">
            <div class="jv_card-header">
                <div class="jv_header-content">
                    <form method="POST" action="#" class="jv_search-section">
                        <div class="jv_search-container">
                            <button type="submit" class="ym_area-icon-pesquisa" name="pesquisar">
                                <i class="fas fa-search search-icon"></i>
                            </button>
                            <input type="text" name="pesquisa" id="jv_searchInput" placeholder="Pesquisar por código..." class="jv_search-input">
                        </div>
                    </form>
                </div>
                <p class="jv_subtitle" id="jv_customerCount">
                    <?= $total_cupons ?> <?= $total_cupons == 1 ? 'cupom encontrado' : 'cupons encontrados' ?>
                </p>
            </div>

            <div class="jv_card-content">
                <div class="jv_table-container">
                    <table class="jv_table">
                        <thead>
                            <tr class="jv_table-header">
                                <th class="jv_codigo">Código</th>
                                <th class="jv_desconto">Desconto</th>
                                <th class="jv_cadastro">Data de Cadastro</th>
                                <th class="jv_validade">Validade</th>
                            </tr>
                        </thead>
                        <tbody id="jv_customerTableBody">
                            <?php if ($total_cupons > 0): ?>
                                <?php foreach ($cupons as $cupom): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($cupom['codigo'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($cupom['valor'] ?? $cupom['desconto'] ?? '0') ?>%</td>
                                        <td><?= isset($cupom['data_emissao']) ? date("d/m/Y", strtotime($cupom['data_emissao'])) : '-' ?></td>
                                        <td><?= isset($cupom['data_validade']) ? date("d/m/Y", strtotime($cupom['data_validade'])) : '-' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" style="text-align: center;">Nenhum cupom encontrado</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Paginação -->
    <div class="jv_page-navigation">
        <?php if($pagina_atual > 1): ?>
            <a href="?pagina=<?= $pagina_atual - 1 ?>" class="jv_page-arrow"><i class="fas fa-arrow-left"></i></a>
        <?php endif; ?>
        <?php
        $inicio = max(1, $pagina_atual - 2);
        $fim = min($total_paginas, $pagina_atual + 2);
        for ($i = $inicio; $i <= $fim; $i++): ?>
            <a href="?pagina=<?= $i ?>" class="jv_page-number <?= $i == $pagina_atual ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
        <?php if($pagina_atual < $total_paginas): ?>
            <a href="?pagina=<?= $pagina_atual + 1 ?>" class="jv_page-arrow"><i class="fas fa-arrow-right"></i></a>
        <?php endif; ?>
    </div>

    <script>
        const dados = <?= json_encode($cupons) ?>;

        function formatarData(dataStr) {
            const [ano, mes, dia] = dataStr.split('-');
            return `${dia.padStart(2,'0')}/${mes.padStart(2,'0')}/${ano}`;
        }

        function GerarTabela() {
            const tabela = document.getElementById("jv_customerTableBody");
            let html = "";
            const hoje = new Date();

            // Só mostra cupons válidos
            const cuponsValidos = dados.filter(cupom => new Date(cupom['data_validade']) >= hoje);

            cuponsValidos.forEach(cupom => {
                html += `<tr>
                    <td>${cupom['codigo']}</td>
                    <td>${cupom['valor']}%</td>
                    <td>${formatarData(cupom['data_emissao'])}</td>
                    <td>${formatarData(cupom['data_validade'])}</td>
                </tr>`;
            });

            tabela.innerHTML = html;
        }

        function Pesquisar() {
            const pesquisa = document.getElementById("jv_searchInput").value.toLowerCase();
            const tabela = document.getElementById("jv_customerTableBody");
            const hoje = new Date();

            let cuponsFiltrados = dados.filter(cupom => new Date(cupom['data_validade']) >= hoje);

            if (pesquisa !== "") {
                cuponsFiltrados = cuponsFiltrados.filter(cupom =>
                    cupom['codigo'].toLowerCase().includes(pesquisa)
                );
            }

            let html = "";
            cuponsFiltrados.forEach(cupom => {
                html += `<tr>
                    <td>${cupom['codigo']}</td>
                    <td>${cupom['valor']}%</td>
                    <td>${formatarData(cupom['data_emissao'])}</td>
                    <td>${formatarData(cupom['data_validade'])}</td>
                </tr>`;
            });

            tabela.innerHTML = html;
        }
    </script>
</main>
</body>
</html>