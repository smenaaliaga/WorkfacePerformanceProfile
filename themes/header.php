<?php
//SE OBTIENE LA CLASE Login DE login.class.php
$singleton = Login::singleton_login();
if(isset($_POST['mail'])){
    $mail = $_POST['mail'];
    $password = $_POST['password'];
	
	//FUNCION DE LA CLASE Login DE login.class.php
	//Encuentra los usuarios existentes desde la bd
    $usuario = $singleton->login_users($mail,$password);
	
	/*ESTA FUNCION REDIRECCIONA A LAS PAGINAS PHP. CONFIG: .htaccess*/
    if($usuario == TRUE){header("Location: dashboard");}
    else{header("Location: loginError");}
}
if (isset($_SESSION['id_User'])){
		header("Location: dashboard");
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
