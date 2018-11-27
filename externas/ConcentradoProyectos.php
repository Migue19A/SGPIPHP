<?php 
$miConn=new Consultas();
$proyectos=$miConn->getProyectosDocente(1);
?>
<script src="../../js/concentrado_proyectos.js" type="text/javascript">
</script>
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
<div class="container">
    <div class="modal fade" id="modalReact" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" type="button">
                    ×
                </button>
                <h4 class="modal-title" style="text-align: center;">
                </h4>
            </div>
            <div class="modal-body">
                <form action="" method="get">
                    <div class="form-group">
                        <label>
                            *Explique el motivo de su reactivación
                        </label>
                    </div>
                    <div class="">
                        <textarea class="form-control" rows="4" id="motivoReact"></textarea>
                    </div>
                    <div class="form-group">
                        <label>
                            No más de 256 caracteres
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="button">
                    Cancelar
                </button>
                <button class="btn btn-primary" id="btnEnviar" data-dismiss="modal" type="button">
                    Enviar
                </button>
            </div>
        </div>
    </div>
</div>
</div>
<div class="container">
    <div class="modal fade" id="modalShowProy" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                    <h4 align="center" class="modal-title">
                        Información del Proyecto
                    </h4>
                </div>
                <div class="modal-body">
                    <form action="" method="get">
                        <div class="row">
                            <h3 class="text-center" style="font-weight: bold;">
                                Proyecto
                            </h3>
                            <div class="col-sm-4 form-group">
                                <label>
                                    *Fecha de presentación
                                </label>
                                <input class="form-control" name="" required="" type="date">
                                </input>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>
                                    *Convocatoria CPR
                                </label>
                                <input class="form-control" name="" required="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label>
                                    *Tipo de investigación
                                </label>
                            </div>
                            <div class="col-sm-3">
                                <label>
                                    *Tipo de sector
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <input name="Aplicada" type="checkbox">
                                    <label>
                                        A. Investigación aplicada
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-2">
                                <input name="Aplicada" type="checkbox">
                                    <label>
                                        Publico
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-3">
                                <input name="Aplicada" type="checkbox">
                                    <label>
                                        Social
                                    </label>
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <input name="Aplicada" type="checkbox">
                                    <label>
                                        B. Desarrollo experimental
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-2">
                                <input name="Aplicada" type="checkbox">
                                    <label>
                                        Privado
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-3">
                                <input name="Aplicada" type="checkbox">
                                    <label>
                                        Productivo
                                    </label>
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <input name="Aplicada" type="checkbox">
                                    <label>
                                        C. Investigación básica
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-2">
                                <input name="Aplicada" type="checkbox">
                                    <label>
                                        Educativo
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-3">
                                <input name="Aplicada" type="checkbox">
                                    <label>
                                        Otro
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-9 form-group">
                                <label>
                                    *Especifique
                                </label>
                                <input class="form-control" name="" required="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-9">
                                <label>
                                    *Linea de investigación
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <input name="01" type="checkbox">
                                    <label>
                                        LIIADT-01 Computo en la nube
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-9">
                                <input name="02" type="checkbox">
                                    <label>
                                        LIIADT-02 Computo intensivo
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-9">
                                <input name="03" type="checkbox">
                                    <label>
                                        LIIADT-03 Sistemas inteligentes de automatización
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-9">
                                <input name="04" type="checkbox">
                                    <label>
                                        LIIADT-04 Desarrollo de tecnología e innovación
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-9">
                                <input name="05" type="checkbox">
                                    <label>
                                        LIIADT-05 Control y automatización
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-9">
                                <input name="06" type="checkbox">
                                    <label>
                                        LIIADT-06 Desarrollo e innovación en tecnologías de producción
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-9">
                                <input name="07" type="checkbox">
                                    <label>
                                        LIIADT-07 Desarrollo e innovación de productos biotecnológicos y tecnológicos
                                    </label>
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>
                                    *Nombre del proyecto
                                </label>
                                <input class="form-control" name="" required="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>
                                    Duración:
                                </label>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>
                                    *Inicio
                                </label>
                                <input class="form-control" name="" required="" type="date">
                                </input>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>
                                    *Fin
                                </label>
                                <input class="form-control" name="" required="" type="date">
                                </input>
                            </div>
                            <div class="col-sm-12" style="background:#000">
                            </div>
                        </div>
                        <!----------------------------------------------------------------------------------------------------------------------->
                        <div class="row">
                            <h3 class="text-center" style="font-weight: bold;">
                                Recepción
                            </h3>
                            <div class="col-sm-5 form-group">
                                <label>
                                    *Numero de recepción
                                </label>
                                <input class="form-control" type="text"/>
                            </div>
                            <div class="col-sm-5 form-group">
                                <label>
                                    *Fecha de recepción
                                </label>
                                <input class="form-control" type="date"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-12" style="text-align: left;">
                                <label>
                                    Recibió *Nombre(s)
                                </label>
                                <input class="form-control" type="text"/>
                            </div>
                        </div>
                        <div class="col-sm-12" style="background:#000">
                        </div>
                        <!------------------------------------------------------------------------------------------------------------>
                        <div class="row">
                            <h3 class="text-center" style="font-weight: bold;">
                                Responsable
                            </h3>
                            <div class="col-sm-4 form-group">
                                <label>
                                    *Apellido paterno
                                </label>
                                <input class="form-control" type="text"/>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>
                                    *Apellido materno
                                </label>
                                <input class="form-control" type="text"/>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>
                                    *Nombre(s)
                                </label>
                                <input class="form-control" type="text"/>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>
                                    *Grado máximo de estudios
                                </label>
                                <input class="form-control" style="width:100%;" type="text"/>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>
                                    *Academia a la que pertenece
                                </label>
                                <input class="form-control" type="text"/>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 form-group">
                                    <label>
                                        *No. Personal
                                    </label>
                                    <input class="form-control" type="text"/>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>
                                        *Móvil
                                    </label>
                                    <input class="form-control" type="text"/>
                                </div>
                                <div class="col-sm-3" form-group="">
                                    <label>
                                        *Correo
                                    </label>
                                    <input class="form-control" type="text"/>
                                </div>
                                <div class="col-sm-3" form-group="">
                                    <label>
                                        *Correo alternativo
                                    </label>
                                    <input class="form-control" type="text"/>
                                </div>
                            </div>
                            <div class="col-sm-12" form-group="">
                                <label>
                                    *Descripción de las principales actividades a desarrollar en el proyecto
                                </label>
                            </div>
                            <div class="col-sm-12" form-group="">
                                <input class="form-control" style="height: 150px;" tabindex="4" type="text">
                                </input>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>
                                    Palabras clave:
                                </label>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>
                                    (1)
                                </label>
                                <input class="form-control" name="" type="text"/>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>
                                    (2)
                                </label>
                                <input class="form-control" name="" type="text"/>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>
                                    (3)
                                </label>
                                <input class="form-control" name="" type="text"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="background:#000">
                            </div>
                        </div>
                        <!------------------------------------------------------------------------------------------------------------------------------->
                        <!-- colaboradores -->
                        <h3 class="text-center" style="font-weight: bold;">
                            Colaborador
                        </h3>
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>
                                    Apellido paterno
                                </label>
                                <input class="form-control" required="" type="text">
                                </input>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>
                                    Apellido materno
                                </label>
                                <input class="form-control" required="" type="text">
                                </input>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>
                                    Nombre(s)
                                </label>
                                <input class="form-control" required="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>
                                Grado máximo de estudios
                            </label>
                            <input class="form-control" required="" type="text">
                            </input>
                        </div>
                        <div class="col-sm-8 form-group">
                            <label>
                                Academia a la que pertenece
                            </label>
                            <input class="form-control" required="" type="text">
                            </input>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>
                                    No. Personal
                                </label>
                                <input class="form-control" required="" type="text">
                                </input>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>
                                    Móvil
                                </label>
                                <input class="form-control" pattern="^\d{10}$" required="" type="text">
                                </input>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>
                                    Correo
                                </label>
                                <input class="form-control" required="" type="email">
                                </input>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>
                                    Correo alternativo
                                </label>
                                <input class="form-control" required="" type="email">
                                </input>
                            </div>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>
                                *Descripción de las principales actividades a desarrollar en el proyecto
                            </label>
                            <textarea class="form-control" rows="7" style="width: 99%; resize: none;">
                            </textarea>
                        </div>
                        <!--------------------------------------------------------------------------------------------------------------------------->
                        <div class="row">
                            <div class="col-sm-12" style="background:#000">
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="text-center" style="font-weight: bold;">
                                Objetivos
                            </h3>
                            <div class="col-sm-12 form-group">
                                <label>
                                    *Indique el objetivo general(No más de 512 caracteres)
                                </label>
                                <textarea class="form-control" rows="6" style="resize: none;">
                                </textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>
                                    *Establezca los objetivos específicos, científicos y tecnológicos subyacentes en el proyecto(No más de 512 caracteres)
                                </label>
                            </div>
                            <div class="col-sm-12 form-group">
                                <textarea class="form-control" rows="6" style="resize: none;">
                                </textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>
                                    *Indique los resultados esperados en términos concretos(No más de 512 Caracteres)
                                </label>
                            </div>
                            <div class="col-sm-12 form-group">
                                <textarea class="form-control" rows="6" style="resize: none;">
                                </textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="background:#000">
                            </div>
                        </div>
                        <!-------------------------------------------------------------------------------------------------------------------------->
                        <div class="row">
                            <h3 class="text-center" style="font-weight: bold;">
                                Vinculación
                            </h3>
                            <div class="col-sm-3 form-group">
                                <label>
                                    *Existe convenio:
                                </label>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label>
                                    Si
                                </label>
                                <input name="" type="checkbox">
                                </input>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label>
                                    No
                                </label>
                                <input name="" type="checkbox">
                                </input>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>
                                    *Nombre de la organización
                                </label>
                                <input class="form-control" name="" type="text">
                                </input>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>
                                    *Dirección
                                </label>
                                <input class="form-control" name="" type="text">
                                </input>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>
                                    *Área
                                </label>
                                <input class="form-control" name="" type="text">
                                </input>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>
                                    *Teléfono
                                </label>
                                <input class="form-control" name="" type="text">
                                </input>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>
                                    *Nombre del contacto
                                </label>
                                <input class="form-control" name="" type="text">
                                </input>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>
                                    *Descripción de la organización(No más de 256 caracteres)
                                </label>
                                <textarea class="form-control" name="" rows="6" style="resize: none;">
                                </textarea>
                            </div>
                            <div class="col-sm-7 form-group">
                                <label>
                                    *Existen aportaciones financieras o en especie de la vinculación:
                                </label>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label>
                                    Si
                                </label>
                                <input name="" type="checkbox">
                                </input>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label>
                                    No
                                </label>
                                <input name="" type="checkbox">
                                </input>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>
                                    Si la respuesta es si, describa cuales son(No más de 256 caracteres)
                                </label>
                                <textarea class="form-control" name="" rows="6" style="resize: none;">
                                </textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="background:#000">
                            </div>
                        </div>
                        <!------------------------------------------------------------------------------------------------------------------------------------------------->
                        <div class="row">
                            <h3 class="text-center" style="font-weight: bold;">
                                Productos académicos
                            </h3>
                            <div class="col-sm-3 form-group">
                                <input class="form-group" name="" style="margin-left: 18px;" type="checkbox">
                                    <label>
                                        Servicio Social
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-3 form-group">
                                <input class="form-group" name="" style="margin-left: 18px;" type="checkbox">
                                    <label>
                                        Residencia profesional
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-3 form-group">
                                <input class="form-group" name="" style="margin-left: 18px;" type="checkbox">
                                    <label>
                                        Tesis
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-12 form-group">
                                <input class="form-group" name="" style="margin-left: 18px;" type="checkbox">
                                    <label>
                                        Ponencias/Conferencias
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-12 form-group">
                                <input class="form-group" name="" style="margin-left: 18px;" type="checkbox">
                                    <label>
                                        Artículos
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-12 form-group">
                                <input class="form-group" name="" style="margin-left: 18px;" type="checkbox">
                                    <label>
                                        Libros/Manuales
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-3 form-group">
                                <input class="form-group" name="" style="margin-left: 18px;" type="checkbox">
                                    <label>
                                        Propiedad Intelectual
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-1">
                                <label>
                                    Especificar:
                                </label>
                            </div>
                            <div class="col-sm-7 form-group">
                                <input class="form-control" name="" style="margin-left: 18px;" type="text">
                                </input>
                            </div>
                            <div class="col-sm-3 form-group">
                                <input class="form-group" name="" style="margin-left: 18px;" type="checkbox">
                                    <label>
                                        Otros
                                    </label>
                                </input>
                            </div>
                            <div class="col-sm-1">
                                <label>
                                    Especificar:
                                </label>
                            </div>
                            <div class="col-sm-7 form-group">
                                <input class="form-control" name="" style="margin-left: 18px;" type="text">
                                </input>
                            </div>
                        </div>
                        <!---------------------------------------------------------------------------------------------->
                        <div class="row">
                            <div class="col-sm-12" style="background:#000">
                            </div>
                        </div>
                        <h1 class="text-center" style="font-weight: Yu Gothic UI Light; margin-top: 2px">
                            Etapas
                        </h1>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>
                                    Nombre de la etapa:
                                </label>
                                <input class="form-control" name="" style="margin-left: 18px;" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>
                                    Fecha de inicio:
                                </label>
                                <input class="form-control" name="" type="date">
                                </input>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>
                                    Fecha de fin:
                                </label>
                                <input class="form-control" name="" type="date">
                                </input>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>
                                    Total de meses:
                                </label>
                                <input class="form-control" name="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>
                                    Descripción
                                </label>
                            </div>
                            <div class="col-sm-10">
                                <input class="form-control" name="" required="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>
                                    Metas
                                </label>
                            </div>
                            <div class="col-sm-10 form-group">
                                <textarea class="form-control" rows="6" style="resize: none;">
                                </textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>
                                    Actividades
                                </label>
                            </div>
                            <div class="col-sm-10 form-group">
                                <textarea class="form-control" rows="6" style="resize: none;">
                                </textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>
                                    Productos
                                </label>
                            </div>
                            <div class="col-sm-10 form-group">
                                <textarea class="form-control" rows="6" style="resize: none;">
                                </textarea>
                            </div>
                        </div>
                        <!-------------------------------------------------------------------------------------------------->
                        <div class="row">
                            <div class="col-sm-12" style="background:#000">
                            </div>
                        </div>
                        <h3 class="text-center" style="font-weight: bold; margin-bottom: 9px;">
                            Financiamiento Requerido
                        </h3>
                        <div class="row">
                            <div class="col-sm-5 form-group">
                                <label>
                                    *¿Existe actualmente algún financiamiento del proyecto?
                                </label>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label>
                                    Si
                                </label>
                                <input name="" type="checkbox">
                                </input>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label>
                                    No
                                </label>
                                <input name="" type="checkbox">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>
                                    En caso de que la respuesta sea sí
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>
                                    Interno
                                </label>
                                <input name="" type="checkbox">
                                </input>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label>
                                    Externo
                                </label>
                                <input name="" type="checkbox">
                                </input>
                            </div>
                            <div class="col-sm-1 form-group">
                                <label>
                                    Especificar:
                                </label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <input class="form-control" name="" style="margin-left: 18px;" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>
                                    En caso de que la respuesta sea no Desglose($)
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>
                                    Infraestructura:
                                </label>
                            </div>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" name="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>
                                    Consumibles:
                                </label>
                            </div>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" name="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>
                                    Licencias:
                                </label>
                            </div>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" name="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>
                                    Viáticos:
                                </label>
                            </div>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" name="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>
                                    Publicaciones:
                                </label>
                            </div>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" name="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>
                                    Equipo:
                                </label>
                            </div>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" name="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>
                                    Patentes/derechos de autor:
                                </label>
                            </div>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" name="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>
                                    Otros(Especifique):
                                </label>
                            </div>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" name="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>
                                    Total:
                                </label>
                            </div>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" name="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="background:#000">
                            </div>
                        </div>
                        <!---------------------------------------------------------------------------------------------------------------------------->
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>
                                    <b>
                                        *
                                    </b>
                                    S.S.= Servicio Social, R.P.= Residencia Profesional, T= Tesis
                                </h5>
                                <div class="row">
                                    <h3 class="text-center" style="font-weight: bold; margin-bottom: 9px;">
                                        Alumno Colaborador
                                    </h3>
                                    <div class="col-sm-6 form-group">
                                        <label>
                                            Nombre del Alumno:
                                        </label>
                                        <input class="form-control" name="" type="text">
                                        </input>
                                    </div>
                                    <div class="col-sm-2 form-group" style="margin-top: 30px;">
                                        <label>
                                            S.S.
                                        </label>
                                        <input class="form-group" name="" type="checkbox">
                                        </input>
                                    </div>
                                    <div class="col-sm-2 form-group" style="margin-top: 30px;">
                                        <label>
                                            R.P.
                                        </label>
                                        <input class="form-group" name="" type="checkbox">
                                        </input>
                                    </div>
                                    <div class="col-sm-2 form-group" style="margin-top: 30px;">
                                        <label>
                                            T
                                        </label>
                                        <input class="form-group" name="" type="checkbox">
                                        </input>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            N° Control
                                        </label>
                                        <input class="form-control" name="" type="text">
                                        </input>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Semestre
                                        </label>
                                        <input class="form-control" name="" type="text">
                                        </input>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Carrera
                                        </label>
                                        <input class="form-control" name="" type="text">
                                        </input>
                                    </div>
                                    <div class=" col-sm-12 form-group">
                                        <label>
                                            Detalle de Actividades
                                        </label>
                                        <textarea class="form-control" rows="6" style="resize: none;">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>-->
                    <button class="btn btn-primary" data-dismiss="modal" id="reactiva" type="button">
                        Aceptar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
