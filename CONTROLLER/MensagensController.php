<?php
require_once __DIR__ . '/../MODEL/MensagensModel.php';

class MessageController {
    private $mensagem;

    public function __construct() {
        $this->mensagem = new MensagemeModel();
    }

    // Listar todas as mensagens enviadas ao admin
    public function index() {
        $result = $this->mensagem->lerTodas();
        // garante que sempre retorna array
        return is_array($result) ? $result : [];
    }

    // Criar uma nova mensagem

    public function criar() {
        $this->mensagem->nome = trim($_POST['name']);
        $this->mensagem->email = trim($_POST['email']);
        $this->mensagem->mensagem = trim($_POST['mensagem']);

        return $this->mensagem->criar();
    }

    public function mostrar($id) {
        try {
            $this->message->id = $id;
            $msg = $this->mensagem->lerUm();

            if ($msg) {
                include_once __DIR__ . '/../views/messages/show.php';
            } else {
                throw new Exception("Mensagem não encontrada.");
            }
        } catch (Exception $e) {
            $error = $e->getMensagem();
            // include_once __DIR__ . '/../views/error.php';
        }
    }

    // Deletar mensagem
    public function deletar($id) {
        try {
            $this->mensagem->id = $id;
            if ($this->mensagem->deletar()) {
                header("Location: /messages?success=Mensagem excluída");
                exit();
            } else {
                throw new Exception("Erro ao excluir mensagem.");
            }
        } catch (Exception $e) {
            $error = $e->getMensagem();
            // include_once __DIR__ . '/../views/error.php';
        }
    }
}
