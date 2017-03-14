<?php
// incluimos las funciones
require_once 'admin/includes/config.class.php';
require_once 'includes/functions.php';

if (isset($_POST['nombre'])) {

// conexon a base de datos
$conexion = Conexion::singleton_conexion();


$view = "SELECT * FROM users WHERE email = :email";
$sentencia = $conexion -> prepare($view);
$sentencia -> bindParam(':email', $_POST['mail']);
$sentencia -> execute();
$resultados = $sentencia -> fetchAll();
if (empty($resultados)) {
//--------------------------------------------------------------

// contraseña
$nuevapassword = sha1(SALT.$_POST['password'].PEPER);
// perfil
$newprofile = md5($_POST['nombre']);
// Rango
$rank = 1;

$SQL = "INSERT INTO users(name,email,password,profile,public,rank) VALUES(:name,:email,:password,:profile,:public,:rank)";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':name',$_POST['nombre']);
$sentence -> bindParam(':email',$_POST['mail']);
$sentence -> bindParam(':password',$nuevapassword);
$sentence -> bindParam(':profile',$newprofile);
$sentence -> bindParam(':public',$rank);
$sentence -> bindParam(':rank',$rank);
$sentence -> execute();

header('Location: index.php');

//--------------------------------------------------------------
}else{

header('Location: registro.php?error');

}

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo SITETITLE; ?></title>

    <!-- Bootstrap -->
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
    <link href="themes/style.css" rel="stylesheet">
    <?php getstyle(); ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>


<div id="login" class="text-center">
    
    <img src="themes/sau-logo-white.png">
	
	<div class="well">
      
           <form id="form-register" method="POST" action="">
             <label>Nombre:</label>
             <input class="form-control" type="text" name="nombre">
             <label>Email:</label>
             <input class="form-control" type="text" name="mail">
             <label>Contraseña:</label>
             <input class="form-control" type="password" name="password"><p></p>
             <button type="submit" class="btn btn-default pull-right"><i class="fa fa-power-off"></i> Registrarme</button>        
           </form>
      </div>
	
	  <?php
      if (isset($_GET['error'])) {
      	echo'<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Error! </strong> Este correo electronico ya esta en uso :( debes de utilizar otro correo. </div>';
      }
    ?>

</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="themes/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="themes/js/bootstrap.min.js"></script>
    <!-- efectos SAU 2 -->
    <script src="themes/js/effects.js"></script>
    <!-- validation -->
    <script src="themes/js/jquery.validate.min.js"></script>
    <script src="themes/js/additional-methods.min.js"></script>
    <script type="text/javascript">
        $("#form-register").validate({
          rules: {
            nombre: "required",
            password: "required",
            mail: {
              required: true,
              email: true
            }
          }
        });
    </script>

  </body>
</html>