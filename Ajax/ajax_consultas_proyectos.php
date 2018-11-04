<?php 
	session_start();
	include('../externas/Clases/classConn.php');
	include('../controladores/Clases/clase_consultas.php');
	// $accion = $_POST['accion'];
	$arrayC_nombre[] = array();
	$arrayC_paterno[] = array();
	$arrayC_materno[] = array();
	$arrayC_max_estudios[] = array();
	$arrayC_actividades[] = array();
	$arrayC_npersonal[] = array();
	$arrayC_movil[] = array();
	$arrayC_correo1[] = array();
	$arrayC_correo2[] = array();
	$arrayC_academia[] = array();
	$array_nombreEtapa[] = array();
	$array_inicioEtapa[] = array();
	$array_finEtapa[] = array();
	$array_mesesEtapa = array();
	$array_descripcionEtapa= array();
	$array_metasEtapa = array();
	$array_actividadesEtapa = array();
	$array_productosEtapa = array();
	$etapas_num = 0;
	$arrayA_nControl = array();
	$arrayA_semestre = array();
	$arrayA_nombre = array();
	$arrayA_paterno = array();
	$arrayA_materno = array();
	$arrayA_actividades = array();
	$arrayA_carrera = array();
	$arrayA_servicio = array();
	$arrayA_residencia = array();
	$arrayA_tesis = array();
	$arrayObsG = array();
	$arrayObsI = array();
	$arrayObsC = array();
	$numColaboradores= 0;

	if (isset($_POST['accion']))
	{
		$accion = $_POST['accion'];
	}
	else
	{
		$accion=$_GET['accion'];
	}
	$miConn = new ClassConn();
	$conex= new ClaseConsultas();
	switch ($accion) {
		case 'consultarColaborador':
			$numero_control = $_GET['noControl'];
			$colaborador = $conex->obtenerDocentesPre($numero_control);
			$json=array();		
			foreach($colaborador as $row){
	            $np = $row['NoPersonal'];
	            $nomb = $row['Nombre'];
	            $ap = $row['paterno'];
	            $am = $row['materno'];
	            $acad = $row['academia'];
	            $correo1 = $row['correo_inst'];
	            $max_esutudios = $row['maxEstudios'];
	            $cel = $row['celular'];          
			}			
	        $json=array("NoPersonal"=>$np, "Nombre"=>$nomb, "paterno"=>$ap, "materno"=>$am, "academia"=>$acad, "correo_inst"=>$correo1, "maxEstudios"=>$max_esutudios, "celular"=>$cel); 
			echo json_encode($json);
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
		case 'consultaProyectoRevision':
			$proyecto=$_GET['proyecto'];
			$sql='select proy."FechaPresentacion", proy."FolioProyecto", tipoInv."descripcion" descinv, tiposec."descripcion" tiposector, lineaInvest."descripcion" lineaInvestigacion, proy."NombreProyecto" nombreproyecto, proy."FechaPresentacion" fechapresentacion,
				recep."No.Solicitud" numerosolrecepcion, recep."FechaRecepcion" fechaRecep, 
				recep."NombreRecibio" nombrerecibio, usu."Nombre" nombreResponsable, 
				usu."ApellidoP" apellidoPatResponsable, usu."ApellidoM" apellidoMatResponsable,
				docente."GradoMaximoEstudios" gradoMaxEst, carr."Descripcion" carrdescr,
				docente."noPersonal" nopersonaldocproy,docente."TelefonoMovil" movil,
				usu."CorreoInstitucional" correodocenteresp,proy."actividadesResponsable" actresp,
				proy."PalabraClave1" palabra1, proy."PalabraClave2" palabra2, proy."PalabraClave3" palabra3,
				proy."ObjetivoGeneral" objgral,proy."ObjetivoEspecifico" objesp, proy."Resultados" res,
				vincul."NombreOrganizacion" nombreorg, vincul."Direccion" dirvinc, vincul."Area" areavinc,
				vincul."Telefono" telvinc, vincul."NombreCompleto" nombrecontvinc,
				vincul."DescripcionOrganizacion" descorgvinc, vincul."DescripcionAportaciones" descapvinc,
				metas."Servicio" metaserv, metas."Residencia" metares, metas."Tesis" metastesis,
				metas."Ponencia" metaspone, metas."Articulos" metasart, metas."Libros" metaslib,
				metas."PropiedadesIntelectual" metasprop, metas."Otros" metasotros,
				financ."Financiamiento" financiamiento, financ."Interno" financinter, financ."Externo" finanext,
				financ."Especificar" financesp, financ."Infraestructura" financinfraest, 
				financ."Consumibles" financons, financ."Licencias" finanlicen, financ."Viaticos" financviat,
				financ."Publicaciones" financpubl, financ."Equipo" finsncequipo, financ."Patentes" financpat,
				financ."Otros" financotros, financ."Especifique" financotrosesp
				from "proyecto" proy
				inner join "tipoinvestigacion" tipoInv on proy."TipoInvestigacion"=tipoInv."id"
				inner join "tiposector" tipoSec on tipoSec."id"=proy."TipoSector"
				inner join "lineainvestigacion" lineaInvest on lineaInvest."id"=proy."LineaInvestigacion"
				left join "recepcion" recep on recep."Proyecto_FolioProyecto"=proy."FolioProyecto"
				inner join "docente" docente on docente."noPersonal"=proy."Responsable"
				inner join "usuario" usu on usu."NoPersonal"=docente."noPersonal"
				inner join "vinculacion" vincul on vincul."FolioProyecto"=proy."FolioProyecto"
				inner join "metas" metas on metas."FkFolioProyecto"=proy."FolioProyecto"
				inner join "financiamientorequerido" financ on financ."FolioProyecto"=proy."FolioProyecto"
				inner join "carrera" carr on carr."idCarrera"=docente."Carrera_idCarrera"
				where proy."FolioProyecto"=\''.$proyecto.'\'';
			$resultados = pg_query($miConn->conexion(), $sql);
			$result=pg_fetch_array($resultados);
			$sql='select "FkNoControl","Semestre", "Nombre","Paterno", "Materno", "Actividades", al."servicio" servicio,
				al."tesis" tesis, carr."Descripcion",al."residencia" residencia
				from alumnoscolaboradoresdetalle as aldet
				inner join alumno as al on al."NoControl"=aldet."FkNoControl"
				inner join carrera carr on carr."idCarrera"=al."id_carrera"
				where "folioproyecto"=\''.$result['FolioProyecto'].'\'';
			$consulta = pg_query($miConn->conexion(), $sql);
			$json=array();
			$arregloConsulta=array();
			$alumnosCol=array();
			$i=0;
			while ($fila = pg_fetch_row($consulta)) 
			{ 
				$arregloConsulta[$i]=$fila;
				$i++;
			}
			$i=1;
			foreach ($arregloConsulta as $row) 
			{
				$Numero=$i;
				$NoControl=$row[0];
				$Semestre=$row[1];
				$Nombre=$row[2];
				$Paterno=$row[3];
				$Materno=$row[4];
				$Actividades=$row[5];
				$Servicio=$row[6];
				$Tesis=$row[7];
				$Carrera=$row[8];
				$Residencia=$row[9];
				$json=array("Numero"=>$Numero, "NoControl"=>$NoControl, "Semestre"=>$Semestre,"Nombre"=>$Nombre,"Paterno"=>$Paterno,"Materno"=>$Materno,"Actividades"=>$Actividades,"Servicio"=>$Servicio,"Tesis"=>$Tesis,"Carrera"=>$Carrera,"Residencia"=>$Residencia);
				array_push($alumnosCol,$json);
				$i++;
			}


			/*******************************************************************************/
			$sql='select "noEtapa","NombreEtapa","FechaInicio","FechaFin","Meses","Actividades","Descripcion","Metas","Productos" 
				from etapas 
				where "FolioProyecto"=\''.$result['FolioProyecto'].'\'';
			$consulta = pg_query($miConn->conexion(), $sql);
			$json=array();
			$arregloConsulta=array();
			$etapas=array();
			$i=0;
			while ($fila = pg_fetch_row($consulta)) 
			{ 
				$arregloConsulta[$i]=$fila;
				$i++;
			}
			$i=1;
			foreach ($arregloConsulta as $row) 
			{
				$Numero=$i;
				$NoEtapa=$row[0];
				$NombreEtapa=$row[1];
				$FechaInicio=$row[2];
				$FechaFin=$row[3];
				$Meses=$row[4];
				$Actividades=$row[5];
				$Descripcion=$row[6];
				$Metas=$row[7];
				$Productos=$row[8];
				$json=array("Numero"=>$Numero, "NoEtapa"=>$NoEtapa, "NombreEtapa"=>$NombreEtapa,"FechaInicio"=>$FechaInicio,"FechaFin"=>$FechaFin,"Meses"=>$Meses,"Actividades"=>$Actividades,"Descripcion"=>$Descripcion,"Metas"=>$Metas,"Productos"=>$Productos);
				array_push($etapas,$json);
				$i++;
			}
			/*******************************************************************************/

			$sql="select \"CatObservaciones_idObservaciones\", 
					\"ObservacionesGestion\", \"ObservacionesComite\"
					from observaciones 
					where \"Proyecto_FolioProyecto\" ='".$proyecto."'";
			$consulta = pg_query($miConn->conexion(), $sql);
			$json=array();
			$arregloConsulta=array();
			$obsCons=array();
			$i=0;
			while ($fila = pg_fetch_row($consulta)) 
			{ 
				$arregloConsulta[$i]=$fila;
				$i++;
			}
			$i=1;
			foreach ($arregloConsulta as $row) 
			{
				$Apartado=$row[0];
				$ObsGestion=$row[1];
				$ObsComite=$row[2];
				$json=array("Apartado"=>$Apartado, "ObsGestion"=>$ObsGestion,"ObsComite"=>$ObsComite);
				array_push($obsCons,$json);
				$i++;
			}
						/**************************************************************************/
			$sql='SELECT "Actividades","Docente_noPersonal","nombre","ap_paterno","ap_materno","grado_max_estudios","celular","correo_institucional","correo_alternativo","id_carrera", carr."Descripcion"
				FROM colaboradordocente 
				INNER JOIN carrera carr on carr."idCarrera"="id_carrera"
				WHERE "Proyecto_FolioProyecto"=\''.$result['FolioProyecto'].'\'';
			$consulta = pg_query($miConn->conexion(), $sql);
			$json=array();
			$arregloConsulta=array();
			$docenteColab=array();
			$i=0;
			while ($fila = pg_fetch_row($consulta)) 
			{ 
				$arregloConsulta[$i]=$fila;
				$i++;
			}
			$i=1;
			foreach ($arregloConsulta as $row) 
			{
				$Numero=$i;
				$Actividades=$row[0];
				$NoPersonal=$row[1];
				$Nombre=$row[2];
				$Paterno=$row[3];
				$Materno=$row[4];
				$GradMax=$row[5];
				$Celular=$row[6];
				$CorreoInst=$row[7];
				$CorreoPer=$row[8];
				$idCarrera=$row[9];
				$Carrera=$row[10];
				$json=array("Numero"=>$Numero, "Actividades"=>$Actividades, "NoPersonal"=>$NoPersonal,"Nombre"=>$Nombre,"Paterno"=>$Paterno,"Materno"=>$Materno,"GradMax"=>$GradMax,"Celular"=>$Celular,"CorreoInst"=>$CorreoInst,"CorreoPer"=>$CorreoPer,"idCarrera"=>$idCarrera,"Carrera"=>$Carrera);
				array_push($docenteColab,$json);
				$i++;
			}
			?>
			<div class="container" style="margin-top: 0;">
                <div class="col-lg-12 " style="margin-top: 10px;">
                    <div class="col-lg-8 well">
                        <div class="row">
                            <h3 class="text-center" id="inicioP" style="font-weight: bold;">
                                Proyecto
                            </h3>
                            <div class="col-lg-4 form-group">
                                <label>
                                    Fecha de presentación
                                </label>
                                <input class="form-control" name="fechaPresentacion" readonly="" type="date" id="fechaPresentacion" value="<?php echo $result['FechaPresentacion'] ?>">
                            </div>
                            <div class="col-lg-5 form-group">
                                <label>
                                    Convocatoria CPR
                                </label>
                                <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['FolioProyecto'] ?>">
                            </div>
                        </div>
                        <div class="row container col-lg-6">
                            <div class=" form-group">
                                <label>
                                    Tipo de investigación
                                </label>
                                <div class="">
                                    <input class="form-control" name="Aplicada" readonly="" type="text" value="<?php echo $result['descinv'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row container col-lg-6">
                            <div class="form-group">
                                <label>
                                    Tipo de Sector
                                </label>
                                <div class="">
                                    <input name="Aplicada" class="form-control" readonly="" type="text" value="<?php echo $result['tiposector'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-9">
                                    <label>
                                        Linea de investigación
                                    </label>
                                </div>
                                <div class="col-lg-9">
                                    <input name="01" class="form-control" readonly="" type="text" value="<?php echo $result['lineainvestigacion'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Nombre del proyecto
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['nombreproyecto']?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label>
                                        Duración:
                                    </label>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Inicio
                                    </label>
                                    <input class="form-control" name="" readonly="" type="date" value="<?php echo $result['fechapresentacion'] ?>">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Fin
                                    </label>
                                    <input class="form-control" name="" readonly="" type="date">
                                </div>
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="text-center" id="recep" style="font-weight: bold;">
                                    Recepción
                                </h3>
                                <div class="col-lg-5 form-group">
                                    <label>
                                        Numero de Recepción
                                    </label>
                                    <input class="form-control" value="<?php echo $result['numerosolrecepcion'] ?>" readonly="" type="text">
                                </div>
                                <div class="col-lg-5 form-group">
                                    <label>
                                        Fecha de Recepción
                                    </label>
                                    <input class="form-control" value="<?php echo $result['fechaRecep'] ?>" readonly="" type="date">
                                </div>
                                <div class="col-lg-9" style="text-align: left;">
                                    <label>
                                        Recibió
                                    </label>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Nombre(s)
                                    </label>
                                    <input class="form-control" value="<?php echo $result['nombrerecibio'] ?>" readonly="" type="text">
                                  
                                </div>
                                <div class="col-lg-5 form-group">
                                    <label>
                                        Firma
                                    </label>
                                    <input class="form-control" readonly="" type="text">
                                
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        Sello
                                    </label>
                                    <input class="form-control" readonly="" style="height: 150px" type="text">
                                   
                                </div>
                            </div>
                            <div class="col-lg-12" style="background:#000">
                            </div>
                            <div class="row">
                                <h3 class="text-center" style="font-weight: bold;">
                                    Responsable
                                </h3>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Apellido paterno
                                    </label>
                                    <input class="form-control" value="<?php echo $result['apellidopatresponsable'] ?>" readonly="" type="text">
                                
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Apellido materno
                                    </label>
                                    <input class="form-control" value="<?php echo $result['apellidomatresponsable'] ?>" readonly="" type="text">
                                  
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Nombre(s)
                                    </label>
                                    <input class="form-control" value="<?php echo $result['nombreresponsable'] ?>" readonly="" type="text">
                                 
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>
                                        Grado máximo de estudios:
                                    </label>
                                    <input class="form-control" readonly="" style="width:100%;" type="text" value="<?php echo $result['gradomaxest'] ?>">
                                 
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>
                                        Academia a la que pertenece
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $result['carrdescr'] ?>">
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        No. de personal
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $result['nopersonaldocproy'] ?>">
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        Móvil
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $result['movil'] ?>" >
                                </div>
                                <div class="col-lg-3" form-group="">
                                    <label>
                                        Correo institucional
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $result['correodocenteresp'] ?>">
                                </div>
                                <div class="col-lg-4" form-group="">
                                    <label>
                                        Correo alternativo
                                    </label>
                                    <input class="form-control" readonly="" type="text">
                                </div>
                                <div class="col-lg-12" form-group="">
                                    <label>
                                        Firma del responsable del proyecto
                                    </label>
                                    <input class="form-control" readonly="" type="text">
                                    
                                </div>
                                <div class="col-lg-12" form-group="">
                                    <label>
                                        Descripción de las principales actividades a desarrollar en el proyecto
                                    </label>
                                </div>
                                <div class="col-lg-12" form-group="">
                                    <input class="form-control" readonly="" style="height: 150px;" tabindex="4" type="text" value="<?php echo $result['actresp'] ?>">
                           
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        Palabras clave:
                                    </label>
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        (1)
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['palabra1'] ?>">
                              
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        (2)
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['palabra2'] ?>">
                                   
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        (3)
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['palabra3'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                            <?php 
                            foreach ($docenteColab as $row) {
                        	?>
                        	<h3 class="text-center" id="colab1" style="font-weight: bold;">
                                Colaborador <?php echo $row['Numero'] ?>
                            </h3>
                            <div class="row">
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Apellido paterno
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $row['Paterno'] ?>">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Apellido materno
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $row['Materno'] ?>">
                                   
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Nombre(s)
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $row['Nombre'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>
                                    Grado máximo de estudios
                                </label>
                                <input class="form-control" readonly="" type="text" value="<?php echo $row['GradMax'] ?>">
                            </div>
                            <div class="col-lg-8 form-group">
                                <label>
                                    Academia a la que pertenece
                                </label>
                                <input class="form-control" readonly="" type="text" value="<?php echo $row['Carrera'] ?>">
                            </div>
                            <div class="col-lg-2 form-group">
                                <label>
                                    N°. personal
                                </label>
                                <input class="form-control" readonly="" type="text" value="<?php echo $row['NoPersonal'] ?>">
                            </div>
                            <div class="col-lg-3 form-group">
                                <label>
                                    Móvil
                                </label>
                                <input class="form-control" pattern="^\d{10}$" readonly="" type="text" value="<?php echo $row['Celular'] ?>">
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>
                                    Correo institucional
                                </label>
                                <input class="form-control" readonly="" type="email" value="<?php echo $row['CorreoInst'] ?>">
                            </div>
                            <div class="col-lg-3 form-group">
                                <label>
                                    Correo alternativo
                                </label>
                                <input class="form-control" readonly="" type="text" value="<?php echo $row['CorreoPer'] ?>">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label>
                                    Firma del responsable
                                </label>
                                <input class="form-control" readonly="" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label>
                                    Descripción de las principales actividades a desarrollar en el proyecto
                                </label>
                                <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $row['Actividades'] ?>
                                </textarea>
                            </div>
                          	<?php
                            }
                            ?>
                            <div class="row">
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="text-center" id="objetivos" style="font-weight: bold;">
                                    Objetivos
                                </h3>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Indique el objetivo general(No más de 512 caracteres)
                                    </label>
                                    <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $result['objgral'] ?>
                                    </textarea>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Establezca los objetivos específicos, científicos y tecnológicos subyacentes en el proyecto(No más de 512 caracteres)
                                    </label>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $result['objesp'] ?>
                                    </textarea>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Indique los resultados esperados en términos concretos(No más de 512 Caracteres)
                                    </label>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $result['res'] ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="text-center" id="vinculacion" style="font-weight: bold;">
                                    Vinculación
                                </h3>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Existe convenio:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Si
                                    </label>
                                    <input name="" readonly="" type="checkbox">
                                    
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        No
                                    </label>
                                    <input name="" readonly="" type="checkbox">
                                   
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Nombre de la organización
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['nombreorg'] ?>">
                                    
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Dirección
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['dirvinc'] ?>">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Área
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['areavinc'] ?>">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Teléfono
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['telvinc'] ?>">
                                    
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Nombre del contacto
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['nombrecontvinc'] ?>">
                                    
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Descripción de la organización(No más de 256 caracteres)
                                    </label>
                                    <textarea class="form-control" name="" readonly="" rows="5" style="resize:none;"><?php echo $result['descorgvinc'] ?>
                                    </textarea>
                                </div>
                                <div class="col-lg-7 form-group">
                                    <label>
                                        Existen aportaciones financieras o en especie de la vinculación:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Si
                                    </label>
                                    <input name="" readonly="" type="checkbox">
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        No
                                    </label>
                                    <input name="" readonly="" type="checkbox">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Si la respuesta es si, describa cuales son(No más de 256 caracteres)
                                    </label>
                                    <textarea class="form-control" name="" readonly="" rows="5" style="resize:none;"><?php echo $result['descapvinc'] ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="text-center" id="metas" style="font-weight: bold;">
                                    Productos academicos
                                </h3>
                                <div class="col-lg-3 form-group">
                                    <input class="form-group" name="" disabled style="margin-left: 18px;" type="checkbox" <?php if ($result['metaserv']==true){?>checked <?php } ?>>
                                        <label>
                                            Servicio social
                                        </label>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if ($result['metares']==true){?>checked <?php } ?>>
                                        <label>
                                            Residencia profesional
                                        </label>
                                   
                                </div>
                                <div class="col-lg-3 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if ($result['metastesis']==true){?>checked <?php } ?>>
                                        <label>
                                            Tesis
                                        </label>
                                 
                                </div>
                                <div class="col-lg-12 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if ($result['metaspone']==true){?>checked <?php } ?>>
                                        <label>
                                            Ponencias/Conferencias
                                        </label>
                                 
                                </div>
                                <div class="col-lg-12 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if ($result['metasart']==true){?>checked <?php } ?>>
                                        <label>
                                            Artículos
                                        </label>
                              
                                </div>
                                <div class="col-lg-12 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if ($result['metaslib']==true){?>checked <?php } ?>>
                                        <label>
                                            Libros/Manuales
                                        </label>
                                  
                                </div>
                                <div class="col-lg-3 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if (isset($result['metasprop'])){?>checked <?php } ?>>
                                        <label>
                                            Propiedad intelectual
                                        </label>
                           
                                </div>
                                <div class="col-lg-1">
                                    <label>
                                        Especificar:
                                    </label>
                                </div>
                                <div class="col-lg-7 form-group">
                                    <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text" value="<?php echo $result['metasprop'] ?>">
                               
                                </div>
                                <div class="col-lg-3 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if (isset($result['metasotros'])){?>checked <?php } ?>>
                                        <label>
                                            Otros
                                        </label>
                                 
                                </div>
                                <div class="col-lg-1">
                                    <label>
                                        Especificar:
                                    </label>
                                </div>
                                <div class="col-lg-7 form-group">
                                    <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text" value="<?php echo $result['metasotros'] ?>">
                                
                                </div>
                                <div class="row">
                                    <div class="col-lg-12" style="background:#000">
                                    </div>
                                </div>
                                <?php foreach ($etapas as $etapa) {
                                	?>
                                <h1 class="text-center" id="etapa1" style="font-weight: Yu Gothic UI Light; margin-top: 2px">
                                    Etapa <?php echo $etapa['Numero'] ?>
                                </h1>
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <label>
                                            Nombre de la etapa:
                                        </label>
                                        <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text" value="<?php echo $etapa['NombreEtapa'] ?>">
                                    </div>                                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 form-group">
                                        <label>
                                            Fecha de inicio:
                                        </label>
                                        <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="date" value="<?php echo $etapa['FechaInicio'] ?>">
                                    </div>
                                    
                                    <div class="col-lg-4 form-group">
                                        <label>
                                            Fecha de fin:
                                        </label>
                                        <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="date" value="<?php echo $etapa['FechaFin'] ?>">
                                    </div>
                                    
                                    <div class="col-lg-4 form-group">
                                        <label>
                                            Total de meses:
                                        </label>
                                        <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text" value="<?php echo $etapa['Meses'] ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <label>
                                            Descripción
                                        </label>
                                        <input class="form-control" name="" readonly="" type="text" value="<?php echo $etapa['Descripcion'] ?>">
                                    </div>                                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 form-group">
                                        <label>
                                            Metas
                                        </label>
                                    </div>
                                    <div class="col-lg-10 form-group">
                                        <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $etapa['Metas'] ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 form-group">
                                        <label>
                                            Actividades
                                        </label>
                                    </div>
                                    <div class="col-lg-10 form-group">
                                        <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $etapa['Descripcion'] ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 form-group">
                                        <label>
                                            Productos
                                        </label>
                                    </div>
                                    <div class="col-lg-10 form-group">
                                        <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $etapa['Productos'] ?>
                                        </textarea>
                                    </div>
                                </div>
                                	<?php
                                } ?>
                                <div class="row">
                                    <div class="col-lg-12" style="background:#000">
                                    </div>
                                </div>
                                <h3 class="text-center" id="financ" style="font-weight: bold; margin-bottom: 9px;">
                                    Financiamiento requerido
                                </h3>
                                <div class="row">
                                    <div class="col-lg-5 form-group">
                                        <label>
                                            ¿Existe actualmente algún financiamiento del proyecto?
                                        </label>
                                    </div>
                                    <div class="col-lg-2 form-group">
                                        <label>
                                            Si
                                        </label>
                                        <input name="" readonly="" type="checkbox" <?php if ($result['financiamiento']==true){?>checked <?php }?> >
                                    </div>
                                    <div class="col-lg-2 form-group">
                                        <label>
                                            No
                                        </label>
                                        <input name="" readonly="" type="checkbox" <?php if ($result['financiamiento']==false){?>checked <?php }?> >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5>
                                            En caso de que la respuesta sea sí
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Interno
                                    </label>
                                    <input name="" readonly="" type="checkbox"<?php if ($result['financinter']==true){?>checked <?php }?> >
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Externo
                                    </label>
                                    <input name="" readonly="" type="checkbox" <?php if ($result['finanext']==true){?>checked <?php }?>>
                                
                                </div>
                                <div class="col-lg-1 form-group">
                                    <label>
                                        Especificar:
                                    </label>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text" value="<?php echo $result['financesp'] ?>">
                                  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>
                                        En caso de que la respuesta sea no desglose($)
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Infraestructura:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financinfraest'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Consumibles:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financons'] ?>">
                             
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Licencias:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['finanlicen'] ?>">
                           
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Viáticos:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financviat'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Publicaciones:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financpubl'] ?>">
                                
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Equipo:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['finsncequipo'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Patentes/derechos de autor:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financpat'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Otros(Especifique):
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financotrosesp'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Total:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                             <div class="row">
                                <?php foreach ($alumnosCol as $row) {
                                ?>
                                <div class="col-lg-12">
                                    <h5>
                                        <b>
                                            *
                                        </b>
                                        S.S.= Servicio Social, R.P.= Residencia Profesional, T= Tesis
                                    </h5>
                                    <h3 class="text-center" id="alumnos" style="font-weight: bold; margin-bottom: 9px;">
                                        Alumno colaborador <?php echo $row['Numero'] ?>
                                    </h3>
                                    <div class="row">
                                        <div class="col-lg-6 form-group">
                                            <label>
                                                Nombre del Alumno
                                            </label>
                                            <input class="form-control" name="" type="text" value="<?php echo $row['Nombre'].' '.$row['Paterno'].' '.$row['Materno']?>" disabled>
                                        </div>                                                        
                                        <div class="col-lg-2 form-group" style="margin-top: 30px;">
                                            <label>
                                                S.S.
                                            </label>
                                            <input class="form-group" name="" type="checkbox" <?php if ($row['Servicio']==true) {?>checked <?php }?> >
                                        </div>
                                        <div class="col-lg-2 form-group" style="margin-top: 30px;">
                                            <label>
                                                R.P.
                                            </label>
                                            <input class="form-group" name="" type="checkbox" <?php if ($row['Residencia']==true) {?>checked <?php }?> >
                                      
                                        </div>
                                        <div class="col-lg-2 form-group" style="margin-top: 30px;">
                                            <label>
                                                T
                                            </label>
                                            <input class="form-group" name="" type="checkbox" <?php if ($row['Tesis']==true) {?>checked <?php }?> >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 form-group">
                                            <label>
                                                No. control
                                            </label>
                                            <input class="form-control" name="" readonly="" type="text" value="<?php echo $row['NoControl'] ?>">
                                        </div>                                                        
                                        <div class="col-lg-4 form-group">
                                            <label>
                                                Semestre:
                                            </label>
                                             <input class="form-control" name="" readonly="" type="text" value="<?php echo $row['Semestre'] ?>">
                                        </div>                                                        
                                        <div class="col-lg-4 form-group">
                                            <label>
                                                Carrera
                                            </label>
                                            <input class="form-control" name="" readonly="" type="text" value="<?php echo $row['Carrera'] ?>">
                                        </div>
                                        
                                        <div class=" col-lg-12 form-group">
                                            <label>
                                                Detalle de actividades
                                            </label>
                                            <textarea class="form-control" readonly="" rows="3" style="resize:none;"><?php echo $row['Actividades'] ?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div> 
                                <?php 	
                                } ?>
                            </div>
                        </div>
                    </div>
		            <div class="col-lg-4" role="complementary">
		                <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
		                    <ul class="nav bs-docs-sidenav">
		                        <div class="container" id="navObserv">
		                        	<input type="hidden" id="folio" name="folio" value="<?php echo $result['FolioProyecto']; ?>">
		                            <h3>
		                                Observaciones
		                            </h3>
		                            <div class="panel panel-primary panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                Realizar Observaciones
                                            </h5>
                                            <span class="pull-right clickable panel-collapsed">
                                                <i class="glyphicon glyphicon-chevron-down">
                                                </i>
                                            </span>
                                        </div>
                                        <form action="" method="POST" id="formObsInvest">
                                        <input type="hidden" value="<?php echo $result['FolioProyecto'] ?>" name="folio" id="folio" >
                                        <div class="panel-body" style="display: none;">
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#inicioP" style="color: #337ab7">
                                                    Proyecto
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" id="obs_proyecto" name="obs_proyecto" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#recep" style="color: #337ab7">
                                                    Recepción
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_recepcion" id="obs_recepcion" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#colab1" style="color: #337ab7">
                                                    Colaboradores
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_colaboradores" id="obs_colaboradores" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#objetivos" style="color: #337ab7">
                                                    Objetivos
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_objetivos" id="obs_objetivos" rows="5" style="resize:none"></textarea>
                                                    
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#vinculacion" style="color: #337ab7">
                                                    Vinculación
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" id="obs_vinculacion" name="obs_vinculacion" rows="5" style="resize:none"></textarea>
                                                    
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#metas" style="color: #337ab7">
                                                    Metas
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_metas" id="obs_metas" rows="5" style="resize:none"></textarea>
                                                    
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#etapa1" style="color: #337ab7">
                                                    Etapas
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_etapas" id="obs_etapas" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#financ" style="color: #337ab7">
                                                    Financiamiento
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_financiamiento" id="obs_financiamiento" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#al1" style="color: #337ab7">
                                                    Alumnos
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_alumnos" id="obs_alumnos" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                        </form>
                                        </div>
                                    </div>
		                            <div class="panel panel-primary panel-default" id="navObserv">
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
		                                    <form id="obs-Gest" method="_POST">
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#inicioP" style="color: #337ab7">
		                                            Proyecto
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" name="obs_proyecto" id="obs_proyecto" rows="5" style="resize:none"><?php echo $obsCons[0]['ObsGestion']?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#recep" style="color: #337ab7">
		                                            Recepción
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_recepcion" name="obs_recepcion" rows="5" style="resize:none"><?php echo $obsCons[1]['ObsGestion']?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#colab1" style="color: #337ab7">
		                                            Colaboradores
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_colaboradores" name="obs_colaboradores" rows="5" style="resize:none"><?php echo $obsCons[2]['ObsGestion']?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#objetivos" style="color: #337ab7">
		                                            Objetivos
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_objetivos" name="obs_objetivos" rows="5" style="resize:none"><?php echo $obsCons[3]['ObsGestion']?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#vinculacion" style="color: #337ab7">
		                                            Vinculación
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_vinculacion" name="obs_vinculacion" rows="5" style="resize:none"><?php echo $obsCons[4]['ObsGestion']?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#metas" style="color: #337ab7">
		                                            Metas
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_metas" name="obs_metas" rows="5" style="resize:none"><?php echo $obsCons[5]['ObsGestion']?></textarea>
		                                            
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#etapa1" style="color: #337ab7">
		                                            Etapas
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_etapas" name="obs_etapas" rows="5" style="resize:none"><?php echo $obsCons[6]['ObsGestion']?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#financ" style="color: #337ab7">
		                                            Financiamiento
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_financiamiento" name="obs_financiamiento" rows="5" style="resize:none"><?php echo $obsCons[7]['ObsGestion']?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#al1" style="color: #337ab7">
		                                            Alumnos
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_alumnos" name="obs_alumnos" rows="5" style="resize:none"><?php echo $obsCons[8]['ObsGestion']?></textarea>
		                                        </div>
		                                    </li>
		                                </div>
		                            	</form>
		                            </div>
		                            <div class="panel panel-primary panel-default" id="navObserv">
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
		                                    <form id="obs-Com" method="_POST">
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#inicioP" style="color: #337ab7">
		                                            Proyecto
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" name="obsComiteProy" id="obsComiteProy" rows="5" style="resize:none"><?php echo $obsCons[0]['ObsComite']?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#recep" style="color: #337ab7">
		                                            Recepción
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteRecep" name="obsComiteRecep" rows="5" style="resize:none"><?php echo $obsCons[1]['ObsComite']?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#colab1" style="color: #337ab7">
		                                            Colaboradores
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteColab" name="obsComiteColab" rows="5" style="resize:none"><?php echo $obsCons[2]['ObsComite']?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#objetivos" style="color: #337ab7">
		                                            Objetivos
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteObj" name="obsComiteObj" rows="5" style="resize:none"><?php echo $obsCons[3]['ObsComite']?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#vinculacion" style="color: #337ab7">
		                                            Vinculación
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteVinc" name="obsComiteVinc" rows="5" style="resize:none"><?php echo $obsCons[4]['ObsComite']?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#metas" style="color: #337ab7">
		                                            Metas
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteMetas" name="obsComiteMetas" rows="5" style="resize:none"><?php echo $obsCons[5]['ObsComite']?></textarea>
		                                            
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#etapa1" style="color: #337ab7">
		                                            Etapas
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteEtapas" name="obsComiteEtapas" rows="5" style="resize:none"><?php echo $obsCons[6]['ObsComite']?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#financ" style="color: #337ab7">
		                                            Financiamiento
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteFinanc" name="obsComiteFinanc" rows="5" style="resize:none"><?php echo $obsCons[7]['ObsComite']?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#al1" style="color: #337ab7">
		                                            Alumnos
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteAlumnos" name="obsComiteAlumnos" rows="5" style="resize:none"><?php echo $obsCons[8]['ObsComite']?></textarea>
		                                        </div>
		                                    </li>
		                                </div>
		                            </form>
		                            </div>
		                            <li class="">
                                        <a href="#" onclick="guardarObservaciones(4)">
                                            Aceptar Proyecto
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#" onclick="guardarObservaciones(5)">
                                            Rechazar Proyecto
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#" onclick="guardarObservaciones(1)">
                                            Regresar por correcciones
                                        </a>
                                    </li>
                                    <li class="">
                                        <a data-dismiss="modal" href="" onclick="guardarObservaciones(6)">
                                            Enviar revisión a Consejo de Investigación
                                        </a>
                                    </li>
		                            <li class="">
		                                <a data-dismiss="modal" href="">
		                                    Cerrar
		                                </a>
		                            </li>
		                        </div>
		                    </ul>
		                </nav>
		            </div>
        		</div>
            </div>
			<?php
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
		case 'consultarProyecto':
			$folio = $_POST['botonVer'];
			$consulta = "SELECT * FROM proyecto WHERE \"FolioProyecto\"='".$folio."';";
			$result = pg_query($miConn->conexion(), $consulta);
			$result = pg_fetch_array($result);
			$tipoInvestigacion = $result['TipoInvestigacion'];
			$consultaTipoInvestigacion = "SELECT descripcion FROM tipoInvestigacion WHERE id =".$tipoInvestigacion.";";
			$result2 = pg_query($miConn->conexion(), $consultaTipoInvestigacion);
			$result2= pg_fetch_array($result2);

			$tipoSector = $result['TipoSector'];
			$consultaTipoSector = "SELECT descripcion FROM tiposector WHERE id =".$tipoSector.";";
			$result3 = pg_query($miConn->conexion(), $consultaTipoSector);
			$result3= pg_fetch_array($result3);
			if($result3[0]== "Otro"){
				$tipoSect= $result['Especificar'];
			}else{
				$tipoSect= $result3[0];
			}

			$LineaInv = $result['LineaInvestigacion'];
			$consultaLineaInvestigacion = "SELECT descripcion FROM lineainvestigacion WHERE id =".$LineaInv.";";
			$result4 = pg_query($miConn->conexion(), $consultaLineaInvestigacion);
			$result4= pg_fetch_array($result4);

			$nombre = strtoupper($result['NombreProyecto']);
			$consulta2 = "SELECT COUNT(\"Docente_noPersonal\") FROM colaboradordocente WHERE \"Proyecto_FolioProyecto\"='".$folio."';";
			$consulta3 = "SELECT nombre, ap_paterno, ap_materno, grado_max_estudios, \"Actividades\", \"Docente_noPersonal\", celular, \"correo_institucional\", \"correo_alternativo\", \"Descripcion\" academia FROM colaboradordocente INNER JOIN carrera ON id_carrera= \"idCarrera\" 
				WHERE \"Proyecto_FolioProyecto\"='".$folio."' ORDER BY \"ap_paterno\";"; 
			$consulta4 = "SELECT \"ObjetivoGeneral\", \"ObjetivoEspecifico\", \"Resultados\" FROM proyecto WHERE \"FolioProyecto\"='".$folio."';";	
			$consulta5 = "SELECT COUNT(\"FolioProyecto\") consecutivo, \"NombreOrganizacion\", \"Dirección\", \"Area\", \"DescripcionOrganizacion\", \"DescripcionAportaciones\", \"Telefono\", \"NombreCompleto\" FROM vinculacion WHERE \"FolioProyecto\"='".$folio."' GROUP BY \"NombreOrganizacion\", \"Dirección\", \"Area\", 
			\"DescripcionOrganizacion\", \"DescripcionAportaciones\", \"Telefono\", \"NombreCompleto\";";
			$consulta6 = "SELECT \"Servicio\", \"Residencia\", \"Tesis\", \"Ponencia\", \"Articulos\", \"Libros\", \"PropiedadesIntelectual\", \"Otros\" FROM metas 
						  WHERE \"FkFolioProyecto\" = '".$folio."';";
			$consulta7 = "SELECT COUNT(\"PkEtapas\") cons, \"NombreEtapa\", \"noEtapa\", \"FechaInicio\", \"FechaFin\", \"Meses\", \"Descripcion\", \"Metas\", \"Actividades\", \"Productos\" FROM etapas WHERE \"FolioProyecto\" = '".$folio."' GROUP BY \"NombreEtapa\", \"noEtapa\", \"FechaInicio\", \"FechaFin\", \"Meses\", \"Descripcion\", \"Metas\", \"Actividades\", \"Productos\";";

			$consulta8 = "SELECT \"Financiamiento\", \"Interno\", \"Externo\", \"Especificar\", \"Infraestructura\", \"Consumibles\", \"Licencias\", \"Viaticos\", \"Publicaciones\", \"Equipo\", \"Patentes\", \"Otros\", \"Especifique\" 
				FROM financiamientorequerido WHERE \"FolioProyecto\" = '".$folio."';"; 
			$consulta9 = "SELECT \"NoControl\", \"Semestre\", \"Nombre\", \"Paterno\", \"Materno\", 
				\"Descripcion\" carrera, \"Actividades\", \"servicio\", \"residencia\", \"tesis\" FROM alumno INNER JOIN carrera ON \"id_carrera\"= \"idCarrera\" WHERE \"Folio_proyecto\" ='".$folio."' ORDER BY \"Paterno\";";		
			$consulta10 = "SELECT COUNT(\"Folio_proyecto\") FROM alumno WHERE \"Folio_proyecto\"= '".$folio."';";	  
			$consulta11 = "SELECT \"ObservacionesGestion\", \"ObservacionesInvestigacion\", \"ObservacionesComite\" FROM \"observaciones\" WHERE \"Proyecto_FolioProyecto\" = '".$folio."';";
			//echo "Consulta9: ".$user;
			$result5 = pg_query($miConn->conexion(), $consulta2);
			$result5 = pg_fetch_array($result5);			
			$result6 = pg_query($miConn->conexion(), $consulta3);
			$result7 = pg_query($miConn->conexion(), $consulta4);
			$result7 = pg_fetch_array($result7);
			$result8 = pg_query($miConn->conexion(), $consulta5);
			$result8 = pg_fetch_array($result8);
			$result9 = pg_query($miConn->conexion(), $consulta6);
			$result9 = pg_fetch_array($result9);
			$result10 = pg_query($miConn->conexion(), $consulta7);
			$result11 = pg_query($miConn->conexion(), $consulta8);
			$result11 = pg_fetch_array($result11);
			$result12 = pg_query($miConn->conexion(), $consulta9);
			$result12B = pg_query($miConn->conexion(), $consulta10);
			$result12B = pg_fetch_array($result12B);
			$resultObs = pg_query($miConn->conexion(), $consulta11);
			while ($r = pg_fetch_array($result6)){
				$arrayC_nombre[]=  $r['nombre'];
				$arrayC_paterno[]=  $r['ap_paterno'];
				$arrayC_materno[]=  $r['ap_materno'];
				$arrayC_max_estudios[] = $r['grado_max_estudios'];				
				$arrayC_actividades[] = $r['Actividades'];
				$arrayC_npersonal[] = $r['Docente_noPersonal'];
				$arrayC_movil[] = $r['celular'];
				$arrayC_correo1[] = $r['correo_institucional'];
				$arrayC_correo2[] = $r['correo_alternativo'];
				$arrayC_academia[] = $r['academia'];
			}

			while ($row = pg_fetch_array($result10)){
				$array_nombreEtapa[] = $row['NombreEtapa'];
				$array_inicioEtapa[] = $row['FechaInicio'];
				$array_finEtapa[] = $row['FechaFin'];
				$array_mesesEtapa[] = $row['Meses'];
				$array_descripcionEtapa[] = $row['Descripcion'];
				$array_metasEtapa[] = $row['Metas'];
				$array_actividadesEtapa[] = $row['Actividades'];
				$array_productosEtapa[] = $row['Productos'];
				$etapas_num = $row['noEtapa'];

			}

			while ($fila = pg_fetch_array($result12)){
				$arrayA_nControl[] = $fila['NoControl'];
				$arrayA_semestre[] = $fila['Semestre'];
				$arrayA_nombre[] = $fila['Nombre'];
				$arrayA_paterno[] = $fila['Paterno'];
				$arrayA_materno[] = $fila['Materno'];
				$arrayA_actividades[] = $fila['Actividades'];
				$arrayA_carrera[] = $fila['carrera'];
				$arrayA_servicio[] = $fila['servicio'];
				$arrayA_residencia[] = $fila['residencia'];
				$arrayA_tesis[] =$fila['tesis'];
			}

			while ($record = pg_fetch_array($resultObs)){
				$arrayObsG[] = $record['ObservacionesGestion'];
				$arrayObsI[] = $record['ObservacionesInvestigacion'];
				$arrayObsC[] = $record['ObservacionesComite'];
			}

			//$result10 = pg_fetch_array($result10);
			//echo 'Versión actual de PHP: ' . phpversion();			
			$salida = array(
				"fechap" => $result['FechaPresentacion'],
				"cpr" => $result['ConvocatoriaCPR'],
				"tipoI" =>  $result2[0],
				"tipoS" => $tipoSect,
				"linea" => $result4[0],
				"nombre_p" => $nombre,
				"fechaI" => $result['Inicio'],
				"fechaF" => $result['Fin'],
				"actividadesR" => $result['actividadesResponsable'],
				"palabraClave1" => $result['PalabraClave1'],
				"palabraClave2" => $result['PalabraClave2'],
				"palabraClave3" => $result['PalabraClave3'],
				"prueba" => $result5[0],
				"nombre_colaborador" => $arrayC_nombre,
				"paterno_colaborador" => $arrayC_paterno,
				"materno_colaborador" => $arrayC_materno,
				"maxE_colaborador" => $arrayC_max_estudios,
				"actividades_colaborador" => $arrayC_actividades,
				"npersonal_colaborador" => $arrayC_npersonal,
				"movil_colaborador" => $arrayC_movil,
				"correo1_colaborador" => $arrayC_correo1,
				"correo2_colaborador" => $arrayC_correo2,
				"academia_colaborador" => $arrayC_academia,
				"objetivo_general"  => $result7['ObjetivoGeneral'],
				"objetivo_especifico"  => $result7['ObjetivoEspecifico'],
				"resultados"  => $result7['Resultados'],
				"existe" => $result8['consecutivo'],
				"nombre_organizacion" => $result8['NombreOrganizacion'],
				"direccion" => $result8['Dirección'],
				"area" => $result8['Area'],
				"contacto" => $result8['NombreCompleto'],
				"descripcion_organizacion" => $result8['DescripcionOrganizacion'],
				"descripcion_aportaciones" => $result8['DescripcionAportaciones'],
				"telefonov" => $result8['Telefono'],
				"servicio" => $result9['Servicio'],
				"residencia" => $result9['Residencia'],
				"tesis" => $result9['Tesis'],
				"ponencia" => $result9['Ponencia'],
				"articulos" => $result9['Articulos'],
				"libros" => $result9['Libros'],
				"prop_intelectual" => $result9['PropiedadesIntelectual'],
				"otrosP" => $result9['Otros'],
				"numEtapas" => $etapas_num,
				"nombre_etapa" => $array_nombreEtapa,
				"fecha_inicio_etapa" => $array_inicioEtapa,
				"fecha_fin_etapa" => $array_finEtapa,
				"meses" => $array_mesesEtapa,
				"descripcion_etapa" => $array_descripcionEtapa,
				"metas" => $array_metasEtapa,
				"actividades_etapa" => $array_actividadesEtapa,
				"productos" => $array_productosEtapa,
				"financiamiento" => $result11['Financiamiento'],
				"interno" => $result11['Interno'],
				"externo" => $result11['Externo'],
				"especificar" => $result11['Especificar'],
				"infraestructura" => $result11['Infraestructura'],
				"consumibles" => $result11['Consumibles'],
				"licencias" => $result11['Licencias'],
				"viaticos" => $result11['Viaticos'],
				"publicaciones" => $result11['Publicaciones'],
				"equipo" => $result11['Equipo'],
				"patentes" => $result11['Patentes'],
				"otros" => $result11['Otros'],
				"especifique" => $result11['Especifique'],
				"num_alumnos" => $result12B[0],
				"num_control" => $arrayA_nControl,
				"semestre" => $arrayA_semestre,
				"nombre" => $arrayA_nombre,
				"apPaterno" => $arrayA_paterno,
				"apMaterno" => $arrayA_materno,
				"actividadesA" => $arrayA_actividades,
				"carrera" => $arrayA_carrera,
				"a_servicio" => $arrayA_servicio,
				"a_residencia" => $arrayA_residencia,
				"a_tesis" => $arrayA_tesis,
				"obs_gestion" => $arrayObsG,
				"obs_investigacion" => $arrayObsI,
				"obs_comite" => $arrayObsC
			);
			//print_r($result6['nombre']);
			echo json_encode($salida);
		break;
		case 'consultaProyectoComite':
			$proyecto=$_GET['proyecto'];
			$sql='select proy."FechaPresentacion", proy."FolioProyecto", tipoInv."descripcion" descinv, tiposec."descripcion" tiposector, lineaInvest."descripcion" lineaInvestigacion, proy."NombreProyecto" nombreproyecto, proy."FechaPresentacion" fechapresentacion,
				recep."No.Solicitud" numerosolrecepcion, recep."FechaRecepcion" fechaRecep, 
				recep."NombreRecibio" nombrerecibio, usu."Nombre" nombreResponsable, 
				usu."ApellidoP" apellidoPatResponsable, usu."ApellidoM" apellidoMatResponsable,
				docente."GradoMaximoEstudios" gradoMaxEst, carr."Descripcion" carrdescr,
				docente."noPersonal" nopersonaldocproy,docente."TelefonoMovil" movil,
				usu."CorreoInstitucional" correodocenteresp,proy."actividadesResponsable" actresp,
				proy."PalabraClave1" palabra1, proy."PalabraClave2" palabra2, proy."PalabraClave3" palabra3,
				proy."ObjetivoGeneral" objgral,proy."ObjetivoEspecifico" objesp, proy."Resultados" res,
				vincul."NombreOrganizacion" nombreorg, vincul."Direccion" dirvinc, vincul."Area" areavinc,
				vincul."Telefono" telvinc, vincul."NombreCompleto" nombrecontvinc,
				vincul."DescripcionOrganizacion" descorgvinc, vincul."DescripcionAportaciones" descapvinc,
				metas."Servicio" metaserv, metas."Residencia" metares, metas."Tesis" metastesis,
				metas."Ponencia" metaspone, metas."Articulos" metasart, metas."Libros" metaslib,
				metas."PropiedadesIntelectual" metasprop, metas."Otros" metasotros,
				financ."Financiamiento" financiamiento, financ."Interno" financinter, financ."Externo" finanext,
				financ."Especificar" financesp, financ."Infraestructura" financinfraest, 
				financ."Consumibles" financons, financ."Licencias" finanlicen, financ."Viaticos" financviat,
				financ."Publicaciones" financpubl, financ."Equipo" finsncequipo, financ."Patentes" financpat,
				financ."Otros" financotros, financ."Especifique" financotrosesp
				from "proyecto" proy
				inner join "tipoinvestigacion" tipoInv on proy."TipoInvestigacion"=tipoInv."id"
				inner join "tiposector" tipoSec on tipoSec."id"=proy."TipoSector"
				inner join "lineainvestigacion" lineaInvest on lineaInvest."id"=proy."LineaInvestigacion"
				left join "recepcion" recep on recep."Proyecto_FolioProyecto"=proy."FolioProyecto"
				inner join "docente" docente on docente."noPersonal"=proy."Responsable"
				inner join "usuario" usu on usu."NoPersonal"=docente."noPersonal"
				inner join "vinculacion" vincul on vincul."FolioProyecto"=proy."FolioProyecto"
				inner join "metas" metas on metas."FkFolioProyecto"=proy."FolioProyecto"
				inner join "financiamientorequerido" financ on financ."FolioProyecto"=proy."FolioProyecto"
				inner join "carrera" carr on carr."idCarrera"=docente."Carrera_idCarrera"
				where proy."FolioProyecto"=\''.$proyecto.'\'';
			$resultados = pg_query($miConn->conexion(), $sql);
			$result=pg_fetch_array($resultados);
			$sql='select "FkNoControl","Semestre", "Nombre","Paterno", "Materno", "Actividades", al."servicio" servicio,
				al."tesis" tesis, carr."Descripcion",al."residencia" residencia
				from alumnoscolaboradoresdetalle as aldet
				inner join alumno as al on al."NoControl"=aldet."FkNoControl"
				inner join carrera carr on carr."idCarrera"=al."id_carrera"
				where "folioproyecto"=\''.$result['FolioProyecto'].'\'';
			$consulta = pg_query($miConn->conexion(), $sql);
			$json=array();
			$arregloConsulta=array();
			$alumnosCol=array();
			$i=0;
			while ($fila = pg_fetch_row($consulta)) 
			{ 
				$arregloConsulta[$i]=$fila;
				$i++;
			}
			$i=1;
			foreach ($arregloConsulta as $row) 
			{
				$Numero=$i;
				$NoControl=$row[0];
				$Semestre=$row[1];
				$Nombre=$row[2];
				$Paterno=$row[3];
				$Materno=$row[4];
				$Actividades=$row[5];
				$Servicio=$row[6];
				$Tesis=$row[7];
				$Carrera=$row[8];
				$Residencia=$row[9];
				$json=array("Numero"=>$Numero, "NoControl"=>$NoControl, "Semestre"=>$Semestre,"Nombre"=>$Nombre,"Paterno"=>$Paterno,"Materno"=>$Materno,"Actividades"=>$Actividades,"Servicio"=>$Servicio,"Tesis"=>$Tesis,"Carrera"=>$Carrera,"Residencia"=>$Residencia);
				array_push($alumnosCol,$json);
				$i++;
			}
			$sql='select "noEtapa","NombreEtapa","FechaInicio","FechaFin","Meses","Actividades","Descripcion","Metas","Productos" 
				from etapas 
				where "FolioProyecto"=\''.$result['FolioProyecto'].'\'';
			$consulta = pg_query($miConn->conexion(), $sql);
			$json=array();
			$arregloConsulta=array();
			$etapas=array();
			$i=0;
			while ($fila = pg_fetch_row($consulta)) 
			{ 
				$arregloConsulta[$i]=$fila;
				$i++;
			}
			$i=1;
			foreach ($arregloConsulta as $row) 
			{
				$Numero=$i;
				$NoEtapa=$row[0];
				$NombreEtapa=$row[1];
				$FechaInicio=$row[2];
				$FechaFin=$row[3];
				$Meses=$row[4];
				$Actividades=$row[5];
				$Descripcion=$row[6];
				$Metas=$row[7];
				$Productos=$row[8];
				$json=array("Numero"=>$Numero, "NoEtapa"=>$NoEtapa, "NombreEtapa"=>$NombreEtapa,"FechaInicio"=>$FechaInicio,"FechaFin"=>$FechaFin,"Meses"=>$Meses,"Actividades"=>$Actividades,"Descripcion"=>$Descripcion,"Metas"=>$Metas,"Productos"=>$Productos);
				array_push($etapas,$json);
				$i++;
			}
			/*******************************************************************************/

			$sql="select \"CatObservaciones_idObservaciones\", 
					\"ObservacionesGestion\", \"ObservacionesInvestigacion\"
					from observaciones 
					where \"Proyecto_FolioProyecto\" ='".$proyecto."'";
			$consulta = pg_query($miConn->conexion(), $sql);
			$json=array();
			$arregloConsulta=array();
			$obsCons=array();
			$i=0;
			while ($fila = pg_fetch_row($consulta)) 
			{ 
				$arregloConsulta[$i]=$fila;
				$i++;
			}
			$i=1;
			foreach ($arregloConsulta as $row) 
			{
				$Apartado=$row[0];
				$ObsGestion=$row[1];
				$ObsInvest=$row[2];
				$json=array("Apartado"=>$Apartado, "ObsGestion"=>$ObsGestion,"ObsInvest"=>$ObsInvest);
				array_push($obsCons,$json);
				$i++;
			}
			/**************************************************************************/
			$sql='SELECT "Actividades","Docente_noPersonal","nombre","ap_paterno","ap_materno","grado_max_estudios","celular","correo_institucional","correo_alternativo","id_carrera", carr."Descripcion"
				FROM colaboradordocente
				INNER JOIN carrera carr on carr."idCarrera"="id_carrera"
				WHERE "Proyecto_FolioProyecto"=\''.$result['FolioProyecto'].'\'';
			$consulta = pg_query($miConn->conexion(), $sql);
			$json=array();
			$arregloConsulta=array();
			$docenteColab=array();
			$i=0;
			while ($fila = pg_fetch_row($consulta)) 
			{ 
				$arregloConsulta[$i]=$fila;
				$i++;
			}
			$i=1;
			foreach ($arregloConsulta as $row) 
			{
				$Numero=$i;
				$Actividades=$row[0];
				$NoPersonal=$row[1];
				$Nombre=$row[2];
				$Paterno=$row[3];
				$Materno=$row[4];
				$GradMax=$row[5];
				$Celular=$row[6];
				$CorreoInst=$row[7];
				$CorreoPer=$row[8];
				$idCarrera=$row[9];
				$Carrera=$row[10];
				$json=array("Numero"=>$Numero, "Actividades"=>$Actividades, "NoPersonal"=>$NoPersonal,"Nombre"=>$Nombre,"Paterno"=>$Paterno,"Materno"=>$Materno,"GradMax"=>$GradMax,"Celular"=>$Celular,"CorreoInst"=>$CorreoInst,"CorreoPer"=>$CorreoPer,"idCarrera"=>$idCarrera,"Carrera"=>$Carrera);
				array_push($docenteColab,$json);
				$i++;
			}
			?>
			<div class="container" style="margin-top: 0;">
                <div class="col-lg-12 " style="margin-top: 10px;">
                    <div class="col-lg-8 well">
                        <div class="row">
                            <h3 class="text-center" id="inicioP" style="font-weight: bold;">
                                Proyecto
                            </h3>
                            <div class="col-lg-4 form-group">
                                <label>
                                    Fecha de presentación
                                </label>
                                <input class="form-control" name="fechaPresentacion" readonly="" type="date" id="fechaPresentacion" value="<?php echo $result['FechaPresentacion'] ?>">
                            </div>
                            <div class="col-lg-5 form-group">
                                <label>
                                    Convocatoria CPR
                                </label>
                                <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['FolioProyecto'] ?>">
                            </div>
                        </div>
                        <div class="row container col-lg-6">
                            <div class=" form-group">
                                <label>
                                    Tipo de investigación
                                </label>
                                <div class="">
                                    <input class="form-control" name="Aplicada" readonly="" type="text" value="<?php echo $result['descinv'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row container col-lg-6">
                            <div class="form-group">
                                <label>
                                    Tipo de Sector
                                </label>
                                <div class="">
                                    <input name="Aplicada" class="form-control" readonly="" type="text" value="<?php echo $result['tiposector'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-9">
                                    <label>
                                        Linea de investigación
                                    </label>
                                </div>
                                <div class="col-lg-9">
                                    <input name="01" class="form-control" readonly="" type="text" value="<?php echo $result['lineainvestigacion'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Nombre del proyecto
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['nombreproyecto']?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label>
                                        Duración:
                                    </label>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Inicio
                                    </label>
                                    <input class="form-control" name="" readonly="" type="date" value="<?php echo $result['fechapresentacion'] ?>">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Fin
                                    </label>
                                    <input class="form-control" name="" readonly="" type="date">
                                </div>
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="text-center" id="recep" style="font-weight: bold;">
                                    Recepción
                                </h3>
                                <div class="col-lg-5 form-group">
                                    <label>
                                        Numero de Recepción
                                    </label>
                                    <input class="form-control" value="<?php echo $result['numerosolrecepcion'] ?>" readonly="" type="text">
                                </div>
                                <div class="col-lg-5 form-group">
                                    <label>
                                        Fecha de Recepción
                                    </label>
                                    <input class="form-control" value="<?php echo $result['fechaRecep'] ?>" readonly="" type="date">
                                </div>
                                <div class="col-lg-9" style="text-align: left;">
                                    <label>
                                        Recibió
                                    </label>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Nombre(s)
                                    </label>
                                    <input class="form-control" value="<?php echo $result['nombrerecibio'] ?>" readonly="" type="text">
                                  
                                </div>
                                <div class="col-lg-5 form-group">
                                    <label>
                                        Firma
                                    </label>
                                    <input class="form-control" readonly="" type="text">
                                
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        Sello
                                    </label>
                                    <input class="form-control" readonly="" style="height: 150px" type="text">
                                   
                                </div>
                            </div>
                            <div class="col-lg-12" style="background:#000">
                            </div>
                            <div class="row">
                                <h3 class="text-center" style="font-weight: bold;">
                                    Responsable
                                </h3>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Apellido paterno
                                    </label>
                                    <input class="form-control" value="<?php echo $result['apellidopatresponsable'] ?>" readonly="" type="text">
                                
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Apellido materno
                                    </label>
                                    <input class="form-control" value="<?php echo $result['apellidomatresponsable'] ?>" readonly="" type="text">
                                  
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Nombre(s)
                                    </label>
                                    <input class="form-control" value="<?php echo $result['nombreresponsable'] ?>" readonly="" type="text">
                                 
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>
                                        Grado máximo de estudios:
                                    </label>
                                    <input class="form-control" readonly="" style="width:100%;" type="text" value="<?php echo $result['gradomaxest'] ?>">
                                 
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>
                                        Academia a la que pertenece
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $result['carrdescr'] ?>">
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        No. de personal
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $result['nopersonaldocproy'] ?>">
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        Móvil
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $result['movil'] ?>" >
                                </div>
                                <div class="col-lg-3" form-group="">
                                    <label>
                                        Correo institucional
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $result['correodocenteresp'] ?>">
                                </div>
                                <div class="col-lg-4" form-group="">
                                    <label>
                                        Correo alternativo
                                    </label>
                                    <input class="form-control" readonly="" type="text">
                                </div>
                                <div class="col-lg-12" form-group="">
                                    <label>
                                        Firma del responsable del proyecto
                                    </label>
                                    <input class="form-control" readonly="" type="text">
                                    
                                </div>
                                <div class="col-lg-12" form-group="">
                                    <label>
                                        Descripción de las principales actividades a desarrollar en el proyecto
                                    </label>
                                </div>
                                <div class="col-lg-12" form-group="">
                                    <input class="form-control" readonly="" style="height: 150px;" tabindex="4" type="text" value="<?php echo $result['actresp'] ?>">
                           
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        Palabras clave:
                                    </label>
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        (1)
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['palabra1'] ?>">
                              
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        (2)
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['palabra2'] ?>">
                                   
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        (3)
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['palabra3'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                            <?php 
                            foreach ($docenteColab as $row) {
                        	?>
                        	<h3 class="text-center" id="colab1" style="font-weight: bold;">
                                Colaborador <?php echo $row['Numero'] ?>
                            </h3>
                            <div class="row">
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Apellido paterno
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $row['Paterno'] ?>">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Apellido materno
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $row['Materno'] ?>">
                                   
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Nombre(s)
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $row['Nombre'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>
                                    Grado máximo de estudios
                                </label>
                                <input class="form-control" readonly="" type="text" value="<?php echo $row['GradMax'] ?>">
                            </div>
                            <div class="col-lg-8 form-group">
                                <label>
                                    Academia a la que pertenece
                                </label>
                                <input class="form-control" readonly="" type="text" value="<?php echo $row['Carrera'] ?>">
                            </div>
                            <div class="col-lg-2 form-group">
                                <label>
                                    N°. personal
                                </label>
                                <input class="form-control" readonly="" type="text" value="<?php echo $row['NoPersonal'] ?>">
                            </div>
                            <div class="col-lg-3 form-group">
                                <label>
                                    Móvil
                                </label>
                                <input class="form-control" pattern="^\d{10}$" readonly="" type="text" value="<?php echo $row['Celular'] ?>">
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>
                                    Correo institucional
                                </label>
                                <input class="form-control" readonly="" type="email" value="<?php echo $row['CorreoInst'] ?>">
                            </div>
                            <div class="col-lg-3 form-group">
                                <label>
                                    Correo alternativo
                                </label>
                                <input class="form-control" readonly="" type="text" value="<?php echo $row['CorreoPer'] ?>">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label>
                                    Firma del responsable
                                </label>
                                <input class="form-control" readonly="" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label>
                                    Descripción de las principales actividades a desarrollar en el proyecto
                                </label>
                                <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $row['Actividades'] ?>
                                </textarea>
                            </div>
                          	<?php
                            }
                            ?>
                            <div class="row">
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="text-center" id="objetivos" style="font-weight: bold;">
                                    Objetivos
                                </h3>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Indique el objetivo general(No más de 512 caracteres)
                                    </label>
                                    <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $result['objgral'] ?>
                                    </textarea>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Establezca los objetivos específicos, científicos y tecnológicos subyacentes en el proyecto(No más de 512 caracteres)
                                    </label>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $result['objesp'] ?>
                                    </textarea>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Indique los resultados esperados en términos concretos(No más de 512 Caracteres)
                                    </label>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $result['res'] ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="text-center" id="vinculacion" style="font-weight: bold;">
                                    Vinculación
                                </h3>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Existe convenio:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Si
                                    </label>
                                    <input name="" readonly="" type="checkbox">
                                    
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        No
                                    </label>
                                    <input name="" readonly="" type="checkbox">
                                   
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Nombre de la organización
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['nombreorg'] ?>">
                                    
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Dirección
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['dirvinc'] ?>">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Área
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['areavinc'] ?>">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Teléfono
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['telvinc'] ?>">
                                    
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Nombre del contacto
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['nombrecontvinc'] ?>">
                                    
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Descripción de la organización(No más de 256 caracteres)
                                    </label>
                                    <textarea class="form-control" name="" readonly="" rows="5" style="resize:none;"><?php echo $result['descorgvinc'] ?>
                                    </textarea>
                                </div>
                                <div class="col-lg-7 form-group">
                                    <label>
                                        Existen aportaciones financieras o en especie de la vinculación:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Si
                                    </label>
                                    <input name="" readonly="" type="checkbox">
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        No
                                    </label>
                                    <input name="" readonly="" type="checkbox">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Si la respuesta es si, describa cuales son(No más de 256 caracteres)
                                    </label>
                                    <textarea class="form-control" name="" readonly="" rows="5" style="resize:none;"><?php echo $result['descapvinc'] ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="text-center" id="metas" style="font-weight: bold;">
                                    Productos academicos
                                </h3>
                                <div class="col-lg-3 form-group">
                                    <input class="form-group" name="" disabled style="margin-left: 18px;" type="checkbox" <?php if ($result['metaserv']==true){?>checked <?php } ?>>
                                        <label>
                                            Servicio social
                                        </label>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if ($result['metares']==true){?>checked <?php } ?>>
                                        <label>
                                            Residencia profesional
                                        </label>
                                   
                                </div>
                                <div class="col-lg-3 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if ($result['metastesis']==true){?>checked <?php } ?>>
                                        <label>
                                            Tesis
                                        </label>
                                 
                                </div>
                                <div class="col-lg-12 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if ($result['metaspone']==true){?>checked <?php } ?>>
                                        <label>
                                            Ponencias/Conferencias
                                        </label>
                                 
                                </div>
                                <div class="col-lg-12 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if ($result['metasart']==true){?>checked <?php } ?>>
                                        <label>
                                            Artículos
                                        </label>
                              
                                </div>
                                <div class="col-lg-12 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if ($result['metaslib']==true){?>checked <?php } ?>>
                                        <label>
                                            Libros/Manuales
                                        </label>
                                  
                                </div>
                                <div class="col-lg-3 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if (isset($result['metasprop'])){?>checked <?php } ?>>
                                        <label>
                                            Propiedad intelectual
                                        </label>
                           
                                </div>
                                <div class="col-lg-1">
                                    <label>
                                        Especificar:
                                    </label>
                                </div>
                                <div class="col-lg-7 form-group">
                                    <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text" value="<?php echo $result['metasprop'] ?>">
                               
                                </div>
                                <div class="col-lg-3 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if (isset($result['metasotros'])){?>checked <?php } ?>>
                                        <label>
                                            Otros
                                        </label>
                                 
                                </div>
                                <div class="col-lg-1">
                                    <label>
                                        Especificar:
                                    </label>
                                </div>
                                <div class="col-lg-7 form-group">
                                    <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text" value="<?php echo $result['metasotros'] ?>">
                                
                                </div>
                                <div class="row">
                                    <div class="col-lg-12" style="background:#000">
                                    </div>
                                </div>
                                <?php foreach ($etapas as $etapa) {
                                	?>
                                <h1 class="text-center" id="etapa1" style="font-weight: Yu Gothic UI Light; margin-top: 2px">
                                    Etapa <?php echo $etapa['Numero'] ?>
                                </h1>
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <label>
                                            Nombre de la etapa:
                                        </label>
                                        <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text" value="<?php echo $etapa['NombreEtapa'] ?>">
                                    </div>                                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 form-group">
                                        <label>
                                            Fecha de inicio:
                                        </label>
                                        <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="date" value="<?php echo $etapa['FechaInicio'] ?>">
                                    </div>
                                    
                                    <div class="col-lg-4 form-group">
                                        <label>
                                            Fecha de fin:
                                        </label>
                                        <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="date" value="<?php echo $etapa['FechaFin'] ?>">
                                    </div>
                                    
                                    <div class="col-lg-4 form-group">
                                        <label>
                                            Total de meses:
                                        </label>
                                        <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text" value="<?php echo $etapa['Meses'] ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <label>
                                            Descripción
                                        </label>
                                        <input class="form-control" name="" readonly="" type="text" value="<?php echo $etapa['Descripcion'] ?>">
                                    </div>                                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 form-group">
                                        <label>
                                            Metas
                                        </label>
                                    </div>
                                    <div class="col-lg-10 form-group">
                                        <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $etapa['Metas'] ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 form-group">
                                        <label>
                                            Actividades
                                        </label>
                                    </div>
                                    <div class="col-lg-10 form-group">
                                        <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $etapa['Descripcion'] ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 form-group">
                                        <label>
                                            Productos
                                        </label>
                                    </div>
                                    <div class="col-lg-10 form-group">
                                        <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $etapa['Productos'] ?>
                                        </textarea>
                                    </div>
                                </div>
                                	<?php
                                } ?>
                                <div class="row">
                                    <div class="col-lg-12" style="background:#000">
                                    </div>
                                </div>
                                <h3 class="text-center" id="financ" style="font-weight: bold; margin-bottom: 9px;">
                                    Financiamiento requerido
                                </h3>
                                <div class="row">
                                    <div class="col-lg-5 form-group">
                                        <label>
                                            ¿Existe actualmente algún financiamiento del proyecto?
                                        </label>
                                    </div>
                                    <div class="col-lg-2 form-group">
                                        <label>
                                            Si
                                        </label>
                                        <input name="" readonly="" type="checkbox" <?php if ($result['financiamiento']==true){?>checked <?php }?> >
                                    </div>
                                    <div class="col-lg-2 form-group">
                                        <label>
                                            No
                                        </label>
                                        <input name="" readonly="" type="checkbox" <?php if ($result['financiamiento']==false){?>checked <?php }?> >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5>
                                            En caso de que la respuesta sea sí
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Interno
                                    </label>
                                    <input name="" readonly="" type="checkbox"<?php if ($result['financinter']==true){?>checked <?php }?> >
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Externo
                                    </label>
                                    <input name="" readonly="" type="checkbox" <?php if ($result['finanext']==true){?>checked <?php }?>>
                                
                                </div>
                                <div class="col-lg-1 form-group">
                                    <label>
                                        Especificar:
                                    </label>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text" value="<?php echo $result['financesp'] ?>">
                                  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>
                                        En caso de que la respuesta sea no desglose($)
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Infraestructura:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financinfraest'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Consumibles:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financons'] ?>">
                             
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Licencias:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['finanlicen'] ?>">
                           
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Viáticos:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financviat'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Publicaciones:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financpubl'] ?>">
                                
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Equipo:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['finsncequipo'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Patentes/derechos de autor:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financpat'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Otros(Especifique):
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financotrosesp'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Total:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                             <div class="row">
                                <?php foreach ($alumnosCol as $row) {
                                ?>
                                <div class="col-lg-12">
                                    <h5>
                                        <b>
                                            *
                                        </b>
                                        S.S.= Servicio Social, R.P.= Residencia Profesional, T= Tesis
                                    </h5>
                                    <h3 class="text-center" id="alumnos" style="font-weight: bold; margin-bottom: 9px;">
                                        Alumno colaborador <?php echo $row['Numero'] ?>
                                    </h3>
                                    <div class="row">
                                        <div class="col-lg-6 form-group">
                                            <label>
                                                Nombre del Alumno
                                            </label>
                                            <input class="form-control" name="" type="text" value="<?php echo $row['Nombre'].' '.$row['Paterno'].' '.$row['Materno']?>" disabled>
                                        </div>                                                        
                                        <div class="col-lg-2 form-group" style="margin-top: 30px;">
                                            <label>
                                                S.S.
                                            </label>
                                            <input class="form-group" name="" type="checkbox" <?php if ($row['Servicio']==true) {?>checked <?php }?> >
                                        </div>
                                        <div class="col-lg-2 form-group" style="margin-top: 30px;">
                                            <label>
                                                R.P.
                                            </label>
                                            <input class="form-group" name="" type="checkbox" <?php if ($row['Residencia']==true) {?>checked <?php }?> >
                                      
                                        </div>
                                        <div class="col-lg-2 form-group" style="margin-top: 30px;">
                                            <label>
                                                T
                                            </label>
                                            <input class="form-group" name="" type="checkbox" <?php if ($row['Tesis']==true) {?>checked <?php }?> >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 form-group">
                                            <label>
                                                No. control
                                            </label>
                                            <input class="form-control" name="" readonly="" type="text" value="<?php echo $row['NoControl'] ?>">
                                        </div>                                                        
                                        <div class="col-lg-4 form-group">
                                            <label>
                                                Semestre:
                                            </label>
                                             <input class="form-control" name="" readonly="" type="text" value="<?php echo $row['Semestre'] ?>">
                                        </div>                                                        
                                        <div class="col-lg-4 form-group">
                                            <label>
                                                Carrera
                                            </label>
                                            <input class="form-control" name="" readonly="" type="text" value="<?php echo $row['Carrera'] ?>">
                                        </div>
                                        
                                        <div class=" col-lg-12 form-group">
                                            <label>
                                                Detalle de actividades
                                            </label>
                                            <textarea class="form-control" readonly="" rows="3" style="resize:none;"><?php echo $row['Actividades'] ?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div> 
                                <?php 	
                                } ?>
                            </div>
                        </div>
                    </div>
		            <div class="col-lg-4" role="complementary">
		                <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
		                    <ul class="nav bs-docs-sidenav">
		                        <div class="container" id="navObserv">
		                        	<input type="hidden" id="folio" name="folio" value="<?php echo $result['FolioProyecto']; ?>">
		                            <h3>
		                                Observaciones
		                            </h3>
		                            <div class="panel panel-primary panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                Realizar Observaciones
                                            </h5>
                                            <span class="pull-right clickable panel-collapsed">
                                                <i class="glyphicon glyphicon-chevron-down">
                                                </i>
                                            </span>
                                        </div>
                                        <form action="" method="POST" id="formObsInvest">
                                        <input type="hidden" value="<?php echo $result['FolioProyecto'] ?>" name="folio" id="folio" >
                                        <div class="panel-body" style="display: none;">
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#inicioP" style="color: #337ab7">
                                                    Proyecto
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" id="obs_proyecto" name="obs_proyecto" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#recep" style="color: #337ab7">
                                                    Recepción
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_recepcion" id="obs_recepcion" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#colab1" style="color: #337ab7">
                                                    Colaboradores
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_colaboradores" id="obs_colaboradores" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#objetivos" style="color: #337ab7">
                                                    Objetivos
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_objetivos" id="obs_objetivos" rows="5" style="resize:none"></textarea>
                                                    
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#vinculacion" style="color: #337ab7">
                                                    Vinculación
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" id="obs_vinculacion" name="obs_vinculacion" rows="5" style="resize:none"></textarea>
                                                    
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#metas" style="color: #337ab7">
                                                    Metas
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_metas" id="obs_metas" rows="5" style="resize:none"></textarea>
                                                    
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#etapa1" style="color: #337ab7">
                                                    Etapas
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_etapas" id="obs_etapas" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#financ" style="color: #337ab7">
                                                    Financiamiento
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_financiamiento" id="obs_financiamiento" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#al1" style="color: #337ab7">
                                                    Alumnos
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_alumnos" id="obs_alumnos" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                        </form>
                                        </div>
                                    </div>
		                            <div class="panel panel-primary panel-default" id="navObserv">
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
		                                    <form id="obs-Gest" method="_POST">
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#inicioP" style="color: #337ab7">
		                                            Proyecto
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" name="obs_proyecto" id="obs_proyecto" rows="5" style="resize:none"><?php echo $obsCons[0]['ObsGestion'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#recep" style="color: #337ab7">
		                                            Recepción
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_recepcion" name="obs_recepcion" rows="5" style="resize:none"><?php echo $obsCons[1]['ObsGestion'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#colab1" style="color: #337ab7">
		                                            Colaboradores
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_colaboradores" name="obs_colaboradores" rows="5" style="resize:none"><?php echo $obsCons[2]['ObsGestion'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#objetivos" style="color: #337ab7">
		                                            Objetivos
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_objetivos" name="obs_objetivos" rows="5" style="resize:none"><?php echo $obsCons[3]['ObsGestion'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#vinculacion" style="color: #337ab7">
		                                            Vinculación
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_vinculacion" name="obs_vinculacion" rows="5" style="resize:none"><?php echo $obsCons[4]['ObsGestion'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#metas" style="color: #337ab7">
		                                            Metas
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_metas" name="obs_metas" rows="5" style="resize:none"><?php echo $obsCons[5]['ObsGestion'] ?></textarea>
		                                            
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#etapa1" style="color: #337ab7">
		                                            Etapas
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_etapas" name="obs_etapas" rows="5" style="resize:none"><?php echo $obsCons[6]['ObsGestion'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#financ" style="color: #337ab7">
		                                            Financiamiento
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_financiamiento" name="obs_financiamiento" rows="5" style="resize:none"><?php echo $obsCons[7]['ObsGestion'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#al1" style="color: #337ab7">
		                                            Alumnos
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_alumnos" name="obs_alumnos" rows="5" style="resize:none"><?php echo $obsCons[8]['ObsGestion'] ?></textarea>
		                                        </div>
		                                    </li>
		                                </div>
		                            	</form>
		                            </div>
		                            <div class="panel panel-primary panel-default" id="navObserv">
		                                <div class="panel-heading">
		                                    <h5 class="panel-title">
		                                        Subdirección de Investigación
		                                    </h5>
		                                    <span class="pull-right clickable panel-collapsed">
		                                        <i class="glyphicon glyphicon-chevron-down">
		                                        </i>
		                                    </span>
		                                </div>
		                                <div class="panel-body" style="display: none;">
		                                    <form id="obs-Com" method="_POST">
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#inicioP" style="color: #337ab7">
		                                            Proyecto
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" name="obsComiteProy" id="obsComiteProy" rows="5" style="resize:none">
		                                            	<?php echo $obsCons[0]['ObsInvest'] ?>
		                                            </textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#recep" style="color: #337ab7">
		                                            Recepción
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteRecep" name="obsComiteRecep" rows="5" style="resize:none"><?php echo $obsCons[1]['ObsInvest'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#colab1" style="color: #337ab7">
		                                            Colaboradores
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteColab" name="obsComiteColab" rows="5" style="resize:none"><?php echo $obsCons[2]['ObsInvest'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#objetivos" style="color: #337ab7">
		                                            Objetivos
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteObj" name="obsComiteObj" rows="5" style="resize:none"><?php echo $obsCons[3]['ObsInvest'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#vinculacion" style="color: #337ab7">
		                                            Vinculación
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteVinc" name="obsComiteVinc" rows="5" style="resize:none"><?php echo $obsCons[4]['ObsInvest'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#metas" style="color: #337ab7">
		                                            Metas
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteMetas" name="obsComiteMetas" rows="5" style="resize:none"><?php echo $obsCons[5]['ObsInvest'] ?></textarea>
		                                            
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#etapa1" style="color: #337ab7">
		                                            Etapas
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteEtapas" name="obsComiteEtapas" rows="5" style="resize:none"><?php echo $obsCons[6]['ObsInvest'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#financ" style="color: #337ab7">
		                                            Financiamiento
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteFinanc" name="obsComiteFinanc" rows="5" style="resize:none"><?php echo $obsCons[7]['ObsInvest'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#al1" style="color: #337ab7">
		                                            Alumnos
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteAlumnos" name="obsComiteAlumnos" rows="5" style="resize:none"><?php echo $obsCons[8]['ObsInvest'] ?></textarea>
		                                        </div>
		                                    </li>
		                                </div>
		                            </form>
		                            </div>
                                    <li class="">
                                        <a href="#" onclick="guardarObservaciones(6)">
                                            Enviar revisión a Subdirección de Investigación
                                        </a>
                                    </li>
		                            <li class="">
		                                <a data-dismiss="modal" href="">
		                                    Cerrar
		                                </a>
		                            </li>
		                        </div>
		                    </ul>
		                </nav>
		            </div>
        		</div>
            </div>
			<?php
		break;
		case 'consultaProyectoGest':
			$proyecto=$_GET['proyecto'];
			$sql='select proy."FechaPresentacion", proy."FolioProyecto", tipoInv."descripcion" descinv, tiposec."descripcion" tiposector, lineaInvest."descripcion" lineaInvestigacion, proy."NombreProyecto" nombreproyecto, proy."FechaPresentacion" fechapresentacion,
				recep."No.Solicitud" numerosolrecepcion, recep."FechaRecepcion" fechaRecep, 
				recep."NombreRecibio" nombrerecibio, usu."Nombre" nombreResponsable, 
				usu."ApellidoP" apellidoPatResponsable, usu."ApellidoM" apellidoMatResponsable,
				docente."GradoMaximoEstudios" gradoMaxEst, carr."Descripcion" carrdescr,
				docente."noPersonal" nopersonaldocproy,docente."TelefonoMovil" movil,
				usu."CorreoInstitucional" correodocenteresp,proy."actividadesResponsable" actresp,
				proy."PalabraClave1" palabra1, proy."PalabraClave2" palabra2, proy."PalabraClave3" palabra3,
				proy."ObjetivoGeneral" objgral,proy."ObjetivoEspecifico" objesp, proy."Resultados" res,
				vincul."NombreOrganizacion" nombreorg, vincul."Direccion" dirvinc, vincul."Area" areavinc,
				vincul."Telefono" telvinc, vincul."NombreCompleto" nombrecontvinc,
				vincul."DescripcionOrganizacion" descorgvinc, vincul."DescripcionAportaciones" descapvinc,
				metas."Servicio" metaserv, metas."Residencia" metares, metas."Tesis" metastesis,
				metas."Ponencia" metaspone, metas."Articulos" metasart, metas."Libros" metaslib,
				metas."PropiedadesIntelectual" metasprop, metas."Otros" metasotros,
				financ."Financiamiento" financiamiento, financ."Interno" financinter, financ."Externo" finanext,
				financ."Especificar" financesp, financ."Infraestructura" financinfraest, 
				financ."Consumibles" financons, financ."Licencias" finanlicen, financ."Viaticos" financviat,
				financ."Publicaciones" financpubl, financ."Equipo" finsncequipo, financ."Patentes" financpat,
				financ."Otros" financotros, financ."Especifique" financotrosesp
				from "proyecto" proy
				inner join "tipoinvestigacion" tipoInv on proy."TipoInvestigacion"=tipoInv."id"
				inner join "tiposector" tipoSec on tipoSec."id"=proy."TipoSector"
				inner join "lineainvestigacion" lineaInvest on lineaInvest."id"=proy."LineaInvestigacion"
				left join "recepcion" recep on recep."Proyecto_FolioProyecto"=proy."FolioProyecto"
				inner join "docente" docente on docente."noPersonal"=proy."Responsable"
				inner join "usuario" usu on usu."NoPersonal"=docente."noPersonal"
				inner join "vinculacion" vincul on vincul."FolioProyecto"=proy."FolioProyecto"
				inner join "metas" metas on metas."FkFolioProyecto"=proy."FolioProyecto"
				inner join "financiamientorequerido" financ on financ."FolioProyecto"=proy."FolioProyecto"
				inner join "carrera" carr on carr."idCarrera"=docente."Carrera_idCarrera"
				where proy."FolioProyecto"=\''.$proyecto.'\'';
			$resultados = pg_query($miConn->conexion(), $sql);
			$result=pg_fetch_array($resultados);
			$sql='select "FkNoControl","Semestre", "Nombre","Paterno", "Materno", "Actividades", al."servicio" servicio,
				al."tesis" tesis, carr."Descripcion",al."residencia" residencia
				from alumnoscolaboradoresdetalle as aldet
				inner join alumno as al on al."NoControl"=aldet."FkNoControl"
				inner join carrera carr on carr."idCarrera"=al."id_carrera"
				where "folioproyecto"=\''.$result['FolioProyecto'].'\'';
			$consulta = pg_query($miConn->conexion(), $sql);
			$json=array();
			$arregloConsulta=array();
			$alumnosCol=array();
			$i=0;
			while ($fila = pg_fetch_row($consulta)) 
			{ 
				$arregloConsulta[$i]=$fila;
				$i++;
			}
			$i=1;
			foreach ($arregloConsulta as $row) 
			{
				$Numero=$i;
				$NoControl=$row[0];
				$Semestre=$row[1];
				$Nombre=$row[2];
				$Paterno=$row[3];
				$Materno=$row[4];
				$Actividades=$row[5];
				$Servicio=$row[6];
				$Tesis=$row[7];
				$Carrera=$row[8];
				$Residencia=$row[9];
				$json=array("Numero"=>$Numero, "NoControl"=>$NoControl, "Semestre"=>$Semestre,"Nombre"=>$Nombre,"Paterno"=>$Paterno,"Materno"=>$Materno,"Actividades"=>$Actividades,"Servicio"=>$Servicio,"Tesis"=>$Tesis,"Carrera"=>$Carrera,"Residencia"=>$Residencia);
				array_push($alumnosCol,$json);
				$i++;
			}
			$sql='select "noEtapa","NombreEtapa","FechaInicio","FechaFin","Meses","Actividades","Descripcion","Metas","Productos" 
				from etapas 
				where "FolioProyecto"=\''.$result['FolioProyecto'].'\'';
			$consulta = pg_query($miConn->conexion(), $sql);
			$json=array();
			$arregloConsulta=array();
			$etapas=array();
			$i=0;
			while ($fila = pg_fetch_row($consulta)) 
			{ 
				$arregloConsulta[$i]=$fila;
				$i++;
			}
			$i=1;
			foreach ($arregloConsulta as $row) 
			{
				$Numero=$i;
				$NoEtapa=$row[0];
				$NombreEtapa=$row[1];
				$FechaInicio=$row[2];
				$FechaFin=$row[3];
				$Meses=$row[4];
				$Actividades=$row[5];
				$Descripcion=$row[6];
				$Metas=$row[7];
				$Productos=$row[8];
				$json=array("Numero"=>$Numero, "NoEtapa"=>$NoEtapa, "NombreEtapa"=>$NombreEtapa,"FechaInicio"=>$FechaInicio,"FechaFin"=>$FechaFin,"Meses"=>$Meses,"Actividades"=>$Actividades,"Descripcion"=>$Descripcion,"Metas"=>$Metas,"Productos"=>$Productos);
				array_push($etapas,$json);
				$i++;
			}
			/*******************************************************************************/

			$sql="select \"CatObservaciones_idObservaciones\", 
					\"ObservacionesGestion\", \"ObservacionesInvestigacion\"
					from observaciones 
					where \"Proyecto_FolioProyecto\" ='".$proyecto."'";
			$consulta = pg_query($miConn->conexion(), $sql);
			$json=array();
			$arregloConsulta=array();
			$obsCons=array();
			$i=0;
			while ($fila = pg_fetch_row($consulta)) 
			{ 
				$arregloConsulta[$i]=$fila;
				$i++;
			}
			$i=1;
			foreach ($arregloConsulta as $row) 
			{
				$Apartado=$row[0];
				$ObsGestion=$row[1];
				$ObsInvest=$row[2];
				$json=array("Apartado"=>$Apartado, "ObsGestion"=>$ObsGestion,"ObsInvest"=>$ObsInvest);
				array_push($obsCons,$json);
				$i++;
			}
			/**************************************************************************/
			$sql='SELECT "Actividades","Docente_noPersonal","nombre","ap_paterno","ap_materno","grado_max_estudios","celular","correo_institucional","correo_alternativo","id_carrera", carr."Descripcion"
				FROM colaboradordocente
				INNER JOIN carrera carr on carr."idCarrera"="id_carrera"
				WHERE "Proyecto_FolioProyecto"=\''.$result['FolioProyecto'].'\'';
			$consulta = pg_query($miConn->conexion(), $sql);
			$json=array();
			$arregloConsulta=array();
			$docenteColab=array();
			$i=0;
			while ($fila = pg_fetch_row($consulta)) 
			{ 
				$arregloConsulta[$i]=$fila;
				$i++;
			}
			$i=1;
			foreach ($arregloConsulta as $row) 
			{
				$Numero=$i;
				$Actividades=$row[0];
				$NoPersonal=$row[1];
				$Nombre=$row[2];
				$Paterno=$row[3];
				$Materno=$row[4];
				$GradMax=$row[5];
				$Celular=$row[6];
				$CorreoInst=$row[7];
				$CorreoPer=$row[8];
				$idCarrera=$row[9];
				$Carrera=$row[10];
				$json=array("Numero"=>$Numero, "Actividades"=>$Actividades, "NoPersonal"=>$NoPersonal,"Nombre"=>$Nombre,"Paterno"=>$Paterno,"Materno"=>$Materno,"GradMax"=>$GradMax,"Celular"=>$Celular,"CorreoInst"=>$CorreoInst,"CorreoPer"=>$CorreoPer,"idCarrera"=>$idCarrera,"Carrera"=>$Carrera);
				array_push($docenteColab,$json);
				$i++;
			}
			?>
			<div class="container" style="margin-top: 0;">
                <div class="col-lg-12 " style="margin-top: 10px;">
                    <div class="col-lg-8 well">
                        <div class="row">
                            <h3 class="text-center" id="inicioP" style="font-weight: bold;">
                                Proyecto
                            </h3>
                            <div class="col-lg-4 form-group">
                                <label>
                                    Fecha de presentación
                                </label>
                                <input class="form-control" name="fechaPresentacion" readonly="" type="date" id="fechaPresentacion" value="<?php echo $result['FechaPresentacion'] ?>">
                            </div>
                            <div class="col-lg-5 form-group">
                                <label>
                                    Convocatoria CPR
                                </label>
                                <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['FolioProyecto'] ?>">
                            </div>
                        </div>
                        <div class="row container col-lg-6">
                            <div class=" form-group">
                                <label>
                                    Tipo de investigación
                                </label>
                                <div class="">
                                    <input class="form-control" name="Aplicada" readonly="" type="text" value="<?php echo $result['descinv'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row container col-lg-6">
                            <div class="form-group">
                                <label>
                                    Tipo de Sector
                                </label>
                                <div class="">
                                    <input name="Aplicada" class="form-control" readonly="" type="text" value="<?php echo $result['tiposector'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-9">
                                    <label>
                                        Linea de investigación
                                    </label>
                                </div>
                                <div class="col-lg-9">
                                    <input name="01" class="form-control" readonly="" type="text" value="<?php echo $result['lineainvestigacion'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Nombre del proyecto
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['nombreproyecto']?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label>
                                        Duración:
                                    </label>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Inicio
                                    </label>
                                    <input class="form-control" name="" readonly="" type="date" value="<?php echo $result['fechapresentacion'] ?>">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Fin
                                    </label>
                                    <input class="form-control" name="" readonly="" type="date">
                                </div>
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="text-center" id="recep" style="font-weight: bold;">
                                    Recepción
                                </h3>
                                <div class="col-lg-5 form-group">
                                    <label>
                                        Numero de Recepción
                                    </label>
                                    <input class="form-control" value="<?php echo $result['numerosolrecepcion'] ?>" readonly="" type="text">
                                </div>
                                <div class="col-lg-5 form-group">
                                    <label>
                                        Fecha de Recepción
                                    </label>
                                    <input class="form-control" value="<?php echo $result['fechaRecep'] ?>" readonly="" type="date">
                                </div>
                                <div class="col-lg-9" style="text-align: left;">
                                    <label>
                                        Recibió
                                    </label>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Nombre(s)
                                    </label>
                                    <input class="form-control" value="<?php echo $result['nombrerecibio'] ?>" readonly="" type="text">
                                  
                                </div>
                                <div class="col-lg-5 form-group">
                                    <label>
                                        Firma
                                    </label>
                                    <input class="form-control" readonly="" type="text">
                                
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        Sello
                                    </label>
                                    <input class="form-control" readonly="" style="height: 150px" type="text">
                                   
                                </div>
                            </div>
                            <div class="col-lg-12" style="background:#000">
                            </div>
                            <div class="row">
                                <h3 class="text-center" style="font-weight: bold;">
                                    Responsable
                                </h3>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Apellido paterno
                                    </label>
                                    <input class="form-control" value="<?php echo $result['apellidopatresponsable'] ?>" readonly="" type="text">
                                
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Apellido materno
                                    </label>
                                    <input class="form-control" value="<?php echo $result['apellidomatresponsable'] ?>" readonly="" type="text">
                                  
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Nombre(s)
                                    </label>
                                    <input class="form-control" value="<?php echo $result['nombreresponsable'] ?>" readonly="" type="text">
                                 
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>
                                        Grado máximo de estudios:
                                    </label>
                                    <input class="form-control" readonly="" style="width:100%;" type="text" value="<?php echo $result['gradomaxest'] ?>">
                                 
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>
                                        Academia a la que pertenece
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $result['carrdescr'] ?>">
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        No. de personal
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $result['nopersonaldocproy'] ?>">
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        Móvil
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $result['movil'] ?>" >
                                </div>
                                <div class="col-lg-3" form-group="">
                                    <label>
                                        Correo institucional
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $result['correodocenteresp'] ?>">
                                </div>
                                <div class="col-lg-4" form-group="">
                                    <label>
                                        Correo alternativo
                                    </label>
                                    <input class="form-control" readonly="" type="text">
                                </div>
                                <div class="col-lg-12" form-group="">
                                    <label>
                                        Firma del responsable del proyecto
                                    </label>
                                    <input class="form-control" readonly="" type="text">
                                    
                                </div>
                                <div class="col-lg-12" form-group="">
                                    <label>
                                        Descripción de las principales actividades a desarrollar en el proyecto
                                    </label>
                                </div>
                                <div class="col-lg-12" form-group="">
                                    <input class="form-control" readonly="" style="height: 150px;" tabindex="4" type="text" value="<?php echo $result['actresp'] ?>">
                           
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        Palabras clave:
                                    </label>
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        (1)
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['palabra1'] ?>">
                              
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        (2)
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['palabra2'] ?>">
                                   
                                </div>
                                <div class="col-lg-3 form-group">
                                    <label>
                                        (3)
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['palabra3'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                            <?php 
                            foreach ($docenteColab as $row) {
                        	?>
                        	<h3 class="text-center" id="colab1" style="font-weight: bold;">
                                Colaborador <?php echo $row['Numero'] ?>
                            </h3>
                            <div class="row">
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Apellido paterno
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $row['Paterno'] ?>">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Apellido materno
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $row['Materno'] ?>">
                                   
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Nombre(s)
                                    </label>
                                    <input class="form-control" readonly="" type="text" value="<?php echo $row['Nombre'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>
                                    Grado máximo de estudios
                                </label>
                                <input class="form-control" readonly="" type="text" value="<?php echo $row['GradMax'] ?>">
                            </div>
                            <div class="col-lg-8 form-group">
                                <label>
                                    Academia a la que pertenece
                                </label>
                                <input class="form-control" readonly="" type="text" value="<?php echo $row['Carrera'] ?>">
                            </div>
                            <div class="col-lg-2 form-group">
                                <label>
                                    N°. personal
                                </label>
                                <input class="form-control" readonly="" type="text" value="<?php echo $row['NoPersonal'] ?>">
                            </div>
                            <div class="col-lg-3 form-group">
                                <label>
                                    Móvil
                                </label>
                                <input class="form-control" pattern="^\d{10}$" readonly="" type="text" value="<?php echo $row['Celular'] ?>">
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>
                                    Correo institucional
                                </label>
                                <input class="form-control" readonly="" type="email" value="<?php echo $row['CorreoInst'] ?>">
                            </div>
                            <div class="col-lg-3 form-group">
                                <label>
                                    Correo alternativo
                                </label>
                                <input class="form-control" readonly="" type="text" value="<?php echo $row['CorreoPer'] ?>">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label>
                                    Firma del responsable
                                </label>
                                <input class="form-control" readonly="" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label>
                                    Descripción de las principales actividades a desarrollar en el proyecto
                                </label>
                                <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $row['Actividades'] ?>
                                </textarea>
                            </div>
                          	<?php
                            }
                            ?>
                            <div class="row">
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="text-center" id="objetivos" style="font-weight: bold;">
                                    Objetivos
                                </h3>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Indique el objetivo general(No más de 512 caracteres)
                                    </label>
                                    <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $result['objgral'] ?>
                                    </textarea>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Establezca los objetivos específicos, científicos y tecnológicos subyacentes en el proyecto(No más de 512 caracteres)
                                    </label>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $result['objesp'] ?>
                                    </textarea>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Indique los resultados esperados en términos concretos(No más de 512 Caracteres)
                                    </label>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $result['res'] ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="text-center" id="vinculacion" style="font-weight: bold;">
                                    Vinculación
                                </h3>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Existe convenio:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Si
                                    </label>
                                    <input name="" readonly="" type="checkbox">
                                    
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        No
                                    </label>
                                    <input name="" readonly="" type="checkbox">
                                   
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Nombre de la organización
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['nombreorg'] ?>">
                                    
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Dirección
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['dirvinc'] ?>">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Área
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['areavinc'] ?>">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Teléfono
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['telvinc'] ?>">
                                    
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>
                                        Nombre del contacto
                                    </label>
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['nombrecontvinc'] ?>">
                                    
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Descripción de la organización(No más de 256 caracteres)
                                    </label>
                                    <textarea class="form-control" name="" readonly="" rows="5" style="resize:none;"><?php echo $result['descorgvinc'] ?>
                                    </textarea>
                                </div>
                                <div class="col-lg-7 form-group">
                                    <label>
                                        Existen aportaciones financieras o en especie de la vinculación:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Si
                                    </label>
                                    <input name="" readonly="" type="checkbox">
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        No
                                    </label>
                                    <input name="" readonly="" type="checkbox">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>
                                        Si la respuesta es si, describa cuales son(No más de 256 caracteres)
                                    </label>
                                    <textarea class="form-control" name="" readonly="" rows="5" style="resize:none;"><?php echo $result['descapvinc'] ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="text-center" id="metas" style="font-weight: bold;">
                                    Productos academicos
                                </h3>
                                <div class="col-lg-3 form-group">
                                    <input class="form-group" name="" disabled style="margin-left: 18px;" type="checkbox" <?php if ($result['metaserv']==true){?>checked <?php } ?>>
                                        <label>
                                            Servicio social
                                        </label>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if ($result['metares']==true){?>checked <?php } ?>>
                                        <label>
                                            Residencia profesional
                                        </label>
                                   
                                </div>
                                <div class="col-lg-3 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if ($result['metastesis']==true){?>checked <?php } ?>>
                                        <label>
                                            Tesis
                                        </label>
                                 
                                </div>
                                <div class="col-lg-12 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if ($result['metaspone']==true){?>checked <?php } ?>>
                                        <label>
                                            Ponencias/Conferencias
                                        </label>
                                 
                                </div>
                                <div class="col-lg-12 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if ($result['metasart']==true){?>checked <?php } ?>>
                                        <label>
                                            Artículos
                                        </label>
                              
                                </div>
                                <div class="col-lg-12 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if ($result['metaslib']==true){?>checked <?php } ?>>
                                        <label>
                                            Libros/Manuales
                                        </label>
                                  
                                </div>
                                <div class="col-lg-3 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if (isset($result['metasprop'])){?>checked <?php } ?>>
                                        <label>
                                            Propiedad intelectual
                                        </label>
                           
                                </div>
                                <div class="col-lg-1">
                                    <label>
                                        Especificar:
                                    </label>
                                </div>
                                <div class="col-lg-7 form-group">
                                    <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text" value="<?php echo $result['metasprop'] ?>">
                               
                                </div>
                                <div class="col-lg-3 form-group">
                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox"<?php if (isset($result['metasotros'])){?>checked <?php } ?>>
                                        <label>
                                            Otros
                                        </label>
                                 
                                </div>
                                <div class="col-lg-1">
                                    <label>
                                        Especificar:
                                    </label>
                                </div>
                                <div class="col-lg-7 form-group">
                                    <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text" value="<?php echo $result['metasotros'] ?>">
                                
                                </div>
                                <div class="row">
                                    <div class="col-lg-12" style="background:#000">
                                    </div>
                                </div>
                                <?php foreach ($etapas as $etapa) {
                                	?>
                                <h1 class="text-center" id="etapa1" style="font-weight: Yu Gothic UI Light; margin-top: 2px">
                                    Etapa <?php echo $etapa['Numero'] ?>
                                </h1>
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <label>
                                            Nombre de la etapa:
                                        </label>
                                        <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text" value="<?php echo $etapa['NombreEtapa'] ?>">
                                    </div>                                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 form-group">
                                        <label>
                                            Fecha de inicio:
                                        </label>
                                        <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="date" value="<?php echo $etapa['FechaInicio'] ?>">
                                    </div>
                                    
                                    <div class="col-lg-4 form-group">
                                        <label>
                                            Fecha de fin:
                                        </label>
                                        <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="date" value="<?php echo $etapa['FechaFin'] ?>">
                                    </div>
                                    
                                    <div class="col-lg-4 form-group">
                                        <label>
                                            Total de meses:
                                        </label>
                                        <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text" value="<?php echo $etapa['Meses'] ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <label>
                                            Descripción
                                        </label>
                                        <input class="form-control" name="" readonly="" type="text" value="<?php echo $etapa['Descripcion'] ?>">
                                    </div>                                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 form-group">
                                        <label>
                                            Metas
                                        </label>
                                    </div>
                                    <div class="col-lg-10 form-group">
                                        <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $etapa['Metas'] ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 form-group">
                                        <label>
                                            Actividades
                                        </label>
                                    </div>
                                    <div class="col-lg-10 form-group">
                                        <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $etapa['Descripcion'] ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 form-group">
                                        <label>
                                            Productos
                                        </label>
                                    </div>
                                    <div class="col-lg-10 form-group">
                                        <textarea class="form-control" readonly="" rows="4" style="resize:none;"><?php echo $etapa['Productos'] ?>
                                        </textarea>
                                    </div>
                                </div>
                                	<?php
                                } ?>
                                <div class="row">
                                    <div class="col-lg-12" style="background:#000">
                                    </div>
                                </div>
                                <h3 class="text-center" id="financ" style="font-weight: bold; margin-bottom: 9px;">
                                    Financiamiento requerido
                                </h3>
                                <div class="row">
                                    <div class="col-lg-5 form-group">
                                        <label>
                                            ¿Existe actualmente algún financiamiento del proyecto?
                                        </label>
                                    </div>
                                    <div class="col-lg-2 form-group">
                                        <label>
                                            Si
                                        </label>
                                        <input name="" readonly="" type="checkbox" <?php if ($result['financiamiento']==true){?>checked <?php }?> >
                                    </div>
                                    <div class="col-lg-2 form-group">
                                        <label>
                                            No
                                        </label>
                                        <input name="" readonly="" type="checkbox" <?php if ($result['financiamiento']==false){?>checked <?php }?> >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5>
                                            En caso de que la respuesta sea sí
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Interno
                                    </label>
                                    <input name="" readonly="" type="checkbox"<?php if ($result['financinter']==true){?>checked <?php }?> >
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Externo
                                    </label>
                                    <input name="" readonly="" type="checkbox" <?php if ($result['finanext']==true){?>checked <?php }?>>
                                
                                </div>
                                <div class="col-lg-1 form-group">
                                    <label>
                                        Especificar:
                                    </label>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text" value="<?php echo $result['financesp'] ?>">
                                  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>
                                        En caso de que la respuesta sea no desglose($)
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Infraestructura:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financinfraest'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Consumibles:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financons'] ?>">
                             
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Licencias:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['finanlicen'] ?>">
                           
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Viáticos:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financviat'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Publicaciones:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financpubl'] ?>">
                                
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Equipo:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['finsncequipo'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Patentes/derechos de autor:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financpat'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Otros(Especifique):
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text" value="<?php echo $result['financotrosesp'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 form-group">
                                    <label>
                                        Total:
                                    </label>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <input class="form-control" name="" readonly="" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="background:#000">
                                </div>
                            </div>
                             <div class="row">
                                <?php foreach ($alumnosCol as $row) {
                                ?>
                                <div class="col-lg-12">
                                    <h5>
                                        <b>
                                            *
                                        </b>
                                        S.S.= Servicio Social, R.P.= Residencia Profesional, T= Tesis
                                    </h5>
                                    <h3 class="text-center" id="alumnos" style="font-weight: bold; margin-bottom: 9px;">
                                        Alumno colaborador <?php echo $row['Numero'] ?>
                                    </h3>
                                    <div class="row">
                                        <div class="col-lg-6 form-group">
                                            <label>
                                                Nombre del Alumno
                                            </label>
                                            <input class="form-control" name="" type="text" value="<?php echo $row['Nombre'].' '.$row['Paterno'].' '.$row['Materno']?>" disabled>
                                        </div>                                                        
                                        <div class="col-lg-2 form-group" style="margin-top: 30px;">
                                            <label>
                                                S.S.
                                            </label>
                                            <input class="form-group" name="" type="checkbox" <?php if ($row['Servicio']==true) {?>checked <?php }?> >
                                        </div>
                                        <div class="col-lg-2 form-group" style="margin-top: 30px;">
                                            <label>
                                                R.P.
                                            </label>
                                            <input class="form-group" name="" type="checkbox" <?php if ($row['Residencia']==true) {?>checked <?php }?> >
                                      
                                        </div>
                                        <div class="col-lg-2 form-group" style="margin-top: 30px;">
                                            <label>
                                                T
                                            </label>
                                            <input class="form-group" name="" type="checkbox" <?php if ($row['Tesis']==true) {?>checked <?php }?> >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 form-group">
                                            <label>
                                                No. control
                                            </label>
                                            <input class="form-control" name="" readonly="" type="text" value="<?php echo $row['NoControl'] ?>">
                                        </div>                                                        
                                        <div class="col-lg-4 form-group">
                                            <label>
                                                Semestre:
                                            </label>
                                             <input class="form-control" name="" readonly="" type="text" value="<?php echo $row['Semestre'] ?>">
                                        </div>                                                        
                                        <div class="col-lg-4 form-group">
                                            <label>
                                                Carrera
                                            </label>
                                            <input class="form-control" name="" readonly="" type="text" value="<?php echo $row['Carrera'] ?>">
                                        </div>
                                        
                                        <div class=" col-lg-12 form-group">
                                            <label>
                                                Detalle de actividades
                                            </label>
                                            <textarea class="form-control" readonly="" rows="3" style="resize:none;"><?php echo $row['Actividades'] ?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div> 
                                <?php 	
                                } ?>
                            </div>
                        </div>
                    </div>
		            <div class="col-lg-4" role="complementary">
		                <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
		                    <ul class="nav bs-docs-sidenav">
		                        <div class="container" id="navObserv">
		                        	<input type="hidden" id="folio" name="folio" value="<?php echo $result['FolioProyecto']; ?>">
		                            <h3>
		                                Observaciones
		                            </h3>
		                            <div class="panel panel-primary panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                Realizar Observaciones
                                            </h5>
                                            <span class="pull-right clickable panel-collapsed">
                                                <i class="glyphicon glyphicon-chevron-down">
                                                </i>
                                            </span>
                                        </div>
                                        <form action="" method="POST" id="formObsInvest">
                                        <input type="hidden" value="<?php echo $result['FolioProyecto'] ?>" name="folio" id="folio" >
                                        <div class="panel-body" style="display: none;">
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#inicioP" style="color: #337ab7">
                                                    Proyecto
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" id="obs_proyecto" name="obs_proyecto" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#recep" style="color: #337ab7">
                                                    Recepción
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_recepcion" id="obs_recepcion" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#colab1" style="color: #337ab7">
                                                    Colaboradores
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_colaboradores" id="obs_colaboradores" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#objetivos" style="color: #337ab7">
                                                    Objetivos
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_objetivos" id="obs_objetivos" rows="5" style="resize:none"></textarea>
                                                    
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#vinculacion" style="color: #337ab7">
                                                    Vinculación
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" id="obs_vinculacion" name="obs_vinculacion" rows="5" style="resize:none"></textarea>
                                                    
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#metas" style="color: #337ab7">
                                                    Metas
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_metas" id="obs_metas" rows="5" style="resize:none"></textarea>
                                                    
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#etapa1" style="color: #337ab7">
                                                    Etapas
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_etapas" id="obs_etapas" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#financ" style="color: #337ab7">
                                                    Financiamiento
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_financiamiento" id="obs_financiamiento" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#al1" style="color: #337ab7">
                                                    Alumnos
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="obs_alumnos" id="obs_alumnos" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                        </form>
                                        </div>
                                    </div>
		                            <div class="panel panel-primary panel-default" id="navObserv">
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
		                                    <form id="obs-Gest" method="_POST">
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#inicioP" style="color: #337ab7">
		                                            Proyecto
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" name="obs_proyecto" id="obs_proyecto" rows="5" style="resize:none"><?php echo $obsCons[0]['ObsGestion'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#recep" style="color: #337ab7">
		                                            Recepción
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_recepcion" name="obs_recepcion" rows="5" style="resize:none"><?php echo $obsCons[1]['ObsGestion'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#colab1" style="color: #337ab7">
		                                            Colaboradores
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_colaboradores" name="obs_colaboradores" rows="5" style="resize:none"><?php echo $obsCons[2]['ObsGestion'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#objetivos" style="color: #337ab7">
		                                            Objetivos
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_objetivos" name="obs_objetivos" rows="5" style="resize:none"><?php echo $obsCons[3]['ObsGestion'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#vinculacion" style="color: #337ab7">
		                                            Vinculación
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_vinculacion" name="obs_vinculacion" rows="5" style="resize:none"><?php echo $obsCons[4]['ObsGestion'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#metas" style="color: #337ab7">
		                                            Metas
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_metas" name="obs_metas" rows="5" style="resize:none"><?php echo $obsCons[5]['ObsGestion'] ?></textarea>
		                                            
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#etapa1" style="color: #337ab7">
		                                            Etapas
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_etapas" name="obs_etapas" rows="5" style="resize:none"><?php echo $obsCons[6]['ObsGestion'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#financ" style="color: #337ab7">
		                                            Financiamiento
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_financiamiento" name="obs_financiamiento" rows="5" style="resize:none"><?php echo $obsCons[7]['ObsGestion'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#al1" style="color: #337ab7">
		                                            Alumnos
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obs_alumnos" name="obs_alumnos" rows="5" style="resize:none"><?php echo $obsCons[8]['ObsGestion'] ?></textarea>
		                                        </div>
		                                    </li>
		                                </div>
		                            	</form>
		                            </div>
		                            <div class="panel panel-primary panel-default" id="navObserv">
		                                <div class="panel-heading">
		                                    <h5 class="panel-title">
		                                        Subdirección de Investigación
		                                    </h5>
		                                    <span class="pull-right clickable panel-collapsed">
		                                        <i class="glyphicon glyphicon-chevron-down">
		                                        </i>
		                                    </span>
		                                </div>
		                                <div class="panel-body" style="display: none;">
		                                    <form id="obs-Com" method="_POST">
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#inicioP" style="color: #337ab7">
		                                            Proyecto
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" name="obsComiteProy" id="obsComiteProy" rows="5" style="resize:none">
		                                            	<?php echo $obsCons[0]['ObsInvest'] ?>
		                                            </textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#recep" style="color: #337ab7">
		                                            Recepción
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteRecep" name="obsComiteRecep" rows="5" style="resize:none"><?php echo $obsCons[1]['ObsInvest'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#colab1" style="color: #337ab7">
		                                            Colaboradores
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteColab" name="obsComiteColab" rows="5" style="resize:none"><?php echo $obsCons[2]['ObsInvest'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#objetivos" style="color: #337ab7">
		                                            Objetivos
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteObj" name="obsComiteObj" rows="5" style="resize:none"><?php echo $obsCons[3]['ObsInvest'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#vinculacion" style="color: #337ab7">
		                                            Vinculación
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteVinc" name="obsComiteVinc" rows="5" style="resize:none"><?php echo $obsCons[4]['ObsInvest'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#metas" style="color: #337ab7">
		                                            Metas
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteMetas" name="obsComiteMetas" rows="5" style="resize:none"><?php echo $obsCons[5]['ObsInvest'] ?></textarea>
		                                            
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#etapa1" style="color: #337ab7">
		                                            Etapas
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteEtapas" name="obsComiteEtapas" rows="5" style="resize:none"><?php echo $obsCons[6]['ObsInvest'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#financ" style="color: #337ab7">
		                                            Financiamiento
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteFinanc" name="obsComiteFinanc" rows="5" style="resize:none"><?php echo $obsCons[7]['ObsInvest'] ?></textarea>
		                                        </div>
		                                    </li>
		                                    <li class="">
		                                        <a class="accordion col-lg-4" href="#al1" style="color: #337ab7">
		                                            Alumnos
		                                        </a>
		                                        <div class="panel2">
		                                            <textarea class="form-control" id="obsComiteAlumnos" name="obsComiteAlumnos" rows="5" style="resize:none"><?php echo $obsCons[8]['ObsInvest'] ?></textarea>
		                                        </div>
		                                    </li>
		                                </div>
		                            </form>
		                            </div>
                                    <li class="">
                                        <a href="#" onclick="guardarObservaciones(6)">
                                            Enviar revisión a Subdirección de Investigación
                                        </a>
                                    </li>
		                            <li class="">
		                                <a data-dismiss="modal" href="">
		                                    Cerrar
		                                </a>
		                            </li>
		                        </div>
		                    </ul>
		                </nav>
		            </div>
        		</div>
            </div>
			<?php
		break;
		default:
			# code...
			break;
	}
 ?>