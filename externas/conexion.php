<?php 
 $conexion=pg_connect("host='localhost' dbname=SGPI port=5432 user=postgres password=4815162342")or
 die("Lo sentimos pero no se pudo conectar a nuestra db".pg_last_error());
?>