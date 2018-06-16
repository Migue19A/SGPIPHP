<?php 
 class ClassConn
 {
 	function conexion()
 	{
	 	$conexion=pg_connect("host='localhost' dbname=SGPI port=5432 user=postgres password=Rivazul19")or
	 	die("Lo sentimos pero no se pudo conectar a nuestra db".pg_last_error());
	 	return $conexion;
 	}
 } 
 ?>