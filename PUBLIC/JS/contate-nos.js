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
  
      // Simulate an API call
      try {
        // In a real application, you would send this data to a server endpoint
        // using fetch() or XMLHttpRequest.
        // Example:
        // const response = await fetch('/api/contact', {
        //     method: 'POST',
        //     headers: {
        //         'Content-Type': 'application/json',
        //     },
        //     body: JSON.stringify({ name, email, message }),
        // });
        // const result = await response.json();
  
        // For this example, we'll just simulate a delay and success
        await new Promise((resolve) => setTimeout(resolve, 1500))
  
        // Simulate success
        const result = { success: true }
  
        if (result.success) {
          formMessage.textContent = "Mensagem enviada com sucesso!"
          formMessage.classList.add("success")
          contactForm.reset()
        } else {
          formMessage.textContent = "Ocorreu um erro ao enviar a mensagem. Tente novamente."
          formMessage.classList.add("error")
        }
      } catch (error) {
        console.error("Erro ao enviar formulário:", error)
        formMessage.textContent = "Ocorreu um erro de rede. Por favor, tente novamente mais tarde."
        formMessage.classList.add("error")
      } finally {
        submitButton.disabled = false
        submitButton.textContent = "Enviar Mensagem"
      }
    })
  })
  