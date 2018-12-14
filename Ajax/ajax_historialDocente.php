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
        case 'consultarProyectosDocente':
            $folio = $_GET['folioProy'];
            //$datosProy = $conex -> obtenerHistorialProyecto($folio, $_SESSION['NoPersonal']);
            $datosProy = $conex -> obtenerHistorialProyecto($folio, 1);
            ?>
            <table class="table table-condensed">
                        <thead>
                            <tr>
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
                                    Estado actual
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
                                    <?php 
                                    $activos = 0;
                                    $cancelados = 0;
                                    while ($res = pg_fetch_array($datosProy)) {
                                        $activos = $res['activos'];
                                        $cancelados = $res['cancelados'];
                                        $retrasos = $res['retrasos'];
                                        $prorrogas = $res['prorrogas'];
                                        $colaboradores = $res['colaboradores'];
                                        $bloqueos = $res['bloqueos'];
                                        $sanciones = $res['sanciones'];
                                    ?>
                                        <tr>
                                            <td><?php echo $res['folio'] ?></td>                             
                                            <td><?php echo $res['nombreproy'] ?></td>
                                            <td><?php echo $res['fecha_pre'] ?></td>
                                            <td><?php echo $res['estado'] ?></td>
                                            <td><?php echo $res['etapa_act'] ?></td>
                                            <td><?php echo $res['num_colab'] ?></td>
                                            <td><?php echo $res['num_alum'] ?></td>
                                            <td>
                                                <button class="btn btn-primary" data-target="#myModal" data-toggle="modal" onclick="cargarDatosHistorial(this.id, '<?php echo $res['nombreproy'] ?>', '<?php echo $res['nombre_completo'] ?>', '<?php echo $res['fecha_pre'] ?>', <?php echo $res['carrera'] ?>, '<?php echo $res['fecha_fin'] ?>')" type="button" id="<?php echo $res['folio'] ?>">
                                                    Ver detalles
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
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
                                <td><?php echo $activos ?></td>
                            </tr>
                            <tr>
                                <td>Proyectos cancelados</td>
                                <td><?php echo $cancelados ?></td>
                            </tr>
                            <tr>
                                <td>Retrasos de entregables</td>
                                <td><?php echo $retrasos ?></td>
                            </tr>
                            <tr>
                                <td>Prórrogas solicitadas</td>
                                <td><?php echo $prorrogas ?></td>
                            </tr>
                            <tr>
                                <td>Cambios de colaboradores</td>
                                <td><?php echo $colaboradores ?></td>
                            </tr>
                            <tr>
                                <td> N° de bloqueos</td>
                                <td><?php echo $bloqueos ?></td>
                            </tr>
                            <tr>
                                <td>N° de sanciones</td>
                                <td><?php echo $sanciones ?></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <?php

        break; 


        case 'consultarColaboradoresEtapasProyecto':
            $folio = $_GET['folioProy'];
            //echo "Folio: ".$folio;
            //$datosProy = $conex -> obtenerColaboradoresEtapasProyecto($folio);
            ?>
            
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
                                    N° personal
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
                                <td>2</td>
                                <td></td>
                                <td></td>
                                <td></td>                                
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
            <?php 
        break;   
        default:
            # code...
        break;
    }
?>