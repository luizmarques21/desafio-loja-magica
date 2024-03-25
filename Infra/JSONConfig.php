<?php

namespace Infra;

class JSONConfig {
	
	private $aConfig;
	public static $oConfig;
	public static $sConfigFile;
	
	private function __construct() {
		self::$sConfigFile = file_get_contents(__DIR__ . '/.config.json');
	}
	
	public function loadConfig(string $sConfig): array {
		$this->aConfig = json_decode(self::$sConfigFile, true);
		return $this->aConfig[$sConfig];
	}
	
	public static function setConfigFile(string $sPath): void {
		self::$sConfigFile = file_get_contents($sPath);
	}

	public static function getInstance(): JSONConfig {
		if (!isset(self::$oConfig))
			self::$oConfig = new JSONConfig();
		return self::$oConfig;
	}
	
}