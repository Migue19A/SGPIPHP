<?php 
	session_start();
	include('../../externas/conexion.php');
	$cont =0;
	$conta = 1;
	$contador = 0;
	$productos = 30;
	//echo $_POST['accion'];
	$accion=$_POST['accion'];
	$num_col = $_POST['numero_colaborador'];
	$tablas = ['proyecto', "vinculacion", "metas", "financiamientorequerido"];
	$proyectoCadenas = ["FechaPresentacion", "ConvocatoriaCPR", "TipoInvestigacion", "TipoSector", "LineaInvestigacion", "NombreProyecto", "Inicio", "Fin", "actividadesResponsable", "PalabraClave1",
				"PalabraClave2", "PalabraClave3", "ObjetivoGeneral", "ObjetivoEspecifico", "Resultados", "NombreOrganizacion",
				"Dirección", "Area", "Telefono", "NombreCompleto", "DescripcionOrganizacion", "DescripcionAportaciones", "Servicio",
				"Residencia", "Tesis", "Ponenecia", "Articulos", "Libros", "PropiedadesIntelectual", "otros", "Financiamiento", "Interno", "Externo", "Especificar", "Infraestructura", "Consumibles", "Licencias", "Viaticos", "Publicaciones",
				"Equipo", "Patentes", "Otros", "Especifique"];
	$folio = $_POST['folio_obs'];
	//echo "Convenio: ".$convenio;	
	//$sentencia = "UPDATE metas SET \"Servicio\" = '".$convenio."' WHERE \"FkFolioProyecto\" = 'PRE3';";
	//pg_query($conexion, $sentencia);
	//echo "Ejecutar: ".$sentencia;	
			//echo "<script>jQuerys(function(){swal(\"¡Guardado con éxito!\", \"Datos guardados correctamente\", \"success\");});</script>";*/
	switch ($accion) {            	

		case 'correcciones_form':
				$numCols= $_POST['numero_colaborador'];
				echo "Numero de colaborades: ". $numCols."\n";
				$cont =1;				
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

					$sqlI = "UPDATE colaboradordocente SET
							(\"Actividades\"= '".$activ."',
							\"Docente_noPersonal\"= ".$npersonal.",
							\"ap_paterno\"= '".$paterno."',
							\"ap_materno\"= '".$materno."',
							\"grado_max_estudios\"= '".$gradoMax."',
							\"celular\"= ".$cel.",
							\"correo_institucional\"= '".$correoI."',
							\"correo_alternativo\"= '".$correoA."',
							\"id_carrera\"= ".$carrera.",
							\"nombre\"= '".$nombre."' WHERE Proyecto_FolioProyecto ='".$folio."';";
					echo "Colaboradores: ".$sqlI."\n";	
					//pg_query($conexion, $sqlI);
					$cont= $cont+1;
				}
				$etapas=$_POST['numero_etapas'];
                for ($i=1; $i <= $etapas; $i++) 
                { 
                    $nombreEtapa=$_POST['nombreEtapa_'.$i];
                    $inicioEtapa=$_POST['inicioEtapa_'.$i];
                    $finEtapa=$_POST['finalEtapa_'.$i];
                    $mesesEtapa=$_POST['mesesEtapa_'.$i];
                    $descripcioEtapa=$_POST['descripcionEtapa_'.$i];
                    $metasEtapa=$_POST['metasEtapa_'.$i];
                    $actividadeEtapa=$_POST['actividadesEtapa_'.$i];
                    $productosEtapa=$_POST['productosEtapa_'.$i];
                    $sql="UPDATE etapas SET \"noEstapa\"= ".$i.", 
                    	\"NombreEtapa\"= '".$nombreEtapa."', \"FechaInicio\"= '".$inicioEtapa."', \"FechaFin\"= '".$finEtapa."', \"Meses\"= ".$mesesEtapa.", \"Descripcion\"= '".$descripcioEtapa."', \"Metas\"= '".$metasEtapa."', \"Actividades\"= '".$actividadeEtapa."', \"Productos\"= '".$productosEtapa."' WHERE FolioProyecto= '".$folio."';";
                    echo "Etapas: ".$sql."\n";
                    //$resultado=pg_query($conexion, $sql);
                }
                $alumnos=$_POST['numero_alumnos'];
            	for ($i=1; $i <= $alumnos ; $i++) 
            	{ 
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
            		$sql="UPDATE alumno SET \"NoControl\"= '".$noControl."', \"Semestre\"= ".$semestre.", \"Nombre\"= '".$nombreAlumno."', \"Paterno\"= '".$apPaterno."', \"Materno\"= '".$apMaterno."', \"Actividades\"= '".$actividades."', \"id_carrera\"= ".$carrera.", \"servicio\"= ".$servicio.", \"residencia\"= ".$residencia.", \"tesis\"= ".$tesis." WHERE Proyecto_FolioProyecto ='".$folio."';";
    				echo "Alumnos: ".$sql."\n";
            		//$sqlActEstado= "UPDATE \"proyecto\" SET \"idEstado\"=2 WHERE \"FolioProyecto\"='".$folio."';";
            		//$resultado2 = pg_query($conexion, $sqlActEstado);
            	}


				while ($cont<count($proyectoCadenas)){
					if(isset($_POST['proy'.$conta])){						
						$valores = $_POST['proy'.$conta];
					}
					if ($conta == 3){
						$sqlTipoInvestigacion = "SELECT id FROM tipoinvestigacion WHERE \"descripcion\"= '".$valores."';";
						$resultado = pg_query($conexion, $sqlTipoInvestigacion);
						$r = pg_fetch_array($resultado);
						$r = $r[0];
						$sql1 = "UPDATE ".$tablas[$contador]." SET "."\"".$proyectoCadenas[$cont]."\" = ".$r." WHERE \"FolioProyecto\" ='".$folio."';";
						//pg_query($conexion, $sql1);
						echo "SentenciaTipoI: ".$sql1."\n";
					}else if($conta == 4){
						$sqlTipoSector = "SELECT id FROM tiposector WHERE \"descripcion\"= '".$valores."';";
						$resultado = pg_query($conexion, $sqlTipoSector);
						$r = pg_fetch_array($resultado);
						$r = $r[0]; 
						$sql2 = "UPDATE ".$tablas[$contador]." SET "."\"".$proyectoCadenas[$cont]."\" = ".$r." WHERE \"FolioProyecto\" ='".$folio."';";						
						//pg_query($conexion, $sql2);
						echo "SentenciaTipoS: ".$sql2."\n";
					}else if($conta == 5){
						$sqlLineaInvestigacion = "SELECT id FROM lineainvestigacion WHERE \"descripcion\"= '".$valores."';";
						$resultado = pg_query($conexion, $sqlLineaInvestigacion);
						//$r = pg_fetch_array($resultado);
						$r = $r[0]; 
						$sql3 = "UPDATE ".$tablas[$contador]." SET "."\"".$proyectoCadenas[$cont]."\" = ".$r." WHERE \"FolioProyecto\" ='".$folio."';";						
						//pg_query($conexion, $sql3);
						echo "SentenciaLinea: ".$sql3."\n";

					}else{
						//echo "Proyecto: ".$conta." conta: ".$conta." valores: ".$valores;
						
						if($conta == 23){
							while ($conta<=30){
								if(!isset($_POST['proy'.$conta])){
									$sql = "UPDATE ".$tablas[$contador]." SET "."\"".$proyectoCadenas[$cont]."\" = 'f' WHERE \"FkFolioProyecto\" ='".$folio."';";
								}else if($conta== 29){
									$val = $_POST['proy'.$conta];
									$sql = "UPDATE ".$tablas[$contador]." SET "."\"".$proyectoCadenas[$cont]."\" = '".$val."' WHERE \"FkFolioProyecto\" ='".$folio."';";
								}else if($conta== 30){
									$val = $_POST['proy'.$conta];	
									$sql = "UPDATE ".$tablas[$contador]." SET "."\"".$proyectoCadenas[$cont]."\" = '".$val."' WHERE \"FkFolioProyecto\" ='".$folio."';";
								}else{
									$sql = "UPDATE ".$tablas[$contador]." SET "."\"".$proyectoCadenas[$cont]."\" = 't' WHERE \"FkFolioProyecto\" ='".$folio."';";
								}
								echo "Sentencia conta== ".$conta.": ".$sql."\n";
								$conta++;
								$cont++;
							}
							$conta--;
							$cont--;
						}else{
							if($conta == 32 || $conta == 33){
								if(!isset($_POST['proy'.$conta])){
									$sql = "UPDATE ".$tablas[$contador]." SET "."\"".$proyectoCadenas[$cont]."\" = 'f' WHERE \"FkFolioProyecto\" ='".$folio."';";
								}else{
									$sql = "UPDATE ".$tablas[$contador]." SET "."\"".$proyectoCadenas[$cont]."\" = 't' WHERE \"FkFolioProyecto\" ='".$folio."';";								
								}
							}else{
								$sql = "UPDATE ".$tablas[$contador]." SET "."\"".$proyectoCadenas[$cont]."\" = '".$valores."' WHERE \"FolioProyecto\" ='".$folio."';";
							}
							echo "Sentencia conta== ".$conta.": ".$sql."\n";
						}
						//pg_query($conexion, $sql);
					}	
					if($conta==15 || $conta== 22 || $conta == 30){
						$contador++;
					}
					$cont++;
					$conta++;
				}
				$sqlConsultarRevision = "SELECT \"NoRevision\" FROM proyecto WHERE \"FolioProyecto\"= '".$folio."';";				
        		echo "SQLU: ".$sqlConsultarRevision."\n";
				$result = pg_query($conexion, $sqlConsultarRevision);
        		$result = pg_fetch_array($result);
        		$revision  = $result[0]+1;
        		$sqlUpdateR = "UPDATE proyecto SET \"NoRevision\" = ".$revision." WHERE \"FolioProyecto\" = '".$folio."'";
        		echo "SQLU: ".$sqlUpdateR."\n";
        		//pg_query($conexion, $sqlUpdateR);
				$sqlUpdate = "UPDATE proyecto  SET \"idEstado\"= 5 WHERE \"FolioProyecto\"= '".$folio."'";
            	echo "SQLU: ".$sqlUpdate."\n";
            	//pg_query($conexion, $sqlUpdate);
					
			break;
			default: echo "XD";
			break;
		}	

 ?>