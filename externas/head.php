<?php  
include('conexion.php');
?>
<head>
	<meta charset="utf-8">
	<script src="MenuIzquierdo/moment.js">
        </script>
        <script src="MenuIzquierdo/angular.js">
        </script>
        <script src="MenuIzquierdo/angular-animate.js">
        </script>
        <script src="MenuIzquierdo/ui-bootstrap-tpls.js">
        </script>        
        <script src="js/rrule@2.2.0.js">
        </script>
        <script src="MenuIzquierdo/angular-bootstrap-colorpicker.js">
        </script>
        <script src="MenuIzquierdo/angular-bootstrap-calendar.js">
        </script>
        <link href="MenuIzquierdo/angular-bootstrap-calendar.min.css" rel="stylesheet"/>
        <script src="MenuIzquierdo/example.js">
        </script>
        <script src="MenuIzquierdo/helpers.js">
        </script>
        <script src="js/moment.js" type="text/javascript"></script>
        <link href="css/nuevoestilo.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
        <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
        <script src="js/script.js"></script>
        <script src="js/sweetalert2.min.js"></script> 
        <link href="img/itsx.ico" rel="shortcut icon" type="image/x-icon"/>
		<script type="text/javascript" src="js/jquery-3.2.0.js"></script>
		<script type="text/javascript" src="js/jquery-3.2.0.min.js"></script>
        <link href="css/calendario.css" rel="stylesheet" type="text/css"/>
        <script src="js/calendario.js" type="text/javascript">
        </script>
        <script src="js/menuInv.js" type="text/javascript">
        </script>
        <script src="js/menuGest.js" type="text/javascript">
        </script>
        <script src="js/menuCom.js" type="text/javascript">
        </script>
        <script src="js/menuDocente.js" type="text/javascript">
        </script>        
        <script src="js/preRegistro.js" type="text/javascript"></script>
        <link href="css/sweetalert2.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="js/funciones.js"></script>


	<style type="text/css">
		.mayusculas{
			 text-transform: uppercase;
		}
	</style>
	<script>
            var acc = document.getElementsByClassName("accordion");
            var i;
            for (i = 0; i < acc.length; i++) {
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
    </script>
    <script type="text/javascript">
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

                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!
                var yyyy = today.getFullYear();
                 if(dd<10){
                        dd='0'+dd
                    } 
                    if(mm<10){
                        mm='0'+mm
                    } 

                today = yyyy+'-'+mm+'-'+dd;
                document.getElementById("fechaPresentacion").setAttribute("min", today);
                document.getElementById("fechaPresentacion").setAttribute("value", today);
                document.getElementById("fechaInicio").setAttribute("min", today);
                document.getElementById("fechaInicio").setAttribute("value", today);
                document.getElementById("fechaFin").setAttribute("min", today);
                document.getElementById("fechaFin").setAttribute("value", today);
            });
    </script>
</head> 