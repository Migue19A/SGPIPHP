<?php 
    //session_start();
 ?>

<script>
    $(document).ready(function(){
    //$('#btnEnvSub').attr('readonly', true);
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

    $(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
    if(!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
  } else {
    $this.parents('.panel').find('.panel-body').slideDown();
    $this.removeClass('panel-collapsed');
    $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
  }
});
    $('input[name="boton"]').change( function(){
            if($(this).val() == 'si'){
                $('#text').prop('disabled',false);
            }else{
                $('#text').prop('disabled',true);
            }
    });

});
</script>

<div class="container" style="margin-top: 14px;">
            <div class="col-md-9">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="text-center" id="tituloPre" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">Pre-Registro de Proyectos</h2>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>N° de solicitud</th>
                                        <th>Nombre del proyecto</th>                                       
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $res = $miConn->todosProyectos();
                                        $cont = 1;
                                        while($r = pg_fetch_array($res)){
                                            $estado= $miConn->consultarEstadoProyecto($r[2]);
                                            echo "<tr>";
                                            echo "<td>".$cont."</td>";
                                            echo "<td>".$r[0]."</td>";
                                            echo "<td>".$estado."</td>";
                                            if($estado== 'EN CORRECCION'){
                                                echo "<td><button class='btn btn-warning' data-target='#myModal' data-toggle='modal' onclick='ajaxPreregistroConsultas(this.id)' id='".$r[2]."' name='".$r[2]."' type='submit' method='POST' value='".$r[2]."'/>Corregir</button></td>";
                                            }
                                            else if($estado == 'EN REVISION' || $estado == 'EN REVISION INV.'){
                                                echo "<td><button class='btn btn-info' data-target='#myModal' data-toggle='modal' onclick='ajaxPreregistroConsultas(this.id)' id='".$r[2]."' name='".$r[2]."' type='submit' method='POST' value='".$r[2]."'/>Enviado</button></td>";    
                                            }else if($estado == 'ACEPTADO'){
                                                echo "<td><button class='btn btn-success' data-toggle='tooltip' data-placement= 'top' title='Imprimir' onclick='imprimir()' data-toggle='modal' id='".$r[2]."' name='".$r[2]."' method='POST' value='".$r[2]."'/>Aprobado</button></td>";    
                                            }else if($estado == 'RECHAZADO'){
                                                echo "<td><button class='btn btn-danger' data-target='#myModal' data-toggle='modal' onclick='ajaxPreregistroConsultas(this.id)' id='".$r[2]."' name='".$r[2]."' type='submit' disabled method='POST' value='".$r[2]."'/>Rechazado</button></td>";    
                                            }else{
                                                echo "<td><button class='btn btn-primary' data-target='#myModal' data-toggle='modal' onclick='ajaxPreregistroConsultas(this.id)' id='".$r[2]."' name='".$r[2]."' type='submit' method='POST' value='".$r[2]."'/>Revisar</button></td>"; 
                                            }
                                            /*else{
                                                echo "<td><button class='btn btn-success' data-toggle='tooltip' data-placement= 'top' title='Imprimir' onclick='imprimir()' data-toggle='modal' id='".$r[2]."' name='".$r[2]."' method='POST' value='".$r[2]."'/>Aprobado</button></td>";
                                            }*/
                                            echo "</tr>";                                            
                                            $folio = $r[2];
                                            $cont++;
                                        }                         
                                    ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>          
                    <br>          
                    <a class="btn btn-info" href="ContratoConf.pdf" disabled target="_blank" type="submit">Imprimir acuerdo de confidencialidad</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="modal fade" id="myModal" role="dialog" style="display: none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title" style="text-align: center;">Reporte</h4>
                    </div>                    
                    <form id="correcciones_form" name="correcciones_form" class="container" method="POST" style="margin-left: 10px; width: 100%;">
                    <input type="hidden" id="folio_obs" name="folio_obs">
                    <input type="hidden" name="accion" value="correcciones_form">
                    <div class="modal-body">
                        <div class="container" style="margin-top: 0;">
                          <div class="col-lg-12" style="margin-top: 10px;">
                            <div class="col-lg-8 well">
                                <div id="inicioP">
                                <div class="row"> 
                                    <h3 class="text-center" style="font-weight: bold;">
                                        Proyecto
                                    </h3>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            *Fecha de presentación
                                        </label>
                                        <input class="form-control" id="fechapre" name="proy1" readonly type="date">
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            *Convocatoria CPR
                                        </label>
                                        <input class="form-control" id="convocatoria" name="proy2" type="text">
                                        
                                    </div>
                                </div>
                                <div class="row container col-lg-6">    
                                    <div class="col-sm-4">
                                        <label>
                                            *Tipo de investigación
                                        </label>
                                    </div>                                    
                                    <div class="col-sm-6">
                                        <input id="tipoInvestigacion" name="proy3" readonly type="text" class="form-control">
                                    </div>     
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                                <div class="row container col-lg-6"> 
                                    <div class="col-sm-4">
                                        <label>
                                            *Tipo de sector
                                        </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="tipoSector" name="proy4" readonly type="text" class="form-control">      
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                <div class="row container col-lg-6"> 
                                    <div class="col-sm-4">
                                        <label>
                                            *Linea de investigación
                                        </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="lineaInvest" name="proy5" readonly type="text" class="form-control">      
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <label>
                                            *Nombre del proyecto
                                        </label>
                                        <input id="nombre_proyecto" name="proy6" style="text-align: center;" class="form-control" readonly type="text">
                                        
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
                                        <input id="fechaInicio"  class="form-control" name="proy7" readonly type="date">
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            *Fin
                                        </label>
                                        <input id="fechaFin" class="form-control" name="proy8" readonly type="date">          
                                    </div>
                                    </div>
                                    <div class="col-sm-12" style="background:#000">
                                    </div>
                                </div>

                              <!--<div id="recep">
                              <div class="row">
                                    <h3 class="text-center" style="font-weight: bold;">
                                        Recepción
                                    </h3>
                                    <div class="col-sm-5 form-group">
                                        <label>
                                            *Numero de recepción
                                        </label>
                                        <input class="form-control" disabled type="text"/>
                                    </div>
                                    <div class="col-sm-5 form-group">
                                        <label>
                                            *Fecha de recepción
                                        </label>
                                        <input class="form-control" disabled="" type="date"/>
                                    </div>
                              </div>
                              <div class="row form-group">
                                    <div class="col-sm-12" style="text-align: left;">
                                        <label>
                                            Recibió *Nombre(s)
                                        </label>
                                        <input class="form-control" disabled type="text"/>
                                    </div>
                              </div>
                              <div class="col-sm-12" style="background:#000">
                              </div>
                              </div>-->         
                    
                              <div class="row" id="responsable">
                                    <h3 class="text-center" style="font-weight: bold;">
                                        Responsable
                                    </h3>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            *Apellido paterno
                                        </label>
                                        <input class="form-control" disabled id="ap_paterno" type="text"/>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            *Apellido materno
                                        </label>
                                        <input class="form-control" disabled type="text"/>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            *Nombre(s)
                                        </label>
                                        <input class="form-control" disabled type="text"/>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>
                                            *Grado máximo de estudios
                                        </label>
                                        <input class="form-control" disabled style="width:100%;" type="text"/>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>
                                            *Academia a la que pertenece
                                        </label>
                                        <input class="form-control" disabled type="text"/>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            *No. Personal
                                        </label>
                                        <input class="form-control" disabled type="text"/>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            *Móvil
                                        </label>
                                        <input class="form-control" disabled type="text"/>
                                    </div>
                                    <div class="col-sm-3" form-group="">
                                        <label>
                                            *Correo
                                        </label>
                                        <input class="form-control" disabled type="text"/>
                                    </div>
                                    <div class="col-sm-3" form-group="">
                                        <label>
                                            *Correo alternativo
                                        </label>
                                        <input class="form-control" disabled type="text"/>
                                    </div>
                                    <div class="col-sm-12" form-group="">
                                        <label>
                                            *Descripción de las principales actividades a desarrollar en el proyecto
                                        </label>
                                    </div>
                                    <div class="col-sm-12" form-group="">
                                        <input id="principales_actividades" name="proy9"  readonly class="form-control" style="height: 150px;" tabindex="4" type="text">
                                        
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
                                        <input id="palabra1" readonly class="form-control" name="proy10" type="text"/>
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label>
                                            (2)
                                        </label>
                                        <input id="palabra2" readonlyclass="form-control" name="proy11" type="text"/>
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label>
                                            (3)
                                        </label>
                                        <input id="palabra3" readonly class="form-control" name="proy12" type="text"/>
                                    </div>
                                </div>
                                 <div id="colaborador"> 
                                    <input type="hidden" name="numero_colaborador" id="numero_colaborador">
                                     <div class="col-sm-12" style="background:#000">
                                    </div>                                           
                                    <div class="form-group col-md-12">
                                        <h3 style="text-align: center;" id="tituloColaborador">Colaborador 1</h3>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>*Apellido paterno</label>
                                        <input type="text" class="form-control" id="apPaternoCol_1" name="apPaternoCol_1">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Apellido materno</label>
                                        <input type="text" class="form-control" id="apMaternoCol_1" name="apMaternoCol_1">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>*Nombre(s)</label>
                                        <input type="text" class="form-control" id="nombreCol_1" name="nombreCol_1">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>*Grado máximo de estudios</label>
                                        <input type="text" class="form-control" id="gradMaximoCol_1" name="gradMaximoCol_1">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label>*Academia a la que pertenece</label>
                                        <input type="text" class="form-control" id="academiaCol_1" name="academiaCol_1">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>*N° de personal</label>
                                        <input type="number" class="form-control" id="numPersonalCol_1" name="numPersonalCol_1">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Móvil</label>
                                        <input type="number" class="form-control" pattern="^\d{10}$" id="movilCol_1" name="movilCol_1">
                                    </div>
                                    <div class="form-grup col-md-3">
                                        <label>*Correo institucional</label>
                                        <input type="email" class="form-control" id="correoInstCol_1" name="correoInstCol_1">
                                    </div>
                                    <div class="form-grup col-md-3">
                                        <label>Correo alternativo</label>
                                        <input type="email" class="form-control" id="correoAltCol_1" name="correoAltCol_1">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>*Descripción de las principales actividades a desarrollar en el proyecto</label>
                                        <textarea class="form-control" rows="6" style="resize: none;" required id="principalesActCol_1" name="principalesActCol_1"></textarea>
                                    </div>
                                </div>
                                <div id="colaboradores">    
                                </div>            
                                <div class="row">
                                    <div class="col-sm-12" style="background:#000">
                                    </div>
                                </div>
                                <div class="row" id="objetivos">
                                    <h3 class="text-center" style="font-weight: bold;">
                                        Objetivos
                                    </h3>
                                    <div class="col-sm-12 form-group">
                                        <label>
                                            *Indique el objetivo general(No más de 512 caracteres)
                                        </label>
                                        <textarea class="form-control" name="proy13" rows="4" id="objetivoGeneral" readonly>
                                        </textarea>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>
                                            *Establezca los objetivos específicos, científicos y tecnológicos subyacentes en el proyecto(No más de 512 caracteres)
                                        </label>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <textarea class="form-control" name="proy14" rows="4" id="objetivoEspecifico" readonly>
                                        </textarea>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>
                                            *Indique los resultados esperados en términos concretos(No más de 512 Caracteres)
                                        </label>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <textarea class="form-control" name="proy15" rows="4" id="resultados" readonly>
                                        </textarea>
                                    </div>
                                <div class="row">
                                    <div class="col-sm-12" style="background:#000">
                                    </div>
                                </div>
                                </div>
                                            
                                            
                                            
                                <div class="row" id="vinculacion">
                                    <h3 class="text-center" style="font-weight: bold;">
                                        Vinculación
                                    </h3>
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            *Existe convenio:
                                        </label>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            Si
                                        </label>
                                        <input name="" value="t" readonly type="checkbox" id="existe_si">
                                        
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            No
                                        </label>
                                        <input name="" value="f" readonly type="checkbox" id="existe_no">
                                        
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>
                                            *Nombre de la organización
                                        </label>
                                        <input class="form-control" name="proy16" readonly id="nombreOrganizacion" type="text">
                                        
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>
                                            *Dirección
                                        </label>
                                        <input class="form-control" name="proy17" readonly id="direccion" type="text">
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            *Área
                                        </label>
                                        <input class="form-control" name="proy18" readonly id="area" name="" type="text">
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            *Teléfono
                                        </label>
                                        <input class="form-control" readonly id="telefono" name="proy19" type="text">
                                        
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>*Nombre del contacto</label>
                                        <input class="form-control"  id="nombreV" name="proy20" readonly type="text">
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>
                                            *Descripción de la organización(No más de 256 caracteres)
                                        </label>
                                        <textarea class="form-control" readonly id="descripcion_organizacion" name="proy21" rows="5">
                                        </textarea>
                                    </div>
                                    <div class="col-sm-5 form-group">
                                        <label>
                                            *Existen aportaciones financieras o en especie de la vinculación:
                                        </label>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            Si
                                        </label>
                                        <input name="" value="si" readonly type="checkbox" id="aportaciones_si">
                                        
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            No
                                        </label>
                                        <input name="" value="no" readonly type="checkbox" id="aportaciones_no">
                                        
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>
                                            Si la respuesta es si, describa cuales son(No más de 256 caracteres)
                                        </label>
                                        <textarea class="form-control" name="proy22" readonly id="aportaciones" name="" rows="5"></textarea>
                                    </div>
                                <div class="row">
                                    <div class="col-sm-12" style="background:#000">
                                    </div>
                                </div>  
                                </div>

                                <div class="row" id="metas">
                                    <h3 class="text-center" style="font-weight: bold;">
                                        Productos académicos
                                    </h3>
                                    <div class="col-sm-3 form-group">
                                        <input class="form-group" id="servicio" readonly name="proy23" style="margin-left: 18px;" type="checkbox">
                                            <label>
                                                Servicio Social
                                            </label>                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <input class="form-group" id="residencia" readonly name="proy24" style="margin-left: 18px;" type="checkbox">
                                            <label>
                                                Residencia profesional
                                            </label>                                        
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <input class="form-group" name="proy25" readonly id="tesis" style="margin-left: 18px;" type="checkbox" value="t">
                                            <label>
                                                Tesis
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <input class="form-group" name="proy26" readonly id="ponencias" style="margin-left: 18px;" type="checkbox" value="t">
                                            <label>
                                                Ponencias/Conferencias
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-12 form-group"> 
                                        <input class="form-group" name="proy27" readonly id="articulos" style="margin-left: 18px;" type="checkbox" value="t">
                                            <label>
                                                Artículos
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <input class="form-group" name="proy28" readonly id="libros" style="margin-left: 18px;" type="checkbox" value="t">
                                            <label>
                                                Libros/Manuales
                                            </label>
                      
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <input class="form-group" name="" readonly id="propiedad_intelectual" style="margin-left: 18px;" type="checkbox" value="t">
                                            <label>
                                                Propiedad Intelectual
                                            </label>
                           
                                    </div>
                                    <div class="col-sm-1">
                                        <label>
                                            Especificar:
                                        </label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <input class="form-control" name="proy29" readonly id="text_intelectual" style="margin-left: 18px;" type="text">
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <input class="form-group" name="" readonly id="otros" style="margin-left: 18px;" type="checkbox" value="t">
                                            <label>
                                                Otros
                                            </label>
                                       
                                    </div>
                                    <div class="col-sm-1">
                                        <label>
                                            Especificar:
                                        </label>
                                    </div>
                                    <div class="col-sm-7 form-group">
                                        <input class="form-control" name="proy30" readonly id="text_otros" style="margin-left: 18px;" type="text">                              
                                    </div>
                                </div>     


                                 <div id="etapa">
                                        <div class="col-sm-12" style="background:#000">
                                        </div>
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
                                                </div>
                                                <div class="col-sm-1 form-group">
                                                    <label>
                                                        Fecha fin:
                                                    </label>
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <input class="form-control" name="finalEtapa_1" id="finalEtapa_1" style="margin-left: 18px;" require type="date">
                                                </div>
                                                <div class="col-sm-1 form-group">
                                                    <label>
                                                        Meses:
                                                    </label>
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <input class="form-control" name="mesesEtapa_1" id="mesesEtapa_1" style="margin-left: 18px;" require type="number">
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
                                    </div> 
                                    <div class="container col-sm-9" id="etapas">
                                    </div>               

                                <div class="row">
                                    <div class="col-sm-12" style="background:#000">
                                    </div>
                                </div>
                                <div id="financ">
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
                                        <input name="proy31" type="checkbox" value="t" id="financiSi" readonly>
                                        
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            No
                                        </label>
                                        <input name="proy31" type="checkbox" value="f" id="financiNo" disable>            
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
                                        <input name="proy32" type="checkbox" value="t" id="finanInterno" readonly>
                                
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            Externo
                                        </label>
                                        <input name="proy33" type="checkbox" value="t" id="finanExterno" readonly>
                      
                                    </div>
                                    <div class="col-sm-1 form-group">
                                        <label>
                                            Especificar:
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <input id="f_especificar"   class="form-control" name="proy34" style="margin-left: 18px;" type="text" readonly>
               
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
                                        <input class="form-control" readonly id="f_infra" name="proy35" type="number">                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            Consumibles:
                                        </label>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <input id="f_consu" readonly class="form-control" name="proy36" type="number">
                              
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            Licencias:
                                        </label>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <input id="f_lics" readonly class="form-control" name="proy37" type="number">
                           
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            Viáticos:
                                        </label>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <input id="f_viatic" readonly class="form-control" name="proy38" type="number">
                             
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            Publicaciones:
                                        </label>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <input id="f_publica" readonly class="form-control" name="proy39" type="number">
                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            Equipo:
                                        </label>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <input id="f_equipo" readonly class="form-control" name="proy40" type="number">
                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            Patentes/derechos de autor:
                                        </label>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <input id="f_patents" readonly class="form-control" name="proy41" type="number">
                              
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            Otros(Especifique):
                                        </label>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <input id="f_otros_especif" readonly class="form-control" name="proy42" type="number"> 
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Desglosar: </label>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <input type="text" id="otro_especificar" readonly name="proy43" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            Total:
                                        </label>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <input class="form-control" id="f_total" name="proy44" readonly type="number">    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" style="background:#000">
                                    </div>
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
                                                    <input class="form-control" readonly type="text" id="nombreAlumnoCol_1" name="nombreAlumnoCol_1" size="15">
                                                    </div>
                                                    <div class="col-lg-6"><label>*Apellido Paterno</label>
                                                    <input class="form-control" readonly type="text" id="apPaternoAlumnoCol_1" name="apPaternoAlumnoCol_1" size="15">
                                                    </div>
                                                    <div class="col-lg-6"><label>*Apellido Materno</label>
                                                    <input class="form-control" type="text" id="apMaternoAlumnoCol_1" readonly name="apMaternoAlumnoCol_1" size="15">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>*N° control</label>
                                                        <input type="text" readonly id="noControlAlumnoCol_1" name="noControlAlumnoCol_1" class="form-control" maxlength="9">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="col-lg-4">*Carrera</label>
                                                            <input type="text" class="col-lg-8 form-control" name="cboCarreraAlumno_1" id="cboCarreraAlumno_1" readonly>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>*Semestre</label>
                                                            <input type="text" name="cboSemestreAlumnoCol_1" id="cboSemestreAlumnoCol_1" class="form-control">
                                                    </div>                                                    

                                                    <div class="row text-center">
                                                        <div class="form-group col-md-2">
                                                            <label><input type="checkbox" id="alumno_servicio_1" name="alumno_servicio_1" readonly style="margin-top: 35px;">S.S</label>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label><input type="checkbox" id="alumno_residencia_1" readonly name="alumno_residencia_1" style="margin-top: 35px;">R.P</label>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label><input type="checkbox" id="alumno_tesis_1" name="alumno_tesis_1" readonly style="margin-top: 35px;">T</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">                                       
                                                <div class="form-group col-md-12">
                                                    <div class="col-lg-12">
                                                        <label>Descripción de las principales actividades a desarrollar en el proyecto</label>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control col-md-10 col-lg-10" name="actividadesAlumnoCol_1" id="actividadesAlumnoCol_1" cols="90" rows="5" maxlength="256" readonly></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                                <div id="alumnos">
                                </div>                   
                            </div>

                  <div class="col-lg-4" role="complementary">
                                            <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs ">
                                                <ul class="nav bs-docs-sidenav">
                                                    <div class="container" id="navObserv">
                                                        <div id="panel_obs_com" class="panel panel-primary panel-default">
                                                            <div class="panel-heading">
                                                                <h5 class="panel-title">
                                                                    Observaciones del Consejo de Investigación
                                                                </h5>
                                                                <span id="span_obs_com" class="pull-right clickable panel-collapsed">
                                                                    <i class="glyphicon glyphicon-chevron-down">
                                                                    </i>
                                                                </span>
                                                            </div>
                                                            <div class="panel-body" style="display: none;">
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#inicioP" style="color: #337ab7">
                                                                        Proyecto
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea id="obsCom_1" class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>
                                                                        <br>
                                                                            <br>
                                                              
                                                                    </div>
                                                                </li>
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#responsable" style="color: #337ab7">
                                                                        Responsable
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea id="obsCom_2" class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>
                                                                        <br>
                                                                            <br>
                                                       
                                                                    </div>
                                                                </li>
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#colaborador" style="color: #337ab7">
                                                                        Colaboradores
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea id="obsCom_3" class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>
                                                                        <br>
                                                                            <br>
                                                                
                                                                    </div>
                                                                </li>
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#objetivos" style="color: #337ab7">
                                                                        Objetivos
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea id="obsCom_4" class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>
                                                                        <br>
                                                                            <br>                                                           
                                                                    </div>
                                                                </li>
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#vinculacion" style="color: #337ab7">
                                                                        Vinculación
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea id="obsCom_5" class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>
                                                                        <br>
                                                                            <br>
                                                             
                                                                    </div>
                                                                </li>
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#metas" style="color: #337ab7">
                                                                        Metas
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea id="obsCom_6" class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>
                                                                        <br>
                                                                            <br>
                                                         
                                                                    </div>
                                                                </li>
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#etapas" style="color: #337ab7">
                                                                        Etapas
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea id="obsCom_7" class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>
                                                                        <br>
                                                                            <br>
                                                          
                                                                    </div>
                                                                </li>
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#financ" style="color: #337ab7">
                                                                        Financiamiento
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea id="obsCom_8" class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>
                                                                        <br>
                                                                            <br>
                                                        
                                                                    </div>
                                                                </li>
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#alums" style="color: #337ab7">
                                                                        Alumnos
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea id="obsCom_9" class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>
                                                                        <br>
                                                                            <br>
                                                          
                                                                    </div>
                                                                </li>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </ul>
                                            </nav>
                    </div>

    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <div class="col-lg-4" role="complementary">
                        <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs ">
                            <ul class="nav bs-docs-sidenav">
                                <div class="container" id="navObserv">
                                    <div id="panel_obs_ges" class="panel panel-primary panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                Observaciones de Oficina de Seguimiento de Proyectos de Investigación
                                            </h5>
                                            <span id="span_obs_gest" class="pull-right clickable panel-collapsed">
                                                <i class="glyphicon glyphicon-chevron-down">
                                                </i>
                                            </span>
                                        </div>
                                        <div class="panel-body" style="display: none;">
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#inicioP" style="color: #337ab7">
                                                    Proyecto
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsGes_1" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                               
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#responsable" style="color: #337ab7">
                                                    Responsable
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsGes_2" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                               
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#colaborador" style="color: #337ab7">
                                                    Colaboradores
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsGes_3" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                                
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#objetivos" style="color: #337ab7">
                                                    Objetivos
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsGes_4" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                             
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#vinculacion" style="color: #337ab7">
                                                    Vinculación
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsGes_5" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                        
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#metas" style="color: #337ab7">
                                                    Metas
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsGes_6" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                           
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#etapa" style="color: #337ab7">
                                                    Etapas
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsGes_7" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                                  
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#financ" style="color: #337ab7">
                                                    Financiamiento
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsGes_8" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                         
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#alumno" style="color: #337ab7">
                                                    Alumnos
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsGes_9" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                             
                                                </div>
                                            </li>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </nav>
                    </div>

    <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

                    <div class="col-lg-4" role="complementary">
                        <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs ">
                            <ul class="nav bs-docs-sidenav">
                                <div class="container" id="navObserv">
                                    <div id="panel_obs_inv" class="panel panel-primary panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                Observaciones de Subdirección de Investigación y Posgrado
                                            </h5>
                                            <span id="span_obs_inv" class="pull-right clickable panel-collapsed">
                                                <i class="glyphicon glyphicon-chevron-down">
                                                </i>
                                            </span>
                                        </div>
                                        <div class="panel-body" style="display: none;">
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#inicioP" style="color: #337ab7">
                                                    Proyecto
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsInv_1" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                          
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#responsable" style="color: #337ab7">
                                                    Responsable
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsInv_2" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                       
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#colaborador" style="color: #337ab7">
                                                    Colaboradores
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsInv_3" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                          
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#objetivos" style="color: #337ab7">
                                                    Objetivos
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsInv_4" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                              
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#vinculacion" style="color: #337ab7">
                                                    Vinculación
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsInv_5" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                    <br>
                                  
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#metas" style="color: #337ab7">
                                                    Metas
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsInv_6" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                 
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#etapa" style="color: #337ab7">
                                                    Etapas
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsInv_7" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                            
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#financ" style="color: #337ab7">
                                                    Financiamiento
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsInv_8" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                          
                                                </div>
                                            </li>
                                            <li class="">
                                                <a class="accordion col-lg-4" href="#alumno" style="color: #337ab7">
                                                    Alumnos
                                                </a>
                                                <div class="panel2">
                                                    <textarea id="obsInv_9" class="form-control" name="" rows="5" style="resize:none">
                                                    </textarea>
                                                    <br>
                                                        <br>
                                        
                                                </div>
                                            </li>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </nav>
                        <div class="col-lg-12">
                        <input  id="btnEnvSub" name="btnEnvSub" class="btn btn-primary btn-block" type="submit" onclick="Enviar2(form.id)" value="Enviar revisión a S.I.P.">
                        <button data-dismiss="modal" href="" class="btn btn-default btn-block">
                            Cerrar
                        </button>
                        </div>
                    </div>            
                    </div>                        
                    </div>
                </div>
               </div>
            </form>   

        <div class="modal-footer">
        </div>
        </div>       
      </div>
    </div>
