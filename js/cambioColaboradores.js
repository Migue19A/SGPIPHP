function obtenerColaborador_Cambio(fol){
    //prevenir(event);
    var folio = fol;
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

function obC_altaColaborador(numero_cont, id){
    //prevenir(event);
    console.log("id"+ id);
    var noControl = numero_cont;
    $.ajax(
    {
        async: true,
        type: 'GET',
        //ContentType = "application/json; charset=utf-8",        
        datatype: 'json',
        url: '../../Ajax/ajax_consultas_proyectos.php',
        data: {noControl: noControl, accion:'consultarColaborador'},
        beforeSend: function()
        {
        },
        success: function(response){            
            var json = JSON.parse(response);
            $('#apPaternoCol_'+id).val(json.paterno);
            $('#apMaternoCol_'+id).val(json.materno);
            $('#nombreCol_'+id).val(json.Nombre);
            $('#gradMaximoCol_'+id).val(json.maxEstudios);
            $('#academiaCol_'+id).val(json.academia);
            $('#numPersonalCol_'+id).val(json.NoPersonal);
            $('#movilCol_'+id).val(json.celular);
            $('#correoInstCol_'+id).val(json.correo_inst);
        },
        error: function(data) {       
        }
      });
}