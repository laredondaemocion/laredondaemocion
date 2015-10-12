<?php
	## Registro Registro de Cancha Formulario
	## @autor : Victor Toledo
	## @fecha : revision 14/08
	## @obs: falta mas info en la principal

	header ('Content-type: text/html; charset=ISO-8859-1');
	session_start();
	include('conexionbd.php');

	$aux = mysqli_connect($host,$user,$pass,$db);

	if(isset($_SESSION['rut']))
	{

		if($_SESSION['tipo']==2)
		{
			$cons = mysqli_query($aux,"CALL datos_usuario_por_rut('$_SESSION[rut]');")
			or die(mysqli_error($aux));

			$resp = mysqli_fetch_array($cons);

			$_SESSION['dv'] = $resp['digito_verificador'];
			$_SESSION['email'] = $resp['correo_usuario'];

			mysqli_close($aux);
		}
		else{

			$cons = mysqli_query($aux,"CALL datos_administrador_por_rut('$_SESSION[rut]');")
			or die(mysqli_error($aux));

			$resp = mysqli_fetch_array($cons);

			$_SESSION['dv'] = $resp['digito_verificador'];
			$_SESSION['email'] = $resp['correo_administrador'];

			mysqli_close($aux);
		}
	}     
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include("header_comun.php");?>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<script language="javascript" >

		    // Mapa y Geolocalizacion


		    var marcadores_bd= [];
			var mapa = null; //VARIABLE GENERAL PARA EL MAPA


			navigator.geolocation.getCurrentPosition ( fn_ok , fn_mal);

	        function fn_mal(){ 
	            alert("algo salio mal");
	        }
	        function fn_ok( rta ) { // esta funcion es la geolocalizacion exitosa
	            var lat = rta.coords.latitude;
	            var lon = rta.coords.longitude;

	            var punto = new google.maps.LatLng(lat,lon);
	            var config = {
	                zoom:13,
	                center:punto,
	                mapTypeId: google.maps.MapTypeId.ROADMAP
	            };
	            mapa = new google.maps.Map( $("#mapa_index")[0], config );
	            listar();
	        }// funcion geolocalizacion correcta

	        function listar(){
	       		$.ajax({
	               type:"POST",
	               url:"mapas/iajax.php",
	               dataType:"JSON",
	               data:"&tipo=listar",
	               success:function(data){
	                   if(data.estado=="ok")
	                    {   
	                            $.each(data.mensaje, function(i, item){
	                            //OBTENER LAS COORDENADAS DEL PUNTO
	                            var posi = new google.maps.LatLng(item.cx, item.cy);//bien
	                            //CARGAR LAS PROPIEDADES AL MARCADOR
	                            var marca = new google.maps.Marker({
	                                position:posi,
	                                rut:item.Administrador_rut_administrador,
	                                idRecinto: item.idRecinto,
	                                direccion: item.direccion,
	                                telefono: item.telefono_recinto,
	                                nombre: item.nombre_recinto,
	                                correo: item.correo_recinto,
	                                idComuna: item.comunaid

	                            });
	                            
	                            //AGREGAR EVENTO CLICK AL MARCADOR
	                            google.maps.event.addListener(marca, "click", function(){
	                               window.location.href = 'perfil_recinto.php?id_recinto='+marca.idRecinto;
	                            });
	                            
	                            //AGREGAR EL MARCADOR A LA VARIABLE MARCADORES_BD
	                            marcadores_bd.push(marca);
	                            //UBICAR EL MARCADOR EN EL MAPA
	                            marca.setMap(mapa);
	                        });
	                    }
	                else
	                    {
	                        alert("No hay canchas cercanas a tu posici&oacute;n");
	                    }
	               },
	               beforeSend:function(){
	                   
	               },
	               complete:function(){
	                   
	               }
	           });
	    	}

			$(function() {
      	  		$( "#ventana" ).tabs({
       		 	});
      		});

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
		
		<title>La Redonda Emoci&oacute;n</title>
		
	</head>
	<body>
		<?php include("menu.php");?>
		<br><br><br><br>
		<div class="container">
			
			<div id="ventana">
		        <ul>
		          <li><a href="#ventana-2">Geolocalizaci&oacute;n</a></li>
		          <li><a href="#ventana-1">Buscar Cancha</a></li>
		        </ul>
		        <div id="ventana-1">
		        	<div class="row">
			        	<div class="col-sm-6 text-center col-sm-offset-3" align="center">

			      			<div class="col-sm-12">	
								<h2>Busca tu cancha</h2>
							</div>
							<div class="col-sm-6 col-sm-offset-3" align="center">
								<form id="buscar" action="buscar_cancha.php" method="GET">

									<select id="region" class="form-control input-md" name="region" >
										<option value="0">Seleccione Regi&oacute;n</option>

										<?php
										$resultado=mysqli_query($conexion,"SELECT * FROM region");

										while ($row=mysqli_fetch_array($resultado)) {
											echo "<option value='$row[0]'>$row[1]</option>";
										}   
										?>
									</select>



									<select id="provincia" class="form-control input-md" name="provincia">
										<option value="0">Seleccione Provincia</option>
									</select>

									
									<select id="comuna" class="form-control input-md" name="comuna">
										<option value="0">Seleccione Comuna</option>    
									</select>



									<select id="tipo" class="form-control input-md" name="tipo">
										<option value="0">Seleccione Tipo Cancha</option>

										<?php
										$resultado=mysqli_query($conexion,"CALL tipos_cancha()");

										while ($row=mysqli_fetch_array($resultado)) {
											echo "<option value='$row[0]'>$row[0]</option>";
										}   
										?>
									</select>


									<input type="hidden" name="tip" value="buscar">
									<input type="submit" class="btn btn-info" value="BUSCAR">
								</form>
							</div>
						</div>
					</div>
				</div>
		        <div id="ventana-2">
		        	<div class="row">
			        	<div class="col-sm-6 text-center col-sm-offset-4" align="center">
			        		<div id="mapa_index">
						        <!-- aqui va el mapa!!!! -->
						    </div>
			        	</div>
		        	</div>
		        </div>
			</div>
			<div class="clearfooter"></div>
		</div>
		<?php include("footer.php");?>
		
		<?php include("footer_comun.php");?>	
	</body>
</html>