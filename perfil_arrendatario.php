<?php 

  ## perfil arrendatario
  ## @autor : Victor Toledo
  ## @fecha : revision 17/08
  ## obs: 
      
  session_start();
  include("conexionbd.php");

  if(isset($_SESSION['rut']))
  {
    if($_SESSION['tipo']==1)
    {
      header("location:perfil_administrador.php");
    }
  }
  else
  {
    echo "<script>alert('Debe iniciar sesion como arrendatario');
    window.location.href='ingreso.php';
    </script>";
  }
?>
<html>
  <head>
    <title>La Redonda Emoci&oacute;n : Perfil Arrendatario</title>
    <?php include("header_comun.php");?>

    <script type="text/javascript">
      $(function() {
        $( "#ventana" ).tabs({
        });
      });
      function eliminar(){
        confirmacion=confirm("¿Está seguro que desea eliminar su cuenta?");
        if (confirmacion) {
          window.location="eliminar_arrendatario.php ";
        }
      }
      function closepopup()
      {
        if(true == nueva.closed)
        {
          location.reload();
        }
      }
      $(document).ready( function() {
        $("a[rel='pop-up']").click(function () {
          nueva=window.open(this.href, 'Reserva','height=700,width=800,resizable=false,scrollbars=true,location=false');
          return false;
        });

      });

      $(document).ready( function() {
        $("a[rel='pop']").click(function () {
          nuevo=window.open(this.href, 'Info-Reserva','height=700,width=800,resizable=false,scrollbars=true,location=false');
          return false;
        });
      });
    </script>
  </head>
  <body>
    <?php include("menu.php");?>

    <div id="cosa"></div>
    <br><br><br><br><br>
    <div class="container">
      <div id="ventana">
        <ul>
          <li><a href="#ventana-1">Perfil</a></li>
          <li><a href="#ventana-3">Historial de reservas</a></li>
        </ul>
        <div id="ventana-1">
          <div class="row">

            <div class="col-md-2">
                 <img class='img-rounded' aling="left" width="100%" height="200px" border="2" <?php echo 'src="img/perfiles/user/'.$_SESSION['rut'].'/perfil.png"';?> alt="perfil">
            </div>
            <div class="col-md-5">
              <?php
              
                $resultado=mysqli_query($conexion,"CALL datos_usuario_por_rut('$_SESSION[rut]');")
                or die(mysqli_error($conexion));

                if($row=mysqli_fetch_array($resultado)) 
                {
                  $fecha=split("-",$row[1]);

                  echo "<h3>Nombre: $row[0]</h3>";
                  echo "<h3>Rut: $row[2]-$row[3]</h3>";
                  echo "<h3>F. Nacimiento: $fecha[2]/$fecha[1]/$fecha[0]</h3>";
                  echo "<h3>Correo Electronico: $row[correo_usuario]</h3>";
                  echo "<div class='row'>
                  <div class='col-md-2'></div>
                  <a href='editar_arrendatario.php' class='btn btn-success' rel='pop-up'>Editar Datos</a>
                  <a class='btn btn-danger' onclick='eliminar()'>Eliminar Cuenta</a>
                  </div>";
                } 
                mysqli_close($conexion);
              ?>
            </div>
          </div>
        </div>
         
          <div id="ventana-3">
            <div class="row">
              <div class="col-md-5" style="width:1120px; height:300px;">
                <?php
                $cont=0;
                $aux1 = mysqli_connect($host,$user,$pass,$db);
                $resultado=mysqli_query($aux1,"CALL cinco_reservas_usuario('$_SESSION[rut]');")
                or die(mysqli_error($aux1));
                echo "<table class='table table-bordered'>";
                echo "<tr>
                        <td>Nombre Recinto</td>
                        <td>Fecha</td>
                        <td>Enlace</td>
                      </tr>";
                      
                while($row=mysqli_fetch_array($resultado)){
                      $dat_cancha = mysqli_connect($host,$user,$pass,$db);
                      $resultado2=mysqli_query($dat_cancha,"CALL datos_cancha('$row[Cancha_idCancha]');")
                or die(mysqli_error($dat_cancha));
                  if ( $row2=mysqli_fetch_array($resultado2)){
                   echo "<tr>
                            <td>$row2[nombre_recinto]</td>
                            <td>$row[fecha]</td>
                            <td><a href='perfil_cancha.php?idc=$row[Cancha_idCancha]' class='btn btn-info'>Ver Cancha</a></td>
                        </tr>";
                  $cont++;
                  }
                  
                }
                echo "</table>";
                if ($cont==0) {
                  echo "<h3 class='text-center' style='margin-top:10%;'>No tiene historial de reservas.</h3>";
                }
                mysqli_close($aux1);
                ?>  
              </div>
            </div> 
          </div>
        </div>
        <div class="clearfooter"></div>
      </div>
      <?php include("footer.php"); ?>
      <?php include("footer_comun.php"); ?>
      <div id="blueimp-gallery" class="blueimp-gallery">
        <!-- The container for the modal slides -->
        <div class="slides"></div>
          <!-- Controls for the borderless lightbox -->
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
        <!-- The modal dialog, which will be used to wrap the lightbox content -->
        <div class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body next"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left prev">
                  <i class="glyphicon glyphicon-chevron-left"></i>
                  Anterior
                </button>
                <button type="button" class="btn btn-primary next">
                  Siguiente
                  <i class="glyphicon glyphicon-chevron-right"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
  </body>
</html>