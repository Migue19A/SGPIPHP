<?php 
include('../../externas/Clases/consultas_reactivacion.php');
$miConn=new ConsultasReact();
$proyectos=$miConn->getProyectosXEstado(7);
?>
<script src="../../js/reactivacionGest.js">
</script>
<div class="container" style="margin-top: 14px;">
    <div class="col-md-9">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center">
                        Solicitudes de re activación de proyectos
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table table-condensed">
                        <thead>
                            <tr align="center">
                                <th>
                                    N°.
                                </th>
                                <th>
                                    Nombre del proyecto
                                </th>
                                <th>
                                    Nombre del docente
                                </th>
                                <th>
                                    Folio
                                </th>
                                <th>
                                    Fecha de cancelación
                                </th>
                                <th>
                                    Carrera
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
                            <tr align="center">
                                <td>
                                    <label>
                                        <?php echo $i ?>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <?php echo $proyecto['Nombre'] ?>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <?php echo $proyecto['NombreDoc'] ?>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <?php echo $proyecto['Folio'] ?>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        ---
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <?php echo $proyecto['Carrera'] ?>
                                    </label>
                                </td>
                                <td>
                                    <input class="btn btn-primary" data-target="#myModal" data-toggle="modal" name="" type="button" onclick="verSolicitud('<?php echo $proyecto['Folio'] ?>')" value="Ver solicitud"/>
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
    </div>
</div>
<div class="container">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                    <h4 class="modal-title" style="text-align: center;">
                        Solicitud de Reactivación
                    </h4>
                </div>
                <div class="modal-body">
                    <form action="" method="get">
                        <div class="container">
                            <div class="col-lg-12">
                                <div class="col-lg-8 well">
                                    <div id="modalForm">
                                        <h1 class="text-center" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
                                            Información del proyecto
                                        </h1>
                                        <div id="infoSolicitud">
                                            <div class="row">
                                                <div class="col-sm-4 form-group">
                                                    <label>
                                                        Proyecto
                                                    </label>
                                                    <input class="form-control" name="" type="text">
                                                    </input>
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <label>
                                                        Fecha de cancelación
                                                    </label>
                                                    <input class="form-control" name="" type="text">
                                                    </input>
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <label>
                                                        Fecha de solicitud
                                                    </label>
                                                    <input class="form-control" name="" type="text">
                                                    </input>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>
                                                    Motivos de cancelación
                                                </label>
                                                <textarea class="form-control" rows="4">
                                                </textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>
                                                    Motivos de re-activación
                                                </label>
                                                <textarea class="form-control" rows="4">
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h1 class="text-center" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
                                                Información del docente responsable
                                            </h1>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>
                                                    Selecciona un docente
                                                </label>
                                                <select class="form-control">
                                                    <option>
                                                        Docente
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 form-group">
                                                <label>
                                                    Apellido paterno
                                                </label>
                                                <input class="form-control" name="" type="text">
                                                </input>
                                            </div>
                                            <div class="col-sm-4 form-group">
                                                <label>
                                                    Apellido materno
                                                </label>
                                                <input class="form-control" name="" type="text">
                                                </input>
                                            </div>
                                            <div class="col-sm-4 form-group">
                                                <label>
                                                    Nombre(s)
                                                </label>
                                                <input class="form-control" name="" type="text">
                                                </input>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 form-group">
                                                <label>
                                                    N° Personal
                                                </label>
                                                <input class="form-control" name="" type="text">
                                                </input>
                                            </div>
                                            <div class="col-sm-3 form-group">
                                                <label>
                                                    Carrera
                                                </label>
                                                <input class="form-control" name="" type="text">
                                                </input>
                                            </div>
                                            <div class="col-sm-3 form-group">
                                                <label>
                                                    Móvil
                                                </label>
                                                <input class="form-control" name="" type="text">
                                                </input>
                                            </div>
                                            <div class="col-sm-3 form-group">
                                                <label>
                                                    Correo
                                                </label>
                                                <input class="form-control" name="" type="text">
                                                </input>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h4 style="text-align: center;">
                                                Historial del docente
                                            </h4>
                                            <table class="table" style="float: center;">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                        </th>
                                                        <th>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            Proyectos activos
                                                        </td>
                                                        <td>
                                                            0
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Proyectos cancelados
                                                        </td>
                                                        <td>
                                                            0
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Retrasos de entregables
                                                        </td>
                                                        <td>
                                                            0
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Prórrogas solicitadas
                                                        </td>
                                                        <td>
                                                            0
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Cambios de colaboradores
                                                        </td>
                                                        <td>
                                                            0
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            N° de bloqueos
                                                        </td>
                                                        <td>
                                                            0
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            N° de sanciones
                                                        </td>
                                                        <td>
                                                            0
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 form-group">
                                                <label>
                                                    Colaborador 1
                                                </label>
                                                <br>
                                                    <label>
                                                        Anterior:
                                                    </label>
                                                    <select class="form-control">
                                                        <option>
                                                            Colaborador
                                                        </option>
                                                    </select>
                                                </br>
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label>
                                                    Colaborador 2
                                                </label>
                                                <br>
                                                    <label>
                                                        Anterior:
                                                    </label>
                                                    <select class="form-control">
                                                        <option>
                                                            Colaborador
                                                        </option>
                                                    </select>
                                                </br>
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label>
                                                    Colaborador 3
                                                </label>
                                                <br>
                                                    <label>
                                                        Anterior:
                                                    </label>
                                                    <select class="form-control">
                                                        <option>
                                                            Colaborador
                                                        </option>
                                                    </select>
                                                </br>
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label>
                                                    Colaborador 4
                                                </label>
                                                <br>
                                                    <label>
                                                        Anterior:
                                                    </label>
                                                    <select class="form-control">
                                                        <option>
                                                            Colaborador
                                                        </option>
                                                    </select>
                                                </br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4" role="complementary">
                                    <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix col-lg-3">
                                        <ul class="nav bs-docs-sidenav">
                                            <div class="container" id="navObserv">
                                                <div class="panel panel-primary panel-default">
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
                                                            <!-- <a class="accordion col-lg-4" href="#inicioP" style="color: #337ab7"> -->
                                                                Proyecto
                                                            <!-- </a> -->
                                                            <div class="panelObs">
                                                                <textarea class="form-control" name="observaciones" id="observaciones" rows="5" style="resize:none"></textarea>
                                                            </div>
                                                        </li>
                                                    </div>
                                                </div>
                                                <li class="">
                                                    <a href="#" onclick="aceptar()" type="button">
                                                        Enviar revisión a Subdirección de Investigación y Posgrado
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="#" onclick="rechazar()" type="button">
                                                        Enviar a docente responsable
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a data-dismiss="modal" href="#" type="button">
                                                        Cancelar
                                                    </a>
                                                </li>
                                            </div>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
