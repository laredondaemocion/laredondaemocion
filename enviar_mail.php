<?php
	## Registro en bd de usuario/administrador
	## @autor : Victor Toledo
	## @fecha : 12/08
	include("conexionbd.php");
	
	$consulta=mysqli_query($conexion," CALL `mail_por_rut`($_POST[tipo],$_POST[rut]);") or die(mysqli_error($conexion));

		if($resp=mysqli_fetch_array($consulta)){
			
			$destino = $resp[0];
			$desde = "laredondaemocionchile@gmail.com";
			$asunto = "Recuperacion de contraseña";
			$mensaje = "Estimado usuario, su solicitud de contraseña ha sido exitosa. Su contraseña es: $resp[1]. Atentamente Laredondaemocion.cl";
			mail($destino,$asunto,$mensaje,$desde);

			echo "<script>
			alert('Su contraseña ha sido enviada exitosamente');
			
			window.location.href='index.php';

			</script>";
		}else{
			echo "<script>
			alert('Error al enviar la su contraseña');
			
			window.location.href='recupera_contra.php';

			</script>";
		}


		
?>