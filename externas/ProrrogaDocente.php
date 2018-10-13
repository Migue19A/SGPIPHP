<script type="text/javascript">
    $(document).ready(function(){
        $('#solicita_prorroga').prop('disabled', 'disabled');
             
    });

</script>

<div class="container" style="margin-top: 15px;">
            <div class="col-md-9">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="padding-bottom: 50px;">
                            <h3 style="text-align: center;" id="prorroga_text">Solicitud de prórroga</h3>
                            <div class="form-group col-md-12">
                                <select class="form-control" id="select_prorroga" name="select_prorroga", onchange="ajaxProrrogaConsultas(this.id)">
                                    <option>Seleccione un proyecto</option>
                                    <?php 
                                        $res = $miConn->todosProyectos();
                                        while($r = pg_fetch_array($res)){
                                            echo "<option value='".$r[2]."'>".$r[0]."</option>";       
                                        }
                                    ?>   
                                </select>                            
                            </div>                            
                        </div>
                        <div class="panel-body">
                            <h1 style="text-align: center;"><b>¡ATENCIÓN!</b></h1>
                            <div class="form-group col-md-12">
                                <h3 style="text-align: center;">La solicitud debe ser hasta antes de los tres días hábiles previos a la fecha de entrega.</h3>                                    
                            </div>    
                            <div class="form-group col-md-2" >
                                <label>Proxima entrega</label>
                                <input type="text" id="fecha_entrega" name="entrega_proxima" class="form-control" readonly>
                            </div>
                            <button id="solicita_prorroga" class="btn btn-primary" data-target="#myModal" data-toggle="modal" type="button" style="float: right;">Solicitar prórroga</button>  
                        </div>                                                
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">                        
                        <form id="form_prorroga" name="form_prorroga" class="container" method="POST" style="margin-left: 10px; width: 100%;" onsubmit="SolicitudEnviada(this.id);">
                        <input type="hidden" name="folio_proy", id="folio_proy">
                        <input type="hidden" name="accion" id="accion" value="form_prorroga">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" type="button">
                                ×
                            </button>
                            <h4 align="center" class="modal-title">
                                Solicitud de Prórroga
                            </h4>
                        </div>
                        <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Fecha de solicitud:</label>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <input type="date" class="form-control" name="fecha_solicitud" id="fecha_solicitud" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Nombre del proyecto:</label>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <input class="form-control" type="text" name="nombre_proyecto" id="nombre_proyecto" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Etapa:</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="number" class="form-control" name="numero_etapa" id="numero_etapa" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Motivo:</label>
                                    </div>
                                    <div class="form-group col-md-6">                                        
                                        <select class="form-control" id="motivos" name="motivos" onchange="muestraOtros()">
                                            <option>Incapacidad</option>
                                            <option>Desastres naturales</option>
                                            <option>Cuestiones laborales</option>
                                            <option>Otro</option>
                                        </select>
                                        <div id="otros_motivos"></div>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-12">
                                            <label>
                                                *Especifique las razones por las que está solicitando la prórroga (máximo 255 carácteres)
                                            </label>
                                            <textarea id="pr_especifique" name="pr_especifique" required class="form-control" style="resize: none;" rows="6;" maxlength="255"></textarea>                                       
                                        </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" onclick="cancelar()" type="button">
                                Cancelar
                            </button>
                            <button class="btn btn-primary" type="submit">
                                Enviar
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>