
function formatarData(dataStr) {
    const [ano, mes, dia] = dataStr.split('-');
    return `${dia.padStart(2,'0')}/${mes.padStart(2,'0')}/${ano}`;
}

let pagina = 1;
const limite = 4;
let dadosOriginais = [...dados]; // dados vindos do PHP
let dadosFiltrados = [...dados];

function gerarPaginacao(totalPaginas) {
    const areaPags = document.getElementsByClassName('jv_page-navigation')[0];
    let html = "";

function Pesquisar(){
    inputPesquisa = document.getElementById("jv_searchInput");
    pesquisa = inputPesquisa.value;
    if(pesquisa == ""){
        GerarTabela();
        return none;
    }
    info_tabela = document.getElementById("jv_customerTableBody");
    info_tabela.innerHTML = '';
    html="";
    dados_filtrado=[];

    for (let i = 1; i <= totalPaginas; i++) {
        html += `<a href="#" class="jv_page-number ${i === pagina ? 'active' : ''}" data-pag="${i}">${i}</a>`;
    }

    if (pagina < totalPaginas) {
        html += `<a href="#" class="jv_page-arrow" data-pag="${pagina + 1}"><i class="fas fa-arrow-right"></i></a>`;
    }

    areaPags.innerHTML = html;

    // adicionar eventos nos links de paginação
    areaPags.querySelectorAll('a[data-pag]').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            pagina = parseInt(link.getAttribute('data-pag'));
            gerarTabela();
        });
    });
}

function gerarTabela() {
    const tabela = document.getElementById("jv_customerTableBody");
    tabela.innerHTML = "";

    const totalPaginas = Math.ceil(dadosFiltrados.length / limite);
    gerarPaginacao(totalPaginas);

    const inicio = (pagina - 1) * limite;
    const fim = inicio + limite;
    const cupons = dadosFiltrados.slice(inicio, fim);

    if (cupons.length === 0) {
        tabela.innerHTML = `<tr><td colspan="6" style="text-align: center; height: 49.7vh;">Nenhum cupom encontrado</td></tr>`;
        return;
    }

    cupons.forEach(cupom => {
        tabela.innerHTML += `
            <tr>
                <td>
                    <input type="checkbox" name="selecionados[]" form="formRemoverSelecionados"
                           class="jv_checkbox customer-checkbox"
                           data-customer-id="${cupom.id}"
                           value="${cupom.id}">
                </td>
                <td>${cupom.codigo}</td>
                <td>${cupom.valor}%</td>
                <td>${formatarData(cupom.data_emissao)}</td>
                <td>${formatarData(cupom.data_validade)}</td>
            </tr>
        `;
    });


    area_pags = document.getElementsByClassName('jv_page-navigation')[0];
    area_pags.innerHTML="";
    
    dados_filtrado.forEach(cupom => {
        if (cupom["codigo"].toLowerCase().includes(pesquisa.toLowerCase())) {
           html += `<tr><td>${cupom['codigo']}</td>`;
           html += `<td>${cupom['valor']}%</td>`;
           html += `<td>${formatarData(cupom['data_emissao'])}</td>`;
           html += `<td>${formatarData(cupom['data_validade'])}</td></tr>`;
           
        }
    });

    info_tabela.innerHTML = html;
    
}


let selectedCustomers = [];

function atualizarSelecao() {
    const selectAllCheckbox = document.getElementById('jv_selectAll');
    const checkboxes = document.querySelectorAll('.customer-checkbox');
    const removeButton = document.getElementById('jv_removeSelected');
    const selectedCount = document.getElementById('jv_selectedCount');

    function updateSelectedCount() {
        const checkedBoxes = document.querySelectorAll('.customer-checkbox:checked');
        selectedCustomers = Array.from(checkedBoxes).map(cb => cb.dataset.customerId);
        const totalSelected = selectedCustomers.length;
        selectedCount.textContent = totalSelected;
        removeButton.style.display = totalSelected > 0 ? 'inline-flex' : 'none';
    }

    selectAllCheckbox.onchange = () => {
        checkboxes.forEach(cb => cb.checked = selectAllCheckbox.checked);
        updateSelectedCount();
    };

    checkboxes.forEach(cb => {
        cb.onchange = () => {
            const allChecked = document.querySelectorAll('.customer-checkbox:checked').length === checkboxes.length;
            selectAllCheckbox.checked = allChecked;
            updateSelectedCount();
        };
    });

    updateSelectedCount();
}

function atualizarContagem() {
    const customerCountElement = document.getElementById('jv_customerCount');
    const total = dadosFiltrados.length;
    customerCountElement.textContent = `${total} ${total === 1 ? 'cupom encontrado' : 'cupons encontrados'}`;
}


document.addEventListener('DOMContentLoaded', function() {
    gerarTabela();
});
