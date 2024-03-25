<?php

namespace Model;

class Autenticador {
	
	private $sUsuario;
	private $sSenha;
	
	public function __construct(string $sUsuario, string $sSenha) {
		$this->sUsuario = $sUsuario;
		$this->sSenha = $sSenha;
	}
	
	public function getUsuario(): string {
		return $this->sUsuario;
	}
	
	public function validaSenha(string $sSenha): bool {
		return password_verify($this->sSenha, $sSenha);
	}
	
}