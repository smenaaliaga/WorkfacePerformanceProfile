<?php
require_once 'includes/superadmin.functions.php';

$singleton = Login::singleton_login();
if(isset($_POST['mail'])){
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $usuario = $singleton->login_users($mail,$password);
    if($usuario == TRUE){header("Location: index");}
    if($usuario == FALSE){header("Location: ../index.php?error");}
}
if (isset($_SESSION['id_User'])){header("Location: index");}
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
    <link href="../themes/style.css" rel="stylesheet">
    <?php getstyle(); ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>


<div id="login" class="text-center">
    
    <img src="../themes/wpp-logo-white.png">
	
	<div class="well">
      
           <form id="form-login" method="POST" action="">
             <label>Email:</label>
             <input class="form-control" type="text" name="mail">
             <label>Contraseña:</label>
             <input class="form-control" type="password" name="password"><p></p>
             <button type="submit" class="btn btn-default pull-right"><i class="fa fa-power-off"></i> Iniciar sesión</button>        
           </form>
         	</div>
	
</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../themes/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../themes/js/bootstrap.min.js"></script>
    <!-- efectos SAU 2 -->
    <script src="../themes/js/effects.js"></script>
  </body>
</html>