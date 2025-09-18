document.addEventListener("DOMContentLoaded", function () {
  const tabButtons = document.querySelectorAll(".po-tab-btn[data-tab]");
  const tabContents = document.querySelectorAll(".tab-content");

  if (!tabButtons.length || !tabContents.length) return;

  function showTab(tabName) {
    tabContents.forEach(c => {
      if (c.id === `${tabName}-tab-content`) {
        c.style.display = "block";
      } else {
        c.style.display = "none";
      }
    });
    
    
    tabButtons.forEach(btn => {
      if (btn.dataset.tab === tabName) {
        btn.classList.add("po-active");
      } else {
        btn.classList.remove("po-active");
      }
    });
  }

  tabButtons.forEach(btn => {
    btn.addEventListener("click", function (evt) {
      if (evt && typeof evt.preventDefault === "function") evt.preventDefault();
      const tab = this.dataset.tab;
      if (!tab) return;
      showTab(tab);
    });
  });

  const initialVisible = Array.from(tabContents).find(c => getComputedStyle(c).display !== "none");
  if (initialVisible) {
    const tabName = initialVisible.id.replace(/-tab-content$/, "");
    showTab(tabName);
  } else {
    showTab("sales");
  }
});