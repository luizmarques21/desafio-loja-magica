<?php

namespace Model;

use Exception;
use Infra\DC;

class Usuario {
	
	private $iID;
	private $sLogin;
	private $sSenha;
	private $sTipoUsuario;
	
	public function __construct(string $sLogin, string $sSenha, string $sTipoUsuario) {
		$this->sLogin = $sLogin;
		$this->sSenha = $sSenha;
		$this->sTipoUsuario = $sTipoUsuario;
	}
	
	public function salvar(): void {
		$this->codificaSenha();
		DC::getDAOFactory()->getUsuarioDAO()->save($this);
	}
	
	public function deletar(): void {
		DC::getDAOFactory()->getUsuarioDAO()->delete($this->getID());
	}
	
	public function atualizar(): void {
		$this->atualizaSenha();
		DC::getDAOFactory()->getUsuarioDAO()->replace($this);
	}
	
	public static function createFromArray(array $aDados): Usuario {
		$oUsuario = new Usuario($aDados['usi_login'], $aDados['usi_senha'], $aDados['usi_tipo_usuario']);
		$oUsuario->setID($aDados['usi_id']);
		return $oUsuario;
	}
	
	public function getLogin(): string {
		return $this->sLogin;
	}
	
	public function getID(): int {
		return $this->iID;
	}
	
	public function getTipo(): string {
		return $this->sTipoUsuario;
	}
	
	public function getSenha(): string {
		return $this->sSenha;
	}
	
	public function setID(int $iID): void {
		$this->iID = $iID;
	}
	
	private function codificaSenha(): void {
		$this->sSenha = password_hash($this->sSenha, PASSWORD_DEFAULT);
	}
	
	private function atualizaSenha(): void {
		if (strlen($this->sSenha) <= 0) {
			$oUsuario = DC::getDAOFactory()->getUsuarioDAO()->findByID($this->iID);
			$this->sSenha = $oUsuario->getSenha();
		} else {
			$this->codificaSenha();
		}
	}
	
	public static function isADM(string $sNome): bool {
		$sTipo =DC::getDAOFactory()->getUsuarioDAO()->findByUsername($sNome)->getTipo();
		return $sTipo == TipoUsuario::ADMINISTRADOR;
	}
	
	public function isUsuarioAtivo(string $sUsuarioAtivo): void {
		if ($this->getLogin() == $sUsuarioAtivo)
			throw new Exception ('Usuario ativo no sistema');
	}
	
}