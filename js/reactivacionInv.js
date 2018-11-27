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
function cargaInfoDocente(docente)
{
  $.ajax(
        {
            async: true,
            type: 'POST',
            dataType: 'html',
            url: '../../Ajax/ajax_reactivacion.php',
            data: 
            {
                accion: 'docenteHistorial',
                docente:docente
            },
            beforeSend: function()
            {
            },
            success: function(data)
            {
              $('#historialDocente').html(data);
            },
            error: function(data)
            {
            }
        });
  $.ajax(
        {
            async: true,
            type: 'POST',
            dataType: 'html',
            url: '../../Ajax/ajax_reactivacion.php',
            data: 
            {
                accion: 'docenteInfo',
                docente:docente
            },
            beforeSend: function()
            {
            },
            success: function(data)
            {
              $('#datosDocente').html(data);
            },
            error: function(data)
            {
            }
        });
}

function verSolicitud(proyecto)
{
  $.ajax(
    {
        async: true,
        type: 'POST',
        dataType: 'html',
        url: '../../Ajax/ajax_reactivacion.php',
        data: 
        {
            accion: 'revisaSol',
            proyecto:proyecto
        },
        beforeSend: function()
        {
        },
        success: function(data)
        {
          $('#modalForm').html(data);
        },
        error: function(data)
        {
        }
    });
}
function aceptar()
{
    var proyecto =$('#folioProyecto').val();
    var observaciones=$('#observaciones').val();
    $.ajax(
    {
        async: true,
        type: 'POST',
        dataType: 'html',
        url: '../../Ajax/ajax_reactivacion.php',
        data: 
        {
            accion: 'aceptarReactivacion',
            proyecto:proyecto,
            observaciones:observaciones,
            departamento:2
        },
        beforeSend: function()
        {
        },
        success: function(data)
        {
          $('#modalForm').html(data);
          location.reload();
        },
        error: function(data)
        {
        }
    });
}
function enviarComite()
{
    var proyecto =$('#folioProyecto').val();
    var observaciones=$('#observaciones').val();
    $.ajax(
    {
        async: true,
        type: 'POST',
        dataType: 'html',
        url: '../../Ajax/ajax_reactivacion.php',
        data: 
        {
            accion: 'enviarSolicitudReact',
            proyecto:proyecto,
            observaciones:observaciones,
            departamento:2
        },
        beforeSend: function()
        {
        },
        success: function(data)
        {
          $('#modalForm').html(data);
          location.reload();
        },
        error: function(data)
        {
        }
    });
}
function rechazar()
{
    var proyecto =$('#folioProyecto').val();
    var observaciones=$('#observaciones').val();
    $.ajax(
    {
        async: true,
        type: 'POST',
        dataType: 'html',
        url: '../../Ajax/ajax_reactivacion.php',
        data: 
        {
            accion: 'rechazarSolicitudReact',
            proyecto:proyecto,
            observaciones:observaciones,
            departamento:2
        },
        beforeSend: function()
        {
        },
        success: function(data)
        {
          $('#modalForm').html(data);
          location.reload();
        },
        error: function(data)
        {
        }
    });
}