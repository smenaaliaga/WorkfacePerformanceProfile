<?php
require_once 'includes/superadmin.functions.php';

if (isset($_SESSION['id_User'])) {
   if ($_SESSION['nivel'] <> 1) {
	header('Location: logout');
   }
}else{
    header('Location: logout');
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo SITETITLE; ?></title>

    <!-- WPP core CSS -->
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
            <li class="active"><a href="usuarios"><i class="fa fa-users"></i> Usuarios</a></li>
            <li><a href="perfiles"><i class="fa fa-user-plus"></i> Perfiles</a></li>
            <li><a href="configuration"><i class="fa fa-cog fa-spin"></i> Configuración</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- contenido -->
		  
		  <div class="alert alert-warning" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		  <strong> Advertencia! </strong> 
		  </br>Actualmnete solo esta habilitada la función de añadir usuarios, administradores y super administradores.
		  </div>
		  
		  <div class="alert alert-info" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		  <strong> Información! </strong> 
		  </br>Como Super Administrador se pueden añadir, editar y eliminar: Usuarios RRHH, Administradores, Super Administradores
		  </div>

             <?php
/*
              if (isset($_POST['rango'])) {
                   cambiardatos($_POST['nombre'],$_POST['email'],$_POST['public'],$_POST['rango'],$_POST['userid']);
              }

              if (isset($_POST['nueva2'])) {
                  cambiarpassword($_POST['nueva2'],$_POST['userid']);
              }

              if (isset($_POST['eliminarusuario'])) {
                  eliminarusuario($_POST['eliminarusuario']);
              }
*/
              if (isset($_POST['nuevousuario'])) {
                 newusuario($_POST['password'],$_POST['nombre'],$_POST['apellidos'],$_POST['email'],$_POST['nivel']);
              }

              ?>
             

                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModal">
                   <i class="glyphicon glyphicon-th-large"></i> Nuevo Usuario
                  </button>
                  
                  <!-- Modal -->
                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> Nuevo Usuario</h4>
                        </div>
                        <div class="modal-body">
                        <form id="usunew" method="POST" action="">
                            
                        <label>Nombre:</label>
                        <input class="form-control" type="text" name="nombre" >
						<label>Apellidos:</label>
                        <input class="form-control" type="text" name="apellidos" >
                        <label>Email:</label>
                        <input class="form-control" type="text" name="email" >
                        <label>Contraseña:</label>
                        <input class="form-control" type="password" name="password" >                        
                        <label>Nivel:</label>
                        <select class="form-control" name="nivel">
                          <option value="3">Usuario</option>
                          <option value="2">Administrador</option>
						  <option value="1">Super Administrador</option>
                        </select>            
						
                        <input type="hidden" name="nuevousuario" value="1" >

                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Crear Usuario</button>
                          </form>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                      </div>
                    </div>
                  </div>

             <!-- ultimos posts -->
             <div class="col-sm-12 paddingone">
               <div class="well graficas">
               	

               	  <table class="table table-striped">
               	  	<thead>
               	  		<tr>
               	  		  <th>Nombre</th>
                        <th>Apellidos</th>
               	  		  <th>Email</th>
               	  		  <th>Nivel</th>
                        <th>Acciones</th>
               	  		</tr>
               	  	</thead>
               	  	<tbody>
               	  	  <?php userslist(); ?>
               	  	</tbody>
               	  </table>
                  
               </div>             	
             </div>             
             <!-- ultimos posts -->

            <?php
            if (isset($_POST['editarusuario'])) {
                 //editarusuario($_POST['editarusuario']);
            }?>

          <!-- contenido -->
		  
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="../themes/js/jquery.min.js"></script>
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../themes/js/bootstrap.min.js"></script>
    <!-- validation -->
    <script src="../themes/js/jquery.validate.min.js"></script>
    <script src="../themes/js/additional-methods.min.js"></script>
    <script type="text/javascript">
        $("#usunew").validate({
          rules: {
            nombre: "required",
			apellidos: "required",
            password: "required",
            email: {
              required: true,
              email: true
            }
          }
        });
    </script>

  </body>
</html>
