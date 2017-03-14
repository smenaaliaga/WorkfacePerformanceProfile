<?php
error_reporting(E_ALL ^ E_NOTICE);

require_once 'config.php';   

class Conexion
{
    private static $instancia;
    private $dbh;
 
	//CONSTRUCTOR ??
    private function __construct(){
         
        try {
			
            $this->dbh = new PDO('mysql:host='.localhost.';dbname='.wpp, root, "");
			$this->dbh->exec("SET CHARACTER SET utf8");

        } catch (PDOException $e) {

            print "Error!: " . $e->getMessage();

            die();
        }
    }
	
	//UTILIZA: login.class.php (41), sau-fuctions.php
    public function prepare($sql)
    {

        return $this->dbh->prepare($sql);

    }
 
	//UTILIZA: login.class.php
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