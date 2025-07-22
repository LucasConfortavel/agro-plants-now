// Dados de exemplo para diferentes páginas - ADICIONADO
const vendasData = {
  1: [
    { data: "01/08", vendedor: "João Silva", produto: "Refrigerantes", valor: "R$ 320,00" },
    { data: "01/08", vendedor: "José Ferraz", produto: "Instalação de App", valor: "R$ 700,00" },
    { data: "01/08", vendedor: "Carlos Eduardo", produto: "Serviços Variados", valor: "R$ 980,00" },
    { data: "01/08", vendedor: "Paulo Otávio", produto: "Compras de praga", valor: "R$ 450,00" },
    { data: "01/08", vendedor: "Eduardo Camões", produto: "Franquia - inicial", valor: "R$ 350,00" },
  ],
  2: [
    { data: "02/08", vendedor: "Maria Santos", produto: "Fertilizantes", valor: "R$ 890,00" },
    { data: "02/08", vendedor: "Pedro Lima", produto: "Sementes Premium", valor: "R$ 1.200,00" },
    { data: "02/08", vendedor: "Ana Costa", produto: "Equipamentos", valor: "R$ 2.100,00" },
    { data: "02/08", vendedor: "Roberto Silva", produto: "Consultoria", valor: "R$ 750,00" },
    { data: "02/08", vendedor: "Lucia Mendes", produto: "Treinamento", valor: "R$ 600,00" },
  ],
  3: [
    { data: "03/08", vendedor: "Fernando Rocha", produto: "Defensivos", valor: "R$ 1.500,00" },
    { data: "03/08", vendedor: "Carla Dias", produto: "Irrigação", valor: "R$ 3.200,00" },
    { data: "03/08", vendedor: "Marcos Pereira", produto: "Análise de Solo", valor: "R$ 400,00" },
    { data: "03/08", vendedor: "Sandra Oliveira", produto: "Mudas", valor: "R$ 850,00" },
    { data: "03/08", vendedor: "Ricardo Alves", produto: "Adubos Orgânicos", valor: "R$ 1.100,00" },
  ],
}

const comissoesData = {
  1: [
    {
      data: "02/08",
      vendedor: "João Silva",
      produto: "Refrigerantes",
      valorVenda: "R$ 200,00",
      percentual: "10%",
      valorComissao: "R$ 20,00",
      status: "Pago",
    },
    {
      data: "02/08",
      vendedor: "José Ferraz",
      produto: "Instalação de App",
      valorVenda: "R$ 100,00",
      percentual: "10%",
      valorComissao: "R$ 10,00",
      status: "Pago",
    },
    {
      data: "02/08",
      vendedor: "Carlos Eduardo",
      produto: "Sementes tratadas",
      valorVenda: "R$ 800,00",
      percentual: "10%",
      valorComissao: "R$ 80,00",
      status: "Pago",
    },
    {
      data: "02/08",
      vendedor: "Paulo Otávio",
      produto: "Controle de praga",
      valorVenda: "R$ 500,00",
      percentual: "10%",
      valorComissao: "R$ 50,00",
      status: "Pago",
    },
    {
      data: "02/08",
      vendedor: "Eduardo Camões",
      produto: "Fungicida natural",
      valorVenda: "R$ 250,00",
      percentual: "10%",
      valorComissao: "R$ 25,00",
      status: "Pago",
    },
  ],
  2: [
    {
      data: "03/08",
      vendedor: "Maria Santos",
      produto: "Fertilizantes",
      valorVenda: "R$ 890,00",
      percentual: "12%",
      valorComissao: "R$ 106,80",
      status: "Pendente",
    },
    {
      data: "03/08",
      vendedor: "Pedro Lima",
      produto: "Sementes Premium",
      valorVenda: "R$ 1.200,00",
      percentual: "15%",
      valorComissao: "R$ 180,00",
      status: "Pago",
    },
    {
      data: "03/08",
      vendedor: "Ana Costa",
      produto: "Equipamentos",
      valorVenda: "R$ 2.100,00",
      percentual: "8%",
      valorComissao: "R$ 168,00",
      status: "Pago",
    },
    {
      data: "03/08",
      vendedor: "Roberto Silva",
      produto: "Consultoria",
      valorVenda: "R$ 750,00",
      percentual: "20%",
      valorComissao: "R$ 150,00",
      status: "Pendente",
    },
    {
      data: "03/08",
      vendedor: "Lucia Mendes",
      produto: "Treinamento",
      valorVenda: "R$ 600,00",
      percentual: "15%",
      valorComissao: "R$ 90,00",
      status: "Pago",
    },
  ],
  3: [
    {
      data: "04/08",
      vendedor: "Fernando Rocha",
      produto: "Defensivos",
      valorVenda: "R$ 1.500,00",
      percentual: "10%",
      valorComissao: "R$ 150,00",
      status: "Pago",
    },
    {
      data: "04/08",
      vendedor: "Carla Dias",
      produto: "Irrigação",
      valorVenda: "R$ 3.200,00",
      percentual: "5%",
      valorComissao: "R$ 160,00",
      status: "Pendente",
    },
    {
      data: "04/08",
      vendedor: "Marcos Pereira",
      produto: "Análise de Solo",
      valorVenda: "R$ 400,00",
      percentual: "25%",
      valorComissao: "R$ 100,00",
      status: "Pago",
    },
    {
      data: "04/08",
      vendedor: "Sandra Oliveira",
      produto: "Mudas",
      valorVenda: "R$ 850,00",
      percentual: "12%",
      valorComissao: "R$ 102,00",
      status: "Pago",
    },
    {
      data: "04/08",
      vendedor: "Ricardo Alves",
      produto: "Adubos Orgânicos",
      valorVenda: "R$ 1.100,00",
      percentual: "10%",
      valorComissao: "R$ 110,00",
      status: "Pendente",
    },
  ],
}

let currentTab = "po-vendas"
let currentPage = 1
const totalPages = 3

function loadTableData() {
  const isVendas = currentTab === "po-vendas"
  const data = isVendas ? vendasData[currentPage] : comissoesData[currentPage]

  const tableSelector = isVendas ? "#po-vendas-section tbody" : "#po-comissoes-section tbody"
  const tbody = document.querySelector(tableSelector)

  if (!tbody) {
    console.error(`Tabela não encontrada: ${tableSelector}`)
    return
  }

  tbody.innerHTML = ""

  data.forEach((item) => {
    const row = document.createElement("tr")

    if (isVendas) {
      row.innerHTML = `
        <td>${item.data}</td>
        <td>${item.vendedor}</td>
        <td>${item.produto}</td>
        <td>${item.valor}</td>
      `
    } else {
      const statusClass = item.status === "Pago" ? "po-status-badge" : "po-status-badge-1"
      row.innerHTML = `
        <td>${item.data}</td>
        <td>${item.vendedor}</td>
        <td>${item.produto}</td>
        <td>${item.valorVenda}</td>
        <td>${item.percentual}</td>
        <td>${item.valorComissao}</td>
        <td><span class="${statusClass}">${item.status}</span></td>
      `
    }

    tbody.appendChild(row)
  })
}

function updatePagination() {
  document.querySelectorAll(".jp_page-number").forEach((btn, index) => {
    btn.classList.remove("active")
    if (index + 1 === currentPage) {
      btn.classList.add("active")
    }
  })
}

function goToPage(page) {
  if (page >= 1 && page <= totalPages && page !== currentPage) {
    currentPage = page
    loadTableData()
    updatePagination()
  }
}

function nextPage() {
  if (currentPage < totalPages) {
    goToPage(currentPage + 1)
  }
}

function previousPage() {
  if (currentPage > 1) {
    goToPage(currentPage - 1)
  }
}

const vendasValor = [
  { month: "Jan", value: 35 },
  { month: "Fev", value: 42 },
  { month: "Mar", value: 25 },
  { month: "Abr", value: 50 },
  { month: "Mai", value: 55 },
  { month: "Jun", value: 20 },
  { month: "Jul", value: 15 },
  { month: "Ago", value: 45 },
  { month: "Set", value: 80 },
  { month: "Out", value: 50 },
  { month: "Nov", value: 20 },
  { month: "Dez", value: 35 },
]

const comissaoValor = [
  { month: "Jan", value: 2100 },
  { month: "Fev", value: 2250 },
  { month: "Mar", value: 2700 },
  { month: "Abr", value: 2300 },
  { month: "Mai", value: 2200 },
  { month: "Jun", value: 2350 },
  { month: "Jul", value: 2400 },
  { month: "Ago", value: 2500 },
  { month: "Set", value: 2900 },
  { month: "Out", value: 2800 },
  { month: "Nov", value: 2600 },
  { month: "Dez", value: 2700 },
]

const minigraficoValor = [25, 30, 20, 35, 40, 30, 45, 50, 35, 40, 45, 55]

function criarBarradoGrafico() {
  const chartContainer = document.getElementById("po-vendas-grafico")
  if (!chartContainer) {
    console.error("Container do gráfico de vendas não encontrado")
    return
  }

  while (chartContainer.children.length > 2) {
    chartContainer.removeChild(chartContainer.lastChild)
  }

  const valorMax = Math.max(...vendasValor.map((item) => item.value))
  vendasValor.forEach((item) => {
    const barHeight = (item.value / valorMax) * 200
    const bar = document.createElement("div")
    bar.className = "po-barra"
    bar.style.height = `${barHeight}px`
    bar.style.width = `${100 / vendasValor.length}%`
    bar.style.maxWidth = "60px"

    const label = document.createElement("div")
    label.className = "po-barra-label"
    label.textContent = item.month
    bar.appendChild(label)
    chartContainer.appendChild(bar)
  })
}

function criarGraficodeLinha() {
  const canvas = document.getElementById("po-comissao-grafico")
  if (!canvas) {
    console.error("Canvas do gráfico de comissões não encontrado")
    return
  }

  const ctx = canvas.getContext("2d")
  const dica = document.getElementById("po-grafico-tooltip")

  if (!ctx) {
    console.error("Contexto do canvas não encontrado")
    return
  }

  // Responsividade do canvas
  const container = canvas.parentElement
  const containerWidth = container ? container.clientWidth : 600
  const containerHeight = container ? container.clientHeight : 200

  canvas.width = Math.max(containerWidth - 60, 400) // Mínimo 400px
  canvas.height = Math.max(containerHeight - 40, 160) // Mínimo 160px

  const largura = canvas.width
  const altura = canvas.height - 25

  function desenharGrafico(indiceDestaque = -1) {
    ctx.clearRect(0, 0, largura, altura + 25)
    const valorMax = Math.max(...comissaoValor.map((item) => item.value))
    const valorMin = Math.min(...comissaoValor.map((item) => item.value)) * 0.95
    const intervalo = valorMax - valorMin
    const fundoGradiente = ctx.createLinearGradient(0, 0, 0, altura)
    fundoGradiente.addColorStop(0, "rgba(250, 250, 250, 0.5)")
    fundoGradiente.addColorStop(1, "rgba(255, 255, 255, 0.9)")

    ctx.fillStyle = fundoGradiente
    ctx.fillRect(0, 0, largura, altura)

    ctx.strokeStyle = "#e0e0e0"
    ctx.lineWidth = 1
    ctx.strokeRect(0, 0, largura, altura)
    const numLinhas = 5

    ctx.fillStyle = "#666"
    ctx.font = "10px poppins"
    ctx.textAlign = "right"

    for (let i = 0; i <= numLinhas; i++) {
      const y = (i / numLinhas) * altura
      const valorEixoY = valorMax - (i / numLinhas) * intervalo

      ctx.beginPath()
      ctx.setLineDash([3, 3])
      ctx.strokeStyle = i === numLinhas ? "#aaa" : "#e5e5e5"
      ctx.lineWidth = i === numLinhas ? 1 : 0.5
      ctx.moveTo(0, y)
      ctx.lineTo(largura, y)
      ctx.stroke()

      ctx.fillText(`R$ ${valorEixoY.toFixed(0)}`, -5, y + 4)
    }

    ctx.setLineDash([])
    const pontos = comissaoValor.map((item, indice) => {
      const x = (indice / (comissaoValor.length - 1)) * largura
      const y = altura - ((item.value - valorMin) / intervalo) * altura
      return { x, y }
    })
    ctx.beginPath()
    ctx.moveTo(pontos[0].x, altura)

    pontos.forEach((ponto) => {
      ctx.lineTo(ponto.x, ponto.y)
    })

    ctx.lineTo(pontos[pontos.length - 1].x, altura)
    ctx.closePath()

    const gradiente = ctx.createLinearGradient(0, 0, 0, altura)
    gradiente.addColorStop(0, "rgba(76, 175, 80, 0.3)")
    gradiente.addColorStop(1, "rgba(76, 175, 80, 0.05)")

    ctx.fillStyle = gradiente
    ctx.fill()
    ctx.beginPath()
    ctx.lineWidth = 3

    const linhaGradiente = ctx.createLinearGradient(0, 0, largura, 0)
    linhaGradiente.addColorStop(0, "#4CAF50")
    linhaGradiente.addColorStop(0.5, "#2E7D32")
    linhaGradiente.addColorStop(1, "#4CAF50")

    ctx.strokeStyle = linhaGradiente

    pontos.forEach((ponto, indice) => {
      if (indice === 0) {
        ctx.moveTo(ponto.x, ponto.y)
      } else {
        const pontoPrevio = pontos[indice - 1]
        const cpx1 = pontoPrevio.x + (ponto.x - pontoPrevio.x) / 2
        const cpy1 = pontoPrevio.y
        const cpx2 = pontoPrevio.x + (ponto.x - pontoPrevio.x) / 2
        const cpy2 = ponto.y

        ctx.bezierCurveTo(cpx1, cpy1, cpx2, cpy2, ponto.x, ponto.y)
      }
    })

    ctx.stroke()
    comissaoValor.forEach((item, indice) => {
      const x = (indice / (comissaoValor.length - 1)) * largura

      ctx.beginPath()
      ctx.setLineDash([2, 4])
      ctx.strokeStyle = "#e0e0e0"
      ctx.lineWidth = 0.5
      ctx.moveTo(x, 0)
      ctx.lineTo(x, altura)
      ctx.stroke()
      ctx.setLineDash([])
    })
    pontos.forEach((ponto, indice) => {
      ctx.beginPath()
      ctx.shadowColor = "rgba(0, 0, 0, 0.2)"
      ctx.shadowBlur = 5
      ctx.shadowOffsetX = 0
      ctx.shadowOffsetY = 2
      ctx.arc(ponto.x, ponto.y, indice === indiceDestaque ? 8 : 6, 0, Math.PI * 2)
      ctx.fillStyle = indice === indiceDestaque ? "#2E7D32" : "#4CAF50"
      ctx.fill()

      ctx.shadowColor = "transparent"
      ctx.shadowBlur = 0
      ctx.shadowOffsetX = 0
      ctx.shadowOffsetY = 0

      ctx.beginPath()
      ctx.arc(ponto.x, ponto.y, indice === indiceDestaque ? 6 : 4, 0, Math.PI * 2)
      ctx.fillStyle = "white"
      ctx.fill()

      ctx.beginPath()
      ctx.arc(ponto.x, ponto.y, indice === indiceDestaque ? 4 : 2, 0, Math.PI * 2)
      ctx.fillStyle = indice === indiceDestaque ? "#2E7D32" : "#4CAF50"
      ctx.fill()
    })
    ctx.fillStyle = "#666"
    ctx.font = "10px poppins"
    ctx.textAlign = "center"
    comissaoValor.forEach((item, indice) => {
      const x = (indice / (comissaoValor.length - 1)) * largura

      if (indice % 2 === 0) {
        ctx.fillStyle = "#f5f5f5"
        ctx.fillRect(x - 15, altura + 2, 30, 18)
        ctx.fillStyle = "#666"
      }

      ctx.fillText(item.month, x, altura + 15)
    })

    ctx.save()
    ctx.translate(-25, altura / 2)
    ctx.rotate(-Math.PI / 2)
    ctx.fillStyle = "#666"
    ctx.font = "bold 10px poppins"
    ctx.textAlign = "center"
    ctx.fillText("Valor (R$)", 0, 0)
    ctx.restore()
  }

  desenharGrafico()
  canvas.removeEventListener("mousemove", tratarMovimentoMouse)
  canvas.removeEventListener("mouseout", tratarSaidaMouse)

  function tratarMovimentoMouse(e) {
    const rect = canvas.getBoundingClientRect()
    const mouseX = e.clientX - rect.left
    let indiceProximo = 0
    let distanciaProxima = Number.POSITIVE_INFINITY
    comissaoValor.forEach((item, indice) => {
      const x = (indice / (comissaoValor.length - 1)) * largura
      const distancia = Math.abs(mouseX - x)
      if (distancia < distanciaProxima) {
        distanciaProxima = distancia
        indiceProximo = indice
      }
    })
    if (distanciaProxima < 30) {
      const item = comissaoValor[indiceProximo]
      const x = (indiceProximo / (comissaoValor.length - 1)) * largura
      const y =
        altura -
        ((item.value - Math.min(...comissaoValor.map((i) => i.value)) * 0.95) /
          (Math.max(...comissaoValor.map((i) => i.value)) - Math.min(...comissaoValor.map((i) => i.value)) * 0.95)) *
          altura

      if (dica) {
        dica.style.display = "block"
        dica.style.left = x + 10 + "px"
        dica.style.top = y - 40 + "px"
        dica.style.backgroundColor = "rgba(46, 125, 50, 0.9)"
        dica.style.color = "white"
        dica.style.padding = "8px 12px"
        dica.style.borderRadius = "4px"
        dica.style.fontSize = "12px"
        dica.style.fontWeight = "bold"
        dica.style.boxShadow = "0 2px 10px rgba(0,0,0,0.2)"
        dica.textContent = `R$ ${item.value.toFixed(2)}`
      }

      desenharGrafico(indiceProximo)
    } else {
      if (dica) dica.style.display = "none"
      desenharGrafico()
    }
  }

  function tratarSaidaMouse() {
    if (dica) dica.style.display = "none"
    desenharGrafico()
  }

  canvas.addEventListener("mousemove", tratarMovimentoMouse)
  canvas.addEventListener("mouseout", tratarSaidaMouse)
}

function criarminigrafico() {
  const miniChartContainer = document.getElementById("po-mini-grafico")
  if (!miniChartContainer) {
    console.error("Container do mini gráfico não encontrado")
    return
  }

  miniChartContainer.innerHTML = ""
  const valorMax = Math.max(...minigraficoValor)
  minigraficoValor.forEach((value) => {
    const barHeight = (value / valorMax) * 50
    const bar = document.createElement("div")
    bar.className = "po-mini-barra"
    bar.style.height = `${barHeight}px`
    miniChartContainer.appendChild(bar)
  })
}

// FUNÇÃO CORRIGIDA - PRINCIPAL CORREÇÃO
function switchTab(tabName) {
  console.log("Trocando para a aba:", tabName)

  // Verificar se o título da página existe
  const pageTitle = document.getElementById("po-page-title")
  if (pageTitle) {
    pageTitle.textContent = tabName === "po-vendas" ? "Relatório de Vendas" : "Relatório de Comissões"
  }

  // Remover classe ativa de todas as abas
  document.querySelectorAll(".po-tab").forEach((tab) => {
    tab.classList.remove("po-active")
  })

  // Adicionar classe ativa na aba clicada
  const activeTab = document.querySelector(`.po-tab[data-tab="${tabName}"]`)
  if (activeTab) {
    activeTab.classList.add("po-active")
  } else {
    console.error(`Aba não encontrada: ${tabName}`)
  }

  // Esconder todas as seções de conteúdo
  document.querySelectorAll(".po-content-section").forEach((section) => {
    section.classList.remove("po-active")
  })

  // Atualizar variáveis globais
  currentTab = tabName
  currentPage = 1

  // Mostrar seções apropriadas baseadas na aba
  if (tabName === "po-vendas") {
    // Mostrar seção de vendas
    const vendasSection = document.getElementById("po-vendas-section")
    if (vendasSection) {
      vendasSection.classList.add("po-active")
    } else {
      console.error("Seção de vendas não encontrada")
    }

    // Mostrar gráficos de vendas
    const vendasGraficos = document.getElementById("po-vendas-graficos")
    if (vendasGraficos) {
      vendasGraficos.classList.add("po-active")
      // Criar gráfico de barras após mostrar a seção
      setTimeout(() => criarBarradoGrafico(), 100)
    } else {
      console.error("Seção de gráficos de vendas não encontrada")
    }
  } else if (tabName === "po-comissoes") {
    // Mostrar seção de comissões
    const comissoesSection = document.getElementById("po-comissoes-section")
    if (comissoesSection) {
      comissoesSection.classList.add("po-active")
    } else {
      console.error("Seção de comissões não encontrada")
    }

    // Mostrar gráficos de comissões
    const comissoesGraficos = document.getElementById("po-comissoes-graficos")
    if (comissoesGraficos) {
      comissoesGraficos.classList.add("po-active")
      // Criar gráfico de linha após mostrar a seção
      setTimeout(() => criarGraficodeLinha(), 100)
    } else {
      console.error("Seção de gráficos de comissões não encontrada")
    }
  }

  // Carregar dados da tabela e atualizar paginação
  loadTableData()
  updatePagination()
}

window.onload = () => {
  console.log("Página carregada, inicializando...")

  // Criar gráficos iniciais
  criarBarradoGrafico()
  criarminigrafico()

  // Configurar paginação
  const pageNumbers = document.querySelectorAll(".jp_page-number")
  pageNumbers.forEach((item, index) => {
    item.addEventListener("click", () => {
      goToPage(index + 1)
    })
  })

  // Configurar seta de próxima página
  const pageArrow = document.querySelector(".jp_page-arrow")
  if (pageArrow) {
    pageArrow.addEventListener("click", nextPage)
  }

  // Carregar dados iniciais
  loadTableData()
  updatePagination()

  // Criar gráfico de linha (será usado quando trocar para comissões)
  criarGraficodeLinha()

  console.log("Inicialização concluída")
}

// Recriar gráficos quando a janela for redimensionada - RESPONSIVIDADE
window.addEventListener("resize", () => {
  const comissoesGraficos = document.getElementById("po-comissoes-graficos")
  if (comissoesGraficos && comissoesGraficos.classList.contains("po-active")) {
    setTimeout(() => criarGraficodeLinha(), 100)
  }

  const vendasGraficos = document.getElementById("po-vendas-graficos")
  if (vendasGraficos && vendasGraficos.classList.contains("po-active")) {
    setTimeout(() => criarBarradoGrafico(), 100)
  }
})
