<?php

use Infra\DC;
use Infra\Sessao;
use Model\Cliente;
use Model\Pedido;
use Model\TipoCliente;

class pedidoController extends ApplicationController {
	
	public function index(): void {
		$aPedidos = DC::getDAOFactory()->getPedidoDAO()->findAll();
		$this->oView->setTitulo('Pedidos');
		$this->oView->adicionaVariavel('aPedidos', $aPedidos);
		$this->oView->exibeTemplate('pedidos/listarPedidos.php', 'cabecalho.php');
	}
	
	public function cadastrar(): void {
		$this->oView->setTitulo('Cadastrar novo Pedido');
		$aClientes = DC::getDAOFactory()->getClienteDAO()->findAll();
		$this->oView->adicionaVariavel('aClientes', $aClientes);
		$this->oView->exibeTemplate('pedidos/inserirPedido.php', 'cabecalho.php');
	}
	
	public function excluir(): void {
		$iPedidoID = $this->oGlobals->get('id');
		$oPedido = DC::getDAOFactory()->getPedidoDAO()->findByID($iPedidoID);
		$oPedido->apagar();
		Sessao::setMensagem('Pedido excluido com sucesso');
		header("Location: " . CAMINHO_PADRAO_WEB . "pedido/");
	}
	
	public function editar(): void {
		$iPedidoID = $this->oGlobals->get('id');
		$oPedido = DC::getDAOFactory()->getPedidoDAO()->findByID($iPedidoID);
		$aClientes = DC::getDAOFactory()->getClienteDAO()->findAll();
		$this->oView->setTitulo('Editar Pedido');
		$this->oView->adicionaVariavel('oPedido', $oPedido);
		$this->oView->adicionaVariavel('aClientes', $aClientes);
		$this->oView->exibeTemplate('pedidos/editarPedido.php', 'cabecalho.php');
	}
	
	public function postCadastra(): void {
		try {
			$oPedido = $this->criaPedido();
			$oPedido->salvar();
			Sessao::setMensagem('Pedido cadastrado com sucesso');
		} catch (Exception $oException){
			Sessao::setMensagem($oException->getMessage());
		} finally {
			header("Location: " . CAMINHO_PADRAO_WEB . "pedido/");
		}
		
	}
	
	public function postEdita(): void {
		try {
			$oPedido = $this->criaPedido();
			$oPedido->setDeletado($this->oGlobals->post('pdo_deletado'));
			$oPedido->setID($this->oGlobals->post('pdo_id'));
			$oPedido->atualizar();
			Sessao::setMensagem('Pedido atualizado com sucesso');
		} catch (Exception $oException){
			Sessao::setMensagem($oException->getMessage());
		} finally {
			header("Location: " . CAMINHO_PADRAO_WEB . "pedido/");
		}
	}
	
	private function criaPedido(): Pedido {
		$oPedido = new Pedido();
		$oPedido->setClienteId($this->oGlobals->post('cle_id'));
		$oPedido->setProduto($this->oGlobals->post('pdo_produto'));
		$tData = !empty($this->oGlobals->post('pdo_data_pedido'))
			? DateTime::createFromFormat('Y-m-d', $this->oGlobals->post('pdo_data_pedido'))
			: new DateTime();
		$oPedido->setData($tData);
		$oPedido->setValor((float) $this->oGlobals->post('pdo_valor'));
		$oPedido->setQuantidade($this->oGlobals->post('pdo_quantidade'));

		return $oPedido;
	}

	public function importar(): void {
		$this->oView->setTitulo('Importar Pedidos');
		$this->oView->exibeTemplate('pedidos/importarPedido.php', 'cabecalho.php');
	}

	public function postImportar(): void {
		try {
			DC::getDBHandler()->startTransaction();
			$oXMLData = simplexml_load_file($_FILES['arquivo']['tmp_name']);
			$aPedidos = $oXMLData->children();

			foreach ($aPedidos as $oPedidoXML) {
				$oCliente = new Cliente($oPedidoXML->nome_loja, '', TipoCliente::LOJA);
				$oCliente->setLocalizacao($oPedidoXML->localizacao);
				$oCliente->salvar();

				$oPedido = new Pedido();
				$oPedido->setClienteId($oCliente->getID());
				$oPedido->setProduto($oPedidoXML->produto);
				$oPedido->setQuantidade((int) $oPedidoXML->quantidade);
				$oPedido->salvar();
			}

			Sessao::setMensagem('Dados importados com sucesso');
		} catch (Exception $oException){
			DC::getDBHandler()->failTransaction();
			Sessao::setMensagem($oException->getMessage());
		} finally {
			DC::getDBHandler()->endTransaction();
			header("Location: " . CAMINHO_PADRAO_WEB . "pedido/");
		}
	}
	
}