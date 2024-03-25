<?php

use Infra\DC;
use Model\Autenticador;

class loginController extends ApplicationController {

	public function index(): void {
		$this->oView->setTitulo('Login');
		$this->oView->exibeTemplate('loginForm.php');
	}
	
	public function home(): void {
		$this->oView->setTitulo('Home');
		$sLogado = $this->oSessao->getUsuarioLogado();
		$this->oView->adicionaVariavel('sLogado', $sLogado);
		$this->oView->exibeTemplate('/../public/view/home.php', 'cabecalho.php');
	}
	
	public function validaLogin(): void {
		try{
			$oAutenticador = new Autenticador(
				$this->oGlobals->post('usuario'),
				$this->oGlobals->post('senha')
			);
			$oUsuario = DC::getDAOFactory()->getUsuarioDAO()->findByUsername($oAutenticador->getUsuario());
			if (!$oAutenticador->validaSenha($oUsuario->getSenha()))
				throw new Exception('Senha invalida');
			$this->oSessao->registraUsuarioLogado($oUsuario->getLogin());
			header("Location: home/");
		} catch(Exception $oEx) {
			$this->oSessao->setMensagem($oEx->getMessage());
			$this->index();
		}
	}
	
}