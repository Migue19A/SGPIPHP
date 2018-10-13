<?php 
	session_start();
	include('../externas/Clases/consultas.php');
	// $accion = $_POST['accion'];
	/*$arrayC_nombre[] = array();
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
	$arrayObsG = array();
	$arrayObsI = array();
	$arrayObsC = array();
	$numColaboradores= 0;*/

	if (isset($_POST['accion']))
	{
		$accion = $_POST['accion'];
	}
	else
	{
		$accion=$_GET['accion'];
	}
	$conex = new ClassConn();
	$miConn = new Consultas();
	switch ($accion) {
		case 'consultarProrroga':
			$folio = $_GET['botonVer'];
			$etapa_actual = "SELECT max(\"noEtapa\") FROM etapas WHERE \"FolioProyecto\" = '".$folio."';";	
			$result = pg_query($conex->conexion(), $etapa_actual);
			$noEA = pg_fetch_array($result);
			$sql = "SELECT \"FechaFin\", etapas.\"FolioProyecto\", \"NombreProyecto\", \"noEtapa\" FROM etapas inner join proyecto ON proyecto.\"FolioProyecto\" = etapas.\"FolioProyecto\" WHERE etapas.\"FolioProyecto\" = '".$folio."' and \"noEtapa\"= ".$noEA[0].";";
			$resultado = pg_query($conex->conexion(), $sql);
			$result=pg_fetch_array($resultado);
			$estado= $miConn->consultarEstadoProyecto($folio);
			$salida = array(
				"fechaFin" => $result[0],
				"folio" => $result[1],
				"nombreProy" => $result[2],
				"numEtapa" =>$result[3],
				"estado" => $estado
			);
			//echo "SQL: ".$sql."\n";
			//echo "Folio: ".$folio."\n";
			echo json_encode ($salida);
		break;	 

		case 'obtenerInfo':
			$fol = $_GET['botonVer'];
			$sql = "SELECT UPPER(\"NombreProyecto\"), \"etapa_solicitada\", \"Motivo\", \"Razones\", \"otro_especifique\", \"ObservacionesGestion\", \"ObservacionesInvestigacion\", \"ObservacionesComite\", \"idEstado\" FROM prorroga INNER JOIN proyecto  ON \"Proyecto_FolioProyecto\"= \"FolioProyecto\" INNER JOIN observaciones ON observaciones.\"Proyecto_FolioProyecto\" = prorroga.\"Proyecto_FolioProyecto\" WHERE prorroga.\"Proyecto_FolioProyecto\"= '".$fol."' and \"CatObservaciones_idObservaciones\"=10 GROUP BY \"NombreProyecto\", \"etapa_solicitada\", \"Motivo\", \"Razones\", \"otro_especifique\", prorroga.\"Proyecto_FolioProyecto\", \"ObservacionesGestion\", \"ObservacionesInvestigacion\", \"ObservacionesComite\", \"idEstado\";";
			//echo "SQL: ".$sql;
			$resultado = pg_query($conex->conexion(), $sql);
			$result=pg_fetch_array($resultado);
			if($result[2]== 'Otro'){
				$motivos = $result['otro_especifique'];
			}else{
				$motivos = $result['Motivo'];
			}
			$salida = array(
				"nombre_proyecto" => $result[0],
				"num_etapa" => $result[1],
				"motivo" => $motivos,
				"estado" => $result[8],
				"razones" =>$result[3],
				"obs_G"  => $result[5],
				"obs_I"  => $result[6],
				"obs_C"  => $result[7]
			);
			//echo "SQL: ".$sql."\n";
			//echo "Folio: ".$folio."\n";
			echo json_encode ($salida);
		break;
		default:
			# code...
			break;
	}
 ?>