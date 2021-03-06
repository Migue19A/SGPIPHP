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
} ?>