function Cancelar()
{
    swal({
        title: '¿Desea cancelar la entrega?',
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí'
        }).then(function () 
        {
            swal(
            'Entrega cancelada',
            '',
            'success'
            ).then(function(dimiss)
            {       
            if(dimiss==true)
            {
              location.href="ConsultaEntregables.html"
            }
        })
    })
}
function Finalizar()
{
    swal({
        title: '¿Finalizar reporte?',
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, guardar'
        }).then(function () 
        {
            swal(
            'Solicitud enviada',
            '',
            'success'
        ).then(function(dimiss)
        {         
            if(dimiss==true)
            {
              location.href="FinalizarS.html"
            }
        })
    })
}
var currentStep = 1;
$(document).ready(function () {
    $('.li-nav').click(function () {
        var $targetStep = $($(this).attr('step'));
        currentStep = parseInt($(this).attr('id').substr(7));
        if (!$(this).hasClass('disabled')) {
            $('.li-nav.active').removeClass('active');
            $(this).addClass('active');
            $('.setup-content').hide();
            $targetStep.show();
        }
    });
    $('#navStep1').click();
});
function step1Next(form) {
    //You can make only one function for next, and inside you can check the current step
    if (true) {//Insert here your validation of the first step
        currentStep += 1;
        $('#navStep' + currentStep).removeClass('disabled');
        $('#navStep' + currentStep).click();
    }
    updateForm(form);
}

function prevStep(form) {
    //Notice that the btn prev not exist in the first step
    currentStep -= 1;
    $('#navStep' + currentStep).click();
}

function step2Next(form) {
    if (true) {
        $('#navStep3').removeClass('disabled');
        $('#navStep3').click();
    }
    updateForm(form);
}

function step3Next(form) {
    if (true) {
        $('#navStep4').removeClass('disabled');
        $('#navStep4').click();
    }
    updateForm(form);
}

function step4Next(form) {
    if (true) {
        $('#navStep5').removeClass('disabled');
        $('#navStep5').click();
    }
    updateForm(form);
}

function step5Next(form) {
    if (true) {
        $('#navStep6').removeClass('disabled');
        $('#navStep6').click();
    }
    updateForm(form);
}

function step6Next(form) {
    if (true) {
        $('#navStep7').removeClass('disabled');
        $('#navStep7').click();
    }
    updateForm(form);
}

function step7Next(form) {
    if (true) {
        $('#navStep8').removeClass('disabled');
        $('#navStep8').click();
    }
    updateForm(form);
}

function step8Next(form) {
    if (true) {
        $('#navStep9').removeClass('disabled');
        $('#navStep9').click();
    }
    updateForm(form);
}

function step9Next(form) {
    if (true) {
        $('#navStep10').removeClass('disabled');
        $('#navStep10').click();
    }
    updateForm(form);
}

function step10Next(form) {
    if (true) {
        $('#navStep11').removeClass('disabled');
        $('#navStep11').click();
    }
    updateForm(form);
} 
function updateForm(form)
{
    var proyecto = $('#folioProyecto').val();
    var entregable= $('#entregable').val();
    var form=$('#'+form).serialize();
    $.ajax(
    {
        async: true,
        type: 'POST',
        dataType: 'html',
        url: '../../Ajax/ajax_seguimiento.php?&proyecto='+proyecto+'&entregable='+entregable,
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
function NuevaActividad(activ)
{
    var nuevaAct=parseInt(activ);
    var ultimaAct=parseInt(activ);
    var name='';
    $('label[id="labelNumAct_"]').text('1');
    $('#actividades').append('<div id="actividad_'+ultimaAct+'">'+$('#actividad_').html()+'</div>');
    $('div[id="actividad_'+ultimaAct+'"] > div > div > div > h5 > input, div[id="actividad_'+ultimaAct+'"] > div > div > div > textarea').each(function()
    {
        name=$(this).attr('name')+ultimaAct;
        $(this).attr('name',name);
        $(this).attr('id',name);
    });
    $('label[id="labelNumAct_"]:last').attr('id','labelNumAct_'+nuevaAct);
    $('#numeroActividades').val(nuevaAct);
    nuevaAct++;
    $('#labelNumAct_'+ultimaAct).text(nuevaAct);
    $('#nuevaActividad').attr('onclick','NuevaActividad('+nuevaAct+')');
}

function NuevPersona(pers)
{
    var nuevaPer=parseInt(pers);
    var ultimaPer=parseInt(pers);
    var name='';
    $('label[id="labelNumObj_"]').text('1');
    $('#objetivos').append('<div id="objetivo_'+ultimoObj+'">'+$('#objetivo_').html()+'</div>');
    $('div[id="objetivo_'+ultimoObj+'"] > div > div > div > h5 > input, div[id="objetivo_'+ultimoObj+'"] > div > div > div > textarea').each(function()
    {
        name=$(this).attr('name')+ultimoObj;
        $(this).attr('name',name);
        $(this).attr('id',name);
    });
    $('label[id="labelNumObj_"]:last').attr('id','labelNumObj_'+nuevoObj);
    $('#numeroObjetivos').val(nuevoObj);
    nuevoObj++;
    $('#labelNumObj_'+ultimoObj).text(nuevoObj);
    $('#nuevoObjetivo').attr('onclick','NuevoObjetivoAlcanzado('+nuevoObj+')');
}
function NuevoObjetivoAlcanzado(obj)
{
    var nuevoObj=parseInt(obj);
    var ultimoObj=parseInt(obj);
    var name='';
    $('label[id="labelNumObj_"]').text('1');
    $('#objetivos').append('<div id="objetivo_'+ultimoObj+'">'+$('#objetivo_').html()+'</div>');
    $('div[id="objetivo_'+ultimoObj+'"] > div > div > div > h5 > input, div[id="objetivo_'+ultimoObj+'"] > div > div > div > textarea').each(function()
    {
        name=$(this).attr('name')+ultimoObj;
        $(this).attr('name',name);
        $(this).attr('id',name);
    });
    $('label[id="labelNumObj_"]:last').attr('id','labelNumObj_'+nuevoObj);
    $('#numeroObjetivos').val(nuevoObj);
    nuevoObj++;
    $('#labelNumObj_'+ultimoObj).text(nuevoObj);
    $('#nuevoObjetivo').attr('onclick','NuevoObjetivoAlcanzado('+nuevoObj+')');
}

function NuevaMeta(meta)
{
    var nuevaMeta=parseInt(meta);
    var ultimaMeta=parseInt(meta);
    var name='';
    $('label[id="labelNumMetas_"]').text('1');
    $('#metas').append('<div id="meta_'+ultimaMeta+'">'+$('#meta_').html()+'</div>');
    $('div[id="meta_'+ultimaMeta+'"] > div > div > div > h5 > input, div[id="meta_'+ultimaMeta+'"] > div > div > div > textarea').each(function()
    {
        name=$(this).attr('name')+ultimaMeta;
        $(this).attr('name',name);
        $(this).attr('id',name);
    });
    $('label[id="labelNumMetas_"]:last').attr('id','labelNumMetas_'+nuevaMeta);
    $('#numeroMetas').val(nuevaMeta);
    nuevaMeta++;
    $('#labelNumMetas_'+ultimaMeta).text(nuevaMeta);
    $('#nuevaMeta').attr('onclick','NuevaMeta('+nuevaMeta+')');
}
function NuevoLogroDivulgacion(logro)
{
    var nuevoLogro=parseInt(logro);
    var ultimoLogro=parseInt(logro);
    var name='';
    $('#logros').append('<div id="logro_'+ultimoLogro+'">'+$('#logro_').html()+'</div>');
    $('div[id="logro_'+ultimoLogro+'"] > div > div > div > input, div[id="logro_'+ultimoLogro+'"] > div > div > div > select').each(function()
    {
        name=$(this).attr('name')+ultimoLogro;
        $(this).attr('name',name);
        $(this).attr('id',name);
    });
    $('#numeroLogros').val(nuevoLogro);
    nuevoLogro++;
    $('#nuevoLogro').attr('onclick','NuevoLogroDivulgacion('+nuevoLogro+')');
}

function NuevaPresentacion(presentacion)
{
    var nuevaPres=parseInt(presentacion);
    var ultimaPres=parseInt(presentacion);
    var name='';
    $('#presentaciones').append('<div id="presentacion_'+ultimaPres+'">'+$('#presentacion_').html()+'</div>');
    $('div[id="presentacion_'+ultimaPres+'"] > div > div > div > input, div[id="presentacion_'+ultimaPres+'"] > div > div > div > select').each(function()
    {
        name=$(this).attr('name')+ultimaPres;
        $(this).attr('name',name);
        $(this).attr('id',name);
    });
    $('#numeroPresent').val(nuevaPres);
    nuevaPres++;
    $('#nuevaPres').attr('onclick','NuevaPresentacion('+nuevaPres+')');
}