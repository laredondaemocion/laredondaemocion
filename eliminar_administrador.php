<?php
  ## Eliminar Administrador
  ## @autor : Bryan Soto
  ## @fecha : revision 17/08
  ## obs: 

	header ('Content-type: text/html; charset=ISO-8859-1');
	session_start();
	include('conexionbd.php');     

	$resultado=mysqli_query($conexion,"SELECT eliminar_administrador('$_SESSION[rut]');")
                or die(mysqli_error($conexion));
                
                echo "<script>
			

			window.location='logout.php';
			alert('Usuario Eliminado Exitosamente');
			";
			//window.location.href='perfil_cancha.php?idc=$resp[2]';

			echo "</script>";
?>