<!DOCTYPE html>
<html lang = "pt-br">
<head>
	<META charset = "utf-8"/>
	<title>Resultados Obtidos</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<link rel="stylesheet" type="text/css" href="css/definitions.css">

	<link rel="icon" href="imagens/favicon.ico">
</head>
<body bgcolor="#E8F7F6">
	
	<nav class="navbar navbar-default">
		<div class = "navbar-header">
			<a class = "navbar-brand" href = "#">Sistema Gerenciamento Voltagem Residencia</a>
		</div>

		<div>
			<ul class = "nav navbar-nav">
				<li><a href = "inserirComodos.php">Inserir Comodo</a></li>
				<li><a href = "comodosInseridos.php">Comodos Inseridos</a></li>
				<li class = "active"><a href = "resultPage.php">Resultado Final</a></li>
				
			</ul>
		</div>
	</nav>

	<?php
		include_once ("../model/EspecificacoesComodo.php");
		include_once ("../util/VetorLista.php");

		session_start();

		$_SESSION['paginaOrigem'] = "../view/resultPage.php";
		/*************************************************
			Retorno ao Usuário:
			• Quantidade de tomadas por cômodo
			• Potência de tomadas por Cômodo
			• Potência de iluminação por Cômodo
			• Potência total de uso específico
			• Potência total instalada na residência
		*************************************************/
		
		if(!isset($_SESSION['VetorLista'])){
			if(isset($_SESSION['mensagemErro'])){
				echo "<br/><div class='alert alert-success' align = 'center' role='alert'>".$_SESSION['mensagemErro']."</div>";
				unset($_SESSION['mensagemErro']);
				session_destroy();
			}
			else
				echo "<br/><div class='alert alert-danger' align = 'center' role='alert'>"."Nenhum Dado Armazenado Para Calcular"."</div>";
		}
		else if($_SESSION['VetorLista'] -> isEmpty())
			echo "<br/><div class='alert alert-danger' align = 'center' role='alert'>"."Não há nenhuma informação armazenada"."</div>";
		else{
			$potenciaTotal = 0;
			$potenciaTotalEspecifica = 0;
	?>

			<div class="row"  style=" max-width: 810px; padding: 10px; margin: 0 auto;">
				<div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">
								<div align="center">Resultados Residencia com <?php echo $_SESSION['VetorLista'] -> size() ?> Comodos</div>
								<a href = "../controller/controlador.php"><input style="float:right;" type = "submit" name = "actionResult" value = "Limpar Dados"></a>
							</h3>
						</div>
						<div class="panel-body">
							<div>
								<table class="table">
									<thead>
										<tr>
											<th>Tipo de Comodo</th>
											<th>Quantidade de Tomadas</th>
											<th>Potencia das Tomadas</th>
											<th>Iluminação do Cômodo</th>
										</tr>
									</thead>
									
									<?php for($contador = 0; $contador < $_SESSION['VetorLista'] -> size(); $contador += 1): ?>
									<tbody align="center">
										<tr>
											<td><?php echo $_SESSION['VetorLista'] -> get($contador) -> getIdComodo(); ?></td>
											<td><?php echo $_SESSION['VetorLista'] -> get($contador) -> quantidadeTomadas(); ?></td>
											<!-- /*calcula a potencia das tomadas*/ -->
											<?php $potenciaTomadas = $_SESSION['VetorLista'] -> get($contador) -> potencias(); ?>

											<td><?php echo ($potenciaTomadas / 1000)."KVA<br/>";/*Divide-se por 1000 para converter para KVA*/ ?></td>

											<!-- /*calcula a potencia da iluminacao*/ -->
											<?php $potenciaIlumicacao = $_SESSION['VetorLista'] -> get($contador) -> iluminacao(); ?>
											<td><?php echo $potenciaIlumicacao."KVA<br/><br/>"; ?></td>

											<?php
												/*soma as potencias totais da residencia*/
												$potenciaTotal += (($potenciaTomadas / 1000) + $potenciaIlumicacao);
												$potenciaTotalEspecifica += $_SESSION['VetorLista'] -> get($contador) -> potenciasEspecificas();
											?>
										</tr>								  
									</tbody>
									<?php endfor ?>
								</table>

							<?php
								echo "<br/>Potência total de uso específico: ".$potenciaTotalEspecifica."KVA";
								echo "<br/>Potência total instalada na residência: ".($potenciaTotal + $potenciaTotalEspecifica)."KVA";
								/*session_destroy();*/
							?>
							<input style="float: right" type="button" name="imprimir" value="Imprimir" onclick="window.print();">
							</div><!-- fecha do div da tabela -->
						</div><!-- fecha div panel-body -->
					</div>
				</div><!-- /.col-sm-6 -->
			</div>
			<?php } ?>
	
</body>
</html>