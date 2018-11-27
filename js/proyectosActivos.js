$(document).ready(function()
{
    $("#notificationLink").click(function()
    {
        $("#notificationContainer").fadeToggle(300);
        $("#notification_count").fadeOut("slow");
        return false;
    });
});
function getDatosProyecto(proyecto)
{
    // swal(
    // {
    //   title: '¿Finalizar reactivación?',
    //   text: "",
    //   type: 'warning',
    //   showCancelButton: true,
    //   confirmButtonColor: '#3085d6',
    //   cancelButtonColor: '#d33',
    //   confirmButtonText: 'Si, finalizar'
    // }).then(function () 
    // {
        $.ajax(
        {
            async: true,
            type: 'POST',
            dataType: 'html',
            url: '../../Ajax/ajax_seguimiento.php',
            data: 
            {
                accion: 'proyectosActivos',
                proyecto:proyecto
            },
            beforeSend: function()
            {
            },
            success: function(data)
            {
                $('#bodyProyectosActivos').html(data);
            },
            error: function(data)
            {
            }
        });
        // $('#myModal').modal('hide');
    // })
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