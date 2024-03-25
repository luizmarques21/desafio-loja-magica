<form action="<?php echo CAMINHO_PADRAO_WEB; ?>pedido/postcadastra/" method="post">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="form-group">
				<label class="mr-2">Cliente</label>
				<select name="cle_id" class="form-control">
				<?php
				foreach ($aClientes as $aCliente) {
					echo "<option value='{$aCliente['cle_id']}'>{$aCliente['cle_nome']}</option>";
				}
				?>
				</select>
			</div>
			<div class="form-group">
				<label for="pdo_produto">Produtos</label>
				<textarea name="pdo_produto" class="form-control" id="pdo_produto" rows="4" required></textarea>
			</div>
			<div class="form-group">
				<label for="pdo_quantidade">Quantidade</label>
				<input id="pdo_quantidade" name="pdo_quantidade" type="number" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="pdo_data_pedido">Data do pedido</label>
				<input id="pdo_data_pedido" name="pdo_data_pedido" type="date" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="pdo_valor">Valor (R$)</label>
				<input id="pdo_valor" name="pdo_valor" type="number" class="form-control" required>
			</div>
			<input type="submit" class="btn btn-success btn-block" value="Salvar">
		</div>
	</div>
</form>