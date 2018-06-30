<?php 
	include('../../externas/conexion.php');
	// echo $_POST['accion'];
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
				$sqlInsertar = "INSERT INTO proyecto(folio_proyecto, fecha_presentacion, convocatoria_CPR, inicio, fin, nombre_proyecto, lineaInvestigacion_id, tipoInvestigacion_id, tipoSector_id,
					especificar) VALUES ('".$fp."', '".$fpresent."', '".$ccpr."', '".$inicio."', '".$fin."','".$nombreProy."',
					".$linea.", ".$tipoInvest.", ".$tipoSec.", '".$especific."');";
				$resultado=pg_query($conexion, $sqlInsertar);
				break;
			case 'responsableForm':
				$fp= $_POST['folio_proyecto'];
				$actividades=$_POST['actividades_responsable'];
				$palabra1=$_POST['palabra_clave1'];
				$palabra2=$_POST['palabra_clave2'];
				$palabra3=$_POST['palabra_clave3'];
				$sqlUpdate= "UPDATE proyecto SET 
							actividades_responsable='".$actividades."',
							palabra_clave1='".$palabra1."',
							palabra_clave2='".$palabra2."',
							palabra_clave3='".$palabra3."',
							id_responsable= 1 WHERE folio_proyecto='".$fp."';";
				echo $sqlUpdate;
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
							('".$paterno."', 
							'".$materno."',
							'".$nombre."',
							'".$gradoMax."',
							".$npersonal.",
							".$cel.",
							'".$correoI."',
							'".$correoA."',
							'".$activ."',
							".$carrera.",
							'".$folio."');";
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
							objetivo_general='".$general."',
							objetivo_especifico='".$especifico."',
							resultados='".$resultados."',
							id_responsable= 1 WHERE folio_proyecto='".$fol."';";
				echo $sqlUpdate;
				$resultado=pg_query($conexion, $sqlUpdate);
				break;			
			case 'vinculacionForm':
				$foli = $_POST['folio_proyecto'];
				$existeConvenio = $_POST['convenio'];
				$existeAportacion = $_POST['aporta'];
				$consulta= "SELECT count (id) from vinculacion;";        
        		$result = pg_query($conexion, $consulta);
        		$result = pg_fetch_array($result);
        		$registro = $result[0]+1;
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
					$sqlIV = "INSERT INTO vinculacion VALUES ("
							.$registro.",
							'".$organizacion."',
							'".$direccion."',
							'".$area."',
							'".$descripcion."',
							'".$aportacion."',
							'".$foli."',
							".$telefono.");";
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
				$consulta= "SELECT count (id) from metas;";        
        		$result = pg_query($conexion, $consulta);
        		$result = pg_fetch_array($result);
        		$registro = $result[0]+1;

				$sqlIP= "INSERT INTO metas VALUES(".$registro.", 
						".$servicio.",
						".$residencia.",
						".$tesis.",
						".$ponencia.",
						".$articulos.",
						".$libros.",
						'".$intText."',
						'".$otroText."',
						'".$f."');";
				echo $sqlIP;
				$resultado=pg_query($conexion, $sqlIP);
				break;
			case 'etapasForm':
                $etapas=$_POST['opcion_etapas'];
                $consulta= "SELECT count (id_etapa) from etapas;";        
        		$result = pg_query($conexion, $consulta);
        		$result = pg_fetch_array($result);
        		$registro = $result[0]+1;
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
                    $sql="INSERT INTO etapas (id_etapa, nombre_etapa, fecha_inicio_etapa, fecha_fin_etapa, meses , descripcion_etapa, metas, actividades_etapa, productos, f_proyecto) 
                        VALUES(".$registro.",'".$nombreEtapa."','".$inicioEtapa."','".$finEtapa."',".$mesesEtapa.",'".$descripcioEtapa."','".$metasEtapa."','".$actividadeEtapa."','".$productosEtapa."', '".$folio."');";
                    // echo $sql;
                    $resultado=pg_query($conexion, $sql);
                }
            	break;
            case 'financiamientoForm':
            	$fol= $_POST['folio_proyecto'];
            	$existeActual = $_POST['financiamientoR'];
            	$consulta= "SELECT count (id) from financiamiento;";        
        		$result = pg_query($conexion, $consulta);
        		$result = pg_fetch_array($result);
        		$registro = $result[0]+1;
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

            		$sql = $sql="INSERT INTO financiamiento (id, financ, interno, externo, especificar, folio_proyecto_id) 
                        VALUES(".$registro.",'".$financ_actual."',".$interno.",".$externo.",'".$finan_espe."', '".$fol."');";
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

            		$sql = $sql="INSERT INTO financiamiento (id, financ, infraestructura, consumibles, licencias, viaticos, publicaciones, equipo, patentes, otros, especifique, folio_proyecto_id) 
                        VALUES(".$registro.",".$financ_actual.",".$infra.",".$consu.",".$lice.",".$viatic.",".$public.",".$equipo.",".$patente.",".$otros.",'".$otro_text."','".$fol."');";
                    echo $sql;
                    $resultado=pg_query($conexion, $sql);

            	}
            	break;
            case 'alumnos_form':
            	$alumnos=$_POST['totalAlumnosCol'];
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
            		$sql="INSERT INTO alumno(numero_control, semestre, nombre_alumno, apellido_paterno_alumno, apellido_materno_alumno, actividades_alumno, id_carrera_id, folio_proy) 
            				VALUES ('".$noControl."',".$semestre.",'".$nombreAlumno."','".$apPaterno."','".$apMaterno."','".$actividades."',".$carrera.", '".$folio."');";
    				echo $sql;
            		$resultado=pg_query($conexion, $sql);
            	}
            	break;

				default: echo "XD";



				break;
		}	

 ?>