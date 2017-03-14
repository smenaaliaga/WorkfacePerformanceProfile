<?php

require_once 'config.class.php';
session_start();
class Login
{

    private static $instancia;
    private $dbh;
 
	//CONSTRUCTOR ??
    private function __construct()
    {
		//SE OBTIENE LA CLASE Conexion DE config.class
        $this->dbh = Conexion::singleton_conexion();

    }
 
	//UTILIZA: header.php
    public static function singleton_login()
    {

        if (!isset(self::$instancia)) {

            $miclase = __CLASS__;
            self::$instancia = new $miclase;

        }

        return self::$instancia;

    }
	
	//UTILIZA: header.php
	public function login_users($mail,$password){
		
		try {

			$crypt = sha1(SALT.$password.PEPER);
			$sql = "SELECT * FROM usuarios WHERE email = ? AND  password = ?";
			//SE OBTIENE DE config.class.php (26)
			$query = $this->dbh->prepare($sql);
			$query->bindParam(1,$mail);
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
				 $_SESSION['id_Empresa'] = $id_Empresa = $fila['id_Empresa'];
				 
				 
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