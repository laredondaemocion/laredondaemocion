<?php
	## Cargar provincia al index
	## @autor : Bryan Soto
	## @fecha : revision 12/08
	## obs: 

	include('conexionbd.php');
	header ('Content-type: text/html; charset=ISO-8859-1');

	$region=$_POST['id_region'];

	$resultado=mysqli_query($conexion,"SELECT idprovincia,nombre_provincia FROM provincia WHERE regionid=$region;")	or die(mysqli_error($conexion));
			 
	echo "<option value=''>Seleccione Provincia</option>";
	while ($row=mysqli_fetch_array($resultado)) {
		echo "<option value='$row[0]'>$row[1]</option>";
	}
?>