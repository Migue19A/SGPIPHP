<?php 
$conn=new ClaseConsultas();
//$proyectosActivos = $miConn->obtenerProyectosDocente($_SESSION['NoPersonal']);
$proyectosActivos = $conn->obtenerProyectosDocente(2);
?>
<div class="container">
    <div class="col-md-9 col-md-offset-3" style="margin-top: -400px;">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 style="text-align: center;">
                        Historial de proyectos
                    </h2>                                
                </div>
                <div class="panel-body">
                    <div class="form-group col-md-12">                                    
                        <select class="form-control" onchange="obtenerDatosProyecto(this.value)" id="proyectos">
                            <option>Seleccione un proyecto</option>
                            <?php
                                while($r = pg_fetch_array($proyectosActivos)){
                                echo "<option value='".$r[0]."'>".$r[1]."</option>";       
                                }
                            ?>                                                              
                        </select> 
                    </div>
                <div id="proyectos_docente">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                    Folio
                                </th>
                                <th>
                                    Nombre proyecto
                                </th>
                                <th>
                                    Fecha registro
                                </th>
                                <th>
                                    Estado
                                </th>
                                <th>
                                    Etapa
                                </th>
                                <th>
                                    Colaboradores
                                </th>
                                <th>
                                    Alumnos
                                </th>
                                <th>
                                </th>
                                <tbody>
                                    <tr>
                                    	<td></td>                                            
                                        </td>
                                        <td id="tablaNormal">
                                            
                                        </td>
                                        <td id="tablaNormal">
                                            
                                        </td>
                                        <td id="tablaNormal">
                                            
                                        </td>
                                        <td id="tablaNormal">
                                            
                                        </td>
                                        <td id="tablaNormal">
                                            
                                        </td>
                                        <td id="tablaNormal">
                                            
                                        </td>
                                        <td>
                                        	
                                        </td>
                                        <td>
                                            <button class="btn btn-primary" data-target="#myModal" data-toggle="modal" type="button">
                                                Ver detalles
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </tr>
                        </thead>
                    </table>
                    <h2 style="text-align: center;">Historial personal</h2>
                    <div class="col-md-12" style="">
                        <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Proyectos activos</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>Proyectos cancelados</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>Retrasos de entregables</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>Prórrogas solicitadas</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>Cambios de colaboradores</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td> N° de bloqueos</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td>N° de sanciones</td>
                                <td>7</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
                <div class="container">
                    <div class="modal fade" id="myModal" role="dialog">
                        <!--<div class="modal-dialog modal-lg">-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal" type="button">
                                        ×
                                    </button>
                                    <h2 style="text-align: center;">
                                        Proyecto
                                    </h2>
                                </div>
                                <div class="modal-body">
                                    <div class="panel-group">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <form>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label class="col-form-label">
                                                                Proyecto
                                                            </label>
                                                            <input id="nombre_proy" class="form-control" type="text"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-5">
                                                            <label class="col-form-label">
                                                                Responsable inicial
                                                            </label>
                                                            <input id="responsable_proy" class="form-control" type="text"/>
                                                        </div>
                                                        <div class="hidden">
                                                            <label class="col-form-label">
                                                                Ultimo responsable
                                                            </label>
                                                            <input class="form-control" type="text"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-3">
                                                            <label class="col-form-label">
                                                                Fecha de pre-registro
                                                            </label>
                                                            <input id="fecha_pre"class="form-control" type="text"/>
                                                        </div>
                                                        <div class="hidden">
                                                            <label class="col-form-label">
                                                                Fecha de aceptación
                                                            </label>
                                                            <input class="form-control" type="text"/>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label class="col-form-label">
                                                                Carrera
                                                            </label>
                                                            <select class="form-control" disabled id="carrera_proy">
                                                                <option>...</option>
                                                                <?php
                                                                    $res = $miConn->cboCarrera();
                                                                    while($r = pg_fetch_array($res)){
                                                                        echo "<option value='".$r[0]."'>".$r[1]."</option>";       
                                                                    }
                                                                ?>  
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div id="colaboradores_etapas">
                                                        <h1 style="text-align: center;">
                                                            Colaboradores
                                                        </h1>
                                                        <div class="form-row">
                                                            <div class=" form-group col-md-12">
                                                                <table class="table table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                N°
                                                                            </th>
                                                                            <th>
                                                                                Nombre
                                                                            </th>
                                                                            <th>
                                                                                Carrera
                                                                            </th>
                                                                            <th>
                                                                                Semestre
                                                                            </th>
                                                                            <th>
                                                                                N° control
                                                                            </th>
                                                                            <th style="text-align: center;">
                                                                                Etapa de inicio
                                                                            </th>
                                                                            <th style="text-align: center;">
                                                                                Etapa de termino
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>                                                                                                                                                                        
                                                                        </tr>                                                                                
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <h1 style="text-align: center;">
                                                            Alumnos Colaboradores
                                                        </h1>
                                                        <div class="form-row">
                                                            <div class=" form-group col-md-12">
                                                                <table class="table table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                N°
                                                                            </th>
                                                                            <th>
                                                                                Nombre
                                                                            </th>
                                                                            <th>
                                                                                Carrera
                                                                            </th>
                                                                            <th>
                                                                                Semestre
                                                                            </th>
                                                                            <th>
                                                                                N° control
                                                                            </th>
                                                                            <th style="text-align: center;">
                                                                                Etapa de inicio
                                                                            </th>
                                                                            <th style="text-align: center;">
                                                                                Etapa de termino
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <h1 style="text-align: center;">
                                                            Etapas
                                                        </h1>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <table class="table ">
                                                                    <thead>
                                                                        <tr align="center">
                                                                            <th>N°</th>
                                                                            <th>Nombre del Proyecto</th>
                                                                            <th>Nombre del Docente</th>
                                                                            <th>Ultima revisión de</th>
                                                                            <th>Fecha de inicio</th>
                                                                            <th>Fecha de Fin</th>
                                                                            <th>Fecha de prórroga</th>
                                                                            <th>Etapa1</th>
                                                                            <th>Etapa2</th>
                                                                            <th>Etapa3</th>
                                                                            <th>Etapa4</th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label class="col-form-label">
                                                                Fecha de conclusión
                                                            </label>
                                                            <input class="form-control" id="fecha_fin" name="" required="" type="text"/>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label>
                                                                Fecha de cancelación
                                                            </label>
                                                            <input class="form-control" name="" required="" type="text"/>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label>
                                                                Motivos de cancelación
                                                            </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-default" data-dismiss="modal" type="button">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
</div>