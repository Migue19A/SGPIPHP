<?php
session_start();
include('../../externas/head.php');
include('../../externas/header.php');
include('../../externas/menuGestion.php');
include('../../externas/lateral.php');
// include('../../externas/Clases/consultas.php');
 ?>
	<title>Inicio</title>	 
<?php 
print_r($_SESSION);
	// include('../../externas/reactivacionComite.php');
	include('../../externas/footer.php');
?>