<ul class="nav nav-pills">
  <li role="presentation"><a href="<?php echo BASE_URL ?>agendas">Listar contatos</a></li>
  <li role="presentation" class="active"><a href="<?php BASE_URL ?>agendas/inserir">Inserir contato</a></li>
</ul>
<br />
<form method="post">
<div class="row">
  <div class="form-group col-md-3 col-sd-12">
    <label for="nome">Nome</label>
    <input type="nome" name="nome" class="form-control" id="nome" placeholder="Nome">
  </div>
    <div class="form-group col-md-3 col-sd-12">
    <label for="telefone">Telefone</label>
    <input type="text" name="telefone" class="form-control input-telefone" id="telefone" placeholder="Telefone">
  </div>
  <div class="form-group col-md-3 col-sd-12">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
  </div>
  <div class="form-group col-md-2 col-sd-12">
    <label for="">&nbsp;</label>
	<button type="submit" class="form-control btn btn-primary">Inserir</button>
	</div>
</div>
</form>