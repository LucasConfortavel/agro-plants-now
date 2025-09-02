<?php
class ImagemHandler {
    private $pathBase;
    
    public function __construct() {
        $this->pathBase = $_SERVER['DOCUMENT_ROOT'] . '/PUBLIC/img/';
    }
    
    /**
     * faz upload de uma imagem
     * @param array $arquivo, arquivo enviado via $_FILES
     * @param string $tipo, tipo da imagem (usuario, produto, servico)
     * @param string $nomeAtual, nome atual da imagem (para atualização)
     * @return string nome do arquivo salvo
     */
    public function enviarImagem($arquivo, $tipo, $nomeAtual = null) {
        // validar se é uma imagem
        $checar = getimagesize($arquivo["tmp_name"]);
        if($checar === false) {
            throw new Exception("Arquivo não é uma imagem.");
        }
        
        // verificar se o diretorio existe
        $dirEnvio = $this->pathBase . $tipo . '/';
        if (!file_exists($dirEnvio)) {
            mkdir($dirEnvio, 0777, true);
        }
        
        // gerar nome unico para o arquivo
        $extensao = strtolower(pathinfo($arquivo["name"], PATHINFO_EXTENSION));
        $nomeArquivo = uniqid() . '_' . time() . '.' . $extensao;
        
        // validar extensão
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($extensao, $extensoesPermitidas)) {
            throw new Exception("Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.");
        }
        
        // validar tamanho (maximo 2MB)
        if ($arquivo["size"] > 2097152) {
            throw new Exception("O arquivo é muito grande. Tamanho máximo: 2MB.");
        }
        
        // tentar fazer o upload
        if (move_uploaded_file($arquivo["tmp_name"], $dirEnvio . $nomeArquivo)) {
            // se for uma atualização, excluir a imagem antiga
            if ($nomeAtual && file_exists($dirEnvio . $nomeAtual)) {
                unlink($dirEnvio . $nomeAtual);
            }
            return $nomeArquivo;
        } else {
            throw new Exception("Erro ao fazer upload da imagem.");
        }
    }
    
    /**
     * exclui uma imagem
     * @param string $nomeArquivo, nome do arquivo a ser excluido
     * @param string $tipo, tipo da imagem (usuario, produto, servico)
     * @return bool true se excluído com sucesso
     */
    public function deletarImagem($nomeArquivo, $tipo) {
        if (empty($nomeArquivo)) {
            return true;
        }
        
        $pathArquivo = $this->pathBase . $tipo . '/' . $nomeArquivo;
        
        if (file_exists($pathArquivo)) {
            return unlink($pathArquivo);
        }
        
        return true;
    }
    
    /**
     * obtem o caminho completo da imagem para exibição
     * @param string $nomeArquivo, nome do arquivo
     * @param string $tipo, tipo da imagem (usuario, produto, servico)
     * @return string caminho completo da imagem
     */
    public function getPathImagem($nomeArquivo, $tipo) {
        if (empty($nomeArquivo)) {
            return "/PUBLIC/img/default/no-image.png";
        }
        
        $pathArquivo = "/PUBLIC/img/{$tipo}/{$nomeArquivo}";
        
        // verificar se o arquivo existe
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $pathArquivo)) {
            return "/PUBLIC/img/default/no-image.png";
        }
        
        return $pathArquivo;
    }
}
?>