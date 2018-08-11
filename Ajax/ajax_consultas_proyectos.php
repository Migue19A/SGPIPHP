<?php 
	session_start();
	include('../externas/Clases/classConn.php');
	$accion = $_POST['accion'];

	switch ($accion) {
		case 'consultarProyecto':
			$folio = $_POST['botonVer'];
			$miConn = new ClassConn();
			$consulta = "SELECT * FROM proyecto WHERE folio_proyecto='".$folio."';";
			$result = pg_query($miConn->conexion(), $consulta);
			echo json_encode($result);
		break;
		
		default:
			# code...
			break;
	}
 ?>