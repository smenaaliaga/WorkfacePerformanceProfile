<?php

require_once 'admin/includes/config.class.php';

// conexon a base de datos
$conexion = Conexion::singleton_conexion();


$nombre = 'Tu Nombre';
$password = 'Tu Contraseña';
$email = 'tucorreo@mail.com';
$one = '2';

$crypt = sha1(SALT.$nueva.PEPER);
$profile = md5($nombre);

// Sentencia
$SQL = "INSERT INTO users(name,email,password,profile,public,rank) VALUES(:name,:email,:password,:profile,:public,:rank)";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':name',$nombre);
$sentence -> bindParam(':email',$email);
$sentence -> bindParam(':password',$crypt);
$sentence -> bindParam(':profile',$profile);
$sentence -> bindParam(':public',$one);
$sentence -> bindParam(':rank',$one);
$sentence -> execute();


