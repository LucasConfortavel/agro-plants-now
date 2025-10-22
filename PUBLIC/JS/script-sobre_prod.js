document.addEventListener("DOMContentLoaded", () => {
  // Add smooth scroll animation for page load
  const productContainer = document.querySelector(".gs_product-container")
  if (productContainer) {
    productContainer.style.opacity = "0"
    productContainer.style.transform = "translateY(30px)"

    setTimeout(() => {
      productContainer.style.transition = "all 0.6s ease-out"
      productContainer.style.opacity = "1"
      productContainer.style.transform = "translateY(0)"
    }, 100)
  }

  // Add hover effect to info cards
  const infoCards = document.querySelectorAll(".gs_info-card")
  infoCards.forEach((card, index) => {
    card.style.opacity = "0"
    card.style.transform = "translateY(20px)"

    setTimeout(
      () => {
        card.style.transition = "all 0.4s ease-out"
        card.style.opacity = "1"
        card.style.transform = "translateY(0)"
      },
      200 + index * 100,
    )
  })

  // Add animation to specification items
  const specItems = document.querySelectorAll(".gs_spec-item, .gs_benefit-item, .gs_delivery-item")
  specItems.forEach((item, index) => {
    item.style.opacity = "0"
    item.style.transform = "translateX(-20px)"

    setTimeout(
      () => {
        item.style.transition = "all 0.4s ease-out"
        item.style.opacity = "1"
        item.style.transform = "translateX(0)"
      },
      300 + index * 80,
    )
  })

  // Add ripple effect to buttons
  const buttons = document.querySelectorAll(".ym_btn-primary, .ym_btn-secondary")
  buttons.forEach((button) => {
    button.addEventListener("click", function (e) {
      const ripple = document.createElement("span")
      const rect = this.getBoundingClientRect()
      const size = Math.max(rect.width, rect.height)
      const x = e.clientX - rect.left - size / 2
      const y = e.clientY - rect.top - size / 2

      ripple.style.width = ripple.style.height = size + "px"
      ripple.style.left = x + "px"
      ripple.style.top = y + "px"
      ripple.classList.add("ripple")

      this.appendChild(ripple)

      setTimeout(() => {
        ripple.remove()
      }, 600)
    })
  })

  // Add CSS for ripple effect
  const style = document.createElement("style")
  style.textContent = `
        .ym_btn-primary, .ym_btn-secondary {
            position: relative;
            overflow: hidden;
        }
        
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s ease-out;
            pointer-events: none;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `
  document.head.appendChild(style)
})
