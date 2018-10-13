function prevenir(event){
  event.preventDefault();
}

function cancelar(){
  $('#myModal').modal('hide');
}

function FechaProrroga()
  {
    var opcion = document.getElementById("ProyectoSeleccionado").value;
    console.log(opcion)
    if(opcion=="Proyecto 1")
    {
       document.getElementById("FechaPresentacion").innerHTML="01/12/2016";
    }

    if(opcion=="Proyecto 2")
    {
       document.getElementById("FechaPresentacion").innerHTML="01/03/2017";
    }
    if(opcion=="Proyecto 3")
    {
       document.getElementById("FechaPresentacion").innerHTML="01/04/2017";
    }
    if(opcion=="Proyecto 4")
    {
       document.getElementById("FechaPresentacion").innerHTML="01/05/2017";
    }
  }
  function validaProrroga(dias)
  {
   var tiene = "";
   if (dias == 1){
    tiene = "día";
   }else{
    tiene = "días";
   }
   if(dias<0){
    swal(
    'Ya no puede solicitar la prórroga para este proyecto, la fecha de entrega ha pasado. \n Usted ha sido sancionado',
    '',
    'error'
   );
   }else{
   swal(
    'Ya no puede solicitar la prórroga para este proyecto, \n sólo tiene ' + dias + " "+ tiene +' para la entrega',
    '',
    'error'
   );
  }
  }
  function SolicitudEnviada(form)
  {
  prevenir(event);
  swal({
      title: '¿Seguro que desea realizar esta acción?',
      text: "Ya no podrá realizar algún cambio después",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar'
      }).then(function () {
        ajaxProrroga(form);
      });
  }

  function procesando(){
    swal({
      title: '¡ATENCIÓN!',
      text: "Ya fue solicitada la prórroga para este proyecto, \n espere una respuesta",
      type: 'warning',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar'
      });
  }

  function pr_aceptada(){
    swal({
      title: '¡ATENCIÓN!',
      text: "Su solicitud ha sido aceptada",
      type: 'success',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar'
      });
  }

  function pr_rechazada(){
     swal(
    'Lo sentimos, su solicitud ha sido rechazada',
    '',
    'error'
    );
    /*swal({
      title: '¡ATENCIÓN!',
      text: "Su solicitud ha sido rechazada",
      type: 'danger',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar'
      });*/
  }

  function ajaxProrrogaConsultas(id)
  {
    //botonVer= id;
    var apartado = $('#prorroga_text').text();
    var botonVer = '';
    //console.log("Apartado: " + apartado);
    if(apartado == 'Solicitud de prórroga'){
      accion = 'consultarProrroga';
      botonVer = $('#'+id).val();
    }else{
      accion = 'obtenerInfo';
      botonVer = id;
      $('#folio_pr').val(botonVer);
    }
    //console.log(botonVer);
    //prevenir(event);
    $.ajax(
    {
        async: true,
        type: 'GET',
        //ContentType = "application/json; charset=utf-8",        
        datatype: 'json',
        url: '../../Ajax/ajax_consultas_prorroga.php',
        data: {botonVer: botonVer, accion:accion},
        beforeSend: function()
        {
        },
        success: function(response){ 
           var json = JSON.parse(response);           
           console.log(json.estado);
           if(accion == 'obtenerInfo'){
              $('#proyecto').val(json.nombre_proyecto);
              $('#etapa').val(json.num_etapa);
              $('#motivo').val(json.motivo);
              $('#razones').val(json.razones);
              console.log("Observaciones de gestión: " + json.obs_G);
              $('#obs_prG').text(json.obs_G);
              $('#obs_prI').text(json.obs_I);
              $('#obs_prC').text(json.obs_C);
           }else if(json.estado == 'EN PRORROGA' || json.estado == 'EN PRORROGA INV.' || json.estado == 'EN PRORROGA COM.'){
              procesando();
           }else if(json.estado == 'PRORROGA A'){
              pr_aceptada();
           }else if(json.estado == 'PRORROGA R'){
              pr_rechazada();
           }else{
             console.log(json.fechaFin);
             var now = new Date();
             var actual = moment();
             actual = actual.format('YYYY-MM-DD');
             var entrega = new Date(json.fechaFin); 
             var mNow = moment(now);
             var mEntrega = moment(entrega);
             var diasRestantes = mEntrega.diff(mNow, 'days');
             console.log("Dias: " + diasRestantes + "\n" + "Fecha de hoy: " + actual + "\n");             
             $('#fecha_entrega').val(json.fechaFin);
             if(now < entrega && diasRestantes>3){
                 $('#solicita_prorroga').prop('disabled', false);
                 $('#fecha_solicitud').val(actual);
                 $('#folio_proy').val(json.folio)
                 $('#nombre_proyecto').val(json.nombreProy);
                 $('#numero_etapa').val(json.numEtapa);
             }else{
                 validaProrroga(diasRestantes);
                 $('#solicita_prorroga').prop('disabled', true);
             }
            }
           //console.log(data);
        },
        error: function(data) {       
        }
      });
  }

function muestraOtros(){
  var opc = $('#motivos').val();
  if(opc == "Otro"){
    $("#otros_motivos").html("<input type='text' autofocus placeholder='Escríbalo...' class='form-control' required rows='5' cols='200' id='otros_especifique', name='otros_especifique'>");
  }else{
    $('#otros_motivos').html('');
  }
}

function ajaxProrroga(id)
{
    prevenir(event);
    var form_obs = $('form[id="'+id+'"]').serializeArray();
    //alert(form_obs);
    console.log($('form[id="'+id+'"]').serializeArray());
    /*if(form_obs == null){
        $('#btnEnvSub').attr('disabled', true);
    }else{
        $('#btnEnvSub').attr('disabled', false);
    }*/
    $.ajax(
    {
        async: true,
        type: 'POST',
        url: '../../controladores/preregistro/insertar.php',
        data: $('#'+id).serializeArray(),
        beforeSend: function()
        {
        },
        success: function(data){
                //var f = JSON.parse(response); 
                console.log(data);
                swal(
                    'Solicitud enviada',
                    '',
                    'success'
                ).then(function () {  
                  location.reload();         
                }); 
              },
        error: function(data) {}
      });
}
  