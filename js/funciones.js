$(document).ready(function(){
	/*$('#btnP').click(function(){
		var field = $('#campo1').val();
		var field2 = $('#campo2').val();
		console.log("Campo1: " + field + "\n" + "Campo2: "+ field2);
	});*/	
	//window.onload=actualizar();
});

function leer(){
	var url = "externas/pruebaConsulta.php";
	var nombreB = $('#btn-ingresar').val();
	
        $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: $("#formulario").serialize(), 
           success: function(data)             
           {
             $('#resp').html(data);               
           }
       });
}

function eliminar(){
		var boton= $('#btnE').attr("name");
		$.ajax({
			type:"POST",
			dataType:'json',
			url:'externas/pruebaConsulta.php',
			data:{button:boton},
			success:function(response){
				$('#recarga').load(' #recarga');
				alert("Dato: "+ response.btn);		
			},
		});		
}

function insertar(){
		var campo1=$('#first_name').val().toUpperCase();
		var campo2=$("#last_name").val().toUpperCase();
		var boton= $('#btn').attr("name");
		$.ajax({
			type:"POST",
			dataType:'json',
			url:'externas/pruebaConsulta.php',
			success:function(response){
				//alert("Dato 1: "+response.f1+"\n"+"Dato 2: "+ response.f2+"\n"+"Dato 3: "+ response.btn);					
				$('#recarga').load(' #recarga')		
			},
			error:function(){
				alert('Error general en el sistema');
			}
		});
}

