<?php 
	session_start();
	include('../../externas/conexion.php');
	//echo $_POST['accion'];
	$accion=$_POST['accion'];
			
			//echo "<script>jQuery(function(){swal(\"¡Guardado con éxito!\", \"Datos guardados correctamente\", \"success\");});</script>";*/
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
							'".$descripcion."',							
							'".$aportacion."',
							'".$foli."',
							'".$organizacion."',
							'".$direccion."',
							'".$area."',
							'".$telefono."',
							'".$contacto."');";
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

				$sqlIP= "INSERT INTO metas VALUES('".$folio."', 
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
            		$sql="INSERT INTO alumno(\"NoControl\", \"Semestre\", \"Nombre\", \"Paterno\", \"Materno\", \"Actividades\", \"id_carrera\", \"Folio_proyecto\", \"servicio\", \"residencia\", \"tesis\")	 
            				VALUES ('".$noControl."',".$semestre.",'".$nombreAlumno."','".$apPaterno."','".$apMaterno."','".$actividades."',".$carrera.",'".$folio."', ".$servicio.", ".$residencia.", ".$tesis.");";
    				echo $sql;
            		$resultado=pg_query($conexion, $sql);
            		$sql="INSERT INTO alumnoscolaboradoresdetalle VALUES (".$registro.",'".$noControl."','".$folio."');";
            		$registro++;
    				echo $sql;
            		$resultado=pg_query($conexion, $sql);
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
            		echo $folio;	
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
            			$sqlActEstado= "UPDATE \"proyecto\" SET idEstado=1 WHERE FolioProyecto='".$folio."';"
            		}else{
            			$sqlActEstado= "UPDATE \"proyecto\" SET idEstado=2 WHERE FolioProyecto='".$folio."';"
            		}
            		$resultado2 = pg_query($conexion, $sqlActEstado);         		
            		//$s = array("folio" => $folio); 
            		//echo json_encode($s);
            	break;

				default: echo "XD";
				break;
		}	

 ?>