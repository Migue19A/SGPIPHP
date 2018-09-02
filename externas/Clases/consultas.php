<?php 
// session_start();
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
	function obtenerDocentes()
	{
		$miConn = new ClassConn();
		$sql = 'SELECT "NoPersonal","Nombre" ||\' \'||"ApellidoP"||\' \'||"ApellidoM" usuario, "estado" FROM usuario';
		$consulta = pg_query($miConn->conexion(), $sql);
		$json=array();
		$arregloConsulta=array();
		$result=array();
		$i=0;
		while ($fila = pg_fetch_row($consulta)) 
		{ 
			$arregloConsulta[$i]=$fila;
			$i++;
		}
		$i=0;
		foreach ($arregloConsulta as $row) 
		{
			$NoPersonal=$row[0];
			$nombre=$row[1];
			$estado=$row[2];
			$json=array("NoPersonal"=>$NoPersonal, "Nombre"=>$nombre, "estado"=>$estado);
			array_push($result,$json);
			$i++;
		}
		return $result;
	}





}
?>