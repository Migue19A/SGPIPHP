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
$(document).ready(function()
{
    var acc = document.getElementsByClassName("accordion");
    var i;
    for (i = 0; i < acc.length; i++) 
    {
      acc[i].onclick = function() 
      {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight)
        {
          panel.style.maxHeight = null;
        } else 
        {
          panel.style.maxHeight = panel.scrollHeight + "px";
        } 
      }
    }
    $(document).on('click', '.panel-heading span.clickable',function(e)
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
    });
});