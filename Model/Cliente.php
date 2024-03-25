<?php

namespace Model;

use Infra\DC;

class Cliente {
	
	private $iID;
	private $sNome;
	private $sEmail;
	private $sLocalizacao;
	private $sTipo;
	private $bDeletado = false;
	
	public function __construct(string $sNome, string $sEmail, string $sTipo) {
		$this->sNome = $sNome;
		$this->sEmail = $sEmail;
		$this->sTipo = $sTipo;
	}
	
	public static function createFromArray(array $aDados): Cliente {
		$oCliente = new Cliente($aDados['cle_nome'], $aDados['cle_email'], $aDados['cle_tipo']);
		$oCliente->setID($aDados['cle_id'] ?? null);
		$oCliente->setDeletado($aDados['cle_deletado'] ?? false);
		$oCliente->setLocalizacao($aDados['cle_localizacao'] ?? '');

		return $oCliente;
	}
	
	public function setID(int $iID): void {
		$this->iID = $iID;
	}
	
	public function setDeletado(bool $bDeletado): void {
		$this->bDeletado = $bDeletado;
	}
	
	public function getID(): int {
		return $this->iID ?? 0;
	}
	
	public function getNome(): string {
		return $this->sNome ?? '';
	}
	
	public function getEmail(): string {
		return $this->sEmail ?? '';
	}
	
	public function getTipo(): string {
		return $this->sTipo;
	}

	public function getDeletado(): bool {
		return $this->bDeletado;
	}

	public function salvar(): void {
		DC::getDAOFactory()->getClienteDAO()->save($this);
		$iClienteId = DC::getDAOFactory()->getClienteDAO()->getLastId();
		$this->setID($iClienteId);
	}

	public function apagar(): void {
		$this->setDeletado(true);
		DC::getDAOFactory()->getClienteDAO()->replace($this);
	}

	public function atualizar(): void {
		DC::getDAOFactory()->getClienteDAO()->replace($this);
	}

	public function setLocalizacao(string $sLocalizacao): void {
		$this->sLocalizacao = $sLocalizacao;
	}

	public function getLocalizacao(): string {
		return $this->sLocalizacao ?? '';
	}
	
}