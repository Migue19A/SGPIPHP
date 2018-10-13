 <script type="text/javascript">
    $(document).on('click', '.panel-heading span.clickable', function(e)
    {
        var $this = $(this);
        if(!$this.hasClass('panel-collapsed')) 
            {
              $this.parents('.panel').find('.panel-body').slideUp();
              $this.addClass('panel-collapsed');
              $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
            } 
            else 
            {
              $this.parents('.panel').find('.panel-body').slideDown();
              $this.removeClass('panel-collapsed');
              $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
            }
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
                                if($estado == 'EN PRORROGA' || $estado == 'EN PRORROGA INV.' || $estado == 'EN PRORROGA COM.'){
                                    echo "<tr>";
                                    echo "<td>".$cont."</td>";                                
                                    echo "<td>FRANCISCO TORRES</td>";
                                    echo "<td>".$r[0]."</td>";
                                    echo "<td>".$r['etapa_solicitada']."</td>";
                                    echo "<td>".$r['fecha_solicitud']."</td>";
                                    echo "<td>30/10/2018</td>";
                                    if($estado == 'EN PRORROGA'){
                                        echo "<td><button class='btn btn-primary' data-target='#myModal' data-toggle='modal' onclick='ajaxProrrogaConsultas(this.id)' id='".$r[2]."' name='".$r[2]."' type='submit' method='POST' value='".$r[2]."'/>Revisar</button></td>";    
                                    }else{ //if ($estado == 'EN PRORROGA INV.'){
                                        echo "<td><button class='btn btn-info' disabled data-target='#myModal' data-toggle='modal' onclick='ajaxProrrogaConsultas(this.id)' id='".$r[2]."' name='".$r[2]."' type='submit' method='POST' value='".$r[2]."'/>Enviado</button></td>";    
                                    }
                                
                                    echo "</tr>";                                    
                                }else{
                                    echo "<center><h1 class='text-info'>NO HAY SOLICITUDES DE PRÓRROGA EN ESTE MOMENTO</h1></center>";
                                
                                } 
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <form id="observacionesG_prorroga" name="observacionesG_prorroga" method="POST" onsubmit="SolicitudEnviada(this.id)">
                <input type="hidden" name="accion" value="observacionesG_prorroga">
                <input type="hidden" name="folio_pr" id="folio_pr">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title" style="text-align: center;">Solicitud de Prórroga</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group col-md-12">
                            <label>Proyecto</label>
                            <input type="text" class="form-control" id="proyecto" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Docente</label>
                            <input type="text" value="FRANCISCO TORRES" class="form-control" id="docente" readonly>
                        </div>
                        <div class="form-group col-md-1">
                            <label>Etapa</label>
                             <input type="numner" class="form-control" id="etapa" readonly>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Motivo</label>
                            <input type="text" name="" id="motivo" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Razones por lo cual solicita la prórroga</label>
                            <textarea class="form-control" rows="4" id="razones" disabled></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <h4 style="text-align: center;">Relizar observaciones</h4>
                            <textarea class="form-control" required rows="4" id="realizar_obs" name="realizar_obs"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cerrar</button>
                    <button class="btn btn-primary" type="submit">Enviar a investigación</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>