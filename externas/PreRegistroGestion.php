<script>
    $(document).ready(function(){
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
                            <h2 class="text-center" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">Revisión de Pre-Registro</h2>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>N° de solicitud</th>
                                        <th>Nombre del proyecto</th>
                                        <th>Nombre del docente</th>
                                        <th>Fecha</th>
                                        <th>Revisión N°</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $res = $miConn->todosProyectos();
                                        $cont = 1;
                                        while($r = pg_fetch_array($res)){
                                            echo "<tr>";
                                            echo "<td>".$cont."</td>";
                                            echo "<td>".$r[0]."</td>";
                                            echo "<td>FRANCISCO TORRES</td>";
                                            echo "<td>".$r[1]."</td>";
                                            echo "<td>1</td>";
                                            echo "<td><button class='btn btn-primary' data-target='#myModal' data-toggle='modal' onclick='ajaxPreregistroConsultas(this.id)' id='".$r[2]."' name='".$r[2]."' type='submit' method='POST' value='".$r[2]."'/>Ver proyecto</button></td>";
                                            echo "</tr>";                                            
                                            $folio = $r[2];
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
            <div class="modal fade" id="myModal" role="dialog" style="display: none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title" style="text-align: center;">Pre-Registro</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" class="ng-pristine ng-valid" method="get">
                            <div class="container" style="margin-top: 0;">
                                    <div class="col-lg-12" style="margin-top: 10px;">
                                        <div class="col-lg-8 well">
                                <div class="row"> 
                                    <?php 
                                    ?> 
                                    <h3 class="text-center" style="font-weight: bold;">
                                        Proyecto
                                    </h3>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            *Fecha de presentación
                                        </label>
                                        <input class="form-control" name="" required="" type="date">
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            *Convocatoria CPR
                                        </label>
                                        <input class="form-control" name="" required="" type="text">
                                        
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
                                        
                                    </div>
                                    <div class="col-sm-2">
                                        <input name="Aplicada" type="checkbox">
                                            <label>
                                                Publico
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-3">
                                        <input name="Aplicada" type="checkbox">
                                            <label>
                                                Social
                                            </label>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input name="Aplicada" type="checkbox">
                                            <label>
                                                B. Desarrollo experimental
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-2">
                                        <input name="Aplicada" type="checkbox">
                                            <label>
                                                Privado
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-3">
                                        <input name="Aplicada" type="checkbox">
                                            <label>
                                                Productivo
                                            </label>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input name="Aplicada" type="checkbox">
                                            <label>
                                                C. Investigación básica
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-2">
                                        <input name="Aplicada" type="checkbox">
                                            <label>
                                                Educativo
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-3">
                                        <input name="Aplicada" type="checkbox">
                                            <label>
                                                Otro
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-9 form-group">
                                        <label>
                                            *Especifique
                                        </label>
                                        <input class="form-control" name="" required="" type="text">
                                        
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
                                        
                                    </div>
                                    <div class="col-sm-9">
                                        <input name="02" type="checkbox">
                                            <label>
                                                LIIADT-02 Computo intensivo
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-9">
                                        <input name="03" type="checkbox">
                                            <label>
                                                LIIADT-03 Sistemas inteligentes de automatización
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-9">
                                        <input name="04" type="checkbox">
                                            <label>
                                                LIIADT-04 Desarrollo de tecnología e innovación
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-9">
                                        <input name="05" type="checkbox">
                                            <label>
                                                LIIADT-05 Control y automatización
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-9">
                                        <input name="06" type="checkbox">
                                            <label>
                                                LIIADT-06 Desarrollo e innovación en tecnologías de producción
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-9">
                                        <input name="07" type="checkbox">
                                            <label>
                                                LIIADT-07 Desarrollo e innovación de productos biotecnológicos y tecnológicos
                                            </label>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <label>
                                            *Nombre del proyecto
                                        </label>
                                        <input class="form-control" name="" required="" type="text">
                                        
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
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            *Fin
                                        </label>
                                        <input class="form-control" name="" required="" type="date">
                                        
                                    </div>
                                    <div class="col-sm-12" style="background:#000">
                                    </div>
                                </div>






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




                                                                            <h3 class="text-center" style="font-weight: bold;">
                                    Colaborador
                                </h3>
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Apellido paterno
                                        </label>
                                        <input class="form-control" required="" type="text">
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Apellido materno
                                        </label>
                                        <input class="form-control" required="" type="text">
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Nombre(s)
                                        </label>
                                        <input class="form-control" required="" type="text">
                                    
                                    </div>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>
                                        Grado máximo de estudios
                                    </label>
                                    <input class="form-control" required="" type="text">
                                
                                </div>
                                <div class="col-sm-8 form-group">
                                    <label>
                                        Academia a la que pertenece
                                    </label>
                                    <input class="form-control" required="" type="text">
                            
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 form-group">
                                    <label>
                                        No. Personal
                                    </label>
                                    <input class="form-control" required="" type="text">
                                    
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>
                                        Móvil
                                    </label>
                                    <input class="form-control" pattern="^\d{10}$" required="" type="text">
                                    
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>
                                        Correo
                                    </label>
                                    <input class="form-control" required="" type="email">
                            
                                </div>
                                    <div class="col-sm-3 form-group">
                                    <label>
                                        Correo alternativo
                                    </label>
                                    <input class="form-control" required="" type="email">
                            
                                </div>
                                </div>                                
                                <div class="col-sm-12 form-group">
                                    <label>
                                        *Descripción de las principales actividades a desarrollar en el proyecto
                                    </label>
                                    <textarea class="form-control" rows="5">
                                    </textarea>
                                </div>             
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
                                        <textarea class="form-control" rows="4">
                                        </textarea>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>
                                            *Establezca los objetivos específicos, científicos y tecnológicos subyacentes en el proyecto(No más de 512 caracteres)
                                        </label>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <textarea class="form-control" rows="4">
                                        </textarea>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>
                                            *Indique los resultados esperados en términos concretos(No más de 512 Caracteres)
                                        </label>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <textarea class="form-control" rows="4">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" style="background:#000">
                                    </div>
                                </div>
                                            
                                            
                                            
                                <div class="row">
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
                                        <input name="" type="checkbox">
                                        
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            No
                                        </label>
                                        <input name="" type="checkbox">
                                        
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>
                                            *Nombre de la organización
                                        </label>
                                        <input class="form-control" name="" type="text">
                                        
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>
                                            *Dirección
                                        </label>
                                        <input class="form-control" name="" type="text">
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            *Área
                                        </label>
                                        <input class="form-control" name="" type="text">
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            *Teléfono
                                        </label>
                                        <input class="form-control" name="" type="text">
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            *Nombre del contacto
                                        </label>
                                        <input class="form-control" name="" type="text">
                                        
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>
                                            *Descripción de la organización(No más de 256 caracteres)
                                        </label>
                                        <textarea class="form-control" name="" rows="5">
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
                                        <input name="" type="checkbox">
                                        
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            No
                                        </label>
                                        <input name="" type="checkbox">
                                        
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>
                                            Si la respuesta es si, describa cuales son(No más de 256 caracteres)
                                        </label>
                                        <textarea class="form-control" name="" rows="5">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" style="background:#000">
                                    </div>
                                </div>
    
    
    
    
    
                                <div class="row">
                                    <h3 class="text-center" style="font-weight: bold;">
                                        Productos academicos
                                    </h3>
                                    <div class="col-sm-3 form-group">
                                        <input class="form-group" name="" style="margin-left: 18px;" type="checkbox">
                                            <label>
                                                Servicio Social
                                            </label>                                        
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <input class="form-group" name="" style="margin-left: 18px;" type="checkbox">
                                            <label>
                                                Residencia profesional
                                            </label>                                        
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <input class="form-group" name="" style="margin-left: 18px;" type="checkbox">
                                            <label>
                                                Tesis
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <input class="form-group" name="" style="margin-left: 18px;" type="checkbox">
                                            <label>
                                                Ponencias/Conferencias
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <input class="form-group" name="" style="margin-left: 18px;" type="checkbox">
                                            <label>
                                                Artículos
                                            </label>
                                        
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <input class="form-group" name="" style="margin-left: 18px;" type="checkbox">
                                            <label>
                                                Libros/Manuales
                                            </label>
                      
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <input class="form-group" name="" style="margin-left: 18px;" type="checkbox">
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
                                        <input class="form-control" name="" style="margin-left: 18px;" type="text">
                                        
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <input class="form-group" name="" style="margin-left: 18px;" type="checkbox">
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
                                        <input class="form-control" name="" style="margin-left: 18px;" type="text">
                                
                                    </div>
                                </div>
                                            <div class="row">
                                    <div class="col-sm-12" style="background:#000">
                                    </div>
                                </div>
    
    
    
    
                                                    <h1 class="text-center" style="font-weight: Yu Gothic UI Light; margin-top: 2px">
                                    Etapa
                                </h1>
                                <div class="row">
                                    <div class="col-sm-3 form-group">
                                        <label>
                                            Nombre de la etapa:
                                        </label>
                                    </div>
                                    <div class="col-sm-5 form-group">
                                        <input class="form-control" name="" style="margin-left: 18px;" type="text">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Fecha de inicio:
                                        </label>
                                        <input class="form-control" name="" type="date">
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Fecha de fin:
                                        </label>
                                        <input class="form-control" name="" type="date">
                                        
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Total de meses:
                                        </label>
                                        <input class="form-control" name="" type="text">
                     
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
                  
                                    </div>
                                </div>
                                            <div class="row">
                                                <div class="col-sm-12 form-group">
                                                    <label>
                                                        Metas
                                                    </label>
                                                    <textarea class="form-control" rows="4">
                                                    </textarea>
                                                </div>                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label>
                                                        Actividades
                                                    </label>
                                                    <textarea class="form-control" rows="4">
                                                    </textarea>
                                                </div>                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label>
                                                        Productos
                                                    </label>
                                                    <textarea class="form-control" rows="4">
                                                    </textarea>
                                                </div>                                                
                                            </div>                  

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
                                        
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            No
                                        </label>
                                        <input name="" type="checkbox">
                                      
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
                                
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>
                                            Externo
                                        </label>
                                        <input name="" type="checkbox">
                      
                                    </div>
                                    <div class="col-sm-1 form-group">
                                        <label>
                                            Especificar:
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <input class="form-control" name="" style="margin-left: 18px;" type="text">
               
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
                                      
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" style="background:#000">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5>
                                            <b>
                                                *
                                            </b>
                                            S.S.= Servicio Social, R.P.= Residencia Profesional, T= Tesis
                                        </h5>
                                        
                <!---------------------------------------------------------------------------------------------------------------------------->
                                        <div class="row">
                                            <h3 class="text-center" style="font-weight: bold; margin-bottom: 9px;">
                                                Alumno Colaborador 
                                            </h3>
                                            <div class="col-sm-2 form-group">
                                                <label>
                                                    Nombre del Alumno:
                                                </label>
                                            </div>
                                            <div class="col-md-7 form-group">
                                                <input class="form-control" name="" type="text">
                            
                                            </div>
                                            <div class="col-sm-1 form-group">
                                                <label>
                                                    S.S.
                                                </label>
                                                <input class="form-group" name="" type="checkbox">
                                   
                                            </div>
                                            <div class="col-sm-1 form-group">
                                                <label>
                                                    R.P.
                                                </label>
                                                <input class="form-group" name="" type="checkbox">
                               
                                            </div>
                                            <div class="col-sm-1 form-group">
                                                <label>
                                                    T
                                                </label>
                                                <input class="form-group" name="" type="checkbox">
                                     
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2 form-group">
                                                <label>
                                                    No. Control
                                                </label>
                                            </div>
                                            <div class="col-sm-3 form-group">
                                                <input class="form-control" name="" type="text">
                                              
                                            </div>
                                            <div class="col-sm-1 form-group">
                                                <label>
                                                    Semestre:
                                                </label>
                                            </div>
                                            <div class="col-sm-2 form-group">
                                                <input class="form-control" name="" type="text">
                                    
                                            </div>
                                            <div class="col-sm-1 form-group">
                                                <label>
                                                    Carrera
                                                </label>
                                            </div>
                                            <div class="col-sm-3 form-group">
                                                <input class="form-control" name="" type="text">
                                   
                                            </div>
                                            <div class=" col-sm-12 form-group">
                                                <label>
                                                    Detalle de Actividades
                                                </label>
                                                <textarea class="form-control" rows="3">
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
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
                                                                    <a class="accordion col-lg-4" href="#inicioP" style="color: #337ab7">
                                                                        Proyecto
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>
                                                                    </div>
                                                                </li>
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#recep" style="color: #337ab7">
                                                                        Recepción
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>

                                                                    </div>
                                                                </li>
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#colab1" style="color: #337ab7">
                                                                        Colaboradores
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>

                                                                    </div>
                                                                </li>
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#objetivos" style="color: #337ab7">
                                                                        Objetivos
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>

                                                                    </div>
                                                                </li>
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#vinculacion" style="color: #337ab7">
                                                                        Vinculación
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>

                                                                    </div>
                                                                </li>
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#metas" style="color: #337ab7">
                                                                        Metas
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>

                                                                    </div>
                                                                </li>
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#etapa1" style="color: #337ab7">
                                                                        Etapas
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>

                                                                    </div>
                                                                </li>
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#financ" style="color: #337ab7">
                                                                        Financiamiento
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>

                                                                    </div>
                                                                </li>
                                                                <li class="">
                                                                    <a class="accordion col-lg-4" href="#al1" style="color: #337ab7">
                                                                        Alumnos
                                                                    </a>
                                                                    <div class="panel2">
                                                                        <textarea class="form-control" name="" rows="5" style="resize:none">
                                                                        </textarea>

                                                                    </div>
                                                                </li>
                                                            </div>
                                                        </div>                                                        
                                                    </div>
                                                </ul>
                                                <div class="col-lg-12" >
                                                <a href="#" onclick="EnviarSubdireccion();" class="btn btn-primary btn-block">Enviar revisión a SI.P</a> 
                                                <a href="#" onclick="RegresarDocente();" class="btn btn-info btn-block">Regresar revisión a D.R</a>
                                                <a data-dismiss="modal" href="" class="btn btn-default btn-block">Cerrar</a>
                                            </div>
                                            </nav>                                            
                                        </div>                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>            
        </div>
