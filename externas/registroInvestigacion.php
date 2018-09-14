<?php 
$miConn=new Consultas();
$proyectos=$miConn->getProyectos();
?>
<script src="../../js/registroInvestigacion.js"></script>
<div class="col-md-9" style="margin-top: 14px;">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="text-center" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">Solicitud de Proyectos a Registrar</h1>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Folio del Proyecto</th>
                                <th>Nombre del Proyecto</th>
                                <th>Nombre del Asesor</th>
                                <th>Fecha</th>
                                <th>Revisión N°</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($proyectos as $row) 
                            {?>
                                <tr>
                                    <td><?php echo $row['Numero'] ?></td>
                                    <td><?php echo $row['FolioProyecto'] ?></td>
                                    <td><?php echo $row['Proyecto'] ?></td>
                                    <td><?php echo $row['Nombre'] ?></td>
                                    <td><?php echo $row['FechaPresentacion'] ?></td>
                                    <td><?php echo $row['NoRevision'] ?></td>
                                    <td>
                                        <input class="btn btn-primary" data-target="#myModal" data-toggle="modal" name="" type="button" value="Ver Solicitud" id="<?php echo $row['FolioProyecto'] ?>" onclick="consultarProyecto(this.id)" >
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                                </tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" id="myModal" role="dialog" style="display: none;">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                    <h4 class="modal-title" style="text-align: center;">
                        Reporte
                    </h4>
                    <div class="modal-body">
                        <form action="" class="ng-pristine ng-valid" method="get">
                            <div class="container" style="margin-top: 0;">
                                <div class="col-lg-12 " id="divFormularioRegistro" style="margin-top: 10px;">
                                    <div class="col-lg-8 well">
                                        <div class="row">
                                            <h3 class="text-center" id="inicioP" style="font-weight: bold;">
                                                Proyecto
                                            </h3>
                                            <div class="col-lg-4 form-group">
                                                <label>
                                                    Fecha de presentación
                                                </label>
                                                <input class="form-control" name="" readonly="" type="date">
                                              
                                            </div>
                                            <div class="col-lg-5 form-group">
                                                <label>
                                                    Convocatoria CPR
                                                </label>
                                                <input class="form-control" name="" readonly="" type="text">
                                                
                                            </div>
                                        </div>
                                        <div class="row container col-lg-6">
                                            <div class=" form-group">
                                                <label>
                                                    Tipo de investigación
                                                </label>
                                                <div class="">
                                                    <input name="Aplicada" readonly="" type="checkbox">
                                                        <label>
                                                            A. Investigación aplicada
                                                        </label>
                                                  
                                                </div>
                                                <div class="">
                                                    <input name="Experimental" readonly="" type="checkbox">
                                                        <label>
                                                            B. Desarrollo experimental
                                                        </label>
                                                  
                                                </div>
                                                <div class="">
                                                    <input name="Basica" readonly="" type="checkbox">
                                                        <label>
                                                            C. Investigación básica
                                                        </label>
                                       
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row container col-lg-6">
                                            <div class="form-group">
                                                <label>
                                                    Tipo de Sector
                                                </label>
                                                <div class="">
                                                    <input name="Aplicada" readonly="" type="checkbox">
                                                        <label>
                                                            Publico
                                                        </label>
                                                
                                                </div>
                                                <div class="">
                                                    <input name="Aplicada" readonly="" type="checkbox">
                                                        <label>
                                                            Social
                                                        </label>
                                                  
                                                </div>
                                                <div class="">
                                                    <input name="Aplicada" readonly="" type="checkbox">
                                                        <label>
                                                            Privado
                                                        </label>
                                              
                                                </div>
                                                <div class="">
                                                    <input name="Aplicada" readonly="" type="checkbox">
                                                        <label>
                                                            Productivo
                                                        </label>
                                                    
                                                </div>
                                                <div class="">
                                                    <input name="Aplicada" readonly="" type="checkbox">
                                                        <label>
                                                            Educativo
                                                        </label>
                                                  
                                                </div>
                                                <div class="">
                                                    <input name="Aplicada" readonly="" type="checkbox">
                                                        <label>
                                                            Otro
                                                        </label>
                                                  
                                                </div>
                                                <div class="form-group">
                                                    <label>
                                                        Especifique
                                                    </label>
                                                    <input class="form-control" name="" readonly="" type="text">
                                                    
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-9">
                                                    <label>
                                                        Linea de investigación
                                                    </label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <input name="01" readonly="" type="checkbox">
                                                        <label>
                                                            LIIADT-01 Cómputo en la nube
                                                        </label>
                                                   
                                                </div>
                                                <div class="col-lg-9">
                                                    <input name="02" readonly="" type="checkbox">
                                                        <label>
                                                            LIIADT-02 Cómputo intensivo
                                                        </label>
                                                  
                                                </div>
                                                <div class="col-lg-9">
                                                    <input name="03" readonly="" type="checkbox">
                                                        <label>
                                                            LIIADT-03 Sistemas inteligentes de automatización
                                                        </label>
                                               
                                                </div>
                                                <div class="col-lg-9">
                                                    <input name="04" readonly="" type="checkbox">
                                                        <label>
                                                            LIIADT-04 Desarrollo de tecnologia e innovación
                                                        </label>
                                                   
                                                </div>
                                                <div class="col-lg-9">
                                                    <input name="05" readonly="" type="checkbox">
                                                        <label>
                                                            LIIADT-05 Control y automatización
                                                        </label>
                                                   
                                                </div>
                                                <div class="col-lg-9">
                                                    <input name="06" readonly="" type="checkbox">
                                                        <label>
                                                            LIIADT-06 Desarrollo e innovación en tecnologías de producción
                                                        </label>
                                                    
                                                </div>
                                                <div class="col-lg-9">
                                                    <input name="07" readonly="" type="checkbox">
                                                        <label>
                                                            LIIADT-07 Desarrollo e innovación de productos biotecnológicos y Tecnológicos
                                                        </label>
                                                 
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 form-group">
                                                    <label>
                                                        Nombre del proyecto
                                                    </label>
                                                    <input class="form-control" name="" readonly="" type="text">
                                                    
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label>
                                                        Duración:
                                                    </label>
                                                </div>
                                                <div class="col-lg-4 form-group">
                                                    <label>
                                                        Inicio
                                                    </label>
                                                    <input class="form-control" name="" readonly="" type="date">
                                              
                                                </div>
                                                <div class="col-lg-4 form-group">
                                                    <label>
                                                        Fin
                                                    </label>
                                                    <input class="form-control" name="" readonly="" type="date">
                                                   
                                                </div>
                                                <div class="col-lg-12" style="background:#000">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h3 class="text-center" id="recep" style="font-weight: bold;">
                                                    Recepción
                                                </h3>
                                                <div class="col-lg-5 form-group">
                                                    <label>
                                                        Numero de Recepción
                                                    </label>
                                                    <input class="form-control" readonly="" type="text">
                                                    
                                                </div>
                                                <div class="col-lg-5 form-group">
                                                    <label>
                                                        Fecha de Recepción
                                                    </label>
                                                    <input class="form-control" readonly="" type="date">
                                             
                                                </div>
                                                <div class="col-lg-9" style="text-align: left;">
                                                    <label>
                                                        Recibió
                                                    </label>
                                                </div>
                                                <div class="col-lg-4 form-group">
                                                    <label>
                                                        Nombre(s)
                                                    </label>
                                                    <input class="form-control" readonly="" type="text">
                                                  
                                                </div>
                                                <div class="col-lg-5 form-group">
                                                    <label>
                                                        Firma
                                                    </label>
                                                    <input class="form-control" readonly="" type="text">
                                                
                                                </div>
                                                <div class="col-lg-3 form-group">
                                                    <label>
                                                        Sello
                                                    </label>
                                                    <input class="form-control" readonly="" style="height: 150px" type="text">
                                                   
                                                </div>
                                            </div>
                                            <div class="col-lg-12" style="background:#000">
                                            </div>
                                            <div class="row">
                                                <h3 class="text-center" style="font-weight: bold;">
                                                    Responsable
                                                </h3>
                                                <div class="col-lg-4 form-group">
                                                    <label>
                                                        Apellido paterno
                                                    </label>
                                                    <input class="form-control" readonly="" type="text">
                                                
                                                </div>
                                                <div class="col-lg-4 form-group">
                                                    <label>
                                                        Apellido materno
                                                    </label>
                                                    <input class="form-control" readonly="" type="text">
                                                  
                                                </div>
                                                <div class="col-lg-4 form-group">
                                                    <label>
                                                        Nombre(s)
                                                    </label>
                                                    <input class="form-control" readonly="" type="text">
                                                 
                                                </div>
                                                <div class="col-lg-6 form-group">
                                                    <label>
                                                        Grado máximo de estudios:
                                                    </label>
                                                    <input class="form-control" readonly="" style="width:100%;" type="text">
                                                 
                                                </div>
                                                <div class="col-lg-6 form-group">
                                                    <label>
                                                        Academia a la que pertenece
                                                    </label>
                                                    <input class="form-control" readonly="" type="text">
                                                   
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        No. de personal
                                                    </label>
                                                    <input class="form-control" readonly="" type="text">
                                                   
                                                </div>
                                                <div class="col-lg-3 form-group">
                                                    <label>
                                                        Móvil
                                                    </label>
                                                    <input class="form-control" readonly="" type="text">
                                                   
                                                </div>
                                                <div class="col-lg-3" form-group="">
                                                    <label>
                                                        Correo institucional
                                                    </label>
                                                    <input class="form-control" readonly="" type="text">
                                                    
                                                </div>
                                                <div class="col-lg-4" form-group="">
                                                    <label>
                                                        Correo alternativo
                                                    </label>
                                                    <input class="form-control" readonly="" type="text">
                                                    
                                                </div>
                                                <div class="col-lg-12" form-group="">
                                                    <label>
                                                        Firma del responsable del proyecto
                                                    </label>
                                                    <input class="form-control" readonly="" type="text">
                                                    
                                                </div>
                                                <div class="col-lg-12" form-group="">
                                                    <label>
                                                        Descripción de las principales actividades a desarrollar en el proyecto
                                                    </label>
                                                </div>
                                                <div class="col-lg-12" form-group="">
                                                    <input class="form-control" readonly="" style="height: 150px;" tabindex="4" type="text">
                                           
                                                </div>
                                                <div class="col-lg-3 form-group">
                                                    <label>
                                                        Palabras clave:
                                                    </label>
                                                </div>
                                                <div class="col-lg-3 form-group">
                                                    <label>
                                                        (1)
                                                    </label>
                                                    <input class="form-control" name="" readonly="" type="text">
                                              
                                                </div>
                                                <div class="col-lg-3 form-group">
                                                    <label>
                                                        (2)
                                                    </label>
                                                    <input class="form-control" name="" readonly="" type="text">
                                                   
                                                </div>
                                                <div class="col-lg-3 form-group">
                                                    <label>
                                                        (3)
                                                    </label>
                                                    <input class="form-control" name="" readonly="" type="text">
                                                 
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12" style="background:#000">
                                                </div>
                                            </div>

                                            <!-- colaboradores -->

                                            <h3 class="text-center" id="colab1" style="font-weight: bold;">
                                                Colaborador
                                            </h3>
                                            <div class="row">
                                                <div class="col-lg-4 form-group">
                                                    <label>
                                                        Apellido paterno
                                                    </label>
                                                    <input class="form-control" readonly="" type="text">
                                                 
                                                </div>
                                                <div class="col-lg-4 form-group">
                                                    <label>
                                                        Apellido materno
                                                    </label>
                                                    <input class="form-control" readonly="" type="text">
                                                   
                                                </div>
                                                <div class="col-lg-4 form-group">
                                                    <label>
                                                        Nombre(s)
                                                    </label>
                                                    <input class="form-control" readonly="" type="text">
                                                 
                                                </div>
                                            </div>
                                            <div class="col-lg-4 form-group">
                                                <label>
                                                    Grado máximo de estudios
                                                </label>
                                                <input class="form-control" readonly="" type="text">
                                             
                                            </div>
                                            <div class="col-lg-8 form-group">
                                                <label>
                                                    Academia a la que pertenece
                                                </label>
                                                <input class="form-control" readonly="" type="text">
                                             
                                            </div>
                                            <div class="col-lg-2 form-group">
                                                <label>
                                                    N°. personal
                                                </label>
                                                <input class="form-control" readonly="" type="text">
                                        
                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <label>
                                                    Móvil
                                                </label>
                                                <input class="form-control" pattern="^\d{10}$" readonly="" type="text">
                                            
                                            </div>
                                            <div class="col-lg-4 form-group">
                                                <label>
                                                    Correo institucional
                                                </label>
                                                <input class="form-control" readonly="" type="email">
                                               
                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <label>
                                                    Correo alternativo
                                                </label>
                                                <input class="form-control" readonly="" type="text">
                                            
                                            </div>
                                            <div class="col-lg-12 form-group">
                                                <label>
                                                    Firma del responsable
                                                </label>
                                                <input class="form-control" readonly="" type="text">
                                            
                                            </div>
                                            <div class="col-lg-12 form-group">
                                                <label>
                                                    Descripción de las principales actividades a desarrollar en el proyecto
                                                </label>
                                                <textarea class="form-control" readonly="" rows="4" style="resize:none;">
                                                </textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12" style="background:#000">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h3 class="text-center" id="objetivos" style="font-weight: bold;">
                                                    Objetivos
                                                </h3>
                                                <div class="col-lg-12 form-group">
                                                    <label>
                                                        Indique el objetivo general(No más de 512 caracteres)
                                                    </label>
                                                    <textarea class="form-control" readonly="" rows="4" style="resize:none;">
                                                    </textarea>
                                                </div>
                                                <div class="col-lg-12 form-group">
                                                    <label>
                                                        Establezca los objetivos específicos, científicos y tecnológicos subyacentes en el proyecto(No más de 512 caracteres)
                                                    </label>
                                                </div>
                                                <div class="col-lg-12 form-group">
                                                    <textarea class="form-control" readonly="" rows="4" style="resize:none;">
                                                    </textarea>
                                                </div>
                                                <div class="col-lg-12 form-group">
                                                    <label>
                                                        Indique los resultados esperados en términos concretos(No más de 512 Caracteres)
                                                    </label>
                                                </div>
                                                <div class="col-lg-12 form-group">
                                                    <textarea class="form-control" readonly="" rows="4" style="resize:none;">
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12" style="background:#000">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h3 class="text-center" id="vinculacion" style="font-weight: bold;">
                                                    Vinculación
                                                </h3>
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        Existe convenio:
                                                    </label>
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        Si
                                                    </label>
                                                    <input name="" readonly="" type="checkbox">
                                                    
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        No
                                                    </label>
                                                    <input name="" readonly="" type="checkbox">
                                                   
                                                </div>
                                                <div class="col-lg-12 form-group">
                                                    <label>
                                                        Nombre de la organización
                                                    </label>
                                                    <input class="form-control" name="" readonly="" type="text">
                                                    
                                                </div>
                                                <div class="col-lg-12 form-group">
                                                    <label>
                                                        Dirección
                                                    </label>
                                                    <input class="form-control" name="" readonly="" type="text">
                                                    
                                                </div>
                                                <div class="col-lg-4 form-group">
                                                    <label>
                                                        Área
                                                    </label>
                                                    <input class="form-control" name="" readonly="" type="text">
                                                
                                                </div>
                                                <div class="col-lg-4 form-group">
                                                    <label>
                                                        Teléfono
                                                    </label>
                                                    <input class="form-control" name="" readonly="" type="text">
                                                    
                                                </div>
                                                <div class="col-lg-4 form-group">
                                                    <label>
                                                        Nombre del contacto
                                                    </label>
                                                    <input class="form-control" name="" readonly="" type="text">
                                                    
                                                </div>
                                                <div class="col-lg-12 form-group">
                                                    <label>
                                                        Descripción de la organización(No más de 256 caracteres)
                                                    </label>
                                                    <textarea class="form-control" name="" readonly="" rows="5" style="resize:none;">
                                                    </textarea>
                                                </div>
                                                <div class="col-lg-7 form-group">
                                                    <label>
                                                        Existen aportaciones financieras o en especie de la vinculación:
                                                    </label>
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        Si
                                                    </label>
                                                    <input name="" readonly="" type="checkbox">
                                                 
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        No
                                                    </label>
                                                    <input name="" readonly="" type="checkbox">
                                                   
                                                </div>
                                                <div class="col-lg-12 form-group">
                                                    <label>
                                                        Si la respuesta es si, describa cuales son(No más de 256 caracteres)
                                                    </label>
                                                    <textarea class="form-control" name="" readonly="" rows="5" style="resize:none;">
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12" style="background:#000">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h3 class="text-center" id="metas" style="font-weight: bold;">
                                                    Productos academicos
                                                </h3>
                                                <div class="col-lg-3 form-group">
                                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox">
                                                        <label>
                                                            Servicio social
                                                        </label>
                                                  
                                                </div>
                                                <div class="col-lg-4 form-group">
                                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox">
                                                        <label>
                                                            Residencia profesional
                                                        </label>
                                                   
                                                </div>
                                                <div class="col-lg-3 form-group">
                                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox">
                                                        <label>
                                                            Tesis
                                                        </label>
                                                 
                                                </div>
                                                <div class="col-lg-12 form-group">
                                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox">
                                                        <label>
                                                            Ponencias/Conferencias
                                                        </label>
                                                 
                                                </div>
                                                <div class="col-lg-12 form-group">
                                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox">
                                                        <label>
                                                            Artículos
                                                        </label>
                                              
                                                </div>
                                                <div class="col-lg-12 form-group">
                                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox">
                                                        <label>
                                                            Libros/Manuales
                                                        </label>
                                                  
                                                </div>
                                                <div class="col-lg-3 form-group">
                                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox">
                                                        <label>
                                                            Propiedad intelectual
                                                        </label>
                                           
                                                </div>
                                                <div class="col-lg-1">
                                                    <label>
                                                        Especificar:
                                                    </label>
                                                </div>
                                                <div class="col-lg-7 form-group">
                                                    <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text">
                                               
                                                </div>
                                                <div class="col-lg-3 form-group">
                                                    <input class="form-group" name="" readonly="" style="margin-left: 18px;" type="checkbox">
                                                        <label>
                                                            Otros
                                                        </label>
                                                 
                                                </div>
                                                <div class="col-lg-1">
                                                    <label>
                                                        Especificar:
                                                    </label>
                                                </div>
                                                <div class="col-lg-7 form-group">
                                                    <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text">
                                                
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12" style="background:#000">
                                                    </div>
                                                </div>
                                                <h1 class="text-center" id="etapa1" style="font-weight: Yu Gothic UI Light; margin-top: 2px">
                                                    Etapa
                                                </h1>
                                                <div class="row">
                                                    <div class="col-lg-12 form-group">
                                                        <label>
                                                            Nombre de la etapa:
                                                        </label>
                                                        <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text">
                                                    </div>                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 form-group">
                                                        <label>
                                                            Fecha de inicio:
                                                        </label>
                                                        <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="date">
                                                    </div>
                                                    
                                                    <div class="col-lg-4 form-group">
                                                        <label>
                                                            Fecha de fin:
                                                        </label>
                                                        <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="date">
                                                    </div>
                                                    
                                                    <div class="col-lg-4 form-group">
                                                        <label>
                                                            Total de meses:
                                                        </label>
                                                        <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text">
                                                    </div>
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 form-group">
                                                        <label>
                                                            Descripción
                                                        </label>
                                                        <input class="form-control" name="" readonly="" type="text">
                                                    </div>                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 form-group">
                                                        <label>
                                                            Metas
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-10 form-group">
                                                        <textarea class="form-control" readonly="" rows="4" style="resize:none;">
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 form-group">
                                                        <label>
                                                            Actividades
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-10 form-group">
                                                        <textarea class="form-control" readonly="" rows="4" style="resize:none;">
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 form-group">
                                                        <label>
                                                            Productos
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-10 form-group">
                                                        <textarea class="form-control" readonly="" rows="4" style="resize:none;">
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12" style="background:#000">
                                                    </div>
                                                </div>
                                                <h3 class="text-center" id="financ" style="font-weight: bold; margin-bottom: 9px;">
                                                    Financiamiento requerido
                                                </h3>
                                                <div class="row">
                                                    <div class="col-lg-5 form-group">
                                                        <label>
                                                            ¿Existe actualmente algún financiamiento del proyecto?
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-2 form-group">
                                                        <label>
                                                            Si
                                                        </label>
                                                        <input name="" readonly="" type="checkbox">
                                                
                                                    </div>
                                                    <div class="col-lg-2 form-group">
                                                        <label>
                                                            No
                                                        </label>
                                                        <input name="" readonly="" type="checkbox">
                                                      
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h5>
                                                            En caso de que la respuesta sea sí
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        Interno
                                                    </label>
                                                    <input name="" readonly="" type="checkbox">
                                                 
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        Externo
                                                    </label>
                                                    <input name="" readonly="" type="checkbox">
                                                
                                                </div>
                                                <div class="col-lg-1 form-group">
                                                    <label>
                                                        Especificar:
                                                    </label>
                                                </div>
                                                <div class="col-lg-6 form-group">
                                                    <input class="form-control" name="" readonly="" style="margin-left: 18px;" type="text">
                                                  
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h5>
                                                        En caso de que la respuesta sea no desglose($)
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        Infraestructura:
                                                    </label>
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <input class="form-control" name="" readonly="" type="text">
                                                  
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        Consumibles:
                                                    </label>
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <input class="form-control" name="" readonly="" type="text">
                                             
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        Licencias:
                                                    </label>
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <input class="form-control" name="" readonly="" type="text">
                                           
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        Viáticos:
                                                    </label>
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <input class="form-control" name="" readonly="" type="text">
                                                 
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        Publicaciones:
                                                    </label>
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <input class="form-control" name="" readonly="" type="text">
                                                
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        Equipo:
                                                    </label>
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <input class="form-control" name="" readonly="" type="text">
                                              
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        Patentes/derechos de autor:
                                                    </label>
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <input class="form-control" name="" readonly="" type="text">
                                             
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        Otros(Especifique):
                                                    </label>
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <input class="form-control" name="" readonly="" type="text">
                                                    
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 form-group">
                                                    <label>
                                                        Total:
                                                    </label>
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <input class="form-control" name="" readonly="" type="text">
                                                  
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12" style="background:#000">
                                                </div>
                                            </div>
                                             <div class="row">
                                                <div class="col-lg-12">
                                                    <h5>
                                                        <b>
                                                            *
                                                        </b>
                                                        S.S.= Servicio Social, R.P.= Residencia Profesional, T= Tesis
                                                    </h5>
                                                    <h3 class="text-center" id="alumnos" style="font-weight: bold; margin-bottom: 9px;">
                                                        Alumno colaborador
                                                    </h3>
                                                    <div class="row">
                                                        <div class="col-lg-6 form-group">
                                                            <label>
                                                                Nombre del Alumno
                                                            </label>
                                                            <input class="form-control" name="" type="text">
                                                        </div>                                                        
                                                        <div class="col-lg-2 form-group" style="margin-top: 30px;">
                                                            <label>
                                                                S.S.
                                                            </label>
                                                            <input class="form-group" name="" type="checkbox" >
                                                  
                                                        </div>
                                                        <div class="col-lg-2 form-group" style="margin-top: 30px;">
                                                            <label>
                                                                R.P.
                                                            </label>
                                                            <input class="form-group" name="" type="checkbox">
                                                      
                                                        </div>
                                                        <div class="col-lg-2 form-group" style="margin-top: 30px;">
                                                            <label>
                                                                T
                                                            </label>
                                                            <input class="form-group" name="" type="checkbox">
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4 form-group">
                                                            <label>
                                                                No. control
                                                            </label>
                                                            <input class="form-control" name="" readonly="" type="text">
                                                        </div>                                                        
                                                        <div class="col-lg-4 form-group">
                                                            <label>
                                                                Semestre:
                                                            </label>
                                                             <input class="form-control" name="" readonly="" type="text">
                                                        </div>                                                        
                                                        <div class="col-lg-4 form-group">
                                                            <label>
                                                                Carrera
                                                            </label>
                                                            <input class="form-control" name="" readonly="" type="text">
                                                        </div>
                                                        
                                                        <div class=" col-lg-12 form-group">
                                                            <label>
                                                                Detalle de actividades
                                                            </label>
                                                            <textarea class="form-control" readonly="" rows="3" style="resize:none;">
                                                            </textarea>
                                                        </div>
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
                                                    <div class="panel panel-primary panel-default" id="navObserv">
                                                        <div class="panel-heading">
                                                            <h5 class="panel-title">
                                                                Subdirección de Investigación y Posgrado
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
                                                    <li class="">
                                                        <a href="#" onclick="enin();">
                                                            Aceptar Proyecto
                                                        </a>
                                                    </li>
                                                    <li class="">
                                                        <a href="#" onclick="enin();">
                                                            Rechazar Proyecto
                                                        </a>
                                                    </li>
                                                    <li class="">
                                                        <a href="#" onclick="enin();">
                                                            Regresar por correcciones
                                                        </a>
                                                    </li>
                                                    <li class="">
                                                        <a data-dismiss="modal" href="">
                                                            Enviar revisión a Consejo de Investigación
                                                        </a>
                                                    </li>
                                                    <li class="">
                                                        <a data-dismiss="modal" href="">
                                                            Cerrar
                                                        </a>
                                                    </li>
                                                </div>
                                            </ul>
                                        </nav>
                                    </div>
                                    <script>
                                        // var acc = document.getElementsByClassName("accordion");
                                        //   var i;
                                        //   for (i = 0; i < acc.length; i++) 
                                        //   {
                                        //     acc[i].onclick = function() {
                                        //       this.classList.toggle("active");
                                        //       var panel = this.nextElementSibling;
                                        //       if (panel.style.maxHeight){
                                        //         panel.style.maxHeight = null;
                                        //       } else {
                                        //         panel.style.maxHeight = panel.scrollHeight + "px";
                                        //       } 
                                        //     }
                                        //   }
                                    </script>
                                    <!-- <script type="text/javascript">
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
                                          })
                                    </script> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>