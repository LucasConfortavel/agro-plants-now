<?php
require_once __DIR__ . '/../MODEL/UsuarioModel.php';

class UsuarioController {
    private $user;

    public function __construct() {
        $this->user = new UsuarioModel();
    }

    // Listar usuários com filtro opcional
    public function index($filtro = null) {
        try {
            if ($filtro && in_array($filtro, ['admin', 'vendedor'])) {
                $stmt = $this->user->lerEspecifico($filtro);
            } else {
                $stmt = $this->user->lerTodos();
            }
            
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Criar um novo usuário
    public function criar() {
        try {
            $this->user->nome = $_POST['nome'];
            $this->user->email = $_POST['email'];
            $this->user->senha = $_POST['senha'];
            $this->user->tipo = $_POST['tipo'];
            $this->user->telefone = $_POST['telefone'] ?? null;
            $this->user->CPF = $_POST['CPF'];
            $this->user->endereco = $_POST['endereco'] ?? null;
            $this->user->cidade = $_POST['cidade'] ?? null;
            $this->user->estado = $_POST['estado'] ?? null;
            $this->user->data_nasc = $_POST['data_nasc'] ?? null;
            $this->user->foto = $_POST['foto'] ?? null;

            if ($this->user->criar()) {
                return ['success' => 'Usuário criado com sucesso', 'id' => $this->user->id];
            } else {
                throw new Exception("Erro ao criar usuário");
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Mostrar detalhes de um usuário
    public function mostrar($id) {
        try {
            $this->user->id = $id;
            $user = $this->user->lerUm();
            
            if ($user) {
                return $user;
            } else {
                throw new Exception("Usuário não encontrado");
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Atualizar um usuário
    public function atualizar($id) {
        try {
            $this->user->id = $id;
            
            // Receber dados do formulário
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
            
            // Se uma nova senha foi fornecida
            if (!empty($_POST['senha'])) {
                $this->user->senha = $_POST['senha'];
            }

            if ($this->user->atualizar()) {
                return ['success' => 'Usuário atualizado com sucesso'];
            } else {
                throw new Exception("Erro ao atualizar usuário");
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Deletar um usuário
    public function deletar($id) {
        try {
            $this->user->id = $id;
            
            if ($this->user->deletar()) {
                return ['success' => 'Usuário deletado com sucesso'];
            } else {
                throw new Exception("Erro ao excluir usuário");
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Processar login
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

                    // Retornar redirecionamento com base no tipo de usuário
                    if ($_SESSION['tipo'] == 'admin') {  
                        return ['redirect' => '../VIEW/adm/dashboard-adm.php'];
                    } elseif ($_SESSION['tipo'] == 'vendedor') {
                        return ['redirect' => '../VIEW/vend/dashboard_vendedor.php'];
                    }
                } else {
                    throw new Exception("Email ou senha inválidos.");
                }
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Processar logout
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        return ['redirect' => '../VIEW/paginas-iniciais/landing_page.php'];
    }

    // Verificar se email já existe
    public function checarEmail($email) {
        try {
            $exists = $this->user->emailExiste($email);
            return ['exists' => $exists];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Verificar se CPF já existe
    public function checarCPF($cpf) {
        try {
            $exists = $this->user->cpfExiste($cpf);
            return ['exists' => $exists];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}