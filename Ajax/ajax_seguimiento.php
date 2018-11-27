<?php 
session_start();
include('../externas/Clases/classConn.php');
include('../controladores/Clases/clase_consultas.php');
include('../externas/conexion.php');
$conn= new ClaseConsultas();
if (isset($_GET['entregable'])) {
	$entregable=$_GET['entregable'];
	$etapa=$conn->getEtapa($entregable);
}
if (isset($_GET['proyecto'])) 
{
	$folio=$_GET['proyecto'];
}
else
{
	if (isset($_POST['proyecto'])) 
	{
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
	case 'updateInformeGen1':
		$fechaEntrega=$_POST['fechaEntrega'];
		$sql='UPDATE entregable SET "FechaEntrega"=\''.$fechaEntrega.'\' WHERE "idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
	break;
	case 'updateInformeGen2':
		$noactividad=$_POST['numeroActividades'];
		for ($i=0; $i < $noactividad+1; $i++) 
		{ 
			if ($i==0) {
				$numeroAct='';
			}
			else
			{
				$numeroAct=$i;
			}
			$sql='SELECT nextval(\'seq_actividadesproy\');';
			$consulta=pg_query($conexion, $sql);
			$idActProy = pg_fetch_row($consulta);
			$descripcion=$_POST['descripcionAct_'.$numeroAct];
			$alcance=$_POST['alcanceEntrega_'.$numeroAct];
			$observaciones=$_POST['obsActividades_'.$numeroAct];
			$sql='INSERT INTO actividadesproyecto("NoActividad","DescripcionActividades","Alcance","Observaciones","Entregable_idEntregable", "InformeGeneral_IdInformeGeneral") VALUES('.$i.',\''.$descripcion.'\',\''.$alcance.'\',\''.$observaciones.'\','.$entregable.','.$idActProy[0].')';
			$resultado=pg_query($conexion, $sql);
			// $sql='UPDATE actividadesproyecto SET "NoActividad"=\''.$i.'\', "DescripcionActividades"=\''.$descripcion.'\',"Alcance"=\''.$alcance.'\',"Observaciones"=\''.$observaciones.'\' WHERE "Entregable_idEntregable"='.$entregable;
		}
	break;
	case 'updateInformeGen3':
		$numeroObjetivos=$POST['numeroActividades']+1;
		for ($i=0; $i < $numeroObjetivos; $i++)
		{
			if ($i==0) {
				$numeroObj='';
			}
			else
			{
				$numeroObj=$i;
			}
			$sql='SELECT nextval(\'seq_objAlcanzados\');';
			$consulta=pg_query($conexion, $sql);
			$idObjAlc = pg_fetch_row($consulta);
			$objetivos=$_POST['objInforme_'.$numeroObj];
			$alcance=$_POST['alcanceInforme_'.$numeroObj];
			$observaciones=$_POST['obsInforme_'.$numeroObj];
			$sql='INSERT INTO objetivosalcanzados("NoObjetivos","DescripcionActividades","Alcance","Observaciones","InformeGeneral_IdInformeGeneral","Entregable_idEntregable") VALUES('.$numeroObjetivos.',\''.$objetivos.'\',\''.$alcance.'\',\''.$observaciones.'\','.$idObjAlc[0].',\''.$entregable.'\')';
			$resultado=pg_query($conexion, $sql);
			// $sql='UPDATE objetivosalcanzados SET "NoObjetivos"=\''.$objetivos.'\', "DescripcionActividades"=\''.$descripcion.'\',"Alcance"=\''.$alcance.'\',"Observaciones"=\''.$observaciones.'\' WHERE "Entregable_idEntregable"='.$entregable;
		}
	break;
	case 'updateInformeGen4':
		$entregable=$_GET['entregable'];
		$numeroMetas=$POST['numeroMetas']+1;
		for ($i=0; $i < $numeroMetas; $i++)
		{
			if ($i==0) 
			{
				$numeroMet='';
			}
			else
			{
				$numeroMet=$i;
			}
			$sql='SELECT nextval(\'seq_MetasAlc\');';
			$consulta=pg_query($conexion, $sql);
			$idMetasAlca = pg_fetch_row($consulta);
			$objetivos=$_POST['metasObj_'.$numeroMet];
			$alcance=$_POST['metasAlcance_'.$numeroMet];
			$observaciones=$_POST['obsMetas_'.$numeroMet];
			$sql='INSERT INTO metasAlcanzadas("NoMetas","DescripcionActividades","Alcance","Observaciones","InformeGeneral_IdInformeGeneral","Entregable_idEntregable")VALUES('.$i.',\''.$objetivos.'\',\''.$alcance.'\',\''.$observaciones.'\',\''.$idMetasAlca[0].'\','.$entregable.')';
			$resultado=pg_query($conexion, $sql);
		}
		// $sql='UPDATE metasAlcanzadas SET "NoMetas"=\''.$metas.'\', "DescripcionActividades"=\''.$descripcion.'\',"Alcance"=\''.$alcance.'\',"Observaciones"=\''.$Observaciones.'\' WHERE "Entregable_idEntregable"='.$entregable;
	break;
	case 'updateInformeDet1':
		$entregable=$_GET['entregable'];
		$sql='UPDATE resultados SET "Resultados"=\''.$resultados.'\', "Anexos"=\''.$anexos.'\' WHERE "Entregable_idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
	break;
	case 'updateInformeDet2':
		$entregable=$_GET['entregable'];
		if (isset($_POST['avanceInfDet2'])) {
			$avanceTec=$_POST['avanceInfDet2'];
		}
		else
		{
			$avanceTec=0;
		}
		if (isset($_POST['desInfDet2'])) {
			$desarrolloTec=$_POST['desInfDet2'];
		}
		else
		{
			$desarrolloTec=0;
		}
		if (isset($_POST['creaInfraInfDet2'])) {
			$creaInfraest=$_POST['creaInfraInfDet2'];
		}
		else
		{
			$creaInfraest=0;
		}
		$patentDes=$_POST['creaInfraesInfDet2'];
		$patentAvance=$_POST['avancePatInforme2'];
		$patentInfraest=$_POST['creaInfraesInfDet2'];
		$sql='UPDATE logrosconocimiento SET "AvancesConocimientoCientifico"=\''.$avanceTec.'\', "DesarrolloTecnologico"=\''.$desarrolloTec.'\', "InfraestructuraTecnologica"=\''.$creaInfraest.'\', "PatentableDesarrollo"=\''.$patentDes.'\', "PatentableInfraest"=\''.$patentInfraest.'\', "PatentableCientif"=\''.$patentAvance.'\' WHERE "Entregable_idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
	break;
	case 'updateInformeDet3':
		$entregable=$_GET['entregable'];
		foreach ($_POST as $noControl => $trabajo) {
			if ($noControl!='accion') {
				$noControl=explode('_',$noControl);
				if ($noControl[1]!='') 
				{
					$sql='UPDATE logrosrecursoshumanos SET "NombreTrabajo"=\''.$trabajo.'\' WHERE "Entregable_idEntregable"='.$entregable.' AND "FkNoControl"=\''.$noControl[1].'\'';
				}
			}
		}
		$resultado=pg_query($conexion, $sql);
	break;
	case 'updateInformeDet4':
		$entregable=$_GET['entregable'];
		$numeroLogros=$_POST['numeroLogros']+1;
		for ($i=0; $i < $numeroLogros; $i++)
		{
			if ($i==0) {
				$numeroLogro='';
			}
			else
			{
				$numeroLogro=$i;
			}
			$tituloPon=$_POST['logroTitulo_'.$numeroLogro];
			$tipoPon=$_POST['tipoLogro_'.$numeroLogro];
			$nombreEvto=$_POST['NombreLogro_'.$numeroLogro];
			$lugar=$_POST['lugarLogro_'.$numeroLogro];
			$fecha=$_POST['fechaLogro_'.$numeroLogro];
			$sql='INSERT INTO logrosdivulgacionpublicaciones("TituloDelArticulo","TipoPublicacion","NombrePublicacion","Lugar","Fecha","Entregable_idEntregable") VALUES(\''.$tituloPon.'\',\''.$tipoPon.'\',\''.$nombreEvto.'\',\''.$lugar.'\',\''.$fecha.'\','.$entregable.')';
		// $sql='UPDATE logrosdivulgacionpublicaciones SET "TituloDelArticulo"=\''.$tituloArticulo.'\', "TipoPublicacion"=\''.$tipoPublicacion.'\', "NombrePublicacion"=\''.$nombrePublicacion.'\',"Lugar"=\''.$lugar.'\', "Fecha"=\''.$fecha.'\' WHERE "Entregable_idEntregable"='.$entregable;
			$resultado=pg_query($conexion, $sql);
		}
	break;
	case 'updateInformeDet5':
		$entregable=$_GET['entregable'];
		$numeroPresent=$_POST['numeroPresent']+1;
		for ($i=0; $i < $numeroPresent; $i++)
		{
			if ($i==0) {
				$numeropres='';
			}
			else
			{
				$numeropres=$i;
			}
			$tituloPres=$_POST['tituloPresent_'.$numeropres];
			$tipoPres=$_POST['tipoPresent_'.$numeropres];
			$nombreEvto=$_POST['nombrePresent_'.$numeropres];
			$lugar=$_POST['lugarPresent_'.$numeropres];
			$fecha=$_POST['fechaPresent_'.$numeropres];
			$sql='INSERT INTO logrospresentacioneseventos("TituloPonencia","TipoDePonencia","NombreEvento","Lugar","Fecha","Entregable_idEntregable") VALUES(\''.$tituloPres.'\',\''.$tipoPres.'\',\''.$nombreEvto.'\',\''.$lugar.'\',\''.$fecha.'\','.$entregable.')';
			$resultado=pg_query($conexion, $sql);
			// $sql='UPDATE logrospresentacioneseventos SET "TituloPonencia"=\''.$titulo.'\', "TipoDePonencia"=\''.$tipo.'\', "NombreEvento"=\''.$nombreEvento.'\',"Lugar"=\''.$lugar.'\', "Fecha"=\''.$fecha.'\' WHERE "Entregable_idEntregable"='.$entregable;
		}
	break;
	case 'updateResumenEj1':
		$entregable=$_GET['entregable'];
		$resumen=$_POST['resumenEj1'];
		$sql='UPDATE resumenejecutivo SET "Resumen"=\''.$resumen.'\' WHERE "Entregable_idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
	break;
	case 'formResumenEj2':
		$entregable=$_GET['entregable'];
		$comentarios=$_POST['obsResumenEj2'];
		$sql='UPDATE resumenejecutivo SET "Comentarios"=\''.$comentarios.'\' WHERE "Entregable_idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
	break;
	case 'getEntregable':
		$entrega=$conn->getEntregable($entregable);
		$actividades=$conn->getActividades($entregable);
		$objAlcanzados=$conn->objAlcanzados($entregable);
		$metasAlcanzadas=$conn->metasAlcanzadas($entregable);
		$logrosRH=$conn->getLogrosRH($entregable);
		$logrosDivulgacion=$conn->getLogrosDivulgacion($entregable);
		$logrosPresentacion=$conn->getLogrosPresentacion($entregable);
		?>
		<form action="" method="get">
	        <div class="container" style="margin-top: 0;">
	            <div class="col-lg-12 " style="margin-top: 10px;">
	                <div class="col-lg-8">
	                    <div class="" style="margin-top: 0;">
	                        <div class="col-lg-12 well" style="border-color: black;">
	                            <div class="" style="margin-top: 0;">
	                                <div class="col-lg-12 well" style="border-color: black;">
	                                    <div class="row">
	                                        <div class="col-sm-12 form-group">
	                                            <h1 class="text-center" id="informeG" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
	                                                I.- Informe General
	                                            </h1>
	                                            <table class="table table-bordered">                                                                            
	                                                <thead>
	                                                    <tr>
	                                                        <th>
	                                                            <label>
	                                                                Clave*
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Nombre Completo
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Participación
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Firma
	                                                            </label>
	                                                        </th>
	                                                    </tr>
	                                                </thead>
	                                                <tbody>
	                                                    <tr id="informe_general">
	                                                    </tr>
	                                                </tbody>
	                                            </table>
	                                        </div>
	                                    </div>
	                                    <label>
	                                        *CLAVE: Número de personal, en caso de ser docente o administrativo; o número de control en caso de se alumno o egresado.** PARTICIPACIÓN: Responsable, suplente del responsable, colaborador.
	                                    </label>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    B).- Describa de manera general las actividades que se están desarrollando con relación al proyecto:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
	                                                            <?php 
	                                                            foreach ($actividades as $row) {
                                                            	?>
	                                                            <tr>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['NoActividad'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Descripcion'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td colspan="2">
	                                                                    <label>
	                                                                        <?php echo $row['Alcance'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Observaciones'] ?>
	                                                                    </label>
	                                                                </td>
	                                                            </tr>
	                                                            	<?php
	                                                            }
	                                                             ?>
	                                                        </thead>
	                                                        <tbody>
	                                                            <tr id="infor_des">
	                                                                
	                                                            </tr>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    c).- Describa de manera general los objetivos alcanzados al momento, indicando si sufrieron modificaciones con relación al planteamiento inicial:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
	                                                            <?php 
	                                                            foreach ($objAlcanzados as $row) {
                                                            	?>
	                                                            <tr>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['NoObjetivo'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Descripcion'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td colspan="2">
	                                                                    <label>
	                                                                        <?php echo $row['Alcance'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Observaciones'] ?>
	                                                                    </label>
	                                                                </td>
	                                                            </tr>
	                                                            	<?php
	                                                            }
	                                                             ?>
	                                                        </thead>
	                                                        <tbody>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    D).- Describa de manera general las metas alcanzadas al momento, indicando si sufrieron modificaciones con relación al planteamiento inicial:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
                                                        	<?php 
                                                            foreach ($metasAlcanzadas as $row) {
                                                        	?>
                                                            <tr>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['NoMetas'] ?>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['Descripcion'] ?>
                                                                    </label>
                                                                </td>
                                                                <td colspan="2">
                                                                    <label>
                                                                        <?php echo $row['Alcance'] ?>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['Observaciones'] ?>
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            	<?php
                                                            }
                                                            ?>
	                                                        </thead>
	                                                        <tbody>
	                                                            <tr>
	                                                            </tr>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
									<!------------------------------------------------------------------->
	                                <div class="" style="margin-top: 0;">
	                                    <div class="col-lg-12 well" style="border-color: black;">
	                                        <div class="" style="margin-top: 0;">
	                                            <h1 class="text-center" id="informeI" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
	                                                II. Informe Detallado
	                                            </h1>
	                                            <div class="col-lg-12 well" style="border-color: black;">
	                                                <div class="row">
	                                                    <br>
	                                                        <strong>a) Describa de manera general los resultados obtenidos hasta el momento (anexe tablas, gráficas, memorias de cálculo y lo que considere pertinente para apoyar sus resultados)</strong>
	                                                    <div class="col-sm-12 form-group">
	                                                        <textarea name="" id="textResultados" cols="120" rows="5" disabled=""><?php echo $entrega['Resultados'] ?></textarea>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <thead>
	                                                                    <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            No. de Control
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del Alumno
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del trabajo (Tesis)
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Categoría*
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                </thead>
	                                                                <tbody>
	                                                                    <?php 
	                                                                    foreach ($logrosRH as $row) 
	                                                                    {
	                                                                    	?>
																		<tr>
																			<td><?php echo $row['NoControl'] ?></td>
																			<td><?php echo $row['NombreAl'] ?></td>
																			<td><?php echo $row['NombreTrabajo'] ?></td>
																			<td><?php echo $row['Categoria'] ?></td>
																		</tr>
	                                                                    	<?php
	                                                                    }
	                                                                     ?>
	                                                                </tbody>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *CATEGORÍA: Servicio social, residencia profesional, tesis de licenciatura, tesis de especialización, tesis de maestría, tesis doctoral.
	                                            </label>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <label>
	                                                            D) Logros en divulgación por publicaciones (anexe copia del artículo y constancia de su publicación)
	                                                        </label>
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            Titulo del Articulo
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Tipo de Publicación*
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre de la publicación
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            LUGAR (Indicar si es WEB)
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Fecha
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                <?php 
	                                                                foreach ($logrosDivulgacion as $row) {
	                                                                	?>
																	<tr>
	                                                                    <td><?php echo $row['TituloDelArticulo'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['TipoPublicacion'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['NombrePublicacion'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Lugar'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Fecha'] ?>
	                                                                    </td>
	                                                                </tr>
	                                                                	<?php
	                                                                }
	                                                                ?>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *TIPO DE PUBLICACIÓN: Revista arbitrada, revista sin arbitraje, boletín, memoria, libro, periódico.
	                                            </label>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <label>
	                                                            E).-Logros en presentaciones en eventos (anexe copia del reconocimiento, invitación y programa)
	                                                        </label>
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            Titulo de la Ponencia
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Tipo de Ponencia*
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del Evento
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            LUGAR
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Fecha
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                <?php 
	                                                                foreach ($logrosPresentacion as $row) {
	                                                                	?>
																	<tr>
	                                                                    <td><?php echo $row['TituloPonencia'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['TipoPonencia'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['NombreEvento'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Lugar'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Fecha'] ?>
	                                                                    </td>
	                                                                </tr>
	                                                                	<?php
	                                                                }
	                                                                ?>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *TIPO DE PONENCIA: Conferencia magistral, mesa redonda, cartel.
	                                            </label>
	                                        </div>
	                                    </div>
										<!------------------------------------------------------------------>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <div class="col-sm-12">
	                                                    <div class="" style="margin-top: 0;">
	                                                        <h1 class="text-center" id="resumen" style="font-weight: Yu Gothic UI Light;">
	                                                            III. Resumen Ejecutivo
	                                                        </h1>
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="form-group">
	                                                                    <label>
	                                                                        Con la finalidad de difundir su investigación, explique en forma clara y concisa en qué consiste su proyecto, incluyendo los beneficios obtenidos hasta el momento (de preferencia utilice un máximo de veinte renglones).
	                                                                    </label>
	                                                                </div>
	                                                                <div class="form-group">
	                                                                    <textarea class="form-control" disabled name="textarea" rows="4"><?php echo $entrega['Resumen'] ?></textarea>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="" style="margin-top: 0;">
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="form-group">
	                                                                    <label>
	                                                                        OBSERVACIONES: Utilice este espacio para sus comentarios y sugerencias.
	                                                                    </label>
	                                                                </div>
	                                                                <div class="from-group">
	                                                                    <textarea class="form-control" disabled="" name="textarea" rows="4"><?php echo $entrega['Resumen'] ?></textarea>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="" style="margin-top: 0;">
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="col-sm-3">
	                                                                    <label>
	                                                                        Nombre del Responsable:
	                                                                    </label>
	                                                                </div>
	                                                                <div class="col-sm-4">
	                                                                    <label>
	                                                                        <?php echo $entrega['NombreResp'] ?>
	                                                                    </label>
	                                                                </div>
	                                                            </div>
	                                                            <div class="row">
	                                                                <div class="col-sm-2">
	                                                                    <label>
	                                                                        Firma del Responsable
	                                                                    </label>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	    			<!------------------------------------------------------------------------------->
	                <div class="col-lg-4" role="complementary">
	                    <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
	                        <ul class="nav bs-docs-sidenav">
	                            <div class="container" id="navObserv">
	                                <h3>
	                                    Observaciones
	                                </h3>
	                                <div class="panel panel-primary panel-default">
	                                <form id="formObs" name="formObs" method="_POST" >
		                           		<div class="panel-heading">
			                                <h5 class="panel-title">
			                                    Observaciones
			                                </h5>
			                                <span class="pull-right clickable panel-collapsed">
			                                    <i class="glyphicon glyphicon-chevron-down">
			                                    </i>
			                                </span>
			                            </div>
			                            <div class="panel-body" style="display: none;">
			                                <li class="">
			                                    <a class="accordion col-lg-4" href="#informe" style="color: #337ab7">
			                                        Informe General I
			                                    </a>
			                                    <div class="panel2">
			                                        <textarea class="form-control" name="informeGeneral1" rows="5" id="informeGeneral1" style="resize:none">
			                                        </textarea>
			                                        <br>
		                                            <br>
			                                    </div>
			                                </li>
			                                <li class="">
			                                    <a class="accordion col-lg-4" href="#informeII" style="color: #337ab7">
			                                        Informe Detallado II
			                                    </a>
			                                    <div class="panel2">
			                                        <textarea class="form-control" name="informeDetallado1" rows="5" id="informeDetallado1" style="resize:none">
			                                        </textarea>
			                                        <br>
		                                            <br>
			                                    </div>
			                                </li>
			                                <li class="">
			                                    <a class="accordion col-lg-4" href="#informeIII" style="color: #337ab7">
			                                        Resumen Ejecutivo III
			                                    </a>
			                                    <div class="panel2">
			                                        <textarea class="form-control" id="resumenEjec1" name="resumenEjec1" rows="5" style="resize:none">
			                                        </textarea>
			                                        <br>
			                                            <br>
			                                    </div>
			                                </li>
			                            </div>
                        			</form>
                        			</div>
	                                <!------------------------------------------------------------------->
	                                <div class="panel panel-primary panel-default" id="" >
		                           		<div class="panel-heading">
			                                <h5 class="panel-title">
			                                    Subdirección de Investigación y Posgrado
			                                </h5>
			                                <span class="pull-right clickable panel-collapsed">
			                                    <i class="glyphicon glyphicon-chevron-down">
			                                    </i>
			                                </span>
			                            </div>
			                            <div class="panel-body" style="display: none;">
			                                <li class="">
			                                    <a class="accordion col-lg-4" href="#informe" style="color: #337ab7">
			                                        Informe General I
			                                    </a>
			                                    <div class="panel2">
			                                        <textarea class="form-control" name="" rows="5" style="resize:none">
			                                        </textarea>
			                                        <br>
		                                            <br>
			                                    </div>
			                                </li>
			                                <li class="">
			                                    <a class="accordion col-lg-4" href="#informeII" style="color: #337ab7">
			                                        Informe Detallado II
			                                    </a>
			                                    <div class="panel2">
			                                        <textarea class="form-control" name="" rows="5" style="resize:none">
			                                        </textarea>
			                                        <br>
		                                            <br>
			                                    </div>
			                                </li>
			                                <li class="">
			                                    <a class="accordion col-lg-4" href="#informeIII" style="color: #337ab7">
			                                        Resumen Ejecutivo III
			                                    </a>
			                                    <div class="panel2">
			                                        <textarea class="form-control" name="" rows="5" style="resize:none">
			                                        </textarea>
			                                        <br>
		                                            <br>
			                                    </div>
			                                </li>
			                            </div>
                        			</div>
                        			<div class="panel panel-primary panel-default">
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
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informe" style="color: #337ab7">
                                                    Informe General I
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" id="" name="" rows="5" style="resize:none"></textarea>
                                                   
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeII" style="color: #337ab7">
                                                    Informe Detallado II
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" id="" name="" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeIII" style="color: #337ab7">
                                                    Resumen Ejecutivo III
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" id="" name="" rows="5" style="resize:none"></textarea>
                                                </div>
                                            </li>
                                        </div>
                                    </div>
	                                <li class="">
	                                    <a href="#" onclick="aceptar(<?php echo $entregable ?>)">
	                                        Aceptar Entrega
	                                    </a>
	                                </li>
	                                <li class="">
	                                    <a href="#" onclick="enviarRevision('Consejo')">
	                                        Enviar a Consejo de Investigación
	                                    </a>
	                                </li>
	                                <li class="">
	                                    <a href="#" onclick="enviarRevision('Docente')">
	                                        Regresar revisión a Docente Resposable
	                                    </a>
	                                </li>
	                                <li class="">
	                                </li>
	                                <li class="">
	                                    <a data-dismiss="modal" href="#">
	                                        Cerrar
	                                    </a>
	                                </li>
	                            </div>
	                        </ul>
	                    </nav>
	                </div>
	            </div>
	        </div>
	    </form>
	    <script>
		var acc = document.getElementsByClassName("accordion");
		var i;
		for (i = 0; i < acc.length; i++) 
		{
		  acc[i].onclick = function() 
		  {
		    this.classList.toggle("active");
		    var panel = this.nextElementSibling;
		    if (panel.style.maxHeight)
		    {
		      panel.style.maxHeight = null;
		    } else 
		    {
		      panel.style.maxHeight = panel.scrollHeight + "px";
		    } 
		  }
		}
		$(document).on('click', '.panel-heading span.clickable',function(e)
		{
		  var $this = $(this);
		  if(!$this.hasClass('panel-collapsed')) 
		  {
		    $this.parents('.panel').find('.panel-body').slideUp();
		    $this.addClass('panel-collapsed');
		    $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		  } 
		  else 
		  {
		    $this.parents('.panel').find('.panel-body').slideDown();
		    $this.removeClass('panel-collapsed');
		    $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		  }
		})
		</script>
		<?php
	break;
	case 'getEntregableComite':
		$entrega=$conn->getEntregable($entregable);
		$actividades=$conn->getActividades($entregable);
		$objAlcanzados=$conn->objAlcanzados($entregable);
		$metasAlcanzadas=$conn->metasAlcanzadas($entregable);
		$logrosRH=$conn->getLogrosRH($entregable);
		$logrosDivulgacion=$conn->getLogrosDivulgacion($entregable);
		$logrosPresentacion=$conn->getLogrosPresentacion($entregable);
		?>
		<form action="" method="get">
	        <div class="container" style="margin-top: 0;">
	            <div class="col-lg-12 " style="margin-top: 10px;">
	                <div class="col-lg-8">
	                    <div class="" style="margin-top: 0;">
	                        <div class="col-lg-12 well" style="border-color: black;">
	                            <div class="" style="margin-top: 0;">
	                                <div class="col-lg-12 well" style="border-color: black;">
	                                    <div class="row">
	                                        <div class="col-sm-12 form-group">
	                                            <h1 class="text-center" id="informeG" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
	                                                I.- Informe General
	                                            </h1>
	                                            <table class="table table-bordered">                                                                            
	                                                <thead>
	                                                    <tr>
	                                                        <th>
	                                                            <label>
	                                                                Clave*
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Nombre Completo
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Participación
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Firma
	                                                            </label>
	                                                        </th>
	                                                    </tr>
	                                                </thead>
	                                                <tbody>
	                                                    <tr id="informe_general">
	                                                    </tr>
	                                                </tbody>
	                                            </table>
	                                        </div>
	                                    </div>
	                                    <label>
	                                        *CLAVE: Número de personal, en caso de ser docente o administrativo; o número de control en caso de se alumno o egresado.** PARTICIPACIÓN: Responsable, suplente del responsable, colaborador.
	                                    </label>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    B).- Describa de manera general las actividades que se están desarrollando con relación al proyecto:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
	                                                            <?php 
	                                                            foreach ($actividades as $row) {
                                                            	?>
	                                                            <tr>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['NoActividad'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Descripcion'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td colspan="2">
	                                                                    <label>
	                                                                        <?php echo $row['Alcance'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Observaciones'] ?>
	                                                                    </label>
	                                                                </td>
	                                                            </tr>
	                                                            	<?php
	                                                            }
	                                                             ?>
	                                                        </thead>
	                                                        <tbody>
	                                                            <tr id="infor_des">
	                                                                
	                                                            </tr>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    c).- Describa de manera general los objetivos alcanzados al momento, indicando si sufrieron modificaciones con relación al planteamiento inicial:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
	                                                            <?php 
	                                                            foreach ($objAlcanzados as $row) {
                                                            	?>
	                                                            <tr>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['NoObjetivo'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Descripcion'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td colspan="2">
	                                                                    <label>
	                                                                        <?php echo $row['Alcance'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Observaciones'] ?>
	                                                                    </label>
	                                                                </td>
	                                                            </tr>
	                                                            	<?php
	                                                            }
	                                                             ?>
	                                                        </thead>
	                                                        <tbody>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    D).- Describa de manera general las metas alcanzadas al momento, indicando si sufrieron modificaciones con relación al planteamiento inicial:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
                                                        	<?php 
                                                            foreach ($metasAlcanzadas as $row) {
                                                        	?>
                                                            <tr>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['NoMetas'] ?>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['Descripcion'] ?>
                                                                    </label>
                                                                </td>
                                                                <td colspan="2">
                                                                    <label>
                                                                        <?php echo $row['Alcance'] ?>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['Observaciones'] ?>
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            	<?php
                                                            }
                                                            ?>
	                                                        </thead>
	                                                        <tbody>
	                                                            <tr>
	                                                            </tr>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
									<!------------------------------------------------------------------->
	                                <div class="" style="margin-top: 0;">
	                                    <div class="col-lg-12 well" style="border-color: black;">
	                                        <div class="" style="margin-top: 0;">
	                                            <h1 class="text-center" id="informeI" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
	                                                II. Informe Detallado
	                                            </h1>
	                                            <div class="col-lg-12 well" style="border-color: black;">
	                                                <div class="row">
	                                                    <br>
	                                                        <strong>a) Describa de manera general los resultados obtenidos hasta el momento (anexe tablas, gráficas, memorias de cálculo y lo que considere pertinente para apoyar sus resultados)</strong>
	                                                    <div class="col-sm-12 form-group">
	                                                        <textarea name="" id="textResultados" cols="120" rows="5" disabled=""><?php echo $entrega['Resultados'] ?></textarea>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <thead>
	                                                                    <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            No. de Control
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del Alumno
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del trabajo (Tesis)
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Categoría*
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                </thead>
	                                                                <tbody>
	                                                                    <?php 
	                                                                    foreach ($logrosRH as $row) 
	                                                                    {
	                                                                    	?>
																		<tr>
																			<td><?php echo $row['NoControl'] ?></td>
																			<td><?php echo $row['NombreAl'] ?></td>
																			<td><?php echo $row['NombreTrabajo'] ?></td>
																			<td><?php echo $row['Categoria'] ?></td>
																		</tr>
	                                                                    	<?php
	                                                                    }
	                                                                     ?>
	                                                                </tbody>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *CATEGORÍA: Servicio social, residencia profesional, tesis de licenciatura, tesis de especialización, tesis de maestría, tesis doctoral.
	                                            </label>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <label>
	                                                            D) Logros en divulgación por publicaciones (anexe copia del artículo y constancia de su publicación)
	                                                        </label>
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            Titulo del Articulo
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Tipo de Publicación*
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre de la publicación
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            LUGAR (Indicar si es WEB)
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Fecha
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                <?php 
	                                                                foreach ($logrosDivulgacion as $row) {
	                                                                	?>
																	<tr>
	                                                                    <td><?php echo $row['TituloDelArticulo'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['TipoPublicacion'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['NombrePublicacion'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Lugar'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Fecha'] ?>
	                                                                    </td>
	                                                                </tr>
	                                                                	<?php
	                                                                }
	                                                                ?>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *TIPO DE PUBLICACIÓN: Revista arbitrada, revista sin arbitraje, boletín, memoria, libro, periódico.
	                                            </label>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <label>
	                                                            E).-Logros en presentaciones en eventos (anexe copia del reconocimiento, invitación y programa)
	                                                        </label>
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            Titulo de la Ponencia
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Tipo de Ponencia*
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del Evento
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            LUGAR
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Fecha
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                <?php 
	                                                                foreach ($logrosPresentacion as $row) {
	                                                                	?>
																	<tr>
	                                                                    <td><?php echo $row['TituloPonencia'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['TipoPonencia'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['NombreEvento'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Lugar'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Fecha'] ?>
	                                                                    </td>
	                                                                </tr>
	                                                                	<?php
	                                                                }
	                                                                ?>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *TIPO DE PONENCIA: Conferencia magistral, mesa redonda, cartel.
	                                            </label>
	                                        </div>
	                                    </div>
										<!------------------------------------------------------------------>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <div class="col-sm-12">
	                                                    <div class="" style="margin-top: 0;">
	                                                        <h1 class="text-center" id="resumen" style="font-weight: Yu Gothic UI Light;">
	                                                            III. Resumen Ejecutivo
	                                                        </h1>
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="form-group">
	                                                                    <label>
	                                                                        Con la finalidad de difundir su investigación, explique en forma clara y concisa en qué consiste su proyecto, incluyendo los beneficios obtenidos hasta el momento (de preferencia utilice un máximo de veinte renglones).
	                                                                    </label>
	                                                                </div>
	                                                                <div class="form-group">
	                                                                    <textarea class="form-control" disabled name="textarea" rows="4"><?php echo $entrega['Resumen'] ?></textarea>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="" style="margin-top: 0;">
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="form-group">
	                                                                    <label>
	                                                                        OBSERVACIONES: Utilice este espacio para sus comentarios y sugerencias.
	                                                                    </label>
	                                                                </div>
	                                                                <div class="from-group">
	                                                                    <textarea class="form-control" disabled="" name="textarea" rows="4"><?php echo $entrega['Resumen'] ?></textarea>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="" style="margin-top: 0;">
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="col-sm-3">
	                                                                    <label>
	                                                                        Nombre del Responsable:
	                                                                    </label>
	                                                                </div>
	                                                                <div class="col-sm-4">
	                                                                    <label>
	                                                                        <?php echo $entrega['NombreResp'] ?>
	                                                                    </label>
	                                                                </div>
	                                                            </div>
	                                                            <div class="row">
	                                                                <div class="col-sm-2">
	                                                                    <label>
	                                                                        Firma del Responsable
	                                                                    </label>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	    			<!------------------------------------------------------------------------------->
	                <div class="col-lg-4" role="complementary">
                        <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
                            <ul class="nav bs-docs-sidenav">
                                <div class="container" id="navObserv">
                                    <h3>
                                        Observaciones
                                    </h3>
                                    <div class="panel panel-primary panel-default">
                                        <form action="">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                Realizar Observaciones
                                            </h5>
                                            <span class="pull-right clickable panel-collapsed">
                                                <i class="glyphicon glyphicon-chevron-down">
                                                </i>
                                            </span>
                                        </div>
                                        <div class="panel-body" style="display: none;">
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informe" style="color: #337ab7">
                                                    Informe General I
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="informeGeneral1" rows="5" style="resize:none">
                                                    </textarea>
                                                   
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeII" style="color: #337ab7">
                                                    Informe Detallado II
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="informeDetallado1" rows="5" style="resize:none">
                                                    </textarea>
                                                    
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeIII" style="color: #337ab7">
                                                    Resumen Ejecutivo III
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="resumenEjec1" rows="5" style="resize:none">
                                                    </textarea>
                                                   
                                                </div>
                                            </li>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="panel panel-primary panel-default">
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
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informe" style="color: #337ab7">
                                                    Informe General I
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                   
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeII" style="color: #337ab7">
                                                    Informe Detallado II
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                   
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeIII" style="color: #337ab7">
                                                    Resumen Ejecutivo III
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    
                                                </div>
                                            </li>
                                        </div>
                                    </div>
                                    <div class="panel panel-primary panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                Subdirección de Investigación y Posgrado
                                            </h5>
                                            <span class="pull-right clickable panel-collapsed">
                                                <i class="glyphicon glyphicon-chevron-down">
                                                </i>
                                            </span>
                                        </div>
                                        <div class="panel-body" style="display: none;">
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informe" style="color: #337ab7">
                                                    Informe General I
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeII" style="color: #337ab7">
                                                    Informe Detallado II
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#informeIII" style="color: #337ab7">
                                                    Resumen Ejecutivo III
                                                </a>
                                                <div class="panel2">
                                                    <textarea class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    
                                                </div>
                                            </li>
                                        </div>
                                    </div>
                                    <li class="">
                                        <a href="#" onclick="RegresarInvestigacion(<?php echo $entregable ?>)">
                                            Regresar revisión a Subdirección de Investigación y Posgrado
                                        </a>
                                    </li>
                                    <li class="">
                                    </li>
                                    <li class="">
                                        <a data-dismiss="modal" href="#">
                                            Cerrar
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </nav>
                    </div>
	            </div>
	        </div>
	    </form>
	    <script>
		var acc = document.getElementsByClassName("accordion");
		var i;
		for (i = 0; i < acc.length; i++) 
		{
		  acc[i].onclick = function() 
		  {
		    this.classList.toggle("active");
		    var panel = this.nextElementSibling;
		    if (panel.style.maxHeight)
		    {
		      panel.style.maxHeight = null;
		    } else 
		    {
		      panel.style.maxHeight = panel.scrollHeight + "px";
		    } 
		  }
		}
		</script>
		<script type="text/javascript">
		$(document).on('click', '.panel-heading span.clickable',function(e)
		{
		  var $this = $(this);
		  if(!$this.hasClass('panel-collapsed')) 
		  {
		    $this.parents('.panel').find('.panel-body').slideUp();
		    $this.addClass('panel-collapsed');
		    $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		  } 
		  else 
		  {
		    $this.parents('.panel').find('.panel-body').slideDown();
		    $this.removeClass('panel-collapsed');
		    $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		  }
		})
		</script>
		<?php
	break;
	case 'getEntregableGest':
		$entrega=$conn->getEntregable($entregable);
		$actividades=$conn->getActividades($entregable);
		$objAlcanzados=$conn->objAlcanzados($entregable);
		$metasAlcanzadas=$conn->metasAlcanzadas($entregable);
		$logrosRH=$conn->getLogrosRH($entregable);
		$logrosDivulgacion=$conn->getLogrosDivulgacion($entregable);
		$logrosPresentacion=$conn->getLogrosPresentacion($entregable);
		?>
		<form action="" method="get">
	        <div class="container" style="margin-top: 0;">
	            <div class="col-lg-12 " style="margin-top: 10px;">
	                <div class="col-lg-8">
	                    <div class="" style="margin-top: 0;">
	                        <div class="col-lg-12 well" style="border-color: black;">
	                            <div class="" style="margin-top: 0;">
	                                <div class="col-lg-12 well" style="border-color: black;">
	                                    <div class="row">
	                                        <div class="col-sm-12 form-group">
	                                            <h1 class="text-center" id="informeG" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
	                                                I.- Informe General
	                                            </h1>
	                                            <table class="table table-bordered">           
	                                                <thead>
	                                                    <tr>
	                                                        <th>
	                                                            <label>
	                                                                Clave*
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Nombre Completo
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Participación
	                                                            </label>
	                                                        </th>
	                                                        <th>
	                                                            <label>
	                                                                Firma
	                                                            </label>
	                                                        </th>
	                                                    </tr>
	                                                </thead>
	                                                <tbody>
	                                                    <tr id="informe_general">
	                                                    </tr>
	                                                </tbody>
	                                            </table>
	                                        </div>
	                                    </div>
	                                    <label>
	                                        *CLAVE: Número de personal, en caso de ser docente o administrativo; o número de control en caso de se alumno o egresado.** PARTICIPACIÓN: Responsable, suplente del responsable, colaborador.
	                                    </label>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    B).- Describa de manera general las actividades que se están desarrollando con relación al proyecto:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
	                                                            <?php 
	                                                            foreach ($actividades as $row) {
                                                            	?>
	                                                            <tr>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['NoActividad'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Descripcion'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td colspan="2">
	                                                                    <label>
	                                                                        <?php echo $row['Alcance'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Observaciones'] ?>
	                                                                    </label>
	                                                                </td>
	                                                            </tr>
	                                                            	<?php
	                                                            }
	                                                             ?>
	                                                        </thead>
	                                                        <tbody>
	                                                            <tr id="infor_des">
	                                                                
	                                                            </tr>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    c).- Describa de manera general los objetivos alcanzados al momento, indicando si sufrieron modificaciones con relación al planteamiento inicial:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
	                                                            <?php 
	                                                            foreach ($objAlcanzados as $row) {
                                                            	?>
	                                                            <tr>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['NoObjetivo'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Descripcion'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td colspan="2">
	                                                                    <label>
	                                                                        <?php echo $row['Alcance'] ?>
	                                                                    </label>
	                                                                </td>
	                                                                <td>
	                                                                    <label>
	                                                                        <?php echo $row['Observaciones'] ?>
	                                                                    </label>
	                                                                </td>
	                                                            </tr>
	                                                            	<?php
	                                                            }
	                                                             ?>
	                                                        </thead>
	                                                        <tbody>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <label>
	                                                    D).- Describa de manera general las metas alcanzadas al momento, indicando si sufrieron modificaciones con relación al planteamiento inicial:
	                                                </label>
	                                                <div class="col-sm-12 form-group">
	                                                    <table class="table table-bordered">
	                                                        <thead>
                                                        	<?php 
                                                            foreach ($metasAlcanzadas as $row) {
                                                        	?>
                                                            <tr>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['NoMetas'] ?>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['Descripcion'] ?>
                                                                    </label>
                                                                </td>
                                                                <td colspan="2">
                                                                    <label>
                                                                        <?php echo $row['Alcance'] ?>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <label>
                                                                        <?php echo $row['Observaciones'] ?>
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            	<?php
                                                            }
                                                            ?>
	                                                        </thead>
	                                                        <tbody>
	                                                            <tr>
	                                                            </tr>
	                                                        </tbody>
	                                                    </table>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
									<!------------------------------------------------------------------->
	                                <div class="" style="margin-top: 0;">
	                                    <div class="col-lg-12 well" style="border-color: black;">
	                                        <div class="" style="margin-top: 0;">
	                                            <h1 class="text-center" id="informeI" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
	                                                II. Informe Detallado
	                                            </h1>
	                                            <div class="col-lg-12 well" style="border-color: black;">
	                                                <div class="row">
	                                                    <br>
	                                                        <strong>a) Describa de manera general los resultados obtenidos hasta el momento (anexe tablas, gráficas, memorias de cálculo y lo que considere pertinente para apoyar sus resultados)</strong>
	                                                    <div class="col-sm-12 form-group">
	                                                        <textarea name="" id="textResultados" cols="120" rows="5" disabled=""><?php echo $entrega['Resultados'] ?></textarea>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <thead>
	                                                                    <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            No. de Control
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del Alumno
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del trabajo (Tesis)
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Categoría*
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                </thead>
	                                                                <tbody>
	                                                                    <?php 
	                                                                    foreach ($logrosRH as $row) 
	                                                                    {
	                                                                    	?>
																		<tr>
																			<td><?php echo $row['NoControl'] ?></td>
																			<td><?php echo $row['NombreAl'] ?></td>
																			<td><?php echo $row['NombreTrabajo'] ?></td>
																			<td><?php echo $row['Categoria'] ?></td>
																		</tr>
	                                                                    	<?php
	                                                                    }
	                                                                     ?>
	                                                                </tbody>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *CATEGORÍA: Servicio social, residencia profesional, tesis de licenciatura, tesis de especialización, tesis de maestría, tesis doctoral.
	                                            </label>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <label>
	                                                            D) Logros en divulgación por publicaciones (anexe copia del artículo y constancia de su publicación)
	                                                        </label>
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            Titulo del Articulo
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Tipo de Publicación*
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre de la publicación
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            LUGAR (Indicar si es WEB)
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Fecha
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                <?php 
	                                                                foreach ($logrosDivulgacion as $row) {
	                                                                	?>
																	<tr>
	                                                                    <td><?php echo $row['TituloDelArticulo'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['TipoPublicacion'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['NombrePublicacion'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Lugar'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Fecha'] ?>
	                                                                    </td>
	                                                                </tr>
	                                                                	<?php
	                                                                }
	                                                                ?>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *TIPO DE PUBLICACIÓN: Revista arbitrada, revista sin arbitraje, boletín, memoria, libro, periódico.
	                                            </label>
	                                            <div class="" style="margin-top: 0;">
	                                                <div class="col-lg-12 well" style="border-color: black;">
	                                                    <div class="row">
	                                                        <label>
	                                                            E).-Logros en presentaciones en eventos (anexe copia del reconocimiento, invitación y programa)
	                                                        </label>
	                                                        <div class="col-sm-12 form-group">
	                                                            <table class="table table-bordered">
	                                                                <tr>
	                                                                    <td>
	                                                                        <label>
	                                                                            Titulo de la Ponencia
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Tipo de Ponencia*
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Nombre del Evento
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            LUGAR
	                                                                        </label>
	                                                                    </td>
	                                                                    <td>
	                                                                        <label>
	                                                                            Fecha
	                                                                        </label>
	                                                                    </td>
	                                                                </tr>
	                                                                <?php 
	                                                                foreach ($logrosPresentacion as $row) {
	                                                                	?>
																	<tr>
	                                                                    <td><?php echo $row['TituloPonencia'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['TipoPonencia'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['NombreEvento'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Lugar'] ?>
	                                                                    </td>
	                                                                    <td><?php echo $row['Fecha'] ?>
	                                                                    </td>
	                                                                </tr>
	                                                                	<?php
	                                                                }
	                                                                ?>
	                                                            </table>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <label>
	                                                *TIPO DE PONENCIA: Conferencia magistral, mesa redonda, cartel.
	                                            </label>
	                                        </div>
	                                    </div>
										<!------------------------------------------------------------------>
	                                    <div class="" style="margin-top: 0;">
	                                        <div class="col-lg-12 well" style="border-color: black;">
	                                            <div class="row">
	                                                <div class="col-sm-12">
	                                                    <div class="" style="margin-top: 0;">
	                                                        <h1 class="text-center" id="resumen" style="font-weight: Yu Gothic UI Light;">
	                                                            III. Resumen Ejecutivo
	                                                        </h1>
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="form-group">
	                                                                    <label>
	                                                                        Con la finalidad de difundir su investigación, explique en forma clara y concisa en qué consiste su proyecto, incluyendo los beneficios obtenidos hasta el momento (de preferencia utilice un máximo de veinte renglones).
	                                                                    </label>
	                                                                </div>
	                                                                <div class="form-group">
	                                                                    <textarea class="form-control" disabled name="textarea" rows="4"><?php echo $entrega['Resumen'] ?></textarea>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="" style="margin-top: 0;">
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="form-group">
	                                                                    <label>
	                                                                        OBSERVACIONES: Utilice este espacio para sus comentarios y sugerencias.
	                                                                    </label>
	                                                                </div>
	                                                                <div class="from-group">
	                                                                    <textarea class="form-control" disabled="" name="textarea" rows="4"><?php echo $entrega['Resumen'] ?></textarea>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="" style="margin-top: 0;">
	                                                        <div class="col-lg-12 well" style="border-color: black;">
	                                                            <div class="row">
	                                                                <div class="col-sm-3">
	                                                                    <label>
	                                                                        Nombre del Responsable:
	                                                                    </label>
	                                                                </div>
	                                                                <div class="col-sm-4">
	                                                                    <label>
	                                                                        <?php echo $entrega['NombreResp'] ?>
	                                                                    </label>
	                                                                </div>
	                                                            </div>
	                                                            <div class="row">
	                                                                <div class="col-sm-2">
	                                                                    <label>
	                                                                        Firma del Responsable
	                                                                    </label>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	    			<!------------------------------------------------------------------------------->
	                <div class="col-lg-4" role="complementary">
                        <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
                            <ul class="nav bs-docs-sidenav">
                                <div class="container" id="navObserv">
                                    <h3>
                                        Observaciones
                                    </h3>
                                    <div class="panel panel-primary panel-default">
	                                    <form class="panel panel-primary panel-default" id="Observ">
	                                        <div class="panel-heading">
	                                            <h5 class="panel-title">
	                                                Realizar Observaciones
	                                            </h5>
	                                            <span class="pull-right clickable panel-collapsed">
	                                                <i class="glyphicon glyphicon-chevron-down">
	                                                </i>
	                                            </span>
	                                        </div>
	                                        <div class="panel-body" style="display: none;">
	                                            <li class="">
	                                                <a class="accordion col-lg-4" href="#informe" style="color: #337ab7">
	                                                    Informe General I
	                                                </a>
	                                                <div class="panel2">
	                                                    <textarea class="form-control" name="informeGeneral1" rows="5" style="resize:none"></textarea>
	                                                </div>
	                                            </li>
	                                            <li class="">
	                                                <a class="accordion col-lg-4" href="#informeII" style="color: #337ab7">
	                                                    Informe Detallado II
	                                                </a>
	                                                <div class="panel2">
	                                                    <textarea class="form-control" name="informeDetallado1" rows="5" style="resize:none"></textarea>
	                                                </div>
	                                            </li>
	                                            <li class="">
	                                                <a class="accordion col-lg-4" href="#informeIII" style="color: #337ab7">
	                                                    Resumen Ejecutivo III
	                                                </a>
	                                                <div class="panel2">
	                                                    <textarea class="form-control" name="resumenEjec1" rows="5" style="resize:none"></textarea>
	                                                </div>
	                                            </li>
	                                        </div>
	                                    </form>
                                	</div>
                                    <li class="">
                                        <a href="#" onclick="GuardarObs(<?php echo $entregable ?>)">
                                            Enviar revisión a Subdirección de Investigación y Posgrado
                                        </a>
                                    </li>
                                    <li class="">
                                    </li>
                                    <li class="">
                                        <a data-dismiss="modal" href="#">
                                            Cerrar
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </nav>
                    </div>
	            </div>
	        </div>
	    </form>
	    <script>
		var acc = document.getElementsByClassName("accordion");
		var i;
		for (i = 0; i < acc.length; i++) 
		{
		  acc[i].onclick = function() 
		  {
		    this.classList.toggle("active");
		    var panel = this.nextElementSibling;
		    if (panel.style.maxHeight)
		    {
		      panel.style.maxHeight = null;
		    } else 
		    {
		      panel.style.maxHeight = panel.scrollHeight + "px";
		    } 
		  }
		}
		</script>
		<?php
	break;
	case 'enviarConsejo':
		$sql='SELECT nextval(\'seq_ObsEntrega\')';
		$resultado=pg_query($conexion, $sql);
		$consulta= pg_fetch_array($resultado);
		$idObservacion=$consulta[0];
		$entregable=$_POST['entregable'];
		$InformeGeneral=$_POST['informeGeneral1'];
		$informeDetallado=$_POST['informeDetallado1'];
		$resumen=$_POST['resumenEjec1'];
		$sql='INSERT INTO observacionesentregable("Entregable_idEntregable","InformeGeneral","InformeDetallado","ResumenEjecutivo","catObservaciones_idObservaciones","Departamento") VALUES('.$entregable.',\''.$InformeGeneral.'\',\''.$informeDetallado.'\',\''.$resumen.'\','.$idObservacion.',2) ';
		$resultado=pg_query($conexion, $sql);
		$sql='UPDATE entregable SET "Estatus"=4 WHERE "idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
	break;
	case 'enviarDocente':
		$sql='SELECT nextval(\'seq_ObsEntrega\')';
		$resultado=pg_query($conexion, $sql);
		$consulta= pg_fetch_array($resultado);
		$idObservacion=$consulta[0];
		$entregable=$_GET['entregable'];
		$InformeGeneral=$_POST['informeGeneral1'];
		$informeDetallado=$_POST['informeDetallado1'];
		$resumen=$_POST['resumenEjec1'];
		$sql='INSERT INTO observacionesentregable("Entregable_idEntregable","InformeGeneral","InformeDetallado","ResumenEjecutivo","catObservaciones_idObservaciones","Departamento") VALUES('.$entregable.',\''.$InformeGeneral.'\',\''.$informeDetallado.'\',\''.$resumen.'\','.$idObservacion.',3) ';
		$resultado=pg_query($conexion, $sql);
		$sql='UPDATE entregable SET "Estatus"=5 WHERE "idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
	break;
	case 'enviarSubdireccion':
	$sql='SELECT nextval(\'seq_ObsEntrega\')';
		$resultado=pg_query($conexion, $sql);
		$consulta= pg_fetch_array($resultado);
		$idObservacion=$consulta[0];
		$entregable=$_GET['entregable'];
		$InformeGeneral=$_POST['informeGeneral1'];
		$informeDetallado=$_POST['informeDetallado1'];
		$resumen=$_POST['resumenEjec1'];
		$sql='INSERT INTO observacionesentregable("Entregable_idEntregable","InformeGeneral","InformeDetallado","ResumenEjecutivo","catObservaciones_idObservaciones","Departamento") VALUES('.$entregable.',\''.$InformeGeneral.'\',\''.$informeDetallado.'\',\''.$resumen.'\','.$idObservacion.',1) ';
		$resultado=pg_query($conexion, $sql);
		$sql='UPDATE entregable SET "Estatus"=2 WHERE "idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
	break;
	case 'aceptaEntrega':
		$sql='SELECT nextval(\'seq_ObsEntrega\')';
		$resultado=pg_query($conexion, $sql);
		$consulta= pg_fetch_array($resultado);
		$idObservacion=$consulta[0];
		$InformeGeneral=$_POST['informeGeneral1'];
		$informeDetallado=$_POST['informeDetallado1'];
		$resumen=$_POST['resumenEjec1'];
		$entregable=$_GET['entregable'];
		$sql='UPDATE entregable SET "Estatus"=3,"FechaEntregada"=localtimestamp WHERE "idEntregable"='.$entregable;
		$resultado=pg_query($conexion, $sql);
		$sql='INSERT INTO observacionesentregable("Entregable_idEntregable","InformeGeneral","InformeDetallado","ResumenEjecutivo","CatObservaciones_idObservaciones","Departamento") VALUES('.$entregable.',\''.$InformeGeneral.'\',\''.$informeDetallado.'\',\''.$resumen.'\','.$idObservacion.',2) ';
		$resultado=pg_query($conexion, $sql);
	break;
	case 'proyectosActivos':
		$etapas=$conn->getEtapasProyecto($folio);
		foreach ($etapas as $row) 
		{ ?>
		<tr align="center">
            <td><?php echo $row['NoEtapa'] ?></td>
            <td><?php echo $row['Nombre'] ?></td>
            <td><?php echo $row['FechaInicio'] ?></td>
            <td><?php echo $row['FechaFin'] ?></td>
            <td>---</td>
            <td><?php echo $row['Estatus'] ?></td>
            <td>
            	<?php 
            	if ($row['Estatus']==3) 
            	{
            		?>
            	<a class="btn btn-success" href="seguimiento.pdf" target="_blank">Imprimir</a>
            		<?php
            	}
            	else
            	{
            		?>
					<a class="btn btn-info" href="Seguimiento.php?&proyecto=<?php echo $row['FolioProyecto']?>&entregable=<?php echo $row['Entregable'] ?>" target="_blank">Realizar entrega</a>
            		<?php
            	} ?>
            </td>
        </tr>
			<?php
		}
		break;
	default:
	break;
}
?>