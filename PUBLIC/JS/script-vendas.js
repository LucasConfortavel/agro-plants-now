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

  const formatarData = (dataStr) => {
  const [ano, mes, diaHora] = dataStr.split('-');
  const dia = diaHora.split(' ')[0]; // pega só o dia antes do espaço
  return `${dia.padStart(2, '0')}/${mes.padStart(2, '0')}/${ano}`;
};

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
    if(pagina != total_pag && total_pag > 1){
        html+=` <a href="?pagina=${parseInt(pagina, 10)+1}" class="jv_page-arrow"><i class="fas fa-arrow-right"></i></a>`;
    }

    area_pags.innerHTML=html;
    html="";

    vendas = dados.slice(((pagina-1)*4), (pagina*limite));    

    vendas.forEach(venda => {
        if (window.location.href.includes("vendas")) {
            html +=`
            <tr>
                <td>
                    <div class="jv_customer-info">
                        <div class="jv_customer-details">
                            <h4>${venda['nome_vendedor']}</h4>
                            <p>${venda['email_vendedor']}</p>
                        </div>
                    </div>
                </td>`;
            html += `<td>${venda['nome_cliente']}</td>`;
            html += `<td>R$ ${venda['total']}</td>`;
            html += `<td class="jv_table-action">
                        <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>   
                        <form class="jv_dropdown" method="GET" action="">
                            <button class="jv_dropdown-item" type="submit" name="visualizar" value="${venda['id']}">
                                <i class="fas fa-eye"></i> Visualizar
                            </button>
                            <div class="jv_dropdown-separator"></div>
                            <button type="button" 
                                class="jv_dropdown-item jv_danger" 
                                onclick="abrirPopup('../../VIEW/pop-up/pop-up_remover.php?id=${venda['id']}', 'Confirmação de Remoção')">
                                <i class="fas fa-trash"></i> Remover
                            </button>
                        </form>
                    </td>
                </tr>`;
        } else if(window.location.href.includes("Rel")){
            html += `<tr><td>${formatarData(venda['data_venda'])}</td>`;
            html +=`
            <td>
                <div class="jv_customer-info">
                    <div class="jv_avatar">
                    </div>
                    <div class="jv_customer-details">
                        <h4>${venda['nome_vendedor']}</h4>
                        <p>${venda['email_vendedor']}</p>
                    </div>
                </div>
            </td>`;
            html += `<td>${venda['nome_cliente']}</td>`;
            html += `<td>R$ ${venda['total']}</td></tr>`;
        }
    });
    tabela.innerHTML = html;
    let contador = document.getElementById("jv_customerCount");
    contador.textContent= `vendas encontradas ${vendas.length}`;
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
        if (dado["nome_vendedor"].toLowerCase().includes(pesquisa.toLowerCase()) || 
            dado["nome_cliente"].toLowerCase().includes(pesquisa.toLowerCase())) {
            dados_filtrado.push(dado);
        }
    });

    area_pags = document.getElementsByClassName('jv_page-navigation')[0];
    area_pags.innerHTML="";
    
    dados_filtrado.forEach(venda => {
        if (window.location.href.includes("vendas")) {
            html += `<tr>
                <td>
                    <div class="jv_customer-info">
                        <div class="jv_customer-details">
                            <h4>${venda['nome_vendedor']}</h4>
                            <p>${venda['email_vendedor']}</p>
                        </div>
                    </div>
                </td>`;
            html += `<td>${venda['nome_cliente']}</td>`;
            html += `<td>R$ ${venda['total']}</td>`;
            html += `<td class="jv_table-action">
                        <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <form class="jv_dropdown" method="GET" action="">
                            <button class="jv_dropdown-item" type="submit" name="visualizar" value="${venda['id']}">
                                <i class="fas fa-eye"></i> Visualizar
                            </button>
                            <div class="jv_dropdown-separator"></div>
                            <button type="button" 
                                class="jv_dropdown-item jv_danger" 
                                onclick="abrirPopup('../../VIEW/pop-up/pop-up_remover.php?id=${venda['id']}', 'Confirmação de Remoção')">
                                <i class="fas fa-trash"></i> Remover
                            </button>
                        </form>
                    </td>
                </tr>`;
        } else if(window.location.href.includes("Rel")){
            html += `<tr><td>${formatarData(venda['data_venda'])}</td>`;
            html +=`
            <td>
                <div class="jv_customer-info">
                    <div class="jv_avatar">
                    </div>
                    <div class="jv_customer-details">
                        <h4>${venda['nome_vendedor']}</h4>
                        <p>${venda['email_vendedor']}</p>
                    </div>
                </div>
            </td>`;
            html += `<td>${venda['nome_cliente']}</td>`;
            html += `<td>R$ ${venda['total']}</td>`;
            html += `<td class="jv_table-action">
                        <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <form class="jv_dropdown" method="GET" action="">
                            <button class="jv_dropdown-item" type="submit" name="visualizar" value="${venda['id']}">
                                <i class="fas fa-eye"></i> Visualizar
                            </button>
                            <div class="jv_dropdown-separator"></div>
                            <button type="button" 
                                class="jv_dropdown-item jv_danger" 
                                onclick="abrirPopup('../../VIEW/pop-up/pop-up_remover.php?id=${venda['id']}', 'Confirmação de Remoção')">
                                <i class="fas fa-trash"></i> Remover
                            </button>
                        </form>
                    </td>
                </tr>`;
        }
    });

    info_tabela.innerHTML = html;
    let contador = document.getElementById("jv_customerCount");
    contador.textContent= `vendas encontradas ${dados_filtrado.length}`;
}

GerarTabela();