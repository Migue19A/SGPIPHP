<?php 
 class ClassConn
 {
 	function conexion()
 	{
	 	$conexion=pg_connect("host='localhost' dbname=SISTEMAGESTION port=5432 user=postgres password=4815162342")or
	 	die("Lo sentimos pero no se pudo conectar a nuestra db".pg_last_error());
	 	return $conexion;
 	}
 } 
 ?>