<?php 
include "../../INCLUDE/Menu_superior.php";
include "../../INCLUDE/vlibras.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipe de Desenvolvimento - Sistema Agrícola</title>
    <link rel="stylesheet" href="../../PUBLIC/css/colaboradores.css">
    <link rel="stylesheet" href="../../PUBLIC/css/style_menu_superior.css">  
</head>
<body>
    <?php
    $developers = [
        [
            'name' => 'Eduardo Riberio Lopez',
            'role' => 'Front-End Developer',
            'image' => '../../PUBLIC/img/IMG-20251112-WA0019.jpeg',
            'specialties' => ['JS', 'PHP', 'HTML', 'CSS'],
            'github' => 'https://github.com/lucassilva',
            'linkedin' => 'https://linkedin.com/in/lucassilva'
        ],
        [
            'name' => 'João Vitor da Silva Oliveira',
            'role' => 'Front-End Developer',
            'image' => '../../PUBLIC/img/João_Vitor.jfif',
            'specialties' => ['JS', 'PHP', 'HTML', 'CSS'],
            'github' => 'https://github.com/anacosta',
            'linkedin' => 'https://linkedin.com/in/anacosta'
        ],
        [
            'name' => 'Lucas Santos Pereira de Oliveira',
            'role' => 'Full Stack Developer',
            'image' => '../../PUBLIC/img/user_6904fd215cd88.gif',
            'specialties' => ['JS', 'PHP', 'HTML', 'CSS'],
            'github' => 'https://github.com/pedrosantos',
            'linkedin' => 'https://linkedin.com/in/pedrosantos'
        ],
        [
            'name' => 'Luiz Fernado Vilalba Queiros Gonçalves',
            'role' => 'Back End Developer - Analista de Dados',
            'image' => '../../PUBLIC/img/user_6904fd215cd88.gif',
            'specialties' => ['JS', 'PHP', 'MySQL'],
            'github' => 'https://github.com/marianaoliveira',
            'linkedin' => 'https://linkedin.com/in/marianaoliveira'
        ],
        [
            'name' => 'Paulo Otávio Câmara Rojas',
            'role' => 'Full Stack Developer - Analista de Dados',
            'image' => '../../PUBLIC/img/Paulo_Otavio.webp',
            'specialties' => ['JS', 'PHP', 'HTML', 'CSS', 'MySQL'],
            'github' => 'https://github.com/rafaelferreira',
            'linkedin' => 'https://linkedin.com/in/rafaelferreira'
        ],
        [
            'name' => 'Yuri yochifumi de Lara maeda',
            'role' => 'Full Stack Developer',
            'image' => '../../PUBLIC/img/user_6904fd215cd88.gif',
            'specialties' => ['JS', 'PHP', 'HTML', 'CSS', 'MySQL'],
            'github' => 'https://github.com/julianarodrigues',
            'linkedin' => 'https://linkedin.com/in/julianarodrigues'
        ],
        [
            'name' => 'Gustavo Francisco Scarton dos Santos',
            'role' => 'Front-End Developer',
            'image' => '../../PUBLIC/img/gustavo.jpeg',
            'specialties' => ['JS', 'PHP', 'HTML', 'CSS', 'MySQL'],
            'github' => 'https://github.com/carlosalmeida',
            'linkedin' => 'https://linkedin.com/in/carlosalmeida'
        ],
        [
            'name' => 'Luã Carlos dos Santos Abreu',
            'role' => 'Full Stack Developer',
            'image' => '../../PUBLIC/img/user_6904fd215cd88.gif',
            'specialties' => ['JS', 'PHP', 'HTML', 'CSS', 'MySQL'],
            'github' => 'https://github.com/beatrizlima',
            'linkedin' => 'https://linkedin.com/in/beatrizlima'
        ],
        [
            'name' => 'Sabrina Luana de Melo Araújo',
            'role' => 'Frontend Developer',
            'image' => '../../PUBLIC/img/Sabrina.jpg',
            'specialties' => ['JS', 'PHP', 'HTML', 'CSS', 'MySQL'],
            'github' => 'https://github.com/SabrinaLuana',
            'linkedin' => 'https://www.linkedin.com/in/sabrina-ara%C3%BAjo-921475328/'
        ],
        [
            'name' => 'Vinícius Cruz Lopes',
            'role' => 'Full Stack Developer',
            'image' => '../../PUBLIC/img/user_6904fd215cd88.gif',
            'specialties' => ['JS', 'PHP', 'HTML', 'CSS', 'MySQL'],
            'github' => 'https://github.com/fernandamartins',
            'linkedin' => 'https://linkedin.com/in/fernandamartins'
        ],
        [
            'name' => 'João Pedro Ramos Corrêa',
            'role' => 'DevOps Engineer',
            'image' => '../../PUBLIC/img/user_6904fd215cd88.gif',
            'specialties' => ['JS', 'PHP', 'HTML', 'CSS', 'MySQL'],
            'github' => 'https://github.com/joao860',
            'linkedin' => 'https://www.linkedin.com/in/joao-pedro404/?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app'
        ],
        [
            'name' => 'José Carlos Ferreira da Silva Júnior',
            'role' => 'Frontend Developer',
            'image' => '../../PUBLIC/img/jose.jpeg',
            'specialties' => ['JS', 'PHP', 'HTML', 'CSS', 'MySQL'],
            'github' => 'https://github.com/juniorsamp4io',
            'linkedin' => 'https://www.linkedin.com/in/jos%C3%A9-junior-3867631a3?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app'
        ],
        [
            'name' => 'Ezequiel Alves Rocha',
            'role' => 'Frontend Developer',
            'image' => '../../PUBLIC/img/ezequiel.jpeg',
            'specialties' => ['JS', 'PHP', 'HTML', 'CSS', 'MySQL'],
            'github' => 'https://github.com/eze-alrc',
            'linkedin' => 'https://www.linkedin.com/in/ezequiel-alves-rocha-53624b324?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app'
        ]
    ];
    ?>

    <div class="container">
        <div class="container-hero">
            <header class="hero">
                <h1>Nossa Equipe de Desenvolvimento</h1>
                <p>Conheça os desenvolvedores que tornaram este sistema possível</p>
            </header>

            <section class="thank-you">
                <h2>Agradecimento Especial</h2>
                <p>
                    Somos gratos a cada membro desta equipe talentosa que dedicou tempo, esforço e expertise 
                    para criar este sistema agrícola. Seu comprometimento com a excelência e trabalho em equipe 
                    resultou em uma plataforma robusta e eficiente que serve nossa comunidade agrícola.
                </p>
            </section>
        </div>

        <section class="developers-grid">
            <?php foreach ($developers as $dev): ?>
                <div class="dev-card">
                    <div class="dev-image-wrapper">
                        <img src="<?php echo htmlspecialchars($dev['image']); ?>" 
                             alt="<?php echo htmlspecialchars($dev['name']); ?>" 
                             class="dev-image">
                        <div class="dev-overlay">
                            <div class="social-links">
                                <a href="<?php echo htmlspecialchars($dev['github']); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="social-link"
                                   aria-label="GitHub de <?php echo htmlspecialchars($dev['name']); ?>">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/>
                                    </svg>
                                </a>
                                <a href="<?php echo htmlspecialchars($dev['linkedin']); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="social-link"
                                   aria-label="LinkedIn de <?php echo htmlspecialchars($dev['name']); ?>">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                                        <rect x="2" y="9" width="4" height="12"/>
                                        <circle cx="4" cy="4" r="2"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="dev-content">
                        <h3 class="dev-name"><?php echo htmlspecialchars($dev['name']); ?></h3>
                        <p class="dev-role"><?php echo htmlspecialchars($dev['role']); ?></p>
                        <div class="dev-specialties">
                            <?php foreach ($dev['specialties'] as $specialty): ?>
                                <span class="specialty-tag"><?php echo htmlspecialchars($specialty); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>

        <section class="tech-stack">
            <h2>Tecnologias Utilizadas</h2>
            <div class="tech-grid">
                <div class="tech-item">JS</div>
                <div class="tech-item">PHP</div>
                <div class="tech-item">HTML</div>
                <div class="tech-item">CSS</div>
                <div class="tech-item">MySQL</div>
            </div>
        </section>
    </div>

    <script src="../../PUBLIC/JS/script-colaboradores.js"></script>
</body>
</html>
