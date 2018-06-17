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
			case 'responsableForm':
				$apPaterno=$_POST['apellidoPatResp'];
				$apMaternoResponsable=$_POST['apellidoMaternoResp'];
				$nombre=$_POST['nombreResp'];
				$gradoMaximo=$_POST['gradoMaximoResp'];
				$academia=$_POST['academiaResp'];
				$numeroPersonal=$_POST['NumeroPersonalResp'];
				$movil=$_POST['movilResp'];
				$correoInst=$_POST['correoInstResp'];
				$correoAlt=$_POST['emailAltResp'];
				$actividades=$_POST['actividades_responsable'];
				$palabra1=$_POST['palabra_clave1'];
				$palabra2=$_POST['palabra_clave2'];
				$palabra3=$_POST['palabra_clave3'];
				$sql="INSERT INTO proyecto (id_responsable,actividades_responsable,palabra_clave1,palabra_clave2,palabra_clave3) values (1,'".$actividades."','".$palabra1."','".$palabra2."','".$palabra3."');";
				echo  $sql;
				$resultado=pg_query($conexion, $sql);
				break;
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
			default:
				# code...
				break;
		}	

 ?>