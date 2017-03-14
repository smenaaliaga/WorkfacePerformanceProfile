<?php
require_once 'includes/superadmin.functions.php';

if (isset($_SESSION['id_User'])) {
   if ($_SESSION['nivel'] <> 1) {
	header('Location: logout');
   }
}else{
    header('Location: logout');
}

if (isset($_POST['mantenimiento'])) {
    updasau($_POST['mantenimiento'],$_POST['mensaje'],$_POST['estilo']);
}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo SITETITLE; ?></title>

    <!-- SAU core CSS -->
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
    <link  href="../themes/css/morris.css" rel="stylesheet">
    <link href="../themes/style.css" rel="stylesheet">
    <link href="admin.css" rel="stylesheet">
    <?php getstyle(); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="dashboard-panel">

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><i class="fa fa-clone animated infinite flash"></i> <?php echo TITLE; ?> | Super Administrador</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a class="logout-btn" href="../dashboard"><i class="fa fa-cubes"></i> Escritorio</a></li>
            <li><a class="logout-btn" href="logout"><i class="fa fa-sign-in"></i> Cerrar Sesion</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">

          <ul class="nav nav-sidebar">
            <li><a href="index"><i class="glyphicon glyphicon-th"></i> Inicio</a></li>
            <li><a href="usuarios"><i class="fa fa-users"></i> Usuarios</a></li>
            <li><a href="perfiles"><i class="fa fa-user-plus"></i> Perfiles</a></li>
            <li class="active"><a href="configuration"><i class="fa fa-cog fa-spin"></i> Configuración</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- contenido -->
		  
		  <div class="alert alert-warning" role="alert">
		  <button type="i" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		  <strong> Advertencia! </strong>
		  </br>
		  Actualmente este sitio no posee funcionalidad.
		  </div>
		  
		  <div class="alert alert-info" role="alert">
		  <button type="i" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		  <strong> Información! </strong>
		  </br>
		  La sección de configuración del Super Administadro contará con las configuraciones del Administrador y
		  del Super Administrador.
		  </div>

        
              <div class="col-sm-6">
                <div class="well">
                  <h4><i class="fa fa-cog fa-spin"></i> Configuración del Sistema</h4>

                  <form method="POST" action="">
                  
                  <?php //sauconfig(); ?>

                  <p></p>

                  <button type="submit" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-floppy-saved"></i> Guardar Cambios</button>

                  </form>
                 
                </div>
              </div>
			  
			  <div class="col-sm-6">
                <div class="well">
                  <h4><i class="fa fa-cog fa-spin"></i> Configuración del Sistema | Super Administrador</h4>

                  <form method="POST" action="">
                  
                  <?php //sauconfig(); ?>

                  <p></p>

                  <button type="submit" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-floppy-saved"></i> Guardar Cambios</button>

                  </form>
                 
                </div>
              </div>



          <!-- contenido -->
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="../themes/js/jquery.min.js"></script>
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../themes/js/bootstrap.min.js"></script>
  </body>
</html>
