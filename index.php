<?php

require_once __DIR__ . '/vendor/autoload.php';

use Infra\DC;
use Infra\Globals;
use Model\Usuario;

const CAMINHO_PADRAO_WEB = 'http://localhost/desafio-loja-magica/';
date_default_timezone_set('America/Bahia');
ini_set('display_errors', 0);

$oSessao = DC::getSessao();
$oSessao->iniciaSessao();

$oGlobais = new Globals($_GET, $_POST);

if (empty($_REQUEST) && !$oSessao->hasUsuarioAtivo()) {
	header("Location: login/");
} else {
	if (!empty($_REQUEST)) {
		if ($_REQUEST['controller'] == 'home') {
			$sClassName = 'loginController';
			$sAction = 'home';
		} else {
			$sClassName = $_REQUEST['controller'] . 'Controller';
			$sAction = $_REQUEST['action'];
		}
		$iID = $_REQUEST['id'];

		if (!$oSessao->hasUsuarioAtivo() && $sClassName != 'loginController') {
			$oSessao->setMensagem('Usuario precisa estar logado');
			header("Location: " . CAMINHO_PADRAO_WEB . "login/");
		} else {
			if ($sClassName == 'usuarioController' &&
				!Usuario::isADM($oSessao->getUsuarioLogado()) &&
				$sAction != 'sair'
			) {
				$oSessao->setMensagem('Usuario precisa ter privilegio adminstrativo');
				header("Location: " . CAMINHO_PADRAO_WEB . "home");
			} else {
				$oObject = new $sClassName($oGlobais);
				if ($sAction === '')
					$oObject->index();
				else
					$oObject->$sAction($iID);
			}
		}
	} else {
		header("Location: " . CAMINHO_PADRAO_WEB . "home");
	}
}