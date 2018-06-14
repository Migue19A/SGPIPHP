<?php 
 $conexion=pg_connect("host='localhost' dbname=prueba port=5432 user=postgres password=Rivazul19")or
 die("Lo sentimos pero no se pudo conectar a nuestra db".pg_last_error());
?>