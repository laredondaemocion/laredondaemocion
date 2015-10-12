<?php
	## Registro en bd de usuario/administrador
	## @autor : Victor Toledo
	## @fecha : 12/08
	include("conexionbd.php");

	$nombre=$_POST['nombre']." ".$_POST['paterno']." ".$_POST['materno'];
	$fecha=$_POST['ano']."-".$_POST['mes']."-".$_POST['dia'];

	
	if(isset($_POST['rut']))
	{

		$consulta=mysqli_query($conexion,"SELECT confirmar_registro('$_POST[tipo]','$_POST[rut]');") or die(mysqli_error($conexion));

		$resp=mysqli_fetch_row($consulta);


		if($resp[0]==0)
		{
			$registro=mysqli_query($conexion,"SELECT ingresar_persona('$_POST[tipo]','$_POST[rut]','$_POST[dv]','$nombre',
				'$_POST[mail]','$fecha','$_POST[fono]','$_POST[pass_1]');") or die(mysqli_error($conexion));

			$rep=mysqli_fetch_row($registro);

			if($rep[0]==1)
			{
				if($_POST['tipo']==1)
				{
					if(!(is_dir("/XAMPP/htdocs/laredonda/img/perfiles/admin/".$_POST["rut"]))){
						mkdir("/XAMPP/htdocs/laredonda/img/perfiles/admin/".$_POST["rut"], 0775);
					copy("/XAMPP/htdocs/laredonda/img/recursos/perfil.png",
						"/XAMPP/htdocs/laredonda/img/perfiles/admin/".$_POST["rut"]."/perfil.png");	
					} 
				}
				else
				{
					if(!(is_dir("/XAMPP/htdocs/laredonda/img/perfiles/user/".$_POST["rut"]))){
					mkdir("/XAMPP/htdocs/laredonda/img/perfiles/user/".$_POST["rut"], 0775);
					copy("/XAMPP/htdocs/laredonda/img/recursos/perfil.png",
						"/XAMPP/htdocs/laredonda/img/perfiles/user/".$_POST["rut"]."/perfil.png");
					}
				}
				
				echo "<script language=javascript>
  				alert('Usuario registrado exitosamente');
  				window.location.href='index.php';
				</script>";
			}
			else
			{
				echo "<script language=javascript>
  				alert('Error al registrar');
  				window.location.href='formulario.php';
				</script>";
			}
		}
		else
		{
			echo "<script language=javascript>
  			alert('Usuario ya registrado');
  			window.location.href='formulario.php';
			</script>";

		}
	}

	mysqli_close($conexion);
?>