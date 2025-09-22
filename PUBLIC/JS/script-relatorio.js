document.addEventListener("DOMContentLoaded", () => {
  const tabButtons = document.querySelectorAll(".po-tab-btn[data-tab]");
  const tabContents = document.querySelectorAll(".tab-content");

  function showTab(tabName) {
    tabContents.forEach(c => {
      c.style.display = (c.id === `${tabName}-tab-content`) ? "block" : "none";
    });

    tabButtons.forEach(btn => {
      btn.classList.toggle("po-active", btn.dataset.tab === tabName);
    });
  }

  tabButtons.forEach(btn => {
    btn.addEventListener("click", e => {
      e.preventDefault();
      showTab(btn.dataset.tab);
    });
  });

  showTab("sales");
});