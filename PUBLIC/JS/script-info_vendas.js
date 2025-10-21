function updateQuantityOnServer(idItem, novaQuantidade, button) {
  console.log(" Iniciando atualização de quantidade")
  console.log(" ID do item:", idItem)
  console.log(" Nova quantidade:", novaQuantidade)
  console.log(" URL da requisição:", window.location.href)

  button.disabled = true
  button.style.opacity = "0.5"

  const formData = new FormData()
  formData.append("action", "update_quantity")
  formData.append("id_item", idItem)
  formData.append("quantidade", novaQuantidade)

  console.log(" Dados do FormData:")
  for (const pair of formData.entries()) {
    console.log("", pair[0], "=", pair[1])
  }

  fetch(window.location.href, {
    method: "POST",
    body: formData,
  })
    .then((response) => {
      console.log(" Status da resposta:", response.status)
      console.log(" Headers da resposta:", response.headers.get("content-type"))

      const contentType = response.headers.get("content-type")
      if (!contentType || !contentType.includes("application/json")) {
        console.error(" Resposta não é JSON! Content-Type:", contentType)
        return response.text().then((text) => {
          console.error(" Conteúdo da resposta:", text)
          throw new Error("Resposta do servidor não é JSON")
        })
      }

      return response.json()
    })
    .then((data) => {
      console.log(" Dados recebidos:", data)

      if (data.success) {
        const cartItem = button.closest(".P_cart-item")
        cartItem.querySelector(".P_item-total").textContent = `R$ ${data.total_item}`

        document.getElementById("summary-subtotal").textContent = `R$ ${data.subtotal}`
        document.getElementById("summary-total").textContent = `R$ ${data.total}`

        console.log(" Quantidade atualizada com sucesso no servidor")
      } else {
        console.error(" Erro ao atualizar quantidade:", data.error)
        alert("Erro ao atualizar quantidade: " + data.error)
        location.reload()
      }
    })
    .catch((error) => {
      console.error(" Erro na requisição:", error)
      console.error(" Stack trace:", error.stack)
      location.reload()
    })
    .finally(() => {
      button.disabled = false
      button.style.opacity = "1"
    })
}

function increaseQty(button) {
  const cartItem = button.closest(".P_cart-item")
  const input = cartItem.querySelector(".P_qty-input")
  const idItem = cartItem.dataset.idItem

  const value = Number.parseInt(input.value)
  const newValue = value + 1

  input.value = newValue

  updateQuantityOnServer(idItem, newValue, button)
}

function decreaseQty(button) {
  const cartItem = button.closest(".P_cart-item")
  const input = cartItem.querySelector(".P_qty-input")
  const idItem = cartItem.dataset.idItem

  const value = Number.parseInt(input.value)

  if (value > 1) {
    const newValue = value - 1

    input.value = newValue

    updateQuantityOnServer(idItem, newValue, button)
  }
}

function updateItemTotal(button) {
  const cartItem = button.closest(".P_cart-item")
  const priceText = cartItem.querySelector(".P_item-preco").textContent
  const price = Number.parseFloat(priceText.replace("R$", "").replace(",", ".").trim())
  const qty = Number.parseInt(cartItem.querySelector(".P_qty-input").value)
  const total = price * qty

  cartItem.querySelector(".P_item-total").textContent = `R$ ${total.toFixed(2).replace(".", ",")}`

  updateSummary()
}

function removeItem(button) {
  const cartItem = button.closest(".P_cart-item")

  cartItem.style.transition = "all 0.3s ease"
  cartItem.style.opacity = "0"
  cartItem.style.transform = "translateX(-20px)"

  setTimeout(() => {
    cartItem.remove()
    updateSummary()
    updateItemCount()
  }, 300)
}

function updateSummary() {
  const cartItems = document.querySelectorAll(".P_cart-item")
  let subtotal = 0

  cartItems.forEach((item) => {
    const totalText = item.querySelector(".P_item-total").textContent
    const total = Number.parseFloat(totalText.replace("R$", "").replace(",", ".").trim())
    subtotal += total
  })

  const discount = 0
  const total = subtotal - discount

  document.getElementById("summary-subtotal").textContent = `R$ ${subtotal.toFixed(2).replace(".", ",")}`
  document.getElementById("summary-discount").textContent = `- R$ ${discount.toFixed(2).replace(".", ",")}`
  document.getElementById("summary-total").textContent = `R$ ${total.toFixed(2).replace(".", ",")}`
}

function updateItemCount() {
  const cartItems = document.querySelectorAll(".P_cart-item")
  const count = cartItems.length
  const itemsCountElement = document.querySelector(".P_items-count")

  if (itemsCountElement) {
    itemsCountElement.textContent = `${count} ${count === 1 ? "item" : "itens"}`
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const applyCouponBtn = document.querySelector(".P_apply-coupon-btn")

  if (applyCouponBtn) {
    applyCouponBtn.addEventListener("click", () => {
      const couponInput = document.querySelector(".P_coupon-input")
      const couponCode = couponInput.value.trim()

      if (couponCode) {
        alert(`Cupom "${couponCode}" aplicado!`)
        couponInput.value = ""
      } else {
        alert("Por favor, digite um cupom válido.")
      }
    })
  }

})
