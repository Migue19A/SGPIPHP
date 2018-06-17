<div class="container">
    <div class="col-lg-9" >
        <!-- <nav class="navbar navbar-inverse">
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
        </nav> -->
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
                                                <div id="resp">
                                                </div>
                                                <input type="hidden" name="folio_proyecto" value="PRE2">
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
                                                        <option value="0">Otro</option>
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
                                                <input type="date" class="form-control" required name="fecha_inicio" id="fechaInicio">
                                                </div>                                               
                                                </label>
                                                </div>
                                                <div class=" input-group date">
                                                <label>Fin</label>
                                                <input type="date" class="form-control" required name="fecha_fin" id="fechaFin">
                                                </div>
                                                </div>                                           
                                                <div class="row">
                                                <input id="btnSig" class="btn btn-primary" value="Siguiente" name="btnSgt" type="submit" style="float: right;" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <!--RESPONSABLE-->
                            <form id="colaborador_form" name="form2" class="container" method="POST" style="margin-left: 10px; width: 100%;">
                                <div class="row setup-content" id="step-3">
                                <input type="text" name="form-0-folio_proyecto"  readonly>
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-12">
                                                <input type="hidden" value="reponsableForm" name="accion">
                                                <select class="form-control" id="cantidad_colaboradores" onchange="muestra_colaborador(this.id)" name="select_colaborador">
                                                    <option>N° de colaboradores a participar en el proyecto</option>
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
                                                    <label>Apellido Paterno</label>
                                                    <input type="text" class="form-control" id="apPaternoCol_1" name="apPaternoCol_1">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Apellido Materno</label>
                                                    <input type="text" class="form-control" id="apMaternoCol_1" name="apMaternoCol_1">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Nombre(s)</label>
                                                    <input type="text" class="form-control" id="nombreCol_1" name="nombreCol_1">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Grado maximo de estudios</label>
                                                    <input type="text" class="form-control" id="gradMaximoCol_1" name="gradMaximoCol_1">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Academia a la que pertenece</label>
                                                    <select class="form-control" id="academiaCol_1" name="academiaCol_1">
                                                        <option value="0">Ingenieria industrial</option>
                                                        <option value="1">Ingenieria en industrias alimentarias</option>
                                                        <option value="2">Ingenieria civil</option>
                                                        <option value="3">Ingenieria electronica</option>
                                                        <option value="4">Ingenieria electromecanica</option>
                                                        <option value="5">Ingenieria bioquimica</option>
                                                        <option value="6">Ingenieria en gestion empresarial</option>
                                                        <option value="7">Ingeneiria mecatronica</option>
                                                        <option value="8">Gastronomia</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>N° personal</label>
                                                    <input type="number" class="form-control" id="numPersonalCol_1" name="numPersonalCol_1">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Movil</label>
                                                    <input type="number" class="form-control" pattern="^\d{10}$" id="movilCol_1" name="movilCol_1">
                                                </div>
                                                <div class="form-grup col-md-3">
                                                    <label>Correo intitucional</label>
                                                    <input type="email" class="form-control" id="correoInstCol_1" name="correoInstCol_1">
                                                </div>
                                                <div class="form-grup col-md-3">
                                                    <label>Correo alternativo</label>
                                                    <input type="email" class="form-control" id="correoAltCol_1" name="correoAltCol_1">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Descripción de las principales actividades a desarrollar en el proyecto</label>
                                                    <textarea class="form-control" rows="6" style="resize: none;" required name="form-0-actividades_colaborador" id="principalesActCol_1" name="principalesActCol_1"></textarea>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                                    <input onclick="step3Next()" class="btn btn-primary" value="Siguiente" type="submit" style="float: right;">
                                                </div>
                                            </div>
                                            <div id="colaboradores">    
                                            </div>
                                        </div>
                                    </div>
                              </div>
                        </form>

 <!--RESPONSABLE-->
                            <form id="responsable_form" name="form2" class="container" method="POST" style="margin-left: 10px; width: 100%;">
                                <div class="row setup-content" id="step-2">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <input type="hidden" value="responsableForm" name="accion">
                                            <h2 style="text-align: center; margin-top: -20px; margin-bottom: 50px;">Responsable</h2>
                                            <div class="form-group col-md-5" readonly>
                                                <label>*Apellido Paterno</label>
                                                <input type="text" class="form-control" readonly value="" id="apellidoPatResp" name="apellidoPatResp" > 
                                            </div>
                                            <div class="form-group col-md-5" readonly>
                                                <label>*Apellido Materno</label>
                                                <input type="text" class="form-control" readonly value="" id="apellidoMaternoResp" name="apellidoMaternoResp" > 
                                            </div>
                                            <div class="form-group col-md-5" readonly >
                                                <label>*Nombre(s)</label>
                                                <input type="text" class="form-control" readonly value=""id="nombreResp" name="nombreResp">
                                            </div>
                                            <div class="form-group col-md-4" readonly>      
                                                <label>*Grado máximo de estudios</label>
                                                <input type="text" class="form-control" readonly value="" id="gradoMaximoResp" name="gradoMaximoResp" >
                                            </div>
                                            <div class="form-group col-md-6" readonly>
                                                <label>*Academia a la que pertenece</label>
                                                <input type="text" class="form-control" readonly value="" id="academiaResp" name="academiaResp" >                  
                                            </div>
                                            <div class="form-group col-md-2" readonly>
                                                <label>*N° de personal</label>
                                                <input type="text" class="form-control" readonly value="" id="NumeroPersonalResp" name="NumeroPersonalResp" >
                                            </div>
                                            <div class="form-group col-md-3" readonly>
                                                <label>Móvil</label>
                                                <input type="text" class="form-control" readonly value="" id="movilResp" name="movilResp" ></div>
                                            <div class="form-group col-md-4">
                                                <label>*Correo institucional</label>
                                                <input type="email" class="form-control" readonly value="" id="correoInstResp" name="correoInstResp" >    
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Correo alternativo</label>
                                                <input type="email" class="form-control" id="emailAltResp" name="emailAltResp" >
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>*Descripción de las principales actividades a desarrollar en el proyecto</label>
                                                <textarea class="form-control" name="actividades_responsable" id="actividades_responsable" required rows="5" cols="200" id="" ></textarea>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>*Palabras clave:</label>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>*(1)</label>
                                                <input class="form-control" onKeyPress="return palabrasClave(event);" id="palabra_clave1" name="palabra_clave1" type="text" required/>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>*(2)</label>
                                                <input class="form-control" onKeyPress="return palabrasClave(event);" id="palabra_clave2" name="palabra_clave2" type="text" required/>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>*(3)</label>
                                                <input class="form-control" onKeyPress="return palabrasClave(event);" id="palabra_clave3" name="palabra_clave3" type="text" required/>
                                            </div>
                                            <div class="row">
                                                <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                                <input type="button" class="btn btn-primary" value="Siguiente" name="botonS2" style="float: right;" id="responsable_form" onclick="ajaxPreregistro(this.id)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <!--COLABORADORES-->
                            
                           <form id="colaborador_form" name="form2" class="container" method="POST" style="margin-left: 10px; width: 100%;">
                                <div class="row setup-content" id="step-3">
                                <input type="text" name="form-0-folio_proyecto"  readonly>
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-12">
                                                <select class="form-control" id="cantidad_colaboradores" onchange="muestra_colaborador(this.id)" name="select_colaborador">
                                                    <option>N° de colaboradores a participar en el proyecto</option>
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
                                                    <label>Apellido Paterno</label>
                                                    <input type="text" class="form-control" id="apPaternoCol_1" name="apPaternoCol_1">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Apellido Materno</label>
                                                    <input type="text" class="form-control" id="apMaternoCol_1" name="apMaternoCol_1">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Nombre(s)</label>
                                                    <input type="text" class="form-control" id="nombreCol_1" name="nombreCol_1">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Grado maximo de estudios</label>
                                                    <input type="text" class="form-control" id="gradMaximoCol_1" name="gradMaximoCol_1">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Academia a la que pertenece</label>
                                                    <select class="form-control" id="academiaCol_1" name="academiaCol_1">
                                                        <option value="0">Ingenieria industrial</option>
                                                        <option value="1">Ingenieria en industrias alimentarias</option>
                                                        <option value="2">Ingenieria civil</option>
                                                        <option value="3">Ingenieria electronica</option>
                                                        <option value="4">Ingenieria electromecanica</option>
                                                        <option value="5">Ingenieria bioquimica</option>
                                                        <option value="6">Ingenieria en gestion empresarial</option>
                                                        <option value="7">Ingeneiria mecatronica</option>
                                                        <option value="8">Gastronomia</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>N° personal</label>
                                                    <input type="number" class="form-control" id="numPersonalCol_1" name="numPersonalCol_1">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Movil</label>
                                                    <input type="number" class="form-control" pattern="^\d{10}$" id="movilCol_1" name="movilCol_1">
                                                </div>
                                                <div class="form-grup col-md-3">
                                                    <label>Correo intitucional</label>
                                                    <input type="email" class="form-control" id="correoInstCol_1" name="correoInstCol_1">
                                                </div>
                                                <div class="form-grup col-md-3">
                                                    <label>Correo alternativo</label>
                                                    <input type="email" class="form-control" id="correoAltCol_1" name="correoAltCol_1">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Descripción de las principales actividades a desarrollar en el proyecto</label>
                                                    <textarea class="form-control" rows="6" style="resize: none;" required name="form-0-actividades_colaborador" id="principalesActCol_1" name="principalesActCol_1"></textarea>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                                    <input onclick="step3Next()" class="btn btn-primary" value="Siguiente" type="submit" style="float: right;">
                                                </div>
                                            </div>
                                            <div id="colaboradores">    
                                            </div>
                                        </div>
                                    </div>
                              </div>
                        </form>
                            <!--OBJETIVOS-->
                            
                            <form class="container" style="width: 100%;">
                                <div class="row setup-content" id="step-4">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                        <input type="text" name="folio_proyecto"  readonly>
                                            <h2 style="text-align: center; margin-top: -20px; margin-bottom: 50px;">Objetivos</h2>
                                            <div class="form-group col-md-12">
                                                <label>*Indique el objetivo general(No más de 512 caracteres)</label>
                                                {{form.objetivoG}}
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>*Establezca los objetivos específicos, científicos y tecnológicos subyacentes en el proyecto(No más de 512 caracteres)</label>
                                                {{form.objetivoE}}
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>*Indique los resultados esperados en términos concretos(No más de 512 Caracteres)</label>
                                                {{form.resultados}}
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                                <input onclick="step4Next()" class="btn btn-primary" value="Siguiente" style="float: right;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <!--VINCULACION-->
                            
                            <form class="container" style="width: 100%;">
                                <div class="row setup-content" id="step-5">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                        <input type="text" name="folio_proyecto"  readonly>
                                            <h2 style="text-align: center; margin-top: -20px; margin-bottom: 50px;">Vinculación</h2>
                                            <div class="form-group col-md-3">
                                                <label>*Existe convenio:</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                {{form.convenio}}
                                            </div>
                                            <div class="row hidden" id="vincula">
                                                <div class="form-group col-md-6">
                                                    <label>*Nombre de la organización</label>
                                                    {{form.nombre_organizacion}}
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>*Dirección</label>
                                                    {{form.direccion_organizacion}}
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>*Área</label>
                                                    {{form.area_organizacion}}
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>*Teléfono</label>
                                                    {{form.telefono_organizacion}}
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>*Nombre del contacto</label>
                                                    {{form.nombreC_organizacion}}
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>*Descripción de la organización(No más de 256 caracteres)</label>
                                                    {{form.descripcion_organizacion}}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-10">
                                                <label>*Existen aportaciones financieras o en especie de la vinculación:</label>
                                            </div>
                                            <div class="form-group col-md-8">
                                               {{form.aporta}}
                                            </div>
                                            <div class="row hidden" id="respuesta">
                                                <div class="col-md-12 form-group">
                                                    <label>Si la respuesta es sí, describa cuales son(No más de 256 caracteres)</label>
                                                    {{form.describa_aportaciones}}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                                <input onclick="step5Next()" class="btn btn-primary" value="Siguiente" style="float: right;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <!--PRODUCTOS ACADEMICOS-->
                            
                            <form class="container" style="width: 100%;">
                                <div class="row setup-content" id="step-6">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                        <input type="text" name="folio_proyecto"  readonly>
                                            <h2 style="text-align: center; margin-top: -20px; margin-bottom: 50px;">Productos académicos</h2>
                                            <label>*Seleccione al menos uno</label>
                                            {{form.productosA}}
                                            <div class="form-group col-md-3">
                                                <label><input type="checkbox">Propiedad intelectual</label>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>Especificar:</label>
                                            </div>
                                            <div class="form-group col-md-7">
                                                {{form.intelectual}}
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label><input type="checkbox">Otros</label>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>Especificar:</label>
                                            </div>
                                            <div class="form-group col-md-7">
                                                {{form.otros}}
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                                <input onclick="step6Next()" class="btn btn-primary" value="Siguiente" style="float: right;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <!--ETAPAS-->
                            
                            <form class="container" style="width: 100%;">
                                <div class="row setup-content" id="step-7">
                                    <div class="col-md-12">
                                    <input type="text" name="folio_proyecto"  readonly>
                                        <div class="col-md-12">
                                            <div class="form-group col-md-12">
                                                <label>No. de Etapas</label>
                                                {{form.sEtapa}}
                                            </div>
                                            <div class="form-group col-md-12">
                                                <h2 style="text-align: center;">Etapa 1°</h2>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>*Nombre de la etapa (no más de 24 caracteres)</label>
                                                {{form.n_Etapa}}
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>*Fecha de inicio</label>
                                                {{form.etapaInicio}}
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>*Fecha de terminación</label>
                                                {{form.etapaTermino}}
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Meses</label>
                                                {{form.etapaMeses}}
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>*Descripción:</label>
                                            </div>
                                            <div class="form-group col-md-10">
                                                {{form.etapaDes}}
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>*Actividades:</label>
                                            </div>
                                            <div class="form-group col-md-10">
                                                {{form.etapaAct}}
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>*Productos:</label>
                                            </div>
                                            <div class="form-group col-md-10">
                                                {{form.etapaPro}}
                                            </div>
                                            
                                            <!--ETAPA 2-->
                                            
                                            <div  id="etapa2">
                                                <div class="form-group col-md-12">
                                                    <h2 style="text-align: center;">Etapa 2°</h2>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>*Nombre de la etapa (no más de 24 caracteres)</label>
                                                    {{form.n_Etapa2}}
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>*Fecha de inicio</label>
                                                    {{form.etapaInicio2}}
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>*Fecha de terminación</label>
                                                    {{form.etapaTermino2}}
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>*Meses</label>
                                                    {{form.etapaMeses2}}
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>*Descripción:</label>
                                                </div>
                                                <div class="form-group col-md-10">
                                                    {{form.etapaDes2}}
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>*Actividades:</label>
                                                </div>
                                                <div class="form-group col-md-10">
                                                    {{form.etapaAct2}}
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>*Productos:</label>
                                                </div>
                                                <div class="form-group col-md-10">
                                                    {{form.etapaPro2}}
                                                </div>
                                            </div>
                                            
                                            <!--FIN ETAPA2-->
                                            
                                            <!--ETAPA 3-->
                                            
                                            <div  id="etapa3">
                                                <div class="form-group col-md-12">
                                                    <h2 style="text-align: center;">Etapa 3°</h2>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>*Nombre de la etapa (no más de 24 caracteres)</label>
                                                    {{form.n_Etapa3}}
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>*Fecha de inicio</label>
                                                    {{form.etapaInicio3}}
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>*Fecha de terminacion</label>
                                                    {{form.etapaTermino3}}
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>*Meses</label>
                                                    {{form.etapaMeses3}}
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>*Descripción:</label>
                                                </div>
                                                <div class="form-group col-md-10">
                                                    {{form.etapaDes3}}
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>*Actividades:</label>
                                                </div>
                                                <div class="form-group col-md-10">
                                                    {{form.etapaAct3}}
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>*Productos:</label>
                                                </div>
                                                <div class="form-group col-md-10">
                                                    {{form.etapaPro3}}
                                                </div>
                                            </div>
                                            
                                            <!--FIN ETAPA2-->
                                            
                                            <!--ETAPA 4-->
                                            
                                            <div  id="etapa4">
                                                <div class="form-group col-md-12">
                                                    <h2 style="text-align: center;">Etapa 4°</h2>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>*Nombre de la etapa (no más de 24 caracteres)</label>
                                                    {{form.n_Etapa4}}
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>*Fecha de inicio</label>
                                                    {{form.etapaInicio4}}
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>*Fecha de terminacion</label>
                                                    {{form.etapaTermino4}}
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>*Meses</label>
                                                    {{form.etapaMeses4}}
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>*Descripción:</label>
                                                </div>
                                                <div class="form-group col-md-10">
                                                    {{form.etapaDes4}}
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>*Actividades:</label>
                                                </div>
                                                <div class="form-group col-md-10">
                                                    {{form.etapaAct4}}
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>*Productos:</label>
                                                </div>
                                                <div class="form-group col-md-10">
                                                    {{form.etapaPro4}}
                                                </div>
                                            </div>
                                            
                                            <!--FIN ETAPA4-->
                                            <div class="form-group col-md-12">
                                                <h5><b>NOTA: </b>Los proyectos pueden tener un máximo de 4 etapas y cada etapa tendrá una duración mínima de 3 meses y máxima de 6 meses, si el proyecto sólo contempla 1  etapa, su duración debe ser de 6 meses</h5>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                                <input onclick="step7Next()" class="btn btn-primary" value="Siguiente" style="float: right;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <!--FINANCIAMIENTO-->
                            
                            <form class="container" style="width: 100%;">
                                <div class="row setup-content" id="step-8">
                                    <div class="col-md-12">
                                    <input type="text" name="folio_proyecto"  readonly>
                                        <div class="col-md-12">
                                            <h2 style="text-align: center; margin-top: -20px; margin-bottom: 50px;">Financiamiento</h2>
                                            <div class="form-group col-md-6">
                                                <label>*¿Existe actualmente algún financiamiento del proyecto?</label>
                                            </div>
                                            <div class="form-group  col-md-2">
                                                {{form.financi}}
                                            </div>
                                            <div class="row hidden" id="financiamientoSi">
                                                <div class="form-group col-md-12">
                                                    <label>En caso de que la respuesta sea sí</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    {{form.finanSi}}
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Especifique</label>
                                                    {{form.fEspeci}}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>*En caso de que la respuesta sea no desglose ($)</label>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Infraestructura:</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>{{form.fInfra}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Consumibles:</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>{{form.fCon}}
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
                                                            <span class="input-group-addon">$</span>{{form.fLic}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Viáticos:</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>{{form.fVia}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Publicaciones:</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>{{form.fPubli}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Equipo:</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>{{form.fEqui}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Patentes/derechos de autor:</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>{{form.fPat}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Otros (Especifique):</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>{{form.fOtros}}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-1">
                                                    <label>Desglosar:</label>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    {{form.fDesglo}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Total:</label>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>{{form.fTot}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                                    <input onclick="step8Next()" class="btn btn-primary" value="Siguiente" style="float: right;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <!--ALUMNOS COLABORADORES-->
                            
                            <form class="container" style="width: 100%;">
                                <div class="row setup-content" id="step-9">
                                    <div class="col-md-12">
                                    <input type="text" name="folio_proyecto"  readonly>
                                        <div class="col-md-12">
                                            <div class="form-group col-md-4">
                                                <label>Total de alumnos colaboradores</label>
                                                {{form.alumTot}}
                                            </div>
                                             <div class=" form-group col-md-2">
                                                <a aria-pressed="true" class="btn btn-primary" onclick="TAlum()" role="button" style="margin-top: 25px;">Aceptar</a>
                                            </div>
                                        </div>
                                        <table>
                                            <tbody id="tablaAlu">
                                                <tr>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group col-md-8" style="margin-top: 30px;">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                             <h2 style="text-align: center;">Alumno colaborador 1°</h2>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>*Nombre del alumno</label>
                                                                {{form.alumNomb}}
                                                            </div>
                                                            <div class="form-group col-md-5">
                                                                {{form.alumSRT}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-4">
                                                                <label>*N° control</label>
                                                                {{form.alumControl}}
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label>*Semestre</label>
                                                                {{form.alumSem}}
                                                            </div>
                                                            <div class="form-group col-md-5">
                                                                <label>*Carrera</label>
                                                                    {{form.alumCar}}
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>*Detalle de actividades (máximo 256 caracteres)</label>
                                                                {{form.alumActi}}
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <h5><b>NOTA:</b>La cantidad de alumnos colaboradores depende de la complejidad del proyecto, como máximo 20 alumnos.</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="form-group col-md-12">
                                                <input onclick="prevStep()" class="btn btn-default" value="Regresar">
                                                <input class="btn btn-primary" value="Finalizar" style="float: right;" onclick="Finalizar()">
                                                <a class="btn btn-info view-pdf" style="float: right; margin-right: 10px;">Vista previa</a>
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
</div>