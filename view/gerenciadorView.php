<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Sistema Voltagem circuito Eletrico</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">	
	<link rel="stylesheet" type="text/css" href="css/fonts.css">	
	<link rel="stylesheet" type="text/css" href="css/definitions.css">
	
	<link rel="icon" href="imagens/favicon.ico">
</head>
<body>

	<?php
		include_once ("../model/EspecificacoesComodo.php");
		include_once ("../model/CodificacaoPaginas.php");
		include_once ("../util/VetorLista.php");
		session_start();
		//session_destroy();
		if(!isset($_SESSION['navbarSelected']))
			$_SESSION['navbarSelected'] = "inserirComodos.php";

		if(!isset($_SESSION['paginaAnterior']))
			$_SESSION['paginaAnterior'] = "inserirComodos.php";

		if(isset($_SESSION['CodificacaoPaginas']) == false)
			$_SESSION['CodificacaoPaginas'] = new CodificacaoPaginas(array("inserirComodos.php", "comodosInseridos.php", "resultPage.php", "edicao.php"));

		if(isset($_SESSION['VetorLista']) == false)
			$_SESSION['VetorLista'] = array(new VetorLista(), new VetorLista());

		if(!isset($_GET['selectPage'])){
			$paginaDestino = $_SESSION['paginaAnterior'];
		}
		else{
			$paginaDestino = $_SESSION['CodificacaoPaginas'] -> getCodigoPagina($_GET['selectPage']);
		}

		$_SESSION['navbarSelected'] = $paginaDestino;
		$_SESSION['CodificacaoPaginas'] -> associaCodificacaoPagina();

	?>

	<nav class="navbar navbar-default navbar-fixed-top">
		<div class = "navbar-header">
			<a class = "navbar-brand" href = "#">Sistema Gerenciamento Voltagem Residencia</a>
		</div>

		<div>
			<ul class = "nav navbar-nav">
				<li class = "<?php echo $_SESSION['navbarSelected'] == 'inserirComodos.php' ? 'active' : ''; ?>">
					<a href = "gerenciadorView.php?selectPage=<?= $_SESSION['CodificacaoPaginas'] -> getCodigos(0) ?>">Inserir Comodos</a>
				</li>
				<li class = "<?php echo $_SESSION['navbarSelected'] == 'comodosInseridos.php' ? 'active' : $_SESSION['navbarSelected'] == 'edicao.php' ? 'active' : ''; ?>">
					<a href = "gerenciadorView.php?selectPage=<?= $_SESSION['CodificacaoPaginas'] -> getCodigos(1) ?>">Comodos Inseridos</a>
				</li>
				<li class = "<?php echo $_SESSION['navbarSelected'] == 'resultPage.php' ? 'active' : ''; ?>">
					<a href = "gerenciadorView.php?selectPage=<?= $_SESSION['CodificacaoPaginas'] -> getCodigos(2) ?>">Resultado Final</a>
				</li>
				
			</ul>
		</div>
	</nav><br/><br/><br/>
	<?php

		switch ($paginaDestino) {
			case "inserirComodos.php":
				include("inserirComodos.php");
				break;
			case "comodosInseridos.php":
				include("comodosInseridos.php");
				break;
			case "resultPage.php":
				include("resultPage.php");
				break;
			case "edicao.php":
				include("edicao.php");
				break;
			
			default:
				# code...
				break;
		}
	?>
</body>
</html>