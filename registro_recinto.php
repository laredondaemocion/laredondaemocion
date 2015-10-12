<?php
	##Formulario Registro Recinto
	##@autor : Victor Toledo
	##fecha : revision 13/08/15

	header ('Content-type: text/html; charset=ISO-8859-1');
	session_start();
	include("conexionbd.php");
?>

<!DOCTYPE HTML>
<html>

	<head>
		<?php include("header_comun.php");?>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<script language="javascript" >
			
			$(document).ready(function(){
			   $("#region").change(function () {
			           $("#region option:selected").each(function () {
			            id_region = $(this).val();
			            $.post("cargar_provincia.php", { id_region: id_region }, function(data){
			                $("#provincia").html(data);
			            });            
			        });
			   });
			});	
		
			$(document).ready(function(){   
			   $("#provincia").change(function () {
			           $("#provincia option:selected").each(function () {
			            id_provincia = $(this).val();
			            $.post("cargar_comuna.php", { id_provincia: id_provincia }, function(data){
			                $("#comuna").html(data);
			            });            
			        });
			   });
			});	
		</script>
		<title>Registro de Recinto</title>
	</head>
	
	
	<body>

		<?php include("menu.php");?>

		<div id="cosa"></div>

		<br><br><br><br>

		<div class="container">

		
			<form  class="form-horizontal" role="form" id="registro" name="regRecinto" 
			method="post" action="registrar_recinto.php" >
				<div class="col-xs-6 col-xs-offset-2">
					<h4>Formulario Registro de Recinto</h4>
					<div class="form-group">
						<div class="col-sm-12">
							<label>Nombre</label>
						</div>
						<div class="col-sm-6">
					 		<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del recinto">
					 	</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<label>Regi&oacute;n</label>
						</div>
						<div class="col-sm-6">
							<select class="form-control" id="region" name="region" >
								<option value="">Seleccione Regi&oacute;n</option>
			
								<?php

									$resultado=mysqli_query($conexion,"CALL nombre_regiones();");

									while ($row=mysqli_fetch_array($resultado)) 
									{
										echo "<option value='$row[0]'>$row[1]</option>";
									}

									mysqli_close($conexion);	
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<label>Provincia</label>
						</div>
						<div class="col-sm-6">  
							<select class="form-control" id="provincia" name="provincia">
								<option value="">Seleccione Provincia</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<label>Comuna</label>
						</div>
						<div class="col-sm-6">
							<select class="form-control" id="comuna" name="comuna">
								<option value="">Seleccione Comuna</option>	
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<label>Direcci&oacute;n</label>
						</div>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direcci&oacute;n del recinto">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<label>Tel&eacute;fono</label>
						</div>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="telefono" name="telefono" placeholder="Tel&eacute;fono del recinto">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<label>Correo electr&oacute;nico</label>
						</div>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="correo" name="correo" placeholder="Correo electr&oacute;nico del recinto">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-6">
							<button type="button" id="boton-form" class="btn btn-default"> Registrar</button>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<h4>Ubicaci&oacute;n del recinto</h4>
					<div id="mapa" class="form-group">
				        <!-- aqui va el mapa!!!! -->
				    </div>
				    <div class="form-group" hidden>
				    	<div class="col-sm-6">
					    	<input type="text" class="form-control" readonly  id="cx" name="cx" autocomplete="off" hidden />
					    	<input type="text" class="form-control"  readonly id="cy" name="cy" autocomplete="off" hidden/>
				    	</div>
				    </div>
				</div>
			</form>
			<div class="clearfooter"></div>
		</div>
	
		
		<?php include("footer_comun.php");?>

		<script type="text/javascript">

			//VARIABLES GENERALES
        	//declaras fuera del ready de jquery
    		var nuevos_marcadores = [];
    
		    //FUNCION PARA QUITAR MARCADORES DE MAPA
		    function limpiar_marcadores(lista)
		    {
		        for(i in lista)
		        {
		            //QUITAR MARCADOR DEL MAPA
		            lista[i].setMap(null);
		        }
		    }

		    function fn_mal(){ 
            // esta no se usa
        	}
	        function fn_ok( rta ) { // esta funcion es la geolocalizacion exitosa
	            
	            var lat = rta.coords.latitude;
	            var lon = rta.coords.longitude;

	            //VARIABLE DE FORMULARIO
	            var formulario = $("#registro");
	            var punto = new google.maps.LatLng(lat,lon); 
	            var config = {
	                zoom:16,
	                center:punto,
	                mapTypeId: google.maps.MapTypeId.HYBRID
	            };
	            var mapa = new google.maps.Map( $("#mapa")[0], config );

	            google.maps.event.addListener(mapa, "click", function(event){
	               var coordenadas = event.latLng.toString();
	               
	               coordenadas = coordenadas.replace("(", "");
	               coordenadas = coordenadas.replace(")", "");
	               
	               var lista = coordenadas.split(",");
	               
	               var direccion = new google.maps.LatLng(lista[0], lista[1]);
	               //PASAR LA INFORMACIÓN AL FORMULARIO
	               formulario.find("input[name='titulo']").focus();
	               formulario.find("input[name='cx']").val(lista[0]);
	               formulario.find("input[name='cy']").val(lista[1]);
	               
	               
	               var marcador = new google.maps.Marker({
	                   //titulo:prompt("Titulo del marcador?"),
	                   position:direccion,
	                   map: mapa, 
	                   animation:google.maps.Animation.DROP,
	                   draggable:false
	               });
	               //ALMACENAR UN MARCADOR EN EL ARRAY nuevos_marcadores
	               nuevos_marcadores.push(marcador);
	               
	               google.maps.event.addListener(marcador, "click", function(){

	               });
	               
	               //BORRAR MARCADORES NUEVOS
	               limpiar_marcadores(nuevos_marcadores);
	               marcador.setMap(mapa);
	            });
	        }// funcion geolocalizacion correcta

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

			$(document).ready(
				function()
				{
					navigator.geolocation.getCurrentPosition ( fn_ok , fn_mal);

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

						if(!esVacio("direccion"))
						{
							return false;
						}
						else
						{
							aprobar("direccion");
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

						if(!esVacio("correo"))
						{
							return false;
						}
						else
						{
							aprobar("correo");
						}

						if(!esVacio("cx"))
						{
							return false;
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