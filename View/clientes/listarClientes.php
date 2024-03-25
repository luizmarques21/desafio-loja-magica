<?php
use Model\TipoCliente;
use Model\Cliente;
?>

<div class="row">
	<div class="col-md-2">
		<a href="<?php echo CAMINHO_PADRAO_WEB; ?>cliente/cadastrar" class="btn btn-info btn-block">Criar Novo Cliente</a>
	</div>
	<div class="col-md-2">
		<a href="<?php echo CAMINHO_PADRAO_WEB; ?>cliente/importar" class="btn btn-secondary btn-block">Importar Clientes</a>
	</div>
    <div class="col-sm-6 ml-auto input-group">
        <span class="input-group-text">Buscar por:</span>
        <select class="form-control" id="filtro-busca">
            <option value="nome">Nome</option>
            <option value="tipo">Tipo</option>
        </select>
        <input type="text" class="form-control" id="valor-busca-nome">
        <select class="form-control" id="valor-busca-tipo">
            <?php foreach (TipoCliente::getArrayCombo() as $aTipo) { ?>
			<option value="<?php echo $aTipo['id']; ?>"><?php echo $aTipo['value']; ?></option>
			<?php } ?>
        </select>
        <button type="button" class="btn btn-light" id="btn-busca">Buscar</button>
        <a href="" class="btn btn-light">Limpar</a>
    </div>
</div>

<div class="row mt-5">
	<div class="col-md-12">
		<?php if (count($aClientes) > 0): ?>
			<table class="table">
				<thead>
				<tr>
					<th>ID</th>
					<th>Nome</th>
                    <th>Email</th>
                    <th>Localização</th>
                    <th>Tipo</th>
                    <th></th>
				</tr>
				</thead>
				<tbody id="table-resultado">
				<?php foreach ($aClientes as $aCliente): ?>
					<?php $oCliente = Cliente::createFromArray($aCliente) ?>
					<tr>
						<td><?php echo $oCliente->getID(); ?></td>
                        <td><?php echo $oCliente->getNome(); ?></td>
                        <td><?php echo $oCliente->getEmail(); ?></td>
                        <td><?php echo $oCliente->getLocalizacao(); ?></td>
                        <td><?php echo TipoCliente::getValueById($oCliente->getTipo()); ?></td>
                        <td align="right">
							<a href="editar/<?php echo $oCliente->getID() ?>" class="btn btn-info btn-group-sm" >Editar</a>
                            <a href="excluir/<?php echo $oCliente->getID() ?>" class="btn btn-danger btn-group-sm">Excluir</a>
                        </td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>
		<?php else: ?>
			<p>Nenhum cliente cadastrado</p>
		<?php endif; ?>
	</div>
</div>

<script src="<?php echo CAMINHO_PADRAO_WEB; ?>public/js/listar-cliente.js"></script>
<script src="<?php echo CAMINHO_PADRAO_WEB; ?>public/js/busca-cliente.js"></script>