
const clientes = [
    { id: 1, nome: "Rafael Germinari", data_cadastro: "12/08" },
    { id: 2, nome: "Calebe Lemos", data_cadastro: "12/08" },
    { id: 3, nome: "Ederson Costa", data_cadastro: "12/08" },
    { id: 4, nome: "Enilda Rosa", data_cadastro: "12/08" },
    { id: 5, nome: "Thiago Almeida", data_cadastro: "12/08" },
    { id: 6, nome: "Pamela Ferreira", data_cadastro: "12/08" },
    { id: 7, nome: "João Silva", data_cadastro: "13/08" },
    { id: 8, nome: "Maria Santos", data_cadastro: "13/08" },
    { id: 9, nome: "Pedro Oliveira", data_cadastro: "14/08" },
    { id: 10, nome: "Ana Costa", data_cadastro: "14/08" },
    { id: 11, nome: "Carlos Pereira", data_cadastro: "15/08" },
    { id: 12, nome: "Lucia Fernandes", data_cadastro: "15/08" },
    { id: 13, nome: "Roberto Lima", data_cadastro: "16/08" },
    { id: 14, nome: "Sandra Martins", data_cadastro: "16/08" },
    { id: 15, nome: "Fernando Rocha", data_cadastro: "17/08" },
    { id: 16, nome: "Carla Souza", data_cadastro: "17/08" },
    { id: 17, nome: "Marcos Ribeiro", data_cadastro: "18/08" },
    { id: 18, nome: "Patricia Gomes", data_cadastro: "18/08" },
  ]
  
  const itensPorPagina = 6
  const totalPaginas = Math.ceil(clientes.length / itensPorPagina)
  let paginaAtual = 1
  
  function exibirClientes(pagina) {
    const inicio = (pagina - 1) * itensPorPagina
    const fim = inicio + itensPorPagina
    const clientesPagina = clientes.slice(inicio, fim)
  
    const tbody = document.getElementById("clientes-tbody")
    tbody.innerHTML = ""
  
    clientesPagina.forEach((cliente) => {
      const tr = document.createElement("tr")
      tr.innerHTML = `
              <td><i class="fa-solid fa-user"></i> ${cliente.nome}</td>
              <td>${cliente.data_cadastro}</td>
              <td><button class="jc_btn-info">i</button></td>
          `
      tbody.appendChild(tr)
    })
  
    atualizarPaginacao()
  }
  
  function atualizarPaginacao() {
    const numerosPaginacao = document.getElementById("numeros-paginacao")
    numerosPaginacao.innerHTML = ""
  
    const maxPaginas = Math.min(totalPaginas, Infinity)
    for (let i = 1; i <= maxPaginas; i++) {
      const btn = document.createElement("button")
      btn.textContent = i
      btn.className = "jc_btn-paginacao"
      if (i === paginaAtual) {
        btn.classList.add("ativo")
      }
      btn.onclick = () => irParaPagina(i)
      numerosPaginacao.appendChild(btn)
    }
  
    document.getElementById("btn-prev").style.display = paginaAtual > 1 ? "inline-block" : "none"
    document.getElementById("btn-next").style.display = paginaAtual < totalPaginas ? "inline-block" : "none"
  }
  
  function irParaPagina(pagina) {
    if (pagina >= 1 && pagina <= totalPaginas) {
      paginaAtual = pagina
      exibirClientes(paginaAtual)
    }
  }
  
  function proximaPagina() {
    if (paginaAtual < totalPaginas) {
      irParaPagina(paginaAtual + 1)
    }
  }
  
  function paginaAnterior() {
    if (paginaAtual > 1) {
      irParaPagina(paginaAtual - 1)
    }
  }
  
  document.addEventListener("DOMContentLoaded", () => {
    exibirClientes(1)
  })
  