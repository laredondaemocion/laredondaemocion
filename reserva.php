<?php
	## Eliminar Reserva
	## @autor : Bryan Soto
	## @fecha : revision 19/08
	

	header ('Content-type: text/html; charset=ISO-8859-1');
	session_start();
	include('conexionbd.php');     
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include("header_comun.php");?>
		<script type="text/javascript">
			function refresh (argument) {
				window.opener.location.reload();
			}
		</script>
	</head>
	<body>
		<?php
				
			$id_h=$_GET['id_horario'];
		?>
		<div id="cosa"></div>
		<br><br><br>
		<form class="form-horizontal text-center" role="form" id="registro_reserva" name="regReserva" 
		method="POST" action="confirma_reserva.php" onsubmit="refresh();">
		<div class="container" name="reserva">
			<h2 class="text-center">Reserva Cancha</h2>
				<div class="row">
				    <input type="hidden" name="id_horario" <?php echo "value='".$id_h."'"?>>	
					<input type="hidden" name="rut" <?php echo "value='".$_SESSION['rut']."'"?>>	
				      	<?php 
				      	$con=mysqli_connect($host,$user,$pass,$db); 
				      		

				      	?>
				        	<div class="form-group">
				        		<h4>
					        		<br>
					        		<?php
					        			$result=mysqli_query($con,"CALL datos_horario($id_h)");
										if ($row=mysqli_fetch_array($result)) {
											echo "Fecha:".$row[0];
										}
					        		?>
										
									<br><br>
										Reservante: <?php echo $_SESSION['nombre'];?>
									<br><br>
									<?php
										$con2=mysqli_connect($host,$user,$pass,$db); 
										$result=mysqli_query($con2,"SELECT precio_horario($id_h)");
										if ($row=mysqli_fetch_array($result)) {
											echo "Precio: $ ".$row[0];
										}
									?>
									<br><br>
				<input type="submit" class="btn btn-success" value="Reservar">
				</h4>
			</form>
		</div>

		<?php
			mysqli_close($con);
			mysqli_close($con2);
		?>
	</body>
</html>