<?php
require_once __DIR__ . '/../MODEL/ClienteModel.php';

class ClienteController {
    private $cliente;

    public function __construct() {
        $this->cliente = new ClienteModel();
    }

    // listar todos os usuarios
    public function index() {
        try {
            $stmt = $this->cliente->lerTodos();
            $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $clientes;

        } catch (Exception $e) {
            $error = $e->getMessage();
            include_once __DIR__ . '/../views/error.php';
        }
    }

    public function criarCliente() {
        try {
            if(strlen($_POST['CPF/CNPJ']) == 14){
                $_POST['CNPJ'] = $_POST['CPF/CNPJ'];
                $_POST['CPF'] = null;
            } elseif (strlen($_POST['CPF/CNPJ']) == 11){
                $_POST['CPF'] = $_POST['CPF/CNPJ'];
                $_POST['CNPJ'] = null;
            }
            else{
                $_POST['CNPJ'] = null;
                $_POST['CPF'] = null;

            }
            $this->cliente->nome = $_POST['nome'];
            $this->cliente->email = $_POST['email'];
            $this->cliente->telefone = $_POST['telefone'];
            $this->cliente->CPF = $_POST['CPF'];
            $this->cliente->CNPJ = $_POST['CNPJ'];
            $this->cliente->data_nasc = $_POST['data_nasc'] ?? 'null';

            $stmt = $this->cliente->criar();
            return true;

        } catch (Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }

    public function mostrar($id) {
        try {
            $this->cliente->id = $id;
            $cliente = $this->cliente->lerUm();
            if ($this->cliente->lerUm()) {
                return $cliente;
            } else {
                throw new Exception("Usuário não encontrado");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }

    // public function editar($id) {
    //     try {
    //         $this->cliente->id = $id;
            
    //         if ($this->cliente->lerUm()) {
    //             include_once __DIR__ . '/../views/clientes/edit.php';
    //         } else {
    //             throw new Exception("Usuário não encontrado");
    //         }
    //     } catch (Exception $e) {
    //         $error = $e->getMessage();
    //         include_once __DIR__ . '/../views/error.php';
    //     }
    // }

    // processar atualização de usuario
    public function atualizar($id) {
        try {
            $this->cliente->id = $id;
            
            // receber dados do formulario
            $this->cliente->nome = $_POST['nome'];
            $this->cliente->email = $_POST['email'];
            $this->cliente->telefone = $_POST['telefone'] ?? null;
            $this->cliente->CPF = $_POST['CPF'];
            $this->cliente->CNPJ = $_POST['CNPJ'];
            $this->cliente->data_nasc = $_POST['data_nasc'] ?? null;
            
            // atualizar usuario
            if ($this->cliente->atualizar()) {
                header("Location: /clientes/$id?success=Usuário atualizado com sucesso");
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
            $this->cliente->id = $id;
            
            if ($this->cliente->delete()) {
                header("Location: /clientes?success=Usuário excluído com sucesso");
                exit();
            } else {
                throw new Exception("Erro ao excluir cliente");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            include_once __DIR__ . '/../views/error.php';
        }
    }

    // // mostrar formulario de login
    // public function formularioLogin() {
    //     include_once __DIR__ . '/../views/clientes/login.php';
    // }

    public function login() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                
                if ($this->cliente->login($email, $senha)) {
                    session_start();
                    $_SESSION['id'] = $this->cliente->id;
                    $_SESSION['email'] = $this->cliente->email;
                    $_SESSION['tipo'] = $this->cliente->tipo;
                    $_SESSION['nome'] = $this->cliente->nome;

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
        $exists = $this->cliente->emailExiste($email);
        
        header('Content-Type: application/json');
        echo json_encode(['exists' => $exists]);
    }

    // verificar se CPF ja existe (para AJAX)
    public function checarCPF() {
        $cpf = $_GET['cpf'];
        $exists = $this->cliente->cpfExiste($cpf);
        
        header('Content-Type: application/json');
        echo json_encode(['exists' => $exists]);
    }
}