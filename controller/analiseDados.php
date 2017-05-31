<?php

	/*espaco para includes*/
	include_once ("../model/EspecificacoesComodo.php");
	include_once ("../util/VetorLista.php");

	function saveData(){
		$comodosAdicionados = new EspecificacoesComodo();
		$comodosAdicionados -> inserirDados(htmlspecialchars($_POST['comodosId']), htmlspecialchars($_POST['area']),
		 htmlspecialchars($_POST['perimetro']), htmlspecialchars($_POST['tomadas']),
		  htmlspecialchars($_POST['quantidade']));
		return $comodosAdicionados;
	}

	function verificaAcao($acao){
		/*session_start();*/
		if($acao == "Nova Tomada"){
			if(isset($_SESSION['adicionarTomada'])){
				if(!isset($_SESSION['valoresPreviosQuantidadeTomada'][0])){
					$_SESSION['valoresPreviosQuantidadeTomada'][0] = 1;
					$_SESSION['valoresPreviosTipoTomada'][0] = "Ferro de Passar";
				}
				else {
					$_SESSION['valoresPreviosQuantidadeTomada'][$_SESSION['adicionarTomada']] = htmlspecialchars($_POST['quantidade']);
					$_SESSION['valoresPreviosTipoTomada'][$_SESSION['adicionarTomada']] = htmlspecialchars($_POST['tomadas']);
					$_SESSION['adicionarTomada'] += 1;
				}
			}
			else
				$_SESSION['adicionarTomada'] = 0;
			
		}

		if($acao == "Inserir Comodo"){
			$_SESSION['adicionarTomada'] = 0;
			$_SESSION['valoresPreviosQuantidadeTomada'][0] = 1;
			$_SESSION['valoresPreviosTipoTomada'][0] = "Ferro de Passar";
		}

		if($acao == "Inserir Comodo")
			$_SESSION['VetorLista'] -> add(saveData());

		if($acao != "Calcular")
			header('Location: ../view/index.php');

		if($acao == "Calcular")
			header('Location: ../view/resultPage.php');
	}

?>