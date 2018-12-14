function login(){
	var usuario=$('#Usuario').val();
	var password=$('#password').val();
	$.ajax(
	{
		async: true,
		type: 'GET',
		dataType: 'json',
		url: '../Ajax/ajax_consultas_proyectos.php',
		data: 
		{
			accion: 'login',
			usuario:usuario,
			password:password
		},
		beforeSend: function()
		{
			$('#Usuario').prop('disabled',true);
			$('#password').prop('disabled',true);
		},
		success: function(data)
		{
			if (data.resultado==1) {
				alert("Ha iniciado sesion correctamente");
				if (data.tipoUsuario='Docente') {
					// location.href('');
				}
				if (data.tipoUsuario='Gestion') {
					// location.href('');
				}
				if (data.tipoUsuario='Investigacion') {
					// location.href('');
				}
				if (data.tipoUsuario='Comite') {
					// location.href('');
				}
			}
			else if (data.resultado==0) 
			{
				alert("Error en usuario o contrase\u00F1a");
				$('#Usuario').prop('disabled',false);
				$('#password').prop('disabled',false);
				$('#Usuario').val('');
				$('#password').val('');

			}
		},
		error: function(data)
		{
		}
	});
}