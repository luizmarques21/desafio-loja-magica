<?php

namespace Infra;

class Sessao {
	
	public function iniciaSessao(): void {
		if (session_status() !== PHP_SESSION_ACTIVE) {
			session_start();
		}
		if (!isset($_SESSION['mensagem']))
			$_SESSION['mensagem'] = '';
		if (!isset($_SESSION['logado']))
			$_SESSION['logado'] = '';
	}
	
	public function registraUsuarioLogado(string $sNome): void {
		$_SESSION['logado'] = $sNome;
	}
	
	public function getUsuarioLogado(): string {
		return $_SESSION['logado'];
	}
	
	public function deslogaUsuario(): void {
		unset($_SESSION['logado']);
	}
	
	public function hasUsuarioAtivo(): bool {
		return (strlen($_SESSION['logado']) > 0);
	}
	
	public static function getMensagem(): string {
		return $_SESSION['mensagem'];
	}
	
	public static function setMensagem(string $sMensagem): void {
		$_SESSION['mensagem'] = $sMensagem;
	}

}