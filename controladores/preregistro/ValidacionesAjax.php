<?php 
include('../../externas/Clases/classConn.php');
	$accion = $_POST['accion'];

	switch ($accion) {
		case 'validarNombre':
			$miConn=new ClassConn();
			$nombreP_post = $_POST['nombreP'];
			$sql= "SELECT COUNT (nombre_proyecto) FROM proyecto WHERE nombre_proyecto='".$nombreP_post."';";
			$result= pg_query($miConn->conexion(), $sql);
			$result=pg_fetch_array($result);
			//print_r($sql);
			if($result[0]==1){
				$mensajeError="Proyecto existente";
			}
			else{
				$mensajeError="";				
			}
			echo $mensajeError;
			break;
		
		default:
			# code...
			break;
	}
	
?>