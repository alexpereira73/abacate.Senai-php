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
	<h2>Resultados Obtidos</h2>

	<?php
		include_once ("../model/EspecificacoesComodo.php");
		include_once ("../util/VetorLista.php");

		session_start();

		
		/*************************************************
			Retorno ao Usuário:
			• Quantidade de tomadas por cômodo

			• Potência de tomadas por Cômodo

			• Potência de iluminação por Cômodo

			• Potência total de uso específico

			• Potência total instalada na residência
		*************************************************/
		
		if(!isset($_SESSION['VetorLista']))
			header('Location: index.php');
		if($_SESSION['VetorLista'] -> isEmpty())
			echo "Não há nenhuma informação armazenada";
		else{
			for($contador = 0; $contador < $_SESSION['VetorLista'] -> size(); $contador += 1){
				echo $_SESSION['VetorLista'] -> get($contador) -> exibirInformacoes()."<br/>";
				echo $_SESSION['VetorLista'] -> get($contador) -> iluminacao()."KVA<br/>";
				echo $_SESSION['VetorLista'] -> get($contador) -> quantidadeTomadas()." Tomadas <br/>";
				echo $_SESSION['VetorLista'] -> get($contador) -> potencias()."VA<br/>";
			}
		}
		session_destroy();
	?>
</body>
</html>