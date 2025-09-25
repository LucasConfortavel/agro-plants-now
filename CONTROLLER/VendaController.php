<?php
require_once __DIR__ . '/../MODEL/VendaModel.php';

class VendaController {
    private $venda;

    public function __construct() {
        $this->venda = new vendaModel();
    }

    public function index($filtro = null) {

        if ($filtro == null) {
            $stmt = $this->venda->lerTodos();
            $vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $vendas;
        } else{
            $stmt = $this->venda->lerEspecifico($filtro);
            $vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $vendas;
        }

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

}