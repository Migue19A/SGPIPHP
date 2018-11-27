$(document).ready(function()
{
    $("#notificationLink").click(function()
    {
        $("#notificationContainer").fadeToggle(300);
        $("#notification_count").fadeOut("slow");
        return false;
    });
});
function finalizarReactivacion(proyecto)
{
    swal(
    {
      title: '¿Finalizar reactivación?',
      text: "",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, finalizar'
    }).then(function () 
    {
        var motivo=$('#motivoReact').val();
        $.ajax(
        {
            async: true,
            type: 'POST',
            dataType: 'html',
            url: '../../Ajax/ajax_reactivacion.php',
            data: 
            {
                accion: 'solicitaReact',
                proyecto:proyecto,
                motivo:motivo
            },
            beforeSend: function()
            {
            },
            success: function(data)
            {
                swal(
                'Solicitud enviada',
                '',
                'success'
                );
                location.reload();  
            },
            error: function(data)
            {
            }
        });
        $('#myModal').modal('hide');
    })
}
function reactivar(proy)
{
    $('#modalReact').modal('show');
    $('#btnEnviar').attr('onclick',"finalizarReactivacion('"+proy+"')");
}
function restablecer()
{
    document.getElementById("reactiva").innerHTML="";
    document.getElementById("reactiva").innerHTML="Aceptar";
}