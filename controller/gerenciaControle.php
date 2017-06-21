<?php
	require_once ("../util/VetorLista.php");
	require_once ("../model/CodificacaoPaginas.php");
	require_once ("../model/EspecificacoesComodo.php");
	session_start();
	$_SESSION['mensagemSucesso'] = array("resultPage.php" => " ", "inserirComodos.php" => " ", "comodosInseridos.php" => " ", "edicao.php" => " ");
	$_SESSION['mensagemErro'] = array("resultPage.php" => " ", "inserirComodos.php" => " ", "comodosInseridos.php" => " ", "edicao.php" => " ");
	if($_SESSION['paginaAnterior'] == "inserirComodos.php" || $_SESSION['paginaAnterior'] == "edicao.php"){
		if((htmlspecialchars($_POST['area'])) == null || (htmlspecialchars($_POST['perimetro'])) == null || (htmlspecialchars($_POST['comodosId'])) == null || htmlspecialchars($_POST['acaoRealizada']) == null){
			if(htmlspecialchars($_POST['acaoRealizada']) != null){
				if(htmlspecialchars($_POST['acaoRealizada']) != "Nova Tomada" || htmlspecialchars($_POST['acaoRealizada']) == "Inserir Comodo" || htmlspecialchars($_POST['acaoRealizada']) == "Concluir"){
					$_SESSION['mensagemErro'][$_SESSION['paginaAnterior']] = "Todos os campos devem ser preenchidos";
					header('Location: '."../view/gerenciadorView.php?selectPage=".($_SESSION['CodificacaoPaginas'] -> getChave($_SESSION['paginaAnterior'])) );
				}
			}
		}
		if(!is_numeric(htmlspecialchars($_POST['area'])))
			$_SESSION['InserindoComodo'] -> setArea("");
		else
			$_SESSION['InserindoComodo'] -> setArea(htmlspecialchars($_POST['area']));

		if(!is_numeric(htmlspecialchars($_POST['perimetro'])))
			$_SESSION['InserindoComodo'] -> setPerimetro("");
		else
			$_SESSION['InserindoComodo'] -> setPerimetro(htmlspecialchars($_POST['perimetro']));

		$_SESSION['InserindoComodo'] -> setIdComodo(htmlspecialchars($_POST['comodosId']));

		$acao = htmlspecialchars($_POST['acaoRealizada']);

		require_once("analiseDados.php");
		entreEdicaoInsercao($acao);
		if($acao == "Inserir Comodo")
			unset($_SESSION['InserindoComodo']);
		
	}
	else if($_SESSION['paginaAnterior'] == "comodosInseridos.php"){
		for($posicaoEdicao = 0; (!isset($_POST['editaDeleta_'.$posicaoEdicao])) && $posicaoEdicao < $_SESSION['VetorLista'][1] -> size(); $posicaoEdicao += 1);
			if($posicaoEdicao >= $_SESSION['VetorLista'][1] -> size())
				$_SESSION['mensagemErro']['comodosInseridos.php'] = "Comodo não encontrado!";
			
			else{
				$editarDeletar = $_POST['editaDeleta_'.$posicaoEdicao];
				if($editarDeletar == "Deletar"){
					$_SESSION['VetorLista'][1] -> removeIndex($posicaoEdicao);
					$_SESSION['mensagemSucesso']["comodosInseridos.php"] = "Comodo Removido Com Sucesso";
				}
				else{
					$_SESSION['paginaAnterior'] = "edicao.php";
					$_SESSION['editando'] = $posicaoEdicao;
				}
			}
	}
	else if($_SESSION['paginaAnterior'] == "resultPage.php"){
		if(isset($_POST['actionResult'])){
			if($_POST['actionResult'] == "Limpar Dados"){
				session_destroy();
				session_start();
				$_SESSION['mensagemSucesso']["resultPage.php"] = "<div class='alert alert-success' role='alert' align = 'center'>"."Dados Deletados com Sucesso"."</div>";
			}
		}
	}
	
	if($_SESSION['mensagemSucesso']["resultPage.php"] == " ")
		unset($_SESSION['mensagemSucesso']["resultPage.php"]);
	if($_SESSION['mensagemSucesso']["inserirComodos.php"] == " ")
		unset($_SESSION['mensagemSucesso']["inserirComodos.php"]);
	if($_SESSION['mensagemSucesso']["comodosInseridos.php"] == " ")
		unset($_SESSION['mensagemSucesso']["comodosInseridos.php"]);
	if($_SESSION['mensagemSucesso']["edicao.php"] == " ")
		unset($_SESSION['mensagemSucesso']["edicao.php"]);

	
	if($_SESSION['mensagemErro']["resultPage.php"] == " ")
		unset($_SESSION['mensagemErro']["resultPage.php"]);
	if($_SESSION['mensagemErro']["inserirComodos.php"] == " ")
		unset($_SESSION['mensagemErro']["inserirComodos.php"]);
	if($_SESSION['mensagemErro']["comodosInseridos.php"] == " ")
		unset($_SESSION['mensagemErro']["comodosInseridos.php"]);
	if($_SESSION['mensagemErro']["edicao.php"] == " ")
		unset($_SESSION['mensagemErro']["edicao.php"]);

	header('Location: '."../view/gerenciadorView.php?selectPage=".($_SESSION['CodificacaoPaginas'] -> getChave($_SESSION['paginaAnterior'])) );
?>