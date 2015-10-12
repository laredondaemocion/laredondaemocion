<?php
	## eliminar imagen recinto
	## @autor : Victor Toledo
	## @fecha : revision 20/08
	
	include("conexionbd.php");

?>

<!DOCTYPE html>
<html>
	<head>
		<title>La Redonda Emoci&oacute;n: Eliminar Imagen</title>
		<?php include("header_comun.php");?>
		<script type="text/javascript">
			function refresh (argument) {
				window.opener.location.reload();
			}

		</script>
	</head>
	<body>
		<div id="cosa"></div>
		<br><br><br><br>
		<form class="form-horizontal text-center" role="form" id="registro_eliminar" name="elim_image" 
		method="POST" action="eliminar_imagen_recinto.php" onsubmit="refresh();">
			<div class="container" name="reserva">
				<h2 class="text-center">Seleccion Imagen(es) por eliminar</h2>
				<div class="row">
					<?php

		                $conector = mysqli_connect($host,$user,$pass,$db);
		                $total_ima=0;
		                $imagenes = mysqli_query($conector,"CALL multimedias_recinto('$_GET[idc]');")
	                  	or die(mysqli_error($conector));

	                  while($resp=mysqli_fetch_array($imagenes))
	                  {
	                    echo '<img src="'.$resp['direccion'].'" alt="$total_ima" width="180" height="180">
	                    <input type="text" value="'.$resp['direccion'].'"  name="dire[]" hidden>
	                    <input type="checkbox" value="'.$resp['idMultimedia_recinto'].'" name="borra[]">
	                    <br>';
	                    $total_ima++;
	                  }
	                  if ($total_ima==0) {
	                    echo "<h3 class='text-center' style='margin-top:10%;'>No hay imagenes asociadas</h3>";
	                  }
	                  mysqli_close($conector);
					?>
					<br>
					<input type="submit" class="btn btn-info" value="Eliminar">
				</div>
			</div>
		</form>

	</body>
</html>