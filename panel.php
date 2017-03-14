<?php
// incluimos las funciones
require_once 'includes/functions.php';
if (isset($_SESSION['id_User'])){
}else{
  header("Location: logout");
}

if (isset($_POST['borrarpost'])) {
     borrarpublicacion($_POST['borrarpost']);
}

if (isset($_POST['delcomment'])) {
     borrarcomentario($_POST['delcomment']);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo SITETITLE; ?></title>

    <!-- SAU core CSS -->
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
    <link href="themes/style.css" rel="stylesheet">
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
          <a class="navbar-brand" href="#"><i class="fa fa-clone animated infinite flash"></i> <?php echo TITLE; ?> </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php isAdmin(); ?>
			<?php isSuperAdmin(); ?>
            <li><a class="logout-btn" href="logout"><i class="fa fa-sign-in"></i> Cerrar Sesion</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">

          <ul class="nav nav-sidebar">
            <li class="active"><a href="dashboard"><i class="glyphicon glyphicon-th"></i> Inicio</a></li>
            <li><a href="perfil"><i class="fa fa-users"></i> Perfiles Operarios</a></li>
            <li><a href="estadisticasGlobales"><i class="fa fa-commenting-o"></i> Estadisticas Globales</a></li>
            <li><a href="config"><i class="fa fa-cog"></i> Configuración</a></li>
          </ul>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- contenido -->
          <!-- publicar 
          <h4 class="login-welcome"><i class="fa fa-hand-paper-o"></i> Bienvenido <?php echo $_SESSION['nombre']; ?></h4>
           <div id="publish" class="well">
             <form id="publipost" method="POST" action="post">
               <textarea class="form-control" rows="2" name="posts"></textarea><p></p>
               <button class="btn btn-sm btn-default pull-right"><i class="fa fa-circle-o-notch"></i> Publicar</button>
             </form>
           </div>
            -->

             <!-- share post -->
             <div class="qa-message-list" id="wallmessages">
             <?php publicaciones(); ?>
             </div>
             <!-- share post -->

          <!-- contenido -->
		  
		  <div class="alert alert-warning" role="alert">
		  <button type="i" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		  <h4><strong> Advertencia! </strong></h4>
		  </br>
		  Actualmente este sitio se encuentra en construcción, por lo tanto hay funciones en el sistema que no funcionaran.
		  </div>
		  
		  <div class="alert alert-info" role="alert">
		  <button type="i" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		  <h4><strong> Información! </strong></h4> 
		  </br>
		  Bienvenido al sistema Worface Performance Profile.
		  </br>
		  El sistema se compone de tres panles: Panel Principal, Panel Administrador, Panel Super Administrador.
		  </br>
		  Actualmente usted se encuentra en el Panel Principal. Los usuarios que pueden ver este panel son:
		  <br>	-Superadmin
		  <br>	-Admin
		  <br>	-Usuario RRHH
		  </br>
		  </br>
		  <p>IDEA: Para entregar mayor valor agregado al estema, el dashboard podría ser utilizada para mostrar 
		  contenido de interés relacionado con la gestión de personal (noticias, datos de interes, novedades, etc) 
		  y/o publicar los detalles de las actualizaciones del sistema</p>
		  </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="themes/js/jquery.min.js"></script>
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="themes/js/bootstrap.min.js"></script>
    <!-- validation -->
    <script src="themes/js/jquery.validate.min.js"></script>
    <script type="text/javascript">
        $("#publipost").validate({
          rules: {
            posts: "required",
          }
        });

        $('form').each(function(){ 
            $(this).validate({       
              rules: {
                comment: "required",
              }
            });
        });

    </script>
  </body>
</html>
