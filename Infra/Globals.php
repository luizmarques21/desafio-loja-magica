<?php

namespace Infra;

class Globals {
	
	private $aGET;
	private $aPOST;
	
	public function __construct(array $aGET, array $aPOST) {
		$this->aGET = $aGET;
		$this->aPOST = $aPOST;
	}
	
	public function get(string $sIndice) {
		if (isset($this->aGET[$sIndice])) {
			return $this->aGET[$sIndice];
		}
		
		return null;
	}
	
	public function post(string $sIndice) {
		if (isset($this->aPOST[$sIndice])) {
			return $this->aPOST[$sIndice];
		}
		
		return null;
	}
	
}