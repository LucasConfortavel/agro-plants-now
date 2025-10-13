<?php
require_once __DIR__ . '/../MODEL/UsuarioModel.php';
require_once __DIR__ . '/../VIEW/vend/ajustes-vendedor-view.php';

class AjustesVendedorController {
    private $usuarioModel;
    private $view;
    private $user_id;

    public function __construct() {
        $this->usuarioModel = new UsuarioModel();
        $this->view = new AjustesVendedorView();
        $this->user_id = $_SESSION['id'] ?? null;
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'index';
        
        switch ($action) {
            case 'atualizarInformacoes':
                $this->atualizarInformacoesAction();
                break;
            case 'index':
            default:
                $this->indexAction();
                break;
        }
    }

    private function indexAction() {
        $dadosUsuario = $this->carregarDadosUsuario($this->user_id);
        $alerta = $_SESSION['alerta'] ?? '';
        
        if (isset($_SESSION['alerta'])) {
            unset($_SESSION['alerta']);
        }

        if (!$dadosUsuario['success']) {
            $alerta = '<script> exibirAlerta("'.$dadosUsuario['error'].'","erro"); </script>';
            $user_data = [];
        } else {
            $user_data = $dadosUsuario['usuario'];
        }

        $this->view->exibirPaginaAjustes($user_data, $alerta);
    }

    private function atualizarInformacoesAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'nome' => $_POST['nome'],
                'email' => $_POST['email'],
                'telefone' => $_POST['telefone'],
                'cpf' => $_POST['cpf'],
                'cep' => $_POST['cep'],
                'data_nasc' => $_POST['data_nasc']
            ];
            
            $resultado = $this->atualizarInformacoes($this->user_id, $dados);
            
            if (isset($resultado['success'])) {
                $_SESSION['alerta'] = '<script> exibirAlerta("'.$resultado['success'].'","sucesso"); </script>';
            } else {
                $_SESSION['alerta'] = '<script> exibirAlerta("'.$resultado['error'].'","erro"); </script>';
            }
            
            header('Location: ajustes-informacoes-vend.php');
            exit();
        }
    }

    public function carregarDadosUsuario($user_id) {
        try {
            $this->usuarioModel->id = $user_id;
            $usuario = $this->usuarioModel->lerUm();
            
            if (!$usuario) {
                throw new Exception("Usuário não encontrado");
            }

            return [
                'success' => true,
                'usuario' => $usuario
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function atualizarInformacoes($user_id, $dados) {
        try {
            $this->validarDadosUsuario($dados);
            
            $this->usuarioModel->id = $user_id;
            $this->usuarioModel->nome = $dados['nome'];
            $this->usuarioModel->email = $dados['email'];
            $this->usuarioModel->telefone = $dados['telefone'] ?? null;
            $this->usuarioModel->CPF = $dados['cpf'];
            $this->usuarioModel->CEP = $dados['cep'] ?? null;
            $this->usuarioModel->data_nasc = $dados['data_nasc'] ?? null;

            if ($this->usuarioModel->atualizar()) {
                return ['success' => 'Informações atualizadas com sucesso'];
            } else {
                throw new Exception("Erro ao atualizar informações");
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    private function validarDadosUsuario($dados) {
        if (empty($dados['nome']) || empty($dados['email']) || empty($dados['cpf'])) {
            throw new Exception("Nome, email e CPF são obrigatórios");
        }

        if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email inválido");
        }

        return true;
    }
}
?>