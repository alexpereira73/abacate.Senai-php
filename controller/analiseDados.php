<?php

	/*espaco para includes*/
	include_once ("../model/EspecificacoesComodo.php");
	include_once ("../util/VetorLista.php");

	function saveData(){
		$comodosAdicionados = new EspecificacoesComodo();
		$quantidadesTomadas = new VetorLista();
		$tiposTomadas = new VetorLista();

		foreach ($_POST['quantidade'] as $quantidadeEspecificas) {
			$quantidadesTomadas -> add($quantidadeEspecificas);
		}

		foreach ($_POST['tomadas'] as $nomesEspecificas) {
			$tiposTomadas -> add($nomesEspecificas);
		}

		$comodosAdicionados -> inserirDados(htmlspecialchars($_POST['comodosId']), htmlspecialchars($_POST['area']),
		 htmlspecialchars($_POST['perimetro']), $tiposTomadas, $quantidadesTomadas);
		return $comodosAdicionados;
	}

	function novaTomada(){
		if(isset($_SESSION['adicionarTomada'])){
			if(!isset($_SESSION['valoresPreviosQuantidadeTomada'][0])){
				$_SESSION['valoresPreviosQuantidadeTomada'][0] = 1;
				$_SESSION['valoresPreviosTipoTomada'][0] = "Ferro de Passar";
			}
			else {
				/*Para quantidade de tomadas*/
				$contadorAdiciona = 0;
				foreach ($_POST['quantidade'] as $quantidadeEspecificas) {
					$_SESSION['valoresPreviosQuantidadeTomada'][$contadorAdiciona] = $quantidadeEspecificas;
					$contadorAdiciona += 1;
				}
				$_SESSION['valoresPreviosQuantidadeTomada'][$contadorAdiciona] = 1;
				
				/*para tipo de tomadas*/
				$contadorAdiciona = 0;
				foreach ($_POST['tomadas'] as $tiposEspecificos) {
					$_SESSION['valoresPreviosTipoTomada'][$contadorAdiciona] = $tiposEspecificos;
					$contadorAdiciona += 1;
				}
				$_SESSION['valoresPreviosTipoTomada'][$contadorAdiciona] = "Ferro de Passar";

				$_SESSION['adicionarTomada'] += 1;
			}
		}
		else
			$_SESSION['adicionarTomada'] = 1;
	}

	function verificaAcao($acao){
		/*session_start();*/
		if($acao == "Nova Tomada"){
			novaTomada();
		}

		if($acao == "Inserir Comodo"){
			unset($_SESSION['adicionarTomada']);
			unset($_SESSION['valoresPreviosQuantidadeTomada'][0]);
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