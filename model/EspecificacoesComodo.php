<?php
	class EspecificacoesComodo{
		private $idComodo = "";
		private $area = 0;
		private $perimetro = 0;
		private $tomadasTipo = "";
		private $quantidadeTomadasTipo = 0;

		public function inserirDados($recebeComodoId, $recebeArea, $recebePerimetro, $recebeTipoTomada, $recebeQuantidadeTomada){
			$this -> idComodo = $recebeComodoId;
			$this -> area = $recebeArea;
			$this -> perimetro = $recebePerimetro;
			$this -> tomadasTipo = $recebeTipoTomada;
			$this -> quantidadeTomadasTipo = $recebeQuantidadeTomada;
		}

		public function exibirInformacoes(){
			echo "Id do comodo: ".$this -> idComodo."<br/>";
			echo "Area do comodo: ".$this -> area."<br/>";
			echo "Perimetro do comodo: ".$this -> perimetro."<br/>";
			echo "Tipo de Tomadas no comodo: ".$this -> tomadasTipo."<br/>";
			echo "Quantidade de Tomadas de cada tipo: ".$this -> quantidadeTomadasTipo."<br/>";
		}

		public function getIdComodo(){
			return $this -> idComodo;
		}

		public function setIdComodo($idComodoRecebido) {
			$this -> idComodo = $idComodoRecebido;
		}

		public function getArea() {
			return $this -> area;
		}

		public function setArea($areaRecebida) {
			$this -> area = $areaRecebida;
		}

		public function getPerimetro() {
			return $this -> perimetro;
		}

		public function setPerimetro($perimetroRecebido) {
			$this -> perimetro = $perimetroRecebido;
		}

		public function getTomadasTipo() {
			return $this -> tomadasTipo;
		}

		public function setTomadasTipo($tomadasTipoRecebido) {
			$this -> tomadasTipo = $tomadasTipoRecebido;
		}

		public function getQuantidadeTomadasTipo() {
			return $this -> quantidadeTomadasTipo;
		}

		public function setQuantidadeTomadasTipo($quantidadeTomadasTipoRecebido) {
			$this -> quantidadeTomadasTipo = $quantidadeTomadasTipoRecebido;
		}

		public function iluminacao(){
			if($this -> area <= 6)
				return 100;

			$potencia = 100;
			for($contador = ($this -> area - 6); $contador > 0; $contador -= 4){
				$potencia += 60;
			}
			return $potencia;
		}

		public function potenciasEspecificas(){
			/*definindo os valores das potencias em KVA*/
			$potencias["Chuveiro"] = 4.4;
			$potencias["Ferro de Passar"] = 1.2;
			$potencias["Ar condicionado"] = 2.5;
			$potencias["Máquina de Lavar"] = 1;
			$potencias["Microondas"] = 2;
			
			/*teste insercao dados da hash*/
			/*foreach ($potencias as $valores) {
				echo "$valores"."<br/>";
			}*/
		}

		public function quantidadeTomadas(){
			if($this -> idComodo == "Dormitorio" || $this -> idComodo == "Sala"){
				$numeroTomadas = intval(($this -> perimetro) <= 5 ? 1 : ($this -> perimetro / 5));
				return (($this -> perimetro / 5) > numeroTomadas) ? (numeroTomadas + 1) : numeroTomadas;
			}
			$numeroTomadas = intval(($this -> perimetro) <= 3.5 ? 1 : ($this -> perimetro / 3.5));
			return (($this -> perimetro / 3.5) > $numeroTomadas) ? ($numeroTomadas + 1) : $numeroTomadas;
		}

		public function potencias(){
			if($this -> idComodo == "Dormitorio" || $this -> idComodo == "Sala"){
				$tomadasTotal = $this -> quantidadeTomadas();
				$potenciaTomada = 0;
				for($contador = 0; $contador < $tomadasTotal; $contador += 1){
					$potenciaTomada += 100;
				}
				return $potenciaTomada;	/*Volts Ampere*/
			}
			else{
				$tomadasTotal = $this -> quantidadeTomadas();
				$potenciaTomada = 0;
				for($contador = 0; $contador < $tomadasTotal; $contador += 1){
					if($contador < 3){
						$potenciaTomada += 600;
						continue;
					}
					$potenciaTomada += 100;
				}
				return $potenciaTomada;	/*Volts Ampere*/
			}
			return 0;
		}

	}
?>