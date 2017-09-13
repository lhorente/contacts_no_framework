<ul class="nav nav-pills">
  <li role="presentation" class="active"><a href="<?php echo BASE_URL ?>agendas">Listar contatos</a></li>
  <li role="presentation"><a href="<?php BASE_URL ?>agendas/inserir">Inserir contato</a></li>
</ul>
<br />
<?php if ($agendas){ ?>
	<table class="table">
		<tr>
			<th>Nome</th>
			<th>Email</th>
			<th>Telefone</th>
			<th>&nbsp;</th>
		</tr>
	<?php foreach ($agendas as $agenda){ ?>
		<tr>
			<td><a href="<?php echo BASE_URL ?>agendas/editar/<?php echo $agenda->id ?>"><?php echo $agenda->nome ?></a></td>
			<td><?php echo $agenda->email ?></td>
			<td><?php echo $agenda->telefone ?></td>
			<td><a href="<?php echo BASE_URL ?>agendas/excluir/<?php echo $agenda->id ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a></td>
		</tr>
	<?php } ?>
	</table>
<?php } else { ?>
	<p class="well">Não existe nenhum contato cadastrado</p>
<?php } ?>