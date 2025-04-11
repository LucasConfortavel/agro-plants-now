const graficoMaiorValor = [
    { month: 'Jan', valor: 35 },
    { month: 'Fev', valor: 42 },
    { month: 'Mar', valor: 25 },
    { month: 'Abr', valor: 50 },
    { month: 'Mai', valor: 55 },
    { month: 'Jun', valor: 20 },
    { month: 'Jul', valor: 15 },
    { month: 'Ago', valor: 90 },
    { month: 'Set', valor: 45 },
    { month: 'Out', valor: 50 },
    { month: 'Nov', valor: 20 },
    { month: 'Dez', valor: 35 }
];

const miniGraficosValores = [
    35, 42, 25, 50, 55, 20, 15, 90, 45, 50, 20, 35
];

function criarbarraGrafico() {
    const chartContainer = document.getElementById('vendas-grafico');
    const maxValor = Math.max(...graficoMaiorValor.map(item => item.valor));
    
    graficoMaiorValor.forEach(item => {
        const barraTamanho = (item.valor / maxValor) * 235;
        
        const bar = document.createElement('div');
        bar.className = 'bar';
        bar.style.height = `${barraTamanho}px`;
        
        const label = document.createElement('div');
        label.className = 'bar-label';
        label.textContent = item.month;
        
        bar.appendChild(label);
        chartContainer.appendChild(bar);
    });
}

function cirarMiniGrafico() {
    const miniChartContainer = document.getElementById('mini-grafico');
    const maxValor = Math.max(...miniGraficosValores);
    
    miniGraficosValores.forEach(valor => {
        const barraTamanho = (valor / maxValor) * 50;
        
        const bar = document.createElement('div');
        bar.className = 'mini-bar';
        bar.style.height = `${barraTamanho}px`;
        
        miniChartContainer.appendChild(bar);
    });
}

window.onload = function() {
    criarbarraGrafico();
    cirarMiniGrafico();
    

    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
    

    const paginacaoItems = document.querySelectorAll('.paginacao span');
    paginacaoItems.forEach(item => {
        item.addEventListener('click', function() {
            paginacaoItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });
};

document.addEventListener('DOMContentLoaded', function() {
    const hamburgerMenu = document.querySelector('.jp_hamburger-menu');
    const sidebar = document.querySelector('.jp_sidebar');
    const overlay = document.querySelector('.jp_overlay');
    
    hamburgerMenu.addEventListener('click', function() {
        hamburgerMenu.classList.toggle('active');
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    });

   

    overlay.addEventListener('click', function() {
        hamburgerMenu.classList.remove('active');
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    });

    document.addEventListener('click', function(event) {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickInsideHamburger = hamburgerMenu.contains(event.target);
        
        if (!isClickInsideSidebar && !isClickInsideHamburger && sidebar.classList.contains('active')) {
            hamburgerMenu.classList.remove('active');
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }
    });
});