<script>
    $(document).ready(function(){
    //$('#btnEnvSub').attr('disabled', true);
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
                    <h1 style="text-align: center;" id="prorroga_text">Solicitudes de Prórroga</h1>
                </div>
                <div class="panel-body">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>No. solicitud</th>
                                <th>Docente responsable</th>
                                <th>Nombre proyecto</th>
                                <th>Etapa</th>
                                <th>Fecha de solicitud</th>
                                <th>Fecha de entrega del reporte</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $res = $miConn->todosProyectosGIC();
                            $cont = 1;
                            while($r = pg_fetch_array($res)){
                                $estado= $miConn->consultarEstadoProyecto($r[2]);
                                if($estado != 'EN PRORROGA COM.' || $estado == 'EN PRORROGA' || $estado == 'EN PRORROGA INV.'){
                                    echo "<center><h1 class='text-info'>NO HAY SOLICITUDES DE PRÓRROGA EN ESTE MOMENTO</h1></center>";
                                }else{
                                echo "<tr>";
                                echo "<td>".$cont."</td>";                                
                                echo "<td>FRANCISCO TORRES</td>";
                                echo "<td>".$r[0]."</td>";
                                echo "<td>".$r['etapa_solicitada']."</td>";
                                echo "<td>".$r['fecha_solicitud']."</td>";
                                echo "<td>30/10/2018</td>";
                                if($estado == 'EN PRORROGA COM.'){
                                    echo "<td><button class='btn btn-primary' data-target='#myModal' data-toggle='modal' onclick='ajaxProrrogaConsultas(this.id)' id='".$r[2]."' name='".$r[2]."' type='submit' method='POST' value='".$r[2]."'/>Revisar</button></td>";    
                                }else{ //if ($estado == 'EN PRORROGA C-I.'){
                                    echo "<td><button class='btn btn-info' disabled data-target='#myModal' data-toggle='modal' onclick='ajaxProrrogaConsultas(this.id)' id='".$r[2]."' name='".$r[2]."' type='submit' method='POST' value='".$r[2]."'/>Enviado</button></td>";    
                                }
                                }
                                echo "</tr>";    
                                $cont++;
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
                            <form id="observacionesI_prorroga" name="observacionesI_prorroga" method="POST" onsubmit="SolicitudEnviada(this.id)">
                                <input type="hidden" name="accion" value="observacionesC_prorroga">
                                <input type="hidden" name="folio_pr" id="folio_pr">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal" type="button">
                                    ×
                                </button>
                                <h4 class="modal-title" style="text-align: center;">
                                    Solicitud de Prórroga
                                </h4>
                            </div>
                            <div class="modal-body">
                                    <div class="container">
                                        <div class="col-lg-12">
                                            <div class="col-lg-8 well">
                                                    <div class="row">
                                                        <div class="col-sm-4 form-group">
                                                            <label>
                                                                Proyecto
                                                            </label>
                                                            <input readonly class="form-control" id="proyecto" name="" type="text">
                                                            
                                                        </div>
                                                        <div class="col-sm-3 form-group">
                                                            <label>
                                                                Docente responsable
                                                            </label>
                                                            <input readonly class="form-control" value="FRANCISCO TORRES" id="docente" name="" type="text">
                                                            
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <label>Etapa</label>
                                                             <input readonly type="numner" class="form-control" id="etapa" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>
                                                            Motivos por lo cual solicita la prórroga
                                                        </label>
                                                        <textarea class="form-control" readonly id="motivo" rows="4">
                                                        </textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Razones por lo cual solicita la prórroga</label>
                                                        <textarea class="form-control" rows="4" id="razones" readonly></textarea>
                                                    </div>
                                            </div>
                                            <div class="col-lg-4" role="complementary">
                                                <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
                                                    <ul class="nav bs-docs-sidenav">
                                                        <div class="container" id="navObserv">
                                                            <h3>
                                                                Observaciones
                                                            </h3>
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
                                                                        <a class="accordion col-lg-4" style="color: #337ab7">
                                                                            Proyecto
                                                                        </a>
                                                                        <div class="panel2">
                                                                            <textarea required class="form-control" id="realizar_obs" name="realizar_obs" rows="5" style="resize:none"></textarea>                                      
                                                                        </div>
                                                                    </li>
                                                                </div>
                                                            </div>
                                                            <div class="panel panel-primary panel-default" id="navObserv">
                                                                <div class="panel-heading">
                                                                    <h5 class="panel-title">
                                                                        Oficina de Seguimiento de Proyectos de Invest.
                                                                    </h5>
                                                                    <span class="pull-right clickable panel-collapsed">
                                                                        <i class="glyphicon glyphicon-chevron-down">
                                                                        </i>
                                                                    </span>
                                                                </div>
                                                                <div class="panel-body" style="display: none;">
                                                                    <li class="">
                                                                        <a class="accordion col-lg-4" style="color: #337ab7">Proyecto</a>
                                                                        <div class="panel2">
                                                                            <textarea readonly class="form-control" id="obs_prG" name="" rows="5" style="resize:none"></textarea>
                                                                            
                                                                        </div>
                                                                    </li>
                                                                </div>
                                                            </div>
                                                            <div class="panel panel-primary panel-default" id="navObserv">
                                                                <div class="panel-heading">
                                                                    <h5 class="panel-title">
                                                                        Observaciones de Subdirección de Investigación
                                                                    </h5>
                                                                    <span class="pull-right clickable panel-collapsed">
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
                                                                            <textarea readonly class="form-control" id="obs_prI" name="" rows="5" style="resize:none"></textarea>
                                                                            
                                                                        </div>
                                                                    </li>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-default" onclick="cancelar()" type="button">
                                    Cancelar
                                </button>
                                <button class="btn btn-info" id="enviar_comite" name="enviar_invest" type="submit" type="button">
                                    Enviar a Subdirección de Investigación y Posgrado
                                </button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>