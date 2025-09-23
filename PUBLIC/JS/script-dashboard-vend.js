document.addEventListener("DOMContentLoaded", () => {
    // Configuração do gráfico
    const canvas = document.getElementById("vendorSalesChart")
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
    animateMetricsOnLoad()
  
    // Função para redimensionar o canvas
    function resizeCanvas() {
      const container = canvas.parentElement
      canvas.width = container.offsetWidth
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
        top: 20,
        right: 20,
        bottom: 30,
        left: 20,
      }
  
      const chartWidth = canvas.width - padding.left - padding.right
      const chartHeight = canvas.height - padding.top - padding.bottom
  
      // Encontrar valores mínimos e máximos
      const maxValue = Math.max(...data)
      const minValue = Math.min(...data) * 0.8
      const valueRange = maxValue - minValue
  
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
        // Desenhar a área sob a linha com gradiente azul
        const gradient = ctx.createLinearGradient(0, padding.top, 0, padding.top + chartHeight)
        gradient.addColorStop(0, "rgba(26, 133, 255, 0.7)")
        gradient.addColorStop(1, "rgba(26, 133, 255, 0.1)")
  
        // Criar um caminho para a área preenchida
        ctx.beginPath()
  
        // Começar no ponto inferior esquerdo
        ctx.moveTo(visiblePoints[0].x, padding.top + chartHeight)
  
        // Adicionar o primeiro ponto
        ctx.lineTo(visiblePoints[0].x, visiblePoints[0].y)
  
        // Criar uma curva suave através de todos os pontos
        for (let i = 0; i < visiblePoints.length - 1; i++) {
          const xc = (visiblePoints[i].x + visiblePoints[i + 1].x) / 2
          const yc = (visiblePoints[i].y + visiblePoints[i + 1].y) / 2
          ctx.quadraticCurveTo(visiblePoints[i].x, visiblePoints[i].y, xc, yc)
        }
  
        // Adicionar o último ponto
        if (visiblePoints.length > 1) {
          ctx.lineTo(visiblePoints[visiblePoints.length - 1].x, visiblePoints[visiblePoints.length - 1].y)
        }
  
        // Completar o caminho até o canto inferior direito
        ctx.lineTo(visiblePoints[visiblePoints.length - 1].x, padding.top + chartHeight)
  
        // Fechar o caminho
        ctx.closePath()
  
        // Preencher a área
        ctx.fillStyle = gradient
        ctx.fill()
  
        // Desenhar a linha do gráfico
        ctx.beginPath()
        ctx.moveTo(visiblePoints[0].x, visiblePoints[0].y)
  
        // Criar uma curva suave através de todos os pontos
        for (let i = 0; i < visiblePoints.length - 1; i++) {
          const xc = (visiblePoints[i].x + visiblePoints[i + 1].x) / 2
          const yc = (visiblePoints[i].y + visiblePoints[i + 1].y) / 2
          ctx.quadraticCurveTo(visiblePoints[i].x, visiblePoints[i].y, xc, yc)
        }
  
        // Configurar o estilo da linha
        ctx.strokeStyle = "#1a85ff"
        ctx.lineWidth = 2
        ctx.stroke()
      }
    }
  })
  
  