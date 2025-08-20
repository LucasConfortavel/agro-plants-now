// Aguardar o carregamento completo do DOM
document.addEventListener('DOMContentLoaded', function() {
  // Elementos DOM
  const searchInput = document.querySelector('.jv_search-input');
  const selectAllCheckbox = document.getElementById('selectAll');
  const customerCheckboxes = document.querySelectorAll('.customer-checkbox');
  const removeSelectedBtn = document.getElementById('removeSelected');
  const selectedCountSpan = document.getElementById('selectedCount');
  
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
      const rows = document.querySelectorAll('#customerTableBody tr');
      
      rows.forEach(row => {
          const name = row.querySelector('h4').textContent.toLowerCase();
          const email = row.querySelector('p').textContent.toLowerCase();
          
          if (name.includes(searchTerm) || email.includes(searchTerm)) {
              row.style.display = '';
          } else {
              row.style.display = 'none';
              // Desselecionar se estiver oculto
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
      const visibleRows = document.querySelectorAll('#customerTableBody tr:not([style*="display: none"])');
      
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
      const customerCountElement = document.getElementById('customerCount');
      if (customerCountElement) {
          const visibleRows = document.querySelectorAll('#customerTableBody tr:not([style*="display: none"])').length;
          customerCountElement.textContent = `${visibleRows} clientes encontrados`;
      }
  }
  
  // Inicializar
  setupEventListeners();
});

// Funções do dropdown (mantidas do código original)
function showDropdown(event, customerId) {
  event.stopPropagation();
  
  // Esconder qualquer dropdown aberto
  hideDropdown();
  
  const rect = event.target.closest('.jv_menu-btn').getBoundingClientRect();
  const dropdownMenu = document.getElementById('dropdownMenu');
  
  if (dropdownMenu) {
      dropdownMenu.style.display = 'block';
      dropdownMenu.style.left = (rect.left - 150) + 'px';
      dropdownMenu.style.top = (rect.bottom + 5) + 'px';
      
      // Add click handlers to dropdown items
      dropdownMenu.querySelectorAll('.jv_dropdown-item').forEach(item => {
          item.onclick = function() {
              handleDropdownAction(item.dataset.action, customerId);
              hideDropdown();
          };
      });
  }
}

function hideDropdown() {
  const dropdownMenu = document.getElementById('dropdownMenu');
  if (dropdownMenu) {
      dropdownMenu.style.display = 'none';
  }
}

function handleDropdownAction(action, customerId) {
  const checkbox = document.querySelector(`.customer-checkbox[data-customer-id="${customerId}"]`);
  if (!checkbox) return;
  
  const row = checkbox.closest('tr');
  const customerName = row.querySelector('h4').textContent;
  
  switch(action) {
      case 'view':
          alert(`Visualizando detalhes de ${customerName}`);
          break;
      case 'edit':
          alert(`Editando ${customerName}`);
          break;
      case 'delete':
          if (confirm(`Tem certeza que deseja remover ${customerName}?`)) {
              row.remove();
              updateCustomerCount();
              alert(`${customerName} foi removido`);
          }
          break;
  }
}

// Função para atualizar contador de clientes (também usada pelo dropdown)
function updateCustomerCount() {
  const customerCountElement = document.getElementById('customerCount');
  if (customerCountElement) {
      const visibleRows = document.querySelectorAll('#customerTableBody tr:not([style*="display: none"])').length;
      customerCountElement.textContent = `${visibleRows} clientes encontrados`;
  }
}
