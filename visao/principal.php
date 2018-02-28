<?php

  require_once("../controle/Acesso.php");
  

  $modelo = new Modelo();
  $acesso = new Acesso();

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
	<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
	<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <title>AlgtTot: Principal</title>

  </head>

  <!-- Bootstrap -->
  <body>

    <!-- MENU DOS ALUNO -->
  	<?php include_once ("includs/menuAluno.php"); ?>

    
    

    <!--MODAL DE VISUALIZAÇÃO E EDIÇÃO DE DADOS-->
    <?php include_once("includs/modalVerEditarPerfil.php"); ?>

    <!--MODAL DE EXCLUIR PERFIL-->
    <?php include_once("includs/modalExcluirPerfil.php"); ?>

  	<section id="conteudo" class="container">

  		<br>
  		<br>
  		<br>

  		<div class="row">

  			<div id="niveis" class="col-sm-7">


  				<div class="panel panel-default">

  					<div class="panel-heading" title="Pontuando em cada nível você desbloqueiará os proximos" style="background-color: #4cae4c; color:white; text-align:center;">

  						<div >
  							<h3 class="blog-title">Escolha um dos níveis!</h3>
  						</div>

  					</div>

  					<div class="panel-body">

  						<br>

              <center>

          				<div id="centro" class="col">

          					<div class="btn-group-vertical" role="group">

          						<form name="niveis" action="atividades.php" method="post">

          							<button name="nivel" value="1" style="min-width: 120px; min-height: 100px;" type="submit" title="Clique para abrir o nível" class="btn btn-<?php echo ($_SESSION['nivel1'] < 0)?'danger':'success'; ?>" href="atividades.php">
                          Nível 1<br>
                          Pontuação<br>
                          <?php echo $_SESSION['nivel1']; ?> <span class='glyphicon glyphicon-star' aria-hidden='true'></span>
                        </button>
          							<br><br>

          							<button name="nivel" value="2" style="min-width: 120px; min-height: 100px;" type="submit" <?php if($_SESSION['nivel1']>=1000){ echo "title='Clique para abrir o nível'"; }else{ echo "title='Faça 1000 pontos no nível 1'"." disabled "; } ?> class="btn btn-<?php echo ($_SESSION['nivel2'] < 0)?'danger':'success'; ?>">
                          Nível 2
                          <?php if($_SESSION['nivel1']>=1000){ echo "<br>Pontuação<br>".$_SESSION['nivel2']." <span class='glyphicon glyphicon-star' aria-hidden='true'></span>"; }else{ echo"<br>Necessário<br>1000 <span class='glyphicon glyphicon-star' aria-hidden='true'></span><br>no nível 1"; } ?></button>
          							<br><br>

          							<button name="nivel" value="3" style="min-width: 120px; min-height: 100px;" type="submit" <?php if($_SESSION['nivel2']>=2000){ echo "title='Clique para abrir o nível'"; }else{ echo "title='Faça 2000 pontos no nível 2'"." disabled "; } ?> class="btn btn-<?php echo ($_SESSION['nivel3'] < 0)?'danger':'success'; ?>">
                          Nível 3
                          <?php if($_SESSION['nivel2']>=2000){ echo "<br>Pontuação<br>".$_SESSION['nivel3']." <span class='glyphicon glyphicon-star' aria-hidden='true'></span>"; }else{ echo"<br>Necessário<br>2000 <span class='glyphicon glyphicon-star' aria-hidden='true'></span><br>no nível 2"; } ?></button>
          							<br><br>

          							<button name="nivel" value="4" style="min-width: 120px; min-height: 100px;" type="submit" <?php if($_SESSION['nivel3']>=3000){ echo "title='Clique para abrir o nível'"; }else{ echo "title='Faça 3000 pontos no nível 3'"." disabled "; } ?> class="btn btn-<?php echo ($_SESSION['nivel4'] < 0)?'danger':'success'; ?>">
                          Nível 4
                          <?php if($_SESSION['nivel3']>=3000){ echo "<br>Pontuação<br>".$_SESSION['nivel4']." <span class='glyphicon glyphicon-star' aria-hidden='true'></span>"; }else{ echo"<br>Necessário<br>3000 <span class='glyphicon glyphicon-star' aria-hidden='true'></span><br>no nível 3"; } ?></button>
          							<br><br>

          							<button name="nivel" value="5" style="min-width: 120px; min-height: 100px;" type="submit" <?php if($_SESSION['nivel4']>=4000){ echo "title='Clique para abrir o nível'"; }else{ echo "title='Faça 4000 pontos no nível 4'"." disabled "; } ?> class="btn btn-<?php echo ($_SESSION['nivel5'] < 0)?'danger':'success'; ?>">
                          Nível 5
                          <?php if($_SESSION['nivel4']>=4000){ echo "<br>Pontuação<br>".$_SESSION['nivel5']." <span class='glyphicon glyphicon-star' aria-hidden='true'></span>"; }else{ echo"<br>Necessário<br>4000 <span class='glyphicon glyphicon-star' aria-hidden='true'></span><br>no nível 4"; } ?></button>
          							<br><br>

          						</form>

          					</div>

          				</div>

              </center>

  					</div>

  				</div><!--Fim do painel-->

  			</div>

  			<div id="ranking" class="col-sm-5 col-sm-offset-0">

          <div class="panel panel-default">

            <div class="panel-heading" style="background-color: #4cae4c; color:white; text-align:center;">
              <h3>Ranking</h3>
            </div>

            <div class="panel-body">

              <div id="usuarios">

                <ol class="list-unstyled">

                <?php

                   $select1 = "SELECT * FROM usuario WHERE status = ? AND cdGrupo = ? ORDER BY pontuacaoTotal DESC LIMIT 10";
                   $dados1 = array('ativo',3);

                   $select2 = "SELECT SUM(questao.pontuacao) AS pontosTotais FROM questao, atividade
                              WHERE atividade.cdAtividade = questao.cdAtividade AND questao.status = ? AND atividade.status = ?";
                   $dados2 = array('ativo','ativo');
                   $alunos = $modelo->selecionar($select1,$dados1);
                   $totalDePontos = $modelo->selecionar($select2,$dados2);

                   foreach ($totalDePontos as $key => $total) {
                     $pontosTotais = $total['pontosTotais'];
                   }

					if(($pontosTotais==null)||($pontosTotais==0)){
						$pontosTotais = 1;
					}

                   $contador = 1;

                   foreach ($alunos as $key => $usuario) {

                      $aluno = htmlspecialchars($usuario['usuario']);
                      $totalDePontosAluno = $usuario['pontuacaoTotal'];

                      $porcentagemAluno = ($totalDePontosAluno * 100) / $pontosTotais;

                      if ($porcentagemAluno>100) {
                          $porcentagemAluno = 100;
                      }

                      $porcentagemAluno = number_format($porcentagemAluno, 1, '.', '');

                ?>


                <p><?php echo $contador; ?>º <?php echo $aluno; ?>: <?php echo $totalDePontosAluno; ?> <span class="glyphicon glyphicon-star" aria-hidden="true"></span></p>
                  <li>
                    <div class="progress">
                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $porcentagemAluno; ?>" aria-valuemin="0" aria-valuemax="100" style="min-width: 4%; width: <?php echo $porcentagemAluno; ?>%;"> <?php echo $porcentagemAluno; ?>%
                        <span class="sr-only"><?php echo $porcentagemAluno; ?>% Complete (warning)</span>
                      </div>
                    </div>
                  </li>

                  <?php

                      $contador++;

                  }

                  ?>


                  <?php if ($contador > 1) { ?>
                    <li><div class="alert alert-success" role="alert"><a href="ranking.php" class="alert-link">Ver Todos</a></div></li>
                 <?php } else { ?>
                    <li><div class="alert alert-warning" role="alert">Nenhum participante</div></li>
                 <?php } ?>

                </ol>

              </div>

            </div>

          </div>

        </div>

  		</div>

  	</section>
      <!--Minhas verificações -->
    <script src="js/verificacoes.js"></script>
  </body>
  </html>
