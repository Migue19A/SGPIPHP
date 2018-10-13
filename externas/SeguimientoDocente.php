<?php 
$proyecto=$_GET['proyecto'];
$entregable=$_GET['entregable'];
$conn=new ClaseConsultas();
$docentes=$conn->consultaDocentes();
$alumnosCol=$conn->getAlumnosCol($proyecto);
?>
<script src="../../js/SeguimientoDocente.js"></script>
<input type="hidden" id="folioProyecto" name="folioProyecto" value="<?php echo $proyecto ?>">
<input type="hidden" id="entregable" name="entregable" value="<?php echo $entregable ?>">
<div class="container" style="margin-top: 14px;">
    <div class="col-md-9">
        <div class="panel-group">
            <div class=" panel panel-default">
                <div class="panel-heading">
                    <nav class="navbar navbar-inverse">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="ConsultaEntregables.html">Seguimiento de proyecto</a>
                            </div>
                            <ul class="nav navbar-nav" id="myNav">
                              <li id="navStep1" class="li-nav active" step="#step-1"><a href="#"><span class="glyphicon glyphicon-arrow-right"></span><span class="sec-text">IG1</span></a></li>
                              <li id="navStep2" class="li-nav disabled" step="#step-2"><a href="#" title="Informe general 2"><span class="glyphicon glyphicon-arrow-right"></span><span class="sec-text">IG2</span></a></li>
                              <li id="navStep3" class="li-nav disabled"  step="#step-3"><a href="#"><span class="glyphicon glyphicon-arrow-right"></span><span class="sec-text">IG3</span></a></li>
                              <li id="navStep4" class="li-nav disabled" step="#step-4"><a href="#"><span class="glyphicon glyphicon-arrow-right"></span><span class="sec-text">IG4</span></a></li>
                              <li id="navStep5" class="li-nav disabled" step="#step-5"><a href="#"><span class="glyphicon glyphicon-arrow-right"></span><span class="sec-text">ID1</span></a></li>
                              <li id="navStep6" class="li-nav disabled" step="#step-6"><a href="#"><span class="glyphicon glyphicon-arrow-right"></span><span class="sec-text">ID2</span></a></li>
                              <li id="navStep7" class="li-nav disabled" step="#step-7"><a href="#"><span class="glyphicon glyphicon-arrow-right"></span><span class="sec-text">ID3</span></a></li>
                              <li id="navStep8" class="li-nav disabled" step="#step-8"><a href="#"><span class="glyphicon glyphicon-arrow-right"></span><span class="sec-text">ID4</span></a></li>
                              <li id="navStep9" class="li-nav disabled" step="#step-9"><a href="#"><span class="glyphicon glyphicon-arrow-right"></span><span class="sec-text">ID5</span></a></li>
                              <li id="navStep10" class="li-nav disabled" step="#step-10"><a href="#"><span class="glyphicon glyphicon-arrow-right"></span><span class="sec-text">RE1</span></a></li>
                              <li id="navStep11" class="li-nav disabled" step="#step-11"><a href="#"><span class="glyphicon glyphicon-arrow-right"></span><span class="sec-text">RE2</span></a></li>
                            </ul>
                        </div>
                    </nav>
                </div>                                
                <div class="panel-body"> 
                    <form class="container" id="formInformeGen1">
                        <input type="hidden" value="updateInformeGen1" id="updateInformeGen1" name="accion">
                        <div class="row setup-content" id="step-1">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <h1 style="text-align: center; margin-top: -30px;">I. Informe general</h1>
                                    <div class="container col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>Fecha de entrega:</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="date" id="fechaEntrega" name="fechaEntrega" value="<?php echo date('Y-m-d') ?>">
                                            </div>
                                        </div>
                                        <div class="row">                                            
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <h4>A) Indique las personas que están participando en los trabajos del proyecto:</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Clave</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nombre completo</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Participación</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label name="clave_1"></label>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" id="docentesColaborando_" name="docentesColaborando_">
                                                    <option value="0" selected hidden>
                                                        Seleccionar Docentes
                                                    </option>
                                            <?php foreach ($docentes as $docente) {
                                                ?>
                                                <option value="<?php echo $docente['NoPersonal'] ?>">
                                                    <?php echo $docente['Nombre'] ?>
                                                </option>
                                                <?php
                                            } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <select class="form-control" name="paqrtDocente_">
                                                    <option id="participacion_1"></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <input onclick="step1Next('formInformeGen1')" class="btn btn-primary" value="Siguiente" style="float: right;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!------------------------------------------------------------------------------------->
                    <form class="container" id="formInformeGen2">
                        <input type="hidden" value="updateInformeGen2" id="updateInformeGen2" name="accion">
                        <input type="hidden" id="numeroActividades" name="numeroActividades" value="1">
                        <div class="row setup-content" id="step-2">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <h1 style="text-align: center; margin-top: -30px;">II. Informe general</h1>
                                    <div class="form-group col-md-12">
                                        <h4>B) Describa de manera general las actividades que se están desarrollando con relación al proyecto:</h4>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="col-lg-1">
                                            <button type="button" id="nuevaActividad" class="form-control btn btn-default" onclick="NuevaActividad(1)">+</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-1">
                                            <label>N°</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Descripcion de la actividad</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label style="text-align: center;">Alcance</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Observaciones</label>
                                        </div>
                                    </div>
                                    <div id="actividades">
                                        <div id="actividad_">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-1">
                                                        <label id="labelNumAct_"></label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <textarea class="form-control" id="descripcionAct_" name="descripcionAct_" rows="5" style="resize: none;"></textarea>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <h5><input type="radio" id="alcanceEntrega_" name="alcanceEntrega_" value="Terminada"> Terminada</h5>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <h5><input type="radio" id="alcanceEntrega_" name="alcanceEntrega_" style="margin-left: -50px;" value="En Proceso"> En proceso</h5>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <textarea class="form-control" rows="5" style="resize: none;" id="obsActividades_" name="obsActividades_" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input onclick="prevStep('formInformeGen2')" class="btn btn-default" value="Regresar">
                                        <input onclick="step2Next('formInformeGen2')" class="btn btn-primary" value="Siguiente" style="float: right; margin-left: 12px;">
                                        <input class="btn btn-primary" value="Subir evidencias" style="float: right;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!------------------------------------------------------------------------------------->
                    <form class="container" id="formInformeGen3">
                        <input type="hidden" value="updateInformeGen3" id="updateInformeGen3" name="accion">
                        <input type="hidden" id="numeroObjetivos" name="numeroActividades" value="1">
                        <div class="row setup-content" id="step-3">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <h1 class="text-center" style="margin-top: -30px;">III. Informe general</h1>
                                    <div class="form-group col-md-12">
                                        <h4>C) Describa de manera general los objetivos alcanzados al momento, indicando si sufrieron modificaciones con relación al planteamiento inicial</h4>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="col-lg-1">
                                            <button type="button" class="form-control btn col-lg-3 btn-default" id="nuevoObjetivo" onclick="NuevoObjetivoAlcanzado(1)">+</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-1">
                                            <label>N°</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Objetivo</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Alcance</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Observaciones</label>
                                        </div>
                                    </div>
                                    <div id="objetivos">
                                        <div id="objetivo_">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-1">
                                                        <label id="labelNumObj_"></label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <textarea class="form-control" rows="5" id="objInforme_" name="objInforme_" style="resize: none;"></textarea>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <h5><input type="radio" name="alcanceInforme_" id="alcanceInforme_" value="Alcanzado" checked>Alcanzado</h5>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <h5><input type="radio" name="alcanceInforme_" id="alcanceInforme_" style="margin-left: -50px;" value="Cambiado">Cambiado</h5>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <textarea class="form-control" rows="5" id="obsInforme3" name="obsInforme_" style="resize: none;"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                  
                                    <div class="row">
                                        <input onclick="prevStep('formInformeGen3')" class="btn btn-default" value="Regresar">
                                        <input onclick="step3Next('formInformeGen3')" class="btn btn-primary" value="Siguiente" style="float: right;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!------------------------------------------------------------------------------------->
                    <form class="container" id="formInformeGen4">
                        <input type="hidden" value="updateInformeGen4" id="updateInformeGen4" name="accion">
                        <input type="hidden" id="numeroMetas" name="numeroMetas" value="1">
                        <div class="row setup-content" id="step-4">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <h1 class="text-center" style="margin-top: -30px;"> IV. Informe general</h1>
                                    <div class="form-group col-md-12">
                                        <h4>D) Describa de manera general las metas “y/o” productos alcanzados por el momento.</h4>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="col-lg-1">
                                            <button type="button" class="form-control btn col-lg-3 btn-default" id="nuevaMeta" onclick="NuevaMeta(1)">+</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-1">
                                            <label>N°</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Objetivo</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Alcance</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Observaciones</label>
                                        </div>
                                    </div>
                                    <div id="metas">
                                        <div id="meta_">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-1">
                                                        <label id="labelNumMetas_"></label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <textarea class="form-control" rows="5" style="resize: none;" id="metasObj_" name="metasObj_" ></textarea>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <h5><input type="radio" id="metasAlcance_" name="metasAlcance_" value="Alcanzado" checked="" >Alcanzado</h5>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <h5><input type="radio" id="metasAlcance_" name="metasAlcance_"  style="margin-left: -50px;" value="Cambiado">Cambiado</h5>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <textarea class="form-control" rows="5" style="resize: none;" id="obsMetas_" name="obsMetas_" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>             
                                    <div class="row">
                                        <input onclick="prevStep('formInformeGen4')" class="btn btn-default" value="Regresar">
                                        <input onclick="step4Next('formInformeGen4')" class="btn btn-primary" value="Siguiente" style="float: right;">
                                    </div>                                                        
                                </div>
                            </div>
                        </div>
                    </form>
                    <!------------------------------------------------------------------------------------->
                    <form class="container" id="formInforme1">
                        <input type="hidden" value="updateInformeDet1" id="updateObservacionesResumen3" name="accion">
                        <div class="row setup-content" id="step-5">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <h1 class="text-center" style="margin-top: -30px;"> I. Informe detallado</h1>
                                    <div class="form.group col-md-12">
                                        <h4>A) Describa de manera general los resultados obtenidos hasta el momento (anexe tablas, gráficas, memorias de cálculo y lo que considere pertinente para apoyar sus resultados)</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <textarea class="form-control" rows="12" style="margin-left: 40px; resize: none;" id="resultInfoDet1" name="resultInfoDet1" ></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input onclick="prevStep('formInforme1')" class="btn btn-default" value="Regresar">
                                        <input onclick="step5Next('formInforme1')" class="btn btn-primary" value="Siguiente" style="float: right; margin-left: 12px;">
                                        <input class="btn btn-primary" value="Subir evidencias" style="float: right;">
                                    </div>                                                           
                                </div>
                            </div>
                        </div>
                    </form>
                    <!------------------------------------------------------------------------------------->
                    <form class="container" id="formInforme2">
                        <input type="hidden" value="updateInformeDet2" id="updateObservacionesResumen3" name="accion">
                        <div class="row setup-content" id="step-6">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <h1 class="text-center" style="margin-top: -30px;">II. Informe detallado</h1>
                                    <div class="form.group col-md-12">
                                        <h4>B) Logros de conocimiento</h4>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-10">
                                            <h4 style="float: right;">¿Es patentable?</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-8">
                                                <label><input type="checkbox" name="avanceInfDet2" value="true" > Avances en el conocimiento científico</label>
                                            </div>
                                            <div class="col-md-2" style="margin-right: -100px;">
                                                <label><input type="radio" name="avancePatInforme2" value="true" >Si</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label><input type="radio" name="avancePatInforme2" value="false" checked>No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-8">
                                                <label><input type="checkbox" name="desInfDet2" value="true" > Desarrollo de tecnología (innovación, adaptación, asimilación)</label>
                                            </div>
                                            <div class="col-md-2" style="margin-right: -100px;">
                                                <label><input type="radio" name="desTecInfDet2" value="true"  >Si</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label><input type="radio" name="desTecInfDet2" value="false" checked>No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <div class="form-group">
                                            <div class="col-md-8" >
                                                <label><input type="checkbox" name="creaInfraInfDet2" value="true" >Creación de infraestructura tecnológica (maquinaria, herramienta y/o equipo para la docencia e investigación)</label>
                                            </div>
                                            <div class="col-md-2" style="margin-right: -100px;">
                                                <label><input type="radio" name="creaInfraesInfDet2" value="true" >Si</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label><input type="radio" name="creaInfraesInfDet2" value="false" checked>No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input onclick="prevStep('formInforme2')" class="btn btn-default" value="Regresar">
                                        <input onclick="step6Next('formInforme2')" class="btn btn-primary" value="Siguiente" style="float: right; margin-left: 12px;">
                                        <input class="btn btn-primary" value="Subir evidencias" style="float: right;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!------------------------------------------------------------------------------------->
                    <form class="container" id="formInforme3">
                        <input type="hidden" value="updateInformeDet3" id="updateObservacionesResumen3" name="accion">
                        <div class="row setup-content" id="step-7">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <h1 class="text-center" style="margin-top: -30px;">III. Informe detallado</h1>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <h4>C) Logros en formación de recursos humanos (anexe copia de la carta de examen de grado y/o carta de liberación de residencia o servicio social, si el titulante no ha terminado la tesis puede anexar la carta de aceptación del tema)</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>N° control</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Nombre del alumno</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Nombre del trabajo</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Categoria</label>
                                        </div>
                                    </div>
                                    <?php foreach ($alumnosCol as $alumno) {
                                        ?>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <input type="text" class="form-control"name="alumnoNoControl_<?php echo $alumno['Numero']?>" value="<?php echo $alumno['NoControl']?>" disabled>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input type="text" class="form-control" name="alumnoNombre_<?php echo $alumno['NoControl']?>" id="alumnoNombre_<?php echo $alumno['Numero']?>" value="<?php echo $alumno['Nombre']?>" disabled>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input type="text" class="form-control" name="alumnoNombreTrabajo_<?php echo $alumno['NoControl']?>" id="alumnoNombreTrabajo_<?php echo $alumno['NoControl']?>" >
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select class="form-control" name="categoriaMeta_<?php echo $alumno['Categoria'] ?>_<?php echo $alumno['NoControl']?>" disabled>
                                                <option value="<?php echo $alumno['Categoria'] ?>"><?php echo $alumno['CategoriaDesc'] ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    } ?>
                                    <div class="row">
                                        <input onclick="prevStep('formInforme3')" class="btn btn-default" value="Regresar">
                                        <input onclick="step7Next('formInforme3')" class="btn btn-primary" value="Siguiente" style="float: right;">
                                    </div>                                                            
                                </div>
                            </div>
                        </div>
                    </form>
                    <!------------------------------------------------------------------------------------->
                    <form class="container"  id="formInforme4">
                        <input type="hidden" value="updateInformeDet4" id="updateObservacionesResumen3" name="accion">
                        <input type="hidden" id="numeroLogros" name="numeroLogros" value="1">
                        <div class="row setup-content" id="step-8">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <h1 class="text-center" style="margin-top: -30px;">IV. Informe detallado</h1>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <h4>D) Logros en divulgación por publicaciones (anexe copia del artículo y constancia de su publicación)</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="col-lg-1">
                                            <button type="button" id="nuevoLogro" class="form-control btn btn-default" onclick="NuevoLogroDivulgacion(1)">+</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Titulo de articulo</label>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Tipo de publicacion</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label style="float: right;">Nombre de la publicacion</label>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Lugar(Indicar si es web)</label>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Fecha</label>
                                        </div>
                                    </div>
                                    <div id="logros">
                                        <div id="logro_">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="logroTitulo_" >
                                                    </div>
                                                    <div class="col-md-3">
                                                        <select class="form-control" name="tipoLogro_" >
                                                            <option value="0">Revista arbitraria</option>
                                                            <option value="1">Revista sin arbitraje</option>
                                                            <option value="2">Boletin</option>
                                                            <option value="3">Memoria</option>
                                                            <option value="4">Libro</option>
                                                            <option value="5">Periodico</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control" name="NombreLogro_" >
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control" name="lugarLogro_">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="date" class="form-control" name="fechaLogro_">
                                                    </div>
                                                </div> 
                                            </div>
                                        ´</div>
                                    </div>
                                    <div class="row">
                                        <input onclick="prevStep('formInforme4')" class="btn btn-default" value="Regresar">
                                        <input onclick="step8Next('formInforme4')" class="btn btn-primary" value="Siguiente" style="float: right;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!------------------------------------------------------------------------------------->
                    <form class="container" id="formInforme5">
                        <input type="hidden" value="updateInformeDet5" id="updateObservacionesResumen3" name="accion">
                        <input type="hidden" id="numeroPresent" name="numeroPresent" value="1">
                        <div class="row setup-content" id="step-9">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <h1 class="text-center" style="margin-top: -30px;">V. Informe detallado</h1>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <h4>E) Logros en presentaciones en eventos (anexe copia del reconocimiento, invitación y programa)</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="col-lg-1">
                                            <button type="button" class="form-control btn col-lg-3 btn-default" id="nuevaPres" onclick="NuevaPresentacion(1)">+</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Titulo de ponencia</label>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Tipo de ponencia</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label style="float: right;">Nombre del evento</label>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Lugar</label>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Fecha</label>
                                        </div>
                                    </div>
                                    <div id="presentaciones">
                                        <div id="presentacion_">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="tituloPresent_" >
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <select class="form-control" name="tipoPresent_" > 
                                                            <option>Conferencia magistral</option>
                                                            <option>Mesa redonda</option>
                                                            <option>Cartel</option>
                                                        <select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control" name="nombrePresent_">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control" name="lugarPresent_">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="date" class="form-control" name="fechaPresent_">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input onclick="prevStep('formInforme5')" class="btn btn-default" value="Regresar">
                                        <input onclick="step9Next('formInforme5')" class="btn btn-primary" value="Siguiente" style="float: right;">
                                    </div>                                                            
                                </div>
                            </div>
                        </div>
                    </form>
                    <!------------------------------------------------------------------------------------->
                    <form class="container" id="formResumenEj1">
                        <input type="hidden" value="updateResumenEj1" id="updateObservacionesResumen3" name="accion">
                        <div class="row setup-content" id="step-10">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <h1 class="text-center" style="margin-top: -30px;">I. Resumen ejecutivo</h1>
                                    <div class="form.group col-md-12">
                                        <h4>Con la finalidad de difundir su investigación, explique en forma clara y concisa en qué consiste su proyecto, incluyendo los beneficios obtenidos hasta el momento (de preferencia utilice un máximo de veinte renglones).</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <textarea class="form-control" rows="12" style="margin-left: 40px; resize: none;" name="resumenEj1"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input onclick="prevStep('formResumenEj1')" class="btn btn-default" value="Regresar">
                                        <input onclick="step10Next('formResumenEj1')" class="btn btn-primary" value="Siguiente" style="float: right;">
                                    </div>                                                        
                                </div>
                            </div>
                        </div>
                    </form>
                    <!------------------------------------------------------------------------------------->
                    <form class="container" id="formResumenEj2">
                        <input type="hidden" value="updateObservacionesResumen2" id="updateObservacionesResumen3" name="accion">
                        <div class="row setup-content" id="step-11">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <h1 class="text-center" style="margin-top: -30px;">II. Resumen ejecutivo</h1>
                                    <div class="form.group col-md-12" >
                                        <h4>OBSERVACIONES: Utilice este espacio para sus comentarios y sugerencias.</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <textarea class="form-control" rows="12" style="margin-left: 40px; resize: none;" name="obsResumenEj2"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input onclick="prevStep('formResumenEj2')" class="btn btn-default" value="Regresar">
                                        <input onclick="Finalizar('formResumenEj2')" class="btn btn-primary" value="Finalizar" style="float: right;">
                                    </div>                                                        
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>                        
    </div>
</div>