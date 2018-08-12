<?php 
session_start();
include('classConn.php');
/**
 * 
 */
if($_POST){	
	$x = $_POST['botonVer'];
	$miConn=new ClassConn();
	$consulta= "SELECT * from proyecto WHERE folio_proyecto='".$x."';";        
    $result = pg_query($miConn->conexion(), $consulta);	
	echo "Chingon: ".$x;
	return $result;
}

class Consultas
{
	// PreRegistro Docente

	function cboInvestigacion()
	{
        
		$miConn=new ClassConn();
        $consulta= "SELECT * FROM TIPOINVESTIGACION";        
        $result = pg_query($miConn->conexion(), $consulta);
        return $result;
	}

	function cboSector(){		
		$miConn=new ClassConn();
        $consulta= "SELECT * FROM  TIPOSECTOR";        
        $result = pg_query($miConn->conexion(), $consulta);
        return $result;
	}

	function cboLinea(){		
		$miConn=new ClassConn();
        $consulta= "SELECT * FROM  lineainvestigacion";        
        $result = pg_query($miConn->conexion(), $consulta);
        return $result;
	}	

	function consultaFolio(){
		$miConn=new ClassConn();
		$consulta= "SELECT COUNT('folio_proyecto') from proyecto";        
        $result = pg_query($miConn->conexion(), $consulta);
        return $result;
	}

	function cboCarrera(){
		$miConn=new ClassConn();
		$consulta= "SELECT * from carrera";        
        $result = pg_query($miConn->conexion(), $consulta);
        return $result;
	}

	//PreRegistro Gestión

	function todosProyectos(){
		$miConn = new ClassConn();
		$consulta = "SELECT UPPER('NombreProyecto'), 'fechaPresentacion', 'folioProyecto' FROM proyecto;";
		$result = pg_query($miConn->conexion(), $consulta);
		return $result;
	}





}
?>