<?php
	##Formulario Registro Recinto
	##@autor : Victor Toledo
	##fecha : 15/06/15

	session_start();
	include("conexionbd.php");


	if(isset($_POST['nombre']))
	{

		$registro=mysqli_query($conexion,"SELECT insertar_recinto('$_SESSION[rut]','$_POST[direccion]',
			'$_POST[telefono]','$_POST[nombre]','$_POST[correo]','$_POST[comuna]','$_POST[cx]',
			'$_POST[cy]');") or die(mysqli_error($conexion));


		$resp=mysqli_fetch_row($registro);


		if($resp[0]!=0)
		{
			mkdir("/XAMPP/htdocs/laredonda/img/perfiles/recinto/".$resp[0], 0775);
			copy("/XAMPP/htdocs/laredonda/img/recursos/logo.png",
						"/XAMPP/htdocs/laredonda/img/perfiles/recinto/".$resp[0]."/logo.png");
			echo "<script>
			alert('Recinto registrado exitosamente');
			window.location.href='perfil_administrador.php';
			</script>";
		}
	}

	mysqli_close($conexion);
?>