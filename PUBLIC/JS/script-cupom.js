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
        pagina = url.get('pagina');;
    } else {
        pagina = 1;
    }
    
    total_pag = Math.ceil(dados.length/limite);
    area_pags = document.getElementsByClassName('jv_page-navigation')[0];
    
    if(pagina != 1){
        html+=` <a href="?pagina=${pagina-1}" class="jv_page-arrow"><i class="fas fa-arrow-left"></i></a>`;
    }

    for (let i = 1; i <= total_pag; i++) {    
       
        if(i == pagina){
            html+=`<a href='?pagina=${i}' class='jv_page-number active'>${i}</a>`;            
        }else{
            html+=`<a href='?pagina=${i}' class='jv_page-number'>${i}</a>`;
        }
    }

    if(pagina != total_pag){
        html+=` <a href="?pagina=${parseInt(pagina, 10)+1}" class="jv_page-arrow"><i class="fas fa-arrow-right"></i></a>`;
    }
    

    area_pags.innerHTML=html;
    html="";

    cupons = dados.slice(((pagina-1)*4), (pagina*limite));

    cupons.forEach(cupom => {
        html += `<tr><td>${cupom['codigo']}</td>`;
        html += `<td>${cupom['valor']}%</td>`;
        html += `<td>${formatarData(cupom['data_emissao'])}</td>`;
        html += `<td>${formatarData(cupom['data_validade'])}</td></tr>`;

    });
    tabela.innerHTML = html;
}



function Pesquisar(){
    inputPesquisa = document.getElementById("jv_searchInput");
    pesquisa = inputPesquisa.value;
    info_tabela = document.getElementById("jv_customerTableBody");
    info_tabela.innerHTML = '';
    html="";
    dados_filtrado=[];

    dados.forEach(dado => {
        if (dado["codigo"].toLowerCase().includes(pesquisa.toLowerCase())) {
            dados_filtrado.push(dado);
        }
    });

    limite = 4;
    pagina = 1;

    cupons = dados_filtrado.slice(((pagina-1)*4), (pagina*limite));
    
    cupons.forEach(cupom => {
        data_emissao = new Date(cupom['data_emissao']);
        data_validade = new Date(cupom['data_validade']);
        if (cupom["codigo"].toLowerCase().includes(pesquisa.toLowerCase())) {
           html += `<tr><td>${cupom['codigo']}</td>`;
           html += `<td>${cupom['valor']}%</td>`;
           html += `<td>${formatarData(cupom['data_emissao'])}</td>`;
           html += `<td>${formatarData(cupom['data_validade'])}</td></tr>`;
           
        }
    });

    info_tabela.innerHTML = html;
    
};

GerarTabela();
