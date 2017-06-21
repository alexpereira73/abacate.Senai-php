<?php
	$_SESSION['paginaAnterior'] = "comodosInseridos.php";
	unset($_SESSION['InserindoComodo']);
	if(isset($_SESSION['mensagemSucesso']['comodosInseridos.php'])){
		echo "<br/><div class='alert alert-success' align = 'center' role='alert'>".$_SESSION['mensagemSucesso']['comodosInseridos.php']."</div>";
		unset($_SESSION['mensagemSucesso']['comodosInseridos.php']);
	}

	if(isset($_SESSION['mensagemErro']['comodosInseridos.php'])){
		echo "<br/><div class='alert alert-danger' align = 'center' role='alert'>".$_SESSION['mensagemErro']['comodosInseridos.php']."</div>";
		unset($_SESSION['mensagemErro']['comodosInseridos.php']);
	}

	if(!isset($_SESSION['VetorLista'][1])){
		$repeticaoLaco = 0;
		echo "<br/><div class='alert alert-danger' role='alert'>"."<p align = 'center'>Nenhum Cômodo foi inserido</p>"."</div>";
	}
	else{
		if($_SESSION['VetorLista'][1] -> size() == 0){
			if(!isset($_SESSION['mensagemSucesso']))
				echo "<br/><div class='alert alert-warning' role='alert'>"."<p align = 'center'>Nenhum Cômodo foi inserido</p>"."</div>";
			else{
				$_SESSION['mensagemSucesso'] = " ";
				unset($_SESSION['mensagemSucesso']);
			}
		}
		$repeticaoLaco = $_SESSION['VetorLista'][1] -> size();
	}
?>

<form style=" max-width: 810px; padding: 10px; margin: 0 auto;" method = "post" action = "../controller/gerenciaControle.php">
	<?php for($position = 0; $position < $repeticaoLaco; $position += 1): ?>

		<div class="row">
			<div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							<div align="center"><?php echo $_SESSION['VetorLista'][1] -> get($position) -> getIdComodo(); ?></div>
							<input style="float:left;" type = "submit" name = "<?= 'editaDeleta_'.$position; ?>" value = "Editar"/>
							<input style="float:right;" type = "submit" name = "<?= 'editaDeleta_'.$position; ?>" value = "Deletar"><br/><br/>
						</h3>
					</div>
					<div class="panel-body">
						<div>

							<table class="table">
								<thead>
									<tr>
										<th>Área</th>
										<th>Perímetro</th>
										<th>Tomadas de Uso Específico</th>
										<th>Quantidade</th>
									</tr>
								</thead>
								
								<tbody>
									<tr>
										<td><?php echo $_SESSION['VetorLista'][1] -> get($position) -> getArea(); ?></td>
										<td><?php echo $_SESSION['VetorLista'][1] -> get($position) -> getPerimetro(); ?></td>
										<?php if( !($_SESSION['VetorLista'][1] -> get($position) -> getTomadasTipo() -> isEmpty()) ){ ?>
											<td><?php echo $_SESSION['VetorLista'][1] -> get($position) -> printTomadasTipo(); ?></td>
											<td><?php echo $_SESSION['VetorLista'][1] -> get($position) -> printQuantidadeTomadasTipo(); ?></td>
										<?php } else { ?>
											<td>------------</td>
											<td>------------</td>
										<?php } ?>
									</tr>								  
								</tbody>
							</table>

						</div><!-- fecha do div da tabela -->
					</div><!-- fecha div panel-body -->
				</div>
			</div><!-- /.col-sm-6 -->
		</div>

	<?php endfor ?>
</form>