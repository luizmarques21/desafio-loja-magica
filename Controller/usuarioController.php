<?php

use Infra\DC;
use Infra\Sessao;
use Model\Usuario;

class usuarioController extends ApplicationController {
	
	public function index(): void {
		$aUsuarios = DC::getDAOFactory()->getUsuarioDAO()->findAll();
		$this->oView->setTitulo('Usuarios');
		$this->oView->adicionaVariavel('aUsuarios', $aUsuarios);
		$this->oView->exibeTemplate('usuarios/listarUsuarios.php', 'cabecalho.php');
	}
	
	public function cadastrar(): void {
		$this->oView->setTitulo('Criar novo usuario');
		$this->oView->exibeTemplate('usuarios/inserirUsuario.php', 'cabecalho.php');
	}
	
	public function excluir(): void {
		try {
			$oUsuario = DC::getDAOFactory()->getUsuarioDAO()->findByID($this->oGlobals->get('id'));
			$oUsuario->isUsuarioAtivo($this->oSessao->getUsuarioLogado());
			$oUsuario->deletar();
			Sessao::setMensagem('Usuario excluido com sucesso');
		} catch (Exception $oException) {
			Sessao::setMensagem($oException->getMessage());
		} finally {
			header("Location: " . CAMINHO_PADRAO_WEB . "usuario/");
		}
	}
	
	public function editar(): void {
		$oUsuario = DC::getDAOFactory()->getUsuarioDAO()->findByID($this->oGlobals->get('id'));
		$this->oView->setTitulo('Editar Usuario');
		$this->oView->adicionaVariavel('oUsuario', $oUsuario);
		$this->oView->exibeTemplate('usuarios/editarUsuario.php', 'cabecalho.php');
	}
	
	public function sair(): void {
		$this->oSessao->deslogaUsuario();
		header("Location: ../login");
	}
	
	public function postCadastrar(): void {
		$oUsuario = new Usuario(
			$this->oGlobals->post('login'),
			$this->oGlobals->post('senha'),
			$this->oGlobals->post('tipo_usuario')
		);
		$oUsuario->salvar();
		Sessao::setMensagem('Usuario cadastrado com sucesso!');
		header("Location: " . CAMINHO_PADRAO_WEB . "usuario/");
	}
	
	public function postEditar(): void {
		$oUsuario = new Usuario(
			$this->oGlobals->post('login'),
			$this->oGlobals->post('senha'),
			$this->oGlobals->post('tipo_usuario')
		);
		$oUsuario->setID($this->oGlobals->post('id'));
		$oUsuario->atualizar();
		Sessao::setMensagem('Usuario atualizado com sucesso!');
		header("Location: " . CAMINHO_PADRAO_WEB . "usuario/");
	}
	
}