<?php use Model\TipoUsuario; ?>

<form action="<?php echo CAMINHO_PADRAO_WEB; ?>usuario/posteditar/" method="post">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="form-group">
				<input type="hidden" name="id" value="<?php echo $oUsuario->getID(); ?>">
				<label for="login">Login</label>
				<input name="login" type="text" value="<?php echo $oUsuario->getLogin() ?>" class="form-control" maxlength="100" required>
				<label for="senha">Senha</label>
				<input type="password" name="senha" class="form-control" placeholder="Deixe em branco caso não queira atualizar a senha" maxlength="60">
				<label for="tipo_usuario">Tipo</label>
				<?php foreach (TipoUsuario::getArrayCombo() as $aTipo) { ?>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="tipo_usuario" required
						<?php echo $aTipo['id'] == $oUsuario->getTipo() ? 'checked' : '' ?>
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