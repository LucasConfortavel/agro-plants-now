<?php
require_once __DIR__ . '/../MODEL/UsuarioModel.php';

class UsuarioController {
    private $user;

    public function __construct() {
        $this->user = new UsuarioModel();
    }

    // listar todos os Vendedores
    public function indexVend() {
        try {
            
            $stmt = $this->user->lerEspecifico('vendedor');
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
            // carregar a view de listagem
            include_once __DIR__ . '/../views/users/index.php';
        } catch (Exception $e) {
            $error = $e->getMessage();
            include_once __DIR__ . '/../views/error.php';
        }
    }

    // listar todos os usuarios
    public function index() {
        try {
            $stmt = $this->user->lerTodos();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users
            // carregar a view de listagem
            include_once __DIR__ . '/../views/users/index.php';
        } catch (Exception $e) {
            $error = $e->getMessage();
            include_once __DIR__ . '/../views/error.php';
        }
    }

    // mostrar formulario de criação de usuario
    public function create() {
        include_once __DIR__ . '/../views/users/create.php';
    }



    // processar criação de usuario
    public function armazenar() {
        try {
            $this->user->nome = $_POST['nome'];
            $this->user->email = $_POST['email'];
            $this->user->senha = $_POST['senha']; // sem hash por enquanto
            $this->user->tipo = $_POST['tipo'];
            $this->user->telefone = $_POST['telefone'] ?? null;
            $this->user->CPF = $_POST['cpf'];
            $this->user->endereco = $_POST['endereco'] ?? null;
            $this->user->cidade = $_POST['cidade'] ?? null;
            $this->user->estado = $_POST['estado'] ?? null;
            $this->user->data_nasc = $_POST['data_nasc'] ?? null;
            $this->user->foto = $_POST['foto'] ?? null;

            if ($this->user->create()) {
                header("Location: /users?success=Usuário criado com sucesso");
                exit();
            } else {
                throw new Exception("Erro ao criar usuário");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }

    // mostrar detalhes de um usuario
    public function mostrar($id) {
        try {
            $this->user->id = $id;
            
            if ($this->user->lerUm()) {
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
            $this->user->id = $id;
            
            if ($this->user->lerUm()) {
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
    public function update($id) {
        try {
            $this->user->id = $id;
            
            // receber dados do formulario
            $this->user->nome = $_POST['nome'];
            $this->user->email = $_POST['email'];
            $this->user->tipo = $_POST['tipo'];
            $this->user->telefone = $_POST['telefone'] ?? null;
            $this->user->CPF = $_POST['cpf'];
            $this->user->endereco = $_POST['endereco'] ?? null;
            $this->user->cidade = $_POST['cidade'] ?? null;
            $this->user->estado = $_POST['estado'] ?? null;
            $this->user->data_nasc = $_POST['data_nasc'] ?? null;
            $this->user->foto = $_POST['foto'] ?? null;
            
            // se uma nova senha foi fornecida
            if (!empty($_POST['senha'])) {
                $this->user->senha = $_POST['senha'];
            }

            // atualizar usuario
            if ($this->user->atualizar()) {
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

    public function delete($id) {
        try {
            $this->user->id = $id;
            
            if ($this->user->delete()) {
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
                
                if ($this->user->login($email, $senha)) {
                    session_start();
                    $_SESSION['id'] = $this->user->id;
                    $_SESSION['email'] = $this->user->email;
                    $_SESSION['tipo'] = $this->user->tipo;
                    $_SESSION['nome'] = $this->user->nome;

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
            // retornar para a página de login com mensagem de erro
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
        $exists = $this->user->emailExiste($email);
        
        header('Content-Type: application/json');
        echo json_encode(['exists' => $exists]);
    }

    // verificar se CPF ja existe (para AJAX)
    public function checarCPF() {
        $cpf = $_GET['cpf'];
        $exists = $this->user->cpfExiste($cpf);
        
        header('Content-Type: application/json');
        echo json_encode(['exists' => $exists]);
    }
}
