<?php
	## Editar Arrendatario
	## @autor : Bryan Soto
	## @fecha : revision 12/08
	

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
				
			
		?>
		<div id="cosa"></div>
		<br><br><br>
		<form class="form-horizontal text-center" role="form" id="registro_reserva" name="regReserva" 
		method="POST" action="confirmacion_edicion_arrendatario.php"  onsubmit="refresh();">
		<div class="container" name="reserva">
			<h2 class="text-center">Editar Datos</h2>
				<div class="row">
				    <input type="hidden" name="rut" <?php echo "value='".$_SESSION['rut']."'"?>>	
				      	<?php 
				      	$rut=$_SESSION['rut'];
				      	$resultado=mysqli_query($conexion,"CALL datos_usuario_por_rut($rut)");
				      	if ($row=mysqli_fetch_array($resultado)) {
				      			echo "	<input type='hidden' name='rut' value='$rut'>
				      					
										<div class='form-group form-group-sm'>
												<div class='col-sm-12'>
												<label>Nombre</label>
												</div>
												<div class='col-sm-4'></div>
												<div class='col-sm-4'>
													<input type='text' class='form-control' name='nombre' id='nombre' value='$row[nombre_usuario]'>
												</div>
										</div>
										<div class='form-group form-group-sm'>
											<div class='col-sm-3'></div>
											<div class='col-sm-6'>
												<label>Correo Electr&oacute;nico</label>
												<input type='email' class='form-control' name='mail' id='mail' value='$row[correo_usuario]'>
											</div>
										</div>
				      					";
				      			echo "<div class='form-group form-group-sm'>
										<div class='col-sm-12'>
											<label>Fecha de nacimiento</label>
										</div>
										<div class='col-sm-2'></div>
										<div class='col-sm-3'>";
					           	
					           	echo"<select name=dia id=dia class='form-control'>";
					           	$fecha=split("-",$row['fecha_nacimiento']);
					            for($i=1;$i<32; $i++)
					              {
					                if($fecha[2]==$i) echo '<option value="'.$i.'" selected>'.$i.'</option>';
					                else echo '<option value="'.$i.'">'.$i.'</option>';
					              }
					                echo "</select>
					                		</div>
											<div class='col-sm-3'>";
					                echo "<select name=mes id=mes1 class='form-control'>";
					                  for($j=1;$j<13;$j++)
					                  {
					                    if($fecha[1]==$j) echo '<option value="'.$j.'" selected>'.$j.'</option>';
					                    else echo '<option value="'.$j.'">'.$j.'</option>';
					                  }
					             
					                echo "</select>
					                		</div>
					                		<div class='col-sm-3'>
					                <select name=ano class='form-control'>";
					              
					              for($k=date('o'); $k>=1930; $k--)
					              {
					                if ($k == $fecha[0])
					                   echo '<option value="'.$k.'" selected>'.$k.'</option>';
					                else
					                  echo '<option value="'.$k.'">'.$k.'</option>';
					              }
					            
					         echo "</select>
					                		</div>
					                		
					         		 </div>
									</div>";
				      		
				      		echo "<div class='form-group form-group-sm'>
												<div class='col-sm-12'>
												<label>Telefono</label>
												</div>
												<div class='col-sm-4'></div>
												<div class='col-sm-4'>
													<input type='text' class='form-control' name='telefono' id='telefono' value='$row[telefono_usuario]'>
												</div>
										</div>";
							echo "<div class='form-group form-group-sm'>
									<div class='col-sm-12'>
									<label>Contrase&ntilde;a</label>
									</div>
									<div class='col-sm-4'></div>
									<div class='col-sm-4'>
										<input type='password' class='form-control' name='contra' id='contra'>
									</div>
							</div>";
				      		}	
				      		

				      		?>
							<div class="form-group form-group-sm">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
									<button id="boton-form" type="button" class="btn btn-default"> Registrar</button>
								</div>
							</div>
							
				
			</form>
		</div>

		<script type="text/javascript">

			function comprobarFecha(dia,mes,year)
			{
				var dias = $("#"+dia).val();
				var meses = $("#"+mes).val();
				var anos = $("#"+year).val();


				if ((meses==4 || meses==6 || meses==9 || meses==11) && dias==31) 
				{
			  		var div = $("#"+mes).closest("div");
					div.removeClass("has-success has-feedback");
					div.addClass("has-error has-feedback");
					$("#glypcn"+mes).remove();
					div.append('<span id="glypcn'+mes+'" class="glyphicon glyphicon-remove form-control-feedback"></span>');

					var dev = $("#"+dia).closest("div");
					dev.removeClass("has-success has-feedback");
					dev.addClass("has-error has-feedback");
					$("#glypcn"+dia).remove();
					dev.append('<span id="glypcn'+dia+'" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			 		
		 			var dov = $("#"+year).closest("div");
					dov.removeClass("has-success has-feedback");
					dov.addClass("has-error has-feedback");
					$("#glypcn"+year).remove();
					dov.append('<span id="glypcn'+year+'" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			 		return false;
				};

			    if (meses == 2)
			    { // bisiesto
			    	var bisiesto = (anos % 4 == 0 && (anos % 100 != 0 || anos % 400 == 0));
			      	if (dias > 29 || (dias==29 && !bisiesto)) 
			      	{
			       		var div = $("#"+mes).closest("div");
						div.removeClass("has-success has-feedback");
						div.addClass("has-error has-feedback");
						$("#glypcn"+mes).remove();
						div.append('<span id="glypcn'+mes+'" class="glyphicon glyphicon-remove form-control-feedback"></span>');

						var dev = $("#"+dia).closest("div");
						dev.removeClass("has-success has-feedback");
						dev.addClass("has-error has-feedback");
						$("#glypcn"+dia).remove();
						dev.append('<span id="glypcn'+dia+'" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				 		
			 			var dov = $("#"+year).closest("div");
						dov.removeClass("has-success has-feedback");
						dov.addClass("has-error has-feedback");
						$("#glypcn"+year).remove();
						dov.append('<span id="glypcn'+year+'" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				 		return false;
			      	}
			    };
			}

			function aprobarFecha(dia,mes,year)
			{
				var div = $("#"+mes).closest("div");
				div.removeClass("has-error has-feedback");
				div.addClass("has-success has-feedback");
				$("#glypcn"+mes).remove();
				div.append('<span id="glypcn'+mes+'" class="glyphicon glyphicon-ok form-control-feedback"></span>');

				var dev = $("#"+dia).closest("div");
				dev.removeClass("has-error has-feedback");
				dev.addClass("has-success has-feedback");
				$("#glypcn"+dia).remove();
				dev.append('<span id="glypcn'+dia+'" class="glyphicon glyphicon-ok form-control-feedback"></span>');
		 		
	 			var dov = $("#"+year).closest("div");
				dov.removeClass("has-error has-feedback");
				dov.addClass("has-success has-feedback");
				$("#glypcn"+year).remove();
				dov.append('<span id="glypcn'+year+'" class="glyphicon glyphicon-ok form-control-feedback"></span>');
			}


			function esVacio(id)
			{
				if($("#"+id).val()==null || $("#"+id).val()=="")
				{
					var div = $("#"+id).closest("div");
					div.removeClass("has-success has-feedback");
					div.addClass("has-error has-feedback");
					$("#glypcn"+id).remove();
					div.append('<span id="glypcn'+id+'" class="glyphicon glyphicon-remove form-control-feedback"></span>');
					return false;
				}
				else
				{
					return true;
				}
			}

			function esNumero(id)
			{
				var str=$("#"+id).val();
				for(var i=0;i<str.length;i++)
				{
					var chara=str.substring(i,i+1);
					if(chara<'0' || chara>'9')
					{
						var div = $("#"+id).closest("div");
						div.remove("has-success has-feedback");
						div.addClass("has-error has-feedback");
						$("#glypcn"+id).remove();
						div.append('<span id="glypcn'+id+'" class="glyphicon glyphicon-remove form-control-feedback"></span>');
						return false;
					}
				}
				return true;
			}

			function aprobar(id)
			{
				var div = $("#"+id).closest("div");
				div.removeClass("has-error has-feedback");
				div.addClass("has-success has-feedback");
				$("#glypcn"+id).remove();
				div.append('<span id="glypcn'+id+'" class="glyphicon glyphicon-ok form-control-feedback"></span>');
			}

			function esInvalido(rut,dv)
			{
				var div = $("#"+rut).closest("div");
				div.removeClass("has-success has-feedback");
				div.addClass("has-error has-feedback");
				$("#glypcn"+rut).remove();
				div.append('<span id="glypcn'+rut+'" class="glyphicon glyphicon-remove form-control-feedback"></span>');

				var dev = $("#"+dv).closest("div");
				dev.removeClass("has-success has-feedback");
				dev.addClass("has-error has-feedback");
				$("#glypcn"+dv).remove();
				dev.append('<span id="glypcn'+dv+'" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			}

			function comprobarPass(puno,pdos)
			{
				if($("#"+puno).val() != $("#"+pdos).val())
				{
					var div = $("#"+pdos).closest("div");
					div.removeClass("has-success has-feedback");
					div.addClass("has-error has-feedback");
					$("#glypcn"+pdos).remove();
					div.append('<span id="glypcn'+pdos+'" class="glyphicon glyphicon-remove form-control-feedback"></span>');
					return false;
				}
				else
				{
					return true;
				}
			}

			function validaRut(numero,dv)
			{
			    strnum=new String($("#"+numero).val()); 
			    var resto,suma,digito,factor,dv;
			    suma=0;
			    factor=2;
			    dv = $("#"+dv).val();
			     
			    for (i=strnum.length - 1;i>=0 ;i--)
			    {
			        suma=suma + (parseInt(strnum.charAt(i)) * factor);
			        factor++;
			        if (factor == 8) factor=2;
			    };

			    resto=(suma % 11);
			     
			    digito = 11 - resto;
			    if (digito == 10) 
			        if (dv=="K" || dv=="k")
			           return true
			        else
			           	return false
			    else
			        if (digito==11)
			           if (dv=="0")
			              return true
			           else
			              return false
			        else
			           if (digito == dv)
			              return true
			           	else
			              return false;
			    return true;
			}

			$(document).ready(
				function()
				{
					$("#boton-form").click(function()
					{
						
						

						if(!esVacio("nombre"))
						{
							return false;
						}
						else
						{
							aprobar("nombre");
						}


						if(!esVacio("mail"))
						{
							return false;
						}
						else
						{
							aprobar("mail");
						}

						if(comprobarFecha("dia","mes","ano")==false)
						{
							return false;
						}
						else
						{
							aprobarFecha("dia","mes","ano");
						}
						
						if(!esVacio("telefono"))
						{
							return false;
						}
						else
						{	

							if(!esNumero("telefono"))
							{
								return false;
							}
							else
							{
								aprobar("telefono");
							}
						}
						
						if(!esVacio("contra"))
						{
							return false;
						}
						
						
						$("form").submit();
					});
				}
			);
		</script>
	</body>
</html>