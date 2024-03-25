<?php

namespace Infra;

class DependencyContainer {
	
	private static $oDBHandler;
	private static $oView;
	private static $oSessao;
	private static $oDAOFactory;

	private function __construct() {}
	
	public static function getDBHandler(): DataBaseHandler {
		if (!isset(self::$oDBHandler)) {
			self::$oDBHandler = new DataBaseHandler(JSONConfig::getInstance());
		}
		return self::$oDBHandler;
	}
	
	public static function getView(): View {
		if (!isset(self::$oView)) {
			self::$oView = new View();
		}
		return self::$oView;
	}
	
	public static function getSessao(): Sessao {
		if (!isset(self::$oSessao)) {
			self::$oSessao = new Sessao();
		}
		return self::$oSessao;
	}

	public static function getDAOFactory(): DAOFactory {
		if (!isset(self::$oDAOFactory)) {
			self::$oDAOFactory = new DAOFactory();
		}
		return self::$oDAOFactory;
	}
	
}