# 🌱 Agro Plants NOW — Plataforma de Vendas Agrícola

**Agro Plants NOW** é um sistema de e-commerce e gestão de vendas para o setor agrícola, desenvolvido em PHP com arquitetura MVC. Permite que vendedores gerenciem clientes, produtos, serviços e pedidos, enquanto administradores têm visão completa do negócio.

> Projeto acadêmico desenvolvido na disciplina de Desenvolvimento de Sistemas — SENAC-MS.

---

## ✨ Funcionalidades

**Administrador**
- Dashboard com métricas de vendas
- Gerenciamento de vendedores e clientes
- Catálogo de produtos e serviços (com upload de imagens)
- Controle de cupons e comissões
- Relatórios e notificações

**Vendedor**
- Dashboard personalizado
- Catálogo de produtos/serviços para venda
- Carrinho de compras e registro de vendas
- Lista de clientes e histórico de pedidos
- Aplicação de cupons de desconto

**Público**
- Landing page institucional
- Página "Sobre nós" e "Contate-nos"
- Recuperação de senha por e-mail (PHPMailer)

---

## 🛠️ Stack Tecnológica

| Camada | Tecnologia |
|--------|-----------|
| Back-end | PHP (MVC) |
| Banco de dados | MySQL (PDO) |
| Front-end | HTML, CSS, JavaScript |
| E-mail | PHPMailer |
| CAPTCHA | reCAPTCHA |
| Acessibilidade | VLibras |
| Dependências | Composer |

---

## 📁 Estrutura do Projeto

```
├── CONTROLLER/     # Lógica de negócio (controllers PHP)
├── MODEL/          # Acesso ao banco de dados
├── VIEW/
│   ├── adm/        # Views do administrador
│   ├── vend/       # Views do vendedor
│   ├── pop-up/     # Modais e pop-ups
│   └── paginas-iniciais/  # Landing page e páginas públicas
├── DB/             # Conexão com banco de dados (PDO)
├── INCLUDE/        # Componentes reutilizáveis (menus, footer, alertas)
└── PUBLIC/
    ├── css/        # Estilos por página
    ├── JS/         # Scripts por funcionalidade
    └── img/        # Imagens e assets
```

---

## 📚 Aprendizados

- Estruturar uma aplicação PHP do zero seguindo o padrão **MVC**, separando claramente Model, View e Controller sem uso de framework
- Usar **PDO com prepared statements** para todas as queries, evitando SQL injection e padronizando o acesso ao banco
- Integrar **PHPMailer** para envio de e-mails transacionais (recuperação de senha, notificações) e **reCAPTCHA** para proteger formulários públicos
- Gerenciar upload e armazenamento de imagens de produtos no servidor, validando tipo e tamanho antes de salvar
- Implementar um sistema de permissões com dois perfis distintos (administrador e vendedor), controlando o acesso às views por sessão PHP

---

## 👤 Autor

**Paulo Otávio Câmara Rojas**  
[GitHub](https://github.com/PauloRojas18) • [LinkedIn](https://linkedin.com/in/paulo-rojas-b7b77a3a1/) • paulootaviogalala@gmail.com
