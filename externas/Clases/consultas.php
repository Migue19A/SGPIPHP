<?php 
session_start();
include('classConn.php');
/**
 * 
 */
class Consultas extends ClassConn
{
	function cboInvestigacion()
	{        
		$miConn=new ClassConn();
        $consulta= "SELECT * FROM  tipoinvestigacion ORDER BY id_tipo_investigacion";        
        $result = pg_query($miConn->conexion(), $consulta);
        return $result;
	}
}
?>