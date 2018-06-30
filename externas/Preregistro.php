<script type="text/javascript">
$(document).ready(function () {
                var currentStep = 1;
                $('.li-nav').click(function () {
                    var $targetStep = $($(this).attr('step'));
                    currentStep = parseInt($(this).attr('id').substr(7));
                    if (!$(this).hasClass('disabled')) {
                        $('.li-nav.active').removeClass('active');
                        $(this).addClass('active');
                        $('.setup-content').hide();
                        $targetStep.show();
                    }
                });
                $('#navStep1').click();

                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!
                var yyyy = today.getFullYear();
                 if(dd<10){
                        dd='0'+dd
                    } 
                    if(mm<10){
                        mm='0'+mm
                    } 

                today = yyyy+'-'+mm+'-'+dd;
                document.getElementById("fechaPresentacion").setAttribute("min", today);
                document.getElementById("fechaPresentacion").setAttribute("value", today);
                document.getElementById("fechaInicio").setAttribute("min", today);
                document.getElementById("fechaInicio").setAttribute("value", today);
                document.getElementById("fechaFin").setAttribute("min", today);
                document.getElementById("fechaFin").setAttribute("value", today);

                Date.prototype.mes = function() {
                  var m = this.getMonth() + 1; // getMonth() is zero-based
                  return (m>9 ? '' : '0') + m;
                };
                Date.prototype.segundos = function() {
                  var s = this.getSeconds();
                  return (s>9 ? '' : '0') + s;
                };

                var fechaIni= $('#fechaFin').val();      
                var diasMaximo = 730;
                var diasMinimo = 182;
                var fechaMax = new Date(fechaIni);
                var fechaMin = new Date(fechaIni);
                fechaMax.setDate(fechaMax.getDate()+diasMaximo);
                fechaMin.setDate(fechaMin.getDate()+diasMinimo);
                var fechaSQLM = fechaMax.getFullYear()+"-"+ fechaMax.mes()+"-"+fechaMax.getDate();
                var fechaSQLm = fechaMin.getFullYear()+"-"+ fechaMin.mes()+"-"+fechaMin.getDate();
                $('#fechaFin').attr('min', fechaSQLm);
                $('#fechaFin').attr('max', fechaSQLM);  
                $('#fechaFin').val(fechaSQLm);

                //Área de texto en caso de que seleccione sí al principio del financiamiento
                $('#especificarF').attr('readonly', true);
                $('#especificarF').attr('required', false);

                //Desglosar en financiamiento
                $('#otro_especificar').attr('readonly', true);
                $('#otro_especificar').attr('required', false);


                $('#infraestructura').val(0);
                $('#consumibles').val(0);
                $('#licencias').val(0);
                $('#viaticos').val(0);
                $('#publicaciones').val(0);
                $('#equipo').val(0);
                $('#patentes').val(0);
                $('#otros_finan').val(0);
                $('#total').val(0);
                $('#otro_especificar').attr('readonly', false);
                $('#otro_especificar').attr('required', true);

                var acc = document.getElementsByClassName("accordion");
                var i;
                for (i = 0; i < acc.length; i++) {
                    acc[i].onclick = function() {
                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
                    if (panel.style.maxHeight){
                      panel.style.maxHeight = null;
                    } else {
                      panel.style.maxHeight = panel.scrollHeight + "px";
                    } 
                  }
            }                
                
});
</script>
<div class="container">
    <div class="col-lg-9" >
        <nav class="navbar navbar-inverse">
            <div class="container-fluid col-lg-12">
                <ul class="nav navbar-nav col-lg-12" id="myNav">
                    <li id="navStep1" class="li-nav active  col-lg-1 barra" step="#step-1">
                        <a href="#" id="navPre">
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            <span class="sec-text">Recepción</span>
                        </a>
                    </li>
                    <li id="navStep2" class="li-nav disabled col-lg-1 barra" step="#step-2">
                        <a href="#" title="Informe general 2" id="navPre">
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            <span class="sec-text">Responsable</span>
                        </a>    
                    </li>
                    <li id="navStep3" class="li-nav disabled col-lg-1 barra"  step="#step-3">
                        <a href="#" id="navPre">
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            <span class="sec-text">Colaboradores</span>
                        </a>
                    </li>
                    <li id="navStep4" class="li-nav disabled col-lg-1 barra" step="#step-4">
                        <a href="#" id="navPre">
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            <span class="sec-text">Objetivos</span>
                        </a>
                    </li>
                    <li id="navStep5" class="li-nav disabled col-lg-1 barra" step="#step-5">
                        <a href="#" id="navPre">
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            <span class="sec-text">Vinculación</span>
                        </a>
                    </li>
                    <li id="navStep6" class="li-nav disabled col-lg-2 barra" step="#step-6">
                        <a href="#" id="navPre">
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            <span class="sec-text">Productos académicos</span>
                        </a>
                    </li>
                    <li id="navStep7" class="li-nav disabled col-lg-1 barra" step="#step-7">
                        <a href="#" id="navPre">
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            <span class="sec-text">Etapas</span>
                        </a>
                    </li>
                    <li id="navStep8" class="li-nav disabled col-lg-2 barra" step="#step-8">
                        <a href="#" id="navPre">
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            <span class="sec-text">Financiamiento</span>
                        </a>
                    </li>
                    <li id="navStep9" class="li-nav disabled col-lg-2 barra" step="#step-9">
                        <a href="#" id="navPre">
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            <span class="sec-text">Alumnos Colaboradores</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="text-center">Pre-Registro de Proyecto de Investigación y Desarrollo Tecnológico</h2> 
                        </div>
                        <div class="panel-body">
                            <form id="recepcion_form" name="form1" onsubmit="ajaxPreregistro(this.id)" class="container" method="POST" style="margin-left: 10px; width: 100%;">
                                <div class="row setup-content" id="step-1">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="col-md-12">
                                            <h2 style="text-align: center; margin-top: -20px; margin-bottom: 50px;">Recepción</h2>
                                            <div class="row">
                                                <input type="hidden" value="recepcionForm" name="accion">
                                                <div class="form-group col-md-3 col-lg-6">
                                                <div class="input-group date">                                 
                                                <?php
                                                    $res = $miConn->consultaFolio();
                                                    $r = pg_fetch_array($res);
                                                    $prefolio = $r[0]+1;                                  
                                                ?> 
                                                <input type="hidden" id="folio_proyecto1" name="folio_proyecto" readonly value=<?php echo "PRE".$prefolio ?>>
                                                <input type="hidden" name="recepcion" value="recepcion">
                                                <label>*Fecha de presentación</label>   
                                                <input type="date" class="form-control" id="fechaPresentacion" required name = "fecha_presentacion" min='2018-06-09' readonly>
                                                </div>
                                                </div>
                                                <div class="form-group col-md-5 col-lg-5">
                                                    <label>*Convocatorio CPR</label>        
                                                    <input type="text" class="form-control" name="clave_cpr" readonly id="CPR" value="CPR1">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">                                       
                                                    <div class="row">
                                                        <label>*Tipo de investigación</label>
                                                        <select class="form-control" name="tipo_investigacion">
                                                        <?php
                                                        $res = $miConn->cboInvestigacion();
                                                        while($r = pg_fetch_array($res)){
                                                            echo "<option value='".$r[0]."'>".$r[1]."</option>";       
                                                        }
                                                        ?>     
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">                                                
                                                    <div class="row">
                                                        <label>*Tipo de sector</label>
                                                        <select class="form-control" name="tipo_sector" onchange="habilitarEspecifique()" id="tipo_sector">
                                                        <?php
                                                            $res = $miConn->cboSector();
                                                            while($r = pg_fetch_array($res)){
                                                                echo "<option value='".$r[0]."'>".$r[1]."</option>";       
                                                            }
                                                        ?>                             
                                                        </select>                                                      
                                                        <br>
                                                        <br>
                                                  </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-d12 form-group"> 
                                                    <label>Especifique</label>
                                                    <textarea id="id_especifique" readonly name="especifique" class="form-control" rows="7" style="resize: none; width: 98%;"></textarea>
                                                </div>
                                            </div>
                                            

                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label>*Línea de investigación</label>
                                                    <select class="form-control" name="linea_investigacion">
                                                            <?php
                                                            $res = $miConn->cboLinea();
                                                            while($r = pg_fetch_array($res)){
                                                                echo "<option value='".$r[0]."'>".$r[1]."</option>";       
                                                            }
                                                        ?> 
                                                    </select>
                                                </div>   
                                            </div> 
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>*Nombre del proyecto</label>
                                                    <textarea maxlength="200" class="form-control" rows="7" style="resize: none; width: 98%; text-transform: uppercase;" required id="nombre_proyecto" name="nombre_proyecto" onblur="validarNombre()"></textarea>
                                                    <div style="color: red;"><label id="error_nombre"></label></div>
                                                    <label>Total de caracteres: 200</label><br>
                                                
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 form-group">
                                                    <label>Duración:</label>
                                                </div>
                                                <div class="col-md-5 form-group">
                                                <div class="input-group date">
                                                <label>Inicio</label>    
                                                <input type="date" class="form-control" onchange="cambiarFecha()" required name="fecha_inicio" id="fechaInicio">
                                                </div>                                               
                                                </label>
                                                </div>
                                                <div class=" input-group date">
                                                <label>Fin</label>
                                                <input type="date" class="form-control" required name="fecha_fin" id="fechaFin">
                                                </div>
                                                </div>                                           
                                                <div class="row">
                                                <input id="btnSig1" class="btn btn-primary" value="Siguiente" name="btnSgt" type="submit" style="float: right;" onclick="anexarFolio()" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                        <!--RESPONSABLE-->
                            <form id="responsable_form" name="form2" onsubmit="ajaxPreregistro(this.id)" class="container" method="POST" style="margin-left: 10px; width: 100%;">
                                <div class="row setup-content" id="step-2">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <input type="hidden" value="responsableForm" name="accion">
                                            <input type="hidden" id="folio_proyecto2" name="folio_proyecto" readonly>
                                            <h2 style="text-align: center; margin-top: -20px; margin-bottom: 50px;">Responsable</h2>
                                            <div class="form-group col-md-4" readonly>
                                                <label>*Apellido paterno</label>
                                                <input type="text" class="form-control" disabled value="" id="apellidoPatResp" name="apellidoPatResp" value="VALDIVIA" > 
                                            </div>
                                            <div class="form-group col-md-4" readonly>
                                                <label>*Apellido materno</label>
                                                <input type="text" class="form-control" readonly value="" id="apellidoMaternoResp" name="apellidoMaternoResp" value="CRUZ" > 
                                            </div>
                                            <div class="form-group col-md-4" readonly >
                                                <label>*Nombre(s)</label>
                                                <input type="text" class="form-control" readonly value=""id="nombreResp" name="nombreResp" value="ANA PATRICIA">
                                            </div>
                                            <div class="form-group col-md-4" readonly>      
                                                <label>*Grado máximo de estudios</label>
                                                <input type="text" class="form-control" readonly value="" id="gradoMaximoResp" name="gradoMaximoResp" value="LICENCIATURA">
                                            </div>
                                            <div class="form-group col-md-6" readonly>
                                                <label>*Academia a la que pertenece</label>
                                                <input type="text" class="form-control" readonly value="" id="academiaResp" name="academiaResp" value="Ingeniería en sistema computacionales">                  
                                            </div>
                                            <div class="form-group col-md-2" readonly>
                                                <label>*N° de personal</label>
                                                <input type="text" class="form-control" readonly value="" id="NumeroPersonalResp" name="NumeroPersonalResp" value="123">
                                            </div>
                                            <div class="form-group col-md-3" readonly>
                                                <label>Móvil</label>
                                                <input type="text" class="form-control" readonly value="" id="movilResp" name="movilResp" ></div>
                                            <div class="form-group col-md-4">
                                                <label>*Correo institucional</label>
                                                <input type="email" class="form-control" readonly value="" id="correoInstResp" name="correoInstResp" value="patty_itx@hotmail.com">    
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Correo alternativo</label>
                                                <input type="email" class="form-control" id="emailAltResp" name="emailAltResp" readonly>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>*Descripción de las principales actividades a desarrollar en el proyecto</label>
                                                <textarea class="form-control" name="actividades_responsable" id="actividades_responsable" required rows="5" cols="200" id="" style="text-transform: uppercase;" ></textarea>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>*Palabras clave:</label>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>*(1)</label>
                                                <input class="form-control" onKeyPress="return palabrasClave(event);" id="palabra_clave1" name="palabra_clave1" type="text" style="text-transform: uppercase;" required/>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>*(2)</label>
                                                <input class="form-control" onKeyPress="return palabrasClave(event);" id="palabra_clave2" name="palabra_clave2" type="text" style="text-transform: uppercase;" required/>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>*(3)</label>
                                                <input class="form-control" onKeyPress="return palabrasClave(event);" id="palabra_clave3" name="palabra_clave3" type="text" style="text-transform: uppercase;" required/>
                                            </div>
                                            <div class="row">
                                                <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                                <input type="submit" class="btn btn-primary" value="Siguiente" name="botonS2" style="float: right;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <!--COLABORADORES-->
                            
                           <form id="colaborador_form" name="form3" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="ajaxPreregistro(this.id)">
                                <div class="row setup-content" id="step-3">
                                    <input type="hidden" id="folio_proyecto3" name="folio_proyecto" readonly>
                                    <input type="hidden" value="colaboradorForm" name="accion">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-12">
                                                <label>N° de colaboradores a participar en el proyecto</label>
                                                <select class="form-control" id="cantidad_colaboradores" onchange="muestra_colaborador(this.id)" name="select_colaborador">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                </select>                                                
                                            </div>
                                            <div id="colaborador">                                            
                                                <div class="form-group col-md-12">
                                                    <h3 style="text-align: center;" id="tituloColaborador">Colaborador 1</h3>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>*Apellido paterno</label>
                                                    <input type="text" class="form-control" required id="apPaternoCol_1" name="apPaternoCol_1">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Apellido materno</label>
                                                    <input type="text" class="form-control" id="apMaternoCol_1" name="apMaternoCol_1">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>*Nombre(s)</label>
                                                    <input type="text" class="form-control" required id="nombreCol_1" name="nombreCol_1">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>*Grado máximo de estudios</label>
                                                    <input type="text" class="form-control" required id="gradMaximoCol_1" name="gradMaximoCol_1">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>*Academia a la que pertenece</label>
                                                    <select class="form-control" id="academiaCol_1" required name="academiaCol_1">
                                                        <?php
                                                            $res = $miConn->cboCarrera();
                                                            while($r = pg_fetch_array($res)){
                                                                echo "<option value='".$r[0]."'>".$r[1]."</option>";       
                                                            }
                                                        ?>  
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>*N° de personal</label>
                                                    <input type="number" class="form-control" required id="numPersonalCol_1" name="numPersonalCol_1">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Móvil</label>
                                                    <input type="number" class="form-control" pattern="^\d{10}$" id="movilCol_1" name="movilCol_1">
                                                </div>
                                                <div class="form-grup col-md-3">
                                                    <label>*Correo institucional</label>
                                                    <input type="email" class="form-control" required id="correoInstCol_1" name="correoInstCol_1">
                                                </div>
                                                <div class="form-grup col-md-3">
                                                    <label>Correo alternativo</label>
                                                    <input type="email" class="form-control" id="correoAltCol_1" name="correoAltCol_1">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>*Descripción de las principales actividades a desarrollar en el proyecto</label>
                                                    <textarea class="form-control" rows="6" style="resize: none;" required name="principalesActCol_1" id="principalesActCol_1" name="principalesActCol_1"></textarea>
                                                </div>
                                                </div>
                                            <div id="colaboradores">    
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                                <input class="btn btn-primary" value="Siguiente" type="submit" style="float: right;">
                                                </div>
                                            </div>
                                    </div>
                              </div>
                        </form>
                            <!--OBJETIVOS-->
                            
                        <form id="objetivos_form" name="form4" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="ajaxPreregistro(this.id)">
                                <div class="row setup-content" id="step-4">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                        <input type="hidden" value="objetivosForm" name="accion">
                                        <input type="hidden" id="folio_proyecto4" name="folio_proyecto" readonly>
                                            <h2 style="text-align: center; margin-top: -20px; margin-bottom: 50px;">Objetivos</h2>
                                            <div class="form-group col-md-12">
                                                <label>*Indique el objetivo general (No más de 512 caracteres)</label>
                                                <textarea class="form-control" required id="obj_general" name="obj_general" style="resize: none;" rows="6" maxlength="512"></textarea>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>*Establezca los objetivos específicos, científicos y tecnológicos subyacentes en el proyecto (No más de 512 caracteres)</label>
                                                <textarea class="form-control" required id="obj_especif" name="obj_especif" style="resize: none;" rows="6" maxlength="512"></textarea>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>*Indique los resultados esperados en términos concretos  (No más de 512 Caracteres)</label>
                                                <textarea class="form-control" required id="resultados" name="resultados" style="resize: none;" rows="6" maxlength="512"></textarea>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                                <input type="submit" class="btn btn-primary" value="Siguiente" style="float: right;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <!--VINCULACION-->
                            
                            <form id="vinculacion_form" name="form5" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="ajaxPreregistro(this.id)">
                                <div class="row setup-content" id="step-5">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <input type="hidden" value="vinculacionForm" name="accion">
                                            <input type="hidden" id="folio_proyecto5" name="folio_proyecto" readonly>
                                            <h2 style="text-align: center; margin-top: -20px; margin-bottom: 50px;">Vinculación</h2>
                                            <div class="form-group col-md-3">
                                                <label>*¿Existe convenio?:</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label><input id="ExisteConvenio1" name="convenio" type="radio" onclick="vinculacionConvenio()" value="si"/>Sí</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label><input id="ExisteConvenio2" name="convenio" type="radio" onclick="vinculacionConvenio()" value="no" checked/>No</label>
                                            </div>
                                            <div class="row hidden" id="vincula">
                                                <div class="form-group col-md-12">
                                                    <label>*Nombre de la organización</label>
                                                    <input class="form-control" required id="organizacionV" name="organizacion" type="text">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>*Dirección</label>
                                                     <input class="form-control" name="direccionV" required  id="direccionV" type="text">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>*Área</label>
                                                    <input class="form-control"  id="areaV" name="areaV" required type="text">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>*Teléfono</label>
                                                    <input class="form-control"  id="telefonoV" name="telefonoV" required pattern="^\d{10}$" type="number">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>*Nombre del contacto</label>
                                                    <input class="form-control"  id="nombreV" name="nombreV" required type="text">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>*Descripción de la organización (No más de 256 caracteres)</label>
                                                     <textarea maxlength="256" id="descripcionV" name="descripcionV" class="form-control" rows="6" required style="resize: none; width: 98%"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-10">
                                                <label>*¿Existen aportaciones financieras o en especie de la vinculación?:</label>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label><input id="aportaciones1" name="aporta" type="radio" onclick="respuestaF()" value="si">Sí</label>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label><input id="aportaciones2" name="aporta" type="radio" onclick="respuestaF()" value="no" checked>No</label>
                                            </div>
                                            <div class="row hidden" id="respuesta">
                                                <div class="col-md-12 form-group">
                                                    <label>Si la respuesta es sí, describa cuáles son (No más de 256 caracteres)</label>
                                                    <textarea maxlength="256" class="form-control" id="descriptionR" name="descriptionR" style="resize: none; width: 98%" rows="6"></textarea>
                                            </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                                <input type="submit" class="btn btn-primary" value="Siguiente" style="float: right;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <!--PRODUCTOS ACADEMICOS-->
                            
                            <form id="prductos_form" name="form6" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="ajaxPreregistro(this.id)">
                                <div class="row setup-content" id="step-6">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                        <input type="hidden" value="productosForm" name="accion">
                                        <input type="hidden" id="folio_proyecto6" name="folio_proyecto" readonly>
                                            <h2 style="text-align: center; margin-top: -20px; margin-bottom: 50px;">Productos académicos</h2>
                                            <label>*Seleccione al menos uno</label>
                                            <div class="form-group col-md-12">
                                                <label><input type="checkbox" required id="servicio" name="servicio"> Servicio social</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label><input type="checkbox" id="residencia" name="residencia"> Residencia profesional</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label><input type="checkbox" id="tesis" name="tesis"> Tesis</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label><input type="checkbox" id="ponencia" name="ponencia"> Ponencias/Conferencias</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label><input type="checkbox" id="articulos" name="articulos"> Articulos</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label><input type="checkbox" id="libros" name="libros"> Libros/Manuales</label>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label><input type="checkbox" onchange="productosHabilitar()" id="intelectual" name="intelectual"> Propiedad intelectual</label>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>Especificar:</label>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <input type="text" readonly id="intelectualText" name="intelectualText" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label><input type="checkbox" onchange="productosHabilitar()" id="otros" name="otros"> Otros</label>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>Especificar:</label>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <input type="text" readonly id="otrosText" name="otrosText" class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                                <input type="submit" class="btn btn-primary" value="Siguiente" style="float: right;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <!--ETAPAS-->
                            
                            <form id="etapas_form" name="etapas_form" onsubmit="ajaxPreregistro(this.id)" class="container" method="POST" style="margin-left: 10px; width: 100%;">
                                <div class="row setup-content" id="step-7">
                                    <input type="hidden" id="accion" name="accion" value="etapasForm">
                                    <input type="hidden" id="folio_proyecto7" name="folio_proyecto" readonly>
                                    <h2 style="text-align: center; margin-top: -20px; margin-bottom: 50px;">Productos académicos</h2>
                                    <div class="col-sm-2 col-lg-offset-2" valign="bottom">
                                        <label>
                                            Total de etapas:
                                        </label>
                                    </div>
                                    <div class="col-sm-2">
                                        <select class="form-control" id="opcion_etapas" name="opcion_etapas" onchange="crearEtapas(this.id)">
                                            <option>
                                                1
                                            </option>
                                            <option>
                                                2
                                            </option>
                                            <option>
                                                3
                                            </option>
                                            <option>
                                                4
                                            </option>
                                        </select>
                                    </div>
                                    <br>
                                    <div id="etapa">
                                        <div class="col-lg-12" style="">
                                            <h3 class="text-center" id="tituloEtapa_1" style="font-weight: Yu Gothic UI Light; margin-top: 2px">Etapa 1</h3>
                                            <div class="row">
                                                <div class="col-sm-3 form-group">
                                                    <label>
                                                        Nombre de la etapa:
                                                    </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input class="form-control" name="nombreEtapa_1" id="nombreEtapa_1" style="margin-left: 18px;" type="text">
                                                    </input>
                                                </div>
                                                <div class="col-sm-3 form-group col-lg-offset-1">
                                                    <h6>
                                                        *No más de 24 caracteres
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2 form-group">
                                                    <label>
                                                        Duración:
                                                    </label>
                                                </div>
                                                <div class="col-sm-1 form-group">
                                                    <label>
                                                        Fecha inicio:
                                                    </label>
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <input class="form-control" name="inicioEtapa_1" id="inicioEtapa_1" style="margin-left: 18px;" required type="date">
                                                    </input>
                                                </div>
                                                <div class="col-sm-1 form-group">
                                                    <label>
                                                        Fecha fin:
                                                    </label>
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <input class="form-control" name="finalEtapa_1" id="finalEtapa_1" style="margin-left: 18px;" require type="date">
                                                    </input>
                                                </div>
                                                <div class="col-sm-1 form-group">
                                                    <label>
                                                        Meses:
                                                    </label>
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <input class="form-control" name="mesesEtapa_1" id="mesesEtapa_1" style="margin-left: 18px;" require type="number">
                                                    </input>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2 form-group">
                                                    <label>
                                                        *Descripcion
                                                    </label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="descripcionEtapa_1" id="descripcionEtapa_1" required type="text">
                                                    </input>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2 form-group">
                                                    <label>
                                                        *Metas
                                                    </label>
                                                </div>
                                                <div class="col-sm-10 form-group">
                                                    <textarea class="form-control" require name="metasEtapa_1" id="metasEtapa_1" rows="4" style="resize: none;">
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2 form-group">
                                                    <label>
                                                        *Actividades
                                                    </label>
                                                </div>
                                                <div class="col-sm-10 form-group">
                                                    <textarea class="form-control" require name="actividadesEtapa_1" id="actividadesEtapa_1" rows="4" style="resize: none;">
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2 form-group">
                                                    <label>
                                                        *Productos
                                                    </label>
                                                </div>
                                                <div class="col-sm-10 form-group">
                                                    <textarea class="form-control" require name="productosEtapa_1" id="productosEtapa_1" rows="4" style="resize: none;">
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container col-sm-9" id="divEtapa">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                        <input type="submit" class="btn btn-primary" value="Siguiente" name="botonS7" style="float: right;">
                                    </div>
                                </div>
                                </form>
                            
                            <!--FINANCIAMIENTO-->
                            
                            <form id="financiamiento_form" name="financiamiento_form" onsubmit="ajaxPreregistro(this.id)" class="container" method="POST" style="margin-left: 10px; width: 100%;">
                                <div class="row setup-content" id="step-8">
                                    <input type="hidden" id="accion" name="accion" value="financiamientoForm">
                                    <input type="hidden" id="folio_proyecto8" name="folio_proyecto" readonly>
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <h2 style="text-align: center; margin-top: -20px; margin-bottom: 50px;">Financiamiento</h2>
                                            <div class="form-group col-md-6">
                                                <label>*¿Existe actualmente algún financiamiento del proyecto?</label>
                                            </div>
                                            <div class="form-group  col-md-2">
                                                <label>Sí</label>
                                                <input name="financiamientoR" required type="radio" onclick="muestraFina()" value="si">
                                            </div>
                                            <div class="form-group  col-md-2">
                                                <label><input name="financiamientoR" required type="radio" onclick="muestraFina()" value="no" checked="">No</label>
                                            </div>
                                            <div class="row hidden" id="financiamientoSi">
                                                <div class="form-group col-md-12">
                                                    <label>En caso de que la respuesta sea sí</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label><input type="radio" name="fsi" onclick="financiar()" id="fSi" value="interno">Interno</label>
                                                </div>
                                                 <div class="form-group col-md-3">
                                                    <label><input type="radio" name="fsi"  onclick="financiar()" id="fSI" value="externo">Externo</label>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>*Especifique</label>
                                                    <textarea class="form-control" rows="3" id="especificarF" name="financia_especificar"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>*En caso de que la respuesta sea no desglose ($)</label>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>*Infraestructura:</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span><input class="form-control"  id="infraestructura" name="infraestructura" onblur="sumar()" type="number" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>*Consumibles:</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span><input class="form-control" id="consumibles" name="consumibles" onblur="sumar()" type="number" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Licencias:</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">$</span><input class="form-control"  id="licencias" name="licencias" onblur="sumar();" type="number" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>*Viáticos:</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span><input class="form-control"  id="viaticos" name="viaticos" onblur="sumar();" type="number" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>*Publicaciones:</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span><input class="form-control"  id="publicaciones" name="publicaciones" onblur="sumar();" type="number" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>*Equipo:</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span><input  class="form-control"  id="equipo" name="equipo" onblur="sumar();" type="number" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>*Patentes/derechos de autor:</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span><input class="form-control"  id="patentes" name="patentes" onblur="sumar();" type="number" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Otros (Especifique):</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span><input class="form-control"  id="otros_finan" name="otros_finan" onblur="sumar();" type="number">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-1">
                                                    <label>Desglosar: </label>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <input type="text" id="otro_especificar" name="otro_especificar" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Total:</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span><input class="form-control" readonly id="total" name="total" type="number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                                    <input type="submit" class="btn btn-primary" value="Siguiente" style="float: right;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <!--ALUMNOS COLABORADORES-->
                            
                            <form id="alumnos_form" name="alumnos_form" onsubmit="ajaxPreregistro(this.id)" class="container" method="POST" style="margin-left: 10px; width: 100%;">
                                <div class="setup-content" id="step-9">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-12">
                                                <h2 class="text-center">Alumnos Colaboradores</h2><br>
                                                <h4 class="text-left">Selecciona el total de alumnos colaboradores</h4>
                                                <input class="form-control text-center" type="number" id="totalAlumnosCol" name="totalAlumnosCol" min="1" max="50" onchange="crearAlumnos(this.id)" value="1" class="form-control">
                                                <input type="hidden" name="accion" id="accion" value="alumnos_form">
                                                <input type="hidden" id="folio_proyecto9" name="folio_proyecto" readonly>
                                            </div>
                                        </div>
                                        <div id="alumno" class="col-lg-12">
                                            <div class="form-group col-md-8" style="margin-top: 30px;">
                                                <label>* S.S.= Servicio Social, R.P.= Residencia Profesional, T= Tesis</label>
                                            </div>
                                            <div class="form-group col-md-12 ">
                                                 <h3 style="text-align: center;" id="tituloAlumno_1">Alumno colaborador 1°</h3>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="col-lg-6"><label>*Nombre</label>
                                                    <input class="form-control" required type="text" id="nombreAlumnoCol_1" name="nombreAlumnoCol_1" size="15">
                                                    </div>
                                                    <div class="col-lg-6"><label>*Apellido Paterno</label>
                                                    <input class="form-control" required type="text" id="apPaternoAlumnoCol_1" name="apPaternoAlumnoCol_1" size="15">
                                                    </div>
                                                    <div class="col-lg-6"><label>*Apellido Materno</label>
                                                    <input class="form-control" type="text" id="apMaternoAlumnoCol_1" name="apMaternoAlumnoCol_1" size="15">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>*N° control</label>
                                                        <input type="text" required id="noControlAlumnoCol_1" name="noControlAlumnoCol_1" class="form-control" maxlength="9">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="col-lg-4">*Carrera</label>
                                                            <select class="col-lg-8 form-control" name="cboCarreraAlumno_1" id="cboCarreraAlumno_1" required>
                                                            <?php 
                                                            $result=$miConn->cboCarrera();
                                                            while($row = pg_fetch_array($result))
                                                            {
                                                                echo "<option value='".$row[0]."'>".$row[1]."</option>";       
                                                            }
                                                            ?>
                                                            </select>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>*Semestre</label>
                                                            <select name="cboSemestreAlumnoCol_1" id="cboSemestreAlumnoCol_1" class="form-control" required>
                                                                <option value="1">Primero</option>
                                                                <option value="2">Segundo</option>
                                                                <option value="3">Tercero</option>
                                                                <option value="4">Cuarto</option>
                                                                <option value="5">Quinto</option>
                                                                <option value="6">Sexto</option>
                                                                <option value="7">Septimo</option>
                                                                <option value="8">Octavo</option>
                                                                <option value="9">Noveno</option>
                                                                <option value="10">Décimo</option>
                                                                <option value="11">Onceavo</option>
                                                                <option value="12">Doceavo</option>
                                                            </select>
                                                    </div>                                                    

                                                    <div class="row text-center">
                                                        <div class="form-group col-md-2">
                                                            <label><input type="checkbox" required style="margin-top: 35px;">S.S</label>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label><input type="checkbox" style="margin-top: 35px;">R.P</label>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label><input type="checkbox" style="margin-top: 35px;">T</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">                                       
                                                <div class="form-group col-md-12">
                                                    <div class="col-lg-4">
                                                        <label class="col-lg-12">*Detalle de actividades <br>(máximo 256 caracteres)</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <textarea class="form-control col-md-10 col-lg-10" name="actividadesAlumnoCol_1" id="actividadesAlumnoCol_1" cols="90" rows="5" maxlength="256" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <h5><b>NOTA:</b>La cantidad de alumnos colaboradores depende de la complejidad del proyecto, como máximo 20 alumnos.</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="alumnos">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <br>
                                            <br>
                                            <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                            <input type="submit" value="Guardar" class="btn btn-primary">
                                            <input class="btn btn-success" value="Finalizar" style="float: right;" onclick="Finalizar()">
                                            <a class="btn btn-info view-pdf" style="float: right; margin-right: 10px;">Vista previa</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>