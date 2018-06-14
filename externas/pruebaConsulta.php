<?php 
	include('conexion.php');
	if($_POST){
		$cam1=$_POST['nombre'];
		$cam2=$_POST['apellido'];		
		echo "tu nombre es: ".$cam1."<br>"; 
    	echo "tu apellido es: ".$cam2."<br>";
		$sql = "INSERT INTO campos (first_field, second_field) VALUES ('".$cam1."', '".$cam2."')";
		return pg_query( $conexion, $sql );
	}
 ?>