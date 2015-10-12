<?php
	
	## Registro Registro de Cancha en BD.
	## @autor : Victor Toledo
	## @fecha : revision 12/08
	## @obs: 

	
	#session_start();

	include("conexionbd.php");

	if(isset($_POST['tipo']))
	{
		$reg = mysqli_query($conexion,"SELECT insertar_cancha('$_POST[recinto]','$_POST[tipo]','$_POST[cantidad]','$_POST[precio_dia]',
			'$_POST[precio_noche]','$_POST[hora_inicio_dia]','$_POST[hora_inicio_noche]','$_POST[hora_fin_noche]','$_POST[numero]');") 
		or die(mysqli_error($conexion));

		$resp = mysqli_fetch_row($reg);

		if($resp[0]==1)
		{
			echo "<script>
			alert('Cancha registrada exitosamente');
			window.location.href='perfil_recinto.php?id_recinto=$_POST[recinto]';
			</script>";
		}
	}




?>