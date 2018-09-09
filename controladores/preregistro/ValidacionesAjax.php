<?php 
	include('../../externas/Clases/classConn.php');
	$accion = $_POST['accion'];

	switch ($accion) {
		case 'validarNombre':
			$miConn=new ClassConn();
			$nombreP_post = $_POST['nombreP'];
			$sql= "SELECT COUNT (\"NombreProyecto\") FROM proyecto WHERE \"NombreProyecto\"='".$nombreP_post."';";
			$result= pg_query($miConn->conexion(), $sql);
			$result=pg_fetch_array($result);
			//print_r($sql);
			if($result[0]==1){
				$mensajeError="Proyecto existente";
			}
			else{
				$mensajeError="";				
			}
			echo $mensajeError;
			break;
		/*
		case 'todos':
			$sql="";
			$result=pg_query();
			echo $sql;
			?>
			<div class="row setup-content" id="step-2">
                                    <div class="col-md-12">
                                    	<?php 
                                    	for(i=0;)
                                    		$result['totalCOl'];
                                    	 ?>
                                        <div class="col-md-12">
                                            <input type="hidden" value="responsableForm" name="accion">
                                            <input type="hidden" id="folio_proyecto2" name="folio_proyecto" readonly>
                                            <h2 style="text-align: center; margin-top: -20px; margin-bottom: 50px;">Responsable</h2>
                                            <div class="form-group col-md-4" readonly>
                                                <label>*Apellido paterno</label>
                                                <input type="text" class="form-control" disabled value="" id="apellidoPatResp" name="apellidoPatResp" value="<?php echo $row['APELLIDO_PATERNO'] ?>" > 
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
			<?
			foreach ($result as $row) 
			{
				?>
				<tr>
					<td>
						algo de informacion <?php echo $row['pk_algo'] ?>
					</td>
					<td>
						algo de informacion <?php echo $row['pk_algo'] ?>
					</td>
					<td>
						algo de informacion <?php echo $row['pk_algo'] ?>
					</td>
				</tr>
				<?
			}
			break;*/
		default:
			# code...
			break;
	}
	
?>