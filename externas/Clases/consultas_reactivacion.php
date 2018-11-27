<?php 
// session_start();
// include('classConn.php');
/**
 * 
 */

class ConsultasReact extends ClassConn
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
		$consulta = "SELECT UPPER(\"NombreProyecto\"), \"FechaPresentacion\", \"FolioProyecto\" FROM proyecto"; //INNER JOIN entregable ON \"Etapas_FolioProyecto\" = \"FolioProyecto\";";
		$result = pg_query($miConn->conexion(), $consulta);
		return $result;
	}

	function todosProyectosGIC(){
		$miConn = new ClassConn();
		$consulta = "SELECT UPPER(\"NombreProyecto\"), \"FechaPresentacion\", \"FolioProyecto\", \"etapa_solicitada\", \"fecha_solicitud\" FROM proyecto INNER JOIN prorroga  ON \"FolioProyecto\"= \"Proyecto_FolioProyecto\""; //INNER JOIN entregable ON \"Etapas_FolioProyecto\" = \"FolioProyecto\";";
		$result = pg_query($miConn->conexion(), $consulta);
		return $result;
	}

	/*function misproyectos(){
		//$docente = $SESSION['no_control'];
		$miConn = new ClassConn();
		$consulta = "SELECT UPPER(\"NombreProyecto\"), \"FechaPresentacion\", \"FolioProyecto\" FROM proyecto;";
		$result = pg_query($miConn->conexion(), $consulta);
		return $result;
	}*/


	function obtenerDocentes()
	{
		$miConn = new ClassConn();
		$sql = 'SELECT "NoPersonal", upper("Nombre") ||\' \'||upper("ApellidoP")||\' \'||upper("ApellidoM") usuario, "estado", upper("Descripcion") academia, "CorreoInstitucional", "GradoMaximoEstudios", "TelefonoMovil"  FROM usuario INNER JOIN docente ON docente."noPersonal" = usuario."NoPersonal" INNER JOIN carrera ON "Carrera_idCarrera" = "idCarrera" WHERE estado= 1';
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
			$academia = $row[3];
			$correoI = $row[4];
			$gradMaxEst = $row[5];
			$movil = $row[6];
			$json=array("NoPersonal"=>$NoPersonal, "Nombre"=>$nombre, "estado"=>$estado, "academia"=>$academia, "correo_inst"=>$correoI, "maxEstudios"=>$gradMaxEst, "celular"=>$movil);
			array_push($result,$json);
			$i++;
		}
		return $result;
	}	

	function consultarEstadoProyecto($folio){
		$miConn = new ClassConn();
		$sqlEstado = "SELECT \"Descripcion\" estado FROM \"proyecto\" INNER JOIN \"cat_estadoproyecto\" ON proyecto.\"idEstado\" = cat_estadoproyecto.\"idEstado\" WHERE \"FolioProyecto\"='".$folio."';";
		$qry= pg_query($miConn->conexion(), $sqlEstado);
		$result = pg_fetch_array($qry);	
		$estado = $result[0];	
		return $estado;
	}

	function consultarObservacionesGestion($folio_p){
		$miConn = new ClassConn();
		$sqlObsG = "SELECT \"ObservacionesGestion\" FROM \"observaciones\" WHERE \"Proyecto_FolioProyecto\" = '".$folio_p."';";
		$qry= pg_query($miConn->conexion(), $sqlObsG);
		return $qry;
	}
	function getProyectosDocente($docente)
	{
		$miConn=new ClassConn();
		$sql='SELECT proy."FolioProyecto","NombreProyecto","Inicio","idEstado",(SELECT COUNT(et."FolioProyecto") FROM etapas et WHERE "FolioProyecto"=proy."FolioProyecto") 
			FROM PROYECTO proy
			WHERE proy."Responsable"='.$docente;
		$consulta= pg_query($miConn->conexion(), $sql);
		$json=array();
		$arregloConsulta=array();
		$result=array();
		$i=0;
		while ($fila = pg_fetch_row($consulta)) 
		{ 
			$arregloConsulta[$i]=$fila;
			$i++;
		}
		foreach ($arregloConsulta as $row) 
		{
			$Folio=$row[0];
			$Nombre=$row[1];
			$FechaInicio=$row[2];
			$Estado=$row[3];
			$Etapas=$row[4];
			$json=array("Folio"=>$Folio, "Nombre"=>$Nombre, "FechaInicio"=>$FechaInicio, "Estado"=>$Estado, "Etapas"=>$Etapas);
			array_push($result,$json);
		}

		return $result;
	}
	function getProyectosXEstado($estado)
	{
		$miConn=new ClassConn();
		print_r($_SESSION);
		$sql='SELECT proy."FolioProyecto","NombreProyecto","Inicio","idEstado",(SELECT COUNT(et."FolioProyecto") FROM etapas et WHERE "FolioProyecto"=proy."FolioProyecto"), USU."Nombre"||\' \'||usu."ApellidoP"||\' \'||usu."ApellidoM" Nombre, car."Descripcion" Carrera
			FROM PROYECTO proy
			INNER JOIN USUARIO USU ON USU."NoPersonal"=proy."Responsable"
			INNER JOIN CARRERA CAR ON CAR."idCarrera"=proy."idCarrera"
			WHERE PROY."pendienteRevisar"='.$_SESSION['Tipo'].'
			AND proy."idEstado"='.$estado;
		// echo $sql;
		$consulta= pg_query($miConn->conexion(), $sql);
		$json=array();
		$arregloConsulta=array();
		$result=array();
		$i=0;
		while ($fila = pg_fetch_row($consulta)) 
		{ 
			$arregloConsulta[$i]=$fila;
			$i++;
		}
		foreach ($arregloConsulta as $row) 
		{
			$Folio=$row[0];
			$Nombre=$row[1];
			$FechaInicio=$row[2];
			$Estado=$row[3];
			$Etapas=$row[4];
			$NombreDoc=$row[5];
			$Carrera=$row[6];
			$json=array("Folio"=>$Folio, "Nombre"=>$Nombre, "FechaInicio"=>$FechaInicio, "Estado"=>$Estado, "Etapas"=>$Etapas,"NombreDoc"=>$NombreDoc,"Carrera"=>$Carrera);
			array_push($result,$json);
		}
		return $result;
	}
	function consultaSolReact($folio)
	{
		$miConn=new ClassConn();
		$sql='SELECT proy."FolioProyecto","NombreProyecto","Inicio","idEstado",(SELECT COUNT(et."FolioProyecto") FROM etapas et WHERE "FolioProyecto"=proy."FolioProyecto"), USU."Nombre"||\' \'||usu."ApellidoP"||\' \'||usu."ApellidoM" Nombre, car."Descripcion" Carrera
			FROM PROYECTO proy
			INNER JOIN USUARIO USU ON USU."NoPersonal"=proy."Responsable"
			INNER JOIN CARRERA CAR ON CAR."idCarrera"=proy."idCarrera"
			WHERE proy."idEstado"='.$estado;
		$consulta= pg_query($miConn->conexion(), $sql);
		$json=array();
		$arregloConsulta=array();
		$result=array();
		$i=0;
		while ($fila = pg_fetch_row($consulta)) 
		{ 
			$arregloConsulta[$i]=$fila;
			$i++;
		}
		foreach ($arregloConsulta as $row) 
		{
			$Folio=$row[0];
			$Nombre=$row[1];
			$FechaInicio=$row[2];
			$Estado=$row[3];
			$Etapas=$row[4];
			$NombreDoc=$row[5];
			$Carrera=$row[6];
			$json=array("Folio"=>$Folio, "Nombre"=>$Nombre, "FechaInicio"=>$FechaInicio, "Estado"=>$Estado, "Etapas"=>$Etapas,"NombreDoc"=>$NombreDoc,"Carrera"=>$Carrera);
			array_push($result,$json);
		}
		return $result;
	}
}

?>