
function palabrasClave(e) {
    var tecla = (document.all) ? e.keyCode : e.which;
    patron = /[A-Z,a-z,á,é,í,ó,ú,Á,É,Í,Ó,Ú]/;
    tecla_final = String.fromCharCode(tecla);
    if (patron.test(tecla_final) == true) {
        return true;
    } else {
        return false;
    }
}

function validaN(e) {
    var tecla = (document.all) ? e.keyCode : e.which;
    patron = /[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    if (patron.test(tecla_final) == true) {
        return true;
    } else {
        return false;
    }
}

function ValidaMaximo() {
    valorA = document.getElementById("totalA").value;
    hacer = 0;
    if (valorA > 20) {
        alert("Número excedido");
        document.getElementById("totalA").value = 0;
        document.getElementById("totalA").focus();
    }
}

function TAlum() {
    var elmtTable = document.getElementById("tablaAlu");
    var tableRows = elmtTable.getElementsByTagName('tr');
    var rowCount = tableRows.length;
    for (var x = rowCount - 1; x > 0; x--) {
        elmtTable.removeChild(tableRows[x]);
    }
    var total = document.getElementById("totalA").value;
    for (i = 0; i < total; i++) {
        var fila = "<div class='form-group col-md-6' style='margin-top: 30px;'>                                                     <label>* S.S.= Servicio Social, R.P.= Residencia Profesional, T= Tesis</label>                                             </div>                                             <div class='form-group col-md-12'>                                                  <h2 style='text-align: center;'>Alumno colaborador " + (i + 1) + "°</h2>                                             </div>                                             <div class='row'>                                                 <div class='form-group col-md-6'>                                                     <label>Nombre del alumno</label>                                                     <input class='form-control' type='text'>                                                 </div>                                                 <div class='form-group col-md-2'>                                                     <label><input type='checkbox' style='margin-top: 35px;'>S.S</label>                                                 </div>                                                 <div class='form-group col-md-2'>                                                     <label><input type='checkbox' style='margin-top: 35px;'>R.P</label>                                                 </div>                                                 <div class='form-group col-md-2'>                                                     <label><input type='checkbox' style='margin-top: 35px;'>T</label>                                                 </div>                                             </div>                                             <div class='row'>                                                 <div class='form-group col-md-4'>                                                     <label>N° control</label>                                                     <input type='number' class='form-control'>                                                 </div>                                                 <div class='form-group col-md-4'>                                                     <label>Semestre</label>                                                     <input type='text' class='form-control'>                                                 </div>                                                 <div class='form-group col-md-4'>                                                     <label>Carrera</label>                                                     <select class='form-control'>                                                         <option>Seleccione una carrera</option>                                                         <option>Ingenieria en sistemas computacionales</option>                                                         <option>Ingenieria industrial</option>                                                         <option>Ingenieria en industrias alimentarias</option>                                                         <option>Ingenieria civil</option>                                                         <option>Ingenieria electronica</option>                                                         <option>Ingenieria electromecanica</option>                                                         <option>Ingenieria bioquimica</option>                                                         <option>Ingenieria en gestion empresarial</option>                                                         <option>Ingeneiria mecatronica</option>                                                         <option>Gastronomia</option>                                                     </select>                                                 </div>                                                 <div class='form-group col-md-12'>                                                     <label>Detalle de actividades</label>                                                     <textarea class='form-control' rows='6' style='resize: none; width: 98%;'></textarea>                                                 </div>                                                 <div class='form-group col-md-12'>                                                     <h5><b>NOTA:</b>La cantidad de alumnos colaboradores depende de la complejidad del proyecto, como máximo 20 alumnos</h5>                                                 </div>";
        var btn = document.createElement("tr");
        btn.innerHTML = fila;
        document.getElementById("tablaAlu").appendChild(btn);
    }
}



function muestra_colaborador(id) {
    var colaboradores=$('#'+id).val();
    $('#colaboradores').html('');
    for (var i = 0; i < (colaboradores-1); i++) 
    {
        $('#colaboradores').prepend($('#colaborador').html());
    }
    var i=1;
    $('h3[id*=tituloColaborador]').each(function()
    {
        $(this).html('Colaborador '+i);
        i++;
    });
    i=1;
    $('input[id*=apPaternoCol_]').each(function()
    {
        $(this).attr('id','apPaternoCol_'+i);
        i++;
    });
    i=1;
    $('input[id*=apMaternoCol_]').each(function()
    {
        $(this).attr('id','apMaternoCol_'+i);
        i++;
    });
    i=1;
    $('input[id*=nombreCol_]').each(function()
    {
        $(this).attr('id','nombreCol_'+i);
        i++;
    });
    i=1;
    $('input[id*=gradMaximoCol_]').each(function()
    {
        $(this).attr('id','gradMaximoCol_'+i);
        i++;
    });
    i=1;
    $('select[id*=academiaCol_]').each(function()
    {
        $(this).attr('id','academiaCol_'+i);
        i++;
    });
    i=1;
    $('input[id*=numPersonalCol_]').each(function()
    {
        $(this).attr('id','numPersonalCol_'+i);
        i++;
    });
    i=1;
    $('input[id*=movilCol_]').each(function()
    {
        $(this).attr('id','movilCol_'+i);
        i++;
    });
    i=1;
    $('input[id*=correoInstCol_]').each(function()
    {
        $(this).attr('id','correoInstCol_'+i);
        i++;
    });
    i=1;
    $('input[id*=correoAltCol_]').each(function()
    {
        $(this).attr('id','correoAltCol_'+i);
        i++;
    });
    i=1;
    $('textarea[id*=principalesActCol_]').each(function()
    {
        $(this).attr('id','principalesActCol_'+i);
        i++;
    });
}

function muestra_etapas() {
    opcion = document.getElementById("opcion_etapas").value;
    if (opcion == 1) {
        document.getElementById("etapa2").className = "hidden";
        document.getElementById("etapa3").className = "hidden";
        document.getElementById("etapa4").className = "hidden";
    }
    if (opcion == 2) {
        document.getElementById("etapa2").className = "";
        document.getElementById("etapa3").className = "hidden";
        document.getElementById("etapa4").className = "hidden";
    }
    if (opcion == 3) {
        document.getElementById("etapa2").className = "";
        document.getElementById("etapa3").className = "";
        document.getElementById("etapa4").className = "hidden";
    }
    if (opcion == 4) {
        document.getElementById("etapa2").className = "";
        document.getElementById("etapa3").className = "";
        document.getElementById("etapa4").className = "";
    }
}

function sumar() {
    var valor1 = verificar("infraestructura");
    var valor2 = verificar("consumibles");
    var valor3 = verificar("licencias");
    var valor4 = verificar("viáticos");
    var valor5 = verificar("publicaciones");
    var valor6 = verificar("equipo");
    var valor7 = verificar("patentes");
    var valor8 = verificar("otros");
    document.getElementById("total").value = parseFloat(valor1) + parseFloat(valor2) + parseFloat(valor3) + parseFloat(valor4) + parseFloat(valor5) + parseFloat(valor6) + parseFloat(valor7) + parseFloat(valor8);
    console.log(document.getElementById("total").value);
}

function verificar(id) {
    var obj = document.getElementById(id);
    if (obj.value == "") value = "0";
    else value = obj.value;
    if (validate_importe(value, 1)) {
        obj.style.borderColor = "#808080";
        return value;
    } else {
        obj.style.borderColor = "#f00";
        return 0;
    }
}

function validate_importe(value, decimal) {
    if (decimal == undefined) decimal = 0;
    if (decimal == 1) {
        var patron = new RegExp("^[0-9]+((,|\.)[0-9]{1,2})?$");
    } else {
        var patron = new RegExp("^([0-9])*$")
    }
    if (value && value.search(patron) == 0) {
        return true;
    }
    return false;
}

function habilitarEspecifique() {
    if (document.getElementById('id_tipoSector_5').checked) {
        document.getElementById('id_especifique').removeAttribute('readonly');
    } else {
        //document.getElementById('id_especifique').readonly = "readonly";
        $('#id_especifique').attr('readonly', true);
    }
}

function vinculacionConvenio() {
    var $elegido = $("input[name=convenio]:checked");
    var r = $elegido.val();
    if (r == "si") {
        document.getElementById('vincula').className = "row";
        document.getElementById('descripcionV').required = "required";
        document.getElementById('nombreV').required = "required";
        document.getElementById('telefonoV').required = "required";
        document.getElementById('areaV').required = "required";
        document.getElementById('direccionV').required = "required";
        document.getElementById('organizacionV').required = "required";
    }
    if (r == "no") {
        document.getElementById('vincula').className = "row hidden";
        document.getElementById('descripcionV').removeAttribute('required');
        document.getElementById('nombreV').removeAttribute('required');
        document.getElementById('telefonoV').removeAttribute('required');
        document.getElementById('areaV').removeAttribute('required');
        document.getElementById('direccionV').removeAttribute('required');
        document.getElementById('organizacionV').removeAttribute('required');
    }
}

function respuestaF() {
    var $elegido = $("input[name=aporta]:checked");
    var r = $elegido.val();
    if (r == "si") {
        document.getElementById('respuesta').className = "row";
        document.getElementById('descriptionR').required = "required";
    }
    if (r == "no") {
        document.getElementById('respuesta').className = "row hidden";
        document.getElementById('descriptionR').removeAttribute('required');
    }
}

function muestraFina() {
    var $elegido = $("input[name=financi]:checked");
    var r = $elegido.val();
    if (r == "si") {
        document.getElementById('financiamientoSi').className = "row";
    }
    if (r == "no") {
        document.getElementById('financiamientoSi').className = "row hidden";
    }
}

function Finalizar() {
    swal({
        title: '¿Finalizar pre-registro?',
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, guardar'
    }).then(function() {
        swal('Solicitud enviada', '', 'success').then(function(dimiss) {
            if (dimiss == true) {
                location.href = "Finalizar"
            }
        })
    })
}

function step1Next() {
    //You can make only one function for next, and inside you can check the current step
    if (true) { //Insert here your validation of the first step
        currentStep += 1;
        $('#navStep' + currentStep).removeClass('disabled');
        $('#navStep' + currentStep).click();
    }
}

function prevStep() {
    //Notice that the btn prev not exist in the first step
    currentStep -= 1;
    $('#navStep' + currentStep).click();
}

function step2Next() {
    if (true) {
        $('#navStep3').removeClass('disabled');
        $('#navStep3').click();
    }
}

function step3Next() {
    if (true) {
        $('#navStep4').removeClass('disabled');
        $('#navStep4').click();
    }
}

function step4Next() {
    if (true) {
        $('#navStep5').removeClass('disabled');
        $('#navStep5').click();
    }
}

function step5Next() {
    if (true) {
        $('#navStep6').removeClass('disabled');
        $('#navStep6').click();
    }
}

function step6Next() {
    if (true) {
        $('#navStep7').removeClass('disabled');
        $('#navStep7').click();
    }
}

function step7Next() {
    if (true) {
        $('#navStep8').removeClass('disabled');
        $('#navStep8').click();
    }
}

function step8Next() {
    if (true) {
        $('#navStep9').removeClass('disabled');
        $('#navStep9').click();
    }
}

$(document).ready(function(){
     $('#recepcion_form').on('submit', function(e){
        e.preventDefault();
        var url = "controladores/preregistro/insertar.php";
        var form = $('#recepcion_form').serialize();        
        var nombreB = $('#btn-ingresar').val();
        var checkEsp = $('#id_tipoSector_5').val();
        console.log("CajaV: "+ checkEsp);
    
        $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: form,
           success: step1Next()
        });
     });
});

function habilitarEspecifique() {
    if($('#tipo_sector').val()==0){
        document.getElementById('id_especifique').removeAttribute('readonly');
        $('#id_especifique').attr('required', false);
    }else{
         $('#id_especifique').attr('readonly', true);
         $('#id_especifique').attr('required',true);
    }
}
