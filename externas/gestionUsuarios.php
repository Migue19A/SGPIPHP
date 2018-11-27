<?php 
$conn=new Consultas();
$docentes=$conn->obtenerDocentes();
// print_r($docentes);
// echo $docentes;
// echo gettype($docentes);
// $docentes=json_decode($docentes,true);
// print_r($docentes);
?>
<script src="../../js/gestionUsuarios.js"></script>
<link rel="stylesheet" href="../../css/gestionUsuarios.css">
 <body>
    <div class="container" style="margin-top: 12px;">
        <input type="hidden" id="filaSeleccionada" name="filaSeleccionada">
        <div class="col-md-9">
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 style="text-align: center;">Gestion de usuarios</h2>
                    </div>
                    <div class="panel-body">                            
                        <div class="col-md-11">
                            <input type="text" class="form-control" id="btnBuscar" placeholder="Buscar docente">
                        </div>    
                        <div class="col-md-1">
                            <input type="button" class="btn btn-primary" value="Buscar">
                        </div>                            
                        <div id="divTablaDocentes">
                            <table class="table" id="tablaDocente">
                                <thead>
                                    <tr>
                                        <th>Numero Personal</th>
                                        <th>Nombre del docente</th>
                                        <th>Estado</th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach($docentes as $valor) 
                                    {?>
                                        <tr id="<?php echo $valor['NoPersonal'] ?>">
                                            <td><?php echo $valor['NoPersonal'] ?></td>
                                            <td><?php echo $valor['Nombre'] ?></td>
                                            <td><?php echo $valor['estado'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <input type="button" class="btn btn-primary" id="btnAlta" data-target="#ModalAlta" data-toggle="modal" value="Alta usuario">
                        <input class="btn btn-primary" id="btnHistorial" data-target="#myModalhis" data-toggle="modal" name="" type="button" value="Historial" style="float: right; margin-left: 5px;"/>
                        <input class="btn btn-primary" id="btnEditar" data-target="#ModalEditar" data-toggle="modal" name="" type="button" value="Editar" style="float: right; margin-left: 5px;"/>
                        <input class="btn btn-primary" name="btnHabilitar" id="btnHabilitar" onclick="cambiarEstado(1);" type="button" value="Habilitar" style="float: right; margin-left: 5px;"/>
                        <input class="btn btn-primary" name="btnBaja" id="btnBaja" onclick="cambiarEstado(2);" type="button" value="Baja" style="float: right;"/>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <div class="container col-sm-8">
        <div class="modal fade" id="ModalEditar" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button">
                            ×
                        </button>
                        <h4 class="modal-title" style="text-align: center;">
                            Cambio de información
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="get" id="formEditaUsuario">
                            <input type="hidden" id="accion" name="accion" value="editaUsuario">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            Nombre(s)
                                        </label>
                                        <input class="form-control" id="nombreEdita" name="nombre" type="text">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>
                                            Apellido paterno
                                        </label>
                                        <input class="form-control" id="apPaternoEdita" name="apPaterno"  type="text">                                                
                                    </div>
                                    <div class="col-sm-4">
                                        <label>
                                            Apellido materno
                                        </label>
                                        <input class="form-control" id="apMaternoEdita" name="apMaterno"  type="text">                                                
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Móvil
                                        </label>
                                        <input class="form-control" id="movilEdita" name="movil" required="" type="text">                                                
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Correo institucional
                                        </label>
                                        <input class="form-control" id="correoEdita" name="correo" required="" type="text">                                                
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            No. personal
                                        </label>
                                        <input class="form-control" id="noPersonalEdita" name="noPersonal" type="text">                                                
                                    </div>
                                </div>
                                <div class="row">                                            
                                    <div class="col-sm-4 form-group">
                                        <label for="sel1">
                                            Grado máximo de estudios
                                        </label>
                                        <select class="form-control" id="gradoMaxEdita" name="gradoMax">
                                            <option value="1">
                                                Licenciatura
                                            </option>
                                            <option value="2">
                                                Maestría
                                            </option>
                                            <option value="3">
                                                Doctorado
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-sm-8 form-group">
                                        <label for="sel1">
                                            Academia a la que pertenece
                                        </label>
                                        <select class="form-control" id="carreraEdita" name="carrera">
                                            <option value="1">Ingenieria en sistemas computacionales</option>
                                            <option value="2">Ingenieria industrial</option>
                                            <option value="3">Ingenieria en industrias alimentarias</option>
                                            <option value="4">Ingenieria civil</option>
                                            <option value="5">Ingenieria electronica</option>
                                            <option value="6">Ingenieria electromecanica</option>
                                            <option value="7">Ingenieria bioquimica</option>
                                            <option value="8">Ingenieria en gestion empresarial</option>
                                            <option value="9">Ingeneiria mecatronica</option>
                                            <option value="10">Gastronomia</option>
                                        </select>
                                    </div>
                                </div>                                        
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Sexo</label>
                                        <select class="form-control" id="sexoEdita" name="sexo">
                                            <option>F</option>
                                            <option>M</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Tipo de ususario</label>
                                        <select class="form-control" id="tipoUsuEdita" name="tipoUsu">
                                            <option value="1">Gestion</option>
                                            <option value="2">Investigacion</option>
                                            <option value="3">Comité</option>
                                            <option value="4">Docente</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal" type="button">
                            Cerrar
                        </button>
                        <button class="btn btn-primary" type="button" id="btnEditarUsuario" onclick="editarUsuario()">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container col-sm-8 col-sm-8">
        <div class="modal fade" id="ModalAlta" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button">
                            ×
                        </button>
                        <h4 class="modal-title" style="text-align: center;">
                            Alta de Usuario
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="formAltaUsuario">
                            <input type="hidden" id="accion" name="accion" value="altaUsuario">
                            <h1 class="text-center" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
                                Datos personales
                            </h1>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            Nombre(s)
                                        </label>
                                        <input class="form-control" id="nombre" name="nombre" required="" type="text">
                                        
                                    </div>
                                    <div class="col-sm-4">
                                        <label>
                                            Apellido paterno
                                        </label>
                                        <input class="form-control" required="" id="apPaterno" name="apPaterno" type="text">
                                        
                                    </div>
                                    <div class="col-sm-4">
                                        <label>
                                            Apellido materno
                                        </label>
                                        <input class="form-control" required="" type="text" id="apMaterno" name="apMaterno">                                              
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Móvil
                                        </label>
                                        <input class="form-control" required="" type="text" id="movil" name="movil">
                                       
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            Correo institucional
                                        </label>
                                        <input class="form-control" required="" type="text" id="correo" name="correo">
                                      
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>
                                            No. personal
                                        </label>
                                        <input class="form-control" required="" type="text" id="noPersonal" name="noPersonal">                                             
                                    </div>
                                </div>
                                <div class="row">                                            
                                    <div class="col-sm-4 form-group">
                                        <label for="sel1">
                                            Grado máximo de estudios
                                        </label>
                                        <select class="form-control" id="gradoMax" name="gradoMax">
                                            <option value="1">
                                                Licenciatura
                                            </option>
                                            <option value="2">
                                                Maestría
                                            </option>
                                            <option value="3">
                                                Doctorado
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-sm-8 form-group">
                                        <label for="sel1">
                                            Academia a la que pertenece
                                        </label>
                                        <select class="form-control" id="carrera" name="carrera">
                                            <option value="1">Ingenieria en sistemas computacionales</option>
                                            <option value="2">Ingenieria industrial</option>
                                            <option value="3">Ingenieria en industrias alimentarias</option>
                                            <option value="4">Ingenieria civil</option>
                                            <option value="5">Ingenieria electronica</option>
                                            <option value="6">Ingenieria electromecanica</option>
                                            <option value="6">Ingenieria bioquimica</option>
                                            <option value="7">Ingenieria en gestion empresarial</option>
                                            <option value="8">Ingeneiria mecatronica</option>
                                            <option value="10">Gastronomia</option>
                                        </select>
                                    </div>
                                </div>                                        
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Sexo</label>
                                        <select class="form-control" id="sexo" name="sexo"> 
                                            <option>F</option>
                                            <option>M</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Fecha de Nacimiento</label>
                                        <input class="form-control" type="date" name="fechaNac" id="fechaNac">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Tipo de ususario</label>
                                        <select class="form-control" id="tipoUsu" name="tipoUsu">
                                            <option value="1">Docente</option>
                                            <option value="2">Gestion</option>
                                            <option value="3"> Investigacion</option>
                                            <option value="4">Comite</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <h1 class="text-center" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">
                                Datos de usuario
                            </h1>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            Contraseña
                                        </label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div> 
                                    <div class="col-sm-4">
                                        <label>
                                            Verificar contraseña
                                        </label>
                                        <input type="password" class="form-control" id="confirmaPass">
                                    </div> 
                                </div>                                                                                                                          
                            </div>
                        </form>
                    </div>
        
        <!---------------------------------------------------------------------------------------------------------------------------------->
                    <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal" type="button">
                            Cancelar
                        </button>
                        <button class="btn btn-primary" onclick="altaUsuario()" type="button" id="btnAltaUsuario">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>            
    <div class="container">
        <div class="modal fade" id="myModalhis" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">                                
                        <h4 style="text-align: center;">Historial</h4>
                    </div>
                    <div class="modal-body">
                        <h3 style="text-align: center;">Historial docente</h3>
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Proyectos activos</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>Proyectos cancelados</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>Retraso de entregables</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>Prórrogas solicitadas</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>Cambios de colaboradores</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>N° bloqueos</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>N° sanciones</td>
                                            <td>0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-dismiss="modal" type="button">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>