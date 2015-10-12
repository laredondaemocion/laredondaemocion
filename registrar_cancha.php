<?php
	## Registro Registro de Cancha Formulario
	## @autor : Victor Toledo
	## @fecha : revision 12/08
	## obs: espacio entre select:
	

	header ('Content-type: text/html; charset=ISO-8859-1');
	session_start();
	include('conexionbd.php');     

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Registro de Cancha</title>
	</head>
	<body>
		<?php
			include("menu.php"); 
			include("header_comun.php");
		?>
		<form class="form-horizontal" role="form" id="registro_cancha" name="regCancha" 
		method="post" action="registro_cancha.php">
			<div id="cosa"></div>
			<br><br><br><br>
			<div class="container">
				<div class="row">
	  				<div class="col-sm-11 col-sm-offset-1">
	    				<h3>Registro de Cancha:</h3>
					    <div class="row">
					      	<div class="col-sm-5">
					      		<?php 

					      			echo "<input type='text' id='recinto' name='recinto' value='$_GET[id]' hidden>";
					      		?>
								<div class="form-group">
									<div class="col-sm-12">
										<label>Numero de cancha:</label>
									</div>
									<div class="col-sm-6">
										<input type="text" class="form-control" id="numero" name="numero" placeholder="1">
									</div>
									<div class="col-sm-1" id="numero_estado"></div>		
								</div>
								<div class="form-group">
						        	<div class="col-sm-6">
							        	<div id="numero_error" class="alert alert-danger" hidden>
							        		<button type="button" class="close" id="cierra_aviso_9">&times;</button>
		  									<strong>Error</strong>, este n&uacute;mero de cancha esta seleccionado
		  									o no es n&uacute;mero.
							        	</div>
								    </div>
								</div>
								<div id="resultado"></div>
						        <div class="form-group">
						        	<div class="col-sm-12">
						        		<label>Tipo de cancha:</label>
						        	</div>
						        	<div class="col-sm-6">
						        		<select class="form-control" id="tipo" name="tipo">
						        			
											<option value="#">Elija una opci&oacute;n</option>
											<option value="Futbol">Futbol</option>
											<option value="Fubtolito">Futbolito</option>
											<option value="Futsal">Futsal</option>
											<option value="Baby Futbol">Baby Futbol</option>
										</select>
						        	</div>
						        	<div class="col-sm-1" id="tipo_estado">
						        		
						        	</div>
					        	</div>
					        	<div class="form-group">
						        	<div class="col-sm-6">
								        	<div id="tipo_error" class="alert alert-danger" hidden>
								        		<button type="button" class="close" id="cierra_aviso">&times;</button>
			  									<strong>Error</strong>, debe ingresar tipo de cancha.
								        	</div>
								    </div>
								</div>
					        	<div class="form-group">
						        	<div class="col-sm-12">
						        		<label>Jugadores por lado:</label>
						        	</div>
						        	<div class="col-sm-6">
						        		<select class="form-control" id="cantidad" name="cantidad">
						        			<option value="#">Elija una opci&oacute;n</option>
						        			<option value="5">5</option>
						        			<option value="6">6</option>
						        			<option value="7">7</option>
						        			<option value="8">8</option>
						        			<option value="9">9</option>
						        			<option value="10">10</option>
						        			<option value="11">11</option>
						        		</select>
						        	</div>
						        	<div class="col-sm-1" id="cantidad_estado">
						        		
						        	</div>
						        </div>
						        <div class="form-group">
						        	<div class="col-sm-6">
								        	<div id="cantidad_error" class="alert alert-danger" hidden>
								        		<button type="button" class="close" id="cierra_aviso_1">&times;</button>
			  									<strong>Error</strong>, debe seleccionar la cantidad de jugadores por lado.
								        	</div>
								    </div>
								</div>
						        <div class="form-group">
						        	<div class="col-sm-12">
						        		<label>Precio horario D&iacute;a:</label>	
						        	</div>
						        	<div class="col-sm-6 inputGroupContainer">
						        		<div class="input-group">
						        			<span class="input-group-addon">$</span>
						        			<input type="text" class="form-control" name="precio_dia" id="precio_dia" placeholder="Precio horario D&iacute;a">
										</div>
						        	</div>
						        	<div class="col-sm-1" id="precio_dia_estado">
						        		
						        	</div>
						        </div>
						        <div class="form-group">
						        	<div class="col-sm-6">
								        	<div id="precio_dia_error" class="alert alert-danger" hidden>
								        		<button type="button" class="close" id="cierra_aviso_2">&times;</button>
			  									<strong>Error</strong>, debe ingresar precio del horario de d&iacute;a.
								        	</div>
								    </div>
								</div>
						        <div class="form-group">
						        	<div class="col-sm-12">
						        		<label>Precio horario Nocturno:</label>
						        	</div>
						        	<div class="col-sm-6 inputGroupContainer">
						        		<div class="input-group">
						        			<span class="input-group-addon">$</span>
						        			<input type="text" class="form-control" name="precio_noche" id="precio_noche" placeholder="Precio horario Noche">
								        </div>	
						        	</div>
						        	<div class="col-sm-1" id="precio_noche_estado">
						        		
						        	</div>
						        </div>
						        <div class="form-group">
						        	<div class="col-sm-6">
								        	<div id="precio_noche_error" class="alert alert-danger" hidden>
								        		<button type="button" class="close" id="cierra_aviso_3">&times;</button>
			  									<strong>Error</strong>, debe ingresar precio del horario de noche.
								        	</div>
								    </div>
								</div>
					      	</div>
						    <div class="col-sm-6">
						        <div class="form-group">
						        	<div class="col-sm-12">
						        		<br>
						        		<label><h4>Horario de atenci&oacute;n:</h4></label>
						        	</div>
						        	<div class="col-sm-3">
						        		<label>Inicio Horario D&iacute;a:</label>
						        		<input type="time" class="form-control" name="hora_inicio_dia" id="hora_inicio_dia" value="00:00">
						        	</div>
						        	<div class="col-sm-1" id="hora_inicio_dia_estado">
						        		
						        	</div>
						        	<div class="col-sm-3">
						        		<label>Inicio Horario Nocturno: </label>
						        		<input type="time" class="form-control" name="hora_inicio_noche" id="hora_inicio_noche" value="19:00">
						        	</div>
						        	<div class="col-sm-1" id="hora_inicio_noche_estado">
						        		
						        	</div>
						        	<div class="col-sm-3">
						        		<label>Fin Horario Nocturno:</label>
						        		<input type="time" class="form-control" name="hora_fin_noche" id="hora_fin_noche" value="01:00">
						        	</div>
						        	<div class="col-sm-1" id="hora_fin_noche_estado">
						        		 
						        	</div>
						        </div>
						        <div class="form-group">
						        	<div class="col-sm-6">
								        	<div id="hora_inicio_dia_error" class="alert alert-danger" hidden>
								        		<button type="button" class="close" id="cierra_aviso_4">&times;</button>
			  									<strong>Error</strong>, debe ingresar hora de inicio de atenci&oacute;n.
								        	</div>
								    </div>
						        </div>
						        <div class="form-group">
						        	<div class="col-sm-6">
								        	<div id="hora_inicio_noche_error" class="alert alert-danger" hidden>
								        		<button type="button" class="close" id="cierra_aviso_5">&times;</button>
			  									<strong>Error</strong>, debe ingresar hora de inicio del horario de noche.
								        	</div>
								    </div>
						        </div>
						        <div class="form-group">
						        	<div class="col-sm-6">
								        	<div id="hora_fin_noche_error" class="alert alert-danger" hidden>
								        		<button type="button" class="close" id="cierra_aviso_6">&times;</button>
			  									<strong>Error</strong>, debe ingresar hora de fin de atenci&oacute;n.
								        	</div>
								    </div>
						        </div>
						        <div class="form-group">
						        	<div class="col-sm-6">
										<button type="button" id="boton-form" class="btn btn-default"> Registrar</button>
									</div>
						        </div>
						    </div>
					    </div>
					</div>
				</div>
				<div class="clearfooter"></div>
			</div>
		</form>
		<?php include("footer_comun.php");?>
		<script type="text/javascript">

			$("#numero").change(function()
            {
                var num = $("#numero").val();
                var id = $("#recinto").val();
                
                $.post( "comp_numero.php", {numero : num, recinto: id }, mostrarDatos );
                
            });

             function mostrarDatos( datos ) {

             	if(datos==0)
             	{	
             		aprobar("numero");
             	}
             	else{
             		rechazar("numero");
             	}
            	
        	}

        	function rechazar(id)
        	{
    			var div = $("#"+id).closest("div");
				var aux = $("#"+id+"_estado").closest("div");
				var err = $("#"+id+"_error").closest("div");
				aux.removeClass("has-success");
				div.removeClass("has-success");
				aux.addClass("has-error")
				div.addClass("has-error");
				$("#glypcn"+id).remove();
				aux.append('<span id="glypcn'+id+'" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				err.show("slow");
				return false;
        	}
			function noSeleccionado(id)
			{
				if($("#"+id).val() == "#")
				{
					var div = $("#"+id).closest("div");
					var aux = $("#"+id+"_estado").closest("div");
					var err = $("#"+id+"_error").closest("div");
					aux.removeClass("has-success");
					div.removeClass("has-success");
					aux.addClass("has-error")
					div.addClass("has-error");
					$("#glypcn"+id).remove();
					aux.append('<span id="glypcn'+id+'" class="glyphicon glyphicon-remove form-control-feedback"></span>');
					err.show("slow");
					return false;
				}
				else
				{
					return true;
				}
			}

			function esVacio(id)
			{
				if($("#"+id).val() == "" || $("#"+id).val() == null)
				{

					var div = $("#"+id).closest("div");
					var aux = $("#"+id+"_estado").closest("div");
					var err = $("#"+id+"_error").closest("div");
					aux.removeClass("has-success");
					div.removeClass("has-success");
					aux.addClass("has-error")
					div.addClass("has-error");
					$("#glypcn"+id).remove();
					aux.append('<span id="glypcn'+id+'" class="glyphicon glyphicon-remove form-control-feedback"></span>');
					err.show("slow");
					return false;
				}
				else
				{
					return true;
				}
			}
			function aprobar(id)
			{
				var div = $("#"+id).closest("div");
				var aux = $("#"+id+"_estado").closest("div");
				var err = $("#"+id+"_error").closest("div");
				aux.removeClass("has-error");
				div.removeClass("has-error");
				aux.addClass("has-success");
				div.addClass("has-success");
				$("#glypcn"+id).remove();
				aux.append('<span id="glypcn'+id+'" class="glyphicon glyphicon-ok form-control-feedback"></span>');
				err.hide("slow");
			}

			function esPrecio(id)
			{
				var str=$("#"+id).val();
				for(var i=0;i<str.length;i++)
				{
					var chara=str.substring(i,i+1);
					if(chara<'0' || chara>'9')
					{
						
						var div = $("#"+id).closest("div");
						var aux = $("#"+id+"_estado").closest("div");
						var err = $("#"+id+"_error").closest("div");
						aux.removeClass("has-success");
						div.removeClass("has-success");
						aux.addClass("has-error")
						div.addClass("has-error");
						$("#glypcn"+id).remove();
						aux.append('<span id="glypcn'+id+'" class="glyphicon glyphicon-remove form-control-feedback"></span>');
						err.show("slow");
						return false;
					}
				}
				return true;
			}
			


			$(document).ready(
				function () 
				{
					$("#boton-form").click(function()
					{

						if(!esVacio("numero"))
						{
							return false;
						}	

						if(!noSeleccionado("tipo"))
						{
							return false;
						}
						else
						{
							aprobar("tipo");
						}

						if(!noSeleccionado("cantidad"))
						{
							return false;
						}
						else
						{
							aprobar("cantidad");
						}

						if(!esPrecio("precio_dia") || !esVacio("precio_dia"))
						{
							return false;
						}
						else
						{
							aprobar("precio_dia");
						}

						if(!esPrecio("precio_noche") || !esVacio("precio_noche"))
						{
							return false;
						}
						else
						{
							aprobar("precio_noche");
						}

						if(!esVacio("hora_inicio_dia"))
						{
							return false;
						}
						else
						{
							aprobar("hora_inicio_dia");
						}

						if(!esVacio("hora_inicio_noche"))
						{
							return false;
						}
						else
						{
							aprobar("hora_inicio_noche");
						}

						if(!esVacio("hora_fin_noche"))
						{
							return false;
						}
						else
						{
							aprobar("hora_fin_noche");
						}

						$("form").submit();
					});
				}
			);

			$(document).ready(
				function () 
				{
					$("#cierra_aviso").click(function()
					{
						var cierra = $("#cierra_aviso").closest("div");
						cierra.hide("slow");
					});
				}
			);

			$(document).ready(
				function () 
				{
					$("#cierra_aviso_9").click(function()
					{
						var cierra = $("#cierra_aviso_9").closest("div");
						cierra.hide("slow");
					});
				}
			);

			$(document).ready(
				function () 
				{
					$("#cierra_avisos").click(function()
					{
						var cierra = $("#cierra_avisos").closest("div");
						cierra.hide("slow");
					});
				}
			);

			$(document).ready(
				function () 
				{
					$("#cierra_aviso_1").click(function()
					{
						var cierra = $("#cierra_aviso_1").closest("div");
						cierra.hide("slow");
					});
				}
			);

			$(document).ready(
				function () 
				{
					$("#cierra_aviso_2").click(function()
					{
						var cierra = $("#cierra_aviso_2").closest("div");
						cierra.hide("slow");
					});
				}
			);

			$(document).ready(
				function () 
				{
					$("#cierra_aviso_3").click(function()
					{
						var cierra = $("#cierra_aviso_3").closest("div");
						cierra.hide("slow");
					});
				}
			);

			$(document).ready(
				function () 
				{
					$("#cierra_aviso_4").click(function()
					{
						var cierra = $("#cierra_aviso_4").closest("div");
						cierra.hide("slow");
					});
				}
			);

			$(document).ready(
				function () 
				{
					$("#cierra_aviso_5").click(function()
					{
						var cierra = $("#cierra_aviso_5").closest("div");
						cierra.hide("slow");
					});
				}
			);

			$(document).ready(
				function () 
				{
					$("#cierra_aviso_6").click(function()
					{
						var cierra = $("#cierra_aviso_6").closest("div");
						cierra.hide("slow");
					});
				}
			);
		</script>
		<?php include("footer.php");?>
	</body>
</html>