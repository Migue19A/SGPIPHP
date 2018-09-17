<?php 
// session_start();
include('classConn.php');
/**
 * 
 */

class Consultas
{
	// PreRegistro Docente

	function getProyectos()
	{
		$miConn=new ClassConn();
		$sql='select proy."FolioProyecto",proy."FechaPresentacion",proy."NoRevision",usu."Nombre"||\' \'||usu."ApellidoP"||\' \'||usu."ApellidoM" Nombre, proy."NombreProyecto" Proyecto
			from proyecto proy
			inner join "docente" docente on docente."noPersonal"=proy."Responsable"
			inner join usuario usu on usu."NoPersonal"=docente."noPersonal"';
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
		$i=1;
		foreach ($arregloConsulta as $row) 
		{
			$Numero=$i;
			$FolioProyecto=$row[0];
			$FechaPresentacion=$row[1];
			$NoRevision=$row[2];
			$Nombre=$row[3];
			$Proyecto=$row[4];
			$json=array("Numero"=>$Numero, "FolioProyecto"=>$FolioProyecto, "FechaPresentacion"=>$FechaPresentacion,"NoRevision"=>$NoRevision,"Nombre"=>$Nombre,"Proyecto"=>$Proyecto);
			array_push($result,$json);
			$i++;
		}
		return $result;

	}
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
		$consulta = "SELECT UPPER(\"NombreProyecto\"), \"FechaPresentacion\", \"FolioProyecto\" FROM proyecto;";
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