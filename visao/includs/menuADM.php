
<!-- MODAL DE VISUALIZAÇÃO DE SINTAXE DO PORTUGOL-->
<?php include_once("includs/modalSintaxePortugol.php"); ?>

<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">

    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Alterar Navegação</span><span class="glyphicon glyphicon-menu-hamburger"></span><i class="fa fa-bars"></i>
            </button>

            <a class="navbar-brand page-scroll" href="principalADM.php">AlgTot</a>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">

                <li>
                    <a class="page-scroll" href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $_SESSION['usuario']; ?></a>
                </li>
                <li>
                    <a class="page-scroll" href="atividadesADM.php"><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span> Atividades</a>
                </li>
                <li>
                    <a class="page-scroll" href="usuariosADM.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuários</a>
                </li>
                <li>
                    <a class="page-scroll" data-toggle="modal" data-target="#verDados" href="#"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Perfil</a>
                </li>
                <li>
                    <a name="acaoSintaxe" value="sintaxe" data-toggle="modal" data-target="#sintaxe" href="#" class="page-scroll"><span class="glyphicon glyphicon-book"></span> Sintaxe Portugol</a> 
                </li>
                <li>
                    <a href="tradutor.php" class="page-scroll"><span class="glyphicon glyphicon-rub"></span> Treinar Portugol</a> 
                </li>
                <li>
                    <form name="sair" action="../controle/Usuario.php" method="post">            
                        <button name="acao" value="Deslogar" type="submit" class="page-scroll-button"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Sair</button>
                    </form>
                </li>

            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
