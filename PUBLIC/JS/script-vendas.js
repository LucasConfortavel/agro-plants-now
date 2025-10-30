document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.jv_search-input');
    const selectAllCheckbox = document.getElementById('jv_selectAll');
    const customerCheckboxes = document.querySelectorAll('.customer-checkbox');
    const removeSelectedBtn = document.getElementById('jv_removeSelected');
    const selectedCountSpan = document.getElementById('jv_selectedCount');
    
    let selectedCustomers = [];
    
    function setupEventListeners() {
        
        // Selecionar todos
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', handleSelectAll);
        }
        
        // Checkboxes individuais
        customerCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                handleCustomerSelect(this.dataset.customerId, this.checked);
            });
        });
        
        // Botão remover selecionados
        if (removeSelectedBtn) {
            removeSelectedBtn.addEventListener('click', handleRemoveSelected);
        }
    }
    
    // Selecionar todos os clientes
    function handleSelectAll() {
        const isChecked = this.checked;
        const visibleRows = document.querySelectorAll('#jv_customerTableBody tr:not([style*="display: none"])');
        
        visibleRows.forEach(row => {
            const checkbox = row.querySelector('.customer-checkbox');
            if (checkbox) {
                checkbox.checked = isChecked;
                handleCustomerSelect(checkbox.dataset.customerId, isChecked);
            }
        });
    }
    
    // Manipular seleção individual de clientes
    function handleCustomerSelect(customerId, isChecked) {
        if (isChecked) {
            // Adicionar ao array se não existir
            if (!selectedCustomers.includes(customerId)) {
                selectedCustomers.push(customerId);
            }
        } else {
            // Remover do array
            selectedCustomers = selectedCustomers.filter(id => id !== customerId);
            // Desselecionar checkbox "Selecionar todos"
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = false;
            }
        }
        
        // Atualizar UI
        updateSelectedUI();
    }
    
    // Atualizar interface com base nos selecionados
    function updateSelectedUI() {
        if (removeSelectedBtn && selectedCountSpan) {
            const hasSelected = selectedCustomers.length > 0;
            
            // Mostrar/ocultar botão de remover
            removeSelectedBtn.style.display = hasSelected ? 'flex' : 'none';
            
            // Atualizar contador
            selectedCountSpan.textContent = selectedCustomers.length;
        }
    }
    
    // Remover clientes selecionados
    function handleRemoveSelected() {
        if (selectedCustomers.length > 0) {
            if (confirm(`Tem certeza que deseja remover ${selectedCustomers.length} cliente(s)?`)) {
                // Simular remoção (substituir por chamada AJAX em produção)
                selectedCustomers.forEach(id => {
                    const checkbox = document.querySelector(`.customer-checkbox[data-customer-id="${id}"]`);
                    if (checkbox) {
                        const row = checkbox.closest('tr');
                        if (row) {
                            row.remove();
                        }
                    }
                });
                
                // Limpar seleção
                selectedCustomers = [];
                updateSelectedUI();
                
                // Atualizar contador total de clientes
                updateCustomerCount();
            }
        }
    }
    
    // Atualizar contador total de clientes
    function updateCustomerCount() {
        const customerCountElement = document.getElementById('jv_customerCount');
        if (customerCountElement) {
            const visibleRows = document.querySelectorAll('#jv_customerTableBody tr:not([style*="display: none"])').length;
            customerCountElement.textContent = `${visibleRows} clientes encontrados`;
        }
    }
    
    // Inicializar
    setupEventListeners();
  });
  
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
    if(pagina != total_pag & total_pag > 1){
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
                    <div class="jv_avatar">
                        ${venda['nome_vendedor'].substring(0, 2).toUpperCase()}
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
                        <form class="jv_dropdown">
                            <button class="jv_dropdown-item" type="submit" name="visualizar" value="<?= htmlspecialchars($venda['id'])?>">
                                <i class="fas fa-eye"></i> Visualizar
                            </button>
                            <div class="jv_dropdown-separator"></div>
                            <button type="button" 
                                class="jv_dropdown-item jv_danger" 
                                onclick="abrirPopup('../../VIEW/pop-up/pop-up_remover.php?id=<?= htmlspecialchars($cliente['id']) ?>', 'Confirmação de Remoção')">
                                <i class="fas fa-trash"></i> Remover
                            </button>
                        </form>
                    </td>
                </tr>`;
        }else if(window.location.href.includes("Rel")){
            html += `<tr><td>${formatarData(venda['data_venda'])}</td>`
            html +=`
            <td>
                <div class="jv_customer-info">
                    <div class="jv_avatar">
                        ${venda['nome_vendedor'].substring(0, 2).toUpperCase()}
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
        if (dado["nome_vendedor"].toLowerCase().includes(pesquisa.toLowerCase()) || dado["nome_cliente"].toLowerCase().includes(pesquisa.toLowerCase())) {
            dados_filtrado.push(dado);
        }
    });


    area_pags = document.getElementsByClassName('jv_page-navigation')[0];
    area_pags.innerHTML="";
    
    dados_filtrado.forEach(venda => {
        if (window.location.href.includes("vendas")) {
            
            html += `<tr><td><input type="checkbox" class="jv_checkbox customer-checkbox" data-customer-id="<?= $venda['id'] ?>"></td>`
            html +=`
            <td>
                <div class="jv_customer-info">
                    <div class="jv_avatar">
                        ${venda['nome_vendedor'].substring(0, 2).toUpperCase()}
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
                        <form class="jv_dropdown">
                            <button class="jv_dropdown-item" type="submit" name="visualizar" value="<?= htmlspecialchars($venda['id'])?>">
                                <i class="fas fa-eye"></i> Visualizar
                            </button>
                            <div class="jv_dropdown-separator"></div>
                            <button type="button" 
                                class="jv_dropdown-item jv_danger" 
                                onclick="abrirPopup('../../VIEW/pop-up/pop-up_remover.php?id=<?= htmlspecialchars($cliente['id']) ?>', 'Confirmação de Remoção')">
                                <i class="fas fa-trash"></i> Remover
                            </button>
                        </form>
                    </td>
                </tr>`;
        }else if(window.location.href.includes("Rel")){
            html += `<tr><td>${formatarData(venda['data_venda'])}</td>`
            html +=`
            <td>
                <div class="jv_customer-info">
                    <div class="jv_avatar">
                        ${venda['nome_vendedor'].substring(0, 2).toUpperCase()}
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
                         <form class="jv_dropdown">
                            <button class="jv_dropdown-item" type="submit" name="visualizar" value="<?= htmlspecialchars($venda['id'])?>">
                                <i class="fas fa-eye"></i> Visualizar
                            </button>
                            <div class="jv_dropdown-separator"></div>
                            <button type="button" 
                                class="jv_dropdown-item jv_danger" 
                                onclick="abrirPopup('../../VIEW/pop-up/pop-up_remover.php?id=<?= htmlspecialchars($cliente['id']) ?>', 'Confirmação de Remoção')">
                                <i class="fas fa-trash"></i> Remover
                            </button>
                        </form>
                    </td>
                </tr>`;
        }
    });

    info_tabela.innerHTML = html;
    
}

GerarTabela();