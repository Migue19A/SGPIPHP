<?php 
include('../../externas/Clases/classConn.php');
	$accion = $_POST['accion'];

	switch ($accion) {
		case 'validarNombre':
			$miConn=new ClassConn();
			$nombreP_post = $_POST['nombreP'];
			$sql= "SELECT COUNT(upper(nombre_proyecto)) FROM proyecto WHERE nombre_proyecto=upper('".$nombreP_post."');";
			$result= pg_query($miConn->conexion(), $sql);
			$result=pg_fetch_array($result);
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