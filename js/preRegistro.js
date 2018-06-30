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
        $(this).attr('name','apPaternoCol_'+i);
        i++;
    });
    i=1;
    $('input[id*=apMaternoCol_]').each(function()
    {
        $(this).attr('id','apMaternoCol_'+i);
        $(this).attr('name','apMaternoCol_'+i);
        i++;
    });
    i=1;
    $('input[id*=nombreCol_]').each(function()
    {
        $(this).attr('id','nombreCol_'+i);
        $(this).attr('name','nombreCol_'+i);
        i++;
    });
    i=1;
    $('input[id*=gradMaximoCol_]').each(function()
    {
        $(this).attr('id','gradMaximoCol_'+i);
        $(this).attr('name','gradMaximoCol_'+i);
        i++;
    });
    i=1;
    $('select[id*=academiaCol_]').each(function()
    {
        $(this).attr('id','academiaCol_'+i);
        $(this).attr('name','academiaCol_'+i);
        i++;
    });
    i=1;
    $('input[id*=numPersonalCol_]').each(function()
    {
        $(this).attr('id','numPersonalCol_'+i);
        $(this).attr('name','numPersonalCol_'+i);
        i++;
    });
    i=1;
    $('input[id*=movilCol_]').each(function()
    {
         $(this).attr('id','movilCol_'+i);
        $(this).attr('name','movilCol_'+i);
        i++;
    });
    i=1;
    $('input[id*=correoInstCol_]').each(function()
    {
        $(this).attr('name','correoInstCol_'+i);
        i++;
    });
    i=1;
    $('input[id*=correoAltCol_]').each(function()
    {
        $(this).attr('id','correoAltCol_'+i);
        $(this).attr('name','correoAltCol_'+i);
        i++;
    });
    i=1;
    $('textarea[id*=principalesActCol_]').each(function()
    {
        $(this).attr('id','principalesActCol_'+i);
        $(this).attr('name','principalesActCol_'+i);
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
    var infra = $('#infraestructura').val();
    var cons = $('#consumibles').val();
    var lic = $('#licencias').val();
    var via= $('#viaticos').val();
    var publi = $('#publicaciones').val();
    var equipo = $('#equipo').val();
    var paten = $('#patentes').val();
    var otros = $('#otros_finan').val();

    var valor1 = parseFloat(infra);
    var valor2 = parseFloat(cons);
    var valor3 = parseFloat(lic);
    var valor4 = parseFloat(via);
    var valor5 = parseFloat(publi);
    var valor6 = parseFloat(equipo);
    var valor7 = parseFloat(paten);
    var valor8 = parseFloat(otros);

    if(valor8 != 0){
        $('#otro_especificar').attr('readonly', false);
        $('#otro_especificar').attr('required', true);
    }else{
        $('#otro_especificar').attr('readonly', true);
        $('#otro_especificar').attr('required', false);
    }
    var total = valor1 + valor2 + valor3 + valor4 + valor5 + valor6 + valor7 + valor8;
    $('#total').val(total);
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
    var $elegido = $("input[name=financiamientoR]:checked");
    var r = $elegido.val();
    if (r == "si") {
        document.getElementById('financiamientoSi').className = "row";
        $('#fSi').attr("required", true);
        $('#fSI').attr("required", true);
        financiar();
        $('#infraestructura').attr('readonly', true);
        $('#consumibles').attr('readonly', true);
        $('#licencias').attr('readonly', true);
        $('#viaticos').attr('readonly', true);
        $('#publicaciones').attr('readonly', true);
        $('#equipo').attr('readonly', true);
        $('#patentes').attr('readonly', true);
        $('#otros_finan').attr('readonly', true);
        $('#total').attr('readonly', true);
        $('#otro_especificar').attr('readonly', true);
    }
    if (r == "no") {
        document.getElementById('financiamientoSi').className = "row hidden";
        $('#fSi').attr("required", false);
        $('#fSI').attr("required", false);
        $('#infraestructura').attr('readonly', false);
        $('#consumibles').attr('readonly', false);
        $('#licencias').attr('readonly', false);
        $('#viaticos').attr('readonly', false);
        $('#publicaciones').attr('readonly', false);
        $('#equipo').attr('readonly', false);
        $('#patentes').attr('readonly', false);
        $('#otros_finan').attr('readonly', false);
        $('#total').attr('readonly', false);        
        $('#especificarF').attr('readonly', true);
        $('#especificarF').attr('required', false);
    }
}


function financiar(){
    var radioFinan= $("input[name=fsi]:checked").val();
    if(radioFinan== "interno" || radioFinan=="externo"){
        $('#especificarF').attr('readonly', false);
        $('#especificarF').attr('required', true);
    }else{
        $('#especificarF').attr('readonly', true);
        $('#especificarF').attr('required', false);
    }   
}

function Finalizar() {
    // TÉCNICO, LICENCIATURA, ESPECIALIDAD, MAESTRÍA, DOCTORADO, POSDOCTORADO
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
                location.href = "finalizar.php"
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

/*$(document).ready(function(){
     $('#recepcion_form').on('submit', function(e){
        e.preventDefault();
        var url = "controladores/preregistro/insertar.php";
        var form = $('#recepcion_form').serialize();
    
        $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: form,
           success: function(data){
                console.log(data);
                step1Next();
           }
        });
     });
});*/

function habilitarEspecifique() {
    if($('#tipo_sector').val()==6){
        document.getElementById('id_especifique').removeAttribute('readonly');
        $('#id_especifique').attr('required', false);
    }else{
         $('#id_especifique').attr('readonly', true);
         $('#id_especifique').attr('required',true);
    }
}

function validarNombre(){
    var namep = $('#nombre_proyecto').val().trim();
    var url = "controladores/preregistro/ValidacionesAjax.php";
    $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: {accion:'validarNombre', nombreP:namep},
           success: function(data){
                $('#error_nombre').text(data);
                if(data== "Proyecto existente"){
                    $('#nombre_proyecto').focus();
                }
                
           }
        });
}

Date.prototype.mes = function() {
  var m = this.getMonth() + 1; // getMonth() is zero-based
  return (m>9 ? '' : '0') + m;
};

Date.prototype.segundos = function() {
  var s = this.getSeconds();
  return (s>9 ? '' : '0') + s;
};

function cambiarFecha(){
    var fechaIni= $('#fechaFin').val();
    console.log(fechaIni);                  
    var diasMaximo = 730;
    var diasMinimo = 182;
    var fechaMax = new Date(fechaIni);
    var fechaMin = new Date(fechaIni);
    fechaMax.setDate(fechaMax.getDate()+diasMaximo);
    fechaMin.setDate(fechaMin.getDate()+diasMinimo);
    var fechaSQLM = fechaMax.getFullYear()+"-"+ fechaMax.mes()+"-"+fechaMax.getDate();
    var fechaSQLm = fechaMin.getFullYear()+"-"+ fechaMin.mes()+"-"+fechaMin.getDate();
    console.log("Fecha Máxima: "+ fechaSQLM);
    console.log("Fecha Mínima: "+ fechaSQLm);
    $('#fechaFin').attr('min', fechaSQLm);
    $('#fechaFin').attr('max', fechaSQLM);  
    $('#fechaFin').val(fechaSQLm); 
}

/*function ajaxPreregistro(id)
{
    //console.log($('form[id="'+id+'"]').serializeArray());
    //e.preventDefault();
    $('#'+id).on('submit', function(e){
    e.preventDefault();
    var url = "controladores/preregistro/insertar.php";
    var form = $('#'+id).serializeArray();
    $.ajax(
    {
        async: true,
        type: 'POST',
        url: url,
        data: form,
        beforeSend: function()
        {
        },
        success: step1Next(),
        error: function(data) {}
      });
    });
}*/

function prevenir(event){
    event.preventDefault();
}

function ajaxPreregistro(id)
{
    console.log($('form[id="'+id+'"]').serializeArray());
    prevenir(event);
    $.ajax(
    {
        async: true,
        type: 'POST',
        url: 'controladores/preregistro/insertar.php',
        data: $('#'+id).serializeArray(),
        beforeSend: function()
        {
        },
        success: function(data){
                console.log(data);
                step1Next()
        },
        error: function(data) {}
      });
}

function anexarFolio(){
    var folio = $('#folio_proyecto1').val();
    var i=2;
    while (i<=9){        
        var anexar= 'folio_proyecto'+i;
        $('#'+ anexar).val(folio); 
        i++;
    }

}

function productosHabilitar(){
    if($('#intelectual').is(':checked') ){
        $('#intelectualText').attr('readonly', false);
        $('#intelectualText').attr('required', true);
    }else{
        $('#intelectualText').attr('readonly', true);
        $('#intelectualText').attr('required', false);
    }

    if($('#otros').is(':checked') ){
        $('#otrosText').attr('readonly', false);
        $('#otrosText').attr('required', true);
    }else{
        $('#otrosText').attr('readonly', true);
        $('#otrosText').attr('required', false);
    }
}

function crearEtapas(id)
{
    $('#divEtapa').html('');
    var numeroEtapas=$('#'+id).val();
    var etapa=$('#etapa').html();
    var i=1;
    for (var i = 0; i < (numeroEtapas-1); i++) 
    {
        $('#divEtapa').prepend(etapa);
    }
    i=1;
    $('h3[id*="tituloEtapa_"]').each(function()
    {
        $(this).text('Etapa '+i);
        i++;
    });
    i=1;
    $('input[id*="nombreEtapa_"]').each(function()
    {
        $(this).attr('id','nombreEtapa_'+i);
        $(this).attr('name','nombreEtapa_'+i);
        i++;
    });
    i=1;
    $('input[id*="inicioEtapa_"]').each(function()
    {
        $(this).attr('id','inicioEtapa_'+i);
        $(this).attr('name','inicioEtapa_'+i);
        i++;
    });
    i=1;
    $('input[id*="finalEtapa_"]').each(function()
    {
        $(this).attr('id','finalEtapa_'+i);
        $(this).attr('name','finalEtapa_'+i);
        i++;
    });
    i=1;
    $('input[id*="mesesEtapa_"]').each(function()
    {
        $(this).attr('id','mesesEtapa_'+i);
        $(this).attr('name','mesesEtapa_'+i);
        i++;
    });
    i=1;
    $('input[id*="descripcionEtapa_"]').each(function()
    {
        $(this).attr('id','descripcionEtapa_'+i);
        $(this).attr('name','descripcionEtapa_'+i);
        i++;
    });
    i=1;
    $('textarea[id*="metasEtapa_"]').each(function()
    {
        $(this).attr('id','metasEtapa_'+i);
        $(this).attr('name','metasEtapa_'+i);
        i++;
    });
    i=1;
    $('textarea[id*="actividadesEtapa_"]').each(function()
    {
        $(this).attr('id','actividadesEtapa_'+i);
        $(this).attr('name','actividadesEtapa_'+i);
        i++;
    });
    i=1;
    $('textarea[id*="productosEtapa_"]').each(function()
    {
        $(this).attr('id','productosEtapa_'+i);
        $(this).attr('name','productosEtapa_'+i);
        i++;
    });
}
function crearAlumnos(id)
{
    $('#alumnos').html('');
    var numeroAlumnos=$('#'+id).val();
    if(numeroAlumnos >20){
        alert("Has excedido el número máximo de colaboradores por proyecto");
    }else{
        var alumno=$('#alumno').html();
        var i=1;
        for (var i = 0; i < (numeroAlumnos-1); i++) 
        {
            $('#alumnos').prepend('<div class="col-lg-12">'+alumno+'</div>');
        }
        i=1;
        $('h2[id*="tituloAlumno_1"]').each(function()
        {
            $(this).text('Alumno Colaborador  '+i);
            i++;
        });
        i=1;
        $('input[id*="nombreAlumnoCol_"]').each(function()
        {
            $(this).attr('id','nombreAlumnoCol_'+i);
            $(this).attr('name','nombreAlumnoCol_'+i);
            i++;
        });
        i=1;
        $('input[id*="apPaternoAlumnoCol_"]').each(function()
        {
            $(this).attr('id','apPaternoAlumnoCol_'+i);
            $(this).attr('name','apPaternoAlumnoCol_'+i);
            i++;
        });
        i=1;
        $('input[id*="apMaternoAlumnoCol_"]').each(function()
        {
            $(this).attr('id','apMaternoAlumnoCol_'+i);
            $(this).attr('name','apMaternoAlumnoCol_'+i);
            i++;
        });
        i=1;
        $('input[id*="noControlAlumnoCol_"]').each(function()
        {
            $(this).attr('id','noControlAlumnoCol_'+i);
            $(this).attr('name','noControlAlumnoCol_'+i);
            i++;
        });
        i=1;
        $('select[id*="cboCarreraAlumno_"]').each(function()
        {
            $(this).attr('id','cboCarreraAlumno_'+i);
            $(this).attr('name','cboCarreraAlumno_'+i);
            i++;
        });
        i=1;
        $('select[id*="cboSemestreAlumnoCol_"]').each(function()
        {
            $(this).attr('id','cboSemestreAlumnoCol_'+i);
            $(this).attr('name','cboSemestreAlumnoCol_'+i);
            i++;
        });
        i=1;
        $('textarea[id*="actividadesAlumnoCol_"]').each(function()
        {
            $(this).attr('id','actividadesAlumnoCol_'+i);
            $(this).attr('name','actividadesAlumnoCol_'+i);
            i++;
        });
        }
    
}



