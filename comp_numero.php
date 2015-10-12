	<?php
	## Comprueba numero de cancha
  	## @autor : Victor Toledo
 	## @fecha : revision 18/08
  	## obs: 

	include("conexionbd.php");

    $cons = mysqli_query($conexion,"SELECT numero_disponible('$_POST[recinto]','$_POST[numero]');")
    or die(mysqli_error($conexion));

    $resp = mysqli_fetch_row($cons);

    echo $resp[0];

    mysqli_close($conexion);
?>