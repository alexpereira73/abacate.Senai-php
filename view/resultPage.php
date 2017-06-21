<?php
	$_SESSION['paginaAnterior'] = "resultPage.php";
	/*************************************************
		Retorno ao Usuário:
		• Quantidade de tomadas por cômodo
		• Potência de tomadas por Cômodo
		• Potência de iluminação por Cômodo
		• Potência total de uso específico
		• Potência total instalada na residência
	*************************************************/
	
	if(!isset($_SESSION['VetorLista'])){
		if(isset($_SESSION['mensagemErro'])){
			echo "<br/><div class='alert alert-success' align = 'center' role='alert'>".$_SESSION['mensagemErro']."</div>";
			unset($_SESSION['mensagemErro']);
			session_destroy();
		}
		else
			echo "<br/><div class='alert alert-danger' align = 'center' role='alert'>"."Nenhum Dado Armazenado Para Calcular"."</div>";
	}
	else if($_SESSION['VetorLista'][1] -> isEmpty())
		echo "<br/><div class='alert alert-danger' align = 'center' role='alert'>"."Não há nenhuma informação armazenada"."</div>";
	else{
		$potenciaTotal = 0;
		$potenciaTotalEspecifica = 0;
?>

		<div class="row"  style=" max-width: 810px; padding: 10px; margin: 0 auto;">
			<div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							<div align="center">Resultados Residencia com <?php echo $_SESSION['VetorLista'][1] -> size(); ?> Comodos</div>
							<form method="post" type = "submit" action="../controller/gerenciaControle.php">
								<input style="float:right;" type = "submit" name = "actionResult" value = "Limpar Dados">
							</form>
						</h3>
					</div>
					<div class="panel-body">
						<div>
							<table class="table">
								<thead>
									<tr>
										<th>Tipo de Comodo</th>
										<th>Quantidade de Tomadas</th>
										<th>Potencia das Tomadas</th>
										<th>Iluminação do Cômodo</th>
									</tr>
								</thead>
								
								<?php for($contador = 0; $contador < $_SESSION['VetorLista'][1] -> size(); $contador += 1): ?>
								<tbody align="center">
									<tr>
										<td><?php echo $_SESSION['VetorLista'][1] -> get($contador) -> getIdComodo(); ?></td>
										<td><?php echo $_SESSION['VetorLista'][1] -> get($contador) -> quantidadeTomadas(); ?></td>
										<!-- /*calcula a potencia das tomadas*/ -->
										<?php $potenciaTomadas = $_SESSION['VetorLista'][1] -> get($contador) -> potencias(); ?>

										<td><?php echo ($potenciaTomadas / 1000)."KVA<br/>";/*Divide-se por 1000 para converter para KVA*/ ?></td>

										<!-- /*calcula a potencia da iluminacao*/ -->
										<?php $potenciaIlumicacao = $_SESSION['VetorLista'][1] -> get($contador) -> iluminacao(); ?>
										<td><?php echo $potenciaIlumicacao."KVA<br/><br/>"; ?></td>

										<?php
											/*soma as potencias totais da residencia*/
											$potenciaTotal += (($potenciaTomadas / 1000) + $potenciaIlumicacao);
											$potenciaTotalEspecifica += $_SESSION['VetorLista'][1] -> get($contador) -> potenciasEspecificas();
										?>
									</tr>
								</tbody>
								<?php endfor ?>
							</table>

							<?php
								echo "<br/>Potência total de uso específico: ".$potenciaTotalEspecifica."KVA";
								echo "<br/>Potência total instalada na residência: ".($potenciaTotal + $potenciaTotalEspecifica)."KVA";
								/*session_destroy();*/
							?>
							<input style="float: right" type="button" name="imprimir" value="Imprimir" onclick="window.print();">
						</div><!-- fecha do div da tabela -->
					</div><!-- fecha div panel-body -->
				</div>
			</div><!-- /.col-sm-6 -->
		</div>
		<?php } ?>