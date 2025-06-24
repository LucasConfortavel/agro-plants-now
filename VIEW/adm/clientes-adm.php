<?php
    include "../../INCLUDE/btn-notificacao.php";
    include "../../INCLUDE/Menu_vend.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Clientes</title>
  <link rel="stylesheet" href="../../PUBLIC/CSS/ajustes-adm.css">
  <link rel="stylesheet" href="../../PUBLIC/CSS/style_menu.css">
  <link rel="stylesheet" href="../../PUBLIC/css/clientes-adm.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="clientes-adm.css">

</head>
<body>
  <main class="jp_main-content">
    <div class="jc_content">
      
      <div class="jc_header">
        <button class="jc_btn-remover">Remover cliente</button>
        <input type="text" class="jc_search-input" placeholder="Pesquise por um cliente" />
        <button class="jc_btn-cadastrar">Cadastrar cliente</button>
      </div>

      <table class="jc_tabela-clientes">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Data de cadastro</th>
            
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><i class="fa-solid fa-user"></i> Rafael Germinari</td>
            <td>12/08</td>
            <td><button class="jc_btn-info">i</button></td>
          </tr>
          <tr>
            <td><i class="fa-solid fa-user"></i> Calebe Lemos</td>
            <td>12/08</td>
            <td><button class="jc_btn-info">i</button></td>
          </tr>
          <tr>
            <td><i class="fa-solid fa-user"></i> Ederson Costa</td>
            <td>12/08</td>
            <td><button class="jc_btn-info">i</button></td>
          </tr>
          <tr>
            <td><i class="fa-solid fa-user"></i> Enilda Rosa</td>
            <td>12/08</td>
            <td><button class="jc_btn-info">i</button></td>
          </tr>
          <tr>
            <td><i class="fa-solid fa-user"></i> Thiago Almeida</td>
            <td>12/08</td>
            <td><button class="jc_btn-info">i</button></td>
          </tr>
          <tr>
            <td><i class="fa-solid fa-user"></i> Pamela Ferreira</td>
            <td>12/08</td>
            <td><button class="jc_btn-info">i</button></td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3">
              <div class="jc_paginacao">
                <span>1</span>
                <span>2</span>
                <span>3</span>
                <span>→</span>
              </div>
            </td>
          </tr>
        </tfoot>
      </table>

    </div>
  </main>
</body>
</html> 