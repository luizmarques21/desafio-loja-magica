<?php

use Infra\Email;
use Infra\Sessao;

class mensagemController extends ApplicationController {

	public function index(): void {
		$this->oView->setTitulo('Enviar mensagem');
		$this->oView->exibeTemplate('mensagem/enviarMensagem.php', 'cabecalho.php');
	}

	public function enviarMensagem(): void {
		try {
			$oEmail = new Email();
			$oEmail->setDestinatario($this->oGlobals->post('nome_cliente'), $this->oGlobals->post('email_cliente'));
			$oEmail->setAssunto($this->oGlobals->post('assunto'));
			$oEmail->setMensagem($this->oGlobals->post('mensagem'));
			$oEmail->enviar();

			Sessao::setMensagem('Mensagem enviada com sucesso');
		} catch (Exception $oException){
			Sessao::setMensagem($oException->getMessage());
		} finally {
			header("Location: " . CAMINHO_PADRAO_WEB . "mensagem/");
		}
	}

}