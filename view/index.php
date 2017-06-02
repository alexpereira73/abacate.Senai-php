<!DOCTYPE html>
<html lang = "pt-br">
<head>
	<META charset = "utf-8"/>
	<title>Sistema de cálculo de voltagem</title>

	<!--<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Didact+Gothic" />-->
	<!--<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">	-->
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<link rel="stylesheet" type="text/css" href="css/definitions.css">

	<link rel="icon" href="imagens/favicon.ico">

</head>
<body bgcolor="#E8F7F6">
	<h1>Sistema Gerenciamento Voltagem residencia</h1>
	<h2>Inserção de Dados</h2>

	<form method = "post" action="../controller/controlador.php">

		<?php session_start();
			if(!isset($_SESSION['adicionarTomada']))
				$_SESSION['adicionarTomada'] = 1;
			if(!isset($_SESSION['valoresPreviosQuantidadeTomada'][0])){
				$_SESSION['valoresPreviosQuantidadeTomada'][0] = 1;
				$_SESSION['valoresPreviosTipoTomada'][0] = "Ferro de Passar";
			}

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

		<tab>Área:</tab><input type="text" name="area" size="1" value = "<?= $_SESSION['areaPrevia'] ?>">

		<tab>Perímetro:</tab><input type="text" name="perimetro" size="1" value = "<?= $_SESSION['perimetroPrevio'] ?>">
		

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

			<tab>Quantidade:<input type="text" name="quantidade[]" size="1"
			 value="<?= $_SESSION['valoresPreviosQuantidadeTomada'][$position] ?>" required/></tab>
		<?php endfor ?>
		

		<tab><input type="submit" name="acaoRealizada" value="Nova Tomada"></tab>

		<br/><input type="submit" name="acaoRealizada" value="Inserir Comodo"><br/>

		<br/><input type="submit" name="acaoRealizada" value="Calcular" size="7">

		<?php
			if(isset($_SESSION['mensagemErro'])){
				echo "<tab/><errorMessages>".$_SESSION['mensagemErro']."</errorMessages>";
				/*echo "<br/><div class='alert alert-danger' role='alert'>".$_SESSION['mensagemErro']."</div>";*/
				unset($_SESSION['mensagemErro']);
			}
		?>
	</form>

</body>
</html>