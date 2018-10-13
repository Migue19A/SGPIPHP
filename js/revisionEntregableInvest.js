function mostrarProyecto(entregable)

{
	$.ajax(
    {
        async: true,
        type: 'POST',
        dataType: 'html',
        url: '../../Ajax/ajax_seguimiento.php?&entregable='+entregable,
        data: {
        	accion:'getEntregable'
        },
        beforeSend: function()
        {

        },
        success: function(data)
        {
        	$('#entregableForm').html(data);
        },
        error: function(data)
        {
        }
    });
}
function aceptar(entregable)
{
    $.ajax(
    {
        async: true,
        type: 'POST',
        dataType: 'html',
        url: '../../Ajax/ajax_seguimiento.php?&entregable='+entregable+'&accion=enviarSubdireccion',
        data: $('form').serialize(),
        beforeSend: function()
        {

        },
        success: function(data)
        {
            $('#entregableForm').html(data);
            window.reload();
        },
        error: function(data)
        {
        }
    });
}
function enviarRevision(destino)
{
    var form=$('form').serialize();
    $.ajax(
    {
        async: true,
        type: 'POST',
        dataType: 'html',
        url: '../../Ajax/ajax_seguimiento.php?&accion=enviar'+destino,
        data: form,
        beforeSend: function()
        {

        },
        success: function(data)
        {
            $('#entregableForm').html(data);
        },
        error: function(data)
        {
        }
    });
}