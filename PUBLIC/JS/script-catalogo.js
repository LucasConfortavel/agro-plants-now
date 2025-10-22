let clicks_1 = 1;
let clicks_2 = 1;

function slideGo(qntProduto, indexArea) {
    let btn_go = document.getElementsByClassName("ym_slideGo")[indexArea];
    let btn_back = document.getElementsByClassName("ym_slideBack")[indexArea];
    let produtos = document.getElementsByClassName("ym_todos-produtos")[indexArea];

    let max_clicks = Math.ceil(qntProduto / 3);
    let clicks = (indexArea == 0) ? clicks_1 : clicks_2;

    if (clicks < max_clicks) {
        clicks++;
        let slides = 66 * (clicks - 1);
        produtos.style.transform = `translateX(-${slides}%)`;

        if (indexArea == 0) clicks_1 = clicks;
        else clicks_2 = clicks;

        btn_back.style.opacity = "1";
    }

    if (clicks >= max_clicks) {
        btn_go.style.opacity = "0";
    }
}

function slideBack(qntProduto, indexArea) {
    let btn_go = document.getElementsByClassName("ym_slideGo")[indexArea];
    let btn_back = document.getElementsByClassName("ym_slideBack")[indexArea];
    let produtos = document.getElementsByClassName("ym_todos-produtos")[indexArea];

    let clicks = (indexArea == 0) ? clicks_1 : clicks_2;

    if (clicks > 1) {
        clicks--;
        let slides = 66 * (clicks - 1);
        produtos.style.transform = `translateX(-${slides}%)`;

        if (indexArea == 0) clicks_1 = clicks;
        else clicks_2 = clicks;

        btn_go.style.opacity = "1"; 
    }

    if (clicks <= 1) {
        btn_back.style.opacity = "0";
    }
}


// Função para mostrar/ocultar categorias
function mostrar_categorias() {
    const options = document.querySelector('.ym_options');
    if (options.style.display === 'block') {
        options.style.display = 'none';
    } else {
        options.style.display = 'block';
    }
}

// Fechar menu de categorias ao clicar fora
document.addEventListener('click', function(event) {
    const select = document.querySelector('.ym_select');
    const options = document.querySelector('.ym_options');
    
    if (!select.contains(event.target) && !options.contains(event.target)) {
        options.style.display = 'none';
    }
});

// Função de pesquisa em tempo real
function inicializarPesquisa() {
    const inputPesquisa = document.getElementById('inputPesquisa');
    
    if (inputPesquisa) {
        inputPesquisa.addEventListener('input', function() {
            const termo = this.value.toLowerCase();
            
            // Filtrar produtos
            const produtos = document.querySelectorAll('#produtos-container .ym_cardProduto');
            produtos.forEach(produto => {
                const nome = produto.querySelector('.ym_nomeProduto').textContent.toLowerCase();
                const descricao = produto.querySelector('.ym_descricao').textContent.toLowerCase();
                
                if (nome.includes(termo) || descricao.includes(termo)) {
                    produto.style.display = 'flex';
                } else {
                    produto.style.display = 'none';
                }
            });
            
            // Filtrar serviços
            const servicos = document.querySelectorAll('#servicos-container .ym_cardProduto');
            servicos.forEach(servico => {
                const nome = servico.querySelector('.ym_nomeProduto').textContent.toLowerCase();
                const descricao = servico.querySelector('.ym_descricao').textContent.toLowerCase();
                
                if (nome.includes(termo) || descricao.includes(termo)) {
                    servico.style.display = 'flex';
                } else {
                    servico.style.display = 'none';
                }
            });
            
            // Resetar os slides quando pesquisar
            clicks_1 = 1;
            clicks_2 = 1;
            
            const areasProdutos = document.querySelectorAll('.ym_todos-produtos');
            areasProdutos.forEach(area => {
                area.style.transform = 'translateX(0)';
            });
            
            const botoesBack = document.querySelectorAll('.ym_slideBack');
            botoesBack.forEach(botao => {
                botao.style.opacity = '0';
            });
            
            const botoesGo = document.querySelectorAll('.ym_slideGo');
            botoesGo.forEach(botao => {
                botao.style.opacity = '1';
            });
        });
    }
}

// Inicializar quando o documento estiver carregado
document.addEventListener('DOMContentLoaded', function() {
    inicializarPesquisa();
    
    // Esconder o menu de opções inicialmente
    const options = document.querySelector('.ym_options');
    if (options) {
        options.style.display = 'none';
    }
});

//Função de busca genérica com ocultação de títulos
// ==============================
const inputPesquisa = document.getElementById('inputPesquisa');

if (inputPesquisa) {
  inputPesquisa.addEventListener('input', function () {
    const termo = this.value.toLowerCase();
    const cards = document.querySelectorAll('.ym_cardProduto');

    cards.forEach(card => {
      const nome = card.querySelector('.ym_nomeProduto').textContent.toLowerCase();
      const descricao = card.querySelector('.ym_descricao').textContent.toLowerCase();

      if (nome.includes(termo) || descricao.includes(termo)) {
        card.style.display = 'flex';
      } else {
        card.style.display = 'none';
      }
    });

    const categorias = document.querySelectorAll('.ym_areaProdutos');

    categorias.forEach(cat => {
      const visibleCards = cat.querySelectorAll('.ym_cardProduto[style*="display: flex"]').length;
      const titulo = cat.previousElementSibling; 

      if (visibleCards > 0) {
        cat.style.display = 'block';
        if (titulo && titulo.classList.contains('ym_titulo-produtos')) {
          titulo.style.display = 'block';
        }
      } else {
        cat.style.display = 'none';
        if (titulo && titulo.classList.contains('ym_titulo-produtos')) {
          titulo.style.display = 'none';
        }
      }
    });
  });
}
