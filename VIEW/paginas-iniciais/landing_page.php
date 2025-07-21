<?php
include "../../INCLUDE/Menu_superior.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link rel="stylesheet" href="../../PUBLIC/css/style_menu_superior.css">
     <link rel="stylesheet" href="../../PUBLIC/css/landing_pg.css">
</head>
<body>
    
    <main class="jp-main-content">
        <!-- Seção Hero -->
        <section class="er_imagem">
            <img src="../../PUBLIC/img/img_home.png" alt="Imagem de fundo do agronegócio" class="img-lp">
            <div class="img-container">
                <h1 class="er_texto">Seja um parceiro na maior rede de distribuição de insumos agrícolas do Brasil</h1>
                <div class="er_btn-sonic">
                    <button class="er_btn-sobre-nos">
                        <a href="sobre_nos.php">Sobre-Nós</a>
                    </button>
                </div>
            </div>
        </section>

        <!-- Seção Carrossel -->
        <section class="er_carrosel-box">
            <div class="carousel-container">
                <h2 class="carousel-title">Mais de 100 Produtos Disponíveis</h2>

                <div class="carousel-wrapper">
                    <button class="carousel-btn prev" onclick="moveCarousel(-1)" aria-label="Anterior">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <div class="carousel-content" id="carouselContent">
                        <div class="product-card">
                            <img src="../../PUBLIC/img/baitola.webp" alt="Fertilizantes" class="product-image">
                            <div class="product-info">
                                <h3>Fertilizantes</h3>
                                <p>Nutrição completa para suas culturas</p>
                            </div>
                        </div>

                        <div class="product-card">
                            <img src="../../PUBLIC/img/baitola2.jpg" alt="Defensivos" class="product-image">
                            <div class="product-info">
                                <h3>Defensivos</h3>
                                <p>Proteção eficaz contra pragas e doenças</p>
                            </div>
                        </div>

                        <div class="product-card">
                            <img src="../../PUBLIC/img/baitola3.jpg" alt="Sementes" class="product-image">
                            <div class="product-info">
                                <h3>Sementes</h3>
                                <p>Genética de alta qualidade e produtividade</p>
                            </div>
                        </div>

                        <div class="product-card">
                            <img src="../../PUBLIC/img/baitola4.webp" alt="Equipamentos" class="product-image">
                            <div class="product-info">
                                <h3>Equipamentos</h3>
                                <p>Tecnologia avançada para o campo</p>
                            </div>
                        </div>

                        <div class="product-card">
                            <img src="../../PUBLIC/img/irrigacao.jpg" alt="Irrigação" class="product-image">
                            <div class="product-info">
                                <h3>Irrigação</h3>
                                <p>Sistemas eficientes de irrigação</p>
                            </div>
                        </div>
                    </div>

                    <button class="carousel-btn next" onclick="moveCarousel(1)" aria-label="Próximo">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

            </div>

            <div class="why-section">
                <h2 class="why-title">Por que você vai amar nossos Produtos Agrícolas</h2>

                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h3>Muito Fácil</h3>
                        <p>Você pode adquirir seus produtos em minutos</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <h3>Super Personalizável</h3>
                        <p>Soluções sob medida para cada tipo de cultura</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-thumbs-up"></i>
                        </div>
                        <h3>Aprovado pelos Produtores</h3>
                        <p>Milhares de agricultores confiam em nossos produtos</p>
                    </div>
                </div>

                <button class="cta-button" onclick="window.location.href='cadastro.php'">COMECE SUA PARCERIA</button>
            </div>

            <div class="final-section">
                <div class="final-content">
                    <div class="final-text">
                        <h2>Organize as vendas de seus produtos</h2>
                        <p>Um método mais prático e acessível para sua organização de vendas e clientes</p>
                    </div>
                    <div class="final-image">
                        <img src="../../PUBLIC/img/dashboard-print.png" alt="Dashboard da fazenda" class="dashboard-image">
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <?php
            include "../../INCLUDE/footer.php";
        ?>
    </footer>
    
    <script src="../../PUBLIC/JS/landing_page.js"></script>
</body>
</html>
