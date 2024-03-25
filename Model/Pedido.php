<?php

namespace Model;

use DateTime;
use Infra\DC;

class Pedido {
	
	private $iID;
	private $iClienteId;
	private $fValor;
	private $sProduto;
	private $iQuantidade;
	private $tData;
	private $bDeletado = false;
	
	public static function createFromArray(array $aDados): Pedido {
		$oPedido = new Pedido();
		$oPedido->setID($aDados['pdo_id']);
		$oPedido->setClienteId($aDados['cle_id']);
		$oPedido->setProduto($aDados['pdo_produto']);
		$oPedido->setQuantidade($aDados['pdo_quantidade']);
		$oPedido->setData(DateTime::createFromFormat('Y-m-d', $aDados['pdo_data_pedido']));
		$oPedido->setValor($aDados['pdo_valor']);
		$oPedido->setDeletado($aDados['pdo_deletado']);

		return $oPedido;
	}
	
	public function setID(int $iID): void {
		$this->iID = $iID;
	}
	
	public function setDeletado(bool $bDeletado): void {
		$this->bDeletado = $bDeletado;
	}
	
	public function getID(): int {
		return $this->iID ?? 0;
	}
	
	public function getProduto(): string {
		return $this->sProduto ?? '';
	}
	
	public function getValor(): float {
		return $this->fValor ?? 0;
	}

	public function getDeletado(): bool {
		return $this->bDeletado;
	}

	public function salvar(): void {
		DC::getDAOFactory()->getPedidoDAO()->save($this);
	}

	public function apagar(): void {
		$this->setDeletado(true);
		DC::getDAOFactory()->getPedidoDAO()->replace($this);
	}

	public function atualizar(): void {
		DC::getDAOFactory()->getPedidoDAO()->replace($this);
	}

	public function setClienteId(int $iClienteId): void {
		$this->iClienteId = $iClienteId;
	}

	public function setProduto(string $sProduto): void {
		$this->sProduto = $sProduto;
	}

	public function setData(DateTime $tData): void {
		$this->tData = $tData;
	}

	public function setValor(float $fValor): void {
		$this->fValor = $fValor;
	}

	public function getClienteId(): int {
		return $this->iClienteId ?? 0;
	}

	public function getData(): DateTime {
		return $this->tData ?? new DateTime();
	}

	public function getCliente(): Cliente {
		return DC::getDAOFactory()->getClienteDAO()->findByID($this->iClienteId);
	}

	public function getQuantidade(): int {
		return $this->iQuantidade ?? 0;
	}

	public function setQuantidade(int $iQuantidade): void {
		$this->iQuantidade = $iQuantidade;
	}
	
}