<?php

namespace Infra;

use DAO\ClienteDAO;
use DAO\PedidoDAO;
use DAO\UsuarioDAO;

class DAOFactory {

	private $oClienteDAO;
	private $oUsuarioDAO;
	private $oPedidoDAO;

	public function getClienteDAO(): ClienteDAO {
		if (empty($this->oClienteDAO)) {
			$this->oClienteDAO = new ClienteDAO();
		}
		return $this->oClienteDAO;
	}

	public function getUsuarioDAO(): UsuarioDAO {
		if (empty($this->oUsuarioDAO)) {
			$this->oUsuarioDAO = new UsuarioDAO();
		}
		return $this->oUsuarioDAO;
	}

	public function getPedidoDAO(): PedidoDAO {
		if (empty($this->oPedidoDAO)) {
			$this->oPedidoDAO = new PedidoDAO();
		}
		return $this->oPedidoDAO;
	}

}