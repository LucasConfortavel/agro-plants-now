// alterna a barra lateral ao clicar no menu de hambúrguer
document.querySelector(".jp_hamburger-menu").addEventListener("click", function () {
  this.classList.toggle("active")
  document.querySelector(".jp_sidebar").classList.toggle("active")
})

// funcionalidade modal de registro de clientes
const addModal = document.getElementById("addClienteModal")
const addBtn = document.getElementById("cadastrarClienteBtn")
const addClienteForm = document.getElementById("addClienteForm")

// mostra o modal ao clicar no botão de registro
addBtn.addEventListener("click", () => {
  addModal.style.display = "block"
  // Foca no primeiro campo do formulário
  setTimeout(() => {
    document.getElementById("nome").focus()
  }, 100)
})

// trata da apresentação de formulários
addClienteForm.addEventListener("submit", (e) => {
  e.preventDefault()

  // Animação de loading no botão
  const submitBtn = e.target.querySelector('button[type="submit"]')
  const originalText = submitBtn.innerHTML
  submitBtn.innerHTML = `
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="animate-spin">
      <path d="M21 12a9 9 0 11-6.219-8.56"/>
    </svg>
    Cadastrando...
  `
  submitBtn.disabled = true

  // Simula processamento
  setTimeout(() => {
    alert("Cliente cadastrado com sucesso!")
    addModal.style.display = "none"
    addClienteForm.reset()
    submitBtn.innerHTML = originalText
    submitBtn.disabled = false
  }, 1500)
})

// fecha modais ao clicar fora
window.addEventListener("click", (e) => {
  if (e.target === addModal) {
    addModal.style.display = "none"
  }
})

// funcionalidade modal de informação do cliente
const clienteInfoModal = document.getElementById("clienteInfoModal")
const closeClienteInfoModal = document.getElementById("closeClienteInfoModal")
const clienteInfoContent = document.getElementById("clienteInfoContent")

// dados de clientes para teste (simulando os dados do PHP)
const clientes = [
  {
    id: 1,
    nome: "Rafael Germinari",
    data_nascimento: "15/03/1985",
    email: "rafael.germinari@email.com",
    telefone: "(11) 99999-9999",
    cpf: "123.456.789-00",
  },
  // A função showClienteInfo() vai buscar clientes por ID, então precisamos
  // de pelo menos um cliente para evitar erros
]

// função para mostrar informações sobre o cliente
function showClienteInfo(id) {
  // numa aplicação real, os dados do cliente são obtidos a partir do servidor
  // para este exemplo, vou utilizar os dados de teste
  const cliente = clientes.find((c) => c.id === id) || {
    nome: "Cliente #" + id,
    data_nascimento: "01/01/1990",
    email: "cliente" + id + "@exemplo.com",
    telefone: "(11) 99999-9999",
    cpf: "123.456.789-00",
  }

  clienteInfoContent.innerHTML = `
    <div class="jp_info-row">
      <div class="jp_info-group">
        <label>Nome</label>
        <p>${cliente.nome}</p>
      </div>
      <div class="jp_info-group">
        <label>Data de nascimento</label>
        <p>${cliente.data_nascimento}</p>
      </div>
    </div>
    <div class="jp_info-row">
      <div class="jp_info-group">
        <label>E-mail</label>
        <p>${cliente.email}</p>
      </div>
      <div class="jp_info-group">
        <label>Telefone</label>
        <p>${cliente.telefone}</p>
      </div>
    </div>
    <div class="jp_info-row">
      <div class="jp_info-group">
        <label>CPF</label>
        <p>${cliente.cpf}</p>
      </div>
    </div>
  `
  clienteInfoModal.style.display = "block"
}

// fecha o modal de informações do cliente
closeClienteInfoModal.addEventListener("click", () => {
  clienteInfoModal.style.display = "none"
})

// atualiza o window click event listener para incluir o modal de informação do cliente
window.addEventListener("click", (e) => {
  if (e.target === addModal) {
    addModal.style.display = "none"
  }
  if (e.target === clienteInfoModal) {
    clienteInfoModal.style.display = "none"
  }
})

// tornar as linhas da tabela clicáveis para mostrar informações sobre o cliente
document.querySelectorAll(".jp_table tbody tr").forEach((row) => {
  row.addEventListener("click", (e) => {
    // não ativa se clicar no ícone de informação (tem o seu próprio manipulador)
    if (!e.target.closest(".jp_info-icon")) {
      const id = Number.parseInt(row.getAttribute("data-id"))
      showClienteInfo(id)
    }
  })
})

// Adiciona funcionalidade de tooltip para textos truncados
document.addEventListener("DOMContentLoaded", () => {
  // Adiciona tooltips para células que podem ter texto truncado
  const tableCells = document.querySelectorAll(".jp_table td[title]")

  tableCells.forEach((cell) => {
    cell.addEventListener("mouseenter", function () {
      const text = this.textContent.trim()
      const title = this.getAttribute("title")

      // Só mostra tooltip se o texto foi truncado
      if (text.includes("...") && title) {
        this.style.position = "relative"
      }
    })
  })
})

// Função para verificar alinhamento dos elementos com a nova largura
function checkAlignment() {
  const tableContainer = document.querySelector(".jp_table-container")
  const header = document.querySelector(".jp_header")
  const topBar = document.querySelector(".jp_top-bar")
  const pagination = document.querySelector(".jp_pagination")
  const contentWrapper = document.querySelector(".jp_content-wrapper")

  if (tableContainer && header && topBar && pagination && contentWrapper) {
    const tableContainerRect = tableContainer.getBoundingClientRect()
    const headerRect = header.getBoundingClientRect()
    const topBarRect = topBar.getBoundingClientRect()
    const paginationRect = pagination.getBoundingClientRect()
    const contentWrapperRect = contentWrapper.getBoundingClientRect()

    // Verifica se todos os elementos estão alinhados com tolerância de 5px
    const isAligned =
      Math.abs(tableContainerRect.left - headerRect.left) < 5 &&
      Math.abs(tableContainerRect.right - headerRect.right) < 5 &&
      Math.abs(tableContainerRect.left - topBarRect.left) < 5 &&
      Math.abs(tableContainerRect.right - topBarRect.right) < 5 &&
      Math.abs(tableContainerRect.left - paginationRect.left) < 5 &&
      Math.abs(tableContainerRect.right - paginationRect.right) < 5

    if (!isAligned) {
      console.log("Elementos não estão perfeitamente alinhados, ajustando...")
      adjustAlignment()
    }
  }
}

// Função para ajustar alinhamento dinamicamente para 1200px
function adjustAlignment() {
  const contentWrapper = document.querySelector(".jp_content-wrapper")
  const header = document.querySelector(".jp_header")
  const topBar = document.querySelector(".jp_top-bar")
  const pagination = document.querySelector(".jp_pagination")

  if (contentWrapper) {
    // Ajusta todos os elementos para ter a mesma largura máxima de 1200px
    ;[header, topBar, pagination].forEach((element) => {
      if (element) {
        element.style.maxWidth = "1200px"
        element.style.width = "100%"
        element.style.margin = "0 auto"
        element.style.boxSizing = "border-box"
      }
    })
  }
}

// Função para otimizar a largura da tabela baseada no conteúdo (1200px)
function optimizeTableWidth() {
  const table = document.querySelector(".jp_table")
  const container = document.querySelector(".jp_content-wrapper")

  if (table && container) {
    const containerWidth = container.offsetWidth
    const padding = 40 // 20px de cada lado
    const availableWidth = containerWidth - padding

    // Ajusta a largura da tabela baseada no espaço disponível
    if (availableWidth > 850 && availableWidth < 1250) {
      table.style.width = "100%"
      table.style.maxWidth = "1200px"
    } else if (availableWidth >= 1250) {
      table.style.width = "1200px"
      table.style.margin = "0 auto"
    }
  }
}

// Função para melhorar a experiência de navegação por teclado
function enhanceKeyboardNavigation() {
  const tableRows = document.querySelectorAll(".jp_table tbody tr")

  tableRows.forEach((row, index) => {
    row.setAttribute("tabindex", "0")

    row.addEventListener("keydown", (e) => {
      if (e.key === "Enter" || e.key === " ") {
        e.preventDefault()
        const id = Number.parseInt(row.getAttribute("data-id"))
        showClienteInfo(id)
      }

      if (e.key === "ArrowDown" && index < tableRows.length - 1) {
        e.preventDefault()
        tableRows[index + 1].focus()
      }

      if (e.key === "ArrowUp" && index > 0) {
        e.preventDefault()
        tableRows[index - 1].focus()
      }
    })
  })
}

// Função para adicionar animações suaves
function addSmoothAnimations() {
  // Adiciona classe para animações CSS
  document.body.classList.add("animations-enabled")

  // Animação de entrada para linhas da tabela
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, index) => {
      if (entry.isIntersecting) {
        setTimeout(() => {
          entry.target.style.opacity = "1"
          entry.target.style.transform = "translateY(0)"
        }, index * 50)
      }
    })
  })

  document.querySelectorAll(".jp_table tbody tr").forEach((row) => {
    row.style.opacity = "0"
    row.style.transform = "translateY(20px)"
    row.style.transition = "opacity 0.3s ease, transform 0.3s ease"
    observer.observe(row)
  })
}

// Chama as funções quando a página carrega e quando a janela é redimensionada
window.addEventListener("load", () => {
  optimizeTableWidth()
  enhanceKeyboardNavigation()
  addSmoothAnimations()
  setTimeout(() => {
    checkAlignment()
  }, 100)
})

window.addEventListener("resize", () => {
  optimizeTableWidth()
  setTimeout(checkAlignment, 100)
})

// Adiciona suporte para escape key nos modais
document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    if (addModal.style.display === "block") {
      addModal.style.display = "none"
    }
    if (clienteInfoModal.style.display === "block") {
      clienteInfoModal.style.display = "none"
    }
  }
})

// Observer para monitorar mudanças no layout com a nova largura
const layoutObserver = new ResizeObserver((entries) => {
  for (const entry of entries) {
    if (entry.target.classList.contains("jp_table")) {
      setTimeout(checkAlignment, 50)
    }
  }
})

// Observa mudanças na tabela
document.addEventListener("DOMContentLoaded", () => {
  const table = document.querySelector(".jp_table")
  if (table) {
    layoutObserver.observe(table)
  }
})
