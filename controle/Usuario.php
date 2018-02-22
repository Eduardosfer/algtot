<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author EduSfer
 */
require_once("../modelo/Modelo.php");
require_once("../controle/AlgTot.php");

date_default_timezone_set('America/Sao_Paulo');

header('Content-Type: text/html; charset=UTF-8');

new Usuario();

Class Usuario {

    private $modelo;
    private $cdUsuario;
    private $usuario;
    private $senha;
    private $cdGrupo;
    private $email;
    private $data;
    private $nivel1;
    private $nivel2;
    private $nivel3;
    private $nivel4;
    private $nivel5;
    private $pontuacaoTotal;

    public function __construct() {

        $this->modelo = new Modelo();
        $this->AlgTot = new AlgTot();

        if (!isset($_POST['acao'])) {

            $_POST['acao'] = "";
        }

        switch ($_POST['acao']) {

            case 'Logar':
                $this->logar();
                break;

            case 'Cadastrar':
                $this->cadastrar();
                break;

            case 'Deslogar':
                $this->deslogar();
                break;

            case 'AlterarUsuario':
                $this->alterarUsuario();
                break;

            case 'ExcluirConta':
                $this->excluirConta();
                break;

            case 'RecuperarSenha':
                $this->recuperarSenha();
                break;

            case 'ExcluirUsuario':
                $this->excluirUsuario();
                break;

            case 'EditarUsuario':
                $this->editarUsuario();
                break;
        }
    }

    public function deslogar() {
        session_start();
        session_destroy();
        header("Location: http:/algtot/index.php");
    }

    public function logar() {

        $this->setUsuario($_POST['usuario']);
        $this->setSenha($_POST['senha']);

        if (($this->usuario != null) && ($this->senha != null)) {

            if ($this->verificarLogin() == true) {

                session_start();

                $_SESSION['usuario'] = $this->usuario;
                $_SESSION['senha'] = $this->senha;
                $_SESSION['cdGrupo'] = $this->cdGrupo;
                $_SESSION['email'] = $this->email;
                $_SESSION['cdUsuario'] = $this->cdUsuario;
                $_SESSION['data'] = $this->data;
                $_SESSION['nivel1'] = $this->nivel1;
                $_SESSION['nivel2'] = $this->nivel2;
                $_SESSION['nivel3'] = $this->nivel3;
                $_SESSION['nivel4'] = $this->nivel4;
                $_SESSION['nivel5'] = $this->nivel5;
                $_SESSION['pontuacaoTotal'] = $this->pontuacaoTotal;

                //Verificando qual o grupo do usuario em questão e redirecionando para a pagina inicial e que ele pode ter acesso.
                if ($_SESSION['cdGrupo'] == 1) {
                    header("Location: http:/algtot/visao/principalADM.php");
                }

                if ($_SESSION['cdGrupo'] == 2) {
                    header("Location: http:/algtot/visao/principalProfessor.php");
                }

                if ($_SESSION['cdGrupo'] == 3) {
                    header("Location: http:/algtot/visao/principal.php");
                }
            } else {                
                $this->AlgTot->setModalRedirecionar('', 'Usuário ou senha incorretos.', '', 'meuModalErro', '../index.php');
            }
        }
    }

    public function verificarLogin() {

        $resultado = false;
        $value = null;

        $select = "SELECT * FROM usuario WHERE usuario = ? AND senha = ? AND status = ?";
        $dados = array($this->usuario, $this->senha, 'ativo');
        $dados = $this->modelo->selecionar($select, $dados);

        foreach ($dados as $key => $value) {
            $value['cdUsuario'];
            $value['usuario'];
            $value['senha'];
            $value['cdGrupo'];
            $value['email'];
            $value['data'];
            $value['nivel1'];
            $value['nivel2'];
            $value['nivel3'];
            $value['nivel4'];
            $value['nivel5'];
            $value['pontuacaoTotal'];
        }

        if (($value['usuario'] == $this->usuario) && ($value['senha'] == $this->senha)) {

            $this->cdUsuario = $value['cdUsuario'];
            $this->usuario = $value['usuario'];
            $this->senha = $value['senha'];
            $this->cdGrupo = $value['cdGrupo'];
            $this->email = $value['email'];
            $this->data = $value['data'];
            $this->nivel1 = $value['nivel1'];
            $this->nivel2 = $value['nivel2'];
            $this->nivel3 = $value['nivel3'];
            $this->nivel4 = $value['nivel4'];
            $this->nivel5 = $value['nivel5'];
            $this->pontuacaoTotal = $value['pontuacaoTotal'];

            $resultado = true;
        }

        return $resultado;
    }

    public function cadastrar() {

        session_start();

        if (!isset($_SESSION['cdGrupo'])) {
            $_SESSION['cdGrupo'] = null;
        }

        if ($_SESSION['cdGrupo'] == 1) {

            $this->setUsuario($_POST['usuario']);
            $this->setSenha($_POST['senha']);
            $this->setEmail($_POST['email']);
            $this->setCdGrupo($_POST['cdGrupo']);
            $this->setData(date('Y-m-d'));
            $mensagem = "";

            if (($this->usuario != null) && ($this->senha != null) && ($this->email != null) && ($this->cdGrupo != null)) {

                $select = "SELECT count(usuario) AS quantidade FROM usuario WHERE usuario = ? AND status = ?";
                $dados = array($this->usuario, 'ativo');

                if ($this->verificarDuplicidade($select, $dados) == true) {

                    $select = "SELECT count(email) AS quantidade FROM usuario WHERE email = ? AND status = ?";
                    $dados = array($this->email, 'ativo');

                    if ($this->verificarDuplicidade($select, $dados) == true) {

                        $insert = "INSERT INTO usuario(usuario, senha, email, cdGrupo, status, data,
													nivel1, nivel2, nivel3, nivel4, nivel5, pontuacaoTotal)
													VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $dados = array($this->usuario, $this->senha, $this->email, $this->cdGrupo, 'ativo', $this->data, 0, 0, 0, 0, 0, 0);
                        $this->modelo->cadastrar($insert, $dados);

                        $mensagem = $mensagem . 'Usuário cadastrado com sucesso!\n';
                    } else {

                        $mensagem = $mensagem . 'Este e-mail já foi cadastrado para um usuário, tente utiliza outro e-mail!\n';
                    }
                } else {

                    $mensagem = $mensagem . 'Este usuário já foi cadastrado, tente outro nome de usuário!\n';
                }

                $this->mostrarMensagemRedirecionar($mensagem, "../visao/usuariosADM.php");
            } else {

                $this->mostrarMensagemRedirecionar("Erro ao cadastrar", "../visao/usuariosADM.php");
            }
        }

        if (!isset($_SESSION['cdGrupo'])) {

            $this->setUsuario($_POST['usuario']);
            $this->setSenha($_POST['senha']);
            $this->setEmail($_POST['email']);
            $this->setCdGrupo(3);
            $this->setData(date('Y-m-d'));
            $mensagem = "";

            if (($this->usuario != null) && ($this->senha != null) && ($this->email != null) && ($this->cdGrupo != null)) {

                $select = "SELECT count(usuario) AS quantidade FROM usuario WHERE usuario = ? AND status = ?";
                $dados = array($this->usuario, 'ativo');

                if ($this->verificarDuplicidade($select, $dados) == true) {

                    $select = "SELECT count(email) AS quantidade FROM usuario WHERE email = ? AND status = ?";
                    $dados = array($this->email, 'ativo');

                    if ($this->verificarDuplicidade($select, $dados) == true) {

                        $insert = "INSERT INTO usuario(usuario, senha, email, cdGrupo, status, data,
													nivel1, nivel2, nivel3, nivel4, nivel5, pontuacaoTotal)
													VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $dados = array($this->usuario, $this->senha, $this->email, $this->cdGrupo, 'ativo', $this->data, 0, 0, 0, 0, 0, 0);
                        $this->modelo->cadastrar($insert, $dados);

                        $mensagem = $mensagem . 'Usuário cadastrado com sucesso!\n';
                    } else {

                        $mensagem = $mensagem . 'Este e-mail já foi cadastrado para um usuário, tente utiliza outro e-mail!\n';
                    }
                } else {

                    $mensagem = $mensagem . 'Este usuário já foi cadastrado, tente outro nome de usuário!\n';
                }

                $this->mostrarMensagemRedirecionar($mensagem, "../index.php");
            } else {

                $this->mostrarMensagemRedirecionar("Erro ao cadastrar", "../index.php");
            }
        }
    }

    public function alterarUsuario() {

        session_start();

        if (!isset($_POST['usuario'])) {
            $this->setUsuario(null);
        } else {
            $this->setUsuario($_POST['usuario']);
        }
        if (!isset($_POST['senha'])) {
            $this->setSenha(null);
        } else {
            $this->setSenha($_POST['senha']);
        }
        if (!isset($_SESSION['cdUsuario'])) {
            $this->cdUsuario = null;
        } else {
            $this->cdUsuario = $_SESSION['cdUsuario'];
        }
        if (!isset($_SESSION['cdGrupo'])) {
            $this->cdGrupo = null;
        } else {
            $this->cdGrupo = $_SESSION['cdGrupo'];
        }
        if (!isset($_SESSION['email'])) {
            $this->email = null;
        } else {
            $this->email = $_SESSION['email'];
        }
        if (!isset($_POST['email'])) {
            $novoEmail = null;
        } else {
            $novoEmail = $_POST['email'];
        }
        if (!isset($_POST['cdGrupo'])) {
            $novoGrupo = null;
        } else {
            $novoGrupo = $_POST['cdGrupo'];
        }
        if (!isset($_POST['novaSenha'])) {
            $novaSenha = null;
        } else {
            $novaSenha = $_POST['novaSenha'];
        }
        if (!isset($_SESSION['usuario'])) {
            $antigoUsuario = null;
        } else {
            $antigoUsuario = $_SESSION['usuario'];
        }
        if (!isset($_SESSION['senha'])) {
            $antigaSenha = null;
        } else {
            $antigaSenha = $_SESSION['senha'];
        }

        $mensagem = "";

        if (isset($antigoUsuario)) {

            if ((isset($novoEmail)) && ($this->email != $novoEmail)) {

                $select = "SELECT count(email) AS quantidade FROM usuario WHERE email = ? AND cdUsuario != ? AND status = ?";
                $dados = array($novoEmail, $this->cdUsuario, 'ativo');

                if ($this->verificarDuplicidade($select, $dados) == true) {

                    $update = "UPDATE usuario SET email = ? WHERE cdUsuario = ? AND status = ?";
                    $dados = array($novoEmail, $this->cdUsuario, 'ativo');
                    $this->modelo->alterar($update, $dados);
                    $_SESSION['email'] = $novoEmail;
                    $mensagem = $mensagem . 'E-mail alterado com sucesso!\n';
                } else {

                    $mensagem = $mensagem . 'Já existe um usuário utilizando este e-mail!\n';
                }
            }

            if ((isset($this->usuario)) && ($this->usuario != $antigoUsuario)) {

                $select = "SELECT count(usuario) AS quantidade FROM usuario WHERE usuario = ? AND cdUsuario != ? AND status = ?";
                $dados = array($this->usuario, $this->cdUsuario, 'ativo');

                if ($this->verificarDuplicidade($select, $dados) == true) {

                    $update = "UPDATE usuario SET usuario = ? WHERE cdUsuario = ? AND status = ?";
                    $dados = array($this->usuario, $this->cdUsuario, 'ativo');
                    $this->modelo->alterar($update, $dados);
                    $_SESSION['usuario'] = $this->usuario;
                    $mensagem = $mensagem . 'Nome de usuário alterado com sucesso!\n';
                } else {

                    $mensagem = $mensagem . 'Já existe um usuário com este nome!\n';
                }
            }

            if (isset($this->senha)) {

                if ($this->senha == $antigaSenha) {

                    if ($this->senha != $novaSenha) {

                        $update = "UPDATE usuario SET senha = ? WHERE cdUsuario = ? AND status = ?";
                        $dados = array($novaSenha, $this->cdUsuario, 'ativo');
                        $this->modelo->alterar($update, $dados);
                        $_SESSION['senha'] = $novaSenha;
                        $mensagem = $mensagem . 'Senha alterada com sucesso!\n';
                    } else {

                        $mensagem = $mensagem . 'Nenhuma alteração feita na senha!\n';
                    }
                } else {

                    $mensagem = $mensagem . 'A senha atual nao esta correta, senha nao alterada!\n';
                }
            }

            //REDIRECIONANDO PARA A PÁGINA QUE O USUÁRIO ESTAVA ANTERIORMENTE
            $paginaAnterior = $_SERVER['HTTP_REFERER'];
            $this->mostrarMensagemRedirecionar($mensagem, $paginaAnterior);
        }
    }

    public function editarUsuario() {

        session_start();

        $this->cdUsuario = $_POST['cdUsuario'];
        $mensagem = "";
        $this->cdGrupo = $_SESSION['cdGrupo'];

        if ((isset($this->cdGrupo)) && ($this->cdGrupo == 1)) {

            if (!isset($_POST['usuario'])) {

                $this->usuario = null;
            } else {

                $this->usuario = $_POST['usuario'];

                $select = "SELECT count(usuario) AS quantidade FROM usuario WHERE usuario = ? AND cdUsuario != ? AND status = ?";
                $dados = array($this->usuario, $this->cdUsuario, 'ativo');

                if ($this->verificarDuplicidade($select, $dados) == true) {

                    $update = "UPDATE usuario SET usuario = ? WHERE cdUsuario = ? AND status = ?";
                    $dados = array($this->usuario, $this->cdUsuario, 'ativo');
                    $this->modelo->alterar($update, $dados);
                    $mensagem = $mensagem . 'Nome de usuário alterado com sucesso!\n';
                } else {

                    $mensagem = $mensagem . 'Já existe um usuário com este nome!\n';
                }
            }

            if (!isset($_POST['senha'])) {

                $this->senha = null;
            } else {

                $this->senha = $_POST['senha'];

                $update = "UPDATE usuario SET senha = ? WHERE cdUsuario = ? AND status = ?";
                $dados = array($this->senha, $this->cdUsuario, 'ativo');
                $this->modelo->alterar($update, $dados);
                $mensagem = $mensagem . 'Senha alterada com sucesso!\n';
            }

            if (!isset($_POST['email'])) {

                $this->email = null;
            } else {

                $this->email = $_POST['email'];

                $select = "SELECT count(email) AS quantidade FROM usuario WHERE email = ? AND cdUsuario != ? AND status = ?";
                $dados = array($this->email, $this->cdUsuario, 'ativo');

                if ($this->verificarDuplicidade($select, $dados) == true) {

                    $update = "UPDATE usuario SET email = ? WHERE cdUsuario = ? AND status = ?";
                    $dados = array($this->email, $this->cdUsuario, 'ativo');
                    $this->modelo->alterar($update, $dados);
                    $mensagem = $mensagem . 'E-mail alterado com sucesso!\n';
                } else {

                    $mensagem = $mensagem . 'Já existe um usuário utilizando este e-mail!\n';
                }
            }

            $this->mostrarMensagemRedirecionar($mensagem, "../visao/usuariosADM.php");
        }
    }

    public function verificarDuplicidade($select, $dados) {

        $resultado = false;

        $dados = $this->modelo->selecionar($select, $dados);

        foreach ($dados as $key => $value) {
            $value['quantidade'];
        }

        if ($value['quantidade'] == 0) {

            $resultado = true;
        }

        return $resultado;
    }

    public function excluirConta() {

        session_start();

        $mensagem = null;
        $this->setCdUsuario($_SESSION['cdUsuario']);
        $this->setSenha($_SESSION['senha']);
        $this->setCdGrupo($_SESSION['cdGrupo']);
        if (!isset($_POST['senhaExcluir'])) {
            $senhaExcluir = null;
        } else {
            $senhaExcluir = $_POST['senhaExcluir'];
        }

        if (isset($_SESSION['usuario'])) {

            if ($this->senha == $senhaExcluir) {

                $update = "UPDATE usuario SET status = ? WHERE cdUsuario = ?";
                $dados = array('deletado', $this->cdUsuario);
                $this->modelo->excluir($update, $dados);
                session_destroy();

                $this->mostrarMensagemRedirecionar("Sua conta foi excluída!", "../index.php");
            } else {

                $mensagem = "Senha incorreta!";
                //REDIRECIONANDO PARA A PÁGINA QUE O USUÁRIO ESTAVA ANTERIORMENTE
                $paginaAnterior = $_SERVER['HTTP_REFERER'];
                $this->mostrarMensagemRedirecionar($mensagem, $paginaAnterior);
            }
        } else {

            $this->mostrarMensagemRedirecionar(null, "../index.php");
        }
    }

    public function excluirUsuario() {

        session_start();
        $this->setCdGrupo($_SESSION['cdGrupo']);
        $grupoExcluir = $_POST['cdGrupo'];
        $usuarioExcluir = $_POST['cdUsuario'];


        if ((isset($_SESSION['usuario'])) && ($this->cdGrupo == 1)) {

            $update = "UPDATE usuario SET status = ? WHERE cdUsuario = ?";
            $dados = array('deletado', $usuarioExcluir);
            $this->modelo->excluir($update, $dados);
            $this->mostrarMensagemRedirecionar("Conta foi excluída com êxito!", "../visao/usuariosADM.php");
        } else {

            $this->mostrarMensagemRedirecionar("Erro!!", "../index.php");
        }
    }

    public function recuperarSenha() {

        $this->setUsuario($_POST['usuario']);

        if (isset($this->usuario)) {

            $select = "SELECT email, senha FROM usuario WHERE usuario = ? AND status = ?";
            $dados = array($this->usuario, 'ativo');
            $dados = $this->modelo->selecionar($select, $dados);

            foreach ($dados as $key => $value) {
                $value['email'];
                $value['senha'];
            }

            if (!isset($value['email'])) {
                $value['email'] = null;
            }
            if (!isset($value['senha'])) {
                $value['senha'] = null;
            }

            $this->setSenha($value['senha']);
            $this->setEmail($value['email']);

            if (isset($this->email)) {

                /*
                  $para = $this->email;
                  $assunto = 'Recuperação de senha, AlgTot';
                  $mensagem = 'Sua senha: ' . $this->senha;
                  $headers = "MIME-Version: 1.1/r/n";
                  $headers .= "Content-type: text/plain; charset=iso-8859-1/r/n";
                  $headers .= "From: AlgTot - AlgTot <algtot@outlook.com.br>/r/n";
                  $headers .= "Return-Path: AlgTot - AlgTot <algtot@outlook.com.br>";

                  if (mail($para, $assunto, $mensagem, $headers) == true) {

                  $this->mostrarMensagemRedirecionar("Uma mensagem foi enviada para sua caixa de e-mail.", "../index.php");
                  } else {

                  $this->mostrarMensagemRedirecionar("Não foi possivel enviar o e-mail, tente novamente!", "../index.php");
                  } */

                $this->mostrarMensagemRedirecionar("Este serviço ainda não está funcionando !\\nEnvie um e-mail para algtot@outlook.com.br solicitando a sua senha\\nVocê deve utilizar o e-mail que está vinculado com o seu usuário do AlgTot!", "../index.php");
            } else {

                $this->mostrarMensagemRedirecionar("Usuário inválido!", "../index.php");
            }
        }
    }

    //Metodo que mostra uma mensagem e permite o redirecionamento
    public function mostrarMensagemRedirecionar($mensagem, $endereco) {

        if ($mensagem != null) {
            echo "<script>alert('" . $mensagem . "')</script>";
        }

        if ($endereco != null) {
            echo "<script>window.location = '" . $endereco . "';</script>";
        }
    }

    public function setCdUsuario($cdUsuario) {
        $this->cdUsuario = $cdUsuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setCdGrupo($cdGrupo) {
        $this->cdGrupo = $cdGrupo;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getCdUsuario() {
        return $this->cdUsuario;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getCdGrupo() {
        return $this->cdGrupo;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getData() {
        return $this->data;
    }

}
