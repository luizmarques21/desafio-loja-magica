<?php use Model\TipoCliente; ?>

<script src="<?php echo CAMINHO_PADRAO_WEB; ?>public/js/lib/jquery-maskedinput.js"></script>

<form action="<?php echo CAMINHO_PADRAO_WEB; ?>cliente/postedita/" method="post">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<input type="hidden" name="cle_id" value="<?php echo $oCliente->getID() ?>">
			<input type="hidden" name="cle_deletado" value="<?php echo $oCliente->getDeletado() ?>">
			<div class="form-group">
				<label for="nome_cliente">Nome</label>
				<input name="cle_nome" type="text" class="form-control" id="nome_cliente" value="<?php echo $oCliente->getNome(); ?>" required>
			</div>
			<div class="form-group">
				<label for="email-cliente">Email</label>
				<input id="email-cliente" name="cle_email" type="email" class="form-control" value="<?php echo $oCliente->getEmail(); ?>" required>
			</div>
			<div class="form-group">
				<label for="cle_localizacao">Localização</label>
				<input name="cle_localizacao" type="text" class="form-control" id="cle_localizacao" value="<?php echo $oCliente->getLocalizacao(); ?>">
			</div>
			<div class="form-group">
				<label class="mr-2">Tipo do Cliente:</label>
				<?php foreach (TipoCliente::getArrayCombo() as $aTipo) { ?>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="cle_tipo" required
						<?php echo $aTipo['id'] == $oCliente->getTipo() ? 'checked' : '' ?>
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