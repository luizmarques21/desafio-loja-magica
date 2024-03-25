<?php

namespace DAO;

use Exception;
use Infra\DC;
use Model\Pedido;

class PedidoDAO {
	
	private $oDBHandler;
	
	public function __construct() {
		$this->oDBHandler = DC::getDBHandler();
	}
	
	public function findAll(): array {
		$sQuery = 'SELECT * FROM pdo_pedido WHERE pdo_deletado = ?';
		return $this->oDBHandler->query($sQuery, [false]);
	}
	
	public function findByID(int $iID): Pedido {
		$sQuery = 'SELECT * FROM pdo_pedido WHERE pdo_id = ?';
		$aItem = $this->oDBHandler->queryOne($sQuery, [$iID]);
		return Pedido::createFromArray($aItem);
	}
	
	public function save(Pedido $oPedido): void {
		$sQuery = 'INSERT INTO pdo_pedido (cle_id, pdo_produto, pdo_quantidade, pdo_data_pedido, pdo_valor) VALUES (?, ?, ?, ?, ?)';
		$aDados = [
			$oPedido->getClienteId(),
			$oPedido->getProduto(),
			$oPedido->getQuantidade(),
			$oPedido->getData()->format('Y-m-d'),
			$oPedido->getValor(),
		];
		if (!$this->oDBHandler->execute($sQuery, $aDados))
			throw new Exception('Erro ao inserir pedido');
	}
	
	public function replace(Pedido $oPedido): void {
		$sQuery = 'UPDATE pdo_pedido
					SET cle_id = ?, pdo_produto = ?, pdo_quantidade = ?,pdo_data_pedido = ?, pdo_valor = ?, pdo_deletado = ?
					WHERE pdo_id = ?';
		$aDados = [
			$oPedido->getClienteId(),
			$oPedido->getProduto(),
			$oPedido->getQuantidade(),
			$oPedido->getData()->format('Y-m-d'),
			$oPedido->getValor(),
			$oPedido->getDeletado(),
			$oPedido->getID()
		];
		$this->oDBHandler->execute($sQuery, $aDados);
	}
	
}