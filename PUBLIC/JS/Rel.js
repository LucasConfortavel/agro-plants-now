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
  const ctx = canvas.getContext("2d")
  const dica = document.getElementById("po-grafico-tooltip")

  if (!canvas || !ctx) {
    console.error("Canvas ou contexto não encontrado")
    return
  }

  const larguraPai = canvas.parentElement ? canvas.parentElement.clientWidth : 300
  const alturaPai = canvas.parentElement ? canvas.parentElement.clientHeight : 200

  canvas.width = larguraPai - 40
  canvas.height = alturaPai - 10

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
    
    pontos.forEach(ponto => {
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

      desenharGrafico(indiceProximo)
    } else {
      dica.style.display = "none"
      desenharGrafico()
    }
  }

  function tratarSaidaMouse() {
    dica.style.display = "none"
    desenharGrafico()
  }

  canvas.addEventListener("mousemove", tratarMovimentoMouse)
  canvas.addEventListener("mouseout", tratarSaidaMouse)
}

function criarminigrafico() {
  const miniChartContainer = document.getElementById("po-mini-grafico")

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

function switchTab(tabName) {
  console.log("Trocando para a aba:", tabName)

  const pageTitle = document.getElementById("po-page-title")
  pageTitle.textContent = tabName === "po-vendas" ? "Relatório de Vendas" : "Relatório de Comissões"

  document.querySelectorAll(".po-tab").forEach((tab) => {
    tab.classList.remove("po-active")
  })
  document.querySelector(`.po-tab[data-tab="${tabName}"]`).classList.add("po-active")

  document.querySelectorAll(".po-content-section").forEach((section) => {
    section.classList.remove("po-active")
  })

  if (tabName === "po-vendas") {
    document.getElementById("po-vendas-section").classList.add("po-active")
    document.getElementById("po-vendas-graficos").classList.add("po-active")
    criarBarradoGrafico()
  } else {
    document.getElementById("po-comissoes-section").classList.add("po-active")
    document.getElementById("po-comissoes-graficos").classList.add("po-active")
    criarGraficodeLinha()
  }
}

window.onload = () => {
  criarBarradoGrafico()
  criarminigrafico()

  const paginationItems = document.querySelectorAll(".po-paginacao span")
  paginationItems.forEach((item) => {
    item.addEventListener("click", function () {
      paginationItems.forEach((i) => i.classList.remove("po-active"))
      this.classList.add("po-active")
    })
  })

  criarGraficodeLinha()
}

window.addEventListener("resize", () => {
  if (document.getElementById("po-comissoes-graficos").classList.contains("po-active")) {
    criarGraficodeLinha()
  }
})