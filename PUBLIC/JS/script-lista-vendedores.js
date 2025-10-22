// Esperar o carregamento completo do DOM
document.addEventListener('DOMContentLoaded', function () {
    // Elementos DOM
    const searchInput = document.querySelector('.jv_search-input');
    const selectAllCheckbox = document.getElementById('jv_selectAll');
    const removeSelectedBtn = document.getElementById('jv_removeSelected');
    const selectedCountSpan = document.getElementById('jv_selectedCount');

    // Inicializar array de itens selecionados
    let selectedCustomers = [];

    // --- FUNÇÃO PRINCIPAL PARA CONFIGURAR EVENTOS DAS CHECKBOXES ---
    function setupCustomerCheckboxes() {
        const customerCheckboxes = document.querySelectorAll('.customer-checkbox');

        customerCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                handleCustomerSelect(this.dataset.customerId, this.checked);
            });
        });
    }

    // --- PESQUISA ---
    function handleSearch() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#jv_customerTableBody tr');

        rows.forEach(row => {
            const name = row.querySelector('h4')?.textContent.toLowerCase() || "";
            const email = row.querySelector('p')?.textContent.toLowerCase() || "";

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

    // --- SELECIONAR TODOS ---
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

    // --- MANIPULAR SELEÇÃO INDIVIDUAL ---
    function handleCustomerSelect(customerId, isChecked) {
        if (isChecked) {
            if (!selectedCustomers.includes(customerId)) {
                selectedCustomers.push(customerId);
            }
        } else {
            selectedCustomers = selectedCustomers.filter(id => id !== customerId);
            if (selectAllCheckbox) selectAllCheckbox.checked = false;
        }
        updateSelectedUI();
    }

    // --- ATUALIZAR INTERFACE ---
    function updateSelectedUI() {
        const hasSelected = selectedCustomers.length > 0;

        if (removeSelectedBtn && selectedCountSpan) {
            removeSelectedBtn.style.display = hasSelected ? 'flex' : 'none';
            selectedCountSpan.textContent = selectedCustomers.length;
        }
    }

    // --- REMOVER SELECIONADOS ---
    function handleRemoveSelected() {
        if (selectedCustomers.length > 0) {
            if (confirm(`Tem certeza que deseja remover ${selectedCustomers.length} item(ns)?`)) {
                selectedCustomers.forEach(id => {
                    const checkbox = document.querySelector(`.customer-checkbox[data-customer-id="${id}"]`);
                    if (checkbox) {
                        const row = checkbox.closest('tr');
                        if (row) row.remove();
                    }
                });
                selectedCustomers = [];
                updateSelectedUI();
                updateCustomerCount();
            }
        }
    }

    // --- ATUALIZAR CONTADOR TOTAL ---
    function updateCustomerCount() {
        const customerCountElement = document.getElementById('jv_customerCount');
        if (customerCountElement) {
            const visibleRows = document.querySelectorAll('#jv_customerTableBody tr:not([style*="display: none"])').length;
            customerCountElement.textContent = `${visibleRows} clientes encontrados`;
        }
    }

    // --- CONFIGURAR EVENTOS GERAIS ---
    function setupEventListeners() {
        if (searchInput) searchInput.addEventListener('input', handleSearch);
        if (selectAllCheckbox) selectAllCheckbox.addEventListener('change', handleSelectAll);
        if (removeSelectedBtn) removeSelectedBtn.addEventListener('click', handleRemoveSelected);

        setupCustomerCheckboxes(); // Inicializa checkboxes
    }

    // --- SE A TABELA FOR GERADA NOVAMENTE, RECONFIGURAR OS EVENTOS ---
    window.addEventListener('tabelaAtualizada', setupCustomerCheckboxes);

    // Inicializar tudo
    setupEventListeners();
});


// --- FUNÇÕES DO DROPDOWN ---
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
