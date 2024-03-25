<?php

namespace DAO;

use Exception;
use Infra\DependencyContainer;
use Model\Usuario;

class UsuarioDAO {
	
	private $oDBHandler;
	
	public function __construct() {
		$this->oDBHandler = DependencyContainer::getDBHandler();
	}
	
	public function findByUsername(string $sUser): Usuario {
		$sQuery = 'SELECT * FROM usi_usuario WHERE usi_login = ? AND usi_data_remocao IS NULL';
		$aResultado = $this->oDBHandler->queryOne($sQuery, [$sUser]);
		if (is_bool($aResultado))
			throw new Exception('Usuario não encontrado');
		return Usuario::createFromArray($aResultado);
	}
	
	public function findAll(): array {
		$sQuery = 'SELECT * FROM usi_usuario WHERE usi_data_remocao IS NULL';
		return $this->oDBHandler->query($sQuery);
	}
	
	public function findByID(int $iID): Usuario {
		$sQuery = 'SELECT * FROM usi_usuario WHERE usi_id = ? AND usi_data_remocao IS NULL';
		$aUsuario = $this->oDBHandler->queryOne($sQuery, [$iID]);
		return Usuario::createFromArray($aUsuario);
	}
	
	public function save(Usuario $oUsuario): bool {
		$sQuery = 'INSERT INTO usi_usuario (usi_login, usi_senha, usi_tipo_usuario) VALUES (?, ?, ?)';
		$aDados = [
			$oUsuario->getLogin(),
			$oUsuario->getSenha(),
			$oUsuario->getTipo()
		];
		return $this->oDBHandler->execute($sQuery, $aDados);
	}
	
	public function delete(int $iID): bool {
		$sQuery = 'UPDATE usi_usuario SET usi_data_remocao = ? WHERE usi_id = ?';
		return $this->oDBHandler->execute($sQuery, [date('Y-m-d H:i:s'), $iID]);
	}
	
	public function replace(Usuario $oUsuario): bool {
		$sQuery = 'UPDATE usi_usuario SET usi_login = ?, usi_senha = ?, usi_tipo_usuario = ? WHERE usi_id = ?';
		$aDados = [
			$oUsuario->getLogin(),
			$oUsuario->getSenha(),
			$oUsuario->getTipo(),
			$oUsuario->getID()
		];
		return $this->oDBHandler->execute($sQuery, $aDados);
		
	}
}