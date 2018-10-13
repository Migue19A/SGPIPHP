function mostrarProyecto(entregable)

{
	$.ajax(
    {
        async: true,
        type: 'POST',
        dataType: 'html',
        url: '../../Ajax/ajax_seguimiento.php?&entregable='+entregable,
        data: {
        	accion:'getEntregableGest'
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
function GuardarObs(entregable)
{
    var form =$('#Observ').serialize();
    $.ajax(
    {
        async: true,
        type: 'POST',
        dataType: 'html',
        url: '../../Ajax/ajax_seguimiento.php?&entregable='+entregable+'&accion=enviarSubdireccion',
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
function RegresarInvestigacion(entregable)
{
    $.ajax(
    {
        async: true,
        type: 'POST',
        dataType: 'html',
        url: '../../Ajax/ajax_seguimiento.php?&entregable='+entregable+'&accion=aceptaEntrega',
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