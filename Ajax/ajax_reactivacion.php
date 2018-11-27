<?php 
session_start();
include('../externas/Clases/classConn.php');
include('../controladores/Clases/clase_consultas.php');
include('../externas/conexion.php');
if (isset($_GET['proyecto'])) 
{
	$folio=$_GET['proyecto'];
}
else
{
	if (isset($_POST['proyecto'])) {
		$folio=$_POST['proyecto'];
	}
}
if (isset($_POST['accion'])) {
	$accion =$_POST['accion'];
}
else
{
	$accion =$_GET['accion'];
}
switch ($accion) {
	case 'solicitaReact':
		$motivo=$_POST['motivo'];
		$sql='UPDATE proyecto SET "pendienteRevisar"=1,"docenteSolicitante"='.$_SESSION['NoPersonal'].',"motivoReactivacion"=\''.$motivo.'\' WHERE "FolioProyecto"=\''.$folio.'\'';
		$resultado=pg_query($conexion, $sql);
		break;
	case 'revisaSol':
        $conn=new ClaseConsultas();
        $solicitud=$conn->getInfoSolicitudReactivacion($folio);
		$docentes=$conn->consultaTodosDocentes();
        $colaboradores=$conn->getColaboradores($folio);
		?>
        <h1 class="text-center" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
            Información del proyecto
        </h1>
        <div class="row">
            <div class="row">
            <div class="col-sm-4 form-group">
                <label>
                    Proyecto
                </label>
                <input class="form-control" name="" type="text" value="<?php echo $solicitud['NombreProyecto'] ?>">
                </input>
            </div>
            <div class="col-sm-4 form-group">
                <label>
                    Fecha de cancelación
                </label>
                <input class="form-control" name="" type="text" value="<?php echo $solicitud['FechaCanc'] ?>">
                </input>
                <input type="hidden" value="<?php echo $folio ?>" id="folioProyecto" />
            </div>
            <div class="col-sm-4 form-group">
                <label>
                    Fecha de solicitud
                </label>
                <input class="form-control" name="" type="text" value="<?php echo $solicitud['FechaSol'] ?>">
                </input>
            </div>
        </div>
        <div class="form-group">
            <label>
                Motivos de cancelación
            </label>
            <textarea class="form-control" rows="4"><?php echo $solicitud['MotivoCanc'] ?></textarea>
        </div>
        <div class="form-group">
            <label>
                Motivos de re-activación
            </label>
            <textarea class="form-control" rows="4"><?php echo $solicitud['MotivoReact'] ?></textarea>
        </div>
        <div class="row">
            <h1 class="text-center" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
                Información del docente responsable
            </h1>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label>
                    Selecciona un docente
                </label>
                <select class="form-control" onchange="cargaInfoDocente(this.value)" id="cboDocente">
                    <option hidden selected value="0">Seleccionar</option>
                    <?php 
                    foreach ($docentes as $docente) 
                    {
                    	?>
                    	<option value="<?php echo $docente['NoPersonal'] ?>"><?php echo $docente['Nombre'] ?></option>
                    	<?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div id="datosDocente">
	        <div class="row">
	            <div class="col-sm-4 form-group">
	                <label>
	                    Apellido paterno
	                </label>
	                <input class="form-control" name="" type="text">
	                </input>
	            </div>
	            <div class="col-sm-4 form-group">
	                <label>
	                    Apellido materno
	                </label>
	                <input class="form-control" name="" type="text">
	                </input>
	            </div>
	            <div class="col-sm-4 form-group">
	                <label>
	                    Nombre(s)
	                </label>
	                <input class="form-control" name="" type="text">
	                </input>
	            </div>
	        </div>
	        <div class="row">
	            <div class="col-sm-3 form-group">
	                <label>
	                    N° Personal
	                </label>
	                <input class="form-control" name="" type="text">
	                </input>
	            </div>
	            <div class="col-sm-3 form-group">
	                <label>
	                    Carrera
	                </label>
	                <input class="form-control" name="" type="text">
	                </input>
	            </div>
	            <div class="col-sm-3 form-group">
	                <label>
	                    Móvil
	                </label>
	                <input class="form-control" name="" type="text">
	                </input>
	            </div>
	            <div class="col-sm-3 form-group">
	                <label>
	                    Correo
	                </label>
	                <input class="form-control" name="" type="text">
	                </input>
	            </div>
	        </div>
        </div>
        <div class="row">
            <h4 style="text-align: center;">
                Historial del docente
            </h4>
            <table class="table" style="float: center;">
                <thead>
                    <tr>
                        <th>
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody id="historialDocente">
                    <tr>
                        <td>
                            Proyectos activos
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Proyectos cancelados
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Retrasos de entregables
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Prórrogas solicitadas
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Cambios de colaboradores
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                    <tr>
                        <td>
                            N° de bloqueos
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                    <tr>
                        <td>
                            N° de sanciones
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <?php 
            foreach ($colaboradores as $row) 
            {
                ?>
            <div class="col-sm-6 form-group">
                <label>
                    Colaborador 1
                </label>
                <br>
                    <label>
                        Anterior:
                    </label>
                    <select class="form-control">
                        <option>
                            Colaborador
                        </option>
                    </select>
                </br>
            </div>
                <?php
            }
            ?>
        </div>
		<?php
	   break;
	case 'docenteInfo':
		$conn=new ClaseConsultas();
		$docente=$_POST['docente'];
		$docentes=$conn->consultaDocentesDetalle($docente);
        $historial=$conn->getHistorialDocente($docente);
		?>
		<div class="row">
	            <div class="col-sm-4 form-group">
	                <label>
	                    Apellido paterno
	                </label>
	                <input class="form-control" name="" type="text" value="<?php echo $docentes['ApellidoP'] ?>">
	                </input>
	            </div>
	            <div class="col-sm-4 form-group">
	                <label>
	                    Apellido materno
	                </label>
	                <input class="form-control" name="" type="text" value="<?php echo $docentes['ApellidoM'] ?>">
	                </input>
	            </div>
	            <div class="col-sm-4 form-group">
	                <label>
	                    Nombre(s)
	                </label>
	                <input class="form-control" name="" type="text" value="<?php echo $docentes['Nombre'] ?>">
	                </input>
	            </div>
	        </div>
	        <div class="row">
	            <div class="col-sm-3 form-group">
	                <label>
	                    N° Personal
	                </label>
	                <input class="form-control" name="" type="text" value="<?php echo $docentes['NoPersonal'] ?>">
	                </input>
	            </div>
	            <div class="col-sm-3 form-group">
	                <label>
	                    Carrera
	                </label>
	                <input class="form-control" name="" type="text" value="<?php echo $docentes['Carrera'] ?>">
	                </input>
	            </div>
	            <div class="col-sm-3 form-group">
	                <label>
	                    Móvil
	                </label>
	                <input class="form-control" name="" type="text" value="<?php echo $docentes['Telefono'] ?>">
	                </input>
	            </div>
	            <div class="col-sm-3 form-group">
	                <label>
	                    Correo
	                </label>
	                <input class="form-control" name="" type="text" value="<?php echo $docentes['Correo'] ?>">
	                </input>
	            </div>
	        </div>
		<?php 
		break;
    case 'docenteHistorial':
        $conn=new ClaseConsultas();
        $docente=$_POST['docente'];
        $historial=$conn->getHistorialDocente($docente);
        ?>
        <tr>
            <td>
                Proyectos activos
            </td>
            <td>
                <?php echo $historial['Activos'] ?>
            </td>
        </tr>
        <tr>
            <td>
                Proyectos cancelados
            </td>
            <td>
                <?php echo $historial['Cancelados'] ?>
            </td>
        </tr>
        <tr>
            <td>
                Retrasos de entregables
            </td>
            <td>
                <?php echo $historial['Retrasos'] ?>
            </td>
        </tr>
        <tr>
            <td>
                Prórrogas solicitadas
            </td>
            <td>
                <?php echo $historial['Prorroga'] ?>
            </td>
        </tr>
        <tr>
            <td>
                Cambios de colaboradores
            </td>
            <td>
                0
            </td>
        </tr>
        <tr>
            <td>
                N° de bloqueos
            </td>
            <td>
                <?php echo $historial['Bloqueos'] ?>
            </td>
        </tr>
        <tr>
            <td>
                N° de sanciones
            </td>
            <td>
                <?php echo $historial['Sanciones'] ?>
            </td>
        </tr>
        <?php
        break;
    case 'aceptarReactivacion':
        $observaciones=$_POST['observaciones'];
        $departamento=$_POST['departamento'];
        $sql='SELECT nextval(\'seq_obsReact\');';
        $consulta = pg_query($conexion, $sql);
        $idObs = pg_fetch_row($consulta);
        $sql='UPDATE PROYECTO SET "idEstado"=12,"docenteSolicitante"=null,"pendienteRevisar"=null WHERE "FolioProyecto"=\''.$folio.'\'';
        pg_query($conexion, $sql);
        $sql='INSERT INTO observacionesreactivacion("idobservacionesreact","observaciones","departamento","FolioProyecto") VALUES('.$idObs[0].',\''.$observaciones.'\','.$departamento.',\''.$folio.'\')';
        pg_query($conexion, $sql);
        break;
        break;
	case 'CancInfo':
        $conn=new ClaseConsultas();
        $solicitud=$conn->getInfoSolicitudReactivacion($proyecto);
        ?>
        <div class="row">
            <div class="col-sm-4 form-group">
                <label>
                    Proyecto
                </label>
                <input class="form-control" name="" type="text" value="<?php echo $solicitud['NombreProyecto'] ?>">
                </input>
            </div>
            <div class="col-sm-4 form-group">
                <label>
                    Fecha de cancelación
                </label>
                <input class="form-control" name="" type="text" value="<?php echo $solicitud['FechaCanc'] ?>">
                </input>
            </div>
            <div class="col-sm-4 form-group">
                <label>
                    Fecha de solicitud
                </label>
                <input class="form-control" name="" type="text" value="<?php echo $solicitud['FechaSol'] ?>">
                </input>
            </div>
        </div>
        <div class="form-group">
            <label>
                Motivos de cancelación
            </label>
            <textarea class="form-control" rows="4"><?php echo $solicitud['MotivoCanc'] ?></textarea>
        </div>
        <div class="form-group">
            <label>
                Motivos de re-activación
            </label>
            <textarea class="form-control" rows="4"><?php echo $solicitud['MotivoReact'] ?></textarea>
        </div>
        <?php
        break;
    case 'enviarSolicitudReact':
        $observaciones=$_POST['observaciones'];
        $departamento=$_POST['departamento'];
        switch ($departamento) 
        {
            case 1:
                $revisar=2;
                break;
            case 2:
                $revisar=3;
                break;
            case 3:
                $revisar=2;
                break;
            default:
                break;
        }
        $sql='SELECT nextval(\'seq_obsReact\');';
        $consulta = pg_query($conexion, $sql);
        $idObs = pg_fetch_row($consulta);
        $sql='UPDATE PROYECTO SET "pendienteRevisar"='.$revisar.' WHERE "FolioProyecto"=\''.$folio.'\'';
        pg_query($conexion, $sql);
        $sql='INSERT INTO observacionesreactivacion("idobservacionesreact","observaciones","departamento","FolioProyecto") VALUES('.$idObs[0].',\''.$observaciones.'\','.$departamento.',\''.$folio.'\')';
        pg_query($conexion, $sql);
        break;
    case 'rechazarSolicitudReact':
        $observaciones=$_POST['observaciones'];
        $departamento=$_POST['departamento'];
        switch ($departamento) 
        {
            case 1:
                $revisar=2;
                break;
            case 2:
                $revisar=4;
                break;
            case 3:
                $revisar=2;
                break;
            default:
                break;
        }
        $sql='SELECT nextval(\'seq_obsReact\');';
        $consulta = pg_query($conexion, $sql);
        $idObs = pg_fetch_row($consulta);
        $sql='UPDATE PROYECTO SET "pendienteRevisar"=0,"docenteSolicitante"=null,"pendienteRevisar"=null WHERE "FolioProyecto"=\''.$folio.'\'';
        pg_query($conexion, $sql);
        $sql='INSERT INTO observacionesreactivacion("idobservacionesreact","observaciones","departamento","FolioProyecto") VALUES('.$idObs[0].',\''.$observaciones.'\','.$departamento.',\''.$folio.'\')';
        pg_query($conexion, $sql);
        break;
    default:
		# code...
		break;
}
?>