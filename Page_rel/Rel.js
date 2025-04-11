const salesData = [
    { month: 'Jan', value: 35 },
    { month: 'Fev', value: 42 },
    { month: 'Mar', value: 25 },
    { month: 'Abr', value: 50 },
    { month: 'Mai', value: 55 },
    { month: 'Jun', value: 20 },
    { month: 'Jul', value: 15 },
    { month: 'Ago', value: 45 },
    { month: 'Set', value: 80 },
    { month: 'Out', value: 50 },
    { month: 'Nov', value: 20 },
    { month: 'Dez', value: 35 }
];

const commissionData = [
    { month: 'Jan', value: 2100 },
    { month: 'Fev', value: 2250 },
    { month: 'Mar', value: 2700 },
    { month: 'Abr', value: 2300 },
    { month: 'Mai', value: 2200 },
    { month: 'Jun', value: 2350 },
    { month: 'Jul', value: 2400 },
    { month: 'Ago', value: 2500 },
    { month: 'Set', value: 2900 },
    { month: 'Out', value: 2800 },
    { month: 'Nov', value: 2600 },
    { month: 'Dez', value: 2700 }
];

const miniChartData = [
    25, 30, 20, 35, 40, 30, 45, 50, 35, 40, 45, 55
];

function createBarChart() {
    const chartContainer = document.getElementById('vendas-grafico');
    while (chartContainer.children.length > 2) {
        chartContainer.removeChild(chartContainer.lastChild);
    }
    
    const maxValue = Math.max(...salesData.map(item => item.value));
    
    salesData.forEach(item => {
        const barHeight = (item.value / maxValue) * 200;
        
        const bar = document.createElement('div');
        bar.className = 'barra';
        bar.style.height = `${barHeight}px`;
        
        const label = document.createElement('div');
        label.className = 'barra-label';
        label.textContent = item.month;
        
        bar.appendChild(label);
        chartContainer.appendChild(bar);
    });
}

function createLineChart() {
    const canvas = document.getElementById('comissao-grafico');
    const ctx = canvas.getContext('2d');
    const tooltip = document.getElementById('grafico-tooltip');
    
    canvas.width = canvas.parentElement.clientWidth - 40;
    canvas.height = canvas.parentElement.clientHeight - 30;
    
    const width = canvas.width;
    const height = canvas.height;
    
    ctx.clearRect(0, 0, width, height);
    
    const maxValue = Math.max(...commissionData.map(item => item.value));
    const minValue = Math.min(...commissionData.map(item => item.value));
    const range = maxValue - minValue;
    
    ctx.beginPath();
    ctx.strokeStyle = '#4CAF50';
    ctx.lineWidth = 3;
    
    commissionData.forEach((item, index) => {
        const x = (index / (commissionData.length - 1)) * width;
        const y = height - ((item.value - minValue) / range) * height;
        
        if (index === 0) {
            ctx.moveTo(x, y);
        } else {
            ctx.lineTo(x, y);
        }
    });
    
    ctx.stroke();
    
    commissionData.forEach((item, index) => {
        const x = (index / (commissionData.length - 1)) * width;
        const y = height - ((item.value - minValue) / range) * height;
        
        ctx.beginPath();
        ctx.arc(x, y, 5, 0, Math.PI * 2);
        ctx.fillStyle = '#4CAF50';
        ctx.fill();
        ctx.strokeStyle = 'white';
        ctx.lineWidth = 2;
        ctx.stroke();
    });
    
    ctx.fillStyle = '#999';
    ctx.font = '10px Arial';
    ctx.textAlign = 'center';
    
    commissionData.forEach((item, index) => {
        const x = (index / (commissionData.length - 1)) * width;
        ctx.fillText(item.month, x, height + 15);
    });
    
    canvas.addEventListener('mousemove', function(e) {
        const rect = canvas.getBoundingClientRect();
        const mouseX = e.clientX - rect.left;
        
        let closestIndex = 0;
        let closestDistance = Infinity;
        
        commissionData.forEach((item, index) => {
            const x = (index / (commissionData.length - 1)) * width;
            const distance = Math.abs(mouseX - x);
            
            if (distance < closestDistance) {
                closestDistance = distance;
                closestIndex = index;
            }
        });
        
        if (closestDistance < 30) {
            const item = commissionData[closestIndex];
            const x = (closestIndex / (commissionData.length - 1)) * width;
            const y = height - ((item.value - minValue) / range) * height;
            
            tooltip.style.display = 'block';
            tooltip.style.left = (x + 10) + 'px';
            tooltip.style.top = (y - 30) + 'px';
            tooltip.textContent = `R$ ${item.value.toFixed(2)}`;
            
            ctx.clearRect(0, 0, width, height);
            
            ctx.beginPath();
            ctx.strokeStyle = '#4CAF50';
            ctx.lineWidth = 3;
            
            commissionData.forEach((item, index) => {
                const x = (index / (commissionData.length - 1)) * width;
                const y = height - ((item.value - minValue) / range) * height;
                
                if (index === 0) {
                    ctx.moveTo(x, y);
                } else {
                    ctx.lineTo(x, y);
                }
            });
            
            ctx.stroke();
            
            commissionData.forEach((item, index) => {
                const x = (index / (commissionData.length - 1)) * width;
                const y = height - ((item.value - minValue) / range) * height;
                
                ctx.beginPath();
                ctx.arc(x, y, index === closestIndex ? 7 : 5, 0, Math.PI * 2);
                ctx.fillStyle = index === closestIndex ? '#2E7D32' : '#4CAF50';
                ctx.fill();
                ctx.strokeStyle = 'white';
                ctx.lineWidth = 2;
                ctx.stroke();
            });
            
            ctx.fillStyle = '#999';
            ctx.font = '10px Arial';
            ctx.textAlign = 'center';
            
            commissionData.forEach((item, index) => {
                const x = (index / (commissionData.length - 1)) * width;
                ctx.fillText(item.month, x, height + 15);
            });
        } else {
            tooltip.style.display = 'none';
        }
    });
    
    canvas.addEventListener('mouseout', function() {
        tooltip.style.display = 'none';
    });
}

function createMiniChart() {
    const miniChartContainer = document.getElementById('mini-grafico');

    miniChartContainer.innerHTML = '';
    
    const maxValue = Math.max(...miniChartData);
    
    miniChartData.forEach(value => {
        const barHeight = (value / maxValue) * 50;
        
        const bar = document.createElement('div');
        bar.className = 'mini-barra';
        bar.style.height = `${barHeight}px`;
        
        miniChartContainer.appendChild(bar);
    });
}

function switchTab(tabName) {
console.log("Trocando para a aba:", tabName);

const pageTitle = document.getElementById('page-title');
pageTitle.textContent = tabName === 'vendas' ? 'Relatório de Vendas' : 'Relatório de Comissões';

document.querySelectorAll('.tab').forEach(tab => {
tab.classList.remove('active');
});
document.querySelector(`.tab[data-tab="${tabName}"]`).classList.add('active');

document.querySelectorAll('.content-section').forEach(section => {
section.classList.remove('active');
});

if (tabName === 'vendas') {
document.getElementById('vendas-section').classList.add('active');
document.getElementById('vendas-graficos').classList.add('active');
createBarChart();
} else {
document.getElementById('comissoes-section').classList.add('active');
document.getElementById('comissoes-graficos').classList.add('active');
createLineChart();
}
}

window.onload = function() {
    createBarChart();
    createMiniChart();
    
    const paginationItems = document.querySelectorAll('.paginacao span');
    paginationItems.forEach(item => {
        item.addEventListener('click', function() {
            paginationItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    createLineChart();
};

window.addEventListener('resize', function() {
    if (document.getElementById('comissoes-graficos').classList.contains('active')) {
        createLineChart();
    }
});

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