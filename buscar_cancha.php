	<?php
	## Buscar Cancha
	## @autor : Bryan Soto
	## @fecha : revision 13/08
	## obs: consulta implementado 

	header ('Content-type: text/html; charset=ISO-8859-1');
	session_start();
	include('conexionbd.php');     
?>
<!DOCTYPE html>
<html>
<head>
	
	<?php include("header_comun.php");?>
	
	<title></title>
</head>
<body>
	<?php include("menu.php");?>
	<div id="cosa"></div>
	<br><br><br><br>
	<div class="container" style="min-height:650px;">
		
		<div class="text-center"><h2>Resultado Busqueda</h2>
		
			<?php
				$cont=0;
				$comunaid=$_GET['comuna'];
				$tipo=$_GET['tipo'];
				$resultado=mysqli_query($conexion,"CALL buscar_recinto('$_GET[region]','$_GET[provincia]',
					'$_GET[comuna]','$_GET[tipo]');") or die(mysqli_error($conexion));

				while ($row=mysqli_fetch_array($resultado)) {
					echo "<div class='row'>";
					
					echo "<img class='img-rounded col-md-2' src='img/perfiles/recinto/$row[0]/logo.png'
							WIDTH=300px HEIGHT=100px style='padding-top:30px' BORDER=2 >";
					echo "<div class='col-md-2'>";
					echo "<h3>$row[1]</h3><h4>$row[2]</h4><h4>$row[3]</h4>";
					echo "</div>";
					
					echo "<h4 style='padding-top:50px' ><a class='col-md-2 btn btn-info' href='perfil_cancha.php?idc=$row[4]'>Ver Detalles</a></h4>";
					
					echo "</div>";
					$cont++;
					
				}	
			?>
		</div>
			<?php
				if ($cont==0) {
					
					echo "<script language=javascript>
	  				alert('No existen canchas con esas caracteristicas');
	  				window.location.href='index.php';
	  				</script>";
				}
			?>
			<div class="clearfooter"></div>
			
		</div>

		<?php include("footer.php");?>

		<?php include("footer_comun.php");?>
	</body>
</html>
