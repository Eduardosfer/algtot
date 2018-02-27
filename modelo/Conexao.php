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

//TODOS OS ARQUIVOS DO SISTEMA ESTÃO DE ALGUMA FORMA VINCULADOS A ESSE O INCLUINDO, POR ISSO ELE É TAMBEM UM CENTRALIZADOR ONDE AS CONFIGURAÇÕES SÃO LINCADAS
require_once("../config/config.php");

Class Conexao {

    private $conexao;    

    public function __construct() {        
                
        $host = LOCAL_HOST;
        $dbName = DB_NAME;
        $usuario = DB_USER_NAME;
        $senha = DB_USER_SENHA;

        try {
            $colacao = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            $this->conexao = new PDO('mysql:host=' . $host . ';dbname=' . $dbName . '', $usuario, $senha, $colacao);
        } catch (Exception $ex) {
            $ex->getMessage();
        }

        if (!isset($this->conexao)) {
            echo "<script>alert('BASE DE DADOS NÃO ENCONTRADA');window.location = '../index.php';</script>";
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
