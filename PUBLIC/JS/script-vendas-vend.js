function toggleDropdown(btn) {
    const dropdown = btn.nextElementSibling;
    const isVisible = dropdown.style.display === "block";

    // Fecha todos os outros
    document.querySelectorAll(".jv_dropdown").forEach(d => d.style.display = "none");

    // Abre apenas o clicado
    if (!isVisible) {
        dropdown.style.display = "block";
    }
}

// Fecha ao clicar fora
document.addEventListener("click", e => {
    if (!e.target.closest(".jv_menu-btn") && !e.target.closest(".jv_dropdown")) {
        document.querySelectorAll(".jv_dropdown").forEach(d => d.style.display = "none");
    }
});

formatarData = (dataStr) => {
    const [ano, mes, dia] = dataStr.split('-');
    return `${dia.padStart(2,'0')}/${mes.padStart(2,'0')}/${ano}`;
}

function GerarTabela(){
    tabela = document.getElementById("jv_customerTableBody");
    html="";
    
    limite = 4;
    
    const url = new URLSearchParams(window.location.search);
    if (url.has('pagina')) {
        pagina = url.get('pagina');
    } else {
        pagina = 1;
    }
    
    total_pag = Math.ceil(dados.length/limite);
    area_pags = document.getElementsByClassName('jv_page-navigation')[0];
    
    html_pag = "";
    if(pagina != 1){
        html_pag += ` <a href="?pagina=${pagina-1}" class="jv_page-arrow"><i class="fas fa-arrow-left"></i></a>`;
    }

    for (let i = 1; i <= total_pag; i++) {    
        if(i == pagina){
            html_pag += `<a href='?pagina=${i}' class='jv_page-number active'>${i}</a>`;            
        }else{
            html_pag += `<a href='?pagina=${i}' class='jv_page-number'>${i}</a>`;
        }
    }

    if(pagina != total_pag){
        html_pag += ` <a href="?pagina=${parseInt(pagina, 10)+1}" class="jv_page-arrow"><i class="fas fa-arrow-right"></i></a>`;
    }
    
    area_pags.innerHTML = html_pag;

    vendas = dados.slice(((pagina-1)*4), (pagina*limite));    

    vendas.forEach(venda => {
        // Pegar as iniciais do cliente
        const iniciais = venda['nome_cliente'] ? venda['nome_cliente'].substring(0, 2).toUpperCase() : 'CL';
        
        html += `<tr>
            <td>
                <div class="jv_customer-info">
                    <div class="jv_avatar">
                        ${iniciais}
                    </div>
                    <div class="jv_customer-details">
                        <h4>Venda #${venda['id']}</h4>
                    </div>
                </div>
            </td>
            <td>${venda['data_venda'] || '-'}</td>
            <td>${venda['nome_cliente'] || '-'}</td>
            <td>R$ ${parseFloat(venda['total']).toFixed(2).replace('.', ',')}</td>
            <td class="jv_table-action">
                <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
                <div class="jv_dropdown">
                    <a href="venda-info-vend.php?id=${venda['id']}" class="jv_dropdown-item">
                        <i class="fas fa-eye"></i> Visualizar
                    </a>
                    <div class="jv_dropdown-separator"></div>
                    <button type="button" 
                        class="jv_dropdown-item jv_danger" 
                        onclick="confirmarRemocao(${venda['id']})">
                        <i class="fas fa-trash"></i> Remover
                    </button>
                </div>
            </td>
        </tr>`;
    });
    
    tabela.innerHTML = html;
    
    // Atualizar contador
    document.getElementById('jv_customerCount').textContent = 
        `${dados.length} ${dados.length === 1 ? 'venda encontrada' : 'vendas encontradas'}`;
}

function Pesquisar(){
    inputPesquisa = document.getElementById("jv_searchInput");
    pesquisa = inputPesquisa.value;
    
    if(pesquisa == ""){
        GerarTabela();
        return;
    }
    
    info_tabela = document.getElementById("jv_customerTableBody");
    info_tabela.innerHTML = '';
    html="";
    dados_filtrado=[];

    dados.forEach(dado => {
        const vendaId = `Venda #${dado['id']}`;
        if (vendaId.toLowerCase().includes(pesquisa.toLowerCase()) || 
            (dado["nome_cliente"] && dado["nome_cliente"].toLowerCase().includes(pesquisa.toLowerCase()))) {
            dados_filtrado.push(dado);
        }
    });

    area_pags = document.getElementsByClassName('jv_page-navigation')[0];
    area_pags.innerHTML="";
    
    dados_filtrado.forEach(venda => {
        const iniciais = venda['nome_cliente'] ? venda['nome_cliente'].substring(0, 2).toUpperCase() : 'CL';
        
        html += `<tr>
            <td>
                <div class="jv_customer-info">
                    <div class="jv_avatar">
                        ${iniciais}
                    </div>
                    <div class="jv_customer-details">
                        <h4>Venda #${venda['id']}</h4>
                    </div>
                </div>
            </td>
            <td>${venda['data_venda'] || '-'}</td>
            <td>${venda['nome_cliente'] || '-'}</td>
            <td>R$ ${parseFloat(venda['total']).toFixed(2).replace('.', ',')}</td>
            <td class="jv_table-action">
                <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
                <div class="jv_dropdown">
                    <a href="venda-info-vend.php?id=${venda['id']}" class="jv_dropdown-item">
                        <i class="fas fa-eye"></i> Visualizar
                    </a>
                    <div class="jv_dropdown-separator"></div>
                    <button type="button" 
                        class="jv_dropdown-item jv_danger" 
                        onclick="confirmarRemocao(${venda['id']})">
                        <i class="fas fa-trash"></i> Remover
                    </button>
                </div>
            </td>
        </tr>`;
    });

    info_tabela.innerHTML = html;
    
    // Atualizar contador
    document.getElementById('jv_customerCount').textContent = 
        `${dados_filtrado.length} ${dados_filtrado.length === 1 ? 'venda encontrada' : 'vendas encontradas'}`;
}

function confirmarRemocao(id) {
    if (confirm('Tem certeza que deseja remover esta venda?')) {
        window.location.href = `?remover=${id}`;
    }
}

// Inicializar tabela ao carregar
document.addEventListener('DOMContentLoaded', function() {
    GerarTabela();
});