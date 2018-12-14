<?php 
	include('../externas/Clases/classConn.php');
	include('../controladores/Clases/clase_consultas.php');
    include('../externas/conexion.php');
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
                                $cont=0;
                                $status= 0;
                                //if($result = pg_fetch_array($colab)){
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
                                    <?php 
                                        $status = $result['estado_colaborador']; 
                                        if($status== 4 || $status== 5){
                                            if($status == 4){
                                                echo "<td><strong class='text-info'><small>Pendiente de cambio</small></strong></td>";
                                            }
                                            if($status== 5){
                                                echo "<td><strong><small class='text-info'>Pendiente de baja</small></strong></td>";
                                            }
                                        }else{
                                    ?>
                                             <td><input class="btn btn-warning" data-toggle="modal" id="<?php echo $folio ?>" name="" data-target="#myModal" onclick="ajaxComboColaboradores(this.id, 1, <?php echo $result['personal_colaborador']?>)" data-toggle="modal" type="button" value="Solicitar cambio"/></td>
                                             <td><input class="btn btn-danger" data-target="#myModal2" id="<?php echo $folio ?>" data-toggle="modal" name="" onclick="ajaxComboColaboradores(this.id, 1, <?php echo $result['personal_colaborador']?>)" type="button" value=" Solicitar baja "/></td>
                                    <?php 
                                        } 
                                    ?>						            
                                    <input type="hidden" id="<?php echo $result['personal_colaborador']?>" name="actividades_colab_prin" value="<?php echo $result['activ_colab'] ?>">
						        <tr>
                                <?php
                                    $cont++;
                                 } 
                                 ?>     
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <?php 
                                        if($folio != 'Proyectos activos'){
                                            if($cont==4){ 
                                                echo "<td><strong><small class='text-info'>Ya no puede registrar más colaboradores docentes, ha alcanzado el máximo de 4</small></strong></td>";
                                            }else{     
                                                echo '<td><input class="btn btn-primary"  id="'.$folio.'" data-target="#myModal3" data-toggle="modal" onclick="ajaxComboColaboradores(this.id, 0, 0)" type="button" value="Solicitar alta"/></td>';                                          
                                            }
                                        }
                                    //}
                                    ?>
                                <!--<td><input class="btn btn-success"  id="<?php echo $folio ?>" data-target="#myModal3" data-toggle="modal" onclick="ajaxComboColaboradores(this.id, 0, <?php //echo $result['personal_colaborador'] ?>)" type="button" value="Solicitar alta"/></td>-->
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
                                        <th>Estado</th>
                                        <th>
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
                                        $cont= 1;
                                        $status=0;
										while($result = pg_fetch_array($alum)){
									?>
	                            	<tr>
	                                	<td><?php echo $result['pat_alum']?></td>
							            <td><?php echo $result['mat_alum']?></td>
							            <td><?php echo $result['nombre_alum']?></td>
							            <td><?php echo $result['control_alum']?></td>
							            <td><?php echo $result['etapa_actual'] ?></td>
                                        <td><?php echo $result['sdo_alum'] ?></td>
                                    <?php 
                                        $status = $result['sdo_alum']; 
                                        if($status== 7 || $status== 8){
                                            if($status == 7){
                                                echo "<td><strong class='text-info'><small>Pendiente de cambio</small></strong></td>";
                                            }
                                            if($status== 8){
                                                echo "<td><strong><small class='text-info'>Pendiente de baja</small></strong></td>";
                                            }
                                        }else{
                                    ?>
                                             <td><input class="btn btn-warning" data-toggle="modal" id="<?php echo $folio ?>" name="" data-target="#ModalCambioAlumno" onclick="ajaxComboAlumnos(this.id, 1, '<?php echo $result['control_alum']?>')" data-toggle="modal" type="button" value="Solicitar cambio"/></td>
                                             <td><input class="btn btn-danger" data-target="#ModalBajaAlumno" id="<?php echo $folio ?>" data-toggle="modal" name="" onclick="ajaxComboAlumnos(this.id, 1, '<?php echo $result['control_alum']?>')" type="button" value=" Solicitar baja "/></td>
                                    <?php 
                                        } 
                                    ?>
                                        <input type="hidden" id="<?php echo $result['control_alum']?>" name="actividades_alum_prin" value="<?php echo $result['activ_alum'] ?>">
							            <!--<td><input class="btn btn-warning" data-toggle="modal" id="<?php //echo $folio ?>" name="" data-target="#myModal" data-toggle="modal" type="button" value="Solicitar cambio"/></td>
							            <td><input class="btn btn-danger" data-target="#myModal2" id="<?php //echo $folio ?>" data-toggle="modal" name="" type="button" value=" Solicitar baja "/></td>-->                      
	                                <tr>
                                <?php
                                    $cont++;
                                 } 
                                 ?>	                                  
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>                                        
                                        <?php 
                                            if($folio != 'Proyectos activos'){
                                                if($cont==20){ 
                                                    echo "<td><strong><small class 'text-info'>Ya no puede registrar más alumnos, ha alcanzado el máximo de 20</small></strong></td>";
                                                }else{     
                                                    echo '<td><input class="btn btn-primary"  id="'.$folio.'" data-target="#ModalAltaAlumno" data-toggle="modal" onclick="ajaxComboAlumnos(this.id, 0, 0)" type="button" value="Solicitar alta"/></td>';                                           
                                                }
                                            }
                                        ?>
                                        <!--<td><input class="btn btn-success" data-target="#ModalAltaAlumno" data-toggle="modal" name="" type="button" value="Solicitar alta"/></td>-->
                                        
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


		case 'obtenerColabCombo':
			$folio= $_GET['folio'];
			$colabDisp = $conex -> obtenerDocentesDisponibles($folio);
			?>
			<select class="form-control" data-live-search="true" onchange="obtener_colaborador(this.value, 0)" id="cbo_colaboradoresA">
            <option>Seleccione un Docente</option>
            <?php 
	            foreach($colabDisp as $row){
	                echo "<option value='".$row['NoPersonal']."'>".$row['Nombre']." - ".$row['academia']." - No. PERSONAL: ".$row['NoPersonal']."</option>"; 
	            }
            ?>
            </select> 
			<?php
		break;

		case 'obtenerColabComboCambio':
			$folio= $_GET['folio'];
			$colabDisp = $conex -> obtenerDocentesDisponibles($folio);
			?>
			<select class="form-control" data-live-search="true" onchange="obtener_colaborador(this.value, 1)" id="cbo_colaboradoresC">
            <option>Seleccione un Docente</option>
            <?php 
	            foreach($colabDisp as $row){
	                echo "<option value='".$row['NoPersonal']."'>".$row['Nombre']." - ".$row['academia']." - No. PERSONAL: ".$row['NoPersonal']."</option>"; 
	            }
            ?>
            </select> 
			<?php
		break;

        case 'obtenerAlumnoCombo':
            $folio= $_GET['folio'];
            $alumDisp = $conex -> obtenerAlumnosDisponibles($folio);
            ?>
            <select class="form-control" data-live-search="true" onchange="obtener_alumno(this.value, 0)" id="cbo_alumnosA">
            <option>Seleccione un Alumno</option>
            <?php 
                while($row = pg_fetch_array($alumDisp)){
                    echo "<option value='".$row['control_alum']."'>".$row['nombre_alum']." - ".$row['academia']." - No. CONTROL: ".$row['control_alum']."</option>"; 
                }
            ?>
            </select> 
            <?php
        break;

        case 'obtenerAlumnoComboCambio':
            $folio= $_GET['folio'];
            $alumDisp = $conex -> obtenerAlumnosDisponibles($folio);
            ?>
            <select class="form-control" data-live-search="true" id="<?php echo $folio ?>" onchange="obtener_alumno(this.value, 1)" id="cbo_alumnosC">
            <option>Seleccione un Alumno</option>
            <?php 
                while($row = pg_fetch_array($alumDisp)){
                    echo "<option value='".$row['control_alum']."'>".$row['nombre_alum']." - ".$row['academia']." - No. CONTROL: ".$row['control_alum']."</option>"; 
                }
            ?>
            </select> 
            <?php
        break;

		case 'obtenerColab':
			$numero_control = $_GET['noControl'];
			$colaborador = $conex->obtenerDocenteCamColab($numero_control);
			while($row = pg_fetch_array($colaborador)){
	            $np = $row['NoPersonal'];
	            $nomb = $row['nombre'];
	            $ap = $row['apellidop'];
	            $am = $row['apellidom'];
	            $acad = $row['academia'];
	            $correo1 = $row['CorreoInstitucional'];
	            $max_estudios = $row['GradoMaximoEstudios'];
	            $cel = $row['TelefonoMovil'];  
	            $actividades = $row['actividades'];
                $correo2 = $row['correo_alt'];        
			}			
	        $json=array("NoPersonal"=>$np, "Nombre"=>$nomb, "paterno"=>$ap, "materno"=>$am, "academia"=>$acad, "correo_inst"=>$correo1, "maxEstudios"=>$max_estudios, "celular"=>$cel, "actividades"=>$actividades, "correo_alt"=>$correo2); 
			echo json_encode($json);
		break;

        case 'obtenerAlum':
            $numero_control = $_GET['noControl'];
            $colaborador = $conex->obtenerDatosAlumno($numero_control);
            $json=array();      
            while($row = pg_fetch_array($colaborador)){
                $nc = $row['control_alum'];
                $nomb = $row['nombre_alum'];
                $ap = $row['pat_alum'];
                $am = $row['mat_alum'];
                $acad = $row['academia'];
                $carrera = $row['academia'];
                $servicio = $row['serv'];
                $residencia= $row['resid'];
                $tesis = $row['tes']; 
                $semestre = $row['sems'];
                $actividades = $row['activs'];
            }           
            $json=array("NoControl"=>$nc, "Nombre"=>$nomb, "paterno"=>$ap, "materno"=>$am, "academia"=>$acad, "servicio"=>$servicio, "residencia"=>$residencia, "tesis"=>$tesis, "semestre"=>$semestre, "al_activ"=>$actividades); 
            echo json_encode($json);
        break;

		case 'altaColaborador':
			$folio = $_POST['folio_proyecto'];
			$num_perso = $_POST['numero_p'];
			$actividades = $_POST['p_actividades'];
			$tipo = $_POST['tipoSolicitud'];
			$sqlI = "INSERT INTO \"cambioColaboradores\" (\"actividades_actuales\", \"folio_proyecto\", \"id_doc\", \"id_tipo_cambio\", \"id_estado\") VALUES
							('".$actividades."', 
							'".$folio."',
							".$num_perso.",
							 ".$tipo.", 12);";
			echo $sqlI;	
			pg_query($conexion, $sqlI);
            $sqlU = "UPDATE \"usuario\" SET \"estado\" = 3 WHERE \"NoPersonal\" = ".$num_perso.";";
            echo $sqlU;
            pg_query($conexion, $sqlU);

		break;

        case 'altaAlumno':
            $folio = $_POST['al_folio_proyecto'];
            $num_cont = $_POST['al_control'];
            $actividades = $_POST['al_actividades'];
            $tipo = $_POST['al_tipoSolicitud'];
            $semestre = $_POST['al_semestre'];
            if(isset($_POST['al_servicio'])){
                $serv = 1;
            }else{
                $serv = 0;
            }
            if(isset($_POST['al_residencia'])){
                $residn = 1;
            }else{
                $residn = 0;
            }
            if(isset($_POST['al_tesis'])){
                $tesi = 1;
            }else{
                $tesi = 0;
            }
            $sqlI = "INSERT INTO \"cambioAlumnos\" (\"actividades_actuales\", \"folio_proyecto\", \"id_alum\", \"id_tipo_cambio\", \"semestre\", \"servic\", \"resid\", \"tesis\", \"id_estado\") VALUES
                            ('".$actividades."', 
                            '".$folio."',
                            '".$num_cont."',
                            ".$tipo.",
                            ".$semestre.",
                            '".$serv."',
                            '".$residn."',
                             '".$tesi."', 12);";
            echo $sqlI; 
            pg_query($conexion, $sqlI);
            $sqlU = "UPDATE \"alumno\" SET \"estado\" = 6 WHERE \"NoControl\" = '".$num_cont."';";
            echo $sqlU;
            pg_query($conexion, $sqlU);

        break;

        case 'cambioColaborador':
            $folio = $_POST['cam_folio_proyecto'];
            $num_perso_org = $_POST['np_original'];
            $num_perso_reem = $_POST['cam_numero_p'];
            $actividades = $_POST['cam_actividades_colab'];
            $tipo = $_POST['cam_tipoSolicitud'];
            $motivo = $_POST['cambioC_observaciones'];
            $sqlI = "INSERT INTO \"cambioColaboradores\" (\"actividades_actuales\", \"folio_proyecto\", \"id_doc\", \"id_tipo_cambio\", \"motivo\", \"np_reemplazo\", \"id_estado\") VALUES
                            ('".$actividades."', 
                            '".$folio."',
                            ".$num_perso_org.",
                            ".$tipo.",
                            '".$motivo."',
                             ".$num_perso_reem." , 12);";
            echo $sqlI; 
            pg_query($conexion, $sqlI);
            $sqlU = "UPDATE \"usuario\" SET \"estado\" = 4 WHERE \"NoPersonal\" = ".$num_perso_org.";";
            echo $sqlU;            
            pg_query($conexion, $sqlU);
            $sqlU = "UPDATE \"usuario\" SET \"estado\" = 4 WHERE \"NoPersonal\" = ".$num_perso_reem.";";
            echo $sqlU;
            pg_query($conexion, $sqlU);
        break;

        case 'cambioAlumno':
            $folio = $_POST['al_folio_proyectoC'];
            $num_cont_orig = $_POST['nc_original'];
            $num_cont_reemp = $_POST['al_control'];
            $actividades = $_POST['al_actividades'];
            $tipo = $_POST['al_tipoSolicitud'];
            $semestre = $_POST['al_semestre'];
            $observaciones = $_POST['observaciones_alum'];
            if(isset($_POST['al_servicio'])){
                $serv = 1;
            }else{
                $serv = 0;
            }
            if(isset($_POST['al_residencia'])){
                $residn = 1;
            }else{
                $residn = 0;
            }
            if(isset($_POST['al_tesis'])){
                $tesi = 1;
            }else{
                $tesi = 0;
            }
            $sqlI = "INSERT INTO \"cambioAlumnos\" (\"actividades_actuales\", \"folio_proyecto\", \"id_alum\", \"id_tipo_cambio\", \"motivo\", \"semestre\", \"servic\", \"resid\", \"tesis\", \"nc_reemplazo\", \"id_estado\") VALUES
                            ('".$actividades."', 
                            '".$folio."',
                            '".$num_cont_orig."',
                            ".$tipo.",
                            '".$observaciones."',
                            ".$semestre.",
                            '".$serv."',
                            '".$residn."',
                            '".$tesi."',
                             '".$num_cont_reemp."', 12);";
            echo $sqlI; 
            pg_query($conexion, $sqlI);
            $sqlU = "UPDATE \"alumno\" SET \"estado\" = 7 WHERE \"NoControl\" = '".$num_cont_orig."';";
            echo $sqlU;
            pg_query($conexion, $sqlU);
            $sqlU = "UPDATE \"alumno\" SET \"estado\" = 7 WHERE \"NoControl\" = '".$num_cont_reemp."';";
            echo $sqlU;
            pg_query($conexion, $sqlU);

        break;

        case 'bajaColaborador':
            $folio = $_POST['baja_folio_proyecto'];
            $num_perso = $_POST['baja_numero_p'];
            $motivoBaja = $_POST['motivo_bajaC'];
            $tipo = $_POST['baja_tipoSolicitud'];
            $sqlI = "INSERT INTO \"cambioColaboradores\" (\"motivo\", \"folio_proyecto\", \"id_doc\", \"id_tipo_cambio\", \"id_estado\") VALUES ('".$motivoBaja."', '".$folio."', ".$num_perso.", ".$tipo.", 12);";
            echo $sqlI; 
            pg_query($conexion, $sqlI);
            $sqlU = "UPDATE \"usuario\" SET \"estado\" = 5 WHERE \"NoPersonal\" = ".$num_perso.";";
            echo $sqlU;
            pg_query($conexion, $sqlU);
                //$resultado=pg_query($conex, $sqlI);

        break;

        case 'bajaAlumno':
            $folio = $_POST['baja_folio_proyecto'];
            $num_ctrl = $_POST['baja_numero_c'];
            $motivoBaja = $_POST['motivo_bajaAlum'];
            $tipo = $_POST['baja_tipoSolicitud'];
            $sqlI = "INSERT INTO \"cambioAlumnos\" (\"motivo\", \"folio_proyecto\", \"id_alum\", \"id_tipo_cambio\", \"id_estado\") VALUES ('".$motivoBaja."',  '".$folio."', '".$num_ctrl."', ".$tipo.", 12);";
            echo $sqlI; 
            pg_query($conexion, $sqlI);
            $sqlU = "UPDATE \"alumno\" SET \"estado\" = 8 WHERE \"NoControl\" = '".$num_ctrl."';";
            echo $sqlU;
            pg_query($conexion, $sqlU);

        break;

        case 'colab_procesar_solicitud_alta':
             $folio = $_POST['folio_proyecto'];
             $np_alta = $_POST['numero_p_alta'];
             $actividades= $_POST['actividades_colab_alta'];
             $num_solic = $_POST['numero_solicitud'];
             $btn = $_POST['btn'];
             $observaciones = $_POST['obs_alta_colab'];
             if($btn == 2){
                 $sqlI = "INSERT INTO \"colaboradordocente\" (\"Proyecto_FolioProyecto\", \"Docente_noPersonal\", \"Actividades\") VALUES ('".$folio."', ".$np_alta.", '".$actividades."');";
                 echo $sqlI;
                 pg_query($conexion, $sqlI);
                 $sqlU = "UPDATE \"usuario\" SET \"estado\" = 1 WHERE \"NoPersonal\" = ".$np_alta.";";
                 echo $sqlU;
                 pg_query($conexion, $sqlU);
                 $sqlU = "UPDATE \"cambioColaboradores\" SET \"id_estado\" = 15 WHERE \"id_solicitud\" = ".$num_solic.";";
                 echo $sqlU;
                 pg_query($conexion, $sqlU);
            }
            if ($btn == 4){
                $sqlU = "UPDATE \"usuario\" SET \"estado\" = 1 WHERE \"NoPersonal\" = ".$np_alta.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
                $sqlU = "UPDATE \"cambioColaboradores\" SET \"id_estado\" = 14 WHERE \"id_solicitud\" = ".$num_solic.";";
                 echo $sqlU;
                pg_query($conexion, $sqlU);
            }
            if($btn == 6){
                $sqlI = "INSERT INTO \"observaciones\" (\"ObservacionesGestion\", \"CatObservaciones_idObservaciones\", \"Proyecto_FolioProyecto\") VALUES('".$observaciones."', 11, '".$folio."');";
                echo $sqlI;
                pg_query($conexion, $sqlI);
                $sqlU = "UPDATE \"cambioColaboradores\" SET \"id_estado\" = 13 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
            }
            if($btn == 8){
                $sqlU = "UPDATE \"observaciones\" SET \"ObservacionesInvestigacion\" = '".$observaciones."' WHERE \"CatObservaciones_idObservaciones\" = 11 and  \"Proyecto_FolioProyecto\" = '".$folio."';";
                echo $sqlU;
                pg_query($conexion, $sqlU);
                $sqlU = "UPDATE \"cambioColaboradores\" SET \"id_estado\" = 12 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
            }
        break;

        case 'al_procesar_solicitud_alta':
             $folio = $_POST['folio_proyecto'];
             $nc_alta = $_POST['al_controlA'];
             $actividades= $_POST['actividades_alumA'];
             $num_solic = $_POST['numero_solicitud'];
             $btn = $_POST['btn'];
             $observaciones = $_POST['obs_alta_alum'];
             $servicio = $_POST['al_servicio'];
             $residencia = $_POST['al_residencia'];
             $tesis = $_POST['al_tesis'];
             $semestre = $_POST['al_semestreA'];
             if($btn == 2){
                 $sqlI = "INSERT INTO \"alumnoscolaboradoresdetalle\" (\"folioProyecto\", \"FkNoControl\", \"servicio\", \"residencia\", \"tesis\", \"semestre\", \"actividades\") VALUES ('".$folio."', '".$nc_alta."', '".$servicio."', '".$residencia."', '".$tesis."', ".$semestre.", '".$actividades."');";
                 echo $sqlI;
                 pg_query($conexion, $sqlI);
                 $sqlU = "UPDATE \"alumno\" SET \"estado\" = 1 WHERE \"NoControl\" = '".$nc_alta."';";
                 echo $sqlU;
                 pg_query($conexion, $sqlU);
                 $sqlU = "UPDATE \"cambioAlumnos\" SET \"id_estado\" = 15 WHERE \"id_solicitud\" = ".$num_solic.";";
                 echo $sqlU;
                 pg_query($conexion, $sqlU);
            }
            if ($btn == 4){
                $sqlU = "UPDATE \"alumno\" SET \"estado\" = 1 WHERE \"NoPersonal\" = '".$nc_alta."';";
                echo $sqlU;
                pg_query($conexion, $sqlU);
                $sqlU = "UPDATE \"cambioAlumnos\" SET \"id_estado\" = 14 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
            }
            if($btn == 6){
                $sqlI = "INSERT INTO \"observaciones\" (\"ObservacionesGestion\", \"CatObservaciones_idObservaciones\", \"Proyecto_FolioProyecto\") VALUES('".$observaciones."', 14, '".$folio."');";
                echo $sqlI;
                pg_query($conexion, $sqlI);
                $sqlU = "UPDATE \"cambioAlumnos\" SET \"id_estado\" = 13 WHERE \"id_solicitud\" = ".$num_solic.";";
                 echo $sqlU;
                pg_query($conexion, $sqlU);
            }
            if($btn == 8){
                $sqlU = "UPDATE \"observaciones\" SET \"ObservacionesInvestigacion\" = '".$observaciones."' WHERE \"CatObservaciones_idObservaciones\" = 14 and  \"Proyecto_FolioProyecto\" = '".$folio."';";
                echo $sqlU;
                pg_query($conexion, $sqlU);
                $sqlU = "UPDATE \"cambioAlumnos\" SET \"id_estado\" = 12 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
            }
        break;

        case 'colab_procesar_solicitud_cambio':
             $folio = $_POST['folio_proyecto'];
             $np_ant = $_POST['numero_p_anti'];
             $np_nuevo = $_POST['numero_p_nuevo'];
             $actividades= $_POST['cam_actividades_colab'];
             $num_solic = $_POST['numero_solicitud'];
             $btn = $_POST['btn'];
             $observaciones = $_POST['obs_cambio_colab'];
             if($btn == 2){
                $sqlU = "UPDATE \"colaboradordocente\" SET \"Docente_noPersonal\" = ".$np_nuevo." WHERE \"Docente_noPersonal\" = ".$np_ant." and \"Proyecto_FolioProyecto\"= '".$folio."';";
                echo $sqlU."\n";
                pg_query($conexion, $sqlU);
                $sqlU = "UPDATE \"usuario\" SET \"estado\" = 1 WHERE \"NoPersonal\" = ".$np_ant.";";
                echo $sqlU."\n";
                pg_query($conexion, $sqlU);
                $sqlU = "UPDATE \"cambioColaboradores\" SET \"id_estado\" = 15 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU."\n";
                pg_query($conexion, $sqlU);
            }
            if ($btn == 4){
                $sqlU = "UPDATE \"usuario\" SET \"estado\" = 1 WHERE \"NoPersonal\" = ".$np_ant.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
                $sqlU = "UPDATE \"cambioColaboradores\" SET \"id_estado\" = 14 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
            }
            if($btn == 6){
                $sqlI = "INSERT INTO \"observaciones\" (\"ObservacionesGestion\", \"CatObservaciones_idObservaciones\", \"Proyecto_FolioProyecto\") VALUES('".$observaciones."', 12, '".$folio."');";
                echo $sqlI;
                pg_query($conexion, $sqlI);
                $sqlU = "UPDATE \"cambioColaboradores\" SET \"id_estado\" = 13 WHERE \"id_solicitud\" = ".$num_solic.";";
                 echo $sqlU;
                pg_query($conexion, $sqlU);
            }
            if($btn == 8){
                $sqlU = "UPDATE \"observaciones\" SET \"ObservacionesInvestigacion\" = '".$observaciones."' WHERE \"CatObservaciones_idObservaciones\" = 12 and  \"Proyecto_FolioProyecto\" = '".$folio."';";
                echo $sqlU;
                pg_query($conexion, $sqlU);
                $sqlU = "UPDATE \"cambioColaboradores\" SET \"id_estado\" = 12 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
            }
        break;

        case 'al_procesar_solicitud_cambio':
             $folio = $_POST['folio_proyecto'];
             $nc_ant = $_POST['al_control_anti'];
             $nc_new = $_POST['al_control_new'];
             $actividades= $_POST['cam_actividades_alum'];
             $num_solic = $_POST['numero_solicitud'];
             $btn = $_POST['btn'];
             $observaciones = $_POST['obs_cambio_alum'];
             $servicio = $_POST['al_servicio'];
             $residencia = $_POST['al_residencia'];
             $tesis = $_POST['al_tesis'];
             $semestre = $_POST['al_semestreC_new'];
             if($btn == 2){
                $sqlU = "UPDATE \"alumnoscolaboradoresdetalle\" SET \"FkNoControl\" = '".$nc_new."'' WHERE \"FkNoControl\" = '".$nc_ant."' and \"folioProyecto\"= '".$folio."';";
                echo $sqlU."\n";
                pg_query($conexion, $sqlU);
                $sqlU = "UPDATE \"alumno\" SET \"estado\" = 1 WHERE \"NoControl\" = '".$nc_ant."';";
                echo $sqlU."\n";
                pg_query($conexion, $sqlU);
                $sqlU = "UPDATE \"cambioAlumnos\" SET \"id_estado\" = 15 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU."\n";
                pg_query($conexion, $sqlU);
            }
            if ($btn == 4){
                $sqlU = "UPDATE \"alumno\" SET \"estado\" = 1 WHERE \"NoControl\" = '".$nc_ant."';";
                echo $sqlU;
                pg_query($conexion, $sqlU);
                $sqlU = "UPDATE \"cambioAlumnos\" SET \"id_estado\" = 14 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
            }
            if($btn == 6){
                $sqlI = "INSERT INTO \"observaciones\" (\"ObservacionesGestion\", \"CatObservaciones_idObservaciones\", \"Proyecto_FolioProyecto\") VALUES('".$observaciones."', 15, '".$folio."');";
                echo $sqlI;
                pg_query($conexion, $sqlI);
                $sqlU = "UPDATE \"cambioAlumnos\" SET \"id_estado\" = 13 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
            }
            if($btn == 8){
                $sqlU = "UPDATE \"observaciones\" SET \"ObservacionesInvestigacion\" = '".$observaciones."' WHERE \"CatObservaciones_idObservaciones\" = 15 and  \"Proyecto_FolioProyecto\" = '".$folio."';";
                echo $sqlU;
                pg_query($conexion, $sqlU);
                $sqlU = "UPDATE \"cambioAlumnos\" SET \"id_estado\" = 12 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
            }
        break;

        case 'colab_procesar_solicitud_baja':
             $folio = $_POST['folio_proyecto'];
             $np_baja = $_POST['np_baja_colab'];
             $num_solic = $_POST['numero_solicitud'];
             $btn = $_POST['btn'];
             $observaciones = $_POST['obs_baja_colab'];
             if($btn == 2){
                 $sqlD = "DELETE FROM \"colaboradordocente\" WHERE \"Docente_noPersonal\"= ".$np_baja." and \"Proyecto_FolioProyecto\" = '".$folio."';";
                 echo $sqlD;
                 pg_query($conexion, $sqlD);
                 $sqlU = "UPDATE \"usuario\" SET \"estado\" = 1 WHERE \"NoPersonal\" = ".$np_baja.";";
                 echo $sqlU;
                 pg_query($conexion, $sqlU);
                 $sqlU = "UPDATE \"cambioColaboradores\" SET \"id_estado\" = 15 WHERE \"id_solicitud\" = ".$num_solic.";";
                 echo $sqlU;
                 pg_query($conexion, $sqlU);
            }
            if ($btn == 4){
                $sqlU = "UPDATE \"usuario\" SET \"estado\" = 1 WHERE \"NoPersonal\" = ".$np_baja.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
                $sqlU = "UPDATE \"cambioColaboradores\" SET \"id_estado\" = 14 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
            }
            if($btn == 6){
                $sqlI = "INSERT INTO \"observaciones\" (\"ObservacionesGestion\", \"CatObservaciones_idObservaciones\", \"Proyecto_FolioProyecto\") VALUES('".$observaciones."', 13, '".$folio."');";
                echo $sqlI;
                pg_query($conexion, $sqlI);
                $sqlU = "UPDATE \"cambioColaboradores\" SET \"id_estado\" = 13 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
            }
            if($btn == 8){
                $sqlU = "UPDATE \"observaciones\" SET \"ObservacionesInvestigacion\" = '".$observaciones."' WHERE \"CatObservaciones_idObservaciones\" = 13 and  \"Proyecto_FolioProyecto\" = '".$folio."';";
                echo $sqlU;
                pg_query($conexion, $sqlU);
                $sqlU = "UPDATE \"cambioColaboradores\" SET \"id_estado\" = 12 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
            }
        break;

        case 'alum_procesar_solicitud_baja':
             $folio = $_POST['folio_proyecto'];
             $nc_baja = $_POST['nc_baja_alum'];
             $num_solic = $_POST['numero_solicitud'];
             $btn = $_POST['btn'];
             $observaciones = $_POST['obs_baja_alum'];
             if($btn == 2){
                 $sqlD = "DELETE FROM \"alumnoscolaboradoresdetalle\" WHERE \"FkNoControl\"= '".$nc_baja."' and \"folioproyecto\" = '".$folio."';";
                 echo $sqlD;
                 pg_query($conexion, $sqlD);
                 $sqlU = "UPDATE \"alumno\" SET \"estado\" = 1 WHERE \"NoControl\" = '".$nc_baja."';";
                 echo $sqlU;
                 pg_query($conexion, $sqlU);
                 $sqlU = "UPDATE \"cambioAlumnos\" SET \"id_estado\" = 15 WHERE \"id_solicitud\" = ".$num_solic.";";
                 echo $sqlU;
                 pg_query($conexion, $sqlU);
            }
            if ($btn == 4){
                $sqlU = "UPDATE \"alumno\" SET \"estado\" = 1 WHERE \"NoControl\" = '".$nc_baja."';";
                echo $sqlU;
                pg_query($conexion, $sqlU);
                $sqlU = "UPDATE \"cambioAlumnos\" SET \"id_estado\" = 14 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
            }
            if($btn == 6){
                $sqlI = "INSERT INTO \"observaciones\" (\"ObservacionesGestion\", \"CatObservaciones_idObservaciones\", \"Proyecto_FolioProyecto\") VALUES('".$observaciones."', 16, '".$folio."');";
                echo $sqlI;
                pg_query($conexion, $sqlI);
                $sqlU = "UPDATE \"cambioAlumnos\" SET \"id_estado\" = 13 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
            }
            if($btn == 8){
                $sqlU = "UPDATE \"observaciones\" SET \"ObservacionesInvestigacion\" = '".$observaciones."' WHERE \"CatObservaciones_idObservaciones\" = 16 and  \"Proyecto_FolioProyecto\" = '".$folio."';";
                echo $sqlU;
                pg_query($conexion, $sqlU);
                $sqlU = "UPDATE \"cambioAlumnos\" SET \"id_estado\" = 12 WHERE \"id_solicitud\" = ".$num_solic.";";
                echo $sqlU;
                pg_query($conexion, $sqlU);
            }
        break;


		default:
			
		break;
	}

 ?>