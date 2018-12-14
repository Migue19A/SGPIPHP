function obtenerDatosProyecto(fol){
    //prevenir(event);
    $.ajax(
    {
        async: true,
        type: 'GET',
        //ContentType = "application/json; charset=utf-8",        
        datatype: 'HTML',
        url: '../../Ajax/ajax_historialDocente.php',
        data: {folioProy: fol, accion:'consultarProyectosDocente'},
        beforeSend: function()
        {
            $('#proyectos_docente').html();
        },
        success: function(data){         
            $('#proyectos_docente').html(data);
        },
        error: function(data) {       
        }
      });
}

function cargarDatosHistorial(folio, nombre_proy, responsable, fecha1, carrera, fecha2){
    $('#nombre_proy').val(nombre_proy);
    $('#responsable_proy').val(responsable);
    $('#fecha_pre').val(fecha1);
    $('#carrera_proy').val(carrera);
    $('#fecha_fin').val(fecha2);
    $.ajax(
    {
        async: true,
        type: 'GET',
        //ContentType = "application/json; charset=utf-8",        
        datatype: 'HTML',
        url: '../../Ajax/ajax_historialDocente.php',
        data: {folioProy: folio, accion:'consultarColaboradoresEtapasProyecto'},
        beforeSend: function()
        {
            $('#colaboradores_etapas').html();
        },
        success: function(data){         
            $('#colaboradores_etapas').html(data);
        },
        error: function(data) {       
        }
      });
}