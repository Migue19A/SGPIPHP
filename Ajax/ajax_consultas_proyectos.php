<?php 
	session_start();
	include('../externas/Clases/classConn.php');
	if (isset($_POST['accion']))
	{
		$accion = $_POST['accion'];
	}
	else
	{
		$accion=$_GET['accion'];
	}
	$miConn = new ClassConn();
	switch ($accion) {
		case 'consultarProyecto':
			$folio = $_POST['botonVer'];
			$consulta = "SELECT * FROM proyecto WHERE folio_proyecto='".$folio."';";
			$result = pg_query($miConn->conexion(), $consulta);
			echo json_encode($result);
		break;
		case 'login':
			$usuario=$_GET['usuario'];
			$password=$_GET['password'];
			$resultado=new stdClass;
			$sql='select "descripciontipo", "Descripcion", "NoPersonal", "Nombre", "ApellidoP", "ApellidoM", "Sexo", "CorreoInstitucional", "GradoMaximoEstudios", "TelefonoMovil", "Carrera_idCarrera","estado"
				from usuario as  us 
				left join docente as doc on us."NoPersonal"=doc."noPersonal"
				left join carrera as car on car."idCarrera"=doc."Carrera_idCarrera"
				left join tipoUsuario as tipUs on tipUs."idtipousuario"=us."tipoUsuario"
				where contrasenia=\''.$password.'\' and "NoPersonal"='.$usuario.';';
				// echo $sql;
			$resultados = pg_query($miConn->conexion(), $sql);
			$result=pg_fetch_array($resultados);
			if ($resultados && $result['NoPersonal']!=null) 
			{
				$_SESSION['NoPersonal']=$result['NoPersonal'];
				$_SESSION['TipoUsuario']=$result['descripciontipo'];
				$_SESSION['Carrera']=$result['Descripcion'];
				$_SESSION['Nombre']=$result['Nombre'];
				$_SESSION['ApPaterno']=$result['ApellidoP'];
				$_SESSION['ApMaterno']=$result['ApellidoM'];
				$_SESSION['Sexo']=$result['Sexo'];
				$_SESSION['Correo']=$result['CorreoInstitucional'];
				$_SESSION['Telefono']=$result['TelefonoMovil'];
				$_SESSION['GradEstudios']=$result['GradoMaximoEstudios'];
				$_SESSION['Estado']=$result['estado'];
				$resultado->resultado=1;
				$resultado->tipoUsuario=$result['descripciontipo'];
			}
			else
			{
				$resultado->resultado=0;
			}
			$resultado=json_encode($resultado, JSON_FORCE_OBJECT);
			echo $resultado;
			break;
		case 'cambiarEstadoUsuario':
			$usuario=$_GET['usuario'];
			$estado=$_GET['estado'];
			$resultado=new stdClass;
			$sql='UPDATE USUARIO SET "estado"='.$estado.' WHERE "NoPersonal"='.$usuario;
			$result = pg_query($miConn->conexion(), $sql);
			if ($result) {
				$resultado->resultado=1;
			}
			else
			{
				$resultado->resultado=0;
			}
			$resultado=json_encode($resultado, JSON_FORCE_OBJECT);
			echo $resultado;
		break;
		case 'altaUsuario': 
			$resultado=new stdClass;
			$nombre=$_POST['nombre'];
			$apPaterno=$_POST['apPaterno'];
			$apMaterno=$_POST['apMaterno'];
			$movil=$_POST['movil'];
			$correo=$_POST['correo'];
			$noPersonal=$_POST['noPersonal'];
			$gradoMax=$_POST['gradoMax'];
			$carrera=$_POST['carrera'];
			$sexo=$_POST['sexo'];
			$tipoUsu=$_POST['tipoUsu'];
			$password=$_POST['password'];
			$fechaNac=$_POST['fechaNac'];
			$sql='INSERT INTO usuario("NoPersonal","Nombre","ApellidoP","ApellidoM","FechaNacimiento","Sexo","CorreoInstitucional","contrasenia","tipoUsuario","estado") 
				values ('.$noPersonal.',\''.$nombre.'\',\''.$apPaterno.'\',\''.$apMaterno.'\',\''.$fechaNac.'\',\''.$sexo.'\',\''.$correo.'\',\''.$password.'\','.$tipoUsu.',1);';
			$sql.='INSERT INTO docente("noPersonal","GradoMaximoEstudios","TelefonoMovil","Carrera_idCarrera") values('.$noPersonal.','.$gradoMax.','.$movil.','.$carrera.');';
			$insertUsuario = pg_query($miConn->conexion(), $sql);
			if ($insertUsuario) {
				$resultado->resultado=1;
			}
			else
			{
				$resultado->resultado=0;
			}
			$resultado=json_encode($resultado, JSON_FORCE_OBJECT);
			echo $resultado;
		break;
		case 'editaUsuario':
			$resultado=new stdClass;
			$nombre=$_POST['nombre'];
			$apPaterno=$_POST['apPaterno'];
			$apMaterno=$_POST['apMaterno'];
			$movil=$_POST['movil'];
			$correo=$_POST['correo'];
			$noPersonal=$_POST['noPersonal'];
			$gradoMax=$_POST['gradoMax'];
			$carrera=$_POST['carrera'];
			$sexo=$_POST['sexo'];
			$tipoUsu=$_POST['tipoUsu'];
			$usuario=$_GET['usuario'];
			$sql='UPDATE usuario SET "NoPersonal"='.$noPersonal.', "Nombre"=\''.$nombre.'\', "ApellidoP"=\''.$apPaterno.'\', "ApellidoM"=\''.$apMaterno.'\',"Sexo"=\''.$sexo.'\', "CorreoInstitucional"=\''.$correo.'\', "tipoUsuario"='.$tipoUsu.' WHERE "NoPersonal"='.$usuario.';';
			$sql.='UPDATE docente SET "noPersonal"='.$noPersonal.', "GradoMaximoEstudios"='.$gradoMax.', "TelefonoMovil"='.$movil.', "Carrera_idCarrera"='.$carrera.' WHERE "noPersonal"='.$usuario.';';
			$insertUsuario = pg_query($miConn->conexion(), $sql);
			if ($insertUsuario) {
				$resultado->resultado=1;
			}
			else
			{
				$resultado->resultado=0;
			}
			$resultado=json_encode($resultado, JSON_FORCE_OBJECT);
			echo $resultado;
			break;
		default:
			# code...
			break;
	}
 ?>