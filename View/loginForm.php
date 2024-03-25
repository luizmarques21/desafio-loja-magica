<?php use Infra\Sessao; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Loja Mágica de Tecnologia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo CAMINHO_PADRAO_WEB . 'public/css/styles.css'; ?>">
</head>
<body>

<div class="container">
    <div class="jumbotron">
        <h1><?= $sTitulo; ?></h1>
    </div>
	
	<?php if (strlen(Sessao::getMensagem()) > 0): ?>
        <div class="alert alert-primary">
			<?php
                echo Sessao::getMensagem();
                Sessao::setMensagem('');
            ?>
        </div>
    <?php endif; ?>
    <form action="<?php echo CAMINHO_PADRAO_WEB ?>login/validalogin" method="post">
        <div class="form-group">
            <label for="usuario">Login</label>
            <input type="text" name="usuario" id="usuario" class="form-control">
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>