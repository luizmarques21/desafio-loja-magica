<?php

namespace Infra;

class View {
	
	private $aDados = [];
	
	public function exibeTemplate(string $sTemplate, string $sCabecalho = null): void {
		extract($this->aDados);
		if (!empty($sCabecalho))
			$this->exibeCabecalho($sCabecalho);
		include_once 'View/' . $sTemplate;
		include_once 'public/view/rodape.php';
	}
	
	public function exibeCabecalho(string $sCabecalho) {
		extract($this->aDados);
		include_once 'public/view/' . $sCabecalho;
	}
	
	public function adicionaVariavel(string $sNomeVariavel, $mValorVariavel) {
		$this->aDados[$sNomeVariavel] = $mValorVariavel;
	}
	
	public function setTitulo(string $sTitulo) {
		$this->aDados['sTitulo'] = $sTitulo;
	}
	
}