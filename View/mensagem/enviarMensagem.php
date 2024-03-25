<form action="<?php echo CAMINHO_PADRAO_WEB; ?>mensagem/enviarmensagem/" method="post">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="form-group">
				<label for="nome_cliente">Nome</label>
				<input name="nome_cliente" type="text" class="form-control" id="nome_cliente" required>
			</div>
			<div class="form-group">
				<label for="email-cliente">Email</label>
				<input id="email-cliente" name="email_cliente" type="email" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="assunto">Assunto</label>
				<input name="assunto" type="text" class="form-control" id="assunto">
			</div>
			<div class="form-group">
				<label for="mensagem">Mensagem</label>
				<textarea name="mensagem" class="form-control" id="mensagem" rows="5" required></textarea>
			</div>
			<input type="submit" class="btn btn-success btn-block mt-3" value="Enviar">
		</div>
	</div>
</form>