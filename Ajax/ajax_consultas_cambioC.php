<?php 
	include('../externas/Clases/classConn.php');
	include('../controladores/Clases/clase_consultas.php');
	$arrayC_nombre[] = array();
	$arrayC_paterno[] = array();
	$arrayC_materno[] = array();
	$arrayC_npersonal[] = array();
	$arrayC_movil[] = array();
	$arrayC_correo1[] = array();
	$arrayC_estado[] = array();
	$arrayC_academia[] = array();
	if (isset($_POST['accion']))
	{
		$accion = $_POST['accion'];
	}
	else
	{
		$accion=$_GET['accion'];
	}
	$conex= new ClaseConsultas();

	switch ($accion) {
		case 'consultarColaboradores':
			$folio  = $_GET['folio_cambio'];	
			$colab = $conex -> obtenerColaboradoresCam($folio);
			$alum = $conex -> obtenerAlumnosCam($folio);
			?>
       <div class="col-md-12" >
            <h2 class="text-center" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
                Docentes
            </h2>
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table" style="float: center;">
                        <thead>
                            <tr>
                                <!--<th>
                                    No. de solicitud
                                </th>-->
                                <th>
                                    Apellido paterno
                                </th>
                                <th>
                                    Apellido materno
                                </th>
                                <th>
                                    Nombre(s)
                                </th>
                                <th>
                                    No. personal
                                </th>
                                <th>
                                    Móvil
                                </th>
                                <th>
                                    Correo
                                </th>
                                <th>
                                    Estatus
                                </th>
                                <th>Etapa actual</th>
                                <th>
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>                            
                            	<?php 
								while($result = pg_fetch_array($colab)){
								?>
                            	<tr>
                                	<td><?php echo $result['paterno_colaborador']?></td>
						            <td><?php echo $result['materno_colaborador']?></td>
						            <td><?php echo $result['nombre_colaborador']?></td>
						            <td><?php echo $result['personal_colaborador']?></td>
						            <td><?php echo $result['celular_colaborador'] ?></td>
						            <td><?php echo $result['correo_colaborador'] ?></td>
						            <td><?php echo $result['estado_colaborador'] ?></td>
						            <td><?php echo $result['etapa_actual'] ?></td>
						            <td><input class="btn btn-warning" data-toggle="modal" id="<?php echo $folio ?>" name="" data-target="#myModal" data-toggle="modal" type="button" value="Solicitar cambio"/></td>
						            <td><input class="btn btn-danger" data-target="#myModal2" id="<?php echo $folio ?>" data-toggle="modal" name="" type="button" value=" Solicitar baja "/></td>                      
                                <tr>
                                <?php } ?>	
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <td><input class="btn btn-success"  id="<?php echo $folio ?>" data-target="#myModal3" data-toggle="modal" name="" type="button" value=" Solicitar alta "/></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
        <br>
                    <div class="col-sm-12">
                    <h2 class="text-center" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
                        Alumnos
                    </h2>
                    <div class="table-responsive" id="tb">
                        <div class="table-responsive">
                            <table class="table" style="float: center;">
                                <thead>
                                    <tr>
                                        <th>
                                            Apellido paterno
                                        </th>
                                        <th>
                                            Apellido materno
                                        </th>
                                        <th>
                                            Nombre(s)
                                        </th>
                                        <th>
                                            No. control
                                        </th>
                                        <th>Etapa actual</th>
                                        <th>
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
										while($result = pg_fetch_array($alum)){
									?>
	                            	<tr>
	                                	<td><?php echo $result['pat_alum']?></td>
							            <td><?php echo $result['mat_alum']?></td>
							            <td><?php echo $result['nombre_alum']?></td>
							            <td><?php echo $result['control_alum']?></td>
							            <td><?php echo $result['etapa_actual'] ?></td>
							            <td><input class="btn btn-warning" data-toggle="modal" id="<?php echo $folio ?>" name="" data-target="#myModal" data-toggle="modal" type="button" value="Solicitar cambio"/></td>
							            <td><input class="btn btn-danger" data-target="#myModal2" id="<?php echo $folio ?>" data-toggle="modal" name="" type="button" value=" Solicitar baja "/></td>                      
	                                <tr>
                                <?php } ?>	                                  
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input class="btn btn-success" data-target="#ModalAltaAlumno" data-toggle="modal" name="" type="button" value="Solicitar alta"/></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                    <h4><b>Nota:</b>las actividades del docente o alumno que se de de baja o se cambie, se asignarán al próximo docente o alumno que ocupe su lugar.</h4>
                                </div>
                        </div>
                    </div>
                </div> 
            <?php 
		break;
		
		case 'consultarAlumnos':

		break;

		default:
			
			break;
	}

 ?>