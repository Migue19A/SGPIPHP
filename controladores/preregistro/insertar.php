<?php 
	include('../../externas/conexion.php');
	$fp= $_POST['folio_proyecto'];
	$fpresent= $_POST['fecha_presentacion'];
	$ccpr = $_POST['clave_cpr'];
	$tipoInvest = $_POST['tipo_investigacion'];
	$tipoSec = $_POST['tipo_sector'];
	$especific = $_POST['especifique'];
	if(isset($_POST['tipoSector'])){
		$check=1;
	}else{
	  	$check=0;
	}
	$linea = $_POST['linea_investigacion'];
	$nombreProy = $_POST['nombre_proyecto'];
	$inicio = $_POST['fecha_inicio'];
	$fin = $_POST['fecha_fin'];
	$boton= $_POST['recepcion'];


	echo "Folio: ".$fp."<br>";
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
	echo "Botón: ".$boton."<br>";

	if($boton=='recepcion'){
		$sqlInsertar = "INSERT INTO proyecto(
			folio_proyecto,
			fecha_presentacion,
			convocatoria_CPR,
			inicio,
			fin,
			nombre_proyecto,
			lineaInvestigacion_id,
			tipoInvestigacion_id,
			tipoSector_id,
			especificar) VALUES (
			'".$fp."',
			'".$fpresent."',
			'".$ccpr."',
			'".$inicio."',
			'".$fin."',
			'".$nombreProy."',
			".$linea.",
			".$tipoInvest.",
			".$tipoSec.",
			'hola'
			);";

			echo $sqlInsertar;
			return pg_query($conexion, $sqlInsertar);
		}
			
			//echo "<script>jQuery(function(){swal(\"¡Guardado con éxito!\", \"Datos guardados correctamente\", \"success\");});</script>";*/
			

	



	

 ?>