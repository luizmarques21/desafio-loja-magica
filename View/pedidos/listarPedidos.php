<?php use Model\Pedido; ?>

<div class="row">
	<div class="col-md-4">
		<a href="<?php echo CAMINHO_PADRAO_WEB; ?>pedido/cadastrar/" class="btn btn-info btn-block">Criar Novo Pedido</a>
	</div>
	<div class="col-md-4">
		<a href="<?php echo CAMINHO_PADRAO_WEB; ?>pedido/importar/" class="btn btn-secondary btn-block">Importar Pedidos</a>
	</div>
</div>

<div class="row mt-5">
	<div class="col-md-12">
		<?php if (count($aPedidos) > 0): ?>
			<table class="table">
				<thead>
				<tr>
					<th>ID</th>
					<th>Cliente</th>
                    <th>Produtos</th>
                    <th>Quantidade</th>
                    <th>Data</th>
                    <th>Valor</th>
                    <th></th>
				</tr>
				</thead>
				<tbody id="table-resultado">
				<?php foreach ($aPedidos as $aPedido): ?>
					<?php $oPedido = Pedido::createFromArray($aPedido) ?>
					<tr>
						<td><?php echo $oPedido->getID(); ?></td>
                        <td><?php echo $oPedido->getCliente()->getNome(); ?></td>
                        <td><?php echo $oPedido->getProduto(); ?></td>
                        <td><?php echo $oPedido->getQuantidade(); ?></td>
                        <td><?php echo $oPedido->getData()->format('d/m/Y'); ?></td>
                        <td>R$ <?php echo $oPedido->getValor(); ?></td>
                        <td align="right">
							<a href="editar/<?php echo $oPedido->getID() ?>" class="btn btn-info btn-group-sm" >Editar</a>
                            <a href="excluir/<?php echo $oPedido->getID() ?>" class="btn btn-danger btn-group-sm">Excluir</a>
                        </td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>
		<?php else: ?>
			<p>Nenhum Pedido cadastrado</p>
		<?php endif; ?>
	</div>
</div>