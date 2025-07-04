<?php 
include "../../INCLUDE/Menu_adm.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <link rel="stylesheet" href="../../PUBLIC/css/Rel.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    
<main class="jp_main-content">
    <h1 class="ym_titulo">Relatório de Vendas</h1>

    <div class="po-card">
      <div class="po-tabs">
        <div class="po-tab po-active" data-tab="po-vendas" onclick="switchTab('po-vendas')">Vendas</div>
        <div class="po-tab" data-tab="po-comissoes" onclick="switchTab('po-comissoes')">Comissões</div>
      </div>

      <div class="po-tab-content">
        <button class="po-export-button">
          Exportar como
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
            <polyline points="7 10 12 15 17 10"></polyline>
            <line x1="12" y1="15" x2="12" y2="3"></line>
          </svg>
        </button>

        <!-- Relatório de Vendas -->
        <div id="po-vendas-section" class="po-content-section po-active">
          <h3 style="margin-bottom: 15px;">Registro de Vendas</h3>

          <div class="po-filter-tempo">
            <select>
              <option>Último mês</option>
              <option>Último trimestre</option>
              <option>Último ano</option>
            </select>
          </div>

          <table>
            <thead>
              <tr>
                <th>Data</th>
                <th>Vendedor</th>
                <th>Produto/Serviço</th>
                <th>Valor da venda</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>01/08</td>
                <td>João Silva</td>
                <td>Refrigerantes</td>
                <td>R$ 320,00</td>
              </tr>
              <tr>
                <td>01/08</td>
                <td>José Ferraz</td>
                <td>Instalação de App</td>
                <td>R$ 700,00</td>
              </tr>
              <tr>
                <td>01/08</td>
                <td>Carlos Eduardo</td>
                <td>Serviços Variados</td>
                <td>R$ 980,00</td>
              </tr>
              <tr>
                <td>01/08</td>
                <td>Paulo Otávio</td>
                <td>Compras de praga</td>
                <td>R$ 450,00</td>
              </tr>
              <tr>
                <td>01/08</td>
                <td>Eduardo Camões</td>
                <td>Franquia - inicial</td>
                <td>R$ 350,00</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Relatório de Comissões -->
        <div id="po-comissoes-section" class="po-content-section">
          <h3 style="margin-bottom: 15px;">Registro de Comissões</h3>

          <div class="po-filter-tempo">
            <select>
              <option>Último mês</option>
              <option>Último trimestre</option>
              <option>Último ano</option>
            </select>
          </div>

          <table>
            <thead>
              <tr>
                <th>Data</th>
                <th>Vendedor</th>
                <th>Produto/Serviço</th>
                <th>Valor da Venda</th>
                <th>% Comissão</th>
                <th>Valor da Comissão</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>02/08</td>
                <td>João Silva</td>
                <td>Refrigerantes</td>
                <td>R$ 200,00</td>
                <td>10%</td>
                <td>R$ 20,00</td>
                <td><span class="po-status-badge">Pago</span></td>
              </tr>
              <tr>
                <td>02/08</td>
                <td>José Ferraz</td>
                <td>Instalação de App</td>
                <td>R$ 100,00</td>
                <td>10%</td>
                <td>R$ 10,00</td>
                <td><span class="po-status-badge">Pago</span></td>
              </tr>
              <tr>
                <td>02/08</td>
                <td>Carlos Eduardo</td>
                <td>Sementes tratadas</td>
                <td>R$ 800,00</td>
                <td>10%</td>
                <td>R$ 80,00</td>
                <td><span class="po-status-badge">Pago</span></td>
              </tr>
              <tr>
                <td>02/08</td>
                <td>Paulo Otávio</td>
                <td>Controle de praga</td>
                <td>R$ 500,00</td>
                <td>10%</td>
                <td>R$ 50,00</td>
                <td><span class="po-status-badge">Pago</span></td>
              </tr>
              <tr>
                <td>02/08</td>
                <td>Eduardo Camões</td>
                <td>Fungicida natural</td>
                <td>R$ 250,00</td>
                <td>10%</td>
                <td>R$ 25,00</td>
                <td><span class="po-status-badge">Pago</span></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="jp_page-navigation">
          <div class="jp_page-number active">1</div>
          <div class="jp_page-number">2</div>
          <div class="jp_page-number">3</div>
          <div class="jp_page-arrow">
              <i class="fas fa-arrow-right"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="po-dashboard">
      <!-- Gráficos para a seção de Vendas -->
      <div id="po-vendas-graficos" class="po-card po-grafico-container po-content-section po-active">
        <div class="po-tab-content">
          <div class="po-grafico-header">
            <div class="po-grafico-titulo">Gráfico de vendas</div>
            <div class="po-filter-tempo">
              <select>
                <option>Último mês</option>
                <option>Último trimestre</option>
                <option>Último ano</option>
              </select>
            </div>
          </div>

          <div class="po-grafico" id="po-vendas-grafico">
            <div class="po-y-eixo">
              <div class="po-y-eixo1">1000</div>
              <div class="po-y-eixo1">90</div>
              <div class="po-y-eixo1">80</div>
              <div class="po-y-eixo1">70</div>
              <div class="po-y-eixo1">60</div>
              <div class="po-y-eixo1">50</div>
              <div class="po-y-eixo1">40</div>
              <div class="po-y-eixo1">30</div>
              <div class="po-y-eixo1">20</div>
              <div class="po-y-eixo1">10</div>
              <div class="po-y-eixo1">00</div>
            </div>
            <div class="po-grafico-grid">
              <div class="po-linha-pontilhada"></div>
              <div class="po-linha-pontilhada"></div>
              <div class="po-linha-pontilhada"></div>
              <div class="po-linha-pontilhada"></div>
              <div class="po-linha-pontilhada"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Gráficos para a seção de Comissões -->
      <div id="po-comissoes-graficos" class="po-card po-grafico-container po-content-section">
        <div class="tab-content">
          <div class="po-grafico-header">
            <div class="po-grafico-titulo">Gastos com Comissões</div>
            <div class="po-btn-grafico">
              <a class="po-export-button po-button" href="../pop-up/pop-up-comissao.php">
                Calcular Comissão
              </a>
              <div class="po-filter-tempo po-button"> 
                <select>
                  <option>Último mês</option>
                  <option>Último trimestre</option>
                  <option>Último ano</option>
                </select>
              </div>
            </div>
          </div>

          <div class="po-linha-grafico">
            <div class="po-y-eixo">
              <div class="po-y-eixo1">R$2.950</div>
              <div class="po-y-eixo1">R$2.800</div>
              <div class="po-y-eixo1">R$2.650</div>
              <div class="po-y-eixo1">R$2.500</div>
              <div class="po-y-eixo1">R$2.350</div>
              <div class="po-y-eixo1">R$2.200</div>
              <div class="po-y-eixo1">R$2.050</div>
              <div class="po-y-eixo1">R$1.900</div>
              <div class="po-y-eixo1">R$1.750</div>
            </div>
            <canvas id="po-comissao-grafico" class="po-linha-grafico-canvas"></canvas>
            <div class="po-tooltip" id="po-grafico-tooltip"></div>
          </div>
        </div>
      </div>

      <div class="po-card po-estatos-container">
        <div class="po-tab-content">
          <div class="po-circular-progress">
            <div class="po-progress-value">60%</div>
          </div>
          <div class="po-progress-label">Taxa de aumento</div>

          <div class="po-mini-grafico" id="po-mini-grafico"></div>
          <div class="po-mes-label">Agosto</div>
        </div>
      </div>
    </div>
  </div>

</main>


<script src="../../PUBLIC/JS/Rel.js"></script>
<script src="../../PUBLIC/JS/script.js"></script>


</body>
</html>