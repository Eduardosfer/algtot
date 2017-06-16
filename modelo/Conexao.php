<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conexao
 *
 * @author EduSfer
 */
header('Content-Type: text/html; charset=UTF-8');

Class Conexao {

    private $conexao;

    public function __construct() {

        $host = 'localhost';
        $dbName = 'algtot';
        $usuario = 'root';
        $senha = 'root';

        try {

            $colacao = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            $this->conexao = new PDO('mysql:host=' . $host . ';dbname=' . $dbName . '', $usuario, $senha, $colacao);
        } catch (Exception $ex) {
            $ex->getMessage();
        }

        if (!isset($this->conexao)) {
            $this->mostrarMensagemRedirecionar("Base de dados nÃ£o encontrada!", "../visao/algTotApresentacao.php");
        }
    }

    public function mostrarMensagemRedirecionar($mensagem, $endereco) {

        if ($mensagem != null) {
            echo "<script>alert('" . $mensagem . "')</script>";
        }

        if ($endereco != null) {
            echo "<script>window.location = '" . $endereco . "';</script>";
        }
    }

    public function obterConexao() {
        return $this->conexao;
    }

    public function desconectar() {
        $this->conexao = null;
    }

    public function __destruct() {
        //
    }

}
