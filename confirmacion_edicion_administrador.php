<?php
  ## Editar Datos Administrador
  ## @autor : Bryan Soto
  ## @fecha : revision 17/08
  ## obs: 

	header ('Content-type: text/html; charset=ISO-8859-1');
	session_start();
	include('conexionbd.php');     
	$fecha=$_POST['ano']."-".$_POST['mes']."-".$_POST['dia'];


	$resultado=mysqli_query($conexion,"SELECT editar_administrador('$_SESSION[rut]','$_POST[nombre]','$_POST[mail]',
				'$fecha',$_POST[telefono],'$_POST[contra]');")
                or die(mysqli_error($conexion));
                
             
			
			echo "<script>
			alert('Datos Editados Exitosamente');
			window.opener.location.reload();
			window.close()";
			//window.location.href='perfil_cancha.php?idc=$resp[2]';

			echo "</script>";
?>