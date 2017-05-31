<?php
	/*controlador*/

	/*espaco para includes*/
	include_once ("../model/EspecificacoesComodo.php");
	include_once ("../util/VetorLista.php");

	session_start();

	if(isset($_SESSION['VetorLista']) == false)
		$_SESSION['VetorLista'] = new VetorLista();

	$testaAcao = htmlspecialchars($_POST['acaoRealizada']);

	include_once("tratamentosErro.php");
	verificaErros($testaAcao);

	include_once("analiseDados.php");
	if(!isset($_SESSION['mensagemErro']))
		verificaAcao($testaAcao);

?>