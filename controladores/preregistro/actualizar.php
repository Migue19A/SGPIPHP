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


					
			break;
			default: echo "XD";
			break;
		}	

 ?>