  
//   // DOM Elements
//   const searchInput = document.getElementById('searchInput');
//   const selectAllCheckbox = document.getElementById('selectAll');
//   const customerTableBody = document.getElementById('customerTableBody');
//   const customerCount = document.getElementById('customerCount');
//   const removeSelectedBtn = document.getElementById('removeSelected');
//   const selectedCountSpan = document.getElementById('selectedCount');
//   const emptyState = document.getElementById('emptyState');
//   const dropdownMenu = document.getElementById('dropdownMenu');
  
//   // Initialize
//   document.addEventListener('DOMContentLoaded', function() {
//     setupEventListeners();
//   });
  
//   // Event Listeners
//   function setupEventListeners() {
//     searchInput.addEventListener('input', handleSearch);
//     selectAllCheckbox.addEventListener('change', handleSelectAll);
//     removeSelectedBtn.addEventListener('click', handleRemoveSelected);
    
//     // Close dropdown when clicking outside
//     document.addEventListener('click', function(e) {
//         if (!e.target.closest('.dropdown-menu') && !e.target.closest('.menu-btn')) {
//             hideDropdown();
//         }
//     });
//   }
  
//   // Search functionality
//   function handleSearch() {
//     const searchTerm = searchInput.value.toLowerCase();
//     filteredCustomers = customers.filter(customer => 
//         customer.name.toLowerCase().includes(searchTerm) ||
//         customer.email.toLowerCase().includes(searchTerm)
//     );
    
//     selectedCustomers = [];
//     updateSelectedUI();
//   }
  
//   // Select all functionality
//   function handleSelectAll() {
//     if (selectAllCheckbox.checked) {
//         selectedCustomers = filteredCustomers.map(customer => customer.id);
//     } else {
//         selectedCustomers = [];
//     }
//     updateSelectedUI();
//     updateCheckboxes();
//   }
  
//   // Individual customer selection
//   function handleCustomerSelect(customerId, checked) {
//     if (checked) {
//         selectedCustomers.push(customerId);
//     } else {
//         selectedCustomers = selectedCustomers.filter(id => id !== customerId);
//     }
    
//     updateSelectedUI();
//     updateSelectAllCheckbox();
//   }
  
//   // Remove selected customers
//   function handleRemoveSelected() {
//     if (confirm(`Tem certeza que deseja remover ${selectedCustomers.length} cliente(s)?`)) {
//         // Here you would typically make an API call
//         console.log('Removing customers:', selectedCustomers);
//         selectedCustomers = [];
//         updateSelectedUI();
//     }
//   }
  
//   // Update selected customers UI
//   function updateSelectedUI() {
//     const hasSelected = selectedCustomers.length > 0;
//     removeSelectedBtn.style.display = hasSelected ? 'flex' : 'none';
//     selectedCountSpan.textContent = selectedCustomers.length;
//   }
  
//   // Update select all checkbox state
//   function updateSelectAllCheckbox() {
//     const allSelected = filteredCustomers.length > 0 && selectedCustomers.length === filteredCustomers.length;
//     const someSelected = selectedCustomers.length > 0;
    
//     selectAllCheckbox.checked = allSelected;
//     selectAllCheckbox.indeterminate = someSelected && !allSelected;
//   }
  
//   // Update individual checkboxes
//   function updateCheckboxes() {
//     const checkboxes = document.querySelectorAll('.customer-checkbox');
//     checkboxes.forEach(checkbox => {
//         checkbox.checked = selectedCustomers.includes(checkbox.dataset.customerId);
//     });
//   }
  
// //   // Render table
// //   function renderTable() {
// //     // Update customer count
// //     const count = filteredCustomers.length;
// //     customerCount.textContent = `${count} cliente${count !== 1 ? 's' : ''} encontrado${count !== 1 ? 's' : ''}`;
    
// //     // Show/hide empty state
// //     if (filteredCustomers.length === 0) {
// //         customerTableBody.style.display = 'none';
// //         emptyState.style.display = 'block';
// //         return;
// //     } else {
// //         customerTableBody.style.display = '';
// //         emptyState.style.display = 'none';
// //     }
    
// //     // Render customers
// //     // customerTableBody.innerHTML = filteredCustomers.map((customer, index) => `
// //     //     <tr>
// //     //         <td>
// //     //             <input type="checkbox" class="checkbox customer-checkbox" 
// //     //                    data-customer-id="${customer.id}"
// //     //                    ${selectedCustomers.includes(customer.id) ? 'checked' : ''}>
// //     //         </td>
// //     //         <td>
// //     //             <div class="customer-info">
// //     //                 <div class="avatar">
// //     //                     ${getInitials(customer.name)}
// //     //                 </div>
// //     //                 <div class="customer-details">
// //     //                     <h4>${customer.name}</h4>
// //     //                     <p>${customer.email}</p>
// //     //                 </div>
// //     //             </div>
// //     //         </td>
// //     //         <td>
// //     //             ${getStatusBadge(customer.status)}
// //     //         </td>
// //     //         <td>${formatDate(customer.registrationDate)}</td>
           
// //     //         <td>
// //     //             <button class="menu-btn" onclick="showDropdown(event, '${customer.id}')">
// //     //                 <i class="fas fa-ellipsis-h"></i>
// //     //             </button>
// //     //         </td>
// //     //     </tr>
// //     // `).join('');
    
// //     // Add event listeners to checkboxes
// //     document.querySelectorAll('.customer-checkbox').forEach(checkbox => {
// //         checkbox.addEventListener('change', function() {
// //             handleCustomerSelect(this.dataset.customerId, this.checked);
// //         });
// //     });
    
// //     updateSelectAllCheckbox();
// //   }
  
//   // Utility functions
//   function getInitials(name) {
//     return name.split(' ').map(n => n[0]).join('').toUpperCase();
//   }
  
//   function getStatusBadge(status) {
//     const statusConfig = {
//         active: { label: "Ativo", class: "badge-active" },
//         inactive: { label: "Inativo", class: "badge-inactive" },
//         pending: { label: "Pendente", class: "badge-pending" },
//     };
    
//     const config = statusConfig[status];
//     return `<span class="badge ${config.class}">${config.label}</span>`;
//   }
  
//   function formatCurrency(value) {
//     return new Intl.NumberFormat("pt-BR", {
//         style: "currency",
//         currency: "BRL",
//     }).format(value);
//   }
  
//   function formatDate(dateString) {
//     return new Date(dateString).toLocaleDateString("pt-BR");
//   }
  
//   // Dropdown functionality
//   function showDropdown(event, customerId) {
//     event.stopPropagation();
    
//     const rect = event.target.getBoundingClientRect();
//     dropdownMenu.style.display = 'block';
//     dropdownMenu.style.left = (rect.left - 150) + 'px';
//     dropdownMenu.style.top = (rect.bottom + 5) + 'px';
    
//     // Add click handlers to dropdown items
//     dropdownMenu.querySelectorAll('.dropdown-item').forEach(item => {
//         item.onclick = function() {
//             handleDropdownAction(item.dataset.action, customerId);
//             hideDropdown();
//         };
//     });
//   }
  
//   function hideDropdown() {
//     dropdownMenu.style.display = 'none';
//   }
  
//   function handleDropdownAction(action, customerId) {
//     const customer = customers.find(c => c.id === customerId);
    
//     switch(action) {
//         case 'view':
//             console.log('Visualizar cliente:', customer);
//             alert(`Visualizando detalhes de ${customer.name}`);
//             break;
//         case 'edit':
//             console.log('Editar cliente:', customer);
//             alert(`Editando ${customer.name}`);
//             break;
//         case 'delete':
//             if (confirm(`Tem certeza que deseja remover ${customer.name}?`)) {
//                 console.log('Remover cliente:', customer);
//                 alert(`${customer.name} foi removido`);
//             }
//             break;
//     }
//   }


// Variáveis de paginação
let currentPage = 1;
const totalPages = 3;

// DOM Elements
const searchInput = document.getElementById('searchInput');
const selectAllCheckbox = document.getElementById('selectAll');
const customerTableBody = document.getElementById('customerTableBody');
const customerCount = document.getElementById('customerCount');
const removeSelectedBtn = document.getElementById('removeSelected');
const selectedCountSpan = document.getElementById('selectedCount');
const emptyState = document.getElementById('emptyState');
const dropdownMenu = document.getElementById('dropdownMenu');
const pageNumbers = document.querySelectorAll('.jp_page-number');
const pageArrow = document.querySelector('.jp_page-arrow');

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    setupEventListeners();
    setupPagination();
});

// Event Listeners
function setupEventListeners() {
    searchInput.addEventListener('input', handleSearch);
    selectAllCheckbox.addEventListener('change', handleSelectAll);
    removeSelectedBtn.addEventListener('click', handleRemoveSelected);
    
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown-menu') && !e.target.closest('.menu-btn')) {
            hideDropdown();
        }
    });
}

// Funções de Paginação
function setupPagination() {
    pageNumbers.forEach((btn, index) => {
        btn.addEventListener('click', () => goToPage(index + 1));
    });
    pageArrow.addEventListener('click', nextPage);
}

function goToPage(page) {
    if (page >= 1 && page <= totalPages && page !== currentPage) {
        currentPage = page;
        updatePagination();
        loadPageData();
    }
}

function nextPage() {
    if (currentPage < totalPages) {
        goToPage(currentPage + 1);
    }
}

function updatePagination() {
    pageNumbers.forEach((btn, index) => {
        btn.classList.remove('active');
        if (index + 1 === currentPage) {
            btn.classList.add('active');
        }
    });
}

function loadPageData() {
    console.log(`Carregando página ${currentPage}`);
    // Implemente sua lógica de carregamento aqui:
    // - Pode ser um fetch() para API
    // - Ou filtragem de um array local
}

// Restante das suas funções originais (mantidas intactas)
function handleSearch() {
    const searchTerm = searchInput.value.toLowerCase();
    filteredCustomers = customers.filter(customer => 
        customer.name.toLowerCase().includes(searchTerm) ||
        customer.email.toLowerCase().includes(searchTerm)
    );
    selectedCustomers = [];
    updateSelectedUI();
}

function handleSelectAll() {
    if (selectAllCheckbox.checked) {
        selectedCustomers = filteredCustomers.map(customer => customer.id);
    } else {
        selectedCustomers = [];
    }
    updateSelectedUI();
    updateCheckboxes();
}

function handleCustomerSelect(customerId, checked) {
    if (checked) {
        selectedCustomers.push(customerId);
    } else {
        selectedCustomers = selectedCustomers.filter(id => id !== customerId);
    }
    updateSelectedUI();
    updateSelectAllCheckbox();
}

function handleRemoveSelected() {
    if (confirm(`Tem certeza que deseja remover ${selectedCustomers.length} cliente(s)?`)) {
        console.log('Removing customers:', selectedCustomers);
        selectedCustomers = [];
        updateSelectedUI();
    }
}

function updateSelectedUI() {
    const hasSelected = selectedCustomers.length > 0;
    removeSelectedBtn.style.display = hasSelected ? 'flex' : 'none';
    selectedCountSpan.textContent = selectedCustomers.length;
}

function updateSelectAllCheckbox() {
    const allSelected = filteredCustomers.length > 0 && selectedCustomers.length === filteredCustomers.length;
    const someSelected = selectedCustomers.length > 0;
    selectAllCheckbox.checked = allSelected;
    selectAllCheckbox.indeterminate = someSelected && !allSelected;
}

function updateCheckboxes() {
    const checkboxes = document.querySelectorAll('.customer-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectedCustomers.includes(checkbox.dataset.customerId);
    });
}

function getInitials(name) {
    return name.split(' ').map(n => n[0]).join('').toUpperCase();
}

function getStatusBadge(status) {
    const statusConfig = {
        active: { label: "Ativo", class: "badge-active" },
        inactive: { label: "Inativo", class: "badge-inactive" },
        pending: { label: "Pendente", class: "badge-pending" },
    };
    const config = statusConfig[status];
    return `<span class="badge ${config.class}">${config.label}</span>`;
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

function showDropdown(event, customerId) {
    event.stopPropagation();
    const rect = event.target.getBoundingClientRect();
    dropdownMenu.style.display = 'block';
    dropdownMenu.style.left = (rect.left - 150) + 'px';
    dropdownMenu.style.top = (rect.bottom + 5) + 'px';
    
    dropdownMenu.querySelectorAll('.dropdown-item').forEach(item => {
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