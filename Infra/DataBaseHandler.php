<?php

namespace Infra;

use PDO;
use PDOException;
use PDOStatement;

class DataBaseHandler {
	
	private $rConexao;
	private $oConfig;
	private $bFalha = false;
	private $sNomeBanco;
	private $sHost;
	private $sUsuario;
	private $sSenha;
	private $iPorta;
	
	public function __construct(JSONConfig $oConfig) {
		$this->oConfig = $oConfig;
		$aConfig = $this->oConfig->loadConfig('DB');
		
		$this->sHost = $aConfig['hostname'];
		$this->iPorta = $aConfig['port'];
		$this->sUsuario = $aConfig['username'];
		$this->sSenha = $aConfig['password'];
		$this->sNomeBanco = $aConfig['database'];
		
		$sDSN = 'mysql:host=' . $this->sHost . ';dbname=' . $this->sNomeBanco . ';port=' . $this->iPorta;
		try {
			$this->rConexao = new PDO($sDSN, $this->sUsuario, $this->sSenha);
			$this->rConexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $oErro) {
			echo $oErro->getMessage();
		}
	}
	
	public function startTransaction(): void {
		$this->rConexao->beginTransaction();
	}
	
	public function endTransaction(): void {
		if (!$this->bFalha)
			$this->rConexao->commit();
		else
			$this->rConexao->rollBack();
	}
	
	public function failTransaction(): bool {
		$this->bFalha = true;
		return $this->bFalha;
	}
	
	public function queryOne(string $sSQL, array $aParams = null) {
		$mSTMT = $this->rConexao->prepare($sSQL);
		if ($aParams)
			$mSTMT = $this->bindParametros($mSTMT, $aParams);
		$mSTMT->execute();
		return $mSTMT->fetch();
	}
	
	public function query(string $sSQL, array $aParams = null): array {
		$mSTMT = $this->rConexao->prepare($sSQL);
		if ($aParams)
			$mSTMT = $this->bindParametros($mSTMT, $aParams);
		$mSTMT->execute();
		return $mSTMT->fetchAll();
	}
	
	public function execute(string $sSQL, array $aParams): bool {
		$mSTMT = $this->rConexao->prepare($sSQL);
		if ($aParams)
			$mSTMT = $this->bindParametros($mSTMT, $aParams);
		return $mSTMT->execute();
	}
	
	private function bindParametros(PDOStatement $mStatement, array $aParametros): PDOStatement {
		$iChave = 1;
		foreach ($aParametros as $aParametro) {
			$mStatement->bindValue($iChave, $aParametro);
			$iChave++;
		}
		return $mStatement;
	}
	
}