
function toggleDropdown(btn) {
    const dropdown = btn.nextElementSibling;
    const isVisible = dropdown.style.display === "block";

    document.querySelectorAll(".jv_dropdown").forEach(d => d.style.display = "none");

    if (!isVisible) {
        dropdown.style.display = "block";
    }
}

document.addEventListener("click", e => {
if (!e.target.closest(".jv_menu-btn") && !e.target.closest(".jv_dropdown")) {
    document.querySelectorAll(".jv_dropdown").forEach(d => d.style.display = "none");
}
});


//PESQUISA

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

    usuarios = dados.slice(((pagina-1)*4), (pagina*limite));

    usuarios.forEach(usuario => {

        html += `<tr><td>
        <div class="jv_customer-info">
            <div class="jv_avatar">
                ${usuario['nome'].substring(0, 2).toUpperCase()}
            </div>
            <div class="jv_customer-details">
                <h4>${usuario['nome']}</h4>
                <p>${usuario['email']}</p>
            </div>
        </div>
        </td>`;
        html += `<td>${usuario['telefone']}</td>`;
        html += `<td>${formatarData(usuario['data_nasc'])}</td>`;
        html += `<td>${usuario['status']}</td>`;
        html += `<td class="jv_table-action">
                    <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <form class="jv_dropdown" method="GET" action="">
                        <button type="submit" name="visualizar" value="${usuario['id']}" class="jv_dropdown-item">
                            <i class="fas fa-eye"></i> Visualizar
                        </button>
                        <div class="jv_dropdown-separator"></div>`
        if(usuario['status'] == "ATIVADO"){
            html += `<button type="button" onclick="abrirPopup(\'../../VIEW/pop-up/pop-up_remover.php?id='${usuario['id']},Cadastro de Vendedores)" class="jv_dropdown-item jv_danger">
                <i class="fa-solid fa-ban"></i> Desativar
            </button>
            </form>
        </td>
    </tr>`
            
        }else{html += `<button type="button" onclick="abrirPopup(../../VIEW/pop-up/pop-up_remover.php?id=${usuario['id']},Cadastro de Vendedores)" class="jv_dropdown-item jv_acess">
                <i class="fa-solid fa-power-off"></i> Ativar
            </button>
            </form>
        </td>
    </tr>`
        }
    });
    tabela.innerHTML = html;
}



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

    dados.forEach(dado => {
        if (dado["nome"].toLowerCase().includes(pesquisa.toLowerCase()) || dado["email"].toLowerCase().includes(pesquisa.toLowerCase())) {
            dados_filtrado.push(dado);
        }
    });


    area_pags = document.getElementsByClassName('jv_page-navigation')[0];
    area_pags.innerHTML="";
    
    dados_filtrado.forEach(usuario => {
        html += `<tr><td>
        <div class="jv_customer-info">
            <div class="jv_avatar">
                ${usuario['nome'].substring(0, 2).toUpperCase()}
            </div>
            <div class="jv_customer-details">
                <h4>${usuario['nome']}</h4>
                <p>${usuario['email']}</p>
            </div>
        </div>
        </td>`;
        html += `<td>${usuario['telefone']}</td>`;
        html += `<td>${formatarData(usuario['data_nasc'])}</td>`;
        html += `<td>${usuario['status']}</td>`;
        html += `<td class="jv_table-action">
                    <button class="jv_menu-btn" onclick="toggleDropdown(this)">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <form class="jv_dropdown" method="GET" action="">
                        <button type="submit" name="visualizar" value="${usuario['id']}" class="jv_dropdown-item">
                            <i class="fas fa-eye"></i> Visualizar
                        </button>
                        <div class="jv_dropdown-separator"></div>`
        if(usuario['status'] == "ATIVADO"){
            html += `<button type="button" onclick="abrirPopup(\'../../VIEW/pop-up/pop-up_remover.php?id='${usuario['id']},Cadastro de Vendedores)" class="jv_dropdown-item jv_danger">
                <i class="fa-solid fa-ban"></i> Desativar
            </button>
            </form>
        </td>
    </tr>`
            
        }else{html += `<button type="button" onclick="abrirPopup(../../VIEW/pop-up/pop-up_remover.php?id=${usuario['id']},Cadastro de Vendedores)" class="jv_dropdown-item jv_acess">
                <i class="fa-solid fa-power-off"></i> Ativar
            </button>
            </form>
        </td>
    </tr>`
        }
    });

    info_tabela.innerHTML = html;
    
}

GerarTabela();

