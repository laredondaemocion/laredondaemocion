<?php
  ## Eliminar Cancha
  ## @autor : Bryan Soto
  ## @fecha : revision 17/08
  ## obs: 

	header ('Content-type: text/html; charset=ISO-8859-1');
	session_start();
	include('conexionbd.php');     

	$resultado=mysqli_query($conexion,"SELECT eliminar_cancha('$_GET[idc]');")
                or die(mysqli_error($conexion));

                echo "<script>
			

			window.location='perfil_recinto.php?id_recinto=$_GET[idr]';
			alert('Cancha Eliminada Exitosamente');
			";
			//window.location.href='perfil_cancha.php?idc=$resp[2]';

			echo "</script>";
?>