<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acesso
 *
 * @author EduSfer
 */
require_once("../modelo/Modelo.php");

header('Content-Type: text/html; charset=UTF-8');

Class Acesso {

    private $modelo;

    public function __construct() {
        date_default_timezone_set("America/Bahia");
        $this->modelo = new Modelo();
    }

    public function acessar() {

        session_start();

        if (!isset($_SESSION['usuario'])) {
            header("Location: http:/algtot/index.php");
        } else {

            $url = explode("/", $_SERVER['REQUEST_URI']);

            $aplicacao = $url[3];
            $cdGrupo = $_SESSION['cdGrupo'];

            $select = "SELECT aplicacao FROM aplicacao, grupo WHERE grupo.cdGrupo = aplicacao.cdGrupo
                                    AND aplicacao = ?
                                    AND aplicacao.cdGrupo = ?
                                    ORDER BY cdAplicacao ASC";
            $dados = array($aplicacao, $cdGrupo);
            $dados = $this->modelo->selecionar($select, $dados);

            foreach ($dados as $key => $value) {
                $value['aplicacao'];
            }

            //QUANDO NÃƒO ESTIVER NESSAS APLICAÃ‡Ã•ES E ESTIVER EM ALGUMA QUE FOR VERIFICAVEL EU UNSETO A ATIVIDADE E O TIPO
            if (($aplicacao != 'questaoTipo1.php') && ($aplicacao != 'questaoTipo2.php') && ($aplicacao != 'questaoTipo3.php')) {
                unset($_SESSION['atividade']);
                unset($_SESSION['tipo']);
                echo "<script>localStorage.removeItem('porcentagemAtualCookie');</script>";
            }            

            if ($value['aplicacao'] != $aplicacao) {
                $this->mostrarPagina();
            }
        }
    }

    public function verificarApresentacao() {

        session_start();
        $url = explode("/", $_SERVER['REQUEST_URI']);
        $aplicacao = $url[3];
        //QUANDO NÃƒO ESTIVER NESSAS APLICAÃ‡Ã•ES E ESTIVER EM ALGUMA QUE FOR VERIFICAVEL EU UNSETO A ATIVIDADE E O TIPO
        if (($aplicacao != 'questaoTipo1.php') && ($aplicacao != 'questaoTipo2.php') && ($aplicacao != 'questaoTipo3.php')) {
            unset($_SESSION['atividade']);
            unset($_SESSION['tipo']);
            echo "<script>localStorage.removeItem('porcentagemAtualCookie');</script>";
        }
    }

    public function mostrarPagina() {

        if ($_SESSION['cdGrupo'] == 1) {
            header("Location: http:/algtot/visao/principalADM.php");
        }

        if ($_SESSION['cdGrupo'] == 2) {
            header("Location: http:/algtot/visao/principalProfessor.php");
        }

        if ($_SESSION['cdGrupo'] == 3) {
            header("Location: http:/algtot/visao/principal.php");
        }
    }

}
