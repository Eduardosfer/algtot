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
            echo "<div style='text-align: center; margin-top: 5%;margin-left: 20%;margin-right: 20%;'>"
                    . "<div style='padding: 1em;background: crimson;border-radius: 10px 10px 0px 0px;color: aliceblue;' >"
                        . "<p style='padding: 0;margin: 0;'>A BASE DE DADOS NÃO PODE SER ENCONTRADA!</p>"
                    . "</div>"
                    . "<div style='padding: 1em;border-bottom: 1px solid;border-left: 1px solid;border-right: 1px solid;background-color: white;'>"
                        . "<p style='padding: 0;margin: 0;'>ENTRE EM CONTATO COM O ADMINISTRADOR DO SERVIDOR OU VERIFIQUE AS INFORMAÇÕES EM: CONFIG.PHP</p>"
                    . "</div>"
                . "</div>";
            die;
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
