<!DOCTYPE html>
<html lang = "pt-br">
<head>
	<META charset = "utf-8"/>
	<title>Inserir Cômodo</title>

	<!--<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Didact+Gothic" />-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">	
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<link rel="stylesheet" type="text/css" href="css/definitions.css">

	<link rel="icon" href="imagens/favicon.ico">

</head>
<body bgcolor="#E8F7F6">
	
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class = "navbar-header">
			<a class = "navbar-brand" href = "#">Sistema Gerenciamento Voltagem Residencia</a>
		</div>

		<div>
			<ul class = "nav navbar-nav">
				<li class = "active"><a href = "inserirComodos.php">Inserir Comodo</a></li>
				<li><a href = "comodosInseridos.php">Comodos Inseridos</a></li>
				<li><a href = "resultPage.php">Resultado Final</a></li>
				
			</ul>
		</div>
	</nav><br/><br/><br/>

	<form style=" max-width: 810px; padding: 10px; margin: 0 auto;" method = "post" action="../controller/controlador.php">

		<?php session_start();

			if(!isset($_SESSION['paginaOrigem']))
				$_SESSION['paginaOrigem'] = "";
			$booleanTeste = $_SESSION['paginaOrigem'] == "../view/inserirComodos.php" || $_SESSION['paginaOrigem'] == "../controller/controlador.php";
			if(!isset($_SESSION['adicionarTomada']) || !$booleanTeste){
				$_SESSION['adicionarTomada'] = 1;
			
			/*if(!isset($_SESSION['valoresPreviosQuantidadeTomada'][0])){*/
				$_SESSION['valoresPreviosQuantidadeTomada'][0] = 1;
				$_SESSION['valoresPreviosTipoTomada'][0] = "Ferro de Passar";

				unset($_SESSION['areaPrevia']);
				unset($_SESSION['perimetroPrevio']);
				unset($_SESSION['previoIdComodo']);
			}
			$_SESSION['paginaOrigem'] = "../view/inserirComodos.php";

			if(!isset($_SESSION['areaPrevia']))
				$_SESSION['areaPrevia'] = "";

			if(!isset($_SESSION['perimetroPrevio']))
				$_SESSION['perimetroPrevio'] = "";

			if(!isset($_SESSION['previoIdComodo']))
				$_SESSION['previoIdComodo'] = "Banheiro";

			$controlePosicao = 1;
			if($_SESSION['adicionarTomada'] > 1)
				$controlePosicao = $_SESSION['adicionarTomada'];
		?>
		<div class="row">
			<div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							<div align="center">Dados do Cômodo</div>
						</h3>
					</div>
					<div class="panel-body">
						Identificação do cômodo:<select name="comodosId">
							<option value="Banheiro"
							<?= ($_SESSION['previoIdComodo'] == "Banheiro") ? "selected" : "" ?> > Banheiro </option>
							<option value="Cozinha"
							<?= ($_SESSION['previoIdComodo'] == "Cozinha") ? "selected" : "" ?> > Cozinha </option>
							<option value="Copa"
							<?= ($_SESSION['previoIdComodo'] == "Copa") ? "selected" : "" ?> > Copa </option>
							<option value="Copa-Cozinha"
							<?= ($_SESSION['previoIdComodo'] == "Copa-Cozinha") ? "selected" : "" ?> > Copa-Cozinha </option>
							<option value="Area de Servico"
							<?= ($_SESSION['previoIdComodo'] == "Area de Servico") ? "selected" : "" ?> > Área de servico </option>
							<option value="Cozinha-area de servico"
							<?= ($_SESSION['previoIdComodo'] == "Cozinha-area de servico") ? "selected" : "" ?> > Cozinha-área de servico </option>
							<option value="Lavanderia"
							<?= ($_SESSION['previoIdComodo'] == "Lavanderia") ? "selected" : "" ?> > Lavanderia </option>
							<option value="Sala"
							<?= ($_SESSION['previoIdComodo'] == "Sala") ? "selected" : "" ?> > Sala </option>
							<option value="Dormitorio"
							<?= ($_SESSION['previoIdComodo'] == "Dormitorio") ? "selected" : "" ?> > Dormitorio </option>
						</select>

						<tab>Área:</tab><input type="number" name="area" min="1" max="9999" value = "<?= $_SESSION['areaPrevia'] ?>">

						<tab>Perímetro:</tab><input type="number" name="perimetro" min="1" max="9999" value = "<?= $_SESSION['perimetroPrevio'] ?>">
						

						<?php for ($position = 0; $position < $controlePosicao; $position += 1): ?>
							<br/>Tomada de uso específico:<select name="tomadas[]">
								<option value="Ferro de Passar"
								<?= ($_SESSION['valoresPreviosTipoTomada'][$position] == "Ferro de Passar") ? "selected" : "" ?> > Ferro de Passar </option>
								<option value="Chuveiro"
								<?= ($_SESSION['valoresPreviosTipoTomada'][$position] == "Chuveiro") ? "selected" : "" ?> > Chuveiro </option>
								<option value="Maquina de Lavar"
								<?= ($_SESSION['valoresPreviosTipoTomada'][$position] == "Maquina de Lavar") ? "selected" : "" ?> > Máquina de Lavar </option>
								<option value="Microondas"
								<?= ($_SESSION['valoresPreviosTipoTomada'][$position] == "Microondas") ? "selected" : "" ?> > Micro-Ondas </option>
								<option value="Ar condicionado"
								<?= ($_SESSION['valoresPreviosTipoTomada'][$position] == "Ar condicionado") ? "selected" : "" ?> > Ar condicionados </option>
							</select>

							<tab>Quantidade:<input type="number" min="1" max="270" name="quantidade[]"
							 value="<?= $_SESSION['valoresPreviosQuantidadeTomada'][$position] ?>" required/></tab>

							<button style="float: left;" type="submit" class="close" aria-label="Close" name="acaoRealizada" value="<?= 'remove_'.$position ?>">
								<span aria-hidden="true">&times;</span>
							</button>
						<?php endfor ?>
						

						<tab><input type="submit" name="acaoRealizada" value="Nova Tomada"></tab>

						<br/><input type="submit" name="acaoRealizada" value="Inserir Comodo"><br/>

						<!--<br/><input type="submit" name="acaoRealizada" value="Calcular" size="7">-->

					</div><!-- fecha div panel-body -->
				</div>
			</div><!-- /.col-sm-6 -->
		</div>
		

		<?php
			if(isset($_SESSION['mensagemErro'])){
				/*echo "<tab/><errorMessages>".$_SESSION['mensagemErro']."</errorMessages>";*/
				echo "<div class='alert alert-danger' role='alert'>".$_SESSION['mensagemErro']."</div>";
				unset($_SESSION['mensagemErro']);
			}
		?>
	</form>

</body>
</html>