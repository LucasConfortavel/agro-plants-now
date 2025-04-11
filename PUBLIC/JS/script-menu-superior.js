document.addEventListener("DOMContentLoaded", () => {
    const hamburgerMenu = document.querySelector(".jp_hamburger-menu")
    const sidebar = document.querySelector(".jp_sidebar")
    const overlay = document.querySelector(".jp_overlay")
    const navLinks = document.querySelectorAll(".jp_nav-links a")
    const loginBtn = document.querySelector(".jp_login-btn")
  
    // Toggle menu when hamburger is clicked
    hamburgerMenu.addEventListener("click", (e) => {
      e.stopPropagation()
      toggleMenu()
    })
  
    // Close menu when overlay is clicked
    overlay.addEventListener("click", () => {
      closeMenu()
    })
  
    // Close menu when a nav link is clicked
    navLinks.forEach((link) => {
      link.addEventListener("click", () => {
        closeMenu()
      })
    })
  
    // Close menu when login button is clicked
    if (loginBtn) {
      loginBtn.addEventListener("click", () => {
        closeMenu()
      })
    }
  
    // Close menu when clicking outside
    document.addEventListener("click", (event) => {
      const isClickInsideSidebar = sidebar.contains(event.target)
      const isClickInsideHamburger = hamburgerMenu.contains(event.target)
  
      if (!isClickInsideSidebar && !isClickInsideHamburger && sidebar.classList.contains("active")) {
        closeMenu()
      }
    })
  
    // Close menu when ESC key is pressed
    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape" && sidebar.classList.contains("active")) {
        closeMenu()
      }
    })
  
    // Helper functions
    function toggleMenu() {
      hamburgerMenu.classList.toggle("active")
      sidebar.classList.toggle("active")
      overlay.classList.toggle("active")
  
      // Prevent body scrolling when menu is open
      if (sidebar.classList.contains("active")) {
        document.body.style.overflow = "hidden"
      } else {
        document.body.style.overflow = ""
      }
    }
  
    function closeMenu() {
      hamburgerMenu.classList.remove("active")
      sidebar.classList.remove("active")
      overlay.classList.remove("active")
      document.body.style.overflow = ""
    }
  })
  
  