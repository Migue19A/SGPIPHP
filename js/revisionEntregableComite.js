function mostrarProyecto(entregable)

{
	$.ajax(
    {
        async: true,
        type: 'POST',
        dataType: 'html',
        url: '../../Ajax/ajax_seguimiento.php?&entregable='+entregable,
        data: {
        	accion:'getEntregableComite'
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
