<?php 
$conn=new ClaseConsultas();
$docentes=$miConn->obtenerDocentes();
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
                                    <select class="form-control" onchange="obtenerColaborador_Cambio(this.value)">
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
                        <div class="modal-body">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Docente
                                        </label>
                                        <select class="form-control" data-live-search="true">
                                        <?php 
                                            foreach($docentes as $row){
                                                echo "<option value='".$row['NoPersonal']."'>".$row['Nombre']."</option>"; 
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Apellido paterno
                                        </label>
                                        <input class="form-control" required="" type="text">                                    
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Apellido materno
                                        </label>
                                        <input class="form-control" required="" type="text">
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Nombre(s)
                                        </label>
                                        <input class="form-control" required="" type="text">                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label for="sel1">
                                            Grado máximo de estudios:
                                        </label>
                                        <select class="form-control" id="sel1">
                                            <option>
                                                Licenciatura
                                            </option>
                                            <option>
                                                Maestría
                                            </option>
                                            <option>
                                                Doctorado
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-sm-8 form-group">
                                        <label>
                                            Academia a la que pertenece
                                        </label>
                                        <input class="form-control" required="" type="text">                                        
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            N°. personal
                                        </label>
                                        <input class="form-control" required="" type="text">
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Móvil
                                        </label>
                                        <input class="form-control" pattern="^\d{10}$" required="" type="text">
                                        
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label>
                                            Correo institucional
                                        </label>
                                        <input class="form-control" required="" type="email">
                                        
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label>
                                            Correo alternativo
                                        </label>
                                        <input class="form-control" required="" type="email">
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        *Descripción de las principales actividades a desarrollar en el proyecto
                                    </label>
                                    <textarea class="form-control" rows="4" style="resize:none;">
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label>
                                        *Observaciones
                                    </label>
                                    <textarea class="form-control" rows="4" style="resize:none;">
                                    </textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal" type="button">
                                Cerrar
                            <!--</button>
                            <button class="btn btn-primary pull-left" data-dismiss="modal" type="button">
                                Descargar formato de
                                <br>
                                    cambio de colaboradores
                                </br>
                            </button>-->
                            <button class="btn btn-primary" onclick="Cambios();" type="button">
                                Guardar
                            </button>
                        </div>
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
                        <div class="modal-body">
                            <div class="form-group">
                                <label>
                                    *¿Por qué quieres dar de baja al colaborador?
                                </label>
                                <textarea class="form-control" rows="4" style="resize:none;">
                                </textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal" type="button" style="float: left;">
                                Cerrar
                            </button>
                            <button class="btn btn-primary" onclick="CambiosGuardados();" type="button">
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Finaliza modal baja colaborador-->
        

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
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <select class="form-control" data-live-search="true">
                                            <option>
                                                Seleccione un alumno
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-7 form-group">
                                        <h5>                                    
                                            *S.S.= Servicio social, R.P.= Residencia profesional, T= Tesis
                                        </h5>
                                    </div>
                                </div>                                
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>
                                            Nombre del alumno
                                        </label>
                                        <input class="form-control" name="" type="text">
                                    </div>                                    
                                    <div class="col-md-6 form-group">
                                        <label>
                                            Seleccione
                                        </label>
                                        <select class="form-control">
                                            <option>R.P</option>
                                            <option>S.S</option>
                                            <option>T</option>
                                        </select>
                                    </div>
                                                                           
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label>
                                            No. control
                                        </label>
                                        <input class="form-control" name="" type="text">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>
                                            Semestre
                                        </label>
                                        <input class="form-control" name="" type="text">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>
                                            Carrera
                                        </label>
                                        <input class="form-control" name="" type="text">                                        
                                    </div>

                                    <div class=" col-sm-12 form-group">
                                        <label>
                                            Detalle de actividades
                                        </label>
                                        <textarea class="form-control" rows="3" style="resize:none;">
                                        </textarea>
                                    </div>
                                    <div class=" col-sm-12 form-group">
                                        <label>
                                            Observaciones
                                        </label>
                                        <textarea class="form-control" rows="3" style="resize:none;">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-default" data-dismiss="modal" type="button">
                                    Cerrar
                                </button>
                                <button class="btn btn-primary" onclick="CambiosGuardados();" type="button">
                                    Guardar
                                </button>
                            </div>
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
                            <div class="modal-body">
                        
                                  
                                        <div class="col-md-6 form-group">
                                            <select class="form-control" data-live-search="true">
                                                <option>
                                                    Seleccione un alumno
                                                </option>                                                
                                            </select>
                                        </div>
                                    <div class="col-md-6 form-group">
                                        <h5>                                    
                                            *S.S.= Servicio social, R.P.= Residencia profesional, T= Tesis
                                        </h5>
                                    </div>
                                  
                                
                                
                             
                                        <div class="col-md-6 form-group">
                                            <label>
                                                Nombre del alumno
                                            </label>
                                            <input class="form-control" name="" type="text">
                                        </div>
                                    
                                        <div class="col-md-6 form-group">
                                        <label>
                                            Seleccione
                                        </label>
                                        <select class="form-control">
                                            <option>R.P</option>
                                            <option>S.S</option>
                                            <option>T</option>
                                        </select>
                                        </div>                                    
                            
                       
                                    
                                        <div class="col-md-4 form-group">
                                            <label>
                                                No. control
                                            </label>
                                            <input class="form-control" name="" type="text">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>
                                                Semestre
                                            </label>
                                            <input class="form-control" name="" type="text">
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label>
                                                Carrera
                                            </label>
                                            <input class="form-control" name="" type="text">
                                        </div>
                                        <div class=" col-sm-12 form-group">
                                            <label>
                                                Detalle de actividades
                                            </label>
                                            <textarea class="form-control" rows="6" style="resize:none; width: 99%;">
                                            </textarea>
                                        </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-default" data-dismiss="modal" type="button">
                                        Cerrar
                                    </button>
                                    <button class="btn btn-primary" onclick="CambiosGuardados();" type="button">
                                        Guardar
                                    </button>
                                </div>
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
                                <div class="modal-body">
                                    <form action="" method="get">
                                        <div class="col-sm-12 form-group">
                                                <select class="form-control" data-live-search="true" onchange="obtenerDatosColaborador(this.value, this.id)" id ="1">
                                                            <option>Seleccione un Docente</option>
                                                            <?php 
                                                            foreach($docentes as $row){
                                                                echo "<option value='".$row['NoPersonal']."'>".$row['Nombre']." - ".$row['academia']." - No. CONTROL: ".$row['NoPersonal']."</option>"; 
                                                            }
                                                            ?>
                                                </select>
                                            </div>                                    
                           
                                            <div class="col-md-4 form-group">
                                                <label>
                                                    Apellido paterno
                                                </label>
                                                <input class="form-control" required="" type="text">
                                    
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label>
                                                    Apellido materno
                                                </label>
                                                <input class="form-control" required="" type="text">
                                        
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label>
                                                    Nombre(s)
                                                </label>
                                                <input class="form-control" required="" type="text">
                                                
                                            </div>
                                  
                                   
                                            <div class="col-md-4 form-group">
                                                <label for="sel1">
                                                    Grado máximo de estudios
                                                </label>
                                                <select class="form-control" id="sel1">
                                                    <option>
                                                        Licenciatura
                                                    </option>
                                                    <option>
                                                        Maestría
                                                    </option>
                                                    <option>
                                                        Doctorado
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <label>
                                                    Academia a la que pertenece
                                                </label>
                                                <select class="form-control" id="programaCol4">
                                                            <option>Ingenieria en sistemas computacionales</option>
                                                            <option>Ingenieria industrial</option>
                                                            <option>Ingenieria en industrias alimentarias</option>
                                                            <option>Ingenieria civil</option>
                                                            <option>Ingenieria electronica</option>
                                                            <option>Ingenieria electromecanica</option>
                                                            <option>Ingenieria bioquimica</option>
                                                            <option>Ingenieria en gestion empresarial</option>
                                                            <option>Ingeneiria mecatronica</option>
                                                            <option>Gastronomia</option>
                                                        </select>
                                                
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label>
                                                    No. de personal
                                                </label>
                                                <input class="form-control" required="" type="text">
                                        
                                            </div>
                                            <div class="col-sm-3 form-group">
                                                <label>
                                                    Móvil
                                                </label>
                                                <input class="form-control" pattern="^\d{10}$" required="" type="text">
                                                
                                            </div>
                                            <div class="col-sm-4 form-group">
                                                <label>
                                                    Correo
                                                </label>
                                                <input class="form-control" required="" type="email">
                                                
                                            </div>
                                        <div class="col-sm-3 form-group">
                                                <label>
                                                    Correo alternativo
                                                </label>
                                                <input class="form-control" required="" type="email">
                                                
                                            </div>
                                            <div class="col-sm-12 form-group">
                                                <label>
                                                    Firma del responsable del proyecto
                                                </label>
                                                <input class="form-control" required="" type="text">
                                                
                                            </div>
                                     
                                        <div class="form-group col-md-12">
                                            <label>
                                                *Descripción de las principales actividades a desarrollar en el proyecto
                                            </label>
                                            <textarea class="form-control" rows="6" style="resize:none; width: 99%;" >
                                            </textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-default" data-dismiss="modal" type="button">
                                        Cerrar
                                    </button>
                                    <button class="btn btn-primary" onclick="CambiosGuardados();" type="button">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>