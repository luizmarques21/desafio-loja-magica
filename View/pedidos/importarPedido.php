<form action="<?php echo CAMINHO_PADRAO_WEB; ?>pedido/postimportar/" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="form-group">
				<label for="arquivo">Insira o arquivo com os dados de importação</label>
				<input name="arquivo" type="file" class="form-control" id="arquivo" accept=".xml" required>
			</div>
			<input type="submit" class="btn btn-success btn-block mt-3" value="Importar">
		</div>
	</div>
</form>