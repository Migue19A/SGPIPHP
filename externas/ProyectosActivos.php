<?php 
$miConn=new Consultas();
$proyectos=$miConn->getProyectoActivosDocente($_SESSION['NoPersonal']);
// print_r($proyectos);
?>
<script src="../../js/proyectosActivos.js" type="text/javascript">
</script>
<div class="container" style="margin-top: 15px;">
        <div class="col-md-9">
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">Reportes de seguimiento de proyectos</h2>
                    </div>
                    <div class="panel-body">
                            <select class="form-control" id="cboProyectos" onchange="getDatosProyecto(this.value)">
                                <option selected hidden value="0">Seleccione un proyecto</option>
                                <?php foreach ($proyectos as $proyecto) {
                                    ?>
                                    <option value="<?php echo $proyecto['Folio']?>">
                                        <?php echo $proyecto['Nombre'] ?>
                                    </option>
                                    <?php
                                } ?>
                            </select>
                        <div class="container">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Etapa</th>
                                            <th>Nombre de la etapa</th>
                                            <th>Fecha inicio</th>
                                            <th>Fecha fin</th>
                                            <th>Fecha de prorroga</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyProyectosActivos">
                                        <!-- <tr>
                                            <td><input type="checkbox" class="form-group" value=""></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><a class="btn btn-success" href="seguimiento.pdf" target="_blank">Imprimir</a></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="form-group" value=""></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><button class="btn btn-warning">Corregir</button></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="form-group" value=""></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><a class="btn btn-info" href="Formato.html">Realizar entrega</a></td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button class="btn btn-danger" onclick="CancelarProyecto()">Cancelar Proyecto</button>
                        <a class="btn btn-primary" href="constanciaDeInicio.pdf" target="_blank">Constancia de inicio</a>
                        <a class="btn btn-primary" disabled="" href="constanciaDeFinalizacion.pdf" target="_blank">Constancia de Finalización</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="container" style="margin-top: 12px;">
    <div class="col-md-9">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="text-center" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
                        Consulta de Proyectos
                    </h2>
                </div>
                <div class="panel-body">
                    <div class="form-group col-md-6">
                        <select class="form-control">
                            <option>
                                Proyectos propios
                            </option>
                            <option>
                                Proyectos ajenos
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <select class="form-control">
                            <option>
                                Tipo de proyectos
                            </option>
                            <option>
                                Aceptados
                            </option>
                            <option>
                                Cancelados o reactivables
                            </option>
                            <option>
                                No aptos
                            </option>
                            <option>
                                En espera
                            </option>
                            <option>
                                Activos
                            </option>
                            <option>
                                Inactivos
                            </option>
                        </select>
                    </div>
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>
                                    <label>
                                        N°
                                    </label>
                                </th>
                                <th>
                                    <label>
                                        Folio
                                    </label>
                                </th>
                                <th>
                                    <label>
                                        Nombre del Proyecto
                                    </label>
                                </th>
                                <th>
                                    <label>
                                        Fecha de inicio
                                    </label>
                                </th>
                                <th>
                                    <label>
                                        Fecha de cancelación
                                    </label>
                                </th>
                                <th>
                                    <label>
                                        Estado
                                    </label>
                                </th>
                                <th>
                                    <label>
                                        Etapa
                                    </label>
                                </th>
                                <th>
                                    <label>
                                        Información del proyecto
                                    </label>
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0; 
                            foreach ($proyectos as $proyecto) 
                            {
                                $i++;
                            ?>
                            <tr>
                                <th>
                                    <label>
                                        <?php echo $i ?>
                                    </label>
                                </th>
                                <th>
                                    <label>
                                        <?php echo $proyecto['Folio'] ?>
                                    </label>
                                </th>
                                <th>
                                    <label>
                                        <?php echo $proyecto['Nombre'] ?>
                                    </label>
                                </th>
                                <th>
                                    <label>
                                        <?php echo $proyecto['FechaInicio'] ?>
                                    </label>
                                </th>
                                <th>
                                    <label>
                                        ---
                                    </label>
                                </th>
                                <th>
                                    <label>
                                        <?php echo $proyecto['Estado'] ?>
                                    </label>
                                </th>
                                <th>
                                    <label>
                                        <?php echo $proyecto['Etapas'] ?>
                                    </label>
                                </th>
                                <th>
                                    <label>
                                        <button class="btn btn-primary" onclick="reactivar('<?php echo $proyecto['Folio'] ?>')">
                                        Solicitar reactivacion
                                    </button>
                                    </label>
                                </th>
                                <th>
                                </th>
                            </tr>
                            <?php 
                            }
                            ?>
                            <div class="container">
                                <div class="modal fade" id="modalCancel" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <label>
                                                    Motivos de cancelacion
                                                </label>
                                            </div>
                                            <div class="modal-body">
                                                <textarea class="form-control" rows="7" style="resize: none;">
                                                </textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-default" data-dismiss="modal">
                                                    Aceptar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
