const customers = [
    { id: "1", name: "Paulo Rojas", email: "paulo.rojas@email.com", registrationDate: "2024-08-16", totalSpent: 1250.0, status: "active" },
    { id: "2", name: "Maria Silva", email: "maria.silva@email.com", registrationDate: "2024-07-22", totalSpent: 3200.0, status: "active" },
    { id: "3", name: "João Santos", email: "joao.santos@email.com", registrationDate: "2024-06-10", totalSpent: 450.0, status: "pending" },
    { id: "4", name: "Ana Costa", email: "ana.costa@email.com", registrationDate: "2024-05-15", totalSpent: 5600.0, status: "active" },
    { id: "5", name: "Carlos Oliveira", email: "carlos.oliveira@email.com", registrationDate: "2024-04-03", totalSpent: 0, status: "inactive" },
  ];
  
  let filteredCustomers = [...customers];
  let currentOpenDropdown = null;
  
  // DOM Elements
  const searchInput = document.getElementById("searchInput");
  const customerTableBody = document.getElementById("customerTableBody");
  const customerCount = document.getElementById("customerCount");
  const emptyState = document.getElementById("emptyState");
  const dropdownMenu = document.getElementById("dropdownMenu");
  
  // Initialize
  document.addEventListener("DOMContentLoaded", () => {
    renderTable();
    setupEventListeners();
  });
  
  function setupEventListeners() {
    searchInput.addEventListener("input", handleSearch);
  
    // Fecha dropdown ao clicar fora
    document.addEventListener("click", (e) => {
      if (!e.target.closest(".dropdown-menu") && !e.target.closest(".menu-btn")) {
        hideDropdown();
      }
    });
  }
  
  // Busca
  function handleSearch() {
    const searchTerm = searchInput.value.toLowerCase();
    filteredCustomers = customers.filter(
      (customer) =>
        customer.name.toLowerCase().includes(searchTerm) ||
        customer.email.toLowerCase().includes(searchTerm)
    );
  
    renderTable();
  }
  
  // Renderiza tabela
  function renderTable() {
    const count = filteredCustomers.length;
    customerCount.textContent = `${count} cliente${count !== 1 ? "s" : ""} encontrado${count !== 1 ? "s" : ""}`;
  
    if (filteredCustomers.length === 0) {
      customerTableBody.style.display = "none";
      emptyState.style.display = "block";
      return;
    } else {
      customerTableBody.style.display = "";
      emptyState.style.display = "none";
    }
  
    customerTableBody.innerHTML = filteredCustomers
      .map(
        (customer) => `
        <tr>
            <td>
                <div class="customer-info">
                    <div class="avatar">${getInitials(customer.name)}</div>
                    <div class="customer-details">
                        <h4>${customer.name}</h4>
                        <p>${customer.email}</p>
                    </div>
                </div>
            </td>
            <td>${getStatusBadge(customer.status)}</td>
            <td>${formatDate(customer.registrationDate)}</td>
            <td><span class="amount">${formatCurrency(customer.totalSpent)}</span></td> 
            <td>
                <button class="menu-btn" onclick="showDropdown(event, '${customer.id}')">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
            </td>
        </tr>
      `
      )
      .join("");
  }
  
  // Utilitários
  function getInitials(name) {
    return name
      .split(" ")
      .map((n) => n[0])
      .join("")
      .toUpperCase();
  }
  
  function getStatusBadge(status) {
    const statusConfig = {
      active: { label: "Ativo", class: "badge-active" },
      inactive: { label: "Inativo", class: "badge-inactive" },
      pending: { label: "Pendente", class: "badge-pending" },
    };
  
    const config = statusConfig[status] || { label: "Desconhecido", class: "" };
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
  
  // Dropdown
  function showDropdown(event, customerId) {
    event.stopPropagation();
  
    if (currentOpenDropdown === customerId && dropdownMenu.style.display === "block") {
      hideDropdown();
      return;
    }
  
    const rect = event.target.getBoundingClientRect();
    dropdownMenu.style.display = "block";
    dropdownMenu.style.left = rect.left - 150 + "px";
    dropdownMenu.style.top = rect.bottom + window.scrollY + 5 + "px";
  
    currentOpenDropdown = customerId;
  
    dropdownMenu.querySelectorAll(".dropdown-item").forEach((item) => {
      item.onclick = () => {
        handleDropdownAction(item.dataset.action, customerId);
        hideDropdown();
      };
    });
  }
  
  function hideDropdown() {
    dropdownMenu.style.display = "none";
    currentOpenDropdown = null;
  }
  
  function handleDropdownAction(action, customerId) {
    const customer = customers.find((c) => c.id === customerId);
  
    switch (action) {
      case "view":
        alert(`Visualizando detalhes de ${customer.name}`);
        break;
      case "edit":
        alert(`Editando ${customer.name}`);
        break;
      case "delete":
        if (confirm(`Tem certeza que deseja remover ${customer.name}?`)) {
          alert(`${customer.name} foi removido`);
        }
        break;
    }
  }
  