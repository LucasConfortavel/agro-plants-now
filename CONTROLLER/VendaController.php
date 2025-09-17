<?php
require_once __DIR__ . '/../MODEL/VendaModel.php';

class VendaController {
    private $venda;

    public function __construct() {
        $this->venda = new vendaModel();
    }

    // listar todos os usuarios
    public function index($filtro = null) {
        // try {
            if ($filtro == null) {

            $stmt = $this->venda->lerTodos();
            $vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $vendas;
        } else{
            $stmt = $this->venda->lerEspecifico($filtro);
            $vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $vendas;
        }

        // } catch (Exception $e) {
        //     $error = $e->getMessage();
        //     echo $error;
        // }
    }

    public function criarvenda() {
        try {
            if(strlen($_POST['CPF/CNPJ']) == 14){
                $_POST['CNPJ'] = $_POST['CPF/CNPJ'];
            } elseif (strlen($_POST['CPF/CNPJ']) == 11){
                $_POST['CPF'] = $_POST['CPF/CNPJ'];
            }
            else{
                die();
            }
            $this->venda->nome = $_POST['nome'];
            $this->venda->email = $_POST['email'];
            $this->venda->telefone = !empty($_POST['telefone']) ? $_POST['telefone'] : null;
            $this->venda->CPF = !empty($_POST['CPF']) ? $_POST['CPF'] : null;
            $this->venda->CNPJ = !empty($_POST['CNPJ']) ? $_POST['CNPJ'] : null;
            $this->venda->data_nasc = $_POST['data_nasc'] ?? null;

            $stmt = $this->venda->criar();
            return true;

        } catch (Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }

    public function mostrar($id) {
        try {
            $this->venda->id = $id;
            
            if ($this->venda->lerUm()) {
                return $this->venda->lerUm();
            } else {
                throw new Exception("Venda não encontrada");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
           return $error;
        }
    }

    // public function editar($id) {
    //     try {
    //         $this->venda->id = $id;
            
    //         if ($this->venda->lerUm()) {
    //             include_once __DIR__ . '/../views/vendas/edit.php';
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
            $this->venda->id = $id;
            
            // receber dados do formulario
            $this->venda->nome = $_POST['nome'];
            $this->venda->email = $_POST['email'];
            $this->venda->telefone = $_POST['telefone'] ?? null;
            $this->venda->CPF = $_POST['CPF'];
            $this->venda->CNPJ = $_POST['CNPJ'];
            $this->venda->data_nasc = $_POST['data_nasc'] ?? null;
            
            // atualizar usuario
            if ($this->venda->atualizar()) {
                header("Location: /vendas/$id?success=Usuário atualizado com sucesso");
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
            $this->venda->id = $id;
            
            if ($this->venda->delete()) {
                header("Location: /vendas?success=Usuário excluído com sucesso");
                exit();
            } else {
                throw new Exception("Erro ao excluir venda");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            include_once __DIR__ . '/../views/error.php';
        }
    }

    // // mostrar formulario de login
    // public function formularioLogin() {
    //     include_once __DIR__ . '/../views/vendas/login.php';
    // }

    public function login() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                
                if ($this->venda->login($email, $senha)) {
                    session_start();
                    $_SESSION['id'] = $this->venda->id;
                    $_SESSION['email'] = $this->venda->email;
                    $_SESSION['tipo'] = $this->venda->tipo;
                    $_SESSION['nome'] = $this->venda->nome;

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
        $exists = $this->venda->emailExiste($email);
        
        header('Content-Type: application/json');
        echo json_encode(['exists' => $exists]);
    }

    // verificar se CPF ja existe (para AJAX)
    public function checarCPF() {
        $cpf = $_GET['cpf'];
        $exists = $this->venda->cpfExiste($cpf);
        
        header('Content-Type: application/json');
        echo json_encode(['exists' => $exists]);
    }
}