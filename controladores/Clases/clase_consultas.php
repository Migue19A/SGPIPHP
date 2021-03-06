<?php /**
 * 
 */
class ClaseConsultas extends ClassConn
{
	
	function getEtapa($entregable)
	{
		$sql='SELECT et."noEtapa" FROM entregable
			INNER JOIN "etapas" et on et."PkEtapas"="Etapas_noEtapa"
			WHERE "idEntregable"='.$entregable;
		$consulta = pg_query($this->conexion(), $sql);
		$resultado = pg_fetch_row($consulta);
		$result=$resultado[0];
		return $result;
	}
	function consultaDocentes()
	{
		$sql='SELECT "Nombre"||\' \'||"ApellidoP"||\' \'||"ApellidoM" as Nombre,"NoPersonal" as NoPersonal  
			FROM "usuario" 
			WHERE "estado"=1 ';
		$consulta = pg_query($this->conexion(), $sql);
		$json=array();
		$arregloConsulta=array();
		$docentes=array();
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
			$Nombre=$row[0];
			$NoPersonal=$row[1];
			$json=array("Numero"=>$Numero,"Nombre"=>$Nombre,"NoPersonal"=>$NoPersonal);
			array_push($docentes,$json);
			$i++;
		}
		return $docentes;
	}

	function obtenerDocentesPre($num_control)
	{
		$sql = 'SELECT "NoPersonal", upper("Nombre"), upper("ApellidoP"), upper("ApellidoM"), "estado", "idCarrera" academia, "CorreoInstitucional", "GradoMaximoEstudios", "TelefonoMovil"  FROM usuario INNER JOIN docente ON docente."noPersonal" = usuario."NoPersonal" INNER JOIN carrera ON "Carrera_idCarrera" = "idCarrera" WHERE "estado"= 1 and "noPersonal" ='.$num_control.';';
		$consulta = pg_query($this->conexion(), $sql);
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
			$paterno = $row[2];
			$materno = $row[3];
			$estado=$row[4];
			$academia = $row[5];
			$correoI = $row[6];
			$gradMaxEst = $row[7];
			$movil = $row[8];
			$json=array("NoPersonal"=>$NoPersonal, "Nombre"=>$nombre, "paterno"=>$paterno, "materno"=>$materno,  "estado"=>$estado, "academia"=>$academia, "correo_inst"=>$correoI, "maxEstudios"=>$gradMaxEst, "celular"=>$movil);
			array_push($result,$json);
			$i++;
		}
		return $result;
	}

	function obtenerProyectosDocente($responsable){
		$sql = "SELECT \"FolioProyecto\", upper(\"NombreProyecto\") FROM proyecto INNER JOIN docente ON \"Responsable\" = \"noPersonal\" WHERE \"Responsable\"= ".$responsable.";";		
		$result = pg_query($this->conexion(), $sql);
        return $result;
	}

	function obtenerColaboradoresCam($folio){
		$sql = "SELECT doc.\"ap_paterno\" paterno_colaborador, doc.\"ap_materno\" materno_colaborador, doc.\"nombre\" nombre_colaborador, doc.\"Docente_noPersonal\" personal_colaborador, doc.\"celular\" celular_colaborador, doc.\"correo_institucional\" correo_colaborador, usu.\"estado\" estado_colaborador, entre.\"Etapas_noEtapa\" etapa_actual FROM proyecto proy INNER JOIN docente doce ON proy.\"Responsable\" = doce.\"noPersonal\" INNER JOIN colaboradordocente doc ON proy.\"FolioProyecto\" = doc.\"Proyecto_FolioProyecto\" INNER JOIN usuario usu ON doc.\"Docente_noPersonal\" = usu.\"NoPersonal\" INNER JOIN entregable entre ON proy.\"FolioProyecto\" = entre.\"Etapas_FolioProyecto\" WHERE proy.\"FolioProyecto\"= '".$folio."' and entre.\"Estatus\" = 1;";		
		$result = pg_query($this->conexion(), $sql);
        return $result;
	} 

	function obtenerAlumnosCam($folio){
		$sql = "SELECT alum.\"NoControl\" control_alum, alum.\"Paterno\" pat_alum, alum.\"Materno\" mat_alum, alum.\"Nombre\" nombre_alum, entre.\"Etapas_noEtapa\" etapa_actual FROM proyecto proy INNER JOIN docente doce ON proy.\"Responsable\" = doce.\"noPersonal\" INNER JOIN alumno alum ON proy.\"FolioProyecto\" = alum.\"Folio_proyecto\" INNER JOIN entregable entre ON proy.\"FolioProyecto\" = entre.\"Etapas_FolioProyecto\" WHERE proy.\"FolioProyecto\"= '".$folio."' and entre.\"Estatus\" = 1 ;";		
		$result = pg_query($this->conexion(), $sql);
        return $result;
	}


	function getAlumnosCol($proyecto)
	{
		$sql='select "FkNoControl" as NoControl,"Nombre"||\' \'||"Paterno"||\' \'||"Materno" as Nombre, 
			case when "servicio"=true then 1 when "residencia"=true then 2 when "tesis"=true then 3 end categoria, case when "servicio"=true then \'Servicio Social\' when "residencia"=true then \'Residencia Profesional\' when "tesis"=true then \'Tesis\' end categoriaDesc
			from alumnoscolaboradoresdetalle aldet
			inner join alumno al on aldet."FkNoControl"=al."NoControl"
			where "folioproyecto"=\''.$proyecto.'\';';
		$consulta = pg_query($this->conexion(), $sql);
		$json=array();
		$arregloConsulta=array();
		$alumnosCol=array();
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
			$Nombre=$row[1];
			$NoControl=$row[0];
			$Categoria=$row[2];
			$CategoriaDesc=$row[3];
			$json=array("Numero"=>$Numero,"NoControl"=>$NoControl,"Nombre"=>$Nombre,"Categoria"=>$Categoria,"CategoriaDesc"=>$CategoriaDesc);
			array_push($alumnosCol,$json);
			$i++;
		}
		return $alumnosCol;
	}
	function getEntregable($entregable)
	{
		$sql='SELECT entr."idEntregable",entr."FechaEntrega",entr."Etapas_FolioProyecto",entr."Etapas_noEtapa",
			proy."NombreProyecto",proy."Inicio",proy."Fin",usu."Nombre"||\' \'||usu."ApellidoP"||\' \'||usu."ApellidoM",
			res."Resultados",resum."Resumen",entr."Observaciones"
		FROM entregable entr
		INNER JOIN proyecto proy on proy."FolioProyecto"=entr."Etapas_FolioProyecto"
		INNER JOIN usuario usu on usu."NoPersonal"=proy."Responsable"
		INNER JOIN resultados res on res."Entregable_idEntregable"=entr."idEntregable"
		INNER JOIN resumenejecutivo resum on resum."Entregable_idEntregable"=entr."idEntregable"';
		$consulta = pg_query($this->conexion(), $sql);
		$resultado=array();
		$i=1;
		$fila = pg_fetch_row($consulta);
		$Numero=$i;
		$Entregable=$fila[0];
		$FechaEntrega=$fila[1];
		$Etapa=$fila[2];
		$NoEtapa=$fila[3];
		$NombreProyecto=$fila[4];
		$FechaInicio=$fila[5];
		$FechaFin=$fila[6];
		$NombreResp=$fila[7];
		$Resultados=$fila[8];
		$Resumen=$fila[9];
		$Observaciones=$fila[10];
		$resultado=array("Numero"=>$Numero, "Entregable"=>$Entregable, "FechaEntrega"=>$FechaEntrega,"Etapa"=>$Etapa,"NoEtapa"=>$NoEtapa,"NombreProyecto"=>$NombreProyecto,"FechaInicio"=>$FechaInicio,"FechaFin"=>$FechaFin,"NombreResp"=>$NombreResp,"Resultados"=>$Resultados,"Resumen"=>$Resumen,"Observaciones"=>$Observaciones);
		return $resultado;
	}
	function getActividades($entregable)
	{
		$sql='SELECT "NoActividad","DescripcionActividades","Alcance","Observaciones"
		FROM actividadesproyecto WHERE "Entregable_idEntregable"=\''.$entregable.'\'';
		$consulta = pg_query($this->conexion(), $sql);
		$json=array();
		$arregloConsulta=array();
		$resultado=array();
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
			$NoActividad=$row[0];
			$Descripcion=$row[1];
			$Alcance=$row[2];
			$Observaciones=$row[3];
			$json=array("Numero"=>$Numero, "NoActividad"=>$NoActividad, "Descripcion"=>$Descripcion,"Alcance"=>$Alcance,"Observaciones"=>$Observaciones);
			array_push($resultado,$json);
			$i++;
		}
		return $resultado;
	}
	function objAlcanzados($entregable)
	{
		$sql='SELECT "NoObjetivos","DescripcionActividades","Alcance","Observaciones"
		FROM objetivosalcanzados WHERE "Entregable_idEntregable"=\''.$entregable.'\'';
		$consulta = pg_query($this->conexion(), $sql);
		$json=array();
		$arregloConsulta=array();
		$resultado=array();
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
			$NoObjetivo=$row[0];
			$Descripcion=$row[1];
			$Alcance=$row[2];
			$Observaciones=$row[3];
			$json=array("Numero"=>$Numero, "NoObjetivo"=>$NoObjetivo, "Descripcion"=>$Descripcion,"Alcance"=>$Alcance,"Observaciones"=>$Observaciones);
			array_push($resultado,$json);
			$i++;
		}
		return $resultado;
	}
	function metasAlcanzadas($entregable)
	{
		$sql='SELECT "NoMetas","DescripcionActividades","Alcance","Observaciones"
		FROM metasalcanzadas WHERE "Entregable_idEntregable"=\''.$entregable.'\'';
		$consulta = pg_query($this->conexion(), $sql);
		$json=array();
		$arregloConsulta=array();
		$resultado=array();
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
			$NoMetas=$row[0];
			$Descripcion=$row[1];
			$Alcance=$row[2];
			$Observaciones=$row[3];
			$json=array("Numero"=>$Numero, "NoMetas"=>$NoMetas, "Descripcion"=>$Descripcion,"Alcance"=>$Alcance,"Observaciones"=>$Observaciones);
			array_push($resultado,$json);
			$i++;
		}
		return $resultado;
	}
	function getLogrosRH($entregable)
	{
		$sql='SELECT "NombreTrabajo","Categoria","FkNoControl",al."Nombre"||\' \'||al."Paterno"||\' \'||al."Materno"
		FROM "logrosrecursoshumanos" log
		INNER JOIN alumno al on al."NoControl"=log."FkNoControl"
		WHERE log."Entregable_idEntregable"='.$entregable;
		$consulta = pg_query($this->conexion(), $sql);
		$json=array();
		$arregloConsulta=array();
		$resultado=array();
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
			$NombreTrabajo=$row[0];
			$Categoria=$row[1];
			$NoControl=$row[2];
			$NombreAl=$row[3];
			$json=array("Numero"=>$Numero, "NombreTrabajo"=>$NombreTrabajo, "Categoria"=>$Categoria,"NoControl"=>$NoControl,"NombreAl"=>$NombreAl);
			array_push($resultado,$json);
			$i++;
		}
		return $resultado;
	}
	function getLogrosDivulgacion($entregable)
	{
		$sql='SELECT "TipoPublicacion","NombrePublicacion","Lugar","Fecha","TituloDelArticulo" 
			FROM logrosdivulgacionpublicaciones
			WHERE "Entregable_idEntregable"='.$entregable;
		$consulta = pg_query($this->conexion(), $sql);
		$json=array();
		$arregloConsulta=array();
		$resultado=array();
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
			$TipoPublicacion=$row[0];
			$NombrePublicacion=$row[1];
			$Lugar=$row[2];
			$Fecha=$row[3];
			$TituloDelArticulo=$row[4];
			$json=array("Numero"=>$Numero, "TipoPublicacion"=>$TipoPublicacion, "NombrePublicacion"=>$NombrePublicacion,"Lugar"=>$Lugar,"Fecha"=>$Fecha,"TituloDelArticulo"=>$TituloDelArticulo);
			array_push($resultado,$json);
			$i++;
		}
		return $resultado;
	}
	function getLogrosPresentacion($entregable)
	{
		$sql='SELECT "TipoDePonencia","NombreEvento","Lugar","Fecha","TituloPonencia" 
			FROM logrospresentacioneseventos
			WHERE "Entregable_idEntregable"='.$entregable;
		$consulta = pg_query($this->conexion(), $sql);
		$json=array();
		$arregloConsulta=array();
		$resultado=array();
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
			$TipoPonencia=$row[0];
			$NombreEvento=$row[1];
			$Lugar=$row[2];
			$Fecha=$row[3];
			$TituloPonencia=$row[4];
			$json=array("Numero"=>$Numero, "TipoPonencia"=>$TipoPonencia, "NombreEvento"=>$NombreEvento,"Lugar"=>$Lugar,"Fecha"=>$Fecha,"TituloPonencia"=>$TituloPonencia);
			array_push($resultado,$json);
			$i++;
		}
		return $resultado;
	}
	function consultaTodosDocentes()
	{
		$sql='SELECT USU."NoPersonal"||\' - \'||USU."Nombre"||\' \'||USU."ApellidoP"||\' \'||USU."ApellidoP" Nombre, USU."NoPersonal" NoPersonal
			FROM  USUARIO USU';
		$consulta=pg_query($this->conexion(), $sql);
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
			$Nombre=$row[0];
			$NoPersonal=$row[1];
			$json=array("Nombre"=>$Nombre, "NoPersonal"=>$NoPersonal);
			array_push($result,$json);
		}
		return $result;
	}
	function consultaDatosDocente($docente)
	{
		$sql='SELECT USU."Nombre" Nombre,USU."ApellidoP" ApellidoP, USU."ApellidoP" ApellidoM, 
			USU."NoPersonal" NoPersonal, CAR."Descripcion" Carrera, DOC."GradoMaximoEstudios",
			DOC."TelefonoMovil",USU."CorreoInstitucional"
			FROM DOCENTE DOC
			INNER JOIN USUARIO USU ON USU."NoPersonal"=DOC."noPersonal"
			INNER JOIN CARRERA CAR ON CAR."idCarrera"=DOC."Carrera_idCarrera"
			WHERE USU."NoPersonal"=\''.$docente.'\'';
		$consulta=pg_query($this->conexion(), $sql);
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
			$Nombre=$row[0];
			$ApellidoP=$row[1];
			$ApellidoM=$row[2];
			$NoPersonal=$row[3];
			$Carrera=$row[4];
			$Grado=$row[5];
			$Movil=$row[6];
			$Correo=$row[7];
			$json=array("Nombre"=>$Nombre, "ApellidoP"=>$ApellidoP, "ApellidoM"=>$ApellidoM, "NoPersonal"=>$NoPersonal, "Carrera"=>$Carrera,"Grado"=>$Grado,"Movil"=>$Movil,"Correo"=>$Correo);
			array_push($result,$json);
		}
		return $result;
	}
	function consultaDocentesDetalle($docente)
	{
		$sql='SELECT USU."Nombre", USU."ApellidoP" , USU."ApellidoM", USU."NoPersonal", USU."CorreoInstitucional",
		 DOC."TelefonoMovil", CARR."Descripcion"
		FROM DOCENTE DOC
		INNER JOIN USUARIO USU ON USU."NoPersonal"=DOC."noPersonal" 
		INNER JOIN CARRERA CARR ON CARR."idCarrera"=DOC."Carrera_idCarrera"
		WHERE DOC."noPersonal"='.$docente;
		$consulta=pg_query($this->conexion(), $sql);
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
			$Nombre=$row[0];
			$ApellidoP=$row[1];
			$ApellidoM=$row[2];
			$NoPersonal=$row[3];
			$Correo=$row[4];
			$Telefono=$row[5];
			$Carrera=$row[6];
			$result=array("Nombre"=>$Nombre, "ApellidoP"=>$ApellidoP, "ApellidoM"=>$ApellidoM, "NoPersonal"=>$NoPersonal,"Correo"=>$Correo,"Telefono"=>$Telefono, "Carrera"=>$Carrera);
		}
		return $result;
	}
	function getHistorialDocente($docente)
	{
		$sql='SELECT 
		(SELECT COUNT("FolioProyecto") FROM PROYECTO PROYA WHERE PROYA."FolioProyecto"=PROY."FolioProyecto" AND PROYA."idEstado"=7) AS ACTIVOS,
		(SELECT COUNT("FolioProyecto") FROM PROYECTO PROYC WHERE PROYC."FolioProyecto"=PROY."FolioProyecto" AND PROYC."idEstado"=8) AS CANCELADOS,
		(SELECT COUNT("idBloqueo") FROM BLOQUEOS BLOQ WHERE BLOQ."NoPersonal"=doc."noPersonal" ) AS BLOQUEO,
		(SELECT COUNT("idCatSancion") FROM SANCIONES SANS WHERE SANS."nopersonal"=DOC."noPersonal") AS TOTALSANCIONES,
		(SELECT COUNT(ENTR."idEntregable") FROM ENTREGABLE ENTR WHERE ENTR."FechaEntregada" > ENTR."FechaEntrega") AS RETRASOS,
		(SELECT COUNT(PROR."Proyecto_FolioProyecto") FROM PRORROGA PROR 
 			INNER JOIN PROYECTO PROYP ON PROYP."FolioProyecto"=PROR."Proyecto_FolioProyecto"
 			WHERE PROR."Proyecto_FolioProyecto"=PROY."FolioProyecto"
 			AND PROYP."Responsable"=DOC."noPersonal") AS PRORROGASOL
		FROM PROYECTO PROY
		INNER JOIN DOCENTE DOC ON DOC."noPersonal"=PROY."Responsable"
		WHERE DOC."noPersonal"='.$docente;
		$consulta=pg_query($this->conexion(), $sql);
		$json=array();
		$arregloConsulta=array();
		$result=array();
		$i=0;
		while ($fila = pg_fetch_row($consulta)) 
		{ 
			$arregloConsulta[$i]=$fila;
			$i++;
		}
		if ($i>=1) 
		{
			foreach ($arregloConsulta as $row) 
			{
				$Activos=$row[0];
				$Cancelados=$row[1];
				$Bloqueos=$row[2];
				$Sanciones=$row[3];
				$Retrasos=$row[4];
				$Prorroga=$row[5];
				$result=array("Activos"=>$Activos, "Cancelados"=>$Cancelados, "Bloqueos"=>$Bloqueos, "Sanciones"=>$Sanciones,"Retrasos"=>$Retrasos,"Prorroga"=>$Prorroga);
			}
		}
		else{
				$row=array();
				$Activos=(isset($row[0]))?$row[0]:'0';
				$Cancelados=(isset($row[1]))?$row[1]:'0';
				$Bloqueos=(isset($row[2]))?$row[2]:'0';
				$Sanciones=(isset($row[3]))?$row[3]:'0';
				$Retrasos=(isset($row[4]))?$row[4]:'0';
				$Prorroga=(isset($row[5]))?$row[5]:'0';
				$result=array("Activos"=>$Activos, "Cancelados"=>$Cancelados, "Bloqueos"=>$Bloqueos, "Sanciones"=>$Sanciones,"Retrasos"=>$Retrasos,"Prorroga"=>$Prorroga);
		}
		return $result;
	}
	function getInfoSolicitudReactivacion($proyecto)
	{
		$sql='SELECT PROY."NombreProyecto",CANC."FechaCancelacion",PROY."FechaReactivacion",CANC."Motivo",PROY."motivoReactivacion"
		FROM PROYECTO PROY
		LEFT JOIN PROYECTOSCANCELADOS CANC ON CANC."FolioProyecto"=PROY."FolioProyecto"
		WHERE PROY."FolioProyecto"=\''.$proyecto.'\'
		AND CANC."FolioProyecto"=(SELECT MAX(CANC2."FolioProyecto") FROM PROYECTOSCANCELADOS CANC2 WHERE CANC2."FolioProyecto"=\''.$proyecto.'\')';
		// echo $sql;
		// print_r($_SESSION);
		$consulta=pg_query($this->conexion(), $sql);
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
			$NombreProyecto=$row[0];
			$FechaCanc=$row[1];
			$FechaSol=$row[2];
			$MotivoCanc=$row[3];
			$MotivoReact=$row[4];
			$result=array("NombreProyecto"=>$NombreProyecto, "FechaCanc"=>$FechaCanc, "FechaSol"=>$FechaSol, "MotivoCanc"=>$MotivoCanc,"MotivoReact"=>$MotivoReact);
		}
		return $result;
	}
	function getColaboradores($proyecto)
	{
		$sql='SELECT USU."NoPersonal",USU."Nombre"||\' \'||USU."ApellidoP"||\' \'||USU."ApellidoM"
			FROM COLABORADORDOCENTE COL
			INNER JOIN USUARIO USU ON USU."NoPersonal"=COL."Docente_noPersonal"
			WHERE COL."Proyecto_FolioProyecto"=\''.$proyecto.'\'';
		// echo $sql;
		$consulta=pg_query($this->conexion(), $sql);
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
			$json=array("Folio"=>$Folio, "Nombre"=>$Nombre);
			array_push($result,$json);
		}
		return $result;
	}
	function getEtapasProyecto($proyecto)
	{
		$sql='SELECT ETA."NombreEtapa",ETA."noEtapa",ETA."FechaInicio",ETA."FechaFin",ENTREG."Estatus",PROY."FolioProyecto",ENTREG."idEntregable"
		FROM PROYECTO PROY
		INNER JOIN ENTREGABLE ENTREG ON ENTREG."Etapas_FolioProyecto"=PROY."FolioProyecto"
		INNER JOIN ETAPAS ETA ON ETA."FolioProyecto"=PROY."FolioProyecto"
		LEFT JOIN ENTREGABLE ENTRE ON ETA."PkEtapas"=ENTRE."Etapas_noEtapa"
		WHERE PROY."FolioProyecto"=\''.$proyecto.'\'
		ORDER BY  ETA."noEtapa"';
		$consulta=pg_query($this->conexion(), $sql);
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
			$Nombre=$row[0];
			$NoEtapa=$row[1];
			$FechaInicio=$row[2];
			$FechaFin=$row[3];
			$Estatus=$row[4];
			$FolioProyecto=$row[5];
			$Entregable=$row[6];
			$json=array("Nombre"=>$Nombre, "NoEtapa"=>$NoEtapa, "FechaInicio"=>$FechaInicio, "FechaFin"=>$FechaFin, "Estatus"=>$Estatus, "FolioProyecto"=>$FolioProyecto, "Entregable"=>$Entregable);
			array_push($result,$json);
		}
		return $result;
	}
} ?>