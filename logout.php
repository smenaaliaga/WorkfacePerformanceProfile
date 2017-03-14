<?php

session_start();
session_regenerate_id();
unset($_SESSION['id_User']);
session_destroy();
header("Location: index.php");

?>