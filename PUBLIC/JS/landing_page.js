// Funcionalidade do carrossel
let currentPosition = 0
const cardWidth = 380 // 350px + 30px gap

function moveCarousel(direction) {
  const carousel = document.getElementById("carouselContent")
  const cards = carousel.querySelectorAll(".product-card")
  const maxPosition = -(cards.length - 3) * cardWidth // Mostra 3 cards por vez

  currentPosition += direction * cardWidth

  // Limites do carrossel
  if (currentPosition > 0) {
    currentPosition = 0
  } else if (currentPosition < maxPosition) {
    currentPosition = maxPosition
  }

  carousel.style.transform = `translateX(${currentPosition}px)`
}

// Auto-scroll do carrossel (opcional)
function autoScroll() {
  const carousel = document.getElementById("carouselContent")
  const cards = carousel.querySelectorAll(".product-card")

  if (currentPosition <= -(cards.length - 3) * cardWidth) {
    currentPosition = 0
  } else {
    currentPosition -= cardWidth
  }

  carousel.style.transform = `translateX(${currentPosition}px)`
}

// Inicializar auto-scroll (descomente se quiser)
// setInterval(autoScroll, 5000);

// Funcionalidade para dispositivos móveis - scroll por toque
let isDown = false
let startX
let scrollLeft

document.addEventListener("DOMContentLoaded", () => {
  const carousel = document.getElementById("carouselContent")

  carousel.addEventListener("mousedown", (e) => {
    isDown = true
    startX = e.pageX - carousel.offsetLeft
    scrollLeft = carousel.scrollLeft
  })

  carousel.addEventListener("mouseleave", () => {
    isDown = false
  })

  carousel.addEventListener("mouseup", () => {
    isDown = false
  })

  carousel.addEventListener("mousemove", (e) => {
    if (!isDown) return
    e.preventDefault()
    const x = e.pageX - carousel.offsetLeft
    const walk = (x - startX) * 2
    carousel.scrollLeft = scrollLeft - walk
  })

  // Touch events para dispositivos móveis
  carousel.addEventListener("touchstart", (e) => {
    startX = e.touches[0].pageX - carousel.offsetLeft
    scrollLeft = carousel.scrollLeft
  })

  carousel.addEventListener("touchmove", (e) => {
    const x = e.touches[0].pageX - carousel.offsetLeft
    const walk = (x - startX) * 2
    carousel.scrollLeft = scrollLeft - walk
  })
})

// Smooth scroll para links internos (se houver)
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault()
    document.querySelector(this.getAttribute("href")).scrollIntoView({
      behavior: "smooth",
    })
  })
})
