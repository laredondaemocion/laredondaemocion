<?php
	## Cargar comuna al index
	## @autor : Bryan Soto
	## @fecha : revision 12/08
	## obs: 

	include('conexionbd.php');
	header ('Content-type: text/html; charset=ISO-8859-1');

	$provincia=$_POST['id_provincia'];

	$resultado=mysqli_query($conexion,"SELECT idcomuna,nombre_comuna FROM comuna WHERE provinciaid=$provincia;") ;
			 
			 echo "<option value=''>Seleccione Comuna</option>";
	while ($row=mysqli_fetch_array($resultado)) {
			 echo "<option value='$row[0]'>$row[1]</option>";
		}
 
?>