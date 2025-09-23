document.addEventListener("DOMContentLoaded", () => {
  const body = document.body;
  const savedTheme = localStorage.getItem("theme") || "dark";

  applyTheme(savedTheme);

  function applyTheme(theme) {
    body.classList.remove("dark-theme", "light-theme");
    body.classList.add(theme === "dark" ? "dark-theme" : "light-theme");
  }
});