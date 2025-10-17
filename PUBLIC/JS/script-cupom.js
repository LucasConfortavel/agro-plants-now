// Aguardar o carregamento completo do DOM
document.addEventListener('DOMContentLoaded', function() {
  // Elementos DOM
  const searchInput = document.querySelector('.jv_search-input');
  const selectAllCheckbox = document.getElementById('jv_selectAll');
  const customerCheckboxes = document.querySelectorAll('.jv_customer-checkbox');
  const removeSelectedBtn = document.getElementById('jv_removeSelected');
  const selectedCountSpan = document.getElementById('jv_selectedCount');
  
  // Inicializar array de clientes selecionados
  let selectedCustomers = [];
  
  // Adicionar event listeners
  function setupEventListeners() {
      // Pesquisa
      if (searchInput) {
          searchInput.addEventListener('input', handleSearch);
      }
      
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
  
  // Função de pesquisa
  function handleSearch() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('#jv_customerTableBody tr');

    rows.forEach(row => {
        // Obtém a célula da coluna "Código" (segundo <td>)
        const codeCell = row.querySelectorAll('td')[1]; // índice 1 = 2ª coluna

        if (codeCell && codeCell.textContent.toLowerCase().includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';

            // Se o cupom estiver oculto, desmarca a checkbox
            const checkbox = row.querySelector('.customer-checkbox');
            if (checkbox && checkbox.checked) {
                checkbox.checked = false;
                handleCustomerSelect(checkbox.dataset.customerId, false);
            }
        }
    });
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

// Variável global para saber se o menu está aberto
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
