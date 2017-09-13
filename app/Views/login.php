<div class='login-container'>
	<form class="form-signin" method="post" action="<?php echo BASE_URL ?>usuarios/login">
		<h2 class="form-signin-heading">Faça login para acessar</h2>
		<label for="inputEmail" class="sr-only">Usuário</label>
		<input type="text" id="inputEmail" class="form-control" name="login" placeholder="Usuário" required autofocus>
		<label for="inputPassword" class="sr-only">Senha</label>
		<input type="password" id="inputPassword" class="form-control" name="password" placeholder="Senha" required>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>
	</form>
	<div class="weel login-info">
		<a href="<?php echo BASE_URL ?>usuarios/cadastrar">Cadastrar</a>
	</div>
</div>