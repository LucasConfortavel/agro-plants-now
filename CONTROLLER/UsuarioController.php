<?php
require_once __DIR__ . '/../MODEL/UsuarioModel.php';

class UsuarioController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UsuarioModel();
    }

    // listar todos os usuarios
    public function index() {
        try {
            $stmt = $this->userModel->lerTodos();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // carregar a view de listagem
            include_once __DIR__ . '/../views/users/index.php';
        } catch (Exception $e) {
            $error = $e->getMessage();
            include_once __DIR__ . '/../views/error.php';
        }
    }

    // mostrar formulario de criação de usuario
    public function criar() {
        include_once __DIR__ . '/../views/users/create.php';
    }

    // processar criação de usuario
    public function armazenar() {
        try {
            // receber dados do formulario
            $this->userModel->nome = $_POST['nome'];
            $this->userModel->email = $_POST['email'];
            $this->userModel->senha = $_POST['senha']; // sem hash por enquanto
            $this->userModel->tipo = $_POST['tipo'];
            $this->userModel->telefone = $_POST['telefone'] ?? null;
            $this->userModel->CPF = $_POST['cpf'];
            $this->userModel->endereco = $_POST['endereco'] ?? null;
            $this->userModel->cidade = $_POST['cidade'] ?? null;
            $this->userModel->estado = $_POST['estado'] ?? null;
            $this->userModel->data_nasc = $_POST['data_nasc'] ?? null;
            $this->userModel->foto = $_POST['foto'] ?? null;

            if ($this->userModel->criar()) {
                header("Location: /users?success=Usuário criado com sucesso");
                exit();
            } else {
                throw new Exception("Erro ao criar usuário");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            include_once __DIR__ . '/../views/users/create.php';
        }
    }

    // mostrar detalhes de um usuario
    public function mostrar($id) {
        try {
            $this->userModel->id = $id;
            
            if ($this->userModel->lerUm()) {
                include_once __DIR__ . '/../views/users/show.php';
            } else {
                throw new Exception("Usuário não encontrado");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            include_once __DIR__ . '/../views/error.php';
        }
    }

    // mostrar formulario de edição
    public function editar($id) {
        try {
            $this->userModel->id = $id;
            
            if ($this->userModel->lerUm()) {
                include_once __DIR__ . '/../views/users/edit.php';
            } else {
                throw new Exception("Usuário não encontrado");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            include_once __DIR__ . '/../views/error.php';
        }
    }

    // processar atualização de usuario
    public function atualizar($id) {
        try {
            $this->userModel->id = $id;
            
            // receber dados do formulario
            $this->userModel->nome = $_POST['nome'];
            $this->userModel->email = $_POST['email'];
            $this->userModel->tipo = $_POST['tipo'];
            $this->userModel->telefone = $_POST['telefone'] ?? null;
            $this->userModel->CPF = $_POST['cpf'];
            $this->userModel->endereco = $_POST['endereco'] ?? null;
            $this->userModel->cidade = $_POST['cidade'] ?? null;
            $this->userModel->estado = $_POST['estado'] ?? null;
            $this->userModel->data_nasc = $_POST['data_nasc'] ?? null;
            $this->userModel->foto = $_POST['foto'] ?? null;
            
            // se uma nova senha foi fornecida
            if (!empty($_POST['senha'])) {
                $this->userModel->senha = $_POST['senha'];
            }

            // atualizar usuario
            if ($this->userModel->atualizar()) {
                header("Location: /users/$id?success=Usuário atualizado com sucesso");
                exit();
            } else {
                throw new Exception("Erro ao atualizar usuário");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            $this->editar($id); // voltar para o formulario de edição com erro
        }
    }

    public function deletar($id) {
        try {
            $this->userModel->id = $id;
            
            if ($this->userModel->deletar()) {
                header("Location: /users?success=Usuário excluído com sucesso");
                exit();
            } else {
                throw new Exception("Erro ao excluir usuário");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            include_once __DIR__ . '/../views/error.php';
        }
    }

    // mostrar formulario de login
    public function formularioLogin() {
        include_once __DIR__ . '/../views/users/login.php';
    }

    public function login() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                
                if ($this->userModel->login($email, $senha)) {
                    session_start();
                    $_SESSION['id'] = $this->userModel->id;
                    $_SESSION['email'] = $this->userModel->email;
                    $_SESSION['tipo'] = $this->userModel->tipo;
                    $_SESSION['nome'] = $this->userModel->nome;

                    // Redirecionar com base no tipo de usuário
                    if ($_SESSION['tipo'] == 'admin') {  
                        header("Location: ../VIEW/adm/dashboard-adm.php");
                        exit();
                    } elseif ($_SESSION['tipo'] == 'vendedor') {
                        header("Location: ../VIEW/vend/dashboard_vendedor.php");
                        exit();
                    }
                } else {
                    throw new Exception("Email ou senha inválidos.");
                }
            }
        } catch (Exception $e) {
            // retornar para a pagina de login com mensagem de erro
            header("Location: ../VIEW/paginas-iniciais/pagina-de-login.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    // processar logout
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../VIEW/paginas-iniciais/landing_page.php");
        exit();
    }

    // verificar se email ja existe (para AJAX)
    public function checarEmail() {
        $email = $_GET['email'];
        $exists = $this->userModel->emailExiste($email);
        
        header('Content-Type: application/json');
        echo json_encode(['exists' => $exists]);
    }

    // verificar se CPF ja existe (para AJAX)
    public function checarCPF() {
        $cpf = $_GET['cpf'];
        $exists = $this->userModel->cpfExiste($cpf);
        
        header('Content-Type: application/json');
        echo json_encode(['exists' => $exists]);
    }
}