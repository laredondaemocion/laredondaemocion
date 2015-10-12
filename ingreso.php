<?php
	## Formulario de ingreso de usuario
	## @autor : Victor Toledo
	## @fecha : revision 17/08
	## obs: 


?>
<!DOCTYPE html>
<html>
	<head>
		<title>La redonda emoci&oacute;n : perfil arrendatario</title>
		<script type="text/javascript">
      $(function() {
        $( "#ventana" ).tabs({
        });
      });

      $(document).ready( function() {
        $("a[rel='iup']").click(function () {
          n=window.open(this.href, 'Recovery','height=700,width=800,resizable=false,scrollbars=true,location=false');
          return false;
        });

      });

    </script>
	</head>
	<body>
		<?php 
			include("header_comun.php");
			include("menu.php");
		?>
			<div id="cosa"></div>
			<br><br><br><br>
			<div class="container">
				<h3 align="center">Ingreso</h3>
				<div class="col-sm-6 col-sm-offset-4">
				    	<form  class="form-horizontal" role="form" id="ingreso" name="ingreso" 
							method="post" action="login.php" >
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
									<label>Contrase&ntilde;a</label>
								</div>
								<div class="col-sm-5">
									<input type="password" class="form-control" name="pass" id="pass">
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
									<button id="boton-form" type="button" class="btn btn-default"> 
									Ingresar</button>
								</div>
							</div>
							<div class="form-group form-group-sm">
								<div class="col-sm-6">
									<a href="formulario.php"> ¿No &eacute;stas registrado?  JUST DO IT!</a>
								</div>
							</div>
							<div class="form-group form-group-sm">
								<div class="col-sm-6">
									<a href='recupera_contra.php' rel='iup'> Recuperar Contrase&ntilde;a</a>
								</div>
							</div>
						</form>
				</div>
				<div class="clearfooter"></div>
			</div>
		<?php include("footer_comun.php");?>
		<script type="text/javascript">

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

						if(!esVacio("pass"))
						{
							return false;
						}
						else
						{
							aprobar("pass");
						}

						$("form").submit();
					});
				}
			);
		</script>
		<?php include("footer.php");?>

	</body>
</html>