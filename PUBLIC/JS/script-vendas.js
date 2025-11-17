function toggleDropdown(btn) {
  const dropdown = btn.nextElementSibling;
  const isVisible = dropdown.style.display === "block";

  // Fecha todos os outros dropdowns
  document.querySelectorAll(".jv_dropdown").forEach(d => d.style.display = "none");

  // Abre apenas o clicado
  if (!isVisible) {
    dropdown.style.display = "block";
  }
}

// Fecha dropdowns ao clicar fora
document.addEventListener("click", e => {
  if (!e.target.closest(".jv_menu-btn") && !e.target.closest(".jv_dropdown")) {
    document.querySelectorAll(".jv_dropdown").forEach(d => d.style.display = "none");
  }
});

const formatarData = (dataStr) => {
  const [ano, mes, diaHora] = dataStr.split('-');
  const dia = diaHora.split(' ')[0];
  return `${dia.padStart(2, '0')}/${mes.padStart(2, '0')}/${ano}`;
};

function GerarTabela() {
  const tabela = document.getElementById("jv_customerTableBody");
  let html = "";

  const limite = 4;
  const url = new URLSearchParams(window.location.search);
  const pagina = url.has('pagina') ? parseInt(url.get('pagina'), 10) : 1;

  const total_pag = Math.ceil(dados.length / limite);
  const area_pags = document.getElementsByClassName('jv_page-navigation')[0];

  // === PAGINAÇÃO ===
  if (pagina !== 1) {
    html += ` <a href="?pagina=${pagina - 1}" class="jv_page-arrow"><i class="fas fa-arrow-left"></i></a>`;
  }

  for (let i = 1; i <= total_pag; i++) {
    if (i === pagina) {
      html += `<a href='?pagina=${i}' class='jv_page-number active'>${i}</a>`;
    } else {
      html += `<a href='?pagina=${i}' class='jv_page-number'>${i}</a>`;
    }
  }

  if (pagina !== total_pag && total_pag > 1) {
    html += ` <a href="?pagina=${pagina + 1}" class="jv_page-arrow"><i class="fas fa-arrow-right"></i></a>`;
  }

  area_pags.innerHTML = html;
  html = "";

  // === DADOS EXIBIDOS NESTA PÁGINA ===
  const vendas = dados.slice((pagina - 1) * limite, pagina * limite);

  // === GERAR TABELA ===
  if(vendas.length > 0){
    vendas.forEach(venda => {
      if (window.location.href.includes("vendas")) {
        html += `
          <tr>
            <td>
              <div class="jv_customer-info">
                <div class="jv_customer-details">
                  <h4>${venda['nome_vendedor']}</h4>
                  <p>${venda['email_vendedor']}</p>
                </div>
              </div>
            </td>
            <td>${venda['nome_cliente']}</td>
            <td>R$ ${venda['total']}</td>
            <td class="jv_table-action">
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
      } else if (window.location.href.includes("Rel")) {
        html += `<tr><td>${formatarData(venda['data_venda'])}</td>`;
        html += `
          <td>
            <div class="jv_customer-info">
              <div class="jv_customer-details">
                <h4>${venda['nome_vendedor']}</h4>
                <p>${venda['email_vendedor']}</p>
              </div>
            </div>
          </td>
          <td>${venda['nome_cliente']}</td>
          <td>R$ ${venda['total']}</td>
        </tr>`;
      }
    });
  }else{
    html += '<tr><td class="ym_td" colspan="6">Nenhuma venda encontrada</td></tr>';
  }

  tabela.innerHTML = html;

  // === CONTADOR SOMENTE TOTAL DE VENDAS ===
  const contador = document.getElementById("jv_customerCount");
  contador.textContent = `Total de vendas: ${dados.length}`;
}

function Pesquisar() {
  const inputPesquisa = document.getElementById("jv_searchInput");
  const pesquisa = inputPesquisa.value.trim();
  const info_tabela = document.getElementById("jv_customerTableBody");
  const area_pags = document.getElementsByClassName('jv_page-navigation')[0];

  if (pesquisa === "") {
    GerarTabela();
    return;
  }

  info_tabela.innerHTML = '';
  let html = "";
  const dados_filtrado = dados.filter(dado =>
    dado["nome_vendedor"].toLowerCase().includes(pesquisa.toLowerCase()) ||
    dado["nome_cliente"].toLowerCase().includes(pesquisa.toLowerCase())
  );

  area_pags.innerHTML = "";

  if(dados_filtrado.length > 0){
    dados_filtrado.forEach(venda => {
      if (window.location.href.includes("vendas")) {
        html += `
          <tr>
            <td>
              <div class="jv_customer-info">
                <div class="jv_customer-details">
                  <h4>${venda['nome_vendedor']}</h4>
                  <p>${venda['email_vendedor']}</p>
                </div>
              </div>
            </td>
            <td>${venda['nome_cliente']}</td>
            <td>R$ ${venda['total']}</td>
            <td class="jv_table-action">
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
      } else if (window.location.href.includes("Rel")) {
        html += `<tr><td>${formatarData(venda['data_venda'])}</td>`;
        html += `
          <td>
            <div class="jv_customer-info">
              <div class="jv_customer-details">
                <h4>${venda['nome_vendedor']}</h4>
                <p>${venda['email_vendedor']}</p>
              </div>
            </div>
          </td>
          <td>${venda['nome_cliente']}</td>
          <td>R$ ${venda['total']}</td>
        </tr>`;
      }
    });
  }else{
        html += '<tr><td class="ym_td" colspan="6">Nenhuma venda encontrada</td></tr>';
    }
  info_tabela.innerHTML = html;

  // === CONTADOR SOMENTE TOTAL DE VENDAS FILTRADAS ===
  const contador = document.getElementById("jv_customerCount");
  contador.textContent = ` ${dados_filtrado.length} vendas encotradas`
}

GerarTabela();

    