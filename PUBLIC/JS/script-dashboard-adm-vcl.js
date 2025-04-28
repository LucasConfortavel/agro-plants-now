document.addEventListener("DOMContentLoaded", () => {
    // Configuração do gráfico
    const canvas = document.getElementById("salesChart")
    const ctx = canvas.getContext("2d")
  
    // Certifique-se de que o canvas tenha o tamanho correto
    resizeCanvas()
  
    // Dados do gráfico (aproximados com base na imagem)
    const data = [
      200, 220, 250, 300, 350, 400, 450, 500, 550, 520, 480, 450, 420, 400, 380, 400, 450, 500, 520, 500, 480, 450, 420,
      400, 380, 350, 320, 300, 280, 260,
    ]
  
    // Desenhar o gráfico com animação
    drawChartWithAnimation(data)
  
    // Redimensionar o gráfico quando a janela for redimensionada
    window.addEventListener("resize", () => {
      resizeCanvas()
      drawChart(data, 1) // Sem animação no redimensionamento
    })
  
    // Configurar a paginação
    setupPagination()
  
    // Animar os cards quando a página carrega
    animateCardsOnLoad()
  
    // Função para redimensionar o canvas
    function resizeCanvas() {
      const container = canvas.parentElement
      canvas.width = container.offsetWidth - 40 // Margem para a escala Y
      canvas.height = container.offsetHeight
    }
  
    // Função para desenhar o gráfico com animação
    function drawChartWithAnimation(data) {
      let progress = 0
      const animationDuration = 1000 // 1 segundo
      const startTime = performance.now()
  
      function animate(currentTime) {
        const elapsed = currentTime - startTime
        progress = Math.min(elapsed / animationDuration, 1)
  
        drawChart(data, progress)
  
        if (progress < 1) {
          requestAnimationFrame(animate)
        }
      }
  
      requestAnimationFrame(animate)
    }
  
    // Função para desenhar o gráfico
    function drawChart(data, progress) {
      // Limpar o canvas
      ctx.clearRect(0, 0, canvas.width, canvas.height)
  
      const padding = {
        top: 10,
        right: 10,
        bottom: 20,
        left: 10,
      }
  
      const chartWidth = canvas.width - padding.left - padding.right
      const chartHeight = canvas.height - padding.top - padding.bottom
  
      // Encontrar valores mínimos e máximos
      const maxValue = Math.max(...data)
      const minValue = Math.min(...data) * 0.8
      const valueRange = maxValue - minValue
  
      // Desenhar linhas de grade horizontais sutis
      ctx.strokeStyle = "rgba(230, 230, 230, 0.5)"
      ctx.lineWidth = 1
  
      for (let i = 0; i <= 4; i++) {
        const y = padding.top + chartHeight - (i / 4) * chartHeight
        ctx.beginPath()
        ctx.moveTo(padding.left, y)
        ctx.lineTo(padding.left + chartWidth, y)
        ctx.stroke()
      }
  
      // Calcular pontos para o gráfico
      const points = []
      const step = chartWidth / (data.length - 1)
  
      for (let i = 0; i < data.length; i++) {
        const x = padding.left + i * step
        const normalizedValue = (data[i] - minValue) / valueRange
        const y = padding.top + chartHeight - normalizedValue * chartHeight
        points.push({ x, y })
      }
  
      // Cortar os pontos para o progresso atual da animação
      const visiblePoints = points.slice(0, Math.ceil(points.length * progress))
  
      if (visiblePoints.length > 0) {
        // Desenhar a área sob a linha
        const gradient = ctx.createLinearGradient(0, padding.top, 0, padding.top + chartHeight)
        gradient.addColorStop(0, "rgba(0, 200, 0, 0.2)")
        gradient.addColorStop(1, "rgba(0, 200, 0, 0.0)")
  
        ctx.beginPath()
        ctx.moveTo(visiblePoints[0].x, padding.top + chartHeight)
        ctx.lineTo(visiblePoints[0].x, visiblePoints[0].y)
  
        for (let i = 1; i < visiblePoints.length; i++) {
          ctx.lineTo(visiblePoints[i].x, visiblePoints[i].y)
        }
  
        ctx.lineTo(visiblePoints[visiblePoints.length - 1].x, padding.top + chartHeight)
        ctx.closePath()
        ctx.fillStyle = gradient
        ctx.fill()
  
        // Desenhar a linha
        ctx.beginPath()
        ctx.moveTo(visiblePoints[0].x, visiblePoints[0].y)
  
        for (let i = 1; i < visiblePoints.length; i++) {
          ctx.lineTo(visiblePoints[i].x, visiblePoints[i].y)
        }
  
        ctx.strokeStyle = "#00c800"
        ctx.lineWidth = 2
        ctx.stroke()
  
        // Desenhar pontos de destaque
        if (progress === 1) {
          // Destacar apenas alguns pontos importantes
          const highlightIndices = [0, Math.floor(data.length / 2), data.length - 1]
  
          highlightIndices.forEach((index) => {
            if (index < visiblePoints.length) {
              ctx.beginPath()
              ctx.arc(visiblePoints[index].x, visiblePoints[index].y, 4, 0, Math.PI * 2)
              ctx.fillStyle = "#00c800"
              ctx.fill()
              ctx.strokeStyle = "#ffffff"
              ctx.lineWidth = 1
              ctx.stroke()
            }
          })
        }
      }
    }
  })
  
  // Função para animar os cards quando a página carrega
  function animateCardsOnLoad() {
    const cards = document.querySelectorAll(".jp_card")
    cards.forEach((card, index) => {
      card.style.opacity = "0"
      card.style.transform = "translateY(20px)"
  
      setTimeout(() => {
        card.style.transition = "opacity 0.5s ease"
        card.style.opacity = "1"
        card.style.transform = "translateY(0)"
      }, 100 * index)
    })
  }
  
  // Função para configurar a paginação
  function setupPagination() {
    const paginationItems = document.querySelectorAll(".jp_pagination-item")
    const paginationArrow = document.querySelector(".jp_pagination-arrow")
  
    // Dados de exemplo para cada página
    const pageData = [
      [
        { code: "#XXXX", seller: "Rafael", client: "Calebe", date: "02/08", value: "R$7500", commission: "R$750 (10%)" },
        { code: "#XXXX", seller: "Rafael", client: "Calebe", date: "02/08", value: "R$7500", commission: "R$750 (10%)" },
        { code: "#XXXX", seller: "Rafael", client: "Calebe", date: "02/08", value: "R$7500", commission: "R$750 (10%)" },
        { code: "#XXXX", seller: "Rafael", client: "Calebe", date: "02/08", value: "R$7500", commission: "R$750 (10%)" },
      ],
      [
        { code: "#YYYY", seller: "João", client: "Maria", date: "03/08", value: "R$5200", commission: "R$520 (10%)" },
        { code: "#YYYY", seller: "João", client: "Maria", date: "03/08", value: "R$5200", commission: "R$520 (10%)" },
        { code: "#YYYY", seller: "João", client: "Maria", date: "03/08", value: "R$5200", commission: "R$520 (10%)" },
        { code: "#YYYY", seller: "João", client: "Maria", date: "03/08", value: "R$5200", commission: "R$520 (10%)" },
      ],
      [
        { code: "#ZZZZ", seller: "Maria", client: "João", date: "04/08", value: "R$8300", commission: "R$830 (10%)" },
        { code: "#ZZZZ", seller: "Maria", client: "João", date: "04/08", value: "R$8300", commission: "R$830 (10%)" },
        { code: "#ZZZZ", seller: "Maria", client: "João", date: "04/08", value: "R$8300", commission: "R$830 (10%)" },
        { code: "#ZZZZ", seller: "Maria", client: "João", date: "04/08", value: "R$8300", commission: "R$830 (10%)" },
      ],
    ]
  
    let currentPage = 0
  
    // Função para atualizar a tabela com os dados da página atual
    function updateTable(pageIndex) {
      const tableBody = document.querySelector(".jp_sales-table tbody")
      tableBody.innerHTML = ""
  
      pageData[pageIndex].forEach((row) => {
        const tr = document.createElement("tr")
        tr.innerHTML = `
          <td>${row.code}</td>
          <td>${row.seller}</td>
          <td>${row.client}</td>
          <td>${row.date}</td>
          <td class="jp_value-column">${row.value}</td>
          <td class="jp_commission-column">${row.commission}</td>
        `
        tableBody.appendChild(tr)
      })
  
      // Atualizar a classe ativa na paginação
      paginationItems.forEach((item, index) => {
        if (index === pageIndex) {
          item.classList.add("active")
        } else {
          item.classList.remove("active")
        }
      })
  
      // Animar as linhas da tabela
      const rows = tableBody.querySelectorAll("tr")
      rows.forEach((row, index) => {
        row.style.opacity = "0"
        row.style.transform = "translateX(10px)"
  
        setTimeout(() => {
          row.style.transition = "opacity 0.3s ease, transform 0.3s ease"
          row.style.opacity = "1"
          row.style.transform = "translateX(0)"
        }, 50 * index)
      })
  
      currentPage = pageIndex
    }
  
    // Adicionar eventos de clique aos itens de paginação
    paginationItems.forEach((item, index) => {
      item.addEventListener("click", () => {
        updateTable(index)
      })
    })
  
    // Adicionar evento de clique à seta de paginação
    paginationArrow.addEventListener("click", () => {
      const nextPage = (currentPage + 1) % pageData.length
      updateTable(nextPage)
    })
  
    // Inicializar a tabela com a primeira página
    updateTable(0)
  }
  