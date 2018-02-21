<?php
require_once("../controle/Acesso.php");
require_once("../modelo/Modelo.php");

$acesso = new Acesso();
$modelo = new Modelo();

$acesso->acessar();
?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Eduardo Soares Ferreira">

        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->

        <title>AlgtTot: Usuários ADM</title>

    </head>

    <!-- Bootstrap -->
    <body>

        <!-- MENU DO ADM -->
<?php include_once ("includs/menuADM.php"); ?>

        <!-- MODAL PARA SAIR DO SISTEMA -->
<?php include_once("includs/modalSair.php"); ?>

        <!--MODAL DE VISUALIZAÇÃO E EDIÇÃO DE DADOS-->
<?php include_once("includs/modalVerEditarPerfil.php"); ?>

        <!--MODAL DE EXCLUIR PERFIL-->
<?php include_once("includs/modalExcluirPerfil.php"); ?>

        <!--Modal de cadastrar usuário-->
        <div id="cadastrarUsuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header" style="background-color: #4cae4c; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Cadastar Usuário</h4>
                    </div>

                    <form name="cadastrarUsuario" action="../controle/Usuario.php" method="post">

                        <div class="modal-body">

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-user"></span></span>
                                <input name="usuario" type="text" minlength="3" maxlength="20" class="form-control" required placeholder="Usuário" pattern="[a-zA-Z0-9]+" title="Insira um nome de usuário: Apenas letras e números: Maximo 20 caracteres" aria-describedby="sizing-addon2">
                            </div>

                            <br>

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2">@</span>
                                <input name="email" type="email" class="form-control" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="email" title="Insira o e-mail: este e-mail pode ser utilizado para recuperar a conta" aria-describedby="sizing-addon2">
                            </div>

                            <br>

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-flash"></span></span>
                                <select required name="cdGrupo" class="form-control">
                                    <option value="" selected>Selecione um grupo</option>

<?php
$select = "SELECT cdGrupo, grupo FROM grupo ORDER bY grupo ASC";
$dados = array('');

$grupos = $modelo->selecionar($select, $dados);

foreach ($grupos as $key => $grupo) {
    ?>

                                        <option value="<?php echo $grupo['cdGrupo']; ?>"><?php echo $grupo['grupo']; ?></option>

    <?php
}
?>

                                </select>
                            </div>

                            <br>

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                                <input name="senha" id="senhaCadastro" type="password" pattern="\S+" oninput="validarSenha(document.getElementById('senhaCadastro'),document.getElementById('confirmarSenhaCadastro'),document.getElementById('acaoCadastro'))" minlength="3" maxlength="20" class="form-control" required placeholder="Senha" title="Digite uma senha: Maximo 20 caracteres, exceto espaços em branco" aria-describedby="sizing-addon2">
                            </div>

                            <br>

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                                <input name="confirmarSenha" id="confirmarSenhaCadastro" minlength="3" maxlength="20" type="password" pattern="\S+" oninput="validarSenha(document.getElementById('senhaCadastro'),document.getElementById('confirmarSenhaCadastro'),document.getElementById('acaoCadastro'))" class="form-control" required placeholder="Confirme a Senha" title="Confirme a senha digitada acima, exceto espaços em branco" aria-describedby="sizing-addon2">
                            </div>

                            <br>
                            <div id="alertaSenhaIncorretaUsuariosADM" class="alert alert-danger text-center" style="display:none;" title="Senhas não conferem!" role="alert">Senhas não conferem!</div>

                        </div>

                        <div class="modal-footer">
                            <button name="acao" id="acaoCadastro" type="button" value="Cadastrar" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Cadastrar</button>
                        </div>

                    </form>

                </div>

            </div><!-- /.modal-content -->

        </div><!-- /.modal-dialog -->

        <section id="conteudo" class="container">

            <br>
            <br>
            <br>

            <div class="row">

                <div class="col-sm">

                    <div class="panel panel-default">

                        <div class="panel-heading" style="background-color: #4cae4c; color:white;">

                            <div style="text-align: center;">
                                <h3 class="blog-title">Usuários</h3>
                            </div>

                            <form class="form-inline" role="search" action="usuariosADM.php" method="post">

                                <div class="form-group">
                                    <div class="col">
                                        <a href="#" data-toggle="modal" data-target="#cadastrarUsuario" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Cadastrar Usuário</a>
                                    </div>
                                </div>

<?php
if (!isset($_POST['parametro'])) {

    $_POST['parametro'] = null;
}

if (!isset($_POST['buscarPor'])) {

    $_POST['buscarPor'] = null;
}
?>

                                <div class="form-group">

                                    <div class="col">
                                        <select required id="buscarPor" title="Selecione pelo que gostaria de buscar" name="buscarPor" class="form-control">

                                            <option value="" <?php if (($_POST['buscarPor'] == null) && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Buscar por</option>
                                            <option value="usuario.usuario" <?php if (($_POST['buscarPor'] == 'usuario.usuario') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Usuário</option>

                                            <option value="usuario.email" <?php if (($_POST['buscarPor'] == 'usuario.email') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >E-mail</option>

                                            <option value="grupo.grupo" <?php if (($_POST['buscarPor'] == 'grupo.grupo') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Grupo</option>

                                            <option value="usuario.data" <?php if (($_POST['buscarPor'] == 'usuario.data') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Data cadastramento</option>

                                        </select>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="col">

                                        <input required type="text" class="form-control" <?php if (isset($_POST['parametro'])) {
                                    echo "value=" . "'" . $_POST['parametro'] . "'";
                                } ?> placeholder="Busca" name="parametro" title="Digite aqui sua busca">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col">
                                        <button type="submit" name="buscar" value="Buscar" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col">
                                        <a name="usuariosADM" href="usuariosADM.php" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span> Usuários</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col">
                                        <a name="voltarInicio" href="principalADM.php" class="btn btn-default"><span class="glyphicon glyphicon-home"></span> Início</a>
                                    </div>
                                </div>

                            </form>

                        </div>

                        <div class="table-responsive panel-body">

                            <table class="table table-bordered">

                                <thead>
                                    <th>Usuário</th>
                                    <th>Senha</th>
                                    <th>Grupo</th>
                                    <th>E-mail</th>
                                    <th>Data de cadastro</th>
                                    <th>Ações</th>
                                </thead>

                                <tbody>

                                    <?php
                                    //pegando numero de linhas
                                    if (($_POST['buscarPor'] != null) && ($_POST['parametro'] != null)) {

                                        $campo = $_POST['buscarPor'];
                                        $parametro = $_POST['parametro'];

                                        $select = "SELECT count(usuario.cdUsuario) AS numLinhas FROM usuario, grupo
                                      WHERE  usuario.cdGrupo = grupo.cdGrupo
                                      AND usuario.status = ? AND $campo LIKE ?";
                                        $dados = array('ativo', '%' . $parametro . '%');
                                    } else {

                                        $select = "SELECT count(cdUsuario) AS numLinhas FROM usuario WHERE status = ?";
                                        $dados = array('ativo');
                                    }

                                    $numLinhas = $modelo->selecionar($select, $dados);

                                    foreach ($numLinhas as $key => $value) {
                                        $totalLinhas = $value['numLinhas'];
                                    }

                                    $ultimaPagina = $totalLinhas / 7;

                                    //Arredondado o valor de ultima pagina para o proximo numero intero
                                    $ultimaPagina = ceil($ultimaPagina);

                                    //Não pode existir pagina 0 mas quando não existem resoltados na busca essa se torna 0, isso ocasiona erro na consulta, por isso deve ser substituido po 1 que é o minimo permitido.
                                    if ($ultimaPagina == 0) {

                                        $ultimaPagina = 1;
                                    }

                                    if (!isset($_POST['paginar'])) {

                                        //configuração padrão
                                        $_POST['pagina'] = 1;
                                        $_POST['offset'] = 0;
                                        $pagina = $_POST['pagina'];
                                        $offset = $_POST['offset'];
                                    } else {

                                        //configuração padrão pegando a pagina atual
                                        $pagina = $_POST['pagina'];
                                        $offset = $_POST['offset'];

                                        if (($_POST['paginar'] == 'anterior') && ($pagina >= 2)) {

                                            $pagina = $pagina - 1;
                                            $offset = $offset - 7;
                                        }

                                        if (($_POST['paginar'] == 'proxima') && ($pagina >= 1) && ($pagina < $ultimaPagina)) {

                                            $pagina = $pagina + 1;
                                            $offset = $offset + 7;
                                        }

                                        if ($_POST['paginar'] == 'primeira') {

                                            $pagina = 1;
                                            $offset = 0;
                                        }

                                        if ($_POST['paginar'] == 'ultima') {

                                            $pagina = $ultimaPagina;

                                            //É necessario subtrair -1 pois o offset inicia-se em 0 e a numeracao das paginas em 1
                                            $offset = ($ultimaPagina - 1) * 7;
                                        }
                                    }

                                    if (($_POST['buscarPor'] != null) && ($_POST['parametro'] != null)) {

                                        $campo = $_POST['buscarPor'];
                                        $parametro = $_POST['parametro'];

                                        $select = "SELECT usuario.*, grupo.grupo AS grupo FROM usuario, grupo
                                    WHERE usuario.cdGrupo = grupo.cdGrupo AND usuario.status = ?
                                    AND $campo LIKE ? ORDER BY $campo ASC LIMIT $offset,7";
                                        $dados = array('ativo', '%' . $parametro . '%');
                                    } else {

                                        $select = "SELECT usuario.*, grupo.grupo AS grupo FROM usuario, grupo
                                    WHERE usuario.cdGrupo = grupo.cdGrupo AND usuario.status = ?
                                    ORDER BY usuario.cdUsuario DESC LIMIT $offset,7";
                                        $dados = array('ativo');
                                    }

                                    $dados = $modelo->selecionar($select, $dados);

                                    foreach ($dados as $key => $dado) {

                                        $dado['usuario'] = htmlspecialchars($dado['usuario']);
                                        $dado['senha'] = htmlspecialchars($dado['senha']);
                                        $dado['grupo'] = htmlspecialchars($dado['grupo']);
                                        $dado['email'] = htmlspecialchars($dado['email']);
                                        $dado['data'] = htmlspecialchars($dado['data']);
                                        ?>

                                        <tr>
                                            <td><?php echo $dado['usuario']; ?></td>
                                            <td><?php echo $dado['senha']; ?></td>
                                            <td><?php echo $dado['grupo']; ?></td>
                                            <td><?php echo $dado['email']; ?></td>
                                            <td><?php echo date("d/m/Y", strtotime($dado['data'])); ?></td>

                                            <td style="width: 105px;">
                                                <button type="button" class="btn btn-danger" title="Excluir conta" data-toggle="modal" data-target="#excluir<?php echo $dado['cdUsuario'] ?>"><span class="glyphicon glyphicon-trash"></span></button>

                                                <button type="button" class="btn btn-success" title="Ver e/ou editar os dados!" data-toggle="modal" data-target="#editarConta<?php echo $dado['cdUsuario'] ?>"><span class="glyphicon glyphicon-edit"></span></button>
                                                <!--MODAL DE EXCLUSÃO-->

                                                <div id="excluir<?php echo $dado['cdUsuario'] ?>" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="gridSystemModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <form class="form-horizontal" action="../controle/Usuario.php" method="post">
                                                            <div class="modal-content">

                                                                <div class="modal-header" style="background-color: #d43f3a; color: white">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fexar"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="gridSystemModalLabel">Deseja realmente excuir este Usuário ?</h4>
                                                                </div>

                                                                <div class="modal-body">

                                                                    <input type="hidden" name="cdGrupo" value="<?php echo $dado['cdGrupo']; ?>">
                                                                    <input type="hidden" name="cdUsuario" value="<?php echo $dado['cdUsuario']; ?>">

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2">
                                                                            <span class="glyphicon glyphicon-user"></span>
                                                                        </span>
                                                                        <input name="usuario" minlength="3" maxlength="20" type="text" class="form-control" value="<?php echo $dado['usuario']; ?>" disabled required placeholder="Usuário" pattern="[a-zA-Z0-9]+" title="Nome de usuário da conta." aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2">
                                                                            <span class="glyphicon glyphicon-lock"></span>
                                                                        </span>
                                                                        <input name="senha" type="text" pattern="\S+" minlength="3" maxlength="20" class="form-control" value="<?php echo $dado['senha']; ?>" disabled required placeholder="Senha" title="Senha do usuário" aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2">@</span>
                                                                        <input name="email" type="email" class="form-control" disabled pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo $dado['email']; ?>" placeholder="email" title="Este e-mail pode ser utilizado para recuperar a senha da sua conta" aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                        <input name="data" type="date" class="form-control" disabled value="<?php echo $dado['data']; ?>" placeholder="data" title="Esta é a data de cadastramento da conta." aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-flash"></span></span>
                                                                        <input name="grupo" type="text" class="form-control" disabled value="<?php echo $dado['grupo']; ?>" placeholder="Grupo" title="Este é a grupo deste usuário." aria-describedby="sizing-addon2">
                                                                    </div>

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                                                                    <button type="submit" value="ExcluirUsuario" name="acao" class="btn btn-danger">Sim</button>
                                                                </div>

                                                            </div><!-- /.modal-content -->
                                                        </form>
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->

                                                <!--Modal de visualização e edição de dado-->
                                                <div id="editarConta<?php echo $dado['cdUsuario'] ?>" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="gridSystemModalLabel">

                                                    <div class="modal-dialog" role="document">

                                                        <div class="modal-content">

                                                            <div class="modal-header" style="background-color: #4cae4c; color: white;">
                                                                <a  class="close"  href="usuariosADM.php" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                                                                <h4 class="modal-title" id="gridSystemModalLabel">Usuário: <?php echo $dado['usuario']; ?></h4>
                                                            </div>

                                                            <form name="alterarUsuarioF" action="../controle/Usuario.php" method="post">

                                                                <input type="hidden" name="cdGrupo" value="<?php echo $dado['cdGrupo']; ?>">
                                                                <input type="hidden" name="cdUsuario" value="<?php echo $dado['cdUsuario']; ?>">

                                                                <div class="modal-body">

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2">
                                                                            <span class="glyphicon glyphicon-user"></span>
                                                                        </span>
                                                                        <input name="usuario" id="usuario<?php echo $dado['cdUsuario'] ?>" minlength="3" maxlength="20" type="text" class="form-control" value="<?php echo $dado['usuario']; ?>" disabled required placeholder="Usuário" pattern="[a-zA-Z0-9]+" title="Insira um nome de usuário: Apenas letras e números: Maximo 20 caracteres" aria-describedby="sizing-addon2">
                                                                        <span class="input-group-btn">
                                                                            <button id="editarUsuario<?php echo $dado['cdUsuario'] ?>" class="btn btn-default" title="Clique para editar o nome de usuário" onclick="editarInput(document.getElementById('editarUsuario<?php echo $dado['cdUsuario'] ?>'), document.getElementById('usuario<?php echo $dado['cdUsuario'] ?>'))" type="button">Editar</button>
                                                                        </span>
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2">
                                                                            <span class="glyphicon glyphicon-lock"></span>
                                                                        </span>
                                                                        <input name="senha" id="senha<?php echo $dado['cdUsuario'] ?>" type="text" pattern="\S+" minlength="3" maxlength="20" class="form-control" value="<?php echo $dado['senha']; ?>" disabled required placeholder="Senha atual" title="Digite a senha atual: Maximo 20 caracteres, exceto espaços em branco" aria-describedby="sizing-addon2">
                                                                        <span class="input-group-btn">
                                                                            <button id="editarSenha<?php echo $dado['cdUsuario'] ?>" class="btn btn-default" title="Clique para editar a senha" onclick="editarInput(document.getElementById('editarSenha<?php echo $dado['cdUsuario'] ?>'), document.getElementById('senha<?php echo $dado['cdUsuario'] ?>'))" type="button">Editar</button>
                                                                        </span>
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2">@</span>
                                                                        <input name="email" id="email<?php echo $dado['cdUsuario'] ?>" type="email" class="form-control" disabled pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo $dado['email']; ?>" placeholder="email" title="Este e-mail pode ser utilizado para recuperar a senha da sua conta" aria-describedby="sizing-addon2">
                                                                        <span class="input-group-btn">
                                                                            <button id="editarEmail<?php echo $dado['email'] ?>" class="btn btn-default" title="Clique para editar o e-mail do usuário" onclick="editarInput(document.getElementById('editarEmail<?php echo $dado['cdUsuario'] ?>'), document.getElementById('email<?php echo $dado['cdUsuario'] ?>'))" type="button">Editar</button>
                                                                        </span>
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-flash"></span></span>
                                                                        <input name="grupo" type="text" class="form-control" disabled value="<?php echo $dado['grupo']; ?>" placeholder="Grupo" title="Este é a grupo deste usuário." aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                        <input name="data" type="date" class="form-control" disabled value="<?php echo $dado['data']; ?>" placeholder="data" title="Esta é a data de cadastramento da conta." aria-describedby="sizing-addon2">
                                                                    </div>


                                                                </div>

                                                                <div class="modal-footer">
                                                                    <div class="row">
                                                                        <div class="col-sm-4  col-sm-offset-8">
                                                                            <a name="cancelar" href="usuariosADM.php" class="btn btn-default">Cancelar</a>
                                                                            <button name="acao" type="submit" value="EditarUsuario" class="btn btn-success">Salvar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div><!-- /.modal-content -->

                                                </div><!--Fim modal-->

                                                <!--FIM DOS MODAIS-->

                                            </td>

                                        </tr>

    <?php
}
?>

                                </tbody>

                            </table>

                        </div>

                        <div class="panel-footer">

                            <form name="paginacao" action="usuariosADM.php" method="post">

                                <div style="text-align: center">

                                    <input type="hidden" name="pagina" <?php if (isset($_POST['pagina'])) {
    echo "value='" . $pagina . "'";
} ?> >
                                    <input type="hidden" name="offset" <?php if (isset($_POST['offset'])) {
    echo "value='" . $offset . "'";
} ?> >

                                    <input type="hidden" name="buscarPor" <?php if (isset($_POST['buscarPor'])) {
    echo "value='" . $_POST['buscarPor'] . "'";
} ?> >
                                    <input type="hidden" name="parametro" <?php if (isset($_POST['parametro'])) {
    echo "value='" . $_POST['parametro'] . "'";
} ?> >

                                    <button name="paginar" title="Página <?php echo $pagina; ?> de <?php echo $ultimaPagina; ?>" type="button" class="btn btn-success">
                                        <?php echo $pagina; ?> de <?php echo $ultimaPagina; ?>
                                    </button>
                                    <button style="padding: 9px;" name="paginar" title="Ir para primeira página" value="primeira" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-menu-left" ></span><span class="glyphicon glyphicon-menu-left" ></span></button>
                                    <button style="padding: 9px;" name="paginar" title="Ir para página anterior" value="anterior" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-menu-left" ></span></button>
                                    <button name="paginar" title="Página atual" value="atual" type="button" class="btn btn-success">
                                        <?php echo $pagina; ?>
                                    </button>
                                    <button style="padding: 9px;" name="paginar" title="Ir para próxima página" value="proxima" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-menu-right" ></span></button>
                                    <button style="padding: 9px;" name="paginar" title="Ir para ultima página" value="ultima" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-menu-right" ></span><span class="glyphicon glyphicon-menu-right" ></span></button>

                                </div>

                            </form>

                        </div>

                    </div><!--Fim do painel-->

                </div>

            </div>

        </section>

        <!--Minhas verificações -->
        <script src="js/verificacoes.js"></script>

    </body>
</html>
