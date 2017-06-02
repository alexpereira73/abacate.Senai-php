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
			$potenciaTotal = 0;
			$potenciaTotalEspecifica = 0;

			for($contador = 0; $contador < $_SESSION['VetorLista'] -> size(); $contador += 1){
				echo "ID Comodo: ".$_SESSION['VetorLista'] -> get($contador) -> getIdComodo()."<br/>";
				echo "Quantidade de Tomadas: ".$_SESSION['VetorLista'] -> get($contador) -> quantidadeTomadas()." Tomadas <br/>";

				/*calcula a potencia das tomadas*/
				$potenciaTomadas = $_SESSION['VetorLista'] -> get($contador) -> potencias();
				echo "Potencia das Tomadas: ".($potenciaTomadas / 1000)."KVA<br/>";	/*Divide-se por 1000 para converter para KVA*/

				/*calcula a potencia da iluminacao*/
				$potenciaIlumicacao = $_SESSION['VetorLista'] -> get($contador) -> iluminacao();
				echo "Ilumicação: ".$potenciaIlumicacao."KVA<br/><br/>";

				/*soma as potencias totais da residencia*/
				$potenciaTotal += (($potenciaTomadas / 1000) + $potenciaIlumicacao);
				$potenciaTotalEspecifica += $_SESSION['VetorLista'] -> get($contador) -> potenciasEspecificas();
			}

			echo "<br/>Potência total de uso específico: ".$potenciaTotalEspecifica."KVA<br/>";
			echo "Potência total instalada na residência: ".($potenciaTotal + $potenciaTotalEspecifica)."KVA<br/>";
		}
		session_destroy();
	?>
</body>
</html>