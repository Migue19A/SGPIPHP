function consultarProyecto(proyecto)
{
	$.ajax(
	{
		async: true,
		type: 'GET',
		dataType: 'html',
		url: '../../Ajax/ajax_consultas_proyectos.php',
		data: 
		{
			accion: 'consultaProyectoComite',
			proyecto:proyecto
		},
		beforeSend: function()
		{
			$('#divFormularioRegistro').html();
		},
		success: function(data)
		{
			$('#divFormularioRegistro').html(data);
			var acc = document.getElementsByClassName("accordion");
			var i;
			for (i = 0; i < acc.length; i++) 
			{
				acc[i].onclick = function() {
				  	this.classList.toggle("active");
				  	var panel = this.nextElementSibling;
				  	if (panel.style.maxHeight){
				    	panel.style.maxHeight = null;
				  	} else {
				    	panel.style.maxHeight = panel.scrollHeight + "px";
				  	} 
				}
			}
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
          	});
		},
		error: function(data)
		{
		}
	});
}
function guardarObservaciones(estado)
{
	var form =$('#formObsInvest').serialize();
	$.ajax(
	{
		async: true,
		type: 'POST',
		dataType: 'html',
		url: '../../controladores/preregistro/insertar.php?&accion=observacionesRegistroComite&estado='+estado,
		data: form,
		beforeSend: function()
		{
		},
		success: function(data)
		{
		},
		error: function(data)
		{
		}
	});
}