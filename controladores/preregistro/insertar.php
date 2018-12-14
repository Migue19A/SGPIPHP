<?php 
	session_start();
	include('../../externas/conexion.php');
	$accion=$_POST['accion'];
	switch ($accion) {            	

			case 'recepcionForm':
				$fp= $_POST['folio_proyecto'];
				$fpresent= $_POST['fecha_presentacion'];	
				$ccpr = $_POST['clave_cpr'];
				$tipoInvest = $_POST['tipo_investigacion'];
				$tipoSec = $_POST['tipo_sector'];
				$especific = $_POST['especifique'];
				$linea = $_POST['linea_investigacion'];
				$nombreProy = $_POST['nombre_proyecto'];
				$inicio = $_POST['fecha_inicio'];
				$fin = $_POST['fecha_fin'];
				$boton= $_POST['recepcion'];
				$sqlInsertar = "INSERT INTO proyecto(\"FolioProyecto\", \"FechaPresentacion\", \"ConvocatoriaCPR\",  \"Inicio\", \"Fin\", \"NombreProyecto\", \"LineaInvestigacion\", \"TipoInvestigacion\", \"TipoSector\", \"Especificar\") VALUES ('".$fp."', '".$fpresent."', '".$ccpr."', '".$inicio."', '".$fin."','".$nombreProy."',
					".$linea.", ".$tipoInvest.", ".$tipoSec.", '".$especific."');";
				$resultado=pg_query($conexion, $sqlInsertar);
				// echo $sqlInsertar;
				break;
			case 'responsableForm':
				$fp= $_POST['folio_proyecto'];
				$actividades=$_POST['actividades_responsable'];
				$palabra1=$_POST['palabra_clave1'];
				$palabra2=$_POST['palabra_clave2'];
				$palabra3=$_POST['palabra_clave3'];
				$sqlUpdate= "UPDATE proyecto SET 
							\"actividadesResponsable\"='".$actividades."',
							\"PalabraClave1\"='".$palabra1."',
							\"PalabraClave2\"='".$palabra2."',
							\"PalabraClave3\"='".$palabra3."',
							\"Responsable\"= 1 WHERE \"FolioProyecto\"='".$fp."';";
				// echo $sqlUpdate;
				$resultado=pg_query($conexion, $sqlUpdate);
				break;
			case 'colaboradorForm':
				$numCols= $_POST['select_colaborador'];
				$cont =1;		
				$folio = $_POST['folio_proyecto'];		
				while ($cont<=$numCols) {
					$paterno = $_POST['apPaternoCol_'.$cont];
					$materno= $_POST['apMaternoCol_'.$cont];
					$nombre= $_POST['nombreCol_'.$cont];
					$gradoMax= $_POST['gradMaximoCol_'.$cont];
					$carrera = $_POST['academiaCol_'.$cont];
					$npersonal= $_POST['numPersonalCol_'.$cont];
					$cel = $_POST['movilCol_'.$cont];
					$correoI= $_POST['correoInstCol_'.$cont];
					$correoA= $_POST['correoAltCol_'.$cont];
					$activ= $_POST['principalesActCol_'.$cont];

					if($cel== ""){
						$cel= 0;
					}

					$sqlI = "INSERT INTO colaboradordocente VALUES 
							('".$activ."', 
							'".$folio."',
							".$npersonal.",
							'".$paterno."',
							'".$materno."',
							'".$gradoMax."',
							".$cel.",
							'".$correoI."',
							'".$correoA."',
							".$carrera.",
							'".$nombre."');";
					echo $sqlI;	
					$resultado=pg_query($conexion, $sqlI);
					$cont= $cont+1;
				}
				break;	
			case 'objetivosForm':
				$fol= $_POST['folio_proyecto'];
				$general=$_POST['obj_general'];
				$especifico=$_POST['obj_especif'];
				$resultados=$_POST['resultados'];
				$sqlUpdate= "UPDATE proyecto SET 
							\"ObjetivoGeneral\"='".$general."',
							\"ObjetivoEspecifico\"='".$especifico."',
							\"Resultados\"='".$resultados."'
							 WHERE \"FolioProyecto\"='".$fol."';";
				echo $sqlUpdate;
				$resultado=pg_query($conexion, $sqlUpdate);
				break;			
			case 'vinculacionForm':
				$foli = $_POST['folio_proyecto'];
				$existeConvenio = $_POST['convenio'];
				$existeAportacion = $_POST['aporta'];
				// $consulta= "SELECT count (id) from vinculacion;";        
    //     		$result = pg_query($conexion, $consulta);
    //     		$result = pg_fetch_array($result);
    //     		$registro = $result[0]+1;
				if($existeConvenio== "si"){
					$organizacion= $_POST['organizacion'];
					$direccion= $_POST['direccionV'];
					$area = $_POST['areaV'];
					$telefono = $_POST['telefonoV'];
					$contacto = $_POST['nombreV'];		
					$descripcion = $_POST['descripcionV'];			
					
					if($existeAportacion=="si"){
						$aportacion = $_POST['descriptionR'];
					}else{
						$aportacion= ' ';
					}
					$sqlIV = "INSERT INTO vinculacion VALUES (														
							'".$foli."',							
							'".$organizacion."',
							'".$direccion."',
							'".$area."',
							'".$telefono."',
							'".$contacto."',
							'".$descripcion."',
							'".$aportacion."');";
					echo $sqlIV;	
					$resultado=pg_query($conexion, $sqlIV);

				}else{
					echo " ";
				}
				break;
			case 'productosForm':
				$intText = $_POST['intelectualText'];
				$otroText = $_POST['otrosText'];
				$f = $_POST['folio_proyecto'];
				if(!isset($_POST['servicio'])){
					$servicio= 'false';
				}else{
					$servicio='true';
				}
				if(!isset($_POST['residencia'])){
					$residencia= 'false';
				}else{
					$residencia='true';
				}
				if(!isset($_POST['tesis'])){
					$tesis= 'false';
				}else{
					$tesis='true';
				}
				if(!isset($_POST['ponencia'])){
					$ponencia= 'false';
				}else{
					$ponencia='true';
				}
				if(!isset($_POST['articulos'])){
					$articulos= 'false';
				}else{
					$articulos='true';
				}
				if(!isset($_POST['libros'])){
					$libros= 'false';
				}else{
					$libros='true';
				}
				$consulta= "SELECT count(\"PkMetas\") from metas;";        
        		$result = pg_query($conexion, $consulta);
        		$result = pg_fetch_array($result);
        		$registro = $result[0]+1;

				$sqlIP= "INSERT INTO metas VALUES('".$f."', 
						".$servicio.",
						".$residencia.",
						".$tesis.",
						".$ponencia.",
						".$articulos.",
						".$libros.",
						'".$intText."',
						'".$otroText."',
						".$registro.");";
				echo $sqlIP;
				$resultado=pg_query($conexion, $sqlIP);
				break;
			case 'etapasForm':
                $etapas=$_POST['opcion_etapas'];
                $consulta= "SELECT count (\"PkEtapas\") from etapas;";        
        		$result = pg_query($conexion, $consulta);
        		$result = pg_fetch_array($result);
        		$registro = $result[0]+1;        		
                $numeroEtapa = $_POST['opcion_etapas'];
                for ($i=1; $i <= $etapas; $i++) 
                { 
                    $nombreEtapa=$_POST['nombreEtapa_'.$i];
                    $inicioEtapa=$_POST['inicioEtapa_'.$i];
                    $folio = $_POST['folio_proyecto'];
                    $finEtapa=$_POST['finalEtapa_'.$i];
                    $mesesEtapa=$_POST['mesesEtapa_'.$i];
                    $descripcioEtapa=$_POST['descripcionEtapa_'.$i];
                    $metasEtapa=$_POST['metasEtapa_'.$i];
                    $actividadeEtapa=$_POST['actividadesEtapa_'.$i];
                    $productosEtapa=$_POST['productosEtapa_'.$i];
                    $sql="INSERT INTO etapas (\"PkEtapas\", \"NombreEtapa\", \"noEtapa\", \"FechaInicio\", \"FechaFin\", \"Meses\" , \"Descripcion\", \"Metas\", \"Actividades\", \"Productos\", \"FolioProyecto\") 
                        VALUES(".$registro.",'".$nombreEtapa."', '".$numeroEtapa."', '".$inicioEtapa."','".$finEtapa."',".$mesesEtapa.",'".$descripcioEtapa."','".$metasEtapa."','".$actividadeEtapa."','".$productosEtapa."', '".$folio."');";
                    $registro++;
                    echo $sql;
                    $resultado=pg_query($conexion, $sql);
                }
            	break;
            case 'financiamientoForm':
            	$fol= $_POST['folio_proyecto'];
            	$existeActual = $_POST['financiamientoR'];
            	// $consulta= "SELECT count (id) from financiamiento;";
        		// $result = pg_query($conexion, $consulta);
        		// $result = pg_fetch_array($result);
        		// $registro = $result[0]+1;
            	if($existeActual== 'si'){
            		$financ_actual= 'true';
            		$externIntern = $_POST['fsi'];
            		if($externIntern == 'interno'){
            			$interno= 'true';
            			$externo = 'false'; 
            		}else{
            			$externo= 'true';
            			$interno = 'false'; 
            		}            		
            		$finan_espe= $_POST['financia_especificar'];

            		$sql = $sql="INSERT INTO financiamientorequerido (\"Financiamiento\", \"Interno\", \"Externo\", \"Especificar\", \"FolioProyecto\") 
                        VALUES('".$financ_actual."',".$interno.",".$externo.",'".$finan_espe."', '".$fol."');";
                    echo $sql;
                    $resultado=pg_query($conexion, $sql);
            	}else{
            		$financ_actual= 'false';
            		$infra= $_POST['infraestructura'];
            		$consu= $_POST['consumibles'];
            		$lice= $_POST['licencias'];
            		$viatic = $_POST['viaticos'];
            		$public = $_POST['publicaciones'];
            		$equipo = $_POST['equipo'];
            		$patente = $_POST['patentes'];
            		$otros = $_POST['otros_finan'];
            		$total = $_POST['total'];
            		$otro_text = $_POST['otro_especificar'];

            		$sql = $sql="INSERT INTO financiamientorequerido ( \"Financiamiento\", \"Infraestructura\", \"Consumibles\", \"Licencias\", \"Viaticos\", \"Publicaciones\", \"Equipo\", \"Patentes\", \"Otros\", \"Especifique\", \"FolioProyecto\") 
                        VALUES(".$financ_actual.",".$infra.",".$consu.",".$lice.",".$viatic.",".$public.",".$equipo.",".$patente.",".$otros.",'".$otro_text."','".$fol."');";
                    echo $sql;
                    $resultado=pg_query($conexion, $sql);

            	}
            	break;
            case 'alumnos_form':
            	$alumnos=$_POST['totalAlumnosCol'];
            	$consulta= "SELECT count (\"pkdetalle_alumnocoldetalle\") from etapas;";        
        		$result = pg_query($conexion, $consulta);
        		$result = pg_fetch_array($result);
        		$registro = $result[0]+1;
            	for ($i=1; $i <= $alumnos ; $i++) 
            	{ 
            		$folio = $_POST['folio_proyecto'];
            		$nombreAlumno=$_POST['nombreAlumnoCol_'.$i];
            		$apPaterno=$_POST['apPaternoAlumnoCol_'.$i];
            		$apMaterno=$_POST['apMaternoAlumnoCol_'.$i];
            		$noControl=$_POST['noControlAlumnoCol_'.$i];
            		$carrera=$_POST['cboCarreraAlumno_'.$i];
            		$semestre=$_POST['cboSemestreAlumnoCol_'.$i];
            		$actividades=$_POST['actividadesAlumnoCol_'.$i];
            		if(!isset($_POST['alumno_servicio_'.$i])){
						$servicio= 'false';
					}else{
						$servicio='true';
					}
					if(!isset($_POST['alumno_residencia_'.$i])){
						$residencia= 'false';
					}else{
						$residencia='true';
					}
					if(!isset($_POST['alumno_tesis_'.$i])){
						$tesis= 'false';
					}else{
						$tesis='true';
					}
					echo "Entra";
            		$sql="INSERT INTO alumno(\"NoControl\", \"Semestre\", \"Nombre\", \"Paterno\", \"Materno\", \"Actividades\", \"id_carrera\", \"Folio_proyecto\", \"servicio\", \"residencia\", \"tesis\", \"estado\")	 
            				VALUES ('".$noControl."',".$semestre.",'".$nombreAlumno."','".$apPaterno."','".$apMaterno."','".$actividades."',".$carrera.",'".$folio."', ".$servicio.", ".$residencia.", ".$tesis.", 1);";
    				echo $sql;
            		$resultado=pg_query($conexion, $sql);
            		$sql="INSERT INTO alumnoscolaboradoresdetalle VALUES (".$registro.",'".$noControl."','".$folio."');";
            		$registro++;
    				echo $sql;
            		$resultado=pg_query($conexion, $sql);
                    $sqlUpdateR = "UPDATE proyecto SET \"NoRevision\" = 1 WHERE \"FolioProyecto\" = '".$folio."'";
                    echo "SQLU: ".$sqlUpdateR."\n";                    
                    pg_query($conexion, $sqlUpdateR);
            		$sqlActEstado= "UPDATE \"proyecto\" SET \"idEstado\"=2 WHERE \"FolioProyecto\"='".$folio."';";
            		$resultado2 = pg_query($conexion, $sqlActEstado);
            	}
            	break;

            	case 'observacionesPreregistro':
            		$presionado= 0;
            		if (isset(_POST['btnEnvDoc'])){
            			$presionado= 1;
            		}else{
            			$presionado= 2;
            		}
            		$folio= $_POST['folio_obs'];
            		echo $presionado;	
            		$ob_proyecto = $_POST['obs_proyecto'];
            		$ob_recepcion = $_POST['obs_recepcion'];
            		$ob_colaboradores = $_POST['obs_colaboradores'];
            		$ob_objetivos = $_POST['obs_objetivos'];
            		$ob_vinculacion = $_POST['obs_vinculacion'];
            		$ob_metas = $_POST['obs_metas'];
            		$ob_etapas = $_POST['obs_etapas'];
            		$ob_fto =  $_POST['obs_financiamiento'];
            		$ob_alumnos = $_POST['obs_alumnos'];
            		$observaciones = array($ob_proyecto, $ob_recepcion, $ob_colaboradores, $ob_objetivos, $ob_vinculacion, $ob_metas, $ob_etapas, $ob_fto, $ob_alumnos);
					//var_dump($observaciones);
            		$conta = 1;
            		while($conta<=9){
            		$sqlInsertObs = "INSERT INTO \"observaciones\" (\"ObservacionesGestion\",\"Proyecto_FolioProyecto\",\"CatObservaciones_idObservaciones\") VALUES ('".$observaciones[$conta-1]."','".$folio."',".$conta." );";      		
            		
            		$resultado=pg_query($conexion, $sqlInsertObs);        		

            		//echo "Insert: ".$sqlInsertObs; 
            		$conta++;
            		}   
            		if($presionado== 1){
            			$sqlActEstado= "UPDATE \"proyecto\" SET \"idEstado\"=1 WHERE \"FolioProyecto\"='".$folio."';";
            		}else{
        				$sqlActEstado= "UPDATE \"proyecto\" SET \"idEstado\"=5 WHERE \"FolioProyecto\"='".$folio."';";
            		}
            		$resultado2 = pg_query($conexion, $sqlActEstado);         		
            		//$s = array("folio" => $folio); 
            		//echo json_encode($s);
            	break;

            	case 'form_prorroga':
            		$folio = $_POST['folio_proy'];
            		$fecha_solicitud = $_POST['fecha_solicitud'];
            		$nombre_proy = $_POST['nombre_proyecto'];
            		$motivos = $_POST['motivos'];
            		$numeroEtapa = $_POST['numero_etapa'];
            		$razones = $_POST['pr_especifique'];
            		$docente = 1;
            		if(isset($_POST['otros_especifique'])){
            			$otros = $_POST['otros_especifique'];
            		}else{
            			$otros = '';
            		}
            		$sql = "INSERT INTO prorroga (\"Motivo\", \"Razones\", \"Proyecto_FolioProyecto\", \"fecha_solicitud\", \"id_docente\", \"otro_especifique\", \"etapa_solicitada\")
            			   VALUES ('".$motivos."', '".$razones."', '".$folio."','".$fecha_solicitud."', ".$docente.",
            			   		   '".$otros."',".$numeroEtapa.");";
            		echo "SQL: ".$sql."\n";
            		pg_query($conexion, $sql);
            		$sqlUpdate = "UPDATE proyecto  SET \"idEstado\"= 6 WHERE \"FolioProyecto\"= '".$folio."'";
            		echo "SQLU: ".$sqlUpdate."\n";
            		pg_query($conexion, $sqlUpdate);
            	break;

            	case 'observacionesG_prorroga':
            		$f = $_POST['folio_pr'];
            		$obs = $_POST['realizar_obs'];

            		$sentencia = "INSERT INTO observaciones (\"ObservacionesGestion\", \"CatObservaciones_idObservaciones\", \"Proyecto_FolioProyecto\") VALUES ('".$obs."', 10, '".$f."');";
            		pg_query($conexion, $sentencia);
            		$sqlActEstado= "UPDATE \"proyecto\" SET \"idEstado\"=7 WHERE \"FolioProyecto\"='".$f."';";
            		pg_query($conexion, $sqlActEstado);
            		echo "Sentencia: ".$sentencia;
            	break;	

            	case 'observacionesI_prorroga':
            		$f = $_POST['folio_pr'];
            		$obs = $_POST['realizar_obs'];
            		if(isset($_POST['enviar_comite'])){
            		$sentencia = "INSERT INTO observaciones (\"ObservacionesInvestigacion\", \"CatObservaciones_idObservaciones\", \"Proyecto_FolioProyecto\") VALUES ('".$obs."', 10, '".$f."');";
            		pg_query($conexion, $sentencia);
            		$sqlActEstado= "UPDATE \"proyecto\" SET \"idEstado\"=8 WHERE \"FolioProyecto\"='".$f."';";
            		pg_query($conexion, $sqlActEstado);
            		echo "Sentencia: ".$sentencia;
            		}
            		if(isset($_POST['aceptar'])){
            			$sqlActEstado= "UPDATE \"proyecto\" SET \"idEstado\"=9 WHERE \"FolioProyecto\"='".$f."';";
            			pg_query($conexion, $sqlActEstado);
            		}
            		if(isset($_POST['rechazar'])){
            			$sqlActEstado= "UPDATE \"proyecto\" SET \"idEstado\"=10 WHERE \"FolioProyecto\"='".$f."';";
            			pg_query($conexion, $sqlActEstado);
            		}
            	break;	

            	case 'observacionesC_prorroga':
            		$f = $_POST['folio_pr'];
            		$obs = $_POST['realizar_obs'];

            		$sentencia = "INSERT INTO observaciones (\"ObservacionesComite\", \"CatObservaciones_idObservaciones\", \"Proyecto_FolioProyecto\") VALUES ('".$obs."', 10, '".$f."');";
            		pg_query($conexion, $sentencia);
            		$sqlActEstado= "UPDATE \"proyecto\" SET \"idEstado\"=11 WHERE \"FolioProyecto\"='".$f."';";
            		pg_query($conexion, $sqlActEstado);
            		echo "Sentencia: ".$sentencia;
            	break;

            	case 'updateInformeGen1':
		$fechaEntrega=$_POST['fechaEntrega'];
		$sql='UPDATE entregable SET "FechaEntrega"=\''.$fechaEntrega.'\' WHERE "idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
	break;
	case 'updateInformeGen2':
		$noactividad=$_POST['numeroActividades'];
		for ($i=0; $i < $noactividad+1; $i++) 
		{ 
			if ($i==0) {
				$numeroAct='';
			}
			else
			{
				$numeroAct=$i;
			}
			$sql='SELECT nextval(\'seq_actividadesproy\');';
			$consulta=pg_query($conexion, $sql);
			$idActProy = pg_fetch_row($consulta);
			$descripcion=$_POST['descripcionAct_'.$numeroAct];
			$alcance=$_POST['alcanceEntrega_'.$numeroAct];
			$observaciones=$_POST['obsActividades_'.$numeroAct];
			$sql='INSERT INTO actividadesproyecto("NoActividad","DescripcionActividades","Alcance","Observaciones","Entregable_idEntregable", "InformeGeneral_IdInformeGeneral") VALUES('.$i.',\''.$descripcion.'\',\''.$alcance.'\',\''.$observaciones.'\','.$entregable.','.$idActProy[0].')';
			$resultado=pg_query($conexion, $sql);
			// $sql='UPDATE actividadesproyecto SET "NoActividad"=\''.$i.'\', "DescripcionActividades"=\''.$descripcion.'\',"Alcance"=\''.$alcance.'\',"Observaciones"=\''.$observaciones.'\' WHERE "Entregable_idEntregable"='.$entregable;
		}
	break;
	case 'updateInformeGen3':
		$numeroObjetivos=$POST['numeroActividades']+1;
		for ($i=0; $i < $numeroObjetivos; $i++)
		{
			if ($i==0) {
				$numeroObj='';
			}
			else
			{
				$numeroObj=$i;
			}
			$sql='SELECT nextval(\'seq_objAlcanzados\');';
			$consulta=pg_query($conexion, $sql);
			$idObjAlc = pg_fetch_row($consulta);
			$objetivos=$_POST['objInforme_'.$numeroObj];
			$alcance=$_POST['alcanceInforme_'.$numeroObj];
			$observaciones=$_POST['obsInforme_'.$numeroObj];
			$sql='INSERT INTO objetivosalcanzados("NoObjetivos","DescripcionActividades","Alcance","Observaciones","InformeGeneral_IdInformeGeneral","Entregable_idEntregable") VALUES('.$numeroObjetivos.',\''.$objetivos.'\',\''.$alcance.'\',\''.$observaciones.'\','.$idObjAlc[0].',\''.$entregable.'\')';
			$resultado=pg_query($conexion, $sql);
			// $sql='UPDATE objetivosalcanzados SET "NoObjetivos"=\''.$objetivos.'\', "DescripcionActividades"=\''.$descripcion.'\',"Alcance"=\''.$alcance.'\',"Observaciones"=\''.$observaciones.'\' WHERE "Entregable_idEntregable"='.$entregable;
		}
	break;
	case 'updateInformeGen4':
		$entregable=$_GET['entregable'];
		$numeroMetas=$POST['numeroMetas']+1;
		for ($i=0; $i < $numeroMetas; $i++)
		{
			if ($i==0) 
			{
				$numeroMet='';
			}
			else
			{
				$numeroMet=$i;
			}
			$sql='SELECT nextval(\'seq_MetasAlc\');';
			$consulta=pg_query($conexion, $sql);
			$idMetasAlca = pg_fetch_row($consulta);
			$objetivos=$_POST['metasObj_'.$numeroMet];
			$alcance=$_POST['metasAlcance_'.$numeroMet];
			$observaciones=$_POST['obsMetas_'.$numeroMet];
			$sql='INSERT INTO metasAlcanzadas("NoMetas","DescripcionActividades","Alcance","Observaciones","InformeGeneral_IdInformeGeneral","Entregable_idEntregable")VALUES('.$i.',\''.$objetivos.'\',\''.$alcance.'\',\''.$observaciones.'\',\''.$idMetasAlca[0].'\','.$entregable.')';
			$resultado=pg_query($conexion, $sql);
		}
		// $sql='UPDATE metasAlcanzadas SET "NoMetas"=\''.$metas.'\', "DescripcionActividades"=\''.$descripcion.'\',"Alcance"=\''.$alcance.'\',"Observaciones"=\''.$Observaciones.'\' WHERE "Entregable_idEntregable"='.$entregable;
	break;
	case 'updateInformeDet1':
		$entregable=$_GET['entregable'];
		$sql='UPDATE resultados SET "Resultados"=\''.$resultados.'\', "Anexos"=\''.$anexos.'\' WHERE "Entregable_idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
	break;
	case 'updateInformeDet2':
		$entregable=$_GET['entregable'];
		if (isset($_POST['avanceInfDet2'])) {
			$avanceTec=$_POST['avanceInfDet2'];
		}
		else
		{
			$avanceTec=0;
		}
		if (isset($_POST['desInfDet2'])) {
			$desarrolloTec=$_POST['desInfDet2'];
		}
		else
		{
			$desarrolloTec=0;
		}
		if (isset($_POST['creaInfraInfDet2'])) {
			$creaInfraest=$_POST['creaInfraInfDet2'];
		}
		else
		{
			$creaInfraest=0;
		}
		$patentDes=$_POST['creaInfraesInfDet2'];
		$patentAvance=$_POST['avancePatInforme2'];
		$patentInfraest=$_POST['creaInfraesInfDet2'];
		$sql='UPDATE logrosconocimiento SET "AvancesConocimientoCientifico"=\''.$avanceTec.'\', "DesarrolloTecnologico"=\''.$desarrolloTec.'\', "InfraestructuraTecnologica"=\''.$creaInfraest.'\', "PatentableDesarrollo"=\''.$patentDes.'\', "PatentableInfraest"=\''.$patentInfraest.'\', "PatentableCientif"=\''.$patentAvance.'\' WHERE "Entregable_idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
	break;
	case 'updateInformeDet3':
		$entregable=$_GET['entregable'];
		foreach ($_POST as $noControl => $trabajo) {
			if ($noControl!='accion') {
				$noControl=explode('_',$noControl);
				if ($noControl[1]!='') 
				{
					$sql='UPDATE logrosrecursoshumanos SET "NombreTrabajo"=\''.$trabajo.'\' WHERE "Entregable_idEntregable"='.$entregable.' AND "FkNoControl"=\''.$noControl[1].'\'';
				}
			}
		}
		$resultado=pg_query($conexion, $sql);
	break;
	case 'updateInformeDet4':
		$entregable=$_GET['entregable'];
		$numeroLogros=$_POST['numeroLogros']+1;
		for ($i=0; $i < $numeroLogros; $i++)
		{
			if ($i==0) {
				$numeroLogro='';
			}
			else
			{
				$numeroLogro=$i;
			}
			$tituloPon=$_POST['logroTitulo_'.$numeroLogro];
			$tipoPon=$_POST['tipoLogro_'.$numeroLogro];
			$nombreEvto=$_POST['NombreLogro_'.$numeroLogro];
			$lugar=$_POST['lugarLogro_'.$numeroLogro];
			$fecha=$_POST['fechaLogro_'.$numeroLogro];
			$sql='INSERT INTO logrosdivulgacionpublicaciones("TituloDelArticulo","TipoPublicacion","NombrePublicacion","Lugar","Fecha","Entregable_idEntregable") VALUES(\''.$tituloPon.'\',\''.$tipoPon.'\',\''.$nombreEvto.'\',\''.$lugar.'\',\''.$fecha.'\','.$entregable.')';
		// $sql='UPDATE logrosdivulgacionpublicaciones SET "TituloDelArticulo"=\''.$tituloArticulo.'\', "TipoPublicacion"=\''.$tipoPublicacion.'\', "NombrePublicacion"=\''.$nombrePublicacion.'\',"Lugar"=\''.$lugar.'\', "Fecha"=\''.$fecha.'\' WHERE "Entregable_idEntregable"='.$entregable;
			$resultado=pg_query($conexion, $sql);
		}
	break;
	case 'updateInformeDet5':
		$entregable=$_GET['entregable'];
		$numeroPresent=$_POST['numeroPresent']+1;
		for ($i=0; $i < $numeroPresent; $i++)
		{
			if ($i==0) {
				$numeropres='';
			}
			else
			{
				$numeropres=$i;
			}
			$tituloPres=$_POST['tituloPresent_'.$numeropres];
			$tipoPres=$_POST['tipoPresent_'.$numeropres];
			$nombreEvto=$_POST['nombrePresent_'.$numeropres];
			$lugar=$_POST['lugarPresent_'.$numeropres];
			$fecha=$_POST['fechaPresent_'.$numeropres];
			$sql='INSERT INTO logrospresentacioneseventos("TituloPonencia","TipoDePonencia","NombreEvento","Lugar","Fecha","Entregable_idEntregable") VALUES(\''.$tituloPres.'\',\''.$tipoPres.'\',\''.$nombreEvto.'\',\''.$lugar.'\',\''.$fecha.'\','.$entregable.')';
			$resultado=pg_query($conexion, $sql);
			// $sql='UPDATE logrospresentacioneseventos SET "TituloPonencia"=\''.$titulo.'\', "TipoDePonencia"=\''.$tipo.'\', "NombreEvento"=\''.$nombreEvento.'\',"Lugar"=\''.$lugar.'\', "Fecha"=\''.$fecha.'\' WHERE "Entregable_idEntregable"='.$entregable;
		}
	break;
	case 'updateResumenEj1':
		$entregable=$_GET['entregable'];
		$resumen=$_POST['resumenEj1'];
		$sql='UPDATE resumenejecutivo SET "Resumen"=\''.$resumen.'\' WHERE "Entregable_idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
	break;
	case 'formResumenEj2':
		$entregable=$_GET['entregable'];
		$comentarios=$_POST['obsResumenEj2'];
		$sql='UPDATE resumenejecutivo SET "Comentarios"=\''.$comentarios.'\' WHERE "Entregable_idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
	break;
	case 'getEntregable':
		$entrega=$conn->getEntregable($entregable);
		$actividades=$conn->getActividades($entregable);
		$objAlcanzados=$conn->objAlcanzados($entregable);
		$metasAlcanzadas=$conn->metasAlcanzadas($entregable);
		$logrosRH=$conn->getLogrosRH($entregable);
		$logrosDivulgacion=$conn->getLogrosDivulgacion($entregable);
		$logrosPresentacion=$conn->getLogrosPresentacion($entregable);
		?>
		<form action="" method="get">
	        <div class="container" style="margin-top: 0;">
	            <div class="col-lg-12 " style="margin-top: 10px;">
	                <div class="col-lg-8">
	                    <div class="" style="margin-top: 0;">
	                        <div class="col-lg-12 well" style="border-color: black;">
	                            <div class="" style="margin-top: 0;">
	                                <div class="col-lg-12 well" style="border-color: black;">
	                                    <div class="row">
	                                        <div class="col-sm-12 form-group">
	                                            <h1 class="text-center" id="informeG" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
	                                                I.- Informe General
	                                            </h1>
	                                            <table class="table table-bordered">                                                                            
	                                                <thead>
	                                                    <tr>
	                                                        <th>
	                                                            <label>
	                                                                Clave*
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Nombre Completo
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Participación
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Firma
	                                                            </label>
	                                                        </th>
	                                                    </tr>
	                                                </thead>
	                                                <tbody>
	                                                    <tr id="informe_general">
	                                                    </tr>
	                                                </tbody>
	                                            </table>
	                                        </div>
	                                    </div>
	                                    <label>
	                                        *CLAVE: Número de personal, en caso de ser docente o administrativo; o número de control en caso de se alumno o egresado.** PARTICIPACIÓN: Responsable, suplente del responsable, colaborador.
	                                    </label>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    B).- Describa de manera general las actividades que se están desarrollando con relación al proyecto:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
	                                                            <?php 
	                                                            foreach ($actividades as $row) {
                                                            	?>
	                                                            <tr>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['NoActividad'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Descripcion'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td colspan="2">
	                                                                    <label>
	                                                                        <?php echo $row['Alcance'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Observaciones'] ?>
	                                                                    </label>
	                                                                </td>
	                                                            </tr>
	                                                            	<?php
	                                                            }
	                                                             ?>
	                                                        </thead>
	                                                        <tbody>
	                                                            <tr id="infor_des">
	                                                                
	                                                            </tr>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    c).- Describa de manera general los objetivos alcanzados al momento, indicando si sufrieron modificaciones con relación al planteamiento inicial:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
	                                                            <?php 
	                                                            foreach ($objAlcanzados as $row) {
                                                            	?>
	                                                            <tr>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['NoObjetivo'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Descripcion'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td colspan="2">
	                                                                    <label>
	                                                                        <?php echo $row['Alcance'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Observaciones'] ?>
	                                                                    </label>
	                                                                </td>
	                                                            </tr>
	                                                            	<?php
	                                                            }
	                                                             ?>
	                                                        </thead>
	                                                        <tbody>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    D).- Describa de manera general las metas alcanzadas al momento, indicando si sufrieron modificaciones con relación al planteamiento inicial:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
                                                        	<?php 
                                                            foreach ($metasAlcanzadas as $row) {
                                                        	?>
                                                            <tr>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['NoMetas'] ?>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['Descripcion'] ?>
                                                                    </label>
                                                                </td>
                                                                <td colspan="2">
                                                                    <label>
                                                                        <?php echo $row['Alcance'] ?>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['Observaciones'] ?>
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            	<?php
                                                            }
                                                            ?>
	                                                        </thead>
	                                                        <tbody>
	                                                            <tr>
	                                                            </tr>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
									<!------------------------------------------------------------------->
	                                <div class="" style="margin-top: 0;">
	                                    <div class="col-lg-12 well" style="border-color: black;">
	                                        <div class="" style="margin-top: 0;">
	                                            <h1 class="text-center" id="informeI" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
	                                                II. Informe Detallado
	                                            </h1>
	                                            <div class="col-lg-12 well" style="border-color: black;">
	                                                <div class="row">
	                                                    <br>
	                                                        <strong>a) Describa de manera general los resultados obtenidos hasta el momento (anexe tablas, gráficas, memorias de cálculo y lo que considere pertinente para apoyar sus resultados)</strong>
	                                                    <div class="col-sm-12 form-group">
	                                                        <textarea name="" id="textResultados" cols="120" rows="5" disabled=""><?php echo $entrega['Resultados'] ?></textarea>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <thead>
	                                                                    <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            No. de Control
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del Alumno
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del trabajo (Tesis)
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Categoría*
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                </thead>
	                                                                <tbody>
	                                                                    <?php 
	                                                                    foreach ($logrosRH as $row) 
	                                                                    {
	                                                                    	?>
																		<tr>
																			<td><?php echo $row['NoControl'] ?></td>
																			<td><?php echo $row['NombreAl'] ?></td>
																			<td><?php echo $row['NombreTrabajo'] ?></td>
																			<td><?php echo $row['Categoria'] ?></td>
																		</tr>
	                                                                    	<?php
	                                                                    }
	                                                                     ?>
	                                                                </tbody>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *CATEGORÍA: Servicio social, residencia profesional, tesis de licenciatura, tesis de especialización, tesis de maestría, tesis doctoral.
	                                            </label>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <label>
	                                                            D) Logros en divulgación por publicaciones (anexe copia del artículo y constancia de su publicación)
	                                                        </label>
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            Titulo del Articulo
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Tipo de Publicación*
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre de la publicación
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            LUGAR (Indicar si es WEB)
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Fecha
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                <?php 
	                                                                foreach ($logrosDivulgacion as $row) {
	                                                                	?>
																	<tr>
	                                                                    <td><?php echo $row['TituloDelArticulo'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['TipoPublicacion'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['NombrePublicacion'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Lugar'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Fecha'] ?>
	                                                                    </td>
	                                                                </tr>
	                                                                	<?php
	                                                                }
	                                                                ?>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *TIPO DE PUBLICACIÓN: Revista arbitrada, revista sin arbitraje, boletín, memoria, libro, periódico.
	                                            </label>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <label>
	                                                            E).-Logros en presentaciones en eventos (anexe copia del reconocimiento, invitación y programa)
	                                                        </label>
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            Titulo de la Ponencia
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Tipo de Ponencia*
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del Evento
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            LUGAR
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Fecha
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                <?php 
	                                                                foreach ($logrosPresentacion as $row) {
	                                                                	?>
																	<tr>
	                                                                    <td><?php echo $row['TituloPonencia'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['TipoPonencia'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['NombreEvento'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Lugar'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Fecha'] ?>
	                                                                    </td>
	                                                                </tr>
	                                                                	<?php
	                                                                }
	                                                                ?>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *TIPO DE PONENCIA: Conferencia magistral, mesa redonda, cartel.
	                                            </label>
	                                        </div>
	                                    </div>
										<!------------------------------------------------------------------>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <div class="col-sm-12">
	                                                    <div class="" style="margin-top: 0;">
	                                                        <h1 class="text-center" id="resumen" style="font-weight: Yu Gothic UI Light;">
	                                                            III. Resumen Ejecutivo
	                                                        </h1>
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="form-group">
	                                                                    <label>
	                                                                        Con la finalidad de difundir su investigación, explique en forma clara y concisa en qué consiste su proyecto, incluyendo los beneficios obtenidos hasta el momento (de preferencia utilice un máximo de veinte renglones).
	                                                                    </label>
	                                                                </div>
	                                                                <div class="form-group">
	                                                                    <textarea class="form-control" disabled name="textarea" rows="4"><?php echo $entrega['Resumen'] ?></textarea>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="" style="margin-top: 0;">
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="form-group">
	                                                                    <label>
	                                                                        OBSERVACIONES: Utilice este espacio para sus comentarios y sugerencias.
	                                                                    </label>
	                                                                </div>
	                                                                <div class="from-group">
	                                                                    <textarea class="form-control" disabled="" name="textarea" rows="4"><?php echo $entrega['Resumen'] ?></textarea>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="" style="margin-top: 0;">
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="col-sm-3">
	                                                                    <label>
	                                                                        Nombre del Responsable:
	                                                                    </label>
	                                                                </div>
	                                                                <div class="col-sm-4">
	                                                                    <label>
	                                                                        <?php echo $entrega['NombreResp'] ?>
	                                                                    </label>
	                                                                </div>
	                                                            </div>
	                                                            <div class="row">
	                                                                <div class="col-sm-2">
	                                                                    <label>
	                                                                        Firma del Responsable
	                                                                    </label>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	    			<!------------------------------------------------------------------------------->
	                <div class="col-lg-4" role="complementary">
	                    <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
	                        <ul class="nav bs-docs-sidenav">
	                            <div class="container" id="navObserv">
	                                <h3>
	                                    Observaciones
	                                </h3>
	                                <div class="panel panel-primary panel-default">
	                                <form id="formObs" name="formObs" method="_POST" >
		                           		<div class="panel-heading">
			                                <h5 class="panel-title">
			                                    Observaciones
			                                </h5>
			                                <span class="pull-right clickable panel-collapsed">
			                                    <i class="glyphicon glyphicon-chevron-down">
			                                    </i>
			                                </span>
			                            </div>
			                            <div class="panel-body" style="display: none;">
			                                <li class="">
			                                    <a class="accordion col-lg-4" href="#informe" style="color: #337ab7">
			                                        Informe General I
			                                    </a>
			                                    <div class="panel2">
			                                        <textarea class="form-control" name="informeGeneral1" rows="5" id="informeGeneral1" style="resize:none">
			                                        </textarea>
			                                        <br>
		                                            <br>
			                                    </div>
			                                </li>
			                                <li class="">
			                                    <a class="accordion col-lg-4" href="#informeII" style="color: #337ab7">
			                                        Informe Detallado II
			                                    </a>
			                                    <div class="panel2">
			                                        <textarea class="form-control" name="informeDetallado1" rows="5" id="informeDetallado1" style="resize:none">
			                                        </textarea>
			                                        <br>
		                                            <br>
			                                    </div>
			                                </li>
			                                <li class="">
			                                    <a class="accordion col-lg-4" href="#informeIII" style="color: #337ab7">
			                                        Resumen Ejecutivo III
			                                    </a>
			                                    <div class="panel2">
			                                        <textarea class="form-control" id="resumenEjec1" name="resumenEjec1" rows="5" style="resize:none">
			                                        </textarea>
			                                        <br>
			                                            <br>
			                                    </div>
			                                </li>
			                            </div>
                        			</form>
                        			</div>
	                                <!------------------------------------------------------------------->
	                                <div class="panel panel-primary panel-default" id="" >
		                           		<div class="panel-heading">
			                                <h5 class="panel-title">
			                                    Subdirección de Investigación y Posgrado
			                                </h5>
			                                <span class="pull-right clickable panel-collapsed">
			                                    <i class="glyphicon glyphicon-chevron-down">
			                                    </i>
			                                </span>
			                            </div>
			                            <div class="panel-body" style="display: none;">
			                                <li class="">
			                                    <a class="accordion col-lg-4" href="#informe" style="color: #337ab7">
			                                        Informe General I
			                                    </a>
			                                    <div class="panel2">
			                                        <textarea class="form-control" name="" rows="5" style="resize:none">
			                                        </textarea>
			                                        <br>
		                                            <br>
			                                    </div>
			                                </li>
			                                <li class="">
			                                    <a class="accordion col-lg-4" href="#informeII" style="color: #337ab7">
			                                        Informe Detallado II
			                                    </a>
			                                    <div class="panel2">
			                                        <textarea class="form-control" name="" rows="5" style="resize:none">
			                                        </textarea>
			                                        <br>
		                                            <br>
			                                    </div>
			                                </li>
			                                <li class="">
			                                    <a class="accordion col-lg-4" href="#informeIII" style="color: #337ab7">
			                                        Resumen Ejecutivo III
			                                    </a>
			                                    <div class="panel2">
			                                        <textarea class="form-control" name="" rows="5" style="resize:none">
			                                        </textarea>
			                                        <br>
		                                            <br>
			                                    </div>
			                                </li>
			                            </div>
                        			</div>
                        			<div class="panel panel-primary panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                Consejo de Investigación
                                            </h5>
                                            <span class="pull-right clickable panel-collapsed">
                                                <i class="glyphicon glyphicon-chevron-down">
                                                </i>
                                            </span>
                                        </div>
                                        <div class="panel-body" style="display: none;">
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informe" style="color: #337ab7">
                                                    Informe General I
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" id="" name="" rows="5" style="resize:none"></textarea>
                                                   
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeII" style="color: #337ab7">
                                                    Informe Detallado II
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" id="" name="" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeIII" style="color: #337ab7">
                                                    Resumen Ejecutivo III
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" id="" name="" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                        </div>
                                    </div>
	                                <li class="">
	                                    <a href="#" onclick="aceptar(<?php echo $entregable ?>)">
	                                        Aceptar Entrega
	                                    </a>
	                                </li>
	                                <li class="">
	                                    <a href="#" onclick="enviarRevision('Consejo')">
	                                        Enviar a Consejo de Investigación
	                                    </a>
	                                </li>
	                                <li class="">
	                                    <a href="#" onclick="enviarRevision('Docente')">
	                                        Regresar revisión a Docente Resposable
	                                    </a>
	                                </li>
	                                <li class="">
	                                </li>
	                                <li class="">
	                                    <a data-dismiss="modal" href="#">
	                                        Cerrar
	                                    </a>
	                                </li>
	                            </div>
	                        </ul>
	                    </nav>
	                </div>
	            </div>
	        </div>
	    </form>
	    <script>
		var acc = document.getElementsByClassName("accordion");
		var i;
		for (i = 0; i < acc.length; i++) 
		{
		  acc[i].onclick = function() 
		  {
		    this.classList.toggle("active");
		    var panel = this.nextElementSibling;
		    if (panel.style.maxHeight)
		    {
		      panel.style.maxHeight = null;
		    } else 
		    {
		      panel.style.maxHeight = panel.scrollHeight + "px";
		    } 
		  }
		}
		</script>
		<script type="text/javascript">
		$(document).on('click', '.panel-heading span.clickable',function(e)
		{
		  var $this = $(this);
		  if(!$this.hasClass('panel-collapsed')) 
		  {
		    $this.parents('.panel').find('.panel-body').slideUp();
		    $this.addClass('panel-collapsed');
		    $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		  } 
		  else 
		  {
		    $this.parents('.panel').find('.panel-body').slideDown();
		    $this.removeClass('panel-collapsed');
		    $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		  }
		})
		</script>
		<?php
	break;
	case 'getEntregableComite':
		$entrega=$conn->getEntregable($entregable);
		$actividades=$conn->getActividades($entregable);
		$objAlcanzados=$conn->objAlcanzados($entregable);
		$metasAlcanzadas=$conn->metasAlcanzadas($entregable);
		$logrosRH=$conn->getLogrosRH($entregable);
		$logrosDivulgacion=$conn->getLogrosDivulgacion($entregable);
		$logrosPresentacion=$conn->getLogrosPresentacion($entregable);
		?>
		<form action="" method="get">
	        <div class="container" style="margin-top: 0;">
	            <div class="col-lg-12 " style="margin-top: 10px;">
	                <div class="col-lg-8">
	                    <div class="" style="margin-top: 0;">
	                        <div class="col-lg-12 well" style="border-color: black;">
	                            <div class="" style="margin-top: 0;">
	                                <div class="col-lg-12 well" style="border-color: black;">
	                                    <div class="row">
	                                        <div class="col-sm-12 form-group">
	                                            <h1 class="text-center" id="informeG" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
	                                                I.- Informe General
	                                            </h1>
	                                            <table class="table table-bordered">                                                                            
	                                                <thead>
	                                                    <tr>
	                                                        <th>
	                                                            <label>
	                                                                Clave*
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Nombre Completo
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Participación
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Firma
	                                                            </label>
	                                                        </th>
	                                                    </tr>
	                                                </thead>
	                                                <tbody>
	                                                    <tr id="informe_general">
	                                                    </tr>
	                                                </tbody>
	                                            </table>
	                                        </div>
	                                    </div>
	                                    <label>
	                                        *CLAVE: Número de personal, en caso de ser docente o administrativo; o número de control en caso de se alumno o egresado.** PARTICIPACIÓN: Responsable, suplente del responsable, colaborador.
	                                    </label>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    B).- Describa de manera general las actividades que se están desarrollando con relación al proyecto:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
	                                                            <?php 
	                                                            foreach ($actividades as $row) {
                                                            	?>
	                                                            <tr>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['NoActividad'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Descripcion'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td colspan="2">
	                                                                    <label>
	                                                                        <?php echo $row['Alcance'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Observaciones'] ?>
	                                                                    </label>
	                                                                </td>
	                                                            </tr>
	                                                            	<?php
	                                                            }
	                                                             ?>
	                                                        </thead>
	                                                        <tbody>
	                                                            <tr id="infor_des">
	                                                                
	                                                            </tr>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    c).- Describa de manera general los objetivos alcanzados al momento, indicando si sufrieron modificaciones con relación al planteamiento inicial:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
	                                                            <?php 
	                                                            foreach ($objAlcanzados as $row) {
                                                            	?>
	                                                            <tr>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['NoObjetivo'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Descripcion'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td colspan="2">
	                                                                    <label>
	                                                                        <?php echo $row['Alcance'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Observaciones'] ?>
	                                                                    </label>
	                                                                </td>
	                                                            </tr>
	                                                            	<?php
	                                                            }
	                                                             ?>
	                                                        </thead>
	                                                        <tbody>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    D).- Describa de manera general las metas alcanzadas al momento, indicando si sufrieron modificaciones con relación al planteamiento inicial:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
                                                        	<?php 
                                                            foreach ($metasAlcanzadas as $row) {
                                                        	?>
                                                            <tr>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['NoMetas'] ?>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['Descripcion'] ?>
                                                                    </label>
                                                                </td>
                                                                <td colspan="2">
                                                                    <label>
                                                                        <?php echo $row['Alcance'] ?>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['Observaciones'] ?>
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            	<?php
                                                            }
                                                            ?>
	                                                        </thead>
	                                                        <tbody>
	                                                            <tr>
	                                                            </tr>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
									<!------------------------------------------------------------------->
	                                <div class="" style="margin-top: 0;">
	                                    <div class="col-lg-12 well" style="border-color: black;">
	                                        <div class="" style="margin-top: 0;">
	                                            <h1 class="text-center" id="informeI" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
	                                                II. Informe Detallado
	                                            </h1>
	                                            <div class="col-lg-12 well" style="border-color: black;">
	                                                <div class="row">
	                                                    <br>
	                                                        <strong>a) Describa de manera general los resultados obtenidos hasta el momento (anexe tablas, gráficas, memorias de cálculo y lo que considere pertinente para apoyar sus resultados)</strong>
	                                                    <div class="col-sm-12 form-group">
	                                                        <textarea name="" id="textResultados" cols="120" rows="5" disabled=""><?php echo $entrega['Resultados'] ?></textarea>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <thead>
	                                                                    <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            No. de Control
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del Alumno
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del trabajo (Tesis)
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Categoría*
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                </thead>
	                                                                <tbody>
	                                                                    <?php 
	                                                                    foreach ($logrosRH as $row) 
	                                                                    {
	                                                                    	?>
																		<tr>
																			<td><?php echo $row['NoControl'] ?></td>
																			<td><?php echo $row['NombreAl'] ?></td>
																			<td><?php echo $row['NombreTrabajo'] ?></td>
																			<td><?php echo $row['Categoria'] ?></td>
																		</tr>
	                                                                    	<?php
	                                                                    }
	                                                                     ?>
	                                                                </tbody>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *CATEGORÍA: Servicio social, residencia profesional, tesis de licenciatura, tesis de especialización, tesis de maestría, tesis doctoral.
	                                            </label>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <label>
	                                                            D) Logros en divulgación por publicaciones (anexe copia del artículo y constancia de su publicación)
	                                                        </label>
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            Titulo del Articulo
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Tipo de Publicación*
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre de la publicación
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            LUGAR (Indicar si es WEB)
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Fecha
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                <?php 
	                                                                foreach ($logrosDivulgacion as $row) {
	                                                                	?>
																	<tr>
	                                                                    <td><?php echo $row['TituloDelArticulo'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['TipoPublicacion'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['NombrePublicacion'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Lugar'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Fecha'] ?>
	                                                                    </td>
	                                                                </tr>
	                                                                	<?php
	                                                                }
	                                                                ?>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *TIPO DE PUBLICACIÓN: Revista arbitrada, revista sin arbitraje, boletín, memoria, libro, periódico.
	                                            </label>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <label>
	                                                            E).-Logros en presentaciones en eventos (anexe copia del reconocimiento, invitación y programa)
	                                                        </label>
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            Titulo de la Ponencia
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Tipo de Ponencia*
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del Evento
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            LUGAR
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Fecha
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                <?php 
	                                                                foreach ($logrosPresentacion as $row) {
	                                                                	?>
																	<tr>
	                                                                    <td><?php echo $row['TituloPonencia'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['TipoPonencia'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['NombreEvento'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Lugar'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Fecha'] ?>
	                                                                    </td>
	                                                                </tr>
	                                                                	<?php
	                                                                }
	                                                                ?>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *TIPO DE PONENCIA: Conferencia magistral, mesa redonda, cartel.
	                                            </label>
	                                        </div>
	                                    </div>
										<!------------------------------------------------------------------>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <div class="col-sm-12">
	                                                    <div class="" style="margin-top: 0;">
	                                                        <h1 class="text-center" id="resumen" style="font-weight: Yu Gothic UI Light;">
	                                                            III. Resumen Ejecutivo
	                                                        </h1>
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="form-group">
	                                                                    <label>
	                                                                        Con la finalidad de difundir su investigación, explique en forma clara y concisa en qué consiste su proyecto, incluyendo los beneficios obtenidos hasta el momento (de preferencia utilice un máximo de veinte renglones).
	                                                                    </label>
	                                                                </div>
	                                                                <div class="form-group">
	                                                                    <textarea class="form-control" disabled name="textarea" rows="4"><?php echo $entrega['Resumen'] ?></textarea>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="" style="margin-top: 0;">
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="form-group">
	                                                                    <label>
	                                                                        OBSERVACIONES: Utilice este espacio para sus comentarios y sugerencias.
	                                                                    </label>
	                                                                </div>
	                                                                <div class="from-group">
	                                                                    <textarea class="form-control" disabled="" name="textarea" rows="4"><?php echo $entrega['Resumen'] ?></textarea>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="" style="margin-top: 0;">
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="col-sm-3">
	                                                                    <label>
	                                                                        Nombre del Responsable:
	                                                                    </label>
	                                                                </div>
	                                                                <div class="col-sm-4">
	                                                                    <label>
	                                                                        <?php echo $entrega['NombreResp'] ?>
	                                                                    </label>
	                                                                </div>
	                                                            </div>
	                                                            <div class="row">
	                                                                <div class="col-sm-2">
	                                                                    <label>
	                                                                        Firma del Responsable
	                                                                    </label>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	    			<!------------------------------------------------------------------------------->
	                <div class="col-lg-4" role="complementary">
                        <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
                            <ul class="nav bs-docs-sidenav">
                                <div class="container" id="navObserv">
                                    <h3>
                                        Observaciones
                                    </h3>
                                    <div class="panel panel-primary panel-default">
                                        <form action="">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                Realizar Observaciones
                                            </h5>
                                            <span class="pull-right clickable panel-collapsed">
                                                <i class="glyphicon glyphicon-chevron-down">
                                                </i>
                                            </span>
                                        </div>
                                        <div class="panel-body" style="display: none;">
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informe" style="color: #337ab7">
                                                    Informe General I
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="informeGeneral1" rows="5" style="resize:none">
                                                    </textarea>
                                                   
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeII" style="color: #337ab7">
                                                    Informe Detallado II
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="informeDetallado1" rows="5" style="resize:none">
                                                    </textarea>
                                                    
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeIII" style="color: #337ab7">
                                                    Resumen Ejecutivo III
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="resumenEjec1" rows="5" style="resize:none">
                                                    </textarea>
                                                   
                                                </div>
                                            </li>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="panel panel-primary panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                Oficina de Seguimiento de Proyectos de Invest.
                                            </h5>
                                            <span class="pull-right clickable panel-collapsed">
                                                <i class="glyphicon glyphicon-chevron-down">
                                                </i>
                                            </span>
                                        </div>
                                        <div class="panel-body" style="display: none;">
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informe" style="color: #337ab7">
                                                    Informe General I
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                   
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeII" style="color: #337ab7">
                                                    Informe Detallado II
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                   
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeIII" style="color: #337ab7">
                                                    Resumen Ejecutivo III
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    
                                                </div>
                                            </li>
                                        </div>
                                    </div>
                                    <div class="panel panel-primary panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                Subdirección de Investigación y Posgrado
                                            </h5>
                                            <span class="pull-right clickable panel-collapsed">
                                                <i class="glyphicon glyphicon-chevron-down">
                                                </i>
                                            </span>
                                        </div>
                                        <div class="panel-body" style="display: none;">
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informe" style="color: #337ab7">
                                                    Informe General I
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeII" style="color: #337ab7">
                                                    Informe Detallado II
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeIII" style="color: #337ab7">
                                                    Resumen Ejecutivo III
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    
                                                </div>
                                            </li>
                                        </div>
                                    </div>
                                    <li class="">
                                        <a href="#" onclick="RegresarInvestigacion(<?php echo $entregable ?>)">
                                            Regresar revisión a Subdirección de Investigación y Posgrado
                                        </a>
                                    </li>
                                    <li class="">
                                    </li>
                                    <li class="">
                                        <a data-dismiss="modal" href="#">
                                            Cerrar
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </nav>
                    </div>
	            </div>
	        </div>
	    </form>
	    <script>
		var acc = document.getElementsByClassName("accordion");
		var i;
		for (i = 0; i < acc.length; i++) 
		{
		  acc[i].onclick = function() 
		  {
		    this.classList.toggle("active");
		    var panel = this.nextElementSibling;
		    if (panel.style.maxHeight)
		    {
		      panel.style.maxHeight = null;
		    } else 
		    {
		      panel.style.maxHeight = panel.scrollHeight + "px";
		    } 
		  }
		}
		</script>
		<script type="text/javascript">
		$(document).on('click', '.panel-heading span.clickable',function(e)
		{
		  var $this = $(this);
		  if(!$this.hasClass('panel-collapsed')) 
		  {
		    $this.parents('.panel').find('.panel-body').slideUp();
		    $this.addClass('panel-collapsed');
		    $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		  } 
		  else 
		  {
		    $this.parents('.panel').find('.panel-body').slideDown();
		    $this.removeClass('panel-collapsed');
		    $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		  }
		})
		</script>
		<?php
	break;
	case 'getEntregableGest':
		$entrega=$conn->getEntregable($entregable);
		$actividades=$conn->getActividades($entregable);
		$objAlcanzados=$conn->objAlcanzados($entregable);
		$metasAlcanzadas=$conn->metasAlcanzadas($entregable);
		$logrosRH=$conn->getLogrosRH($entregable);
		$logrosDivulgacion=$conn->getLogrosDivulgacion($entregable);
		$logrosPresentacion=$conn->getLogrosPresentacion($entregable);
		?>
		<form action="" method="get">
	        <div class="container" style="margin-top: 0;">
	            <div class="col-lg-12 " style="margin-top: 10px;">
	                <div class="col-lg-8">
	                    <div class="" style="margin-top: 0;">
	                        <div class="col-lg-12 well" style="border-color: black;">
	                            <div class="" style="margin-top: 0;">
	                                <div class="col-lg-12 well" style="border-color: black;">
	                                    <div class="row">
	                                        <div class="col-sm-12 form-group">
	                                            <h1 class="text-center" id="informeG" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
	                                                I.- Informe General
	                                            </h1>
	                                            <table class="table table-bordered">                                                                            
	                                                <thead>
	                                                    <tr>
	                                                        <th>
	                                                            <label>
	                                                                Clave*
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Nombre Completo
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Participación
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Firma
	                                                            </label>
	                                                        </th>
	                                                    </tr>
	                                                </thead>
	                                                <tbody>
	                                                    <tr id="informe_general">
	                                                    </tr>
	                                                </tbody>
	                                            </table>
	                                        </div>
	                                    </div>
	                                    <label>
	                                        *CLAVE: Número de personal, en caso de ser docente o administrativo; o número de control en caso de se alumno o egresado.** PARTICIPACIÓN: Responsable, suplente del responsable, colaborador.
	                                    </label>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    B).- Describa de manera general las actividades que se están desarrollando con relación al proyecto:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
	                                                            <?php 
	                                                            foreach ($actividades as $row) {
                                                            	?>
	                                                            <tr>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['NoActividad'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Descripcion'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td colspan="2">
	                                                                    <label>
	                                                                        <?php echo $row['Alcance'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Observaciones'] ?>
	                                                                    </label>
	                                                                </td>
	                                                            </tr>
	                                                            	<?php
	                                                            }
	                                                             ?>
	                                                        </thead>
	                                                        <tbody>
	                                                            <tr id="infor_des">
	                                                                
	                                                            </tr>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    c).- Describa de manera general los objetivos alcanzados al momento, indicando si sufrieron modificaciones con relación al planteamiento inicial:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
	                                                            <?php 
	                                                            foreach ($objAlcanzados as $row) {
                                                            	?>
	                                                            <tr>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['NoObjetivo'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Descripcion'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td colspan="2">
	                                                                    <label>
	                                                                        <?php echo $row['Alcance'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Observaciones'] ?>
	                                                                    </label>
	                                                                </td>
	                                                            </tr>
	                                                            	<?php
	                                                            }
	                                                             ?>
	                                                        </thead>
	                                                        <tbody>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    D).- Describa de manera general las metas alcanzadas al momento, indicando si sufrieron modificaciones con relación al planteamiento inicial:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
                                                        	<?php 
                                                            foreach ($metasAlcanzadas as $row) {
                                                        	?>
                                                            <tr>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['NoMetas'] ?>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['Descripcion'] ?>
                                                                    </label>
                                                                </td>
                                                                <td colspan="2">
                                                                    <label>
                                                                        <?php echo $row['Alcance'] ?>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['Observaciones'] ?>
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            	<?php
                                                            }
                                                            ?>
	                                                        </thead>
	                                                        <tbody>
	                                                            <tr>
	                                                            </tr>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
									<!------------------------------------------------------------------->
	                                <div class="" style="margin-top: 0;">
	                                    <div class="col-lg-12 well" style="border-color: black;">
	                                        <div class="" style="margin-top: 0;">
	                                            <h1 class="text-center" id="informeI" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
	                                                II. Informe Detallado
	                                            </h1>
	                                            <div class="col-lg-12 well" style="border-color: black;">
	                                                <div class="row">
	                                                    <br>
	                                                        <strong>a) Describa de manera general los resultados obtenidos hasta el momento (anexe tablas, gráficas, memorias de cálculo y lo que considere pertinente para apoyar sus resultados)</strong>
	                                                    <div class="col-sm-12 form-group">
	                                                        <textarea name="" id="textResultados" cols="120" rows="5" disabled=""><?php echo $entrega['Resultados'] ?></textarea>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <thead>
	                                                                    <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            No. de Control
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del Alumno
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del trabajo (Tesis)
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Categoría*
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                </thead>
	                                                                <tbody>
	                                                                    <?php 
	                                                                    foreach ($logrosRH as $row) 
	                                                                    {
	                                                                    	?>
																		<tr>
																			<td><?php echo $row['NoControl'] ?></td>
																			<td><?php echo $row['NombreAl'] ?></td>
																			<td><?php echo $row['NombreTrabajo'] ?></td>
																			<td><?php echo $row['Categoria'] ?></td>
																		</tr>
	                                                                    	<?php
	                                                                    }
	                                                                     ?>
	                                                                </tbody>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *CATEGORÍA: Servicio social, residencia profesional, tesis de licenciatura, tesis de especialización, tesis de maestría, tesis doctoral.
	                                            </label>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <label>
	                                                            D) Logros en divulgación por publicaciones (anexe copia del artículo y constancia de su publicación)
	                                                        </label>
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            Titulo del Articulo
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Tipo de Publicación*
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre de la publicación
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            LUGAR (Indicar si es WEB)
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Fecha
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                <?php 
	                                                                foreach ($logrosDivulgacion as $row) {
	                                                                	?>
																	<tr>
	                                                                    <td><?php echo $row['TituloDelArticulo'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['TipoPublicacion'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['NombrePublicacion'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Lugar'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Fecha'] ?>
	                                                                    </td>
	                                                                </tr>
	                                                                	<?php
	                                                                }
	                                                                ?>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *TIPO DE PUBLICACIÓN: Revista arbitrada, revista sin arbitraje, boletín, memoria, libro, periódico.
	                                            </label>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <label>
	                                                            E).-Logros en presentaciones en eventos (anexe copia del reconocimiento, invitación y programa)
	                                                        </label>
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            Titulo de la Ponencia
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Tipo de Ponencia*
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del Evento
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            LUGAR
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Fecha
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                <?php 
	                                                                foreach ($logrosPresentacion as $row) {
	                                                                	?>
																	<tr>
	                                                                    <td><?php echo $row['TituloPonencia'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['TipoPonencia'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['NombreEvento'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Lugar'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Fecha'] ?>
	                                                                    </td>
	                                                                </tr>
	                                                                	<?php
	                                                                }
	                                                                ?>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *TIPO DE PONENCIA: Conferencia magistral, mesa redonda, cartel.
	                                            </label>
	                                        </div>
	                                    </div>
										<!------------------------------------------------------------------>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <div class="col-sm-12">
	                                                    <div class="" style="margin-top: 0;">
	                                                        <h1 class="text-center" id="resumen" style="font-weight: Yu Gothic UI Light;">
	                                                            III. Resumen Ejecutivo
	                                                        </h1>
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="form-group">
	                                                                    <label>
	                                                                        Con la finalidad de difundir su investigación, explique en forma clara y concisa en qué consiste su proyecto, incluyendo los beneficios obtenidos hasta el momento (de preferencia utilice un máximo de veinte renglones).
	                                                                    </label>
	                                                                </div>
	                                                                <div class="form-group">
	                                                                    <textarea class="form-control" disabled name="textarea" rows="4"><?php echo $entrega['Resumen'] ?></textarea>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="" style="margin-top: 0;">
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="form-group">
	                                                                    <label>
	                                                                        OBSERVACIONES: Utilice este espacio para sus comentarios y sugerencias.
	                                                                    </label>
	                                                                </div>
	                                                                <div class="from-group">
	                                                                    <textarea class="form-control" disabled="" name="textarea" rows="4"><?php echo $entrega['Resumen'] ?></textarea>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="" style="margin-top: 0;">
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="col-sm-3">
	                                                                    <label>
	                                                                        Nombre del Responsable:
	                                                                    </label>
	                                                                </div>
	                                                                <div class="col-sm-4">
	                                                                    <label>
	                                                                        <?php echo $entrega['NombreResp'] ?>
	                                                                    </label>
	                                                                </div>
	                                                            </div>
	                                                            <div class="row">
	                                                                <div class="col-sm-2">
	                                                                    <label>
	                                                                        Firma del Responsable
	                                                                    </label>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	    			<!------------------------------------------------------------------------------->
	                <div class="col-lg-4" role="complementary">
                        <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
                            <ul class="nav bs-docs-sidenav">
                                <div class="container" id="navObserv">
                                    <h3>
                                        Observaciones
                                    </h3>
                                    <form class="panel panel-primary panel-default" id="Observ">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                Realizar Observaciones
                                            </h5>
                                            <span class="pull-right clickable panel-collapsed">
                                                <i class="glyphicon glyphicon-chevron-down">
                                                </i>
                                            </span>
                                        </div>
                                        <div class="panel-body" style="display: none;">
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informe" style="color: #337ab7">
                                                    Informe General I
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="informeGeneral1" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeII" style="color: #337ab7">
                                                    Informe Detallado II
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="informeDetallado1" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeIII" style="color: #337ab7">
                                                    Resumen Ejecutivo III
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="resumenEjec1" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                        </div>
                                    </form>
                                    <li class="">
                                        <a href="#" onclick="GuardarObs(<?php echo $entregable ?>)">
                                            Enviar revisión a Subdirección de Investigación y Posgrado
                                        </a>
                                    </li>
                                    <li class="">
                                    </li>
                                    <li class="">
                                        <a data-dismiss="modal" href="#">
                                            Cerrar
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </nav>
                    </div>
	            </div>
	        </div>
	    </form>
	    <script>
		var acc = document.getElementsByClassName("accordion");
		var i;
		for (i = 0; i < acc.length; i++) 
		{
		  acc[i].onclick = function() 
		  {
		    this.classList.toggle("active");
		    var panel = this.nextElementSibling;
		    if (panel.style.maxHeight)
		    {
		      panel.style.maxHeight = null;
		    } else 
		    {
		      panel.style.maxHeight = panel.scrollHeight + "px";
		    } 
		  }
		}
		</script>
		<script type="text/javascript">
		$(document).on('click', '.panel-heading span.clickable',function(e)
		{
		  var $this = $(this);
		  if(!$this.hasClass('panel-collapsed')) 
		  {
		    $this.parents('.panel').find('.panel-body').slideUp();
		    $this.addClass('panel-collapsed');
		    $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		  } 
		  else 
		  {
		    $this.parents('.panel').find('.panel-body').slideDown();
		    $this.removeClass('panel-collapsed');
		    $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		  }
		})
		</script>
		<?php
	break;
	case 'enviarConsejo':
		$sql='SELECT nextval(\'seq_ObsEntrega\')';
		$resultado=pg_query($conexion, $sql);
		$consulta= pg_fetch_array($resultado);
		$idObservacion=$consulta[0];
		$entregable=$_POST['entregable'];
		$InformeGeneral=$_POST['informeGeneral1'];
		$informeDetallado=$_POST['informeDetallado1'];
		$resumen=$_POST['resumenEjec1'];
		$sql='INSERT INTO observacionesentregable("Entregable_idEntregable","InformeGeneral","InformeDetallado","ResumenEjecutivo","catObservaciones_idObservaciones","Departamento") VALUES('.$entregable.',\''.$InformeGeneral.'\',\''.$informeDetallado.'\',\''.$resumen.'\','.$idObservacion.',2) ';
		$resultado=pg_query($conexion, $sql);
		$sql='UPDATE entregable SET "Estatus"=4 WHERE "idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
	break;
	case 'enviarDocente':
		$sql='SELECT nextval(\'seq_ObsEntrega\')';
		$resultado=pg_query($conexion, $sql);
		$consulta= pg_fetch_array($resultado);
		$idObservacion=$consulta[0];
		$entregable=$_GET['entregable'];
		$InformeGeneral=$_POST['informeGeneral1'];
		$informeDetallado=$_POST['informeDetallado1'];
		$resumen=$_POST['resumenEjec1'];
		$sql='INSERT INTO observacionesentregable("Entregable_idEntregable","InformeGeneral","InformeDetallado","ResumenEjecutivo","catObservaciones_idObservaciones","Departamento") VALUES('.$entregable.',\''.$InformeGeneral.'\',\''.$informeDetallado.'\',\''.$resumen.'\','.$idObservacion.',3) ';
		$resultado=pg_query($conexion, $sql);
		$sql='UPDATE entregable SET "Estatus"=5 WHERE "idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
	break;
	case 'enviarSubdireccion':
	$sql='SELECT nextval(\'seq_ObsEntrega\')';
		$resultado=pg_query($conexion, $sql);
		$consulta= pg_fetch_array($resultado);
		$idObservacion=$consulta[0];
		$entregable=$_GET['entregable'];
		$InformeGeneral=$_POST['informeGeneral1'];
		$informeDetallado=$_POST['informeDetallado1'];
		$resumen=$_POST['resumenEjec1'];
		$sql='INSERT INTO observacionesentregable("Entregable_idEntregable","InformeGeneral","InformeDetallado","ResumenEjecutivo","catObservaciones_idObservaciones","Departamento") VALUES('.$entregable.',\''.$InformeGeneral.'\',\''.$informeDetallado.'\',\''.$resumen.'\','.$idObservacion.',1) ';
		$resultado=pg_query($conexion, $sql);
		$sql='UPDATE entregable SET "Estatus"=2 WHERE "idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
	break;
	case 'aceptaEntrega':
		$sql='SELECT nextval(\'seq_ObsEntrega\')';
		$resultado=pg_query($conexion, $sql);
		$consulta= pg_fetch_array($resultado);
		$idObservacion=$consulta[0];
		$InformeGeneral=$_POST['informeGeneral1'];
		$informeDetallado=$_POST['informeDetallado1'];
		$resumen=$_POST['resumenEjec1'];
		$entregable=$_GET['entregable'];
		$sql='UPDATE entregable SET "Estatus"=3 WHERE "idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
		$sql='INSERT INTO observacionesentregable("Entregable_idEntregable","InformeGeneral","InformeDetallado","ResumenEjecutivo","CatObservaciones_idObservaciones","Departamento") VALUES('.$entregable.',\''.$InformeGeneral.'\',\''.$informeDetallado.'\',\''.$resumen.'\','.$idObservacion.',2) ';
		$resultado=pg_query($conexion, $sql);
	break;
            	
				default: echo "XD";
				break;
		}	

 ?>