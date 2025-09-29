const ctx = document.getElementById('grafico_adm').getContext('2d');
    const meuGrafico = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        datasets: [{
          label: 'Vendas',
          data: window.data_grafico,
          borderColor: 'rgba(39, 219, 54, 1)',
          backgroundColor: 'rgba(44, 171, 54, 0.23)',
          fill: true,
          tension: 0.1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: true,
            position: 'top',
          },
          title: {
            display: true,
            text: 'Vendas do ano'
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });



// Configurar a paginação
  setupPagination()



// Função para configurar a paginação
function setupPagination() {
  const paginationItems = document.querySelectorAll(".jp_pagination-item")
  const paginationArrow = document.querySelector(".jp_pagination-arrow")

  // Dados de exemplo para cada página
  const pageData = [
    [
      { code: "#XXXX", seller: "Rafael", client: "Bioest/ Líq/", date: "02/08", value: "R$7500", commission: "R$750 (10%)" },
      { code: "#XXXX", seller: "Rafael", client: "Bioest/ Líq/", date: "02/08", value: "R$7500", commission: "R$750 (10%)" },
      { code: "#XXXX", seller: "Rafael", client: "Bioest/ Líq/", date: "02/08", value: "R$7500", commission: "R$750 (10%)" },
      { code: "#XXXX", seller: "Rafael", client: "Bioest/ Líq/", date: "02/08", value: "R$7500", commission: "R$750 (10%)" },
    ],
    [
      { code: "#YYYY", seller: "João", client: "Bioest/ Líq/", date: "03/08", value: "R$5200", commission: "R$520 (10%)" },
      { code: "#YYYY", seller: "João", client: "Bioest/ Líq/", date: "03/08", value: "R$5200", commission: "R$520 (10%)" },
      { code: "#YYYY", seller: "João", client: "Bioest/ Líq/", date: "03/08", value: "R$5200", commission: "R$520 (10%)" },
      { code: "#YYYY", seller: "João", client: "Bioest/ Líq/", date: "03/08", value: "R$5200", commission: "R$520 (10%)" },
    ],
    [
      { code: "#ZZZZ", seller: "Maria", client: "Bioest/ Líq/", date: "04/08", value: "R$8300", commission: "R$830 (10%)" },
      { code: "#ZZZZ", seller: "Maria", client: "Bioest/ Líq/", date: "04/08", value: "R$8300", commission: "R$830 (10%)" },
      { code: "#ZZZZ", seller: "Maria", client: "Bioest/ Líq/", date: "04/08", value: "R$8300", commission: "R$830 (10%)" },
      { code: "#ZZZZ", seller: "Maria", client: "Bioest/ Líq/", date: "04/08", value: "R$8300", commission: "R$830 (10%)" },
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
