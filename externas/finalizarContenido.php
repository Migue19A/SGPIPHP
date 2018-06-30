<div class="container" style="width: 90%; margin-left: 180px; display: block;">

<h1 class="text-center" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">Pre-registro finalizado</h1>
<script>
function descargar(){
  window.open('Preregistro.pdf', '_blank');
}

var f = new Date();
document.write("<h1 class='text-center'>Fecha y hora de finalización: " + f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear() + " " + f.getHours()+ ":"+ f.getMinutes() + " horas</h1>");
</script>

<h1 class="text-center" style="font-weight: Yu Gothic UI Light; margin-bottom: 4px;">Número de preregistro: 1234</h1>

<button style="margin: 20px 390px;" class="btn btn-primary" onclick="descargar()">Descargar formato<br><i class="fa fa-download fa-2x" aria-hidden="true"></i></button>
</div>