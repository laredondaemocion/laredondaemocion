<?php

	## Cerrar Sesion
	## @autor : Bryan Soto
	## @fecha : revision 17/08
	## obs: 

	session_start();
	session_destroy();
	header("location:index.php");
?>