<!DOCTYPE html>
<html lang = "pt-br">
<head>
	<META charset = "utf-8"/>
	<title>Comodos Inseridos</title>

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
				<li class = "active"><a href = "comodosInseridos.php">Comodos Inseridos</a></li>
				<li><a href = "resultPage.php">Resultado Final</a></li>
				
			</ul>
		</div>
	</nav>

	<?php
		include_once ("../model/EspecificacoesComodo.php");
		include_once ("../util/VetorLista.php");
		session_start();

		$_SESSION['paginaOrigem'] = "../view/comodosInseridos.php";
		if(isset($_SESSION['mensagemSucesso'])){
			echo "<br/><div class='alert alert-success' align = 'center' role='alert'>".$_SESSION['mensagemSucesso']."</div>";
		}
		if(!isset($_SESSION['VetorLista'])){
			$repeticaoLaco = 0;
			echo "<br/><div class='alert alert-danger' role='alert'>"."<p align = 'center'>Nenhum Cômodo foi inserido</p>"."</div>";
		}
		else{
			if($_SESSION['VetorLista'] -> size() == 0){
				if(!isset($_SESSION['mensagemSucesso']))
					echo "<br/><div class='alert alert-warning' role='alert'>"."<p align = 'center'>Nenhum Cômodo foi inserido</p>"."</div>";
				else
					unset($_SESSION['mensagemSucesso']);
			}
			$repeticaoLaco = $_SESSION['VetorLista'] -> size();
		}
	?>

	<form style=" max-width: 810px; padding: 10px; margin: 0 auto;" method = "post" action = "edicao.php">
		<?php for($position = 0; $position < $repeticaoLaco; $position += 1): ?>

			<div class="row">
				<div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">
								<div align="center"><?php echo $_SESSION['VetorLista'] -> get($position) -> getIdComodo(); ?></div>
								<input style="float:left;" type = "submit" name = "<?= 'editaDeleta_'.$position; ?>" value = "Editar"/>
								<input style="float:right;" type = "submit" name = "<?= 'editaDeleta_'.$position; ?>" value = "Deletar"><br/><br/>
							</h3>
						</div>
						<div class="panel-body">
							<div>

								<table class="table">
									<thead>
										<tr>
											<th>Área</th>
											<th>Perímetro</th>
											<th>Tomadas de Uso Específico</th>
											<th>Quantidade</th>
										</tr>
									</thead>
									
									<tbody>
										<tr>
											<td><?php echo $_SESSION['VetorLista'] -> get($position) -> getArea(); ?></td>
											<td><?php echo $_SESSION['VetorLista'] -> get($position) -> getPerimetro(); ?></td>
											<td><?php echo $_SESSION['VetorLista'] -> get($position) -> printTomadasTipo(); ?></td>
											<td><?php echo $_SESSION['VetorLista'] -> get($position) -> printQuantidadeTomadasTipo(); ?></td>
										</tr>								  
									</tbody>
								</table>

							</div><!-- fecha do div da tabela -->
						</div><!-- fecha div panel-body -->
					</div>
				</div><!-- /.col-sm-6 -->
			</div>

		<?php endfor ?>
	</form>
	
</body>
</html>
