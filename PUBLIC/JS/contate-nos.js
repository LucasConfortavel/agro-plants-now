document.addEventListener("DOMContentLoaded", () => {
    const contactForm = document.getElementById("contact-form")
    const formMessage = document.getElementById("form-message")
    const submitButton = contactForm.querySelector(".submit-button")
  
    contactForm.addEventListener("submit", async (event) => {
      event.preventDefault()
  
      submitButton.disabled = true
      submitButton.textContent = "Enviando..."
      formMessage.textContent = ""
      formMessage.className = "form-status-message"
  
      const formData = new FormData(contactForm)
      const name = formData.get("name")
      const email = formData.get("email")
      const message = formData.get("message")

      if (!name || !email || !message) {
        formMessage.textContent = "Por favor, preencha todos os campos."
        formMessage.classList.add("error")
        submitButton.disabled = false
        submitButton.textContent = "Enviar Mensagem"
        return
      }

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
      if (!emailRegex.test(email)) {
        formMessage.textContent = "Por favor, insira um email válido."
        formMessage.classList.add("error")
        submitButton.disabled = false
        submitButton.textContent = "Enviar Mensagem"
        return
      }
  
      try {
        const response = await fetch('', {
            method: 'POST',
            body: formData
        })

        if (response.ok) {
          window.location.reload()
        } else {
          throw new Error('Erro na resposta do servidor')
        }

      } catch (error) {
        console.error("Erro ao enviar formulário:", error)
        
        contactForm.removeEventListener('submit', arguments.callee)
        contactForm.submit()
      }
    })

    const inputs = contactForm.querySelectorAll('input, textarea')
    inputs.forEach(input => {
      input.addEventListener('input', () => {
        if (formMessage.textContent && formMessage.classList.contains('error')) {
          formMessage.textContent = ''
          formMessage.className = 'form-status-message'
        }
      })
    })
  })