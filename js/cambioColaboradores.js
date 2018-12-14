var folio = '';
var peti = 0;
$(document).ready(function(){
    $('#btnGuardarA').attr('disabled', true);
    $('#btnGuardarC').attr('disabled', true);
    $('#btnGuardarAC').attr('disabled', true);
    $('#btnGuardarAA').attr('disabled', true);
});

function prevenir(event){
    event.preventDefault();
}

function obtenerColaborador_Cambio(fol){
    //prevenir(event);
    folio = fol;
    $.ajax(
    {
        async: true,
        type: 'GET',
        //ContentType = "application/json; charset=utf-8",        
        datatype: 'HTML',
        url: '../../Ajax/ajax_consultas_cambioC.php',
        data: {folio_cambio: folio, accion:'consultarColaboradores'},
        beforeSend: function()
        {
            $('#tb_todo').html();
        },
        success: function(data){         
            $('#tb_todo').html(data);
        },
        error: function(data) {       
        }
      });
}

function obtener_colaborador(numero_cont, opc){
    //prevenir(event);    
    var valorComboA = $('#cbo_colaboradoresA').val();
    var valorComboC = $('#cbo_colaboradoresC').val();
    if(valorComboA == 'Seleccione un Docente'){
        $('#btnGuardarA').attr('disabled', true);
    }
    if(valorComboC== 'Seleccione un Docente' ){
        $('#btnGuardarC').attr('disabled', true);
    }
    if(valorComboA != 'Seleccione un Docente' || valorComboC != 'Seleccione un Docente' ){
        $('#btnGuardarA').attr('disabled', false);
        $('#btnGuardarC').attr('disabled', false); 
        var noControl = numero_cont;    
        $.ajax(
        {
            async: true,
            type: 'GET',
            //ContentType = "application/json; charset=utf-8",        
            datatype: 'json',
            url: '../../Ajax/ajax_consultas_cambioC.php',
            data: {noControl: noControl, accion:'obtenerColab'},
            beforeSend: function()
            {
            },
            success: function(response){            
                var json = JSON.parse(response);
                if(opc == 1){
                    $('#cam_ap_paterno').val(json.paterno);
                    $('#cam_ap_materno').val(json.materno);
                    $('#cam_nombre').val(json.Nombre);
                    $('#cam_max_estudios').val(json.maxEstudios);
                    $('#cam_carrera').val(json.academia);
                    $('#cam_numero_p').val(json.NoPersonal);
                    $('#cam_celu').val(json.celular);
                    $('#cam_correo1').val(json.correo_inst);
                    $('#cam_correo2').val(json.correo_alt);
                    //$('#cam_actividades_colab').val(json.actividades);
                }else{
                    $('#ap_paterno').val(json.paterno);
                    $('#ap_materno').val(json.materno);
                    $('#nombre').val(json.Nombre);
                    $('#max_estudios').val(json.maxEstudios);
                    $('#carrera').val(json.academia);
                    $('#numero_p').val(json.NoPersonal);
                    $('#celu').val(json.celular);
                    $('#correo1').val(json.correo_inst);
                    $('#correo2').val(json.correo_alt);
                }
            },
            error: function(data) {       
            }
          });    
        }
}

function obtener_alumno(numero_cont, opc){
    //prevenir(event);    
    var valorComboA = $('#cbo_alumnosA').val();
    var valorComboC = $('#cbo_alumnosC').val();
    if(valorComboA == 'Seleccione un Alumno'){
        $('#btnGuardarAA').attr('disabled', true);
    }
    if(valorComboC== 'Seleccione un Alumno' ){
        $('#btnGuardarAC').attr('disabled', true);
    }
    if(valorComboA != 'Seleccione un Alumno' || valorComboC != 'Seleccione un Alumno'){
        $('#btnGuardarAA').attr('disabled', false);
        $('#btnGuardarAC').attr('disabled', false); 
        var noControl = numero_cont;    
        $.ajax(
        {
            async: true,
            type: 'GET',
            //ContentType = "application/json; charset=utf-8",        
            datatype: 'json',
            url: '../../Ajax/ajax_consultas_cambioC.php',
            data: {noControl: noControl, accion:'obtenerAlum'},
            beforeSend: function()
            {
            },
            success: function(response){     
                try{       
                    var json = JSON.parse(response);
                    var aumenta = 0;
                    if(opc == 0){
                        $('#al_ap_paterno').val(json.paterno);
                        $('#al_ap_materno').val(json.materno);
                        $('#al_nombre').val(json.Nombre);
                        $('#al_carrera').val(json.academia);
                        $('#al_control').val(json.NoControl);
                        if(json.servicio == 1){
                            aumenta++;
                            //$('#al_servicio').attr('checked', true);
                            $('#al_servicio').attr('disabled', true);
                        }else{
                            $('#al_servicio').attr('disabled', false);
                        }
                        if(json.residencia == 1){
                            aumenta++;
                            //$('#al_residencia').attr('checked', true);
                            $('#al_residencia').attr('disabled', true);
                        }else{
                            $('#al_residencia').attr('disabled', false);
                        }
                        if(json.tesis == 1){
                            aumenta++;
                            //$('#al_tesis').attr('checked', true);
                            $('#al_tesis').attr('disabled', true);
                        }else{
                            $('#al_tesis').attr('disabled', false);
                        }
                        console.log("Aumenta: " + aumenta);
                        if(aumenta == 3){
                            ValidarAlumno();
                        }
                        //$('#cam_actividades_colab').val(json.actividades);
                    }else{
                        $('#al_ap_paterno_cam').val(json.paterno);
                        $('#al_ap_materno_cam').val(json.materno);
                        $('#al_nombre_cam').val(json.Nombre);
                        $('#al_carrera_cam').val(json.academia);
                        $('#al_control_cam').val(json.NoControl);
                        if(json.servicio == 1){
                            aumenta++;
                            //$('#al_servicio').attr('checked', true);
                            $('#al_servicio_cam').attr('disabled', true);
                        }else{
                            $('#al_servicio_cam').attr('disabled', false);
                        }
                        if(json.residencia == 1){
                            aumenta++;
                            //$('#al_residencia').attr('checked', true);
                            $('#al_residencia_cam').attr('disabled', true);
                        }else{
                            $('#al_residencia_cam').attr('disabled', false);
                        }
                        if(json.tesis == 1){
                            aumenta++;
                            //$('#al_tesis').attr('checked', true);
                            $('#al_tesis_cam').attr('disabled', true);
                        }else{
                            $('#al_tesis_cam').attr('disabled', false);
                        }
                        console.log("Aumenta: " + aumenta);
                        if(aumenta == 3){
                            ValidarAlumno();
                        }
                    }
                }catch (error){
                    alert("Error: " + error);
                }
            },
            error: function(data) {       
            }
          });    
        }
}

function EnviarSolicitud(form){
    prevenir(event);
    var form_obs = $('form[id="'+form+'"]').serializeArray();
    console.log(form_obs); 
    swal({
      title: 'Ya no podrá hacer cambios',
      text: "¿Seguro que desea enviar la solicitud?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar'
      }).then(function () {        
         ajaxCambioColaboradores(form, 1);
      });
}

function ValidarAlumno(){
    swal({
      title: "¡ATENCIÓN!",
      text: "El alumno sólo puede ser registrado como un contribuyente más.\nSin embargo ya no puede realizar ni servicio,\nni residencia, ni tesis con este proyecto",
      type: 'warning',
      showCancelButton: false,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar'
      });
}

function ajaxCambioColaboradores(id, opc){
    prevenir(event);
    var form_obs = $('form[id="'+id+'"]').serializeArray();
    //alert("Folio: " + folio);
    //alert(form_obs);
    //console.log($('form[id="'+id+'"]').serializeArray());
    //console.log(botonVer);
    $.ajax(
    {
        async: true,
        type: 'POST',
        //ContentType = "application/json; charset=utf-8",        
        datatype: 'json',
        url: '../../Ajax/ajax_consultas_cambioC.php',
        data: $('#'+id).serializeArray(),
        beforeSend: function()
        {            
        },
        success: function(data){            
                console.log(data);                
                if (opc==1){
                    swal(
                    'Solicitud enviada',
                    '',
                    'success'
                ).then(function(){
                    obtenerColaborador_Cambio(folio);                  
                });
                    
                }else{
                    swal(
                        'Solicitud enviada',
                        '',
                        'success'
                    ).then(function(){
                        location.reload();                  
                    });
                }
                $('#myModalAltaColaborador').modal('hide');
                $('#myModalAltaAlumno').modal('hide');
                $('#myModalCambioColaborador').modal('hide');
                $('#myModalCambioAlumno').modal('hide');
                $('#myModalBajaColaborador').modal('hide');
                $('#myModalBajaAlumno').modal('hide');
        },
        error: function(data) {       
        }
      });
}
/*function ajaxCambioColaboradores(id){
    prevenir(event);
    var form_obs = $('form[id="'+id+'"]').serializeArray();
    //alert("Folio: " + folio);
    //alert(form_obs);
    //console.log($('form[id="'+id+'"]').serializeArray());
    //console.log(botonVer);
    $.ajax(
    {
        async: true,
        type: 'POST',
        //ContentType = "application/json; charset=utf-8",        
        datatype: 'json',
        url: '../../Ajax/ajax_consultas_cambioC.php',
        data: $('#'+id).serializeArray(),
        beforeSend: function()
        {            
        },
        success: function(data){            
                console.log(data);
                swal(
                    'Solicitud enviada',
                    '',
                    'success'
                );
                obtenerColaborador_Cambio(folio);
                $('#myModal').modal('hide');
                $('#myModal2').modal('hide');
                $('#myModal3').modal('hide');
                $('#ModalCambioAlumno').modal('hide');
                $('#ModalAltaAlumno').modal('hide');
                $('#ModalBajaAlumno').modal('hide');
        },
        error: function(data) {       
        }
      });

}*/

function ajaxComboColaboradores(id, ocn, control){
    prevenir(event);
    var opcion = '';
    if(ocn== 0){
        opcion=  'obtenerColabCombo';        
        $('#folio_proyecto').val(id);
    }
    if(ocn==1){
        opcion=  'obtenerColabComboCambio';
        console.log("Control: " + control);
        var actividades = $('#'+control).val();
        console.log("Actividades: " + actividades);
        $('#cam_actividades_colab').val(actividades);
        $('#np_original').val(control);
        $('#baja_numero_p').val(control); 
        $('#cam_folio_proyecto').val(id);
        $('#baja_folio_proyecto').val(id);
    }
    //alert(form_obs);
    //console.log($('form[id="'+id+'"]').serializeArray());
    //console.log(botonVer);
    $.ajax(
    {
        async: true,
        type: 'GET',
        //ContentType = "application/json; charset=utf-8",        
        datatype: 'HTML',
         url: '../../Ajax/ajax_consultas_cambioC.php',
        data: {folio:id, accion: opcion},
        beforeSe0nd: function()
        {
            $('#alta_colab_combo').html();
            $('#cambio_colab_combo').html();
        },
        success: function(data){ 

            if(ocn== 0){
                $('#alta_colab_combo').html(data);
            }else{
                $('#cambio_colab_combo').html(data);
            }
        },
        error: function(data) {       
        }
      });

}

function ajaxComboAlumnos(id, ocn, control){
    prevenir(event);
    var opcion = '';
    $('#al_servicio').attr('disabled', true);
    $('#al_residencia').attr('disabled', true);
    $('#al_tesis').attr('disabled', true);
    if(ocn== 0){
        opcion=  'obtenerAlumnoCombo';        
        $('#al_folio_proyecto').val(id);
    }
    if(ocn==1){
        opcion=  'obtenerAlumnoComboCambio';        
        console.log("Control: " + control);
        var actividades = $('#'+control).val();
        console.log("Actividades: " + actividades);
        $('#al_actividadesC').val(actividades);
        $('#nc_original').val(control);
        $('#al_baja_numero_c').val(control); 
        $('#al_folio_proyectoC').val(id);
        $('#baja_folio_proyectoAlum').val(id);
    }
    //alert(form_obs);
    //console.log($('form[id="'+id+'"]').serializeArray());
    //console.log(botonVer);
    $.ajax(
    {
        async: true,
        type: 'GET',
        //ContentType = "application/json; charset=utf-8",        
        datatype: 'HTML',
         url: '../../Ajax/ajax_consultas_cambioC.php',
        data: {folio:id, accion: opcion},
        beforeSe0nd: function()
        {
            $('#alta_alum_combo').html();
            $('#cambio_alum_combo').html();
        },
        success: function(data){ 
            if(ocn== 0){
                $('#alta_alum_combo').html(data);
            }else{
                $('#cambio_alum_combo').html(data);
            }
        },
        error: function(data) {       
        }
      });

}


/*function enviarFolio(fol){
    $('#folio_proyecto').val(fol);
}*/

function llenarDatosColabAlta(id, activis, solic, folio_proyecto, obsInv){
    $('#colab_folio_proyectoA').val(folio_proyecto);
    $('#colab_numero_solicA').val(solic);
    $('#obs2_alta_colab').val(obsInv);
    $.ajax(
        {
            async: true,
            type: 'GET',
            //ContentType = "application/json; charset=utf-8",        
            datatype: 'json',
            url: '../../Ajax/ajax_consultas_cambioC.php',
            data: {noControl: id, accion:'obtenerColab'},
            beforeSend: function()
            {
            },
            success: function(response){            
                var json = JSON.parse(response);
                //console.log(json.paterno);
                $('#ap_paterno_alta').val(json.paterno);
                $('#ap_materno_alta').val(json.materno);
                $('#nombre_alta').val(json.Nombre);
                $('#max_estudios_alta').val(json.maxEstudios);
                $('#carrera_alta').val(json.academia);
                $('#numero_p_alta').val(json.NoPersonal);
                $('#celu_alta').val(json.celular);
                $('#correo1_alta').val(json.correo_inst);
                $('#actividades_colab_alta').val(activis);
            },
            error: function(data) {       
            }
          });
}

function llenarDatosAlumAlta(id, actividades, solic, serv, resid, tesis, semestre, folio_proyecto, obsInv){
    $('#al_folio_proyectoA').val(folio_proyecto);
    $('#alum_numero_solicA').val(solic);
    $('#al_servicioA').val(serv);
    $('#al_residenciaA').val(resid);
    $('#al_tesisA').val(tesis);
    $('#obs2_alta_alum').val(obsInv);
    $.ajax(
        {
            async: true,
            type: 'GET',
            //ContentType = "application/json; charset=utf-8",        
            datatype: 'json',
            url: '../../Ajax/ajax_consultas_cambioC.php',
            data: {noControl: id, accion:'obtenerAlum'},
            beforeSend: function()
            {
            },
            success: function(response){            
                var json = JSON.parse(response);
                var aumenta =0;
                $('#al_ap_paternoA').val(json.paterno);
                $('#al_ap_maternoA').val(json.materno);
                $('#al_nombreA').val(json.Nombre);
                $('#al_carreraA').val(json.academia);
                $('#al_controlA').val(json.NoControl);
                $('#al_semestreA').val(semestre);
                $('#check_al_servicioA').attr('disabled', true);
                $('#check_al_residenciaA').attr('disabled', true);
                $('#check_al_tesisA').attr('disabled', true);
                if(serv == 1){
                    aumenta++;
                    $('#check_al_servicioA').attr('checked', true);
                }else{
                    $('#check_al_servicioA').attr('checked', false);
                }
                if(resid == 1){
                    aumenta++;
                    $('#check_al_residenciaA').attr('checked', true);
                }else{
                    $('#check_al_residenciaA').attr('checked', false);
                }
                if(tesis == 1){
                    aumenta++;
                    $('#check_al_tesisA').attr('checked', true);
                }else{
                    $('#check_al_tesisA').attr('checked', false);
                }
                $('#actividades_alumA').val(actividades);
                if(aumenta == 0){
                    ValidarAlumno();
                }
            },
            error: function(data) {       
            }
          });
}

function llenarDatosColabNuevo(id){ 
    var nuevasActiv = $('#actividades_colab').val(); 
    $.ajax(
        {
            async: true,
            type: 'GET',
            //ContentType = "application/json; charset=utf-8",        
            datatype: 'json',
            url: '../../Ajax/ajax_consultas_cambioC.php',
            data: {noControl: id, accion:'obtenerColab'},
            beforeSend: function()
            {
            },
            success: function(response){            
                var json = JSON.parse(response);
                $('#cam_ap_paterno').val(json.paterno);
                $('#cam_ap_materno').val(json.materno);
                $('#cam_nombre').val(json.Nombre);
                $('#cam_max_estudios').val(json.maxEstudios);
                $('#cam_carrera').val(json.academia);
                $('#cam_numero_p').val(json.NoPersonal);
                $('#cam_celu').val(json.celular);
                $('#cam_correo1').val(json.correo_inst);
                $('#cam_actividades_colab').val(nuevasActiv);
            },
            error: function(data) {       
            }
          });
}

function llenarDatosColabCambio(id, activis, motivo, np_nuevo ,solic, folio_proyecto, obsInv){  
    $('#colab_folio_proyectoC').val(folio_proyecto);
    $('#colab_numero_solicC').val(solic);
    $('#obs2_cambio_colab').val(obsInv);
    $.ajax(
        {
            async: true,
            type: 'GET',
            //ContentType = "application/json; charset=utf-8",        
            datatype: 'json',
            url: '../../Ajax/ajax_consultas_cambioC.php',
            data: {noControl: id, accion:'obtenerColab'},
            beforeSend: function()
            {
            },
            success: function(response){            
                var json = JSON.parse(response);
                $('#ap_paterno').val(json.paterno);
                $('#ap_materno').val(json.materno);
                $('#nombre').val(json.Nombre);
                $('#max_estudios').val(json.maxEstudios);
                $('#carrera').val(json.academia);
                $('#numero_p').val(json.NoPersonal);
                $('#celu').val(json.celular);
                $('#correo1').val(json.correo_inst);
                $('#actividades_colab').val(activis);
                $('#motivo_cambio').val(motivo);
                llenarDatosColabNuevo(np_nuevo);
            },
            error: function(data) {       
            }
          });
}

function llenarDatosColabBaja(id, motivo_baja, solic, folio_proyecto, obsInv){
    $('#colab_folio_proyectoB').val(folio_proyecto);
    $('#colab_numero_solicB').val(solic);
    $('#motivos_baja_colab').val(motivo_baja);
    $('#np_baja_colab').val(id);
    $('#obs2_baja_colab').val(obsInv);
}

function llenarDatosAlumNuevo(id, scio, rcia, tsis, smstre){ 
    var nuevasActiv = $('#actividades_alum').val(); 
    $.ajax(
        {
            async: true,
            type: 'GET',
            //ContentType = "application/json; charset=utf-8",        
            datatype: 'json',
            url: '../../Ajax/ajax_consultas_cambioC.php',
            data: {noControl: id, accion:'obtenerAlum'},
            beforeSend: function()
            {
            },
            success: function(response){            
                var json = JSON.parse(response);
                var aumenta =0;
                $('#al_ap_paterno_new').val(json.paterno);
                $('#al_ap_materno_new').val(json.materno);
                $('#al_nombre_new').val(json.Nombre);
                $('#al_carrera_new').val(json.academia);
                $('#al_control_new').val(json.NoControl);
                $('#al_semestreC_new').val(smstre);
                if(scio == 1){
                    aumenta++;
                    //$('#al_servicio').attr('checked', true);
                    $('#check_al_servicioC').attr('disabled', true);
                }else{
                    $('#check_al_servicioC').attr('disabled', false);
                }
                if(rcia == 1){
                    aumenta++;
                    //$('#al_residencia').attr('checked', true);
                    $('#check_al_residenciaC').attr('disabled', true);
                }else{
                    $('#check_al_residenciaC').attr('disabled', false);
                }
                if(tsis == 1){
                    aumenta++;
                    //$('#al_tesis').attr('checked', true);
                    $('#check_al_tesisC').attr('disabled', true);
                }else{
                    $('#check_al_tesisC').attr('disabled', false);
                }
                $('#cam_actividades_alum').val(nuevasActiv);
                if(aumenta == 0){
                    ValidarAlumno();
                }
            },
            error: function(data) {       
            }
          });
}


function llenarDatosAlumCambio(id, activ, nuevo, solic, motiv, s, r, t, smtre, folio_proyecto, obsInv){
    $('#al_folio_proyectoC').val(folio_proyecto);
    $('#alum_numero_solicC').val(solic);
    $('#al_servicioC').val(s);
    $('#al_residenciaC').val(r);
    $('#al_tesisC').val(t); 
    $('#obs2_cambio_alum').val(obsInv); 
    $.ajax(
        {
            async: true,
            type: 'GET',
            //ContentType = "application/json; charset=utf-8",        
            datatype: 'json',
            url: '../../Ajax/ajax_consultas_cambioC.php',
            data: {noControl: id, accion:'obtenerAlum'},
            beforeSend: function()
            {
            },
            success: function(response){            
                var json = JSON.parse(response);
                $('#al_ap_paterno').val(json.paterno);
                $('#al_ap_materno').val(json.materno);
                $('#al_nombre').val(json.Nombre);
                $('#al_carrera').val(json.academia);
                $('#al_control').val(json.NoControl);
                $('#actividades_alum').val(activ);
                $('#alum_motivo_cambio').val(motiv);
                $('#al_semestreC_anti').val(json.semestre);
                $('#check_al_servicioC').attr('disabled', true);
                $('#check_al_residenciaC').attr('disabled', true);
                $('#check_al_tesisC').attr('disabled', true);
                llenarDatosAlumNuevo(nuevo, s, r, t, smtre);
            },
            error: function(data) {       
            }
          });
}

function llenarDatosAlumBaja(id, motivo_baja, solic, folio_proyecto, obsInv){
    $('#alum_folio_proyectoB').val(folio_proyecto);
    $('#alum_numero_solicB').val(solic);
    $('#nc_baja_alum').val(id);
    $('#motivos_baja_alum').val(motivo_baja);
    $('#obs2_baja_alum').val(obsInv);
}

function enviar_investigacion(form){
      swal({
      title: 'Ya no podrá hacer cambios',
      text: "¿Seguro que desea enviarlo a investigación?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar'
    }).then(function () {        
         ajaxCambioColaboradores(form, 2);
    });
}

function enviar_gestion(form){
      swal({
      title: 'Ya no podrá hacer cambios',
      text: "¿Seguro que desea enviarlo a gestión?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar'
    }).then(function () {        
         ajaxCambioColaboradores(form, 2);
    });
}

function rechazar(form){
      swal({
      title: 'Ya no podrá hacer cambios',
      text: "¿Seguro que desea rechazar la solicitud?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar'
    }).then(function () {        
         ajaxCambioColaboradores(form, 2);
    });
}

function aceptar(form){
      swal({
      title: 'Ya no podrá hacer cambios',
      text: "¿Seguro que desea aceptar la solicitud?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar'
    }).then(function () {        
         ajaxCambioColaboradores(form, 2);
    });
}

function tipo(peticion){ 
    peti=0;   
    if(peticion== 1){
        peti = 2;
    }
    if(peticion== 2){
        peti = 4;
    }
    if(peticion== 3){
        peti = 6;
    }
    if(peticion == 4){
        peti = 8;
    }
    $('#btn_alta_colab').val(peti);
    $('#btn_alta_alum').val(peti);
    $('#btn_cambio_colab').val(peti);
    $('#btn_cambio_alum').val(peti);
    $('#btn_baja_colab').val(peti);
    $('#btn_baja_alum').val(peti);
    console.log("Peticion: " + peti);
}

function ProcesarSolicitud(id){
    prevenir(event);
    var form_obs = $('form[id="'+id+'"]').serializeArray();
    console.log(form_obs); 
    if(peti== 2){
        aceptar(id);
    }
    if(peti== 4){
        rechazar(id);
    }
    if(peti== 6){
        enviar_investigacion(id);
    }
    if(peti == 8){
        enviar_gestion(id);
    }
}

