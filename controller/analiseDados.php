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

	function adicionaDadosTemporarios($proximaNao){
		/*Para quantidade de tomadas*/
		$contadorAdiciona = 0;
		foreach ($_POST['quantidade'] as $quantidadeEspecificas) {
			$_SESSION['valoresPreviosQuantidadeTomada'][$contadorAdiciona] = $quantidadeEspecificas;
			$contadorAdiciona += 1;
		}
		if($proximaNao)
			$_SESSION['valoresPreviosQuantidadeTomada'][$contadorAdiciona] = 1;
		
		/*para tipo de tomadas*/
		$contadorAdiciona = 0;
		foreach ($_POST['tomadas'] as $tiposEspecificos) {
			$_SESSION['valoresPreviosTipoTomada'][$contadorAdiciona] = $tiposEspecificos;
			$contadorAdiciona += 1;
		}
		if($proximaNao)
			$_SESSION['valoresPreviosTipoTomada'][$contadorAdiciona] = "Ferro de Passar";
	}

	function novaTomada(){
		if(isset($_SESSION['adicionarTomada'])){
			if(!isset($_SESSION['valoresPreviosQuantidadeTomada'][0])){
				$_SESSION['valoresPreviosQuantidadeTomada'][0] = 1;
				$_SESSION['valoresPreviosTipoTomada'][0] = "Ferro de Passar";

				/*Para os campos de Area e Perimetro fora do laço de repetição*/
				$_SESSION['areaPrevia'] = "";
				$_SESSION['perimetroPrevio'] = "";
				$_SESSION['previoIdComodo'] = "Banheiro";
			}
			else {
				adicionaDadosTemporarios(true);
				$_SESSION['adicionarTomada'] += 1;
			}

			/*Para area e perimetro*/
			if(is_numeric(htmlspecialchars($_POST['area'])))
				$_SESSION['areaPrevia'] = htmlspecialchars($_POST['area']);
			if(is_numeric(htmlspecialchars($_POST['perimetro'])))
				$_SESSION['perimetroPrevio'] = htmlspecialchars($_POST['perimetro']);
			$_SESSION['previoIdComodo'] = htmlspecialchars($_POST['comodosId']);
		}
		else
			$_SESSION['adicionarTomada'] = 1;
	}

	function verificaAcao($acao){
		/*session_start();*/
		if($acao == "Nova Tomada"){
			novaTomada();
			if($_SESSION['paginaOrigem'] == "../view/edicao.php"){
				$_SESSION['paginaOrigem'] = "../controller/controlador.php";
				header('Location: ../view/edicao.php');
			}
			else if($_SESSION['paginaOrigem'] == "../view/inserirComodos.php"){
				$_SESSION['paginaOrigem'] = "../controller/controlador.php";
				header('Location: ../view/inserirComodos.php');
			}
			
		}

		else{
			adicionaDadosTemporarios(false);
			if(!isset($_SESSION['mensagemErro'])){
				if($acao == "Inserir Comodo"){
					$_SESSION['VetorLista'] -> add(saveData());
					header('Location: ../view/inserirComodos.php');
				}

				else if($acao == "Concluir"){
					$_SESSION['VetorLista'] -> set($_SESSION['editando'], saveData());
					header('Location: ../view/comodosInseridos.php');
				}

				else{
					$positionRemove = intval(substr($acao, -1));
					if($positionRemove >= $_SESSION['adicionarTomada']){
						$_SESSION['paginaOrigem'] = "../controller/controlador.php";
						header('Location: ../view/comodosInseridos.php');
					}
					else{
						/*executa acao de remocao*/
						
						$paginaMudanca = $_SESSION['paginaOrigem'];
						$_SESSION['paginaOrigem'] = "../controller/controlador.php";
						header('Location: '.$paginaMudanca);
					}
				}
				if(!isset($positionRemove)){
					unset($_SESSION['adicionarTomada']);
					unset($_SESSION['valoresPreviosQuantidadeTomada'][0]);
					$_SESSION['valoresPreviosTipoTomada'][0] = "Ferro de Passar";

					unset($_SESSION['areaPrevia']);
					unset($_SESSION['perimetroPrevio']);
					unset($_SESSION['previoIdComodo']);
				}
			}

		}

	}

?>