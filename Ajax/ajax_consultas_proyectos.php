<?php 
	session_start();
	include('../externas/Clases/classConn.php');
	// $accion = $_POST['accion'];
	$arrayC_nombre[] = array();
	$arrayC_paterno[] = array();
	$arrayC_materno[] = array();
	$arrayC_max_estudios[] = array();
	$arrayC_actividades[] = array();
	$arrayC_npersonal[] = array();
	$arrayC_movil[] = array();
	$arrayC_correo1[] = array();
	$arrayC_correo2[] = array();
	$arrayC_academia[] = array();
	$array_nombreEtapa[] = array();
	$array_inicioEtapa[] = array();
	$array_finEtapa[] = array();
	$array_mesesEtapa = array();
	$array_descripcionEtapa= array();
	$array_metasEtapa = array();
	$array_actividadesEtapa = array();
	$array_productosEtapa = array();
	$etapas_num = 0;
	$arrayA_nControl = array();
	$arrayA_semestre = array();
	$arrayA_nombre = array();
	$arrayA_paterno = array();
	$arrayA_materno = array();
	$arrayA_actividades = array();
	$arrayA_carrera = array();
	$arrayA_servicio = array();
	$arrayA_residencia = array();
	$arrayA_tesis = array();

	$numColaboradores= 0;

	if (isset($_POST['accion']))
	{
		$accion = $_POST['accion'];
	}
	else
	{
		$accion=$_GET['accion'];
	}
	$miConn = new ClassConn();

	switch ($accion) {
		case 'login':
			$usuario=$_GET['usuario'];
			$password=$_GET['password'];
			$resultado=new stdClass;
			$sql='select "descripciontipo", "Descripcion", "NoPersonal", "Nombre", "ApellidoP", "ApellidoM", "Sexo", "CorreoInstitucional", "GradoMaximoEstudios", "TelefonoMovil", "Carrera_idCarrera","estado"
				from usuario as  us 
				left join docente as doc on us."NoPersonal"=doc."noPersonal"
				left join carrera as car on car."idCarrera"=doc."Carrera_idCarrera"
				left join tipoUsuario as tipUs on tipUs."idtipousuario"=us."tipoUsuario"
				where contrasenia=\''.$password.'\' and "NoPersonal"='.$usuario.';';
				// echo $sql;
			$resultados = pg_query($miConn->conexion(), $sql);
			$result=pg_fetch_array($resultados);
			if ($resultados && $result['NoPersonal']!=null) 
			{
				$_SESSION['NoPersonal']=$result['NoPersonal'];
				$_SESSION['TipoUsuario']=$result['descripciontipo'];
				$_SESSION['Carrera']=$result['Descripcion'];
				$_SESSION['Nombre']=$result['Nombre'];
				$_SESSION['ApPaterno']=$result['ApellidoP'];
				$_SESSION['ApMaterno']=$result['ApellidoM'];
				$_SESSION['Sexo']=$result['Sexo'];
				$_SESSION['Correo']=$result['CorreoInstitucional'];
				$_SESSION['Telefono']=$result['TelefonoMovil'];
				$_SESSION['GradEstudios']=$result['GradoMaximoEstudios'];
				$_SESSION['Estado']=$result['estado'];
				$resultado->resultado=1;
				$resultado->tipoUsuario=$result['descripciontipo'];
			}
			else
			{
				$resultado->resultado=0;
			}
			$resultado=json_encode($resultado, JSON_FORCE_OBJECT);
			echo $resultado;
			break;
		case 'cambiarEstadoUsuario':
			$usuario=$_GET['usuario'];
			$estado=$_GET['estado'];
			$resultado=new stdClass;
			$sql='UPDATE USUARIO SET "estado"='.$estado.' WHERE "NoPersonal"='.$usuario;
			$result = pg_query($miConn->conexion(), $sql);
			if ($result) {
				$resultado->resultado=1;
			}
			else
			{
				$resultado->resultado=0;
			}
			$resultado=json_encode($resultado, JSON_FORCE_OBJECT);
			echo $resultado;
		break;
		case 'altaUsuario': 
			$resultado=new stdClass;
			$nombre=$_POST['nombre'];
			$apPaterno=$_POST['apPaterno'];
			$apMaterno=$_POST['apMaterno'];
			$movil=$_POST['movil'];
			$correo=$_POST['correo'];
			$noPersonal=$_POST['noPersonal'];
			$gradoMax=$_POST['gradoMax'];
			$carrera=$_POST['carrera'];
			$sexo=$_POST['sexo'];
			$tipoUsu=$_POST['tipoUsu'];
			$password=$_POST['password'];
			$fechaNac=$_POST['fechaNac'];
			$sql='INSERT INTO usuario("NoPersonal","Nombre","ApellidoP","ApellidoM","FechaNacimiento","Sexo","CorreoInstitucional","contrasenia","tipoUsuario","estado") 
				values ('.$noPersonal.',\''.$nombre.'\',\''.$apPaterno.'\',\''.$apMaterno.'\',\''.$fechaNac.'\',\''.$sexo.'\',\''.$correo.'\',\''.$password.'\','.$tipoUsu.',1);';
			$sql.='INSERT INTO docente("noPersonal","GradoMaximoEstudios","TelefonoMovil","Carrera_idCarrera") values('.$noPersonal.','.$gradoMax.','.$movil.','.$carrera.');';
			$insertUsuario = pg_query($miConn->conexion(), $sql);
			if ($insertUsuario) {
				$resultado->resultado=1;
			}
			else
			{
				$resultado->resultado=0;
			}
			$resultado=json_encode($resultado, JSON_FORCE_OBJECT);
			echo $resultado;
		break;
		case 'editaUsuario':
			$resultado=new stdClass;
			$nombre=$_POST['nombre'];
			$apPaterno=$_POST['apPaterno'];
			$apMaterno=$_POST['apMaterno'];
			$movil=$_POST['movil'];
			$correo=$_POST['correo'];
			$noPersonal=$_POST['noPersonal'];
			$gradoMax=$_POST['gradoMax'];
			$carrera=$_POST['carrera'];
			$sexo=$_POST['sexo'];
			$tipoUsu=$_POST['tipoUsu'];
			$usuario=$_GET['usuario'];
			$sql='UPDATE usuario SET "NoPersonal"='.$noPersonal.', "Nombre"=\''.$nombre.'\', "ApellidoP"=\''.$apPaterno.'\', "ApellidoM"=\''.$apMaterno.'\',"Sexo"=\''.$sexo.'\', "CorreoInstitucional"=\''.$correo.'\', "tipoUsuario"='.$tipoUsu.' WHERE "NoPersonal"='.$usuario.';';
			$sql.='UPDATE docente SET "noPersonal"='.$noPersonal.', "GradoMaximoEstudios"='.$gradoMax.', "TelefonoMovil"='.$movil.', "Carrera_idCarrera"='.$carrera.' WHERE "noPersonal"='.$usuario.';';
			$insertUsuario = pg_query($miConn->conexion(), $sql);
			if ($insertUsuario) {
				$resultado->resultado=1;
			}
			else
			{
				$resultado->resultado=0;
			}
			$resultado=json_encode($resultado, JSON_FORCE_OBJECT);
			echo $resultado;
			break;
		case 'consultarProyecto':
			$folio = $_POST['botonVer'];
			$consulta = "SELECT * FROM proyecto WHERE \"FolioProyecto\"='".$folio."';";
			$result = pg_query($miConn->conexion(), $consulta);
			$result = pg_fetch_array($result);
			$tipoInvestigacion = $result['TipoInvestigacion'];
			$consultaTipoInvestigacion = "SELECT descripcion FROM tipoInvestigacion WHERE id =".$tipoInvestigacion.";";
			$result2 = pg_query($miConn->conexion(), $consultaTipoInvestigacion);
			$result2= pg_fetch_array($result2);

			$tipoSector = $result['TipoSector'];
			$consultaTipoSector = "SELECT descripcion FROM tiposector WHERE id =".$tipoSector.";";
			$result3 = pg_query($miConn->conexion(), $consultaTipoSector);
			$result3= pg_fetch_array($result3);
			if($result3[0]== "Otro"){
				$tipoSect= $result['Especificar'];
			}else{
				$tipoSect= $result3[0];
			}

			$LineaInv = $result['LineaInvestigacion'];
			$consultaLineaInvestigacion = "SELECT descripcion FROM lineainvestigacion WHERE id =".$LineaInv.";";
			$result4 = pg_query($miConn->conexion(), $consultaLineaInvestigacion);
			$result4= pg_fetch_array($result4);

			$nombre = strtoupper($result['NombreProyecto']);
			$consulta2 = "SELECT COUNT(\"Docente_noPersonal\") FROM colaboradordocente WHERE \"Proyecto_FolioProyecto\"='".$folio."';";
			$consulta3 = "SELECT nombre, ap_paterno, ap_materno, grado_max_estudios, \"Actividades\", \"Docente_noPersonal\", celular, \"correo_institucional\", \"correo_alternativo\", \"Descripcion\" academia FROM colaboradordocente INNER JOIN carrera ON id_carrera= \"idCarrera\" 
				WHERE \"Proyecto_FolioProyecto\"='".$folio."' ORDER BY \"ap_paterno\";"; 
			$consulta4 = "SELECT \"ObjetivoGeneral\", \"ObjetivoEspecifico\", \"Resultados\" FROM proyecto WHERE \"FolioProyecto\"='".$folio."';";	
			$consulta5 = "SELECT COUNT(\"FolioProyecto\") consecutivo, \"NombreOrganizacion\", \"Dirección\", \"Area\", \"DescripcionOrganizacion\", \"DescripcionAportaciones\", \"Telefono\", \"NombreCompleto\" FROM vinculacion WHERE \"FolioProyecto\"='".$folio."' GROUP BY \"NombreOrganizacion\", \"Dirección\", \"Area\", 
			\"DescripcionOrganizacion\", \"DescripcionAportaciones\", \"Telefono\", \"NombreCompleto\";";
			$consulta6 = "SELECT \"Servicio\", \"Residencia\", \"Tesis\", \"Ponencia\", \"Articulos\", \"Libros\", \"PropiedadesIntelectual\", \"Otros\" FROM metas 
						  WHERE \"FkFolioProyecto\" = '".$folio."';";
			$consulta7 = "SELECT COUNT(\"PkEtapas\") cons, \"NombreEtapa\", \"noEtapa\", \"FechaInicio\", \"FechaFin\", \"Meses\", \"Descripcion\", \"Metas\", \"Actividades\", \"Productos\" FROM etapas WHERE \"FolioProyecto\" = '".$folio."' GROUP BY \"NombreEtapa\", \"noEtapa\", \"FechaInicio\", \"FechaFin\", \"Meses\", \"Descripcion\", \"Metas\", \"Actividades\", \"Productos\";";

			$consulta8 = "SELECT \"Financiamiento\", \"Interno\", \"Externo\", \"Especificar\", \"Infraestructura\", \"Consumibles\", \"Licencias\", \"Viaticos\", \"Publicaciones\", \"Equipo\", \"Patentes\", \"Otros\", \"Especifique\" 
				FROM financiamientorequerido WHERE \"FolioProyecto\" = 'PRE3';"; 
			$consulta9 = "SELECT \"NoControl\", \"Semestre\", \"Nombre\", \"Paterno\", \"Materno\", 
				\"Descripcion\" carrera, \"Actividades\", \"servicio\", \"residencia\", \"tesis\" FROM alumno INNER JOIN carrera ON \"id_carrera\"= \"idCarrera\" WHERE \"Folio_proyecto\" ='".$folio."' ORDER BY \"Paterno\";";		
			$consulta10 = "SELECT COUNT(\"Folio_proyecto\") FROM alumno WHERE \"Folio_proyecto\"= '".$folio."';";	  
			

			//echo "Consulta9: ".$consulta9;
			$result5 = pg_query($miConn->conexion(), $consulta2);
			$result5 = pg_fetch_array($result5);			
			$result6 = pg_query($miConn->conexion(), $consulta3);
			$result7 = pg_query($miConn->conexion(), $consulta4);
			$result7 = pg_fetch_array($result7);
			$result8 = pg_query($miConn->conexion(), $consulta5);
			$result8 = pg_fetch_array($result8);
			$result9 = pg_query($miConn->conexion(), $consulta6);
			$result9 = pg_fetch_array($result9);
			$result10 = pg_query($miConn->conexion(), $consulta7);
			$result11 = pg_query($miConn->conexion(), $consulta8);
			$result11 = pg_fetch_array($result11);
			$result12 = pg_query($miConn->conexion(), $consulta9);
			$result12B = pg_query($miConn->conexion(), $consulta10);
			$result12B = pg_fetch_array($result12B);
			while ($r = pg_fetch_array($result6)){
				$arrayC_nombre[]=  $r['nombre'];
				$arrayC_paterno[]=  $r['ap_paterno'];
				$arrayC_materno[]=  $r['ap_materno'];
				$arrayC_max_estudios[] = $r['grado_max_estudios'];				
				$arrayC_actividades[] = $r['Actividades'];
				$arrayC_npersonal[] = $r['Docente_noPersonal'];
				$arrayC_movil[] = $r['celular'];
				$arrayC_correo1[] = $r['correo_institucional'];
				$arrayC_correo2[] = $r['correo_alternativo'];
				$arrayC_academia[] = $r['academia'];
			}

			while ($row = pg_fetch_array($result10)){
				$array_nombreEtapa[] = $row['NombreEtapa'];
				$array_inicioEtapa[] = $row['FechaInicio'];
				$array_finEtapa[] = $row['FechaFin'];
				$array_mesesEtapa[] = $row['Meses'];
				$array_descripcionEtapa[] = $row['Descripcion'];
				$array_metasEtapa[] = $row['Metas'];
				$array_actividadesEtapa[] = $row['Actividades'];
				$array_productosEtapa[] = $row['Productos'];
				$etapas_num = $row['noEtapa'];

			}

			while ($fila = pg_fetch_array($result12)){
				$arrayA_nControl[] = $fila['NoControl'];
				$arrayA_semestre[] = $fila['Semestre'];
				$arrayA_nombre[] = $fila['Nombre'];
				$arrayA_paterno[] = $fila['Paterno'];
				$arrayA_materno[] = $fila['Materno'];
				$arrayA_actividades[] = $fila['Actividades'];
				$arrayA_carrera[] = $fila['carrera'];
				$arrayA_servicio[] = $fila['servicio'];
				$arrayA_residencia[] = $fila['residencia'];
				$arrayA_tesis[] =$fila['tesis'];
			}

			//$result10 = pg_fetch_array($result10);
			//echo 'Versión actual de PHP: ' . phpversion();			
			$salida = array(
				"fechap" => $result['FechaPresentacion'],
				"cpr" => $result['ConvocatoriaCPR'],
				"tipoI" =>  $result2[0],
				"tipoS" => $tipoSect,
				"linea" => $result4[0],
				"nombre_p" => $nombre,
				"fechaI" => $result['Inicio'],
				"fechaF" => $result['Fin'],
				"actividades" => $result['actividadesResponsable'],
				"palabraClave1" => $result['PalabraClave1'],
				"palabraClave2" => $result['PalabraClave2'],
				"palabraClave3" => $result['PalabraClave3'],
				"prueba" => $result5[0],
				"nombre_colaborador" => $arrayC_nombre,
				"paterno_colaborador" => $arrayC_paterno,
				"materno_colaborador" => $arrayC_materno,
				"maxE_colaborador" => $arrayC_max_estudios,
				"actividades_colaborador" => $arrayC_actividades,
				"npersonal_colaborador" => $arrayC_npersonal,
				"movil_colaborador" => $arrayC_movil,
				"correo1_colaborador" => $arrayC_correo1,
				"correo2_colaborador" => $arrayC_correo2,
				"academia_colaborador" => $arrayC_academia,
				"objetivo_general"  => $result7['ObjetivoGeneral'],
				"objetivo_especifico"  => $result7['ObjetivoEspecifico'],
				"resultados"  => $result7['Resultados'],
				"existe" => $result8['consecutivo'],
				"nombre_organizacion" => $result8['NombreOrganizacion'],
				"direccion" => $result8['Dirección'],
				"area" => $result8['Area'],
				"descripcion_organizacion" => $result8['DescripcionOrganizacion'],
				"descripcion_aportaciones" => $result8['DescripcionAportaciones'],
				"telefonov" => $result8['Telefono'],
				"servicio" => $result9['Servicio'],
				"residencia" => $result9['Residencia'],
				"tesis" => $result9['Tesis'],
				"ponencia" => $result9['Ponencia'],
				"articulos" => $result9['Articulos'],
				"libros" => $result9['Libros'],
				"prop_intelectual" => $result9['PropiedadesIntelectual'],
				"otros" => $result9['Otros'],
				"numEtapas" => $etapas_num,
				"nombre_etapa" => $array_nombreEtapa,
				"fecha_inicio_etapa" => $array_inicioEtapa,
				"fecha_fin_etapa" => $array_finEtapa,
				"meses" => $array_mesesEtapa,
				"descripcion_etapa" => $array_descripcionEtapa,
				"metas" => $array_metasEtapa,
				"actividades_etapa" => $array_actividadesEtapa,
				"productos" => $array_productosEtapa,
				"financiamiento" => $result11['Financiamiento'],
				"interno" => $result11['Interno'],
				"externo" => $result11['Externo'],
				"especificar" => $result11['Especificar'],
				"infraestructura" => $result11['Infraestructura'],
				"consumibles" => $result11['Consumibles'],
				"licencias" => $result11['Licencias'],
				"viaticos" => $result11['Viaticos'],
				"publicaciones" => $result11['Publicaciones'],
				"equipo" => $result11['Equipo'],
				"patentes" => $result11['Patentes'],
				"otros" => $result11['Otros'],
				"especifique" => $result11['Especifique'],
				"num_alumnos" => $result12B[0],
				"num_control" => $arrayA_nControl,
				"semestre" => $arrayA_semestre,
				"nombre" => $arrayA_nombre,
				"apPaterno" => $arrayA_paterno,
				"apMaterno" => $arrayA_materno,
				"actividades" => $arrayA_actividades,
				"carrera" => $arrayA_carrera,
				"a_servicio" => $arrayA_servicio,
				"a_residencia" => $arrayA_residencia,
				"a_tesis" => $arrayA_tesis
			);
			//print_r($result6['nombre']);
			echo json_encode($salida);
		
		default:
			# code...
			break;
	}
 ?>