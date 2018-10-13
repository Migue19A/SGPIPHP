<?php 
$conn=new ClaseConsultas();
$entregables=$conn->getEntregables();
?>
<script src="../../js/revisionEntregableInvest.js"></script>
<div class="container" style="margin-top: 12px;">
    <div class="col-md-9">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 style="text-align: center;">Reportes de Seguimiento de Proyectos</h2>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Nombre<br>Proyecto</th>
                                        <th>Docente<br>Responsable</th>
                                        <th>Fecha<br>Inicio</th>
                                        <th>Fecha<br>Fin</th>
                                        <th>Fecha<br>Prórroga</th>
                                        <th>Etapa 1</th>
                                        <th>Etapa 2</th>
                                        <th>Etapa 3</th>
                                        <th>Etapa 4</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($entregables as $row) {
                                    $i=1; 
                                        ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $row['NombreProy'] ?></td>
                                        <td><?php echo $row['Docente'] ?></td>
                                        <td><?php echo $row['Inicio'] ?></td>
                                        <td><?php echo $row['Fin'] ?></td>
                                        <td></td>
                                        <td>
                                            <input class="btn btn-primary" data-target="#myModal" data-toggle="modal" name="" type="button" value="Ver Reporte" id="<?php echo $row['Entregable'] ?>" onclick="mostrarProyecto(this.id)" />
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                        <?php
                                    $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------------------------------------------------------------------------->
<div class="container">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" type="button">
                    ×
                </button>
                <h1 class="modal-title" style="text-align: center;">
                    Reporte
                </h1>
                <div class="modal-body" id="entregableForm">
                </div>
            </div>
        </div>
    </div>         
</div>