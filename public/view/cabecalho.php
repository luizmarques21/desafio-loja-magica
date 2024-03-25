<?php use Infra\Sessao; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Loja Mágica de Tecnologia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo CAMINHO_PADRAO_WEB . 'public/css/styles.css'; ?>">
    <script src="http://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous">
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo CAMINHO_PADRAO_WEB; ?>home/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo CAMINHO_PADRAO_WEB; ?>cliente/">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo CAMINHO_PADRAO_WEB; ?>pedido/">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo CAMINHO_PADRAO_WEB; ?>mensagem/">Mensagens</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo CAMINHO_PADRAO_WEB; ?>usuario/">Usuarios</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo CAMINHO_PADRAO_WEB; ?>usuario/sair">Sair</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
	<div class="jumbotron">
		<h1>Loja Mágica de Tecnologia - <?php echo $sTitulo; ?></h1>
	</div>
	
	<?php if (strlen(Sessao::getMensagem()) > 0): ?>
		<div class="alert alert-primary">
			<?php
                echo Sessao::getMensagem();
                Sessao::setMensagem('');
            ?>
		</div>
    <?php endif; ?>