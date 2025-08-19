  // DOM Elements
  const searchInput = document.getElementById('searchInput');
  const selectAllCheckbox = document.getElementById('selectAll');
  const customerTableBody = document.getElementById('customerTableBody');
  const customerCount = document.getElementById('customerCount');
  const removeSelectedBtn = document.getElementById('removeSelected');
  const selectedCountSpan = document.getElementById('selectedCount');
  const emptyState = document.getElementById('emptyState');
  const dropdownMenu = document.getElementById('dropdownMenu');
  
  // Event Listeners
  function setupEventListeners() {
    searchInput.addEventListener('input', handleSearch);
    selectAllCheckbox.addEventListener('change', handleSelectAll);
    removeSelectedBtn.addEventListener('click', handleRemoveSelected);
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.jv_dropdown-menu') && !e.target.closest('.jv_menu-btn')) {
            hideDropdown();
        }
    });
  }
  
  // Update selected customers UI
  function updateSelectedUI() {
    const hasSelected = selectedCustomers.length > 0;
    removeSelectedBtn.style.display = hasSelected ? 'flex' : 'none';
    selectedCountSpan.textContent = selectedCustomers.length;
  }
  
  // Update select all checkbox state
  function updateSelectAllCheckbox() {
    const allSelected = filteredCustomers.length > 0 && selectedCustomers.length === filteredCustomers.length;
    const someSelected = selectedCustomers.length > 0;
    
    selectAllCheckbox.checked = allSelected;
    selectAllCheckbox.indeterminate = someSelected && !allSelected;
  }
  
  // Update individual checkboxes
  function updateCheckboxes() {
    const checkboxes = document.querySelectorAll('.jv_customer-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectedCustomers.includes(checkbox.dataset.customerId);
    });
  }
  
  // Utility functions
  function getInitials(name) {
    return name.split(' ').map(n => n[0]).join('').toUpperCase();
  }
  
  function getStatusBadge(status) {
    const statusConfig = {
        active: { label: "Ativo", class: "jv_badge-active" },
        inactive: { label: "Inativo", class: "jv_badge-inactive" },
        pending: { label: "Pendente", class: "jv_badge-pending" },
    };
    
    const config = statusConfig[status];
    return `<span class="jv_badge ${config.class}">${config.label}</span>`;
  }
  
  function formatCurrency(value) {
    return new Intl.NumberFormat("pt-BR", {
        style: "currency",
        currency: "BRL",
    }).format(value);
  }
  
  function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString("pt-BR");
  }
  
  // Dropdown functionality
  function showDropdown(event, customerId) {
    // event.stopPropagation();
    
    const rect = event.target.getBoundingClientRect();
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
  
  function hideDropdown() {
    dropdownMenu.style.display = 'none';
  }
  
  function handleDropdownAction(action, customerId) {
    const customer = customers.find(c => c.id === customerId);
    
    switch(action) {
        case 'view':
            console.log('Visualizar cliente:', customer);
            alert(`Visualizando detalhes de ${customer.name}`);
            break;
        case 'edit':
            console.log('Editar cliente:', customer);
            alert(`Editando ${customer.name}`);
            break;
        case 'delete':
            if (confirm(`Tem certeza que deseja remover ${customer.name}?`)) {
                console.log('Remover cliente:', customer);
                alert(`${customer.name} foi removido`);
            }
            break;
    }
  }