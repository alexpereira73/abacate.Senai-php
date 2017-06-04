<?php
	function formularioComodo($controlePosicao){
		echo
		"<form style=' max-width: 700px; padding: 10px; margin: 0 auto;' method = 'post' action='../controller/controlador.php'>

			Identificação do cômodo:<select name='comodosId'>
				<option value='Banheiro'"
				.($_SESSION['previoIdComodo'] == "Banheiro") ? "selected" : ""." > Banheiro </option>
				<option value='Cozinha'"
				.($_SESSION['previoIdComodo'] == "Cozinha") ? "selected" : ""." > Cozinha </option>
				<option value='Copa'"
				.($_SESSION['previoIdComodo'] == "Copa") ? "selected" : ""." > Copa </option>
				<option value='Copa-Cozinha'"
				.($_SESSION['previoIdComodo'] == 'Copa-Cozinha') ? 'selected' : ''." > Copa-Cozinha </option>
				<option value='Area de Servico'"
				.($_SESSION['previoIdComodo'] == 'Area de Servico') ? 'selected' : ''." > Área de servico </option>
				<option value='Cozinha-area de servico'"
				.($_SESSION['previoIdComodo'] == 'Cozinha-area de servico') ? 'selected' : ''." > Cozinha-área de servico </option>
				<option value='Lavanderia'"
				.($_SESSION['previoIdComodo'] == 'Lavanderia') ? 'selected' : ''." > Lavanderia </option>
				<option value='Sala'"
				.($_SESSION['previoIdComodo'] == 'Sala') ? 'selected' : ''." > Sala </option>
				<option value='Dormitorio'"
				.($_SESSION['previoIdComodo'] == 'Dormitorio') ? 'selected' : ''." > Dormitorio </option>
			</select>

			<tab>Área:</tab><input type='number' name='area' min='1' max='9999' value = '". $_SESSION['areaPrevia']."'>

			<tab>Perímetro:</tab><input type='number' name='perimetro' min='1' max='9999' value = '".$_SESSION['perimetroPrevio']."'>";
			

			for ($position = 0; $position < $controlePosicao; $position += 1){
				echo
				"<br/>Tomada de uso específico:<select name='tomadas[]'>
					<option value='Ferro de Passar'"
					.($_SESSION['valoresPreviosTipoTomada'][$position] == 'Ferro de Passar') ? 'selected' : ''." > Ferro de Passar </option>
					<option value='Chuveiro'"
					.($_SESSION['valoresPreviosTipoTomada'][$position] == 'Chuveiro') ? 'selected' : ''." > Chuveiro </option>
					<option value='Maquina de Lavar'"
					.($_SESSION['valoresPreviosTipoTomada'][$position] == 'Maquina de Lavar') ? 'selected' : ''." > Máquina de Lavar </option>
					<option value='Microondas'"
					.($_SESSION['valoresPreviosTipoTomada'][$position] == 'Microondas') ? 'selected' : ''." > Micro-Ondas </option>
					<option value='Ar condicionado'"
					.($_SESSION['valoresPreviosTipoTomada'][$position] == 'Ar condicionado') ? 'selected' : ''." > Ar condicionados </option>
				</select>

				<tab>Quantidade:<input type='number' min='1' max='270' name='quantidade[]'
				 value='".$_SESSION['valoresPreviosQuantidadeTomada'][$position]."' required/></tab>";
			}
			
			echo
			"<tab><input type='submit' name='acaoRealizada' value='Nova Tomada'></tab>

			<br/><input type='submit' name='acaoRealizada' value='Inserir Comodo'><br/>

			<!--<br/><input type='submit' name='acaoRealizada' value='Calcular' size='7'>-->";

			
			if(isset($_SESSION['mensagemErro'])){
				/*echo '<tab/><errorMessages>'.$_SESSION['mensagemErro'].'</errorMessages>';*/
				echo "<div class='alert alert-danger' role='alert'>".$_SESSION['mensagemErro']."</div>";
				unset($_SESSION['mensagemErro']);
			}
		
		echo "</form>";
	}
?>