<?php

	function analiseErro(){
		$retornoBooleano = false;
		if(htmlspecialchars($_POST['acaoRealizada']) == null){
			$_SESSION['mensagemErro'][$_SESSION['paginaAnterior']] = "Comando Não encontrado";
			$retornoBooleano = true;
		}
		else{
			$acaoTomada = (htmlspecialchars($_POST['acaoRealizada']) != "Nova Tomada" && !is_numeric(substr(htmlspecialchars($_POST['acaoRealizada']), -1)) || htmlspecialchars($_POST['acaoRealizada']) == "Inserir Comodo" || htmlspecialchars($_POST['acaoRealizada']) == "Concluir");
			if((htmlspecialchars($_POST['area'])) == null && $acaoTomada){
				$_SESSION['mensagemErro'][$_SESSION['paginaAnterior']] = "O campo Area deve ser preenchido";
				$retornoBooleano = true;
			}
			else if((htmlspecialchars($_POST['perimetro'])) == null && $acaoTomada){
				$_SESSION['mensagemErro'][$_SESSION['paginaAnterior']] = "O campo Perimetro deve ser preenchido";
				$retornoBooleano = true;
			}
			else if((htmlspecialchars($_POST['comodosId'])) == null && $acaoTomada){
				$_SESSION['mensagemErro'][$_SESSION['paginaAnterior']] = "O campo Identificação Comodo deve ser selecionado";
				$retornoBooleano = true;
			}
		}
		return $retornoBooleano;
	}
	function saveData(){
		$comodosAdicionados = new EspecificacoesComodo();
		$quantidadesTomadas = new VetorLista();
		$tiposTomadas = new VetorLista();
		if( !($_SESSION['InserindoComodo'] -> getTomadasTipo() -> isEmpty()) ){
			foreach ($_POST['quantidade'] as $quantidadeEspecificas) {
				$quantidadesTomadas -> add($quantidadeEspecificas);
			}

			foreach ($_POST['tomadas'] as $nomesEspecificas) {
				$tiposTomadas -> add($nomesEspecificas);
			}
		}

		$comodosAdicionados -> inserirDados(htmlspecialchars($_POST['comodosId']), htmlspecialchars($_POST['area']),
		 htmlspecialchars($_POST['perimetro']), $tiposTomadas, $quantidadesTomadas);
		return $comodosAdicionados;
	}

	function adicionaDadosTemporarios($proximaNao){
		/*Para quantidade de tomadas*/
		if( !($_SESSION['InserindoComodo'] -> getTomadasTipo() -> isEmpty()) ){
			$_SESSION['InserindoComodo'] -> setQuantidadeTomadasTipo(new VetorLista());
			$_SESSION['InserindoComodo'] -> getQuantidadeTomadasTipo() -> add(1);
			foreach ($_POST['quantidade'] as $quantidadeEspecificas) {
				$_SESSION['InserindoComodo'] -> getQuantidadeTomadasTipo() -> add($quantidadeEspecificas);
			}
			
			/*para tipo de tomadas*/
			$_SESSION['InserindoComodo'] -> setTomadasTipo(new VetorLista());
			$_SESSION['InserindoComodo'] -> getTomadasTipo() -> add("Ferro de Passar");
			foreach ($_POST['tomadas'] as $tiposEspecificos) {
				$_SESSION['InserindoComodo'] -> getTomadasTipo() -> add($tiposEspecificos);
			}
		}
		else{
			$_SESSION['InserindoComodo'] -> getTomadasTipo() -> add("Ferro de Passar");
			$_SESSION['InserindoComodo'] -> getQuantidadeTomadasTipo() -> add(1);
		}
	}

	function novaTomada(){
		adicionaDadosTemporarios(true);

		/*Para area e perimetro*/
		if(is_numeric(htmlspecialchars($_POST['area'])))
			$_SESSION['InserindoComodo'] -> setArea(htmlspecialchars($_POST['area']));
		if(is_numeric(htmlspecialchars($_POST['perimetro'])))
			$_SESSION['InserindoComodo'] -> setPerimetro(htmlspecialchars($_POST['perimetro']));
		$_SESSION['InserindoComodo'] -> setIdComodo(htmlspecialchars($_POST['comodosId']));
	}

	function entreEdicaoInsercao($acao){
		if($acao == "Nova Tomada"){
			novaTomada();
		}
		else if($acao == "Inserir Comodo"){
			$_SESSION['VetorLista'][1] -> add(saveData());
		}
		else if($acao == "Concluir"){
			$_SESSION['VetorLista'][1] -> set($_SESSION['editando'], saveData());
			$_SESSION['paginaAnterior'] = "comodosInseridos.php";
		}
		else{
			$positionRemove = intval(substr($acao, -1));
			if($positionRemove >= $_SESSION['InserindoComodo'] -> getQuantidadeTomadasTipo() -> size()){
				$_SESSION['mensagemErro'][$_SESSION['paginaAnterior']] = "Não encontrada tomada para remoção";
			}
			else{
				/*executa acao de remocao*/
				$quantidadeTomadas = $_SESSION['InserindoComodo'] -> getQuantidadeTomadasTipo() -> size();
				if($quantidadeTomadas >= 0){
					$valoresPreviosTipoTomada = $_SESSION['InserindoComodo'] -> getTomadasTipo();
					$valoresPreviosQuantidadeTomada = $_SESSION['InserindoComodo'] -> getQuantidadeTomadasTipo();
					$contador = $positionRemove;

					for($alterarValores = $positionRemove + 1; $alterarValores < $quantidadeTomadas; $alterarValores += 1){
						$valoresPreviosQuantidadeTomada -> set($contador, $valoresPreviosQuantidadeTomada -> get($alterarValores));
						$valoresPreviosTipoTomada -> set($contador, $valoresPreviosTipoTomada -> get($alterarValores));
						$contador += 1;
					}
					$valoresPreviosQuantidadeTomada -> removeIndex($alterarValores - 1);
					$valoresPreviosTipoTomada -> removeIndex($alterarValores - 1);
				}
				else
					$_SESSION['mensagemErro']['inserirComodos.php'] = "Tomada não pode ser removida!";
			}
		}
	}
?>