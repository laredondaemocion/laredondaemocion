<?php

	## Login del sitema
	## @autor : Bryan Soto
	## @fecha : revision 17/08
	## obs: 

	include('conexionbd.php');

	$clave=$_POST['pass'];
	$rut=$_POST['rut'];
	$tipo=$_POST['tipo'];

	$resultado=mysqli_query($conexion,"SELECT confirmar_ingreso('$tipo','$rut','$clave');")	or die(mysqli_error($conexion));

	$row=mysqli_fetch_row($resultado);


	if($row[0]==1){
		session_start();
		$_SESSION['tipo']=$tipo;
		$_SESSION['rut']=$rut;
		
		if($_POST['tipo']==2){
			$sql="CALL nombre_usuario_rut($rut);";
		}else{
			$sql="CALL nombre_administrador_rut($rut);";
		}
			$res=mysqli_query($conexion,$sql) or die(mysqli_error($conexion));
			$nom=mysqli_fetch_array($res);
			//echo $nom[0];
			$_SESSION['nombre']=$nom[0];
			echo "<script>
			alert('Ingreso Exitoso');
			window.location.href='index.php';
			</script>";
	}else{

		echo "<script>
			alert('Combinaci\u00F3n Rut-Contrase\u00F1a no Registrada');
			window.location.href='ingreso.php';
			</script>";
	}






?>