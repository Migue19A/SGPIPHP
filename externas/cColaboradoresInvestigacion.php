<?php 
    $conn=new ClaseConsultas();
//$proyectosActivos = $miConn->obtenerProyectosDocente($_SESSION['NoPersonal']);
    $solicitudesPendientesC = $conn->obtenerSolicCambioColaboradoresInv();
    $solicitudesPendientesA = $conn->obtenerSolicCambioAlumnosInv();
    $obs_inv = '';  
    $estado_solic = 0;  
    $estado_AC = 0;
    $estado_CC = 0;   
    $estado_BC = 0;
    $estado_AA = 0;
    $estado_CA = 0;
    $estado_BA = 0;  
?>
<div class="container" style="margin-top: 14px;">
    <div class="col-md-9">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="text-center" style="font-weight: Yu Gothic UI Light;">Solicitud cambio colaboradores</h1>
                </div>
                <div class="panel-body">
                    <table class="table table-condensed" style="float: center;">
                        <thead>
                            <tr>
                                <th>No. de solicitud</th>
                                <th>Nombre de proyecto</th>
                                <th>No. P.</th>
                                <th>Tipo Solic.</th>
                                <th>Estado Solic.</th>
                                <th>Fecha</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                while($r = pg_fetch_array($solicitudesPendientesC)){ 
                                $tipo_solic = $r['int_tipo'];
                                $np_doc = $r['np_doc']; 
                                $estado_solic = $r['int_estado'];                              
                            ?>
                            <tr>
                                <td><?php echo $r['solicitud'] ?></td>
                                <td><?php echo $r['nom_proy'] ?></td>
                                <td><?php echo $r['np_doc']?></td>
                                <td><?php echo $r['tiposoli'] ?></td>
                                <td><?php echo $r['desc_estado']?></td>
                                <td><?php echo $r['fecha_solic']?></td>
                                <?php 
                                    if($tipo_solic== 1){
                                        $estado_AC = $estado_solic;
                                ?>
                                        <?php if($estado_solic != 12){ 
                                            $observacionesGest = $conn -> obtenerObservacionesGest($r['folio_p'], 11);
                                            if($res = pg_fetch_array($observacionesGest)){
                                                $obs_inv = $res[0];
                                            }
                                        ?>                                        
                                            <td><input class="btn btn-primary" id="<?php echo $np_doc ?>" data-target="#myModalAltaColaborador" data-toggle="modal" onclick="llenarDatosColabAlta(this.id, '<?php echo $r['activ_act'] ?>', '<?php echo $r['solicitud'] ?>', '<?php echo $r['folio_p'] ?>', '<?php echo $obs_inv ?>')" name="" type="button" value="Ver"/></td>
                                        <?php }else{ ?>
                                            <td><input class="btn btn-info" id="<?php echo $np_doc ?>" data-target="#myModalAltaColaborador" data-toggle="modal" onclick="llenarDatosColabAlta(this.id, '<?php echo $r['activ_act'] ?>', '<?php echo $r['solicitud'] ?>', '<?php echo $r['folio_p'] ?>', '<?php echo $obs_inv ?>')" name="" type="button" value="Enviado"/></td>
                                        <?php } ?>    
                                <?php 
                                    }
                                    if($tipo_solic== 2){
                                        $estado_CC = $estado_solic;
                                ?>
                                        <?php if($estado_solic != 12){ 
                                            $observacionesGest = $conn -> obtenerObservacionesGest($r['folio_p'], 12);
                                            if($res = pg_fetch_array($observacionesGest)){
                                                $obs_inv = $res[0];
                                            }
                                        ?>                                        
                                            <td><input class="btn btn-primary" id="<?php echo $np_doc ?>" data-target="#myModalCambioColaborador" data-toggle="modal" onclick="llenarDatosColabCambio(this.id, '<?php echo $r['activ_act'] ?>', '<?php echo $r['motivo'] ?>', <?php echo $r['np_reemp'] ?>,<?php echo $r['solicitud'] ?>, '<?php echo $r['folio_p'] ?>', '<?php echo $obs_inv ?>')" name="" type="button" value="Ver"/></td>
                                        <?php }else{ ?>
                                            <<td><input class="btn btn-info" id="<?php echo $np_doc ?>" data-target="#myModalCambioColaborador" data-toggle="modal" onclick="llenarDatosColabCambio(this.id, '<?php echo $r['activ_act'] ?>', '<?php echo $r['motivo'] ?>', <?php echo $r['np_reemp'] ?>,<?php echo $r['solicitud'] ?>, '<?php echo $r['folio_p'] ?>', '<?php echo $obs_inv ?>')" name="" type="button" value="Enviado"/></td>
                                        <?php } ?>
                                <?php 
                                    }
                                    if($tipo_solic== 3){
                                        $estado_BC = $estado_solic;
                                ?>
                                        <?php if($estado_solic != 12){ 
                                            $observacionesGest = $conn -> obtenerObservacionesGest($r['folio_p'], 13);
                                            if($res = pg_fetch_array($observacionesGest)){
                                                $obs_inv = $res[0];
                                            }
                                        ?>                                        
                                            <td><input class="btn btn-primary" id="<?php echo $np_doc ?>" data-target="#myModalBajaColaborador" data-toggle="modal" onclick="llenarDatosColabBaja(this.id, '<?php echo $r['motivo'] ?>', <?php echo $r['solicitud'] ?>,'<?php echo $r['folio_p'] ?>', '<?php echo $obs_inv ?>')" name="" type="button" value="Ver"/></td>
                                        <?php }else{ ?>
                                            <td><input class="btn btn-info" id="<?php echo $np_doc ?>" data-target="#myModalBajaColaborador" data-toggle="modal" onclick="llenarDatosColabBaja(this.id, '<?php echo $r['motivo'] ?>', <?php echo $r['solicitud'] ?>,'<?php echo $r['folio_p'] ?>', '<?php echo $obs_inv ?>')" name="" type="button" value="Enviado"/></td>
                                        <?php } ?>
                                <?php
                                    }
                                ?>
                            </tr>
                            <?php 
                                }
                            ?>
                            <!--<tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input class="btn btn-primary" data-target="#myModal" data-toggle="modal" name="" type="button" value="Ver"/></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input class="btn btn-primary" data-target="#myModal2" data-toggle="modal" name="" type="button" value="Ver"/></td>
                            </tr>-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
     <div class="col-md-9">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="text-center" style="font-weight: Yu Gothic UI Light;">Solicitud cambio colaboradores alumnos</h1>
                </div>
                <div class="panel-body">
                    <table class="table table-condensed" style="float: center;">
                        <thead>
                            <tr>
                                <th>No. de solicitud</th>
                                <th>Nombre de proyecto</th>
                                <th>No. Ctrl.</th>
                                <th>Tipo Solic.</th>
                                <th>Estado Solic.</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                while($r = pg_fetch_array($solicitudesPendientesA)){ 
                                $tipo_solic = $r['int_tipo']; 
                                $nc_alum = $r['nc_alum']; 
                                $estado_solic = $r['int_estado'];  
                            ?>
                            <tr>
                                <td><?php echo $r['solicitud'] ?></td>
                                <td><?php echo $r['nom_proy'] ?></td>
                                <td><?php echo $r['nc_alum']?></td>
                                <td><?php echo $r['tiposoli'] ?></td>
                                <td><?php echo $r['desc_estado'] ?></td>
                                <td><?php echo $r['fecha_solic']?></td>
                                <?php 
                                    if($tipo_solic== 4){
                                        $estado_AA = $estado_solic;
                                ?>
                                        <?php if($estado_solic != 12){ 
                                            $observacionesGest = $conn -> obtenerObservacionesGest($r['folio_p'], 14);
                                            if($res = pg_fetch_array($observacionesGest)){
                                                $obs_inv = $res[0];
                                            }
                                        ?>                                   
                                            <td><input class="btn btn-primary" id="<?php echo $nc_alum ?>" data-target="#myModalAltaAlumno" data-toggle="modal" onclick="llenarDatosAlumAlta(this.id, '<?php echo $r['activ_alum'] ?>', <?php echo $r['solicitud'] ?>, <?php echo $r['servicio']?>, <?php echo $r['residencia']?>, <?php echo $r['tesis']?>, <?php echo $r['sem_alum']?>, '<?php echo $r['folio_p'] ?>', '<?php echo $obs_inv ?>')" name="" type="button" value="Ver"/></td>
                                        <?php }else{ ?>                                            
                                            <td><input class="btn btn-info" id="<?php echo $nc_alum ?>" data-target="#myModalAltaAlumno" data-toggle="modal" onclick="llenarDatosAlumAlta(this.id, '<?php echo $r['activ_alum'] ?>', <?php echo $r['solicitud'] ?>, <?php echo $r['servicio']?>, <?php echo $r['residencia']?>, <?php echo $r['tesis']?>, <?php echo $r['sem_alum']?>, '<?php echo $r['folio_p'] ?>', '<?php echo $obs_inv ?>')" name="" type="button" value="Enviado"/></td>>
                                        <?php } ?>   

                                <?php 
                                    }
                                    if($tipo_solic== 5){
                                        $estado_CA = $estado_solic;
                                ?>
                                        <?php if($estado_solic != 12){ 
                                            $observacionesGest = $conn -> obtenerObservacionesGest($r['folio_p'], 15);
                                            if($res = pg_fetch_array($observacionesGest)){
                                                $obs_inv = $res[0];
                                            }
                                        ?>                                   
                                            <td><input class="btn btn-primary" id="<?php echo $nc_alum ?>" data-target="#myModalCambioAlumno" data-toggle="modal" name="" onclick="llenarDatosAlumCambio(this.id, '<?php echo $r['activ_alum'] ?>', '<?php echo $r['nc_reem'] ?>', <?php echo $r['solicitud'] ?>, '<?php echo $r['motivo'] ?>', '<?php echo $r['servicio'] ?>', '<?php echo $r['residencia'] ?>', '<?php echo $r['tesis'] ?>', <?php echo $r['sem_alum'] ?>, '<?php echo $r['folio_p'] ?>', '<?php echo $obs_inv ?>')" type="button" value="Ver"/></td>
                                        <?php }else{ ?>                                            
                                            <td><input class="btn btn-info" id="<?php echo $nc_alum ?>" data-target="#myModalCambioAlumno" data-toggle="modal" name="" onclick="llenarDatosAlumCambio(this.id, '<?php echo $r['activ_alum'] ?>', '<?php echo $r['nc_reem'] ?>', <?php echo $r['solicitud'] ?>, '<?php echo $r['motivo'] ?>', '<?php echo $r['servicio'] ?>', '<?php echo $r['residencia'] ?>', '<?php echo $r['tesis'] ?>', <?php echo $r['sem_alum'] ?>, '<?php echo $r['folio_p'] ?>', '<?php echo $obs_inv ?>')" type="button" value="Enviado"/></td>
                                        <?php } ?>
                                <?php 
                                    }
                                    if($tipo_solic== 6){
                                        $estado_BA = $estado_solic;
                                ?>
                                        
                                        <?php if($estado_solic != 12){ 
                                            $observacionesGest = $conn -> obtenerObservacionesGest($r['folio_p'], 15);
                                            if($res = pg_fetch_array($observacionesGest)){
                                                $obs_inv = $res[0];
                                            }
                                        ?>                                   
                                           <td><input class="btn btn-primary" id="<?php echo $nc_alum ?>" data-target="#myModalBajaAlumno" data-toggle="modal" onclick="llenarDatosAlumBaja(this.id, '<?php echo $r['motivo'] ?>', <?php echo $r['solicitud'] ?>, '<?php echo $r['folio_p'] ?>', '<?php echo $obs_inv ?>')" name="" type="button" value="Ver"/></td>
                                        <?php }else{ ?>                                            
                                            <td><input class="btn btn-info" id="<?php echo $nc_alum ?>" data-target="#myModalBajaAlumno" data-toggle="modal" onclick="llenarDatosAlumBaja(this.id, '<?php echo $r['motivo'] ?>', <?php echo $r['solicitud'] ?>, '<?php echo $r['folio_p'] ?>', '<?php echo $obs_inv ?>')" name="" type="button" value="Enviado"/></td>
                                        <?php } ?>                                        
                                <?php
                                    }
                                ?>
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
</div>

<!----------------------------------------------------------------------------------------------------------------------------------------------->

<div class="container">
    <div class="modal fade" id="myModalBajaColaborador" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title">Baja colaborador</h4>
                </div>
                <form id="procesarBajaC_form" name="" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="ProcesarSolicitud(this.id)">
                <input type="hidden" name="accion" value="colab_procesar_solicitud_baja">
                <input type="hidden" name="folio_proyecto" id="colab_folio_proyectoB" >
                <input type="hidden" name="np_baja_colab" id="np_baja_colab">
                <input type="hidden" name="numero_solicitud" id="colab_numero_solicB">
                <input type="hidden" name="btn" id="btn_baja_colab">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Motivos de la baja</label>
                        <textarea class="form-control" id="motivos_baja_colab" name="motivos_baja_colab" readonly="" rows="4" style="resize:none;"></textarea>
                        <label>Observaciones de la Oficina de Seguimiento y Proyectos de Investigación</label>
                        <textarea class="form-control" id="obs2_baja_colab" readonly rows="4" style="resize:none;"></textarea>
                        <label>Observaciones</label>
                        <textarea class="form-control" name="obs_baja_colab" rows="4" style="resize:none;"></textarea>
                    </div>
                </div>
                <?php if($estado_BC != 13){ ?>                
                    <div class="modal-footer">
                        <button class="btn btn-primary" disabled onclick="tipo(4)" type="submit">Enviar a Gestión</button>
                        <button class="btn btn-default"  data-dismiss="modal" type="button">Cerrar</button>
                    </div>
                <?php }else{ ?>
                    <div class="modal-footer">
                        <button class="btn btn-primary" onclick="tipo(4)" type="submit">Enviar a Gestión</button>
                        <button class="btn btn-default"  data-dismiss="modal" type="button">Cerrar</button>
                    </div>
                <?php } ?>
            </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="modal fade" id="myModalBajaAlumno" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title">Baja colaborador alumno</h4>
                </div>
                <form id="procesarBajaA_form" name="" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="ProcesarSolicitud(this.id)">
                <input type="hidden" name="accion" value="alum_procesar_solicitud_baja">
                <input type="hidden" name="folio_proyecto" id="alum_folio_proyectoB" >
                <input type="hidden" name="nc_baja_alum" id="nc_baja_alum">
                <input type="hidden" name="numero_solicitud" id="alum_numero_solicB">
                <input type="hidden" name="btn" id="btn_baja_alum">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Motivos de la baja</label>
                        <textarea class="form-control" id="motivos_baja_alum" readonly="" rows="4" style="resize:none;"></textarea>
                        <label>Observaciones de la Oficina de Seguimiento y Proyectos de Investigación</label>
                        <textarea class="form-control" id="obs2_baja_alum" readonly rows="4" style="resize:none;"></textarea>
                        <label>Observaciones</label>
                        <textarea class="form-control" name="obs_baja_alum" rows="4" style="resize:none;"></textarea>
                    </div>
                </div>
                <?php if($estado_BA != 13){ ?>                
                    <div class="modal-footer">
                        <button class="btn btn-primary" disabled onclick="tipo(4)" type="submit">Enviar a Gestión</button>
                        <button class="btn btn-default"  data-dismiss="modal" type="button">Cerrar</button>
                    </div>
                <?php }else{ ?>
                    <div class="modal-footer">
                        <button class="btn btn-primary" onclick="tipo(4)" type="submit">Enviar a Gestión</button>
                        <button class="btn btn-default"  data-dismiss="modal" type="button">Cerrar</button>
                    </div>
                <?php } ?>
            </form>
            </div>
        </div>
    </div>
</div>

<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
<div class="container">
    <div class="modal fade" id="myModalAltaColaborador" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">×</button>
                    <h4 class="modal-title text-center">Alta colaborador</h4>
                </div>
                <form id="procesarAltaC_form" name="" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="ProcesarSolicitud(this.id)">
                <input type="hidden" name="accion" value="colab_procesar_solicitud_alta">
                <input type="hidden" name="folio_proyecto" id="colab_folio_proyectoA" >
                <input type="hidden" name="numero_solicitud" id="colab_numero_solicA">
                <input type="hidden" name="btn" id="btn_alta_colab">
                <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>Apellido paterno</label>
                                <input class="form-control" id="ap_paterno_alta" readonly="" type="text">                                            
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>Apellido materno</label>
                                <input class="form-control" id="ap_materno_alta" readonly="" type="text">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>Nombre(s)</label>
                                <input class="form-control" id="nombre_alta" readonly="" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>Grado máximo de estudios</label>
                                <input class="form-control" id="max_estudios_alta" readonly="" type="text">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>
                                    Carrera
                                </label>
                                <select class="form-control" disabled id="carrera_alta" name="al_carrera">
                                        <option>...</option>
                                        <?php
                                            $res = $miConn->cboCarrera();
                                            while($r = pg_fetch_array($res)){
                                                echo "<option value='".$r[0]."'>".$r[1]."</option>";       
                                            }
                                        ?>  
                                </select>  
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>No. de personal</label>
                                <input class="form-control" id="numero_p_alta"  name="numero_p_alta" readonly="" type="text">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>Móvil</label>
                                <input class="form-control" id="celu_alta" pattern="^\d{10}$" readonly="" type="text">
                            </div>
                            <div class="col-sm-5 form-group">
                                <label>Correo institucional</label>
                                <input class="form-control" id="correo1_alta" readonly="" type="email">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Descripción de las principales actividades a desarrollar en el proyecto</label>
                            <textarea class="form-control" id="actividades_colab_alta" name="actividades_colab_alta" readonly="" rows="4" style="resize:none;"></textarea>
                        </div> 
                        <div class="form-group">
                            <label>Observaciones de la Oficina de Seguimiento y Proyectos de Investigacións</label>
                            <textarea class="form-control" id="obs2_alta_colab" readonly rows="4" style="resize:none;"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea class="form-control" name="obs_alta_colab" rows="4" style="resize:none;"></textarea>
                        </div>
                    </div>
                <?php if($estado_AC != 13){ ?>                
                    <div class="modal-footer">
                        <button class="btn btn-primary" disabled onclick="tipo(4)" type="submit">Enviar a Gestión</button>
                        <button class="btn btn-default"  data-dismiss="modal" type="button">Cerrar</button>
                    </div>
                <?php }else{ ?>
                    <div class="modal-footer">
                        <button class="btn btn-primary" onclick="tipo(4)" type="submit">Enviar a Gestión</button>
                        <button class="btn btn-default"  data-dismiss="modal" type="button">Cerrar</button>
                    </div>
                <?php } ?>              
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="modal fade" id="myModalAltaAlumno" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">×</button>
                    <h4 class="modal-title" style="text-align: center;">Alta colaborador alumno</h4>
                </div>                
                <form id="procesarAltaA_form" name="" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="ProcesarSolicitud(this.id)">
                <input type="hidden" name="accion" value="al_procesar_solicitud_alta">
                <input type="hidden" name="folio_proyecto" id="al_folio_proyectoA" >
                <input type="hidden" name="numero_solicitud" id="alum_numero_solicA">
                <input type="hidden" name="btn" id="btn_alta_alum">
                <input type="hidden" name="al_servicio" id="al_servicioA">
                <input type="hidden" name="al_residencia" id="al_residenciaA">
                <input type="hidden" name="al_tesis" id="al_tesisA">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <h5 style="margin-right: 20px;"><input type="checkbox" id="check_al_servicioA"><strong>Servicio Social</strong></h5>
                            <h5 style="margin-right: 20px;"><input type="checkbox" id="check_al_residenciaA"><strong>Residencia Profesionales</strong></h5>
                            <h5><input type="checkbox" id="check_al_tesisA"><strong>Tesis</strong></h5>
                        </div> 
                        <div class="col-sm-4 form-group">
                            <label>Apellido paterno</label>
                            <input class="form-control" id="al_ap_paternoA" readonly="" type="text">                                            
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Apellido materno</label>
                            <input class="form-control" id="al_ap_maternoA" readonly="" type="text">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Nombre(s)</label>
                            <input class="form-control" id="al_nombreA" readonly="" type="text">
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-4 form-group">
                                <label>
                                    Carrera
                                </label>
                                <select class="form-control" disabled id="al_carreraA" name="al_carrera">
                                        <option>...</option>
                                        <?php
                                            $res = $miConn->cboCarrera();
                                            while($r = pg_fetch_array($res)){
                                                echo "<option value='".$r[0]."'>".$r[1]."</option>";       
                                            }
                                        ?>  
                                </select>  
                            </div>
                        <div class="col-sm-3 form-group">
                            <label>No. de control</label>
                            <input class="form-control" id="al_controlA" name="al_controlA" readonly="" type="text">
                        </div>        
                        <div class="col-sm-4 form-group">
                            <label>Semestre</label>
                            <input type="text" class="form-control" name="al_semestreA" id="al_semestreA" readonly>
                        </div>                    
                        <div class="form-group col-md-12">
                            <label>Descripción de las principales actividades a desarrollar en el proyecto</label>
                            <textarea class="form-control" id="actividades_alumA" name="actividades_alumA" readonly="" rows="4" style="resize:none;"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Observaciones de la Oficina de Seguimiento y Proyectos de Investigación</label>
                            <textarea class="form-control" id="obs2_alta_alum" readonly rows="4" style="resize:none;"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Observaciones</label>
                            <textarea class="form-control" name="obs_alta_alum" rows="4" style="resize:none;"></textarea>
                        </div>
                    </div>
                <?php if($estado_AA != 13){ ?>                
                    <div class="modal-footer">
                        <button class="btn btn-primary" disabled onclick="tipo(4)" type="submit">Enviar a Gestión</button>
                        <button class="btn btn-default"  data-dismiss="modal" type="button">Cerrar</button>
                    </div>
                <?php }else{ ?>
                    <div class="modal-footer">
                        <button class="btn btn-primary" onclick="tipo(4)" type="submit">Enviar a Gestión</button>
                        <button class="btn btn-default"  data-dismiss="modal" type="button">Cerrar</button>
                    </div>
                <?php } ?>               
                </form>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------------------------------------------------------------------------------------->

<div class="container">
    <div class="modal fade" id="myModalCambioColaborador" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title text-center">Antiguo colaborador</h4>
                </div>
                <form id="procesarCambioColab_form" name="" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="ProcesarSolicitud(this.id)">    
                <input type="hidden" name="accion" value="colab_procesar_solicitud_cambio">
                <input type="hidden" name="folio_proyecto" id="colab_folio_proyectoC">
                <input type="hidden" name="numero_solicitud" id="colab_numero_solicC">
                <input type="hidden" name="btn" id="btn_cambio_colab">
                <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>Apellido paterno</label>
                                <input class="form-control" id="ap_paterno" readonly="" type="text">                                            
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>Apellido materno</label>
                                <input class="form-control" id="ap_materno" readonly="" type="text">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>Nombre(s)</label>
                                <input class="form-control" id="nombre" readonly="" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>Grado máximo de estudios</label>
                                <input class="form-control" id="max_estudios" readonly="" type="text">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>
                                    Carrera
                                </label>
                                <select class="form-control" disabled id="carrera" name="al_carrera">
                                        <option>...</option>
                                        <?php
                                            $res = $miConn->cboCarrera();
                                            while($r = pg_fetch_array($res)){
                                                echo "<option value='".$r[0]."'>".$r[1]."</option>";       
                                            }
                                        ?>  
                                </select>  
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>No. de personal</label>
                                <input class="form-control" name="numero_p_anti" id="numero_p" readonly="" type="text">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>Móvil</label>
                                <input class="form-control" id="celu" pattern="^\d{10}$" readonly="" type="text">
                            </div>
                            <div class="col-sm-5 form-group">
                                <label>Correo institucional</label>
                                <input class="form-control" id="correo1" readonly="" type="email">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Motivos del cambio</label>
                                <input class="form-control" id="motivo_cambio" readonly  style="resize:none;" type="text">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Descripción de las principales actividades a desarrollar en el proyecto</label>
                            <textarea class="form-control" id="actividades_colab" readonly="" rows="4" style="resize:none;"></textarea>
                        </div>               
                <h4 style="text-align: center;">Nuevo colaborador</h4>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Apellido paterno</label>
                            <input class="form-control" id="cam_ap_paterno" readonly="" type="text">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Apellido materno</label>
                                <input class="form-control" id="cam_ap_materno" readonly="" type="text">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Nombre(s)</label>
                            <input class="form-control" id="cam_nombre" readonly="" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Grado máximo de estudios</label>
                            <input class="form-control" id="cam_max_estudios" readonly="" type="text">
                        </div>
                        <div class="col-md-4 form-group">
                                <label>
                                    Carrera
                                </label>
                                <select class="form-control" disabled id="cam_carrera" name="al_carrera">
                                        <option>...</option>
                                        <?php
                                            $res = $miConn->cboCarrera();
                                            while($r = pg_fetch_array($res)){
                                                echo "<option value='".$r[0]."'>".$r[1]."</option>";       
                                            }
                                        ?>  
                                </select>  
                            </div>
                        <div class="col-md-4 form-group">
                            <label>No. de personal</label>
                            <input class="form-control" name="numero_p_nuevo" id="cam_numero_p" readonly="" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Móvil</label>
                            <input class="form-control" id="cam_celu" pattern="^\d{10}$" readonly="" type="text">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Correo institucional</label>
                            <input class="form-control" id="cam_correo1" readonly="" type="email">
                        </div>
                        <!--<div class="col-md-4 form-group">
                            <label>Correo alternativo</label>
                            <input class="form-control" readonly="" type="email">
                        </div>-->
                    </div>
                        <!--<div class="col-md-12 form-group">
                            <label>Firma del responsable del proyecto</label>
                            <input class="form-control" readonly="" type="text">
                        </div>-->
                        <div class="form-group col-md-12">
                            <label>Descripción de las principales actividades a desarrollar en el proyecto</label>
                            <textarea class="form-control" name="cam_actividades_colab" id="cam_actividades_colab" readonly="" rows="4" style="resize:none;"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Observaciones de la Oficina de Seguimiento y Proyectos de Investigación</label>
                            <textarea class="form-control" id="obs2_cambio_colab" readonly rows="4" style="resize:none;"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Observaciones</label>
                            <textarea class="form-control" name="obs_cambio_colab" rows="4" style="resize:none;"></textarea>
                        </div>
                </div>
                <?php if($estado_CC != 13){ ?>                
                    <div class="modal-footer">
                        <button class="btn btn-primary" disabled onclick="tipo(4)" type="submit">Enviar a Gestión</button>
                        <button class="btn btn-default"  data-dismiss="modal" type="button">Cerrar</button>
                    </div>
                <?php }else{ ?>
                    <div class="modal-footer">
                        <button class="btn btn-primary" onclick="tipo(4)" type="submit">Enviar a Gestión</button>
                        <button class="btn btn-default"  data-dismiss="modal" type="button">Cerrar</button>
                    </div>
                <?php } ?>
            </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="modal fade" id="myModalCambioAlumno" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title" style="text-align: center;">Antiguo colaborador alumno</h4>
                </div>
                <form id="procesarCambioAlum_form" name="" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="ProcesarSolicitud(this.id)">    
                <input type="hidden" name="accion" value="al_procesar_solicitud_cambio">
                <input type="hidden" name="folio_proyecto" id="al_folio_proyectoC" >
                <input type="hidden" name="numero_solicitud" id="alum_numero_solicC">
                <input type="hidden" name="btn" id="btn_cambio_alum">
                <input type="hidden" name="al_servicio" id="al_servicioC">
                <input type="hidden" name="al_residencia" id="al_residenciaC">
                <input type="hidden" name="al_tesis" id="al_tesisC">
                <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>Apellido paterno</label>
                                <input class="form-control" id="al_ap_paterno" readonly="" type="text">                                            
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>Apellido materno</label>
                                <input class="form-control" id="al_ap_materno" readonly="" type="text">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>Nombre(s)</label>
                                <input class="form-control" id="al_nombre" readonly="" type="text">
                            </div>
                        </div>
                        <div class="row">
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
                            <div class="col-sm-3 form-group">
                                <label>No. de control</label>
                                <input class="form-control" id="al_control" name="al_control_anti" readonly="" type="text">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>Semestre</label>
                                <input type="text" class="form-control" id="al_semestreC_anti" readonly>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Motivos del cambio</label>
                                <input class="form-control" id="alum_motivo_cambio" name="alum_motivo_cambio" readonly  style="resize:none;" type="text">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Descripción de las principales actividades a desarrollar en el proyecto</label>
                            <textarea class="form-control" id="actividades_alum" readonly="" rows="4" style="resize:none;"></textarea>
                        </div>                
                <h4 style="text-align: center;">Nuevo colaborador alumno</h4>
                    <div class="row">                    
                    <div class="col-md-12 form-group">
                        <h5 style="margin-right: 20px;"><input type="checkbox" id="check_al_servicioC" name="al_servicio"><strong>Servicio Social</strong></h5>
                        <h5 style="margin-right: 20px;"><input type="checkbox" id="check_al_residenciaC" name=al_residencia"><strong>Residencia Profesionales</strong></h5>
                        <h5><input type="checkbox" id="check_al_tesisC" name="al_tesis"><strong>Tesis</strong></h5>
                    </div>  
                <div class="col-md-4 form-group">
                            <label>Apellido paterno</label>
                            <input class="form-control" id="al_ap_paterno_new" readonly="" type="text">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Apellido materno</label>
                                <input class="form-control" id="al_ap_materno_new" readonly="" type="text">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Nombre(s)</label>
                            <input class="form-control" id="al_nombre_new" readonly="" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                                <label>
                                    Carrera
                                </label>
                                <select class="form-control" disabled id="al_carrera_new" name="al_carrera">
                                        <option>...</option>
                                        <?php
                                            $res = $miConn->cboCarrera();
                                            while($r = pg_fetch_array($res)){
                                                echo "<option value='".$r[0]."'>".$r[1]."</option>";       
                                            }
                                        ?>  
                                </select>  
                            </div>
                        <div class="col-md-4 form-group">
                            <label>No. de control</label>
                            <input class="form-control" id="al_control_new" name="al_control_new" readonly="" type="text">
                        </div>
                        <div class="col-sm-4 form-group">
                                <label>Semestre</label>
                                <input type="text" class="form-control" name="al_semestreC_new" id="al_semestreC_new" readonly>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Descripción de las principales actividades a desarrollar en el proyecto</label>
                        <textarea class="form-control" id="cam_actividades_alum" name="cam_actividades_alum" readonly="" rows="4" style="resize:none;"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                            <label>Observaciones de la Oficina de Seguimiento y Proyectos de Investigación</label>
                            <textarea class="form-control" id="obs2_cambio_alum" readonly rows="4" style="resize:none;"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Observaciones</label>
                        <textarea class="form-control" name="obs_cambio_alum" rows="4" style="resize:none;"></textarea>
                    </div>
                </div>
                <?php if($estado_CA != 13){ ?>                
                    <div class="modal-footer">
                        <button class="btn btn-primary" disabled onclick="tipo(4)" type="submit">Enviar a Gestión</button>
                        <button class="btn btn-default"  data-dismiss="modal" type="button">Cerrar</button>
                    </div>
                <?php }else{ ?>
                    <div class="modal-footer">
                        <button class="btn btn-primary" onclick="tipo(4)" type="submit">Enviar a Gestión</button>
                        <button class="btn btn-default"  data-dismiss="modal" type="button">Cerrar</button>
                    </div>
                <?php } ?>
            </form>
            </div>
        </div>
    </div>
</div>