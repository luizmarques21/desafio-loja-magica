<?php use Model\Usuario; ?>

<div class="row">
	<div class="col-md-4">
		<a href="cadastrar/" class="btn btn-info btn-block">Criar Novo Usuario</a>
	</div>
</div>

<div class="row mt-5">
	<div class="col-md-12">
		<?php if (count($aUsuarios) > 0): ?>
			<table class="table">
				<thead>
				<tr>
					<th>ID</th>
					<th>Login</th>
					<th>Tipo</th>
                    <th></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($aUsuarios as $aUsuario): ?>
					<?php $oUsuario = Usuario::createFromArray($aUsuario) ?>
					<tr>
						<td><?php echo $oUsuario->getID(); ?></td>
						<td><?php echo $oUsuario->getLogin(); ?></td>
						<td><?php echo $oUsuario->getTipo() == 'A'?'Administrador':'Comum' ?></td>
						<td align="right">
							<a href="editar/<?php echo $oUsuario->getID() ?>" class="btn btn-info">Editar</a>
							<a href="excluir/<?php echo $oUsuario->getID() ?>" class="btn btn-danger">Excluir</a>
						</td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>
		<?php else: ?>
			<p>Nenhum usuario cadastrado</p>
		<?php endif; ?>
	</div>
</div>