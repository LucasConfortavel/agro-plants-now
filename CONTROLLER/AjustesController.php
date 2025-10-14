<?php
require_once __DIR__ . '/../MODEL/UsuarioModel.php';
require_once __DIR__ . '/../VIEW/adm/ajustes-view.php';

class AjustesController {
    private $usuarioModel;
    private $view;
    private $user_id;

    public function __construct() {
        $this->usuarioModel = new UsuarioModel();
        $this->view = new AjustesView();
        $this->user_id = $_SESSION['id'] ?? null;
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'index';
        
        switch ($action) {
            case 'atualizarInformacoes':
                $this->atualizarInformacoesAction();
                break;
            case 'alterarSenha':
                $this->alterarSenhaAction();
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
            
            header('Location: ajustes-informacoes-adm.php');
            exit();
        }
    }

    private function alterarSenhaAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $resultado = $this->alterarSenha(
                $this->user_id, 
                $_POST['senha_atual'], 
                $_POST['nova_senha'],
                $_POST['confirmar_senha']
            );
            
            if (isset($resultado['success'])) {
                $_SESSION['alerta'] = '<script> exibirAlerta("'.$resultado['success'].'","sucesso"); </script>';
            } else {
                $_SESSION['alerta'] = '<script> exibirAlerta("'.$resultado['error'].'","erro"); </script>';
            }
            
            header('Location: ajustes-informacoes-adm.php#security');
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

    public function alterarSenha($user_id, $senha_atual, $nova_senha, $confirmar_senha) {
        try {
            if ($nova_senha !== $confirmar_senha) {
                throw new Exception("As senhas não coincidem");
            }

            if (strlen($nova_senha) < 6) {
                throw new Exception("A senha deve ter pelo menos 6 caracteres");
            }

            $this->usuarioModel->id = $user_id;
            $usuario = $this->usuarioModel->lerUm();
            
            if (!$usuario) {
                throw new Exception("Usuário não encontrado");
            }

            if ($senha_atual !== $usuario['senha']) {
                throw new Exception("Senha atual incorreta");
            }

            $this->usuarioModel->senha = $nova_senha;
            
            if ($this->usuarioModel->atualizar()) {
                return ['success' => 'Senha alterada com sucesso'];
            } else {
                throw new Exception("Erro ao alterar senha");
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