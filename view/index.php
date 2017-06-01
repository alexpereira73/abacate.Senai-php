<!DOCTYPE html>
<html lang = "pt-br">
<head>
	<META charset = "utf-8"/>
	<title>Sistema de cálculo de voltagem</title>

	<!--<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Didact+Gothic" />-->
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<link rel="stylesheet" type="text/css" href="css/definitions.css">

	<link rel="icon" href="imagens/favicon.ico">

</head>
<body bgcolor="#E8F7F6">
	<h1>Sistema Gerenciamento Voltagem residencia</h1>
	<h2>Inserção de Dados</h2>

	<form method = "post" action="../controller/controlador.php">

		Identificação do cômodo:<select name="comodosId">
			<option value="Banheiro"> Banheiro </option>
			<option value="Cozinha"> Cozinha </option>
			<option value="Copa"> Copa </option>
			<option value="Copa-Cozinha"> Copa-Cozinha </option>
			<option value="Area de Servico"> Área de servico </option>
			<option value="Cozinha-area de servico"> Cozinha-área de servico </option>
			<option value="Lavanderia"> Lavanderia </option>
			<option value="Sala"> Sala </option>
			<option value="Dormitorio"> Dormitorio </option>
		</select>

		<tab>Área:</tab><input type="text" name="area" size="1">

		<tab>Perímetro:</tab><input type="text" name="perimetro" size="1">
		<?php session_start();
			if(!isset($_SESSION['adicionarTomada']))
				$_SESSION['adicionarTomada'] = 1;
			if(!isset($_SESSION['valoresPreviosQuantidadeTomada'][0])){
				$_SESSION['valoresPreviosQuantidadeTomada'][0] = 1;
				$_SESSION['valoresPreviosTipoTomada'][0] = "Ferro de Passar";
			}

			$controlePosicao = 1;
			if($_SESSION['adicionarTomada'] > 1)
				$controlePosicao = $_SESSION['adicionarTomada'];
			
		?>

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
				echo "<br/><error>".$_SESSION['mensagemErro']."</error>";
				unset($_SESSION['mensagemErro']);
			}
		?>
	</form>

</body>
</html>