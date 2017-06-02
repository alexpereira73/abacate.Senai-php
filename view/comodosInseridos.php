<!DOCTYPE html>
<html lang = "pt-br">
<head>
	<META charset = "utf-8"/>
	<title>Resultados Obtidos</title>

	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<link rel="stylesheet" type="text/css" href="css/definitions.css">

	<link rel="icon" href="imagens/favicon.ico">
</head>
<body bgcolor="#E8F7F6">
	<h1>Sistema Gerenciamento Voltagem residencia</h1>
	<h2>Comodos Inseridos</h2>
	<?php
		include_once ("../model/EspecificacoesComodo.php");
		include_once ("../util/VetorLista.php");
		session_start();
	?>

	<form method = "post" action = "../controller/edicao.php">
		<?php for($position = 0; $position < $_SESSION['VetorLista'] -> size(); $position += 1): ?>
			<?php $_SESSION['VetorLista'] -> get($position) -> exibirInformacoes()."<br/><br/>"; ?>
			<input type = "submit" name = "<?= 'editaComodo_'.$position; ?>" value = "Editar"/>
			<input type = "submit" name = "<?= 'deletaComodo_'.$position; ?>" value = "Deletar"><br/><br/>
		<?php endfor ?>
	</form>
	
</body>
</html>
