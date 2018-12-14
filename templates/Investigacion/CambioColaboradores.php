<?php 	
	session_start();
    include('../../externas/head.php');
    include('../../externas/header.php');
    include('../../externas/menuInvest.php');
    include('../../externas/lateral.php');
    include('../../controladores/Clases/clase_consultas.php');
    //include('externas/Clases/classConn.php');
 ?>
    <title>Cambio de colaboradores</title>     
<?php 
    include('../../externas/cColaboradoresInvestigacion.php')
?>
<?php 
    include('../../externas/footer.php');
?>