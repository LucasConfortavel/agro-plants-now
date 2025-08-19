        
        const salesData = {
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
      };

      const commissionsData = {
          1: [
              { data: "02/08", vendedor: "João Silva", produto: "Refrigerantes", valorVenda: "R$ 200,00", percentual: "10%", valorComissao: "R$ 20,00", status: "Pago" },
              { data: "02/08", vendedor: "José Ferraz", produto: "Instalação de App", valorVenda: "R$ 100,00", percentual: "10%", valorComissao: "R$ 10,00", status: "Pago" },
              { data: "02/08", vendedor: "Carlos Eduardo", produto: "Sementes tratadas", valorVenda: "R$ 800,00", percentual: "10%", valorComissao: "R$ 80,00", status: "Pago" },
              { data: "02/08", vendedor: "Paulo Otávio", produto: "Controle de praga", valorVenda: "R$ 500,00", percentual: "10%", valorComissao: "R$ 50,00", status: "Pago" },
              { data: "02/08", vendedor: "Eduardo Camões", produto: "Fungicida natural", valorVenda: "R$ 250,00", percentual: "10%", valorComissao: "R$ 25,00", status: "Pago" },
          ],
          2: [
              { data: "03/08", vendedor: "Maria Santos", produto: "Fertilizantes", valorVenda: "R$ 890,00", percentual: "12%", valorComissao: "R$ 106,80", status: "Pendente" },
              { data: "03/08", vendedor: "Pedro Lima", produto: "Sementes Premium", valorVenda: "R$ 1.200,00", percentual: "15%", valorComissao: "R$ 180,00", status: "Pago" },
              { data: "03/08", vendedor: "Ana Costa", produto: "Equipamentos", valorVenda: "R$ 2.100,00", percentual: "8%", valorComissao: "R$ 168,00", status: "Pago" },
              { data: "03/08", vendedor: "Roberto Silva", produto: "Consultoria", valorVenda: "R$ 750,00", percentual: "20%", valorComissao: "R$ 150,00", status: "Pendente" },
              { data: "03/08", vendedor: "Lucia Mendes", produto: "Treinamento", valorVenda: "R$ 600,00", percentual: "15%", valorComissao: "R$ 90,00", status: "Pago" },
          ],
          3: [
              { data: "04/08", vendedor: "Fernando Rocha", produto: "Defensivos", valorVenda: "R$ 1.500,00", percentual: "10%", valorComissao: "R$ 150,00", status: "Pago" },
              { data: "04/08", vendedor: "Carla Dias", produto: "Irrigação", valorVenda: "R$ 3.200,00", percentual: "5%", valorComissao: "R$ 160,00", status: "Pendente" },
              { data: "04/08", vendedor: "Marcos Pereira", produto: "Análise de Solo", valorVenda: "R$ 400,00", percentual: "25%", valorComissao: "R$ 100,00", status: "Pago" },
              { data: "04/08", vendedor: "Sandra Oliveira", produto: "Mudas", valorVenda: "R$ 850,00", percentual: "12%", valorComissao: "R$ 102,00", status: "Pago" },
              { data: "04/08", vendedor: "Ricardo Alves", produto: "Adubos Orgânicos", valorVenda: "R$ 1.100,00", percentual: "10%", valorComissao: "R$ 110,00", status: "Pendente" },
          ],
      };

      
      const salesChartData = [35, 42, 25, 50, 55, 20, 15, 45, 80, 50, 20, 35];
      const commissionsChartData = [2100, 2250, 2700, 2300, 2200, 2350, 2400, 2500, 2900, 2800, 2600, 2700];
      const months = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];

     
      let activeTab = 'sales';
      let currentPage = 1;
      let mainChart = null;
      let progressChart = null;

  
      document.addEventListener('DOMContentLoaded', function() {
          initializeEventListeners();
          updateTable();
          initializeCharts();
          createMiniChart();
      });

      function initializeEventListeners() {
          
          document.querySelectorAll('.po-tab-button').forEach(button => {
              button.addEventListener('click', function() {
                  const tab = this.dataset.tab;
                  switchTab(tab);
              });
          });

      
          document.querySelectorAll('.po-page-btn[data-page]').forEach(button => {
              button.addEventListener('click', function() {
                  const page = parseInt(this.dataset.page);
                  changePage(page);
              });
          });

          document.getElementById('po-next-btn').addEventListener('click', function() {
              if (currentPage < 3) {
                  changePage(currentPage + 1);
              }
          });
      }

      function switchTab(tab) {
          activeTab = tab;
          currentPage = 1;

        
          document.querySelectorAll('.po-tab-button').forEach(button => {
              button.classList.toggle('po-active', button.dataset.tab === tab);
          });

         
          updateTable();
          updateChart();
          
          
          document.getElementById('po-table-title').textContent = 
              tab === 'sales' ? 'Registro de Vendas' : 'Registro de Comissões';
          document.getElementById('po-chart-title').textContent = 
              tab === 'sales' ? 'Gráfico de vendas' : 'Gastos com Comissões';
          document.getElementById('po-calc-btn').style.display = 
              tab === 'commissions' ? 'flex' : 'none';
      }

      function changePage(page) {
          if (page >= 1 && page <= 3) {
              currentPage = page;
              updateTable();
              
              
              document.querySelectorAll('.po-page-btn[data-page]').forEach(button => {
                  button.classList.toggle('po-active', parseInt(button.dataset.page) === page);
              });
              
              document.getElementById('po-next-btn').disabled = page >= 3;
          }
      }

      function updateTable() {
          const data = activeTab === 'sales' ? salesData[currentPage] : commissionsData[currentPage];
          const tableHead = document.getElementById('po-table-head');
          const tableBody = document.getElementById('po-table-body');

         
          if (activeTab === 'sales') {
              tableHead.innerHTML = `
                  <tr>
                      <th>Data</th>
                      <th>Vendedor</th>
                      <th>Produto/Serviço</th>
                      <th>Valor da venda</th>
                  </tr>
              `;
          } else {
              tableHead.innerHTML = `
                  <tr>
                      <th>Data</th>
                      <th>Vendedor</th>
                      <th>Produto/Serviço</th>
                      <th>Valor da Venda</th>
                      <th>% Comissão</th>
                      <th>Valor da Comissão</th>
                      <th>Status</th>
                  </tr>
              `;
          }

         
          tableBody.innerHTML = data.map(item => {
              if (activeTab === 'sales') {
                  return `
                      <tr>
                          <td>${item.data}</td>
                          <td>${item.vendedor}</td>
                          <td>${item.produto}</td>
                          <td>${item.valor}</td>
                      </tr>
                  `;
              } else {
                  return `
                      <tr>
                          <td>${item.data}</td>
                          <td>${item.vendedor}</td>
                          <td>${item.produto}</td>
                          <td>${item.valorVenda}</td>
                          <td>${item.percentual}</td>
                          <td>${item.valorComissao}</td>
                          <td><span class="po-badge ${item.status === 'Pago' ? 'po-paid' : 'po-pending'}">${item.status}</span></td>
                      </tr>
                  `;
              }
          }).join('');
      }

      function initializeCharts() {
         
          const ctx = document.getElementById('po-main-chart').getContext('2d');
          mainChart = new Chart(ctx, {
              type: activeTab === 'sales' ? 'bar' : 'line',
              data: {
                  labels: months,
                  datasets: [{
                      data: activeTab === 'sales' ? salesChartData : commissionsChartData,
                      backgroundColor: '#16a34a',
                      borderColor: '#16a34a',
                      borderWidth: 3,
                      fill: false,
                      tension: 0.4
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                      legend: {
                          display: false
                      }
                  },
                  scales: {
                      y: {
                          beginAtZero: true,
                          grid: {
                              color: '#f0f0f0'
                          },
                          ticks: {
                              color: '#666',
                              callback: function(value) {
                                  return activeTab === 'commissions' ? `R$ ${value}` : value;
                              }
                          }
                      },
                      x: {
                          grid: {
                              color: '#f0f0f0'
                          },
                          ticks: {
                              color: '#666'
                          }
                      }
                  }
              }
          });

          
          const progressCtx = document.getElementById('po-progress-chart').getContext('2d');
          progressChart = new Chart(progressCtx, {
              type: 'doughnut',
              data: {
                  datasets: [{
                      data: [60, 40],
                      backgroundColor: ['#4CAF50', '#E0E0E0'],
                      borderWidth: 0
                  }]
              },
              options: {
                  responsive: false,
                  maintainAspectRatio: false,
                  cutout: '70%',
                  plugins: {
                      legend: {
                          display: false
                      }
                  }
              }
          });
      }

      function updateChart() {
          if (mainChart) {
              mainChart.destroy();
          }
          initializeCharts();
      }

      function createMiniChart() {
          const miniChart = document.getElementById('po-mini-chart');
          const data = [25, 30, 20, 35, 40, 30, 45, 50, 35, 40, 45, 55];
          const maxValue = Math.max(...data);
          
          miniChart.innerHTML = data.map(value => 
              `<div class="po-mini-bar" style="height: ${(value / maxValue) * 100}%"></div>`
          ).join('');
      }