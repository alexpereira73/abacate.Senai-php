<?php

	function verificaErros($testandoAcao){
		unset($_SESSION['mensagemErro']);

		if( (htmlspecialchars($_POST['area'])) == null || (htmlspecialchars($_POST['perimetro'])) == null || ($_POST['quantidade']) == null ){
			if($testandoAcao != "Nova Tomada" && substr($testandoAcao, 0, 6) != "remove"){
				$_SESSION['mensagemErro'] = "Todos os campos devem ser preenchidos";
				/*header('Location: ../view/inserirComodos.php');*/
				header('Location: '.$_SESSION['paginaOrigem']);
			}
		}

		else{
			if(!is_numeric(htmlspecialchars($_POST['area'])))
				$_SESSION['mensagemErro'] = "Campo Área deve ser preenchido com Números";
			else if(!is_numeric(htmlspecialchars($_POST['perimetro'])))
				$_SESSION['mensagemErro'] = "Campo Perímetro deve ser preenchido com Números";
			else{
				foreach($_POST['quantidade'] as $searchNumbers)
				if(!is_numeric($searchNumbers)){
					$_SESSION['mensagemErro'] = "Campo Quantidade deve ser preenchido com Números";
					break;
				}
			}

			if(isset($_SESSION['mensagemErro']))
				/*../view/inserirComodos.php*/
				header('Location: '.$_SESSION['paginaOrigem']);
		}
	}
?>