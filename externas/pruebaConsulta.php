<?php 
	include('conexion.php');
	if($_POST){
		$b = $_POST['accionar'];
		$cam1=$_POST['nombre'];
		$cam2=$_POST['apellido'];

		/*for ($i=0;$i<$consulta;$i++)
		{

			
			echo $row["first_field"];
		}*/

		$salidaJson=array('f1' => $cam1, 'f2' =>$cam2, 'btn' =>$b);
		echo json_encode($salidaJson);
		if($b=='insertar'){
			$sql = "INSERT INTO campos (first_field, second_field) VALUES ('".$cam1."', '".$cam2."')";
			return pg_query( $conexion, $sql );
		}
		if($b=='eliminar'){
			$sql = "DELETE FROM campos WHERE id>5";
			return pg_query( $conexion, $sql );
		}
		 echo "tu nombre es: ".$cam1."<br>"; 
    	 echo "tu apellido es: ".$cam2."<br>";
    	 echo "El botón es: ".$b;
	}
 ?>