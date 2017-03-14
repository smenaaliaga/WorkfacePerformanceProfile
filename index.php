<?php 
// incluimos las funciones
require_once 'includes/functions.php';
// incluimos la cabecera
include 'themes/header.php'; 
?>

<div id="login" class="text-center">
    
    <img src="themes/wpp-logo-white.png">
	
	<div class="well">
      <?php saustatus(); ?>
	</div>
	<?php
      if (isset($_GET['error'])) {
      	geterror();
      }
    ?>

</div>

<?php include 'themes/footer.php'; ?>