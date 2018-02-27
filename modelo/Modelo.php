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
header('Content-Type: text/html; charset=UTF-8');

Class Modelo {

    private $conexaoModelo;

    public function __construct() {
        $conexao = new Conexao();
        $this->conexaoModelo = $conexao->obterConexao();
    }

    //Criei metodos diferentes, mesmo que por enquanto com mesmas aÃ§Ãµes, mas posteriormente posso implementar novas aÃ§Ãµes particulares para cada um
    public function cadastrar($insert, $dados) {
        $dados = $this->tratarDados($dados);
        $insercao = $this->conexaoModelo->prepare($insert);
        $insercao->execute($dados);
    }

    public function alterar($update, $dados) {
        $dados = $this->tratarDados($dados);
        $alteracao = $this->conexaoModelo->prepare($update);
        $alteracao->execute($dados);
    }

    public function selecionar($select, $dados) {
        $dados = $this->tratarDados($dados);
        $selecao = $this->conexaoModelo->prepare($select);
        $selecao->execute($dados);
        return $selecao;
    }

    public function selecionarFetchAll($select, $dados) {
        $dados = $this->tratarDados($dados);
        $selecao = $this->conexaoModelo->prepare($select);
        $selecao->execute($dados);
        return $selecao->fetchAll();
    }

    public function selecionarFetch($select, $dados) {
        $dados = $this->tratarDados($dados);
        $selecao = $this->conexaoModelo->prepare($select);
        $selecao->execute($dados);
        return $selecao->fetch();
    }

    public function excluir($update, $dados) {
        $dados = $this->tratarDados($dados);
        $alteracao = $this->conexaoModelo->prepare($update);
        $alteracao->execute($dados);
    }

    public function deletar($delete, $dados) {
        $dados = $this->tratarDados($dados);
        $deletar = $this->conexaoModelo->prepare($delete);
        $deletar->execute($dados);
    }

    public function tratarDados($dados) {
        foreach ($dados as $key => $dado) {
            if ($dados[$key] != strip_tags($dados[$key])) {
                echo "ola";
                header("Location: http:" . BASE_URL_ALG . "visao/algTotApresentacao.php");
            }
        }
        return $dados;
    }

}
