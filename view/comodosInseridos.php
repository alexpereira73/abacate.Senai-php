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
				<li><a href = "index.php">Inserir Comodo</a></li>
				<li class = "active"><a href = "comodosInseridos.php">Comodos Inseridos</a></li>
				<li><a href = "resultPage.php">Resultado Final</a></li>
				
			</ul>
		</div>
	</nav>

	<?php
		include_once ("../model/EspecificacoesComodo.php");
		include_once ("../util/VetorLista.php");
		session_start();

		if(!isset($_SESSION['VetorLista'])){
			$repeticaoLaco = 0;
			echo "<br/><div class='alert alert-danger' role='alert'>"."<p align = 'center'>Nenhum Cômodo foi inserido</p>"."</div>";
		}
		else
			$repeticaoLaco = $_SESSION['VetorLista'] -> size();
	?>

	<form method = "post" action = "edicao.php">
		<?php for($position = 0; $position < $repeticaoLaco; $position += 1): ?>
			<?php $_SESSION['VetorLista'] -> get($position) -> exibirInformacoes()."<br/><br/>"; ?>
			<input type = "submit" name = "<?= 'editaComodo_'.$position; ?>" value = "Editar"/>
			<input type = "submit" name = "<?= 'deletaComodo_'.$position; ?>" value = "Deletar"><br/><br/>
		<?php endfor ?>
	</form>
	
</body>
</html>
