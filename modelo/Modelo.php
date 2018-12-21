<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Modelo
 *
 * @author EduSfer
 */
require_once("Conexao.php");

Class Modelo {

    private $conexaoModelo;

    public function __construct() {
        $conexao = new Conexao();
        $this->conexaoModelo = $conexao->obterConexao();
    }

    //Criei metodos diferentes, mesmo que por enquanto com mesmas aÃ§Ãµes, mas posteriormente posso implementar novas aÃ§Ãµes particulares para cada um
    public function cadastrar($insert, $dados) {
        $dados = $this->tratarDados($dados);
        if ($dados == false) {                  
            $url = (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:'../index.php';
            $this->setModalRedirecionar('Erro ao processar sua solicitação!', 'Isso pode acontecer quando existe alguma informação indevida (Ex: tags HTML ou semelhantes) nos campos preenchidos e enviados.', '', 'meuModalErro', $url);
            die;
        } else {
            $insercao = $this->conexaoModelo->prepare($insert);
            $insercao->execute($dados);
        }
    }

    public function alterar($update, $dados) {
        $dados = $this->tratarDados($dados);        
        if ($dados == false) {                    
            $url = (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:'../index.php';
            $this->setModalRedirecionar('Erro ao processar sua solicitação!', 'Isso pode acontecer quando existe alguma informação indevida (Ex: tags HTML ou semelhantes) nos campos preenchidos e enviados.', '', 'meuModalErro', $url);
            die;
        } else {    
            $alteracao = $this->conexaoModelo->prepare($update);
            $alteracao->execute($dados);
        }
    }

    public function selecionar($select, $dados) {
        $dados = $this->tratarDados($dados); 
        if ($dados == false) {                        
            $url = (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:'../index.php';
            $this->setModalRedirecionar('Erro ao processar sua solicitação!', 'Isso pode acontecer quando existe alguma informação indevida (Ex: tags HTML ou semelhantes) nos campos preenchidos e enviados.', '', 'meuModalErro', $url);
            die;
        } else {
            $selecao = $this->conexaoModelo->prepare($select);
            $selecao->execute($dados);
            return $selecao;
        }        
    }

    public function selecionarFetchAll($select, $dados) {
        $dados = $this->tratarDados($dados);
        if ($dados == false) {                   
            $url = (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:'../index.php';
            $this->setModalRedirecionar('Erro ao processar sua solicitação!', 'Isso pode acontecer quando existe alguma informação indevida (Ex: tags HTML ou semelhantes) nos campos preenchidos e enviados.', '', 'meuModalErro', $url);
            die;
        } else {
            $selecao = $this->conexaoModelo->prepare($select);
            $selecao->execute($dados);
            return $selecao->fetchAll();
        }
    }

    public function selecionarFetch($select, $dados) {
        $dados = $this->tratarDados($dados);
        if ($dados == false) {                    
            $url = (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:'../index.php';
            $this->setModalRedirecionar('Erro ao processar sua solicitação!', 'Isso pode acontecer quando existe alguma informação indevida (Ex: tags HTML ou semelhantes) nos campos preenchidos e enviados.', '', 'meuModalErro', $url);
            die;
        } else {
            $selecao = $this->conexaoModelo->prepare($select);
            $selecao->execute($dados);
            return $selecao->fetch();
        }
    }

    public function excluir($update, $dados) {
        $dados = $this->tratarDados($dados);
        if ($dados == false) {                       
            $url = (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:'../index.php';
            $this->setModalRedirecionar('Erro ao processar sua solicitação!', 'Isso pode acontecer quando existe alguma informação indevida (Ex: tags HTML ou semelhantes) nos campos preenchidos e enviados.', '', 'meuModalErro', $url);
            die;
        } else {
            $alteracao = $this->conexaoModelo->prepare($update);
            $alteracao->execute($dados);
        }
    }

    public function deletar($delete, $dados) {
        $dados = $this->tratarDados($dados);
        if ($dados == false) {                       
            $url = (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:'../index.php';
            $this->setModalRedirecionar('Erro ao processar sua solicitação!', 'Isso pode acontecer quando existe alguma informação indevida (Ex: tags HTML ou semelhantes) nos campos preenchidos e enviados.', '', 'meuModalErro', $url);
            die;
        } else {
            $deletar = $this->conexaoModelo->prepare($delete);
            $deletar->execute($dados);
        }
    }

    public function tratarDados($dados) {
        //VERIFICANDO SE ESXISTE ALGUM CAMPO COM TAGS HTML
        foreach ($dados as $key => $dado) {
            if ($dados[$key] != strip_tags($dados[$key])) {
                return false;
                break;
            }
        }
        return $dados;
    }
    
    //É MUITO (COMPLICADO = DÁ ALGUNS BUGS POIS PODE SE TORNAR UMA CHAMADA RECURSIVA) INSTANCIAR UM OBJETO DO ALGTOT AQUI, ENTÃO É MELHOR FAZER ASSIM
    public function setModalRedirecionar($header = null, $body = null, $footer = null, $meuModal = null, $url = "../index.php") {
        session_start();
        $_SESSION['modal'] = $meuModal;
        $_SESSION['header'] = $header;
        $_SESSION['body'] = $body;
        $_SESSION['footer'] = $footer;
        header("Location: $url");
    }

}
