<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use Infra\DC;
use Model\Cliente;
use Model\TipoCliente;

$sFiltro = $_POST['filtro'];
$sValor = $_POST['valor'];
$oClienteDAO = DC::getDAOFactory()->getClienteDAO();

switch($sFiltro) {
	case 'nome':
		$aClientes = $oClienteDAO->findByName($sValor);
		break;
	case 'tipo':
		$aClientes = $oClienteDAO->findByTipo($sValor);
		break;
}

if (!empty($aClientes)) {
	foreach ($aClientes as $aCliente) {
		$oCliente = Cliente::createFromArray($aCliente); ?>
		<tr>
			<td><?php echo $oCliente->getID(); ?></td>
			<td><?php echo $oCliente->getNome(); ?></td>
			<td><?php echo $oCliente->getEmail(); ?></td>
			<td><?php echo TipoCliente::getValueById($oCliente->getTipo()); ?></td>
			<td align="right">
				<a href="editar/<?php echo $oCliente->getID() ?>" class="btn btn-info btn-group-sm" >Editar</a>
				<a href="excluir/<?php echo $oCliente->getID() ?>" class="btn btn-danger btn-group-sm">Excluir</a>
			</td>
		</tr>
<?php
	}
} else {
	echo '<tr><td colspan="6">Nenhum cliente encontrado</td></tr>';
}