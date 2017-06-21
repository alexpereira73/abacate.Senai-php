<?php
	$booleano = false;
	if(!isset($_SESSION['InserindoComodo']) || $_SESSION['paginaAnterior'] != "inserirComodos.php"){
		$_SESSION['InserindoComodo'] = new EspecificacoesComodo();
		$booleano = true;
	}
	$_SESSION['paginaAnterior'] = "inserirComodos.php";

	if($booleano){
		$_SESSION['InserindoComodo'] -> setArea("");
		$_SESSION['InserindoComodo'] -> setPerimetro("");
		$_SESSION['InserindoComodo'] -> setIdComodo("Banheiro");
		$_SESSION['InserindoComodo'] -> setTomadasTipo(new VetorLista());
		$_SESSION['InserindoComodo'] -> setQuantidadeTomadasTipo(new VetorLista());
	}
	$quantidadeTomadas = $_SESSION['InserindoComodo'] -> getTomadasTipo() -> size();

?>
<div class = "container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<form method = "post" action="../controller/gerenciaControle.php">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							<div align="center">Dados do Cômodo</div>
						</h3>
					</div>
					<div class="panel-body">
						Identificação do cômodo:<select name="comodosId">
							<option value="Banheiro"
							<?= ($_SESSION['InserindoComodo'] -> getIdComodo() == "Banheiro") ? "selected" : "" ?> > Banheiro </option>
							<option value="Cozinha"
							<?= ($_SESSION['InserindoComodo'] -> getIdComodo() == "Cozinha") ? "selected" : "" ?> > Cozinha </option>
							<option value="Copa"
							<?= ($_SESSION['InserindoComodo'] -> getIdComodo() == "Copa") ? "selected" : "" ?> > Copa </option>
							<option value="Copa-Cozinha"
							<?= ($_SESSION['InserindoComodo'] -> getIdComodo() == "Copa-Cozinha") ? "selected" : "" ?> > Copa-Cozinha </option>
							<option value="Area de Servico"
							<?= ($_SESSION['InserindoComodo'] -> getIdComodo() == "Area de Servico") ? "selected" : "" ?> > Área de servico </option>
							<option value="Cozinha-area de servico"
							<?= ($_SESSION['InserindoComodo'] -> getIdComodo() == "Cozinha-area de servico") ? "selected" : "" ?> > Cozinha-área de servico </option>
							<option value="Lavanderia"
							<?= ($_SESSION['InserindoComodo'] -> getIdComodo() == "Lavanderia") ? "selected" : "" ?> > Lavanderia </option>
							<option value="Sala"
							<?= ($_SESSION['InserindoComodo'] -> getIdComodo() == "Sala") ? "selected" : "" ?> > Sala </option>
							<option value="Dormitorio"
							<?= ($_SESSION['InserindoComodo'] -> getIdComodo() == "Dormitorio") ? "selected" : "" ?> > Dormitorio </option>
						</select>

						<tab>Área:</tab><input type="number" name="area" min="1" max="9999" value = "<?= $_SESSION['InserindoComodo'] -> getArea() ?>">

						<tab>Perímetro:</tab><input type="number" name="perimetro" min="1" max="9999" value = "<?= $_SESSION['InserindoComodo'] -> getPerimetro() ?>">
						
						<tab><input type="submit" name="acaoRealizada" value="Nova Tomada"></tab>

						<?php for ($position = 0; $position < $quantidadeTomadas; $position += 1): ?>
							<?php $valoresPreviosTipoTomada = $_SESSION['InserindoComodo'] -> getTomadasTipo(); ?>
							<?php $valoresPreviosQuantidadeTomada = $_SESSION['InserindoComodo'] -> getQuantidadeTomadasTipo(); ?>
							<br/>Tomada de uso específico:<select name="tomadas[]">
								<option value="Ferro de Passar"
								<?= ($valoresPreviosTipoTomada -> get($position) == "Ferro de Passar") ? "selected" : "" ?> > Ferro de Passar </option>
								<option value="Chuveiro"
								<?= ($valoresPreviosTipoTomada -> get($position) == "Chuveiro") ? "selected" : "" ?> > Chuveiro </option>
								<option value="Maquina de Lavar"
								<?= ($valoresPreviosTipoTomada -> get($position) == "Maquina de Lavar") ? "selected" : "" ?> > Máquina de Lavar </option>
								<option value="Microondas"
								<?= ($valoresPreviosTipoTomada -> get($position) == "Microondas") ? "selected" : "" ?> > Micro-Ondas </option>
								<option value="Ar condicionado"
								<?= ($valoresPreviosTipoTomada -> get($position) == "Ar condicionado") ? "selected" : "" ?> > Ar condicionados </option>
							</select>

							<tab>Quantidade:<input type="number" min="1" max="270" name="quantidade[]"
							 value="<?= $valoresPreviosQuantidadeTomada -> get($position) ?>" required/></tab>

							<button style="float: left;" type="submit" class="close" aria-label="Close" name="acaoRealizada" value="<?= 'remove_'.$position ?>">
								<span aria-hidden="true">&times;</span>
							</button>
						<?php endfor ?>

						<br/><input type="submit" name="acaoRealizada" value="Inserir Comodo"><br/>

					</div><!-- fecha div panel-body -->
				</div>
				
			</form>
			<?php
				if(isset($_SESSION['mensagemErro']['inserirComodos.php'])){
					echo "<div class='alert alert-danger' role='alert'>".$_SESSION['mensagemErro']['inserirComodos.php']."</div>";
					unset($_SESSION['mensagemErro']['inserirComodos.php']);
				}
			?>
		</div>	<!-- fecha md-10 -->
		<div class="col-md-1"></div>
	</div>	<!-- fecha row -->
</div>	<!-- fecha container -->