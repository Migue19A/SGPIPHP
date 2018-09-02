$(document).ready(function()
{
	$('tr').each(function()
	{
		$(this).on('click',function()
		{
			seleccionar(this.id);
			$('tr').each(function()
			{
				$(this).removeClass('bg-info');
			})
			$(this).addClass('bg-info');
		});
	});
});
function seleccionar(tr){
	$('#filaSeleccionada').val(tr);
}
function cambiarEstado(estado)
{
	var usuario=$('#filaSeleccionada').val();
	$.ajax(
	{
		async: true,
		type: 'GET',
		dataType: 'json',
		url: '../../Ajax/ajax_consultas_proyectos.php',
		data: {
			accion: 'cambiarEstadoUsuario',
			estado:estado,
			usuario:usuario
		},
		beforeSend: function()
		{
			$('#btnBuscar').prop('disabled',true);
			$('#btnAlta').prop('disabled',true);
			$('#btnHabilitar').prop('disabled',true);
			$('#btnBaja').prop('disabled',true);
			$('#btnHistorial').prop('disabled',true);
			$('#btnEditar').prop('disabled',true);
		},
		success: function(data)
		{
			$('#btnBuscar').prop('disabled',false);
			$('#btnAlta').prop('disabled',false);
			$('#btnHabilitar').prop('disabled',false);
			$('#btnBaja').prop('disabled',false);
			$('#btnHistorial').prop('disabled',false);
			$('#btnEditar').prop('disabled',false);
			if (data.resultado==1) {
				alert("Cambio realizado con exito");
				location.reload();
			}
			else
			{
				alert("Ocurrio un error");
			}
		},
		error: function(data)
		{
		}
	});

}
function altaUsuario()
{
	$.ajax(
	{
		async: true,
		type: 'POST',
		dataType: 'json',
		url: '../../Ajax/ajax_consultas_proyectos.php',
		data: $('#formAltaUsuario').serialize(),
		beforeSend: function()
		{
			$('#btnAltaUsuario').prop('disabled',true);
		},
		success: function(data)
		{	
			$('#btnAltaUsuario').prop('disabled',false);
			if (data.resultado==1) 
			{
				alert("Usuario creado con exito");
				location.reload();
			}
			else
			{
				alert("Ocurrio un error");
			}
		},
		error: function(data)
		{
		}
	});
}
function editarUsuario()
{
	var usuario=$('#filaSeleccionada').val();
	$.ajax(
	{
		async: true,
		type: 'POST',
		dataType: 'json',
		url: '../../Ajax/ajax_consultas_proyectos.php?&usuario='+usuario,
		data: $('#formEditaUsuario').serialize(),
		beforeSend: function()
		{
			$('#btnEditarUsuario').prop('disabled',true);
		},
		success: function(data)
		{	
			$('#btnEditarUsuario').prop('disabled',false);
			if (data.resultado==1) 
			{
				alert("Usuario editado con exito");
				location.reload();
			}
			else
			{
				alert("Ocurrio un error");
			}
		},
		error: function(data)
		{
		}
	});
}