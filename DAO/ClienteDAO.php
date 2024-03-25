<?php

namespace DAO;

use Exception;
use Infra\DC;
use Model\Cliente;

class ClienteDAO {
	
	private $oDBHandler;
	
	public function __construct() {
		$this->oDBHandler = DC::getDBHandler();
	}
	
	public function findAll(): array {
		$sQuery = 'SELECT * FROM cle_cliente WHERE cle_deletado = ?';
		return $this->oDBHandler->query($sQuery, [false]);
	}
	
	public function findByID(int $iID): Cliente {
		$sQuery = 'SELECT * FROM cle_cliente WHERE cle_id = ?';
		$aCliente = $this->oDBHandler->queryOne($sQuery, [$iID]);
		return Cliente::createFromArray($aCliente);
	}
	
	public function save(Cliente $oCliente): void {
		$sQuery = 'INSERT INTO cle_cliente (cle_nome, cle_email, cle_tipo, cle_localizacao) VALUES (?, ?, ?, ?)';
		$aDados = [
			$oCliente->getNome(),
			$oCliente->getEmail(),
			$oCliente->getTipo(),
			$oCliente->getLocalizacao(),
		];
		if (!$this->oDBHandler->execute($sQuery, $aDados))
			throw new Exception('Erro ao inserir cliente');
	}
	
	public function replace(Cliente $oCliente): void {
		$sQuery = 'UPDATE cle_cliente
					SET cle_nome = ?, cle_email = ?, cle_localizacao = ?, cle_tipo = ?, cle_deletado = ?
					WHERE cle_id = ?';
		$aDados = [
			$oCliente->getNome(),
			$oCliente->getEmail(),
			$oCliente->getLocalizacao(),
			$oCliente->getTipo(),
			$oCliente->getDeletado(),
			$oCliente->getID()
		];
		$this->oDBHandler->execute($sQuery, $aDados);
	}
	
	public function findByName(string $sNome): array {
		$sQuery = 'SELECT * FROM cle_cliente WHERE cle_deletado = ? AND cle_nome LIKE ?';
		return $this->oDBHandler->query($sQuery, [false, "%{$sNome}%"]);
	}
	
	public function findByTipo(string $sTipo): array {
		$sQuery = 'SELECT * FROM cle_cliente WHERE cle_deletado = ? AND cle_tipo = ?';
		return $this->oDBHandler->query($sQuery, [false, $sTipo]);
	}

	public function getLastId(): int {
		$sQuery = 'SELECT max(cle_id) FROM cle_cliente';
		$aResultado = $this->oDBHandler->queryOne($sQuery);
		return $aResultado[0];
	}
	
}