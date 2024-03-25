<?php

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Infra\DC;
use Infra\Sessao;
use Model\Cliente;
use Model\Pedido;
use Model\TipoCliente;

class clienteController extends ApplicationController {
	
	public function index(): void {
		$aClientes = DC::getDAOFactory()->getClienteDAO()->findAll();
		$this->oView->setTitulo('Clientes');
		$this->oView->adicionaVariavel('aClientes', $aClientes);
		$this->oView->exibeTemplate('clientes/listarClientes.php', 'cabecalho.php');
	}
	
	public function cadastrar(): void {
		$this->oView->setTitulo('Cadastrar novo Cliente');
		$this->oView->exibeTemplate('clientes/inserirCliente.php', 'cabecalho.php');
	}
	
	public function excluir(): void {
		$iClienteID = $this->oGlobals->get('id');
		$oCliente = DC::getDAOFactory()->getClienteDAO()->findByID($iClienteID);
		$oCliente->apagar();
		Sessao::setMensagem('Cliente excluido com sucesso');
		header("Location: " . CAMINHO_PADRAO_WEB . "cliente/");
	}
	
	public function editar(): void {
		$iClienteID = $this->oGlobals->get('id');
		$oCliente = DC::getDAOFactory()->getClienteDAO()->findByID($iClienteID);
		$this->oView->setTitulo('Editar Cliente');
		$this->oView->adicionaVariavel('oCliente', $oCliente);
		$this->oView->exibeTemplate('clientes/editarCliente.php', 'cabecalho.php');
	}
	
	public function postCadastra(): void {
		try {
			$oCliente = $this->criaCliente();
			$oCliente->salvar();
			Sessao::setMensagem('Cliente cadastrado com sucesso');
		} catch (Exception $oException){
			Sessao::setMensagem($oException->getMessage());
		} finally {
			header("Location: " . CAMINHO_PADRAO_WEB . "cliente/");
		}
		
	}
	
	public function postEdita(): void {
		try {
			$oCliente = $this->criaCliente();
			$oCliente->setDeletado($this->oGlobals->post('cle_deletado'));
			$oCliente->setID($this->oGlobals->post('cle_id'));
			$oCliente->atualizar();
			Sessao::setMensagem('Cliente atualizado com sucesso');
		} catch (Exception $oException){
			Sessao::setMensagem($oException->getMessage());
		} finally {
			header("Location: " . CAMINHO_PADRAO_WEB . "cliente/");
		}
	}
	
	private function criaCliente(): Cliente {
		$oCliente = new Cliente(
			$this->oGlobals->post('cle_nome'),
			$this->oGlobals->post('cle_email'),
			$this->oGlobals->post('cle_tipo')
		);
		$oCliente->setLocalizacao($this->oGlobals->post('cle_localizacao'));

		return $oCliente;
	}

	public function importar(): void {
		$this->oView->setTitulo('Importar Clientes');
		$this->oView->exibeTemplate('clientes/importarCliente.php', 'cabecalho.php');
	}

	public function postImportar(): void {
		try {
			DC::getDBHandler()->startTransaction();
			$sFilePath = $_FILES['arquivo']['tmp_name'];
			$oFileReader = ReaderEntityFactory::createXLSXReader();
			$oFileReader->open($sFilePath);

			foreach ($oFileReader->getSheetIterator() as $oSheet) {
				foreach ($oSheet->getRowIterator() as $iRowKey => $oRow) {
					if ($iRowKey == 1) continue;
					$aCells = $oRow->getCells();
					$oCliente = new Cliente($aCells[1]->getValue(), $aCells[2]->getValue(), TipoCliente::PESSOA);
					$oCliente->salvar();

					$oPedido = new Pedido();
					$oPedido->setClienteId($oCliente->getID());
					$oPedido->setProduto($aCells[3]->getValue());
					$tData = !empty($aCells[4]->getValue())
						? DateTime::createFromFormat('Y-m-d', $aCells[4]->getValue())
						: new DateTime();
					$oPedido->setData($tData);
					$oPedido->setValor((float) $aCells[5]->getValue());
					$oPedido->salvar();
				}
			}

			$oFileReader->close();
			Sessao::setMensagem('Dados importados com sucesso');
		} catch (Exception $oException){
			DC::getDBHandler()->failTransaction();
			Sessao::setMensagem($oException->getMessage());
		} finally {
			DC::getDBHandler()->endTransaction();
			header("Location: " . CAMINHO_PADRAO_WEB . "cliente/");
		}
	}
	
}