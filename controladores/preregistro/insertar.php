<?php 
	include('../../externas/conexion.php');
	echo $_POST['accion'];
	$accion=$_POST['accion'];

	/*echo "Folio: ".$fp."<br>";
	echo "Fecha: ".$fpresent."<br>";
	echo "CPR: ".$ccpr."<br>";
	echo "TipoInv: ".$tipoInvest."<br>";
	echo "TipoSec".$tipoSec."<br>";
	echo "Especifique: ".$especific."<br>";
	echo "Checbox: ".$check."<br>";
	echo "Línea: ".$linea."<br>";
	echo "Nombre del proyecto: ".$nombreProy."<br>";
	echo "Inicio: ".$inicio."<br>";
	echo "Fin: ".$fin."<br>";
	echo "Botón: ".$boton."<br>";*/

	// if($boton=='recepcion'){

			/*if($resultado){				
				echo "<script>jQuery(function(){swal(\"¡Guardado con éxito!\", \"Datos guardados correctamente\", \"success\");});</script>";				
				//return $resultado;
			}*/
		// }
			
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
						$folio='PRE2';
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
				if($existe== "si"){
					$organizacion= $_POST['organizacion'];
					$direccion= $_POST['direccionV'];
					$area = $_POST['areaV'];
					$telefono = $_POST['telefonoV'];
					$contacto = $_POST['nombreV'];		
					$descripcion = $_POST['descripcionV'];			
				}

				break;
			case 'etapasForm':
				$etapas=$_POST['opcion_etapas'];
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
					$sql="INSERT INTO seguimiento_proy_etapas (id_etapa, nombre_etapa, fecha_inicio_etapa, fecha_fin_etapa, meses , descripcion_etapa, metas, actividades_etapa, productos) 
						VALUES(".$i.",'".$nombreEtapa."','".$inicioEtapa."','".$finEtapa."',".$mesesEtapa.",'".$descripcioEtapa."','".$metasEtapa."','".$actividadeEtapa."','".$productosEtapa."');";
					echo $sql;
					$resultado=pg_query($conexion, $sql);
				}
			break;


				default: echo "XD";;

				break;
		}	

 ?>