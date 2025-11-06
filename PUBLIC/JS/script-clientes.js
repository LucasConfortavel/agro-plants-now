
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
