<?php 

  ## Perfil Recinto
  ## @autor : Victor Toledo
  ## @fecha : revision 17/08
  ## obs: 
      
  session_start();
  include("conexionbd.php");

?>
<html>
  <head>
    <title>La Redonda Emoci&oacute;n : Perfil Administrador</title>
    <?php include("header_comun.php");?>
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <link rel="stylesheet" href="css/bootstrap-image-gallery.min.css">

    <script type="text/javascript">

      function openfileDialog() {
        $("#fileLoader").click();
      }

      $(document).ready( function() {
        $("a[rel='pp']").click(function () {
          nova=window.open(this.href, 'Eliminar Imagen Cancha','height=700,width=800,resizable=false,scrollbars=true,location=false');
          return false;
        });

      });

      $(function() {
        $( "#ventana" ).tabs({
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
          <li><a href="#ventana-1">Recinto</a></li>
          <li><a href="#ventana-2">Canchas</a></li>
          <li><a href="#ventana-3">Multimedia</a></li>
        </ul>
        <div id="ventana-1">
          <div class="row">

            <div class="col-md-2">
                <img class='img-rounded' aling='left' <?php echo 'src="img/perfiles/recinto/'.$_GET['id_recinto'].'/logo.png"';?> 
                WIDTH=100% HEIGHT=200px  BORDER=2 >
            </div>
            <div class="col-md-5">
              <?php
              
                $resultado=mysqli_query($conexion,"CALL recinto_por_id('$_GET[id_recinto]');")
                or die(mysqli_error($conexion));

                if($row=mysqli_fetch_array($resultado)) 
                { 

                  echo "<h3>Nombre: $row[nombre_recinto]</h3>";
                  echo "<h3>Direcci&oacute;n: $row[direccion]</h3>";
                  echo "<h3>Telefono: $row[telefono_recinto]</h3>";
                  echo "<h3>Correo Electronico : $row[correo_recinto]</h3>";

                  echo "<div class='row'>
                  <div class='col-md-2'></div>";
                 
                  echo "</div>";
                } 
                mysqli_close($conexion);
              ?>
            </div>
          </div>
        </div>
          <div id="ventana-2">
            <div class="row">
              <div class="col-md-5" style="width:1120px; height:300px; overflow-y:scroll; border:solid;">
                <?php
                  
                  $aux = mysqli_connect($host,$user,$pass,$db);
                  $cont=0;
                  $resultado=mysqli_query($aux,"CALL canchas_recinto('$_GET[id_recinto]');") 
                  or die(mysqli_error($aux));
                  while($rew=mysqli_fetch_array($resultado)){

                    $foto_conexion = mysqli_connect($host,$user,$pass,$db);
                    $ale=mysqli_query($foto_conexion,"CALL multimedia_cancha_random('$rew[0]');") 
                    or die(mysqli_error($foto_conexion));

                    $fot=mysqli_fetch_row($ale);

                    if($fot[2]==null)
                    {
                      echo "<br><h4 style='color:white;'>Numero Cancha: # $rew[numero_cancha]</h4>";
                      echo "<img class='img-rounded ' src='img/recursos/default.jpg' WIDTH=100% HEIGHT=200px  BORDER=2 >";
                      echo "
                      <div class='col-md-5'>
                        <a class='btn btn-info' style='color: white;' href='perfil_cancha.php?idc=$rew[0]'>Ver Cancha</a>";
                      if(isset($_SESSION['rut'])){
                        $aux1 = mysqli_connect($host,$user,$pass,$db);
                        $resultado1=mysqli_query($aux1,"SELECT administrador_de_cancha($_SESSION[rut],$rew[0]);") 
                        or die(mysqli_error($aux1));
                        if ($row1=mysqli_fetch_array($resultado1)) {  
                          if ($row1[0]==1) {
                            echo "  <a style='color: white;'  class='btn btn-danger' href='eliminar_cancha.php?idc=$rew[0]&idr=$_GET[id_recinto]'>Eliminar Cancha</a>";  
                          }
                          
                        }
                      }
                      echo "</div> <br>";
                    }
                    else{
                      echo "<br><h4 style='color:white;'>Numero Cancha: # $rew[numero_cancha]</h4>";
                      echo "<img class='img-rounded ' src='$fot[2]' WIDTH=100% HEIGHT=200px  BORDER=2 >";
                      echo "
                      <div class='col-md-5'>
                        <a class='btn btn-info' style='color: white;' href='perfil_cancha.php?idc=$rew[0]'>Ver Cancha</a>";
                      if(isset($_SESSION['rut'])){
                        $aux1 = mysqli_connect($host,$user,$pass,$db);
                        $resultado1=mysqli_query($aux1,"SELECT administrador_de_cancha($_SESSION[rut],$rew[0]);") 
                        or die(mysqli_error($aux1));
                        if ($row1=mysqli_fetch_array($resultado1)) {  
                          if ($row1[0]==1) {
                            echo "  <a style='color: white;' class='btn btn-danger' href='eliminar_cancha.php?idc=$rew[0]&idr=$_GET[id_recinto]'>Eliminar Cancha</a>";  
                          }
                          
                        }
                      }
                      echo "</div>  <br>";
                    }
                    $cont++;
                    mysqli_close($foto_conexion);
                  }
                  if ($cont==0) {
                    echo "<h3 class='text-center' style='margin-top:10%;'>No existen canchas asociados.</h3>";
                  }
                ?>  
              </div>
              <div class="col-md-5">
                <?php
                if(isset($_SESSION['rut'])){
                  if($_SESSION['rut']==$row['Administrador_rut_administrador'] && $_SESSION['tipo']==1)
                  {
                    echo "<br>";
                    echo "<a class='btn btn-info' style='color: white;' href='registrar_cancha.php?id=$_GET[id_recinto]'>Agregar Cancha</a>";
                  }
                }
                ?>
              </div>
            </div> 
          </div>
          <div id="ventana-3">
            <div class="row">
              <div class="col-md-5" style="width:1120px; height:300px; overflow-y:scroll; border:solid;">
                <div id="links" style="margin-top:1%;">
                <?php

                  $conector = mysqli_connect($host,$user,$pass,$db);
                  $total_ima=0;

                  $imagenes = mysqli_query($conector,"CALL multimedias_recinto('$_GET[id_recinto]');")
                  or die(mysqli_error($conector));

                  while($resp=mysqli_fetch_array($imagenes))
                  {
                    echo "<a href='$resp[direccion]' title='$total_ima' data-gallery>
                    <img src='$resp[direccion]' alt='$total_ima' width='150' height='150'>
                    </a>";
                    $total_ima++;
                  }
                  if ($total_ima==0) {
                    echo "<h3 class='text-center' style='margin-top:10%;'>No hay imagenes asociadas</h3>";
                  }
                  mysqli_close($conector);
                ?>
                </div>
              </div>
              <div class="col-md-12">
                <br>
                <div class="row">
                  <div class="col-md-5">
                    <?php
                    if(isset($_SESSION['rut'])){
                      if($_SESSION['rut']==$row['Administrador_rut_administrador'] && $_SESSION['tipo']==1)
                      {
                        echo '<form name="cargador" id="cargador" method="post" action="subida_recinto.php" enctype="multipart/form-data">
                          <input type="text" name="recinto" value="'.$_GET['id_recinto'].'" hidden>
                          <input type="file" id="fileLoader" name="img[]" multiple accept="image/*" title="Load File" onchange="javascript:this.form.submit();" />
                          <input type="button" class="btn btn-info" id="btnOpenFileDialog" value = "Añadir Imagenes" onclick="openfileDialog();" /> 
                        </form>';
                      }
                    }
                    ?>
                  </div>
                  <div class="col-md-5 col-md-offset-1">
                    <?php
                    if(isset($_SESSION['rut'])){
                      if($_SESSION['rut']==$row['Administrador_rut_administrador'] && $_SESSION['tipo']==1)
                      {
                        echo "<a href='elimagen_recinto.php?idc=$_GET[id_recinto]' class='btn btn-danger' style='color:white;' rel='pp'>Eliminar Imagen</a>";
                      }
                    }
                    ?> 
                  </div>  
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
        <div class="clearfooter"></div>
      </div>

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
      <?php include("footer.php"); ?>
      <?php include("footer_comun.php"); ?>
      <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
      <script src="js/bootstrap-image-gallery.min.js"></script>
  </body>
</html>