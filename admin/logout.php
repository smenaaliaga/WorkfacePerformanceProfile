<?php

session_start();
session_regenerate_id();
unset($_SESSION['iduser']);
session_destroy();
header("Location: login");

?>