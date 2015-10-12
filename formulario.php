<?php

	## Formulario de registro de usuario
	## @autor : Victor Toledo
	## @fecha : revision 13/08
	## obs: 
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Formulario registro Cancha</title>
	</head>

	<body>
		<?php 
			include("header_comun.php");
			include("menu.php");
		?>
		
		<form  class="form-horizontal" role="form" id="registro" name="regAdmin" 
		method="post" action="registro_usuario.php" >

			<div id="cosa"></div>
			<br><br><br><br>
			<div class="container">
				<div class="col-sm-6 col-sm-offset-2">	
					<h4>Formulario registro de usuario de canchas chile</h4>

					<h5>A continuaci&oacute;n rellene el formulario</h5>

					<div class="form-group form-group-sm">
						<div class="col-sm-12">
							<label>RUT</label>
						</div>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="rut" id="rut" placeholder="12345678">
						</div>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="dv" id="dv" placeholder="9">	
						</div>
					</div>
					<div class="form-group form-group-sm">
						<div class="col-sm-12">
						<label>Nombre</label>
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="paterno" id="paterno" placeholder="Apellido Paterno">
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="materno" id="materno" placeholder="Apellido Materno">
						</div>	
					</div>
					<div class="form-group form-group-sm">
						<div class="col-sm-6">
							<label>Correo Electr&oacute;nico</label>
							<input type="email" class="form-control" name="mail" id="mail" placeholder="Email">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<div class="col-sm-12">
							<label>Fecha de nacimiento</label>
						</div>
						<div class="col-sm-3">
							<select class="form-control" name="dia" id="dia">
								<option value="01">1</option>
								<option value="02">2</option>
								<option value="03">3</option>
								<option value="04">4</option>
								<option value="05">5</option>
								<option value="06">6</option>
								<option value="07">7</option>
								<option value="08">8</option>
								<option value="09">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="29">29</option>
								<option value="30">30</option>
								<option value="31">31</option>
							</select> 
						</div>
						<div class="col-sm-3">
							<select class="form-control" name="mes" id="mes">
								<option value="01">Enero</option>
								<option value="02">Febrero</option>
								<option value="03">Marzo</option>
								<option value="04">Abril</option>
								<option value="05">Mayo</option>
								<option value="06">Junio</option>
								<option value="07">Julio</option>
								<option value="08">Agosto</option>
								<option value="09">Septiembre</option>
								<option value="10">Octubre</option>
								<option value="11">Noviembre</option>
								<option value="12">Diciembre</option>
							</select>
						</div>
						<div class="col-sm-3">
							<select class="form-control" name="ano" id="ano">
								<?php 
									for($i=date('o'); $i>=1930; $i--)
									{
										if ($i == date('o'))
											echo '<option value="'.$i.'" selected>'.$i.'</option>';
										else
											echo '<option value="'.$i.'">'.$i.'</option>';
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<div class="col-sm-12">
							<label>Tel&eacute;fono</label>
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="fono" name="fono" placeholder="0322281376">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<div class="col-sm-12">
							<label>Contrase&ntilde;a</label>
						</div>
						<div class="col-sm-4">
							<input type="password" class="form-control" id="pass_1" name="pass_1" placeholder="Contrase&ntilde;a">
						</div>
						<div class="col-sm-4">
							<input type="password" class="form-control" id="pass_2" name="pass_2" placeholder="Confirmar contrase&ntilde;a">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<div class="col-sm-12">
							<label>Tipo de usuario</label>
						</div>
						<div class="radio col-sm-4">
							<label for="admin"><input type="radio" name="tipo" id="tipo" value="1" checked>Administrador</label>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<div class="radio col-sm-4">
							<label for="arren"><input type="radio" name="tipo" value="2" id="tipo">Arrendatario</label>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<div class="col-sm-4">
							<button id="boton-form" type="button" class="btn btn-default"> Registrar</button>
						</div>
					</div>
				</div>
				<div class="clearfooter"></div>
			</div>
		</form>


		<?php include("footer_comun.php");?>
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
						if(!esVacio("rut"))
						{
							return false;
						}
						if(!esVacio("dv"))
						{
							return false;
						}

						
						if(!validaRut("rut","dv"))
						{
							esInvalido("rut","dv");
							return false;
						}
						else
						{
							aprobar("rut");
							aprobar("dv");
						}
						

						if(!esVacio("nombre"))
						{
							return false;
						}
						else
						{
							aprobar("nombre");
						}

						if(!esVacio("paterno"))
						{
							return false;
						}
						else
						{
							aprobar("paterno");
						}

						if(!esVacio("materno"))
						{
							return false;
						}
						else
						{
							aprobar("materno");
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
						
						if(!esVacio("fono"))
						{
							return false;
						}
						else
						{	

							if(!esNumero("fono"))
							{
								return false;
							}
							else
							{
								aprobar("fono");
							}
						}
						
						if(!esVacio("pass_1") || !esVacio("pass_2"))
						{
							return false;
						}
						else
						{
							if(!comprobarPass("pass_1","pass_2"))
							{
								return false;
							}
							else
							{
								aprobar("pass_1");
								aprobar("pass_2");
							}
						}
						
						$("form").submit();
					});
				}
			);
		</script>
		<br><br><br><br>
		<?php include("footer.php");?>			 
	</body>
</html>