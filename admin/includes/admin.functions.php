<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once '../config.php';

// iniciamos session
session_start();

// Nuevamente Clase de Conexion a base de datos, esto solamente es para el admin
class Conexion{
    private static $instancia;
    private $dbh;
 
    private function __construct(){
         
        try {

            $this->dbh = new PDO('mysql:host='.localhost.';dbname='.wpp, root, "");
            $this->dbh->exec("SET CHARACTER SET utf8");

        } catch (PDOException $e) {

            print "Error!: " . $e->getMessage();

            die();
        }
    }

    public function prepare($sql)
    {

        return $this->dbh->prepare($sql);

    }
 
    public static function singleton_conexion()
    {

        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;

        }

        return self::$instancia;
        
    }


     // Evita que el objeto se pueda clonar
    public function __clone()
    {

        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);

    }
}



class Login
{

    private static $instancia;
    private $dbh;
 
    private function __construct()
    {

        $this->dbh = Conexion::singleton_conexion();

    }
 
    public static function singleton_login()
    {

        if (!isset(self::$instancia)) {

            $miclase = __CLASS__;
            self::$instancia = new $miclase;

        }

        return self::$instancia;

    }
  
  public function login_users($email,$password){
    
    try {

      $crypt = sha1(SALT.$password.PEPER);
      
      $sql = "SELECT * FROM usuarios WHERE email = ? AND  password = ? AND nivel = 2";
      $query = $this->dbh->prepare($sql);
      $query->bindParam(1,$email);
      $query->bindParam(2,$crypt);
      $query->execute();
      //$this->dbh = null;

      //si existe el usuario
      if($query->rowCount() == 1)
      {
         
         $fila  = $query->fetch();
         $_SESSION['id_User'] = $fila['id_User'];
         $_SESSION['nombre'] = $fila['nombre'];
         $_SESSION['nivel'] = $fila['nivel'];
		 
				 $sql2 = "SELECT * FROM empresas WHERE empresas.id_Empresa = ?";
				//SE OBTIENE DE config.class.php (26)
				$query2 = $this->dbh->prepare($sql2);
				$query2->bindParam(1,$id_Empresa);
				$query2->execute();
				$this->dbh = null;
				
				if($query2->rowCount() == 1)
				{
					$fila  = $query2->fetch();
					$_SESSION['nombreEmpresa'] = $fila['nombre'];
				}	
		 
         return TRUE;
  
      }else
      return FALSE;
      
    }catch(PDOException $e){
      
      print "Error!: " . $e->getMessage();
      
    }   
    
  }
    

     // Evita que el objeto se pueda clonar
    public function __clone()
    {

        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);

    }

}




function getstyle(){
	
	echo'<link href="../themes/style-color-3.css" rel="stylesheet">';
	
	/*
// conexon a base de datos
$conexion = Conexion::singleton_conexion();

// consulta a base de datos
	$SQL = "SELECT * FROM wpp";
	$sentence = $conexion -> prepare($SQL);
	$sentence -> execute();
	$results = $sentence -> fetchAll();
	if (empty($results)) {
	}else{
		foreach ($results as $key){
			echo'<link href="../themes/style-color-'.$key['style'].'.css" rel="stylesheet">';
		}
		*/
}




function countuser(){
	// conexon a base de datos
    $conexion = Conexion::singleton_conexion();
	$SQL = "SELECT * FROM users";
	$sentence = $conexion -> prepare($SQL);
	$sentence -> execute();
	$cuantos = $sentence -> rowCount();
	echo $cuantos;
}

function countpost(){
	// conexon a base de datos
    $conexion = Conexion::singleton_conexion();
	$SQL = "SELECT * FROM posts";
	$sentence = $conexion -> prepare($SQL);
	$sentence -> execute();
	$cuantos = $sentence -> rowCount();
	echo $cuantos;
}

function countcomments(){
	// conexon a base de datos
    $conexion = Conexion::singleton_conexion();
	$SQL = "SELECT * FROM comments";
	$sentence = $conexion -> prepare($SQL);
	$sentence -> execute();
	$cuantos = $sentence -> rowCount();
	echo $cuantos;
}

function countfollowers(){
	// conexon a base de datos
    $conexion = Conexion::singleton_conexion();
	$SQL = "SELECT * FROM followers";
	$sentence = $conexion -> prepare($SQL);
	$sentence -> execute();
	$cuantos = $sentence -> rowCount();
	echo $cuantos;
}


function lastsix(){
    // conexon a base de datos
    $conexion = Conexion::singleton_conexion();

    // consulta a base de datos
	$SQL = "SELECT * FROM posts,users WHERE posts.userpost = users.iduser ORDER BY posts.idpost DESC LIMIT 8";
	$sentence = $conexion -> prepare($SQL);
	$sentence -> execute();
	$results = $sentence -> fetchAll();
	if (empty($results)) {
	}else{
		foreach ($results as $key){
             
            $fecha = str_replace('-', '/', date("d-m-Y", strtotime($key['datepost'])));

			echo'
              <tr>
                <td>'.$key['name'].'</td>
                <td>'.$fecha.'</td>
                <td><a class="btn btn-warning btn-xs" target="_blank" href="../publication'.$key['permalink'].'"><i class="glyphicon glyphicon-search"></i> Ver Publicación</a></td>
              </tr>
			';
		}
	}	
}


function userslist(){
    // conexon a base de datos
    $conexion = Conexion::singleton_conexion();

    // consulta a base de datos
	$SQL = "SELECT * FROM usuarios";
	$sentence = $conexion -> prepare($SQL);
	$sentence -> execute();
	$results = $sentence -> fetchAll();
	if (empty($results)) {
	}else{
		foreach ($results as $key){
			
			if($key['nivel'] <> 1){
				
				if ($key['nivel'] == 2) {
            	$rango = 'Administrador';
            }
			if ($key['nivel'] == 3) {
            	$rango = 'Usuario';
            }

			echo'
              <tr>
                <td>'.$key['nombre'].'</td>
				<td>'.$key['apellidos'].'</td>
                <td>'.$key['email'].'</td>
                <td>'.$rango.'</td>
                <td>          
                   <form method="POST" action="">
                    <input type="hidden" name="editarusuario" value="'.$key['id_User'].'">
                    <button type="submit" class="btn btn-block btn-xs btn-warning"><i class="glyphicon glyphicon-tasks"></i> Editar</button>
                   </form>

                   <form method="POST" action="">
                    <input type="hidden" name="eliminarusuario" value="'.$key['id_User'].'">
                    <button type="submit" class="btn btn-block btn-xs btn-danger"><i class="glyphicon glyphicon-remove-sign"></i> Eliminar</button>
                   </form>
                </td>
              </tr>
			';
				
			}
		}
	}	
}



function followlist(){
    // conexon a base de datos
    $conexion = Conexion::singleton_conexion();

    // consulta a base de datos
	$SQL = "SELECT * FROM users,followers WHERE followers.user = users.iduser";
	$sentence = $conexion -> prepare($SQL);
	$sentence -> execute();
	$results = $sentence -> fetchAll();
	if (empty($results)) {
	}else{
		foreach ($results as $key){
            
            $fecha = str_replace('-', '/', date("d-m-Y", strtotime($key['datefollow'])));

			echo'
              <tr>
                <td>'.$key['name'].'</td>
                <td>'.checkfollow($key['friend']).'</td>
                <td>'.$fecha.'</td>
                <td>
                  <form method="POST" action="">
                    <input type="hidden" name="follow" value="'.$key['idfollow'].'">
                    <button class="btn btn-danger btn-xs btn-block"><i class="glyphicon glyphicon-remove-sign"></i> Eliminar Registro</button>
                  </form>
                </td>
              </tr>
			';
		}
	}	
}

function checkfollow($user){
    // conexon a base de datos
    $conexion = Conexion::singleton_conexion();

	$SQL = "SELECT * FROM users WHERE iduser = :iduser";
	$sentence = $conexion -> prepare($SQL);
	$sentence -> bindParam(':iduser',$user);
	$sentence -> execute();
	$results = $sentence -> fetchAll();
	foreach ($results as $key){
		
         return $key['name'];

	}
}


function postpost(){
    // conexon a base de datos
    $conexion = Conexion::singleton_conexion();

	$SQL = "SELECT * FROM posts,users WHERE posts.userpost = users.iduser";
	$sentence = $conexion -> prepare($SQL);
	$sentence -> execute();
	$results = $sentence -> fetchAll();
    if (empty($results)){
    }else{
       foreach ($results as $key){

          $fecha = str_replace('-', '/', date("d-m-Y", strtotime($key['datepost'])));

       	  echo'
            <tr>
              <td>'.$key['name'].'</td>
              <td>'.substr($key['post'], 0,50).'..</td>
              <td>'.$fecha.'</td>
              <td>
                 <a target="_blank" href="../publication'.$key['permalink'].'" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Ver Publicación</a>
              </td>
              <td>
                <form method="POST" action="">
                 <input type="hidden" name="post" value="'.$key['idpost'].'" >
                 <button type="submit" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove-sign"></i> Eliminar</button>
                </form>
              </td>
            </tr>
       	  ';
      
       }
    }
}


function borrarpublicacion($post){

// conexon a base de datos
$conexion = Conexion::singleton_conexion();

$SQL = "DELETE FROM posts WHERE idpost = :idpost";
$notfollow = $conexion -> prepare($SQL);
$notfollow -> bindParam(':idpost',$post);
$notfollow -> execute();


$SQL = "DELETE FROM comments WHERE post = :post";
$notfollow = $conexion -> prepare($SQL);
$notfollow -> bindParam(':post',$post);
$notfollow -> execute();


header('Location: '.$_SERVER['HTTP_REFERER'].'');

}


function delfollow($follow){

// conexon a base de datos
$conexion = Conexion::singleton_conexion();

$SQL = "DELETE FROM followers WHERE idfollow = :idfollow";
$notfollow = $conexion -> prepare($SQL);
$notfollow -> bindParam(':idfollow',$follow);
$notfollow -> execute();

header('Location: '.$_SERVER['HTTP_REFERER'].'');

}



function sauconfig(){

  // conexon a base de datos
  $conexion = Conexion::singleton_conexion();

  $SQL = "SELECT * FROM sau WHERE sau = 1";
  $sentence = $conexion -> prepare($SQL);
  $sentence -> execute();
  $results = $sentence -> fetchAll();
  if (empty($results)) {
    # code...
  }else{
    foreach ($results as $key){

        // mantenimiento
        if ($key['maintenance'] == 1){
          $mantenimiento = '
                      <option value="1">NO</option>
                      <option value="2">SI</option>
          ';
        }else{
          $mantenimiento = '
                      <option value="2">SI</option>
                      <option value="1">NO</option>
          ';
        }

        // sau styles
        if ($key['style'] == 1){
          $style = '
                      <option value="1">Black SAU</option>
                      <option value="2">Mix Blue</option>
                      <option value="3">Azure</option>
          ';
        }elseif ($key['style'] == 2) {
          $style = '
                      <option value="2">Mix Blue</option>
                      <option value="3">Azure</option>
                      <option value="1">Black SAU</option>
          ';
        }else{
          $style = '
                      <option value="3">Azure</option>
                      <option value="1">Black SAU</option>
                      <option value="2">Mix Blue</option>
          ';
        }


        echo'

                  <label>Sistema en Mantenimiento</label>
                  <select class="form-control" name="mantenimiento">
                      '.$mantenimiento.'
                  </select>

                  <label>Mensaje de Mantenimiento</label>
                  <textarea class="form-control" name="mensaje" rows="4">'.$key['message_maintenance'].'</textarea>

                  <label>Estilo del Sistema</label>
                  <select class="form-control" name="estilo">
                      '.$style.'
                  </select> 

        ';
    }
  }

}



function updasau($mantenimiento,$mensaje,$style){

// conexon a base de datos
$conexion = Conexion::singleton_conexion();


$SQL = "UPDATE sau SET maintenance = :maintenance, message_maintenance = :message_maintenance, style = :style WHERE sau = 1";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':maintenance',$mantenimiento);
$sentence -> bindParam(':message_maintenance',$mensaje);
$sentence -> bindParam(':style',$style);
$sentence -> execute();

header('Location: '.$_SERVER['HTTP_REFERER'].'');

}


function editarusuario($user){
  // conexon a base de datos
  $conexion = Conexion::singleton_conexion();

  // consulta a base de datos
  $SQL = "SELECT * FROM users WHERE iduser = :iduser";
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':iduser',$user);
  $sentence -> execute();
  $results = $sentence -> fetchAll();
  if (empty($results)) {
  }else{
    foreach ($results as $key){

        if ($key['public'] == 1) {
          $publico = '<option value="1">SI</option><option value="2">NO</option>';
        }else{
          $publico = '<option value="2">NO</option><option value="1">SI</option>';
        }

        if ($key['rank'] == 1) {
          $rango = '
              <option value="1">Usuario</option>
              <option value="2">Administrador</option>
          ';
        }else{
          $rango = '
              <option value="2">Administrador</option>
              <option value="1">Usuario</option>
          ';
        }

      echo'

            <!-- configuracion -->
            <div class="col-sm-6 paddingone">
              <div class="well configuracion-cube">
                <h4><i class="fa fa-files-o"></i> Mis Datos</h4>
                <form id="misdatos" method="POST" action="">
                  <label>Nombre:</label>
                  <input class="form-control" type="text" name="nombre" value="'.$key['name'].'" >
                  <label>Correo Electronico:</label>
                  <input class="form-control" type="text" name="email" value="'.$key['email'].'" >
                  <label>Perfil Publico:</label>
                  <select class="form-control" name="public">
                      '.$publico.'
                  </select>
                  <label>Rango:</label>
                  <select class="form-control" name="rango">
                      '.$rango.'
                  </select>
                  <input type="hidden" name="userid" value="'.$user.'" >
                  <p></p>
                  <button class="btn btn-success pull-right"><i class="glyphicon glyphicon-floppy-saved"></i> Guardar Datos</button>                
                </form>
              </div>
            </div>

            <div class="col-sm-6 paddingone">
              <div class="well configuracion-cube">
                <h4><i class="fa fa-lock"></i> Cambiar Contraseña</h4>
                <form id="mipassword" method="POST" action="">
                  <label>Nueva Contraseña:</label>
                  <input id="nuevapassword" class="form-control" type="password" name="nueva" >
                  <label>Repetir Nueva Contraseña:</label>
                  <input class="form-control" type="password" name="nueva2" >
                  <input type="hidden" name="userid" value="'.$user.'" >
                  <p></p>
                  <button class="btn btn-warning pull-right"><i class="glyphicon glyphicon-floppy-saved"></i> Cambiar Contraseña</button>                                                       
                </form>
              </div>
            </div>
          <!-- configuracion -->


      ';
    }
  }
}



function eliminarusuario($user){

// conexon a base de datos
$conexion = Conexion::singleton_conexion();


// Eliminamos el usuario
$SQL = "DELETE FROM users WHERE iduser = :iduser";
$notfollow = $conexion -> prepare($SQL);
$notfollow -> bindParam(':iduser',$user);
$notfollow -> execute();


// Publicaciones
$SQL = "DELETE FROM posts WHERE userpost = :userpost";
$notfollow = $conexion -> prepare($SQL);
$notfollow -> bindParam(':userpost',$user);
$notfollow -> execute();


// Comentarios
$SQL = "DELETE FROM comments WHERE user = :user";
$notfollow = $conexion -> prepare($SQL);
$notfollow -> bindParam(':user',$user);
$notfollow -> execute();



header('Location: '.$_SERVER['HTTP_REFERER'].'');

}


function cambiardatos($nombre,$email,$public,$rango,$usuario){
// conexon a base de datos
$conexion = Conexion::singleton_conexion();

// cambiamos el permalink del usuario ya que el mismo no es permanente
// lo hago en MD5 solamente por la facilidad del hash y como no tiene
// una importancia tan grande como las contraseñas, no pasa la gran cosa.
$newprofile = md5($nombre);

// consulta a base de datos
$SQL = "UPDATE users SET name = :name, email = :email, public = :public, profile = :profile, rank = :rank WHERE iduser = :iduser";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':name', $nombre);
$sentence -> bindParam(':email', $email);
$sentence -> bindParam(':public', $public);
$sentence -> bindParam(':profile', $newprofile);
$sentence -> bindParam(':rank', $rango);
$sentence -> bindParam(':iduser', $usuario);
$sentence -> execute();

echo'
  <!-- alertas -->
  <div class="col-md-12">
  <div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
   <strong><i class="fa fa-check"></i> Correcto! </strong> Los datos del usuario han sido actualizados correctamente. </div>            
  </div>
  <!-- alertas -->
';

  
}




function cambiarpassword($nueva,$usuario){
// conexon a base de datos
$conexion = Conexion::singleton_conexion();

// has de la password actual
$crypt = sha1(SALT.$actual.PEPER);

//------------------------------------------------------------------------------------

$nuevapassword = sha1(SALT.$nueva.PEPER);

$updapass = "UPDATE users SET password = :password WHERE iduser = :iduser";
$updasentence = $conexion -> prepare($updapass);
$updasentence -> bindParam(':password',$nuevapassword);
$updasentence -> bindParam(':iduser',$usuario);
$updasentence -> execute();

echo'
  <!-- alertas -->
  <div class="col-md-12">
  <div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
   <strong><i class="fa fa-check"></i> Correcto! </strong> Tu contraseña ha sido actualizada correctamente, tendrás que usarla para poder iniciar sesión en el sistema. </div>            
  </div>
  <!-- alertas -->
';

//------------------------------------------------------------------------------------
 
}


function newusuario($password,$nombre,$apellidos,$email,$nivel){

// conexon a base de datos
$conexion = Conexion::singleton_conexion();

// contraseña
$nuevapassword = sha1(SALT.$nueva.PEPER);


$SQL = "INSERT INTO usuarios(password,nombre,apellidos,email,nivel,id_Empresa) VALUES(:password,:nombre,:apellidos,:email,:nivel,:id_Empresa)";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':password',$nuevapassword);
$sentence -> bindParam(':nombre',$nombre);
$sentence -> bindParam(':apellidos',$apellidos);
$sentence -> bindParam(':email',$email);
$sentence -> bindParam(':nivel',$nivel);
$sentence -> bindParam(':id_Empresa','2');
$sentence -> execute();

header('Location: '.$_SERVER['HTTP_REFERER'].'');

}

//COMIENZAN LAS FUNCONES PARA PERFILES

function nuevoPerfil($nombre,$apellidoPaterno,$apellidoMaterno,$rut,$fechaNacimiento,$activo){

// conexon a base de datos
$conexion = Conexion::singleton_conexion();

// perfil
$perfil = md5($nombre);

$id_Empresa = id_Empresa;

$SQL = "INSERT INTO perfiles(nombre,apellidoPaterno,apellidoMaterno,rut,fechaNacimiento,perfil,activo,id_Empresa) 
		VALUES(:nombre,:apellidoPaterno,:apellidoMaterno,:rut,:fechaNacimiento,:perfil,:activo,:id_Empresa)";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':nombre',$nombre);
$sentence -> bindParam(':apellidoPaterno',$apellidoPaterno);
$sentence -> bindParam(':apellidoMaterno',$apellidoMaterno);
$sentence -> bindParam(':rut',$rut);
$sentence -> bindParam(':fechaNacimiento',$fechaNacimiento);
$sentence -> bindParam(':perfil', $perfil);
$sentence -> bindParam(':activo', $activo);
$sentence -> bindParam(':id_Empresa', $id_Empresa);
$sentence -> execute();

header('Location: '.$_SERVER['HTTP_REFERER'].'');

}

//FINALIZA FUNCIONES PARA PERFILES 