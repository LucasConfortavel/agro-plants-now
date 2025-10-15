document.addEventListener('DOMContentLoaded', function() {
  // Elementos DOM
  const searchInput = document.querySelector('.jv_search-input');
  const selectAllCheckbox = document.getElementById('jv_selectAll');
  const customerCheckboxes = document.querySelectorAll('.customer-checkbox');
  const removeSelectedBtn = document.getElementById('jv_removeSelected');
  const selectedCountSpan = document.getElementById('jv_selectedCount');
  
  let selectedCustomers = [];

  function setupEventListeners() {
      if (searchInput) {
          searchInput.addEventListener('input', handleSearch);
      }
      
      if (selectAllCheckbox) {
          selectAllCheckbox.addEventListener('change', handleSelectAll);
      }
      
      customerCheckboxes.forEach(checkbox => {
          checkbox.addEventListener('change', function() {
              handleCustomerSelect(this.dataset.customerId, this.checked);
          });
      });
      
      if (removeSelectedBtn) {
          removeSelectedBtn.addEventListener('click', handleRemoveSelected);
      }
  }

  function handleSearch() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('#jv_customerTableBody tr');

    rows.forEach(row => {
        const codeCell = row.querySelectorAll('td')[1];

        if (codeCell && codeCell.textContent.toLowerCase().includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
            const checkbox = row.querySelector('.customer-checkbox');
            if (checkbox && checkbox.checked) {
                checkbox.checked = false;
                handleCustomerSelect(checkbox.dataset.customerId, false);
            }
        }
    });
  }

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

  function handleCustomerSelect(customerId, isChecked) {
      if (isChecked) {
          if (!selectedCustomers.includes(customerId)) {
              selectedCustomers.push(customerId);
          }
      } else {
          selectedCustomers = selectedCustomers.filter(id => id !== customerId);
          if (selectAllCheckbox) {
              selectAllCheckbox.checked = false;
          }
      }
      updateSelectedUI();
  }

  function updateSelectedUI() {
      if (removeSelectedBtn && selectedCountSpan) {
          const hasSelected = selectedCustomers.length > 0;
          removeSelectedBtn.style.display = hasSelected ? 'flex' : 'none';
          selectedCountSpan.textContent = selectedCustomers.length;
      }

      const visibleCheckboxes = document.querySelectorAll('#jv_customerTableBody tr:not([style*="display: none"]) .customer-checkbox');
      const allChecked = visibleCheckboxes.length > 0 && [...visibleCheckboxes].every(cb => cb.checked);
      selectAllCheckbox.checked = allChecked;
  }

  function handleRemoveSelected() {
      if (selectedCustomers.length > 0) {
          if (confirm(`Tem certeza que deseja remover ${selectedCustomers.length} cliente(s)?`)) {
              selectedCustomers.forEach(id => {
                  const checkbox = document.querySelector(`.customer-checkbox[data-customer-id="${id}"]`);
                  if (checkbox) {
                      const row = checkbox.closest('tr');
                      if (row) {
                          row.remove();
                      }
                  }
              });
              selectedCustomers = [];
              updateSelectedUI();
              updateCustomerCount();
          }
      }
  }

  function updateCustomerCount() {
      const customerCountElement = document.getElementById('jv_customerCount');
      if (customerCountElement) {
          const visibleRows = document.querySelectorAll('#jv_customerTableBody tr:not([style*="display: none"])').length;
          customerCountElement.textContent = `${visibleRows} clientes encontrados`;
      }
  }

  setupEventListeners();
});
