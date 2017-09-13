<h2>Usuários cadastrados</h2>
<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Login</th>
			<th>Contatos</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($usuarios_cadastrados as $usuario){ ?>
		<tr>
			<td><?php echo $usuario['id'] ?></td>
			<td><?php echo $usuario['login'] ?></td>
			<td><?php echo $usuario['total_contatos'] ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart() {

	// Create the data table.
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Topping');
	data.addColumn('number', 'Slices');
	
	<?php foreach ($usuarios_cadastrados as $usuario){ ?>
	data.addRows([
	  ['<?php echo $usuario['login'] ?>', <?php echo $usuario['total_contatos'] ?>]
	]);
	<?php } ?>

	// Set chart options
	var options = {'title':'Quantidade contatos por usuário',
				   'width':600,
				   'height':600};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
	chart.draw(data, options);
  }
</script>


<div id="chart_div"></div>