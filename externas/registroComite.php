<?php 
$miConn=new Consultas();
$proyectos=$miConn->getProyectos();
?>
<script src="../../js/registroComite.js"></script>
<div class="col-md-9" style="margin-top: 14px;">
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="text-center" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">Solicitud de Proyectos a Registrar</h1>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Folio del Proyecto</th>
                            <th>Nombre del Proyecto</th>
                            <th>Nombre del Asesor</th>
                            <th>Fecha</th>
                            <th>Revisión N°</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($proyectos as $row) 
                        {?>
                        <tr>
                            <td><?php echo $row['Numero'] ?></td>
                            <td><?php echo $row['FolioProyecto'] ?></td>
                            <td><?php echo $row['Proyecto'] ?></td>
                            <td><?php echo $row['Nombre'] ?></td>
                            <td><?php echo $row['FechaPresentacion'] ?></td>
                            <td><?php echo $row['NoRevision'] ?></td>
                            <td>
                                <input class="btn btn-primary" data-target="#myModal" data-toggle="modal" name="" type="button" value="Ver Solicitud" id="<?php echo $row['FolioProyecto'] ?>" onclick="consultarProyecto(this.id)" >
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog" style="display: none;">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                    <h4 class="modal-title" style="text-align: center;">
                        Reporte
                    </h4>
                    <div class="modal-body">
                        <div class="container" style="margin-top: 0;">
                            <div class="col-lg-12 " id="divFormularioRegistro" style="margin-top: 10px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>