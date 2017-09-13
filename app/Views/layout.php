
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo SITE_NAME ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo BASE_URL ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL ?>css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<div class="container">
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="<?php echo BASE_URL ?>"><?php echo SITE_NAME ?></a>
			</div>

			<?php if (is_logged()){ ?>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo BASE_URL ?>admin">Admin</a></li>
				<li><a href="<?php echo BASE_URL ?>usuarios/logout">Sair</a></li>
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
			<?php } ?>
		</nav>
			<h1><?php echo SITE_NAME ?></h1>
			<?php if (isset($_SESSION['post_status'])){
				if ($_SESSION['post_status']){?>
					<div class="alert alert-success"><?php echo $_SESSION['return_message'] ?></div>
				<?php } else { ?>
					<div class="alert alert-danger"><?php echo $_SESSION['return_message'] ?></div>
				<?php }
				unset($_SESSION['post_status']);
				unset($_SESSION['return_message']);
			} ?>
			<?php echo $CONTENT ?>
	</div>

	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BASE_URL ?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL ?>js/jquery.maskedinput.min.js"></script>
    <script src="<?php echo BASE_URL ?>js/main.js"></script>
  </body>
</html>