<?php 
$conn=new ClaseConsultas();
//$proyectosActivos = $miConn->obtenerProyectosDocente($_SESSION['NoPersonal']);
$proyectosActivos = $conn->obtenerProyectosDocente(2);
?>
<div class="container" style="margin-top: 13px;">
            <div class="col-lg-9">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="padding-bottom: 40px;">
                            <h2 class="text-center" style="font-weight: Yu Gothic UI Light;">Gestión de Colaboradores</h2>
                            <div class="form-group">
                                <div class="col-md-12 form-group">                                    
                                    <select class="form-control" onchange="obtenerColaborador_Cambio(this.value)" id="proyectos">
                                        <option>Proyectos activos</option>
                                        <?php
                                            while($r = pg_fetch_array($proyectosActivos)){
                                            echo "<option value='".$r[0]."'>".$r[1]."</option>";       
                                            }
                                        ?>                                                                          
                                    </select>                                   
                                </div>                            
                            </div>
                        </div>
                    <div class="panel-body" id= "tb_todo">
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
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>                                                 
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
                                        <th></th>
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
                                            No. control
                                        </th>
                                        <!--<th>
                                            Estatus
                                        </th>-->
                                        <th>Etapa actual</th>
                                        <th>
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>                                    
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                    <h4><b>Nota:</b>las actividades del docente o alumno que se de de baja o se cambie, se asignarán al próximo docente o alumno que ocupe su lugar.</h4>
                            </div>
                        </div>
                    </div>
                </div>
                            
                        </div>
                    </div>
                </div>
            </div>        

        <!--Modal cambio colaboradorDocente-->

        <div class="container">
            <div class="modal fade" data-backdrop="”static”" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" type="button">
                                ×
                            </button>
                            <h4 class="modal-title" style="text-align: center;">
                                Nuevo colaborador
                            </h4>
                        </div>
                        <form id="cambioC_form" name="" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="EnviarSolicitud(this.id)">                
                            <input type="hidden" id="cam_folio_proyecto" name="cam_folio_proyecto" readonly>
                            <input type="hidden" value="cambioColaborador" name="accion">
                            <input type="hidden" id ="cam_tipoSolicitud" name="cam_tipoSolicitud" value="2">
                            <input type="hidden" id="np_original" name="np_original">
                        <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12 form-group" id="cambio_colab_combo">
                                        <select class="form-control" data-live-search="true" onchange="obtener_colaborador(this.value, 1)" id="cbo_colaboradoresC">
                                                    <option>Seleccione un Docente de Reemplazo</option>
                                                    <!--<?php 
                                                    /*foreach($docentes as $row){
                                                        echo "<option value='".$row['NoPersonal']."'>".$row['Nombre']." - ".$row['academia']." - No. CONTROL: ".$row['NoPersonal']."</option>"; 
                                                    }*/
                                                    ?>-->
                                        </select>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Apellido paterno
                                        </label>
                                        <input class="form-control" readonly id= "cam_ap_paterno" type="text">                                    
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Apellido materno
                                        </label>
                                        <input class="form-control" readonly id="cam_ap_materno" type="text">
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Nombre(s)
                                        </label>
                                        <input class="form-control" readonly id="cam_nombre" type="text">                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label for="sel1">
                                            Grado máximo de estudios:
                                        </label>
                                        <input class="form-control" readonly id="cam_max_estudios" type="text">
                                    </div>
                                    <div class="col-sm-8 form-group">
                                        <label>
                                            Academia a la que pertenece
                                        </label>
                                        <select class="form-control" disabled id="cam_carrera">
                                            <option>...</option>
                                            <?php
                                                $res = $miConn->cboCarrera();
                                                while($r = pg_fetch_array($res)){
                                                    echo "<option value='".$r[0]."'>".$r[1]."</option>";       
                                                }
                                            ?>  
                                        </select>                                                  
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            N°. personal
                                        </label>
                                        <input class="form-control" readonly id="cam_numero_p" name="cam_numero_p" type="text">                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Móvil
                                        </label>
                                        <input class="form-control" pattern="^\d{10}$" readonly id="cam_celu" type="text">
                                        
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label>
                                            Correo institucional
                                        </label>
                                        <input class="form-control" readonly id="cam_correo1" type="email">
                                        
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label>
                                            Correo alternativo
                                        </label>
                                        <input class="form-control" readonly id="cam_correo2" name="cam_correo2" type="email">
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Descripción de las actividades asignadas para realizar en el proyecto
                                    </label>
                                    <textarea class="form-control" readonly id="cam_actividades_colab" name="cam_actividades_colab" rows="4" style="resize:none;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>
                                        *Observaciones
                                    </label>
                                    <textarea class="form-control" id="cambioC_observaciones" name="cambioC_observaciones" required rows="4" style="resize:none;"></textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal" type="button">
                                Cerrar
                            </button>
                            <button class="btn btn-primary pull-left" disabled data-dismiss="modal" type="button">
                                Descargar formato de
                                <br>
                                    cambio de colaboradores
                                </br>
                            </button>
                            <button class="btn btn-primary" id="btnGuardarC" onclick="" type="submit">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!--Finaliza modal cambio colaborador-->
        
        
        <!--Modal baja colaboradorDocente-->    

        <div class="container">
            <div class="modal fade" id="myModal2" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" type="button">
                                ×
                            </button>
                            <h4 class="modal-title">
                                Baja colaborador
                            </h4>
                        </div>
                        <form id="bajaC_form" name="" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="EnviarSolicitud(this.id)">                
                            <input type="hidden" id="baja_folio_proyecto" name="baja_folio_proyecto" readonly>
                            <input type="hidden" value="bajaColaborador" name="accion">
                            <input type="hidden" id ="baja_tipoSolicitud" name="baja_tipoSolicitud" value="3">
                            <input type="hidden" id ="baja_numero_p" name="baja_numero_p">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>
                                    *¿Por qué quieres dar de baja al colaborador?
                                </label>
                                <textarea class="form-control" required rows="4" id="motivo_bajaC" name="motivo_bajaC" style="resize:none;"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal" type="button" style="float: left;">
                                Cerrar
                            </button>
                            <button class="btn btn-primary" onclick="" type="submit">
                                Guardar
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Finaliza modal baja colaborador-->
        
        <!-- Modal baja colaboradorAlumno-->
        <div class="container">
            <div class="modal fade" id="ModalBajaAlumno" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" type="button">
                                ×
                            </button>
                            <h4 class="modal-title">
                                Baja colaborador
                            </h4>
                        </div>
                        <form id="bajaA_form" name="" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="EnviarSolicitud(this.id)">                
                            <input type="hidden" id="baja_folio_proyectoAlum" name="baja_folio_proyecto" readonly>
                            <input type="hidden" value="bajaAlumno" name="accion">
                            <input type="hidden" id ="al_baja_tipoSolicitud" name="baja_tipoSolicitud" value="6">
                            <input type="hidden" id ="al_baja_numero_c" name="baja_numero_c">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>
                                    *¿Por qué quieres dar de baja al alumno?
                                </label>
                                <textarea class="form-control" required rows="4" id="motivo_bajaAlum" name="motivo_bajaAlum" style="resize:none;"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal" type="button" style="float: left;">
                                Cerrar
                            </button>
                            <button class="btn btn-primary" onclick="" type="submit">
                                Guardar
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Finaliza modal baja colaboradorAlumno-->

        <!--Modal cambio colaboradorAlumno -->
        <div class="container">
            <div class="modal fade" id="ModalCambioAlumno" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" type="button">
                                ×
                            </button>
                            <h4 class="modal-title" style="text-align: center;">
                                Nuevo colaborador
                            </h4>
                        </div>
                        <form id="cambioA_form" name="" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="EnviarSolicitud(this.id)">
                        <input type="hidden" id="al_folio_proyectoC" name="al_folio_proyectoC" readonly>
                        <input type="hidden" value="cambioAlumno" name="accion">
                        <input type="hidden" id ="al_tipoSolicitudC" name="al_tipoSolicitud" value="5">
                        <input type="hidden" id="nc_original" name="nc_original">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 form-group" id="cambio_alum_combo">
                                        <select class="form-control" data-live-search="true" onchange="obtener_alumno(this.value, 1)" id="cbo_alumnosA">
                                                <option>
                                                    Seleccione un alumno
                                                </option>                                                
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <h5 style="margin-right: 20px;"><input type="checkbox" id="al_servicio_cam" name="al_servicio"><strong>Servicio Social</strong></h5>
                                        <h5 style="margin-right: 20px;"><input type="checkbox" id="al_residencia_cam" name=al_residencia"><strong>Residencia Profesionales</strong></h5>
                                        <h5><input type="checkbox" id="al_tesis" name="al_tesis_cam"><strong>Tesis</strong></h5>
                                    </div>  
                                </div>                                
                                <!--<div class="row">-->
                                    <div class="col-md-4 form-group">
                                            <label>
                                                Apellido paterno
                                            </label>                                                       
                                            <input class="form-control" readonly id="al_ap_paterno_cam" name="" type="text">
                                        </div>  
                                        <div class="col-md-4 form-group">
                                            <label>
                                                Apellido materno
                                            </label>                                                       
                                            <input class="form-control" readonly id="al_ap_materno_cam" name="" type="text">
                                        </div>  
                                         <div class="col-md-4 form-group">
                                            <label>
                                                Nombre(s)
                                            </label>                                                       
                                            <input class="form-control" readonly id="al_nombre_cam" name="" type="text">
                                        </div>                        
                                        <div class="col-md-4 form-group">
                                            <label>
                                                No. control
                                            </label>
                                            <input class="form-control" readonly id="al_control_cam" name="al_control" type="text">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>Semestre</label>
                                            <select id="al_semestre" required name="al_semestre" class="form-control">
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                                <option>11</option>
                                                <option>12</option>
                                            </select>
                                        </div>
                                        <!--<div class="col-md-4 form-group">
                                            <label>
                                                Semestre
                                            </label>
                                            <input class="form-control" name="" type="text">
                                        </div>-->

                                        <div class="col-md-4 form-group">
                                            <label>
                                                Carrera
                                            </label>
                                            <select class="form-control" disabled id="al_carrera_cam" name="al_carrera">
                                                    <option>...</option>
                                                    <?php
                                                        $res = $miConn->cboCarrera();
                                                        while($r = pg_fetch_array($res)){
                                                            echo "<option value='".$r[0]."'>".$r[1]."</option>";       
                                                        }
                                                    ?>  
                                            </select>  
                                        </div>
                                        <div class=" col-sm-12 form-group">
                                            <label>
                                                Detalle de actividades
                                            </label>
                                            <textarea class="form-control" id="al_actividadesC" readonly name="al_actividades" rows="4" style="resize:none; width: 99%;"></textarea>
                                        </div>
                                        <div class=" col-sm-12 form-group">
                                            <label>
                                                Observaciones
                                            </label>
                                            <textarea class="form-control" required id="observaciones_alum" name="observaciones_alum" rows="4" style="resize:none;"></textarea>
                                        </div>
                                    <!--</div>-->
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-default" data-dismiss="modal" type="button">
                                        Cerrar
                                    </button>
                                    <button class="btn btn-primary" id="btnGuadarAC" onclick="" type="submit">
                                        Guardar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Finaliza modal cambio colaboradorAlumno-->
            

            <!--Modal alta colaboradorAlumno-->
            <div class="container">
                <div class="modal fade" id="ModalAltaAlumno" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal" type="button">
                                    ×
                                </button>
                                <h4 class="modal-title" style="text-align: center;">
                                    Nuevo alumno colaborador
                                </h4>
                            </div>
                            <form id="altaA_form" name="" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="EnviarSolicitud(this.id)">
                                <input type="hidden" id="al_folio_proyecto" name="al_folio_proyecto" readonly>
                                <input type="hidden" value="altaAlumno" name="accion">
                                <input type="hidden" id ="al_tipoSolicitud" name="al_tipoSolicitud" value="4">
                                <div class="modal-body">                                   
                                        <div class="col-md-12 form-group" id="alta_alum_combo">
                                            <select class="form-control" data-live-search="true" onchange="obtener_alumno(this.value, 0)" id="cbo_alumnosA">
                                                <option>
                                                    Seleccione un alumno
                                                </option>                                                
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <h5 style="margin-right: 20px;"><input type="checkbox" id="al_servicio" name="al_servicio"><strong>Servicio Social</strong></h5>
                                            <h5 style="margin-right: 20px;"><input type="checkbox" id="al_residencia" name=al_residencia"><strong>Residencia Profesionales</strong></h5>
                                            <h5><input type="checkbox" id="al_tesis" name="al_tesis"><strong>Tesis</strong></h5>
                                        </div>    
                                        <div class="col-md-4 form-group">
                                            <label>
                                                Apellido paterno
                                            </label>                                                       
                                            <input class="form-control" readonly id="al_ap_paterno" name="" type="text">
                                        </div>  
                                        <div class="col-md-4 form-group">
                                            <label>
                                                Apellido materno
                                            </label>                                                       
                                            <input class="form-control" readonly id="al_ap_materno" name="" type="text">
                                        </div>  
                                         <div class="col-md-4 form-group">
                                            <label>
                                                Nombre(s)
                                            </label>                                                       
                                            <input class="form-control" readonly id="al_nombre" name="" type="text">
                                        </div>                        
                                        <div class="col-md-4 form-group">
                                            <label>
                                                No. control
                                            </label>
                                            <input class="form-control" readonly id="al_control" name="al_control" type="text">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>Semestre</label>
                                            <select id="al_semestre" required name="al_semestre" class="form-control">
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                                <option>11</option>
                                                <option>12</option>
                                            </select>
                                        </div>
                                        <!--<div class="col-md-4 form-group">
                                            <label>
                                                Semestre
                                            </label>
                                            <input class="form-control" name="" type="text">
                                        </div>-->

                                        <div class="col-md-4 form-group">
                                            <label>
                                                Carrera
                                            </label>
                                            <select class="form-control" disabled id="al_carrera" name="al_carrera">
                                                    <option>...</option>
                                                    <?php
                                                        $res = $miConn->cboCarrera();
                                                        while($r = pg_fetch_array($res)){
                                                            echo "<option value='".$r[0]."'>".$r[1]."</option>";       
                                                        }
                                                    ?>  
                                            </select>  
                                        </div>
                                        <div class=" col-sm-12 form-group">
                                            <label>
                                                Detalle de actividades
                                            </label>
                                            <textarea class="form-control" maxlength="255" required id="al_actividades" name="al_actividades" rows="6" style="resize:none; width: 99%;"></textarea>
                                        </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-default" data-dismiss="modal" type="button">
                                        Cerrar
                                    </button>
                                    <button class="btn btn-primary" id="btnGuardarAA" onclick="" type="submit">
                                        Guardar
                                    </button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Finaliza modal alta colaboradorAlumno-->

                <!--Modal alta colaboradorDocente-->
                <div class="container">
                    <div class="modal fade" id="myModal3" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal" type="button">
                                        ×
                                    </button>
                                    <h4 class="modal-title" style="text-align: center;">
                                        Nuevo colaborador
                                    </h4>
                                </div>                                
                             <form id="altaC_form" name="" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="EnviarSolicitud(this.id)">
                                <input type="hidden" id="folio_proyecto" name="folio_proyecto" readonly>
                                <input type="hidden" value="altaColaborador" name="accion">
                                <input type="hidden" id ="tipoSolicitud" name="tipoSolicitud" value="1">
                                <div class="modal-body">
                                        <div class="col-sm-12 form-group" id="alta_colab_combo">
                                                <select class="form-control" data-live-search="true" onchange="obtener_colaborador(this.value, 0)" id="cbo_colaboradoresA">
                                                            <option>Seleccione un Docente</option>
                                                            <!--<?php 
                                                            /*foreach($docentes as $row){
                                                                echo "<option value='".$row['NoPersonal']."'>".$row['Nombre']." - ".$row['academia']." - No. CONTROL: ".$row['NoPersonal']."</option>"; 
                                                            }*/
                                                            ?>-->
                                                </select>
                                        </div>                                    
                           
                                            <div class="col-md-4 form-group">
                                                <label>
                                                    Apellido paterno
                                                </label>
                                                <input class="form-control" readonly id="ap_paterno" name="ap_paterno" type="text">
                                    
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label>
                                                    Apellido materno
                                                </label>
                                                <input class="form-control" readonly id="ap_materno" name="ap_materno" type="text">
                                        
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label>
                                                    Nombre(s)
                                                </label>
                                                <input class="form-control" readonly id="nombre" name="nombre" type="text">                                                
                                            </div>                         
                                            <div class="col-md-4 form-group">
                                                <label for="sel1">
                                                    Grado máximo de estudios
                                                </label>
                                                <input class="form-control" readonly id="max_estudios" type="text">
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <label>
                                                    Academia a la que pertenece
                                                </label>
                                                <select class="form-control" disabled id="carrera" name="carrera">
                                                    <option>...</option>
                                                    <?php
                                                        $res = $miConn->cboCarrera();
                                                        while($r = pg_fetch_array($res)){
                                                            echo "<option value='".$r[0]."'>".$r[1]."</option>";       
                                                        }
                                                    ?>  
                                                </select>                                                
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label>
                                                    No. de personal
                                                </label>
                                                <input class="form-control" readonly id="numero_p" name="numero_p" type="text">
                                        
                                            </div>
                                            <div class="col-sm-3 form-group">
                                                <label>
                                                    Móvil
                                                </label>
                                                <input class="form-control" readonly pattern="^\d{10}$" id="celu" name="celu" type="text">
                                                
                                            </div>
                                            <div class="col-sm-4 form-group">
                                                <label>
                                                    Correo
                                                </label>
                                                <input class="form-control" readonly id="correo1" name="correo1" type="email">
                                                
                                            </div>
                                        <div class="col-sm-3 form-group">
                                                <label>
                                                    Correo alternativo
                                                </label>
                                                <input class="form-control" readonly id="correo2" name="correo2" type="email">
                                                
                                        </div>
                                            <!--<div class="col-sm-12 form-group">
                                                <label>
                                                    Firma del responsable del proyecto
                                                </label>
                                                <input class="form-control" required="" type="text">                                             
                                            </div>-->
                                     
                                        <div class="form-group col-md-12">
                                            <label>
                                                *Descripción de las principales actividades a desarrollar en el proyecto
                                            </label>
                                            <textarea class="form-control" required id="p_actividades" name="p_actividades" rows="6" style="resize:none; width: 99%;" maxlength="255"></textarea>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-default" data-dismiss="modal" type="button">
                                        Cerrar
                                    </button>
                                    <button class="btn btn-primary" type="submit" id = "btnGuardarA">
                                        Guardar
                                    </button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>