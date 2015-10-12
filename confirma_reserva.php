<?php
	
	## Registro Registro de Cancha en BD.
	## @autor : Bryan Soto
	## @fecha : revision 12/08
	## @obs: 

	
	

	include("conexionbd.php");

	$id=$_POST['id_horario'];
	$rut=$_POST['rut'];
	$result=mysqli_query($conexion,"CALL datos_horario($id)");
		

		$resp = mysqli_fetch_row($result);

		if($resp[1]==0)
		{
			$aux = mysqli_connect($host,$user,$pass,$db);
			mysqli_query($aux,"SELECT reservar_rut_horario($rut,$id)");
			echo "<script>
			alert('Reserva registrada exitosamente');
			window.close()";
			//window.location.href='perfil_cancha.php?idc=$resp[2]';

			echo "</script>";
		}
		else
		{
			echo "<script>
			alert('Error al intentar ingresar la reserva, intentelo nuevamente');
			window.close()";
			//window.location.href='perfil_cancha.php?idc=$resp[2]
			echo "</script>";

		}
	




?>