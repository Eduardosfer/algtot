<?php
require_once("../controle/Acesso.php");
$acesso = new Acesso();
$acesso->verificarApresentacao();
?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="serious game de auxilio na aprendizagem de lógica de programação: Aqui você pode aprender desenvolver rapidamente sua lógica e poderá competir com diversas outras pessoas!">
        <meta name="author" content="Eduardo Soares Ferreira">
        <meta name="keywords" content="logica,programação,aprendizagem,serious game,serious games,ferramenta de aprendizagem,aprendizagem de lógica,jogo de lógica,aprendizagem de programação,aprender a programar,aprender programar,AlgTot,AliGot,aprende lógica,como programar,aprendendo lógica, aprendendo programar">

        <title>AlgTot</title>

        <!-- Bootstrap Core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

        <!-- Plugin CSS -->
        <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

        <!-- Theme CSS -->
        <link href="css/creative.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->

    </head>

    <body id="page-top">
        
        <!-- MODAL DE VISUALIZAÇÃO DE SINTAXE DO PORTUGOL-->
        <?php include_once("includs/modalSintaxePortugol.php"); ?>        

        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">

            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Alterar Navegação</span><i class="fa fa-bars"></i>
                    </button>

                    <a class="navbar-brand page-scroll" href="#page-top">AlgTot</a>

                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-right">

                        <li>
                            <a class="page-scroll" data-toggle="modal" href="remote.html" data-target="#acessar"><span class="glyphicon glyphicon-log-in"></span> Acessar</a>
                        </li>
                        <li>
                            <a class="page-scroll" data-toggle="modal" href="remote.html" data-target="#cadastrar"><span class="glyphicon glyphicon-user"></span> Cadastrar</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#conhecer"><span class="glyphicon glyphicon-education"></span> Conhecer</a>
                        </li>
                        <li>
                            <a name="acaoSintaxe" href="#" value="sintaxe" data-toggle="modal" data-target="#sintaxe" class="page-scroll"><span class="glyphicon glyphicon-book"></span> Sintaxe Portugol</a> 
                        </li>
                        <li>
                            <a class="page-scroll" href="#contato"><span class="glyphicon glyphicon-envelope"></span> Contato</a>
                        </li>

                    </ul>

                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <!-- Modal de Login-->
        <div id="acessar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header" style="background-color:#4cae4c; color:white">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        <h4 class="modal-title" id="gridSystemModalLabel">Faça seu login.</h4>

                    </div>

                    <!--Inicio do formulario de envio de usuario e senha-->
                    <form name="login" action="../controle/Usuario.php" method="post" class="form-horizontal">

                        <div class="modal-body">

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-user"></span></span>
                                <input name="usuario" type="text" minlength="3" maxlength="20" class="form-control" required placeholder="Usuário" pattern="[a-zA-Z0-9]+" title="Insira seu nome de usuário: Apenas letras e números: máximo 20 caracteres" aria-describedby="sizing-addon2">
                            </div>

                            <br>

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" name="senha" pattern="\S+" title="Digite uma senha: Maximo 20 caracteres, exceto espaços em branco" class="form-control" required minlength="3" maxlength="20" placeholder="Senha" title="Digite sua senha: Máximo 20 caracteres" aria-describedby="sizing-addon2">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <a name="acao" value="Logar" data-toggle="modal" data-target="#recuperarSenha" class="btn btn-defult">Recuperar Senha</a>
                            <button name="acao" type="submit" value="Logar" class="btn btn-success"><span class="glyphicon glyphicon-log-in"></span> Entrar</button>
                        </div>

                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

        <!--Modal de recuperação de senha -->
        <div id="recuperarSenha" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header" style="background-color:#4cae4c; color:white">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        <h4 class="modal-title" id="gridSystemModalLabel">Recuperar senha.</h4>

                    </div>

                    <!--Inicio do formulario de envio de usuario para recuperar a senha-->
                    <form name="recuperarSenha" action="../controle/Usuario.php" method="post" class="form-horizontal">

                        <div class="modal-body">

                            <p>Digite o seu nome de usuário. Uma mensagem será enviada para o e-mail registrado para este usuário.</p>

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-user"></span></span>
                                <input name="usuario" type="text" minlength="3" maxlength="20" class="form-control" required placeholder="Usuário" pattern="[a-zA-Z0-9]+" title="Insira seu nome de usuário: Apenas letras e números: Máximo 20 caracteres" aria-describedby="sizing-addon2">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button name="acao" type="submit" value="RecuperarSenha" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Recuperar Senha</button>
                        </div>

                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

        <!-- Modal de Cadastrar no sistema-->
        <div id="cadastrar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header" style="background-color:#F05F40; color:white">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Cadastre-se</h4>
                    </div>

                    <!--Inicio do formulario de cadastro de usuario no sistema-->
                    <form name="cadastrarUsuario" action="../controle/Usuario.php" method="post">

                        <div class="modal-body">

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-user"></span></span>
                                <input name="usuario" type="text" minlength="3" maxlength="20" class="form-control" required placeholder="Usuário" pattern="[a-zA-Z0-9]+" title="Insira um nome de usuário: Apenas letras e números: Maximo 20 caracteres" aria-describedby="sizing-addon2">
                            </div>

                            <br>

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2">@</span>
                                <input name="email" type="email" class="form-control" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="email" title="Insira seu e-mail: este e-mail pode ser utilizado para recuperar a senha da sua conta" aria-describedby="sizing-addon2">
                            </div>

                            <br>

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                                <input name="senha" id="senha" type="password" pattern="\S+" oninput="validarSenha(document.getElementById('senha'),document.getElementById('confirmarSenha'),document.getElementById('acao'))" minlength="3" maxlength="20" class="form-control" required placeholder="Senha" title="Digite uma senha: Maximo 20 caracteres, exceto espaços em branco" aria-describedby="sizing-addon2">
                            </div>

                            <br>

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                                <input name="confirmarSenha" id="confirmarSenha" pattern="\S+" minlength="3" maxlength="20" type="password" oninput="validarSenha(document.getElementById('senha'),document.getElementById('confirmarSenha'),document.getElementById('acao'))" class="form-control" required placeholder="Confirme a Senha" title="Confirme a senha digitada acima" aria-describedby="sizing-addon2">
                            </div>

                            <br>
                            <div id="alertaSenhaIncorreta" class="alert alert-danger text-center" style="display:none;" title="Senhas não conferem!" role="alert">Senhas não conferem!</div>

                        </div>

                        <div class="modal-footer">
                            <button name="acao" id="acao" type="button" value="Cadastrar" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Cadastrar</button>
                        </div>

                    </form>

                </div>

            </div><!-- /.modal-content -->

        </div><!-- /.modal-dialog -->

        <header> 

            <div class="header-content">

                <div class="header-content-inner">

                    <h1 id="homeHeading">Bem vindo ao AlgTot</h1>
                    <hr>

                    <p>O AlgTot é uma serious game de auxílio na aprendizagem de programação básica, focado em quem está dando os primeiros passos no estudo de programação</p>
                    <button class="btn btn-success btn-xl page-scroll" data-toggle="modal" type="button" data-target="#acessar">Acesse já</button> OU
                    <button class="btn btn-primary btn-xl page-scroll" data-toggle="modal" type="button" data-target="#cadastrar">Cadastre-se</button>

                </div>
            </div>

        </header>

        <section id="conhecer">

            <div class="container">

                <div class="row">

                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Como o AlgTot Funciona</h2>
                        <hr class="primary">
                    </div>

                </div>

            </div>

            <div class="container">

                <div class="row">

                    <div class="col-lg-3 col-md-6 text-center">

                        <div class="service-box">
                            <i class="fa fa-4x text-success sr-icons"><span class="glyphicon glyphicon-rub"></span></i>
                            <h3>Aprenda Com Portugol</h3>
                            <p class="text-muted">Aprenda a programar utilizando o Portugol que é uma pseudo linguagem de programação desenvolvida para facilitar no aprendizado.</p>
                            <button name="acaoSintaxe" value="sintaxe" type="button" data-toggle="modal" data-target="#sintaxe" href="#" class="btn btn-success"><span class="glyphicon glyphicon-book"></span> Sintaxe</button>
                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6 text-center">

                        <div class="service-box">
                            <i class="fa fa-4x text-primary sr-icons"><span class="glyphicon glyphicon-sort-by-alphabet"></span></i>
                            <h3>Aprenda a Estruturar Seus Pensamentos</h3>
                            <p class="text-muted">Aprenda desde conceitos básicos de programação como declarar variáveis até conceitos mais avançados utilizando estruturas de repetição.</p>
                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6 text-center">

                        <div class="service-box">
                            <i class="fa fa-4x text-success sr-icons"><span class="glyphicon glyphicon-education"></span></i>
                            <h3>Aprenda Aos Poucos</h3>
                            <p class="text-muted">O AlgTot trabalha com 5 níveis de dificuldade onde são dispostos as atividades, essas atividades possuem três maneiras diferente se responder.</p>
                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6 text-center">

                        <div class="service-box">
                            <i class="fa fa-4x text-primary sr-icons"><span class="glyphicon glyphicon-stats"></span></i>
                            <h3>Compare Seu Desempenho Com o de Outros Usuários</h3>
                            <p class="text-muted">Você poderá ver seu avanço por meio de uma pontuação que é adquirida de acordo responde as atividades, essa pontuação também é comparada com a de outros usuários.</p>
                        </div>

                    </div>
                </div>
            </div>

        </section>

        <section class="no-padding" id="">

            <div class="container-fluid">

                <div class="row no-gutter popup-gallery">

                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/fullsize/3.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/3.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Atividade
                                    </div>
                                    <div class="project-name">
                                        Corra contra o tempo para responder as questões.
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>               

                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/fullsize/2.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/2.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Atividade
                                    </div>
                                    <div class="project-name">
                                        Ordene sequencias lógicas de maneira correta.
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-sm-6">

                        <a href="img/portfolio/fullsize/1.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/1.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Atividade
                                    </div>
                                    <div class="project-name">
                                        Resolva algoritmos utilizando o Portugol.
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>              

                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/fullsize/5.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/5.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Pontuação
                                    </div>
                                    <div class="project-name">
                                        Veja a sua pontuação adquirida em cada nível.
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/fullsize/4.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/4.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Pontuação
                                    </div>
                                    <div class="project-name">
                                        Veja a sua pontuação comparada a de outros usuários.
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/fullsize/6.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/6.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Sintaxe
                                    </div>
                                    <div class="project-name">
                                        Você pode acessar a sintaxe desta versão do portugol facilmente pelo menu.
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>

            </div>

        </section>

        <section id="contato">

            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading">Entre em Contato Conosco</h2>
                        <p>Caso tenha alguma dúvida, reclamação, contribuição ou elogio entre em contato conosco utilizando o e-mail abaixo, e nós iremos lhe responder o mais rápido possível.</p>
                    </div>

                    <div class="col-lg-12 text-center">
                        <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                        <p><a href="mailto:algtot@outlook.com.br">algtot@outlook.com.br</a></p>
                        <hr class="primary">
                    </div>


                </div>

            </div>

        </section>

        <!-- jQuery -->
        <script src="vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
        <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

        <!--Minhas verificações -->
        <script src="js/verificacoes.js"></script>

        <!-- Theme JavaScript -->
        <script src="js/creative.min.js"></script>

        <footer> <!-- Área do footer -->
            <div class="container">

                <div class="row">

                    <div id="maisInformacoes" class="col-md-3 text-center">
                        <p>
                            O AlgTot foi desenvolvido como projeto de conclusão do curso de
                            Tecnologia em Análise e Desenvolvimento de Sistemas do IF Baiano - Campus Guanambi                
                        </p>
                        <hr class="primary">
                    </div>

                    <div id="licenssa" class="col-md-3 text-center">
                        <p>O AlgTot está licenciado com uma Licença <a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/" target="_blank">Creative Commons - Atribuição-NãoComercial 4.0 Internacional</a><br><a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/" target="_blank"><img alt="Licença Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc/4.0/88x31.png" /></a></p>
                        <hr class="primary">
                    </div>
                    <div id="desenvolvedor" class="col-md-3 text-center">
                        <p>Desenvolvedor: Eduardo Soares Ferreira.</p>
                        <p><a href="mailto:eduardogbi51@hotmail.com">eduardogbi51@hotmail.com</a></p>
                        <hr class="primary">
                    </div>

                    <div id="orientador" class="col-md-3 text-center">
                        <p>Orientador: Prof.Dr. Woquiton Lima Fernandes</p>
                        <p><a href="mailto:woquiton@gmail.com">woquiton@gmail.com</a></p>
                        <hr class="primary">
                    </div>

                </div>

            </div>

        </footer>
        
        <!-- MODAIS DE ALERTAS -->
        <?php include_once("includs/modaisAlertas.php"); ?>

    </body>

</html>
