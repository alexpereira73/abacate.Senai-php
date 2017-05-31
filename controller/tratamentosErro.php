<?php
	session_start();

	function verificaErros($testandoAcao){
		unset($_SESSION['mensagemErro']);

		if( (htmlspecialchars($_POST['area'])) == null || (htmlspecialchars($_POST['perimetro'])) == null || (htmlspecialchars($_POST['quantidade'])) == null ){
			if($testandoAcao != "Nova Tomada" && $testandoAcao != "Calcular"){
				$_SESSION['mensagemErro'] = "Todos os campos devem ser preenchidos";
				header('Location: ../view/index.php');
			}
		}

		else{
			if(!is_numeric(htmlspecialchars($_POST['area'])))
				$_SESSION['mensagemErro'] = "Campo Área deve ser preenchido com Números";
			else if(!is_numeric(htmlspecialchars($_POST['perimetro'])))
				$_SESSION['mensagemErro'] = "Campo Perímetro deve ser preenchido com Números";
			else if(!is_numeric(htmlspecialchars($_POST['quantidade'])))
				$_SESSION['mensagemErro'] = "Campo Quantidade deve ser preenchido com Números";

			if(isset($_SESSION['mensagemErro']))
				header('Location: ../view/index.php');
		}
	}
?>