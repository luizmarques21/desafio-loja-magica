<?php use Model\TipoUsuario; ?>

<form action="<?php echo CAMINHO_PADRAO_WEB; ?>usuario/postcadastrar/" method="post">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="form-group">
				<label for="login">Login</label>
				<input name="login" type="text" class="form-control" placeholder="Usuario" maxlength="100" required>
				<label for="senha">Senha</label>
				<input name="senha" type="password" class="form-control" placeholder="Senha" maxlength="60" required>
				<label for="tipo_usuario">Tipo</label>
				<?php foreach (TipoUsuario::getArrayCombo() as $aTipo) { ?>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="tipo_usuario" required
						   id="<?php echo "radio{$aTipo['id']}"; ?>" value="<?php echo $aTipo['value']; ?>">
					<label class="form-check-label" for="<?php echo "radio{$aTipo['id']}"; ?>">
						<?php echo $aTipo['value']; ?>
					</label>
				</div>
				<?php } ?>
			</div>
			<input type="submit" class="btn btn-success btn-block" value="Salvar">
		</div>
	</div>
</form>