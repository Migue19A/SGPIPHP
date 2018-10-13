<?php 
class ClaseConsultas extends ClassConn
{
	function getEntregables()
	{
		$sql='SELECT entr."idEntregable",entr."FechaEntrega",entr."Etapas_FolioProyecto",entr."Etapas_noEtapa",
			proy."NombreProyecto",proy."Inicio",proy."Fin",usu."Nombre"||\' \'||usu."ApellidoP"||\' \'||usu."ApellidoM"
		FROM entregable entr 
		INNER JOIN proyecto proy ON proy."FolioProyecto"=entr."Etapas_FolioProyecto"
		INNER JOIN usuario usu ON usu."NoPersonal"=proy."Responsable"';
		$consulta = pg_query($this->conexion(), $sql);
		$json=array();
		$arregloConsulta=array();
		$entregables=array();
		$i=0;
		while ($fila = pg_fetch_row($consulta)) 
		{ 
			$arregloConsulta[$i]=$fila;
			$i++;
		}
		$i=1;
		foreach ($arregloConsulta as $row) 
		{
			$Numero=$i;
			$Entregable=$row[0];
			$FechaEntrega=$row[1];
			$Folio=$row[2];
			$Etapa=$row[3];
			$NombreProy=$row[4];
			$Inicio=$row[5];
			$Fin=$row[6];
			$Docente=$row[7];
			$json=array("Numero"=>$Numero,"Entregable"=>$Entregable,"Folio"=>$Folio,"Etapa"=>$Etapa,"FechaEntrega"=>$FechaEntrega,"NombreProy"=>$NombreProy,"Inicio"=>$Inicio,"Fin"=>$Fin,"Docente"=>$Docente);
			array_push($entregables,$json);
			$i++;
		}
		return $entregables;
	}
}

 ?>