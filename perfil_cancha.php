<?php 

  ## Perfil cancha
  ## @autor : Victor Toledo
  ## @fecha : revision 17/08
  ## obs: 
      
  session_start();
  include("conexionbd.php");

?>
<html>
  <head>
    <title>La Redonda Emoci&oacute;n : Perfil Cancha</title>
    <?php include("header_comun.php");?>
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <link rel="stylesheet" href="css/bootstrap-image-gallery.min.css">
    <script type="text/javascript">
      
      function openfileDialog() {
        $("#fileLoader").click();
      }

      $(document).ready( function() {
        $("a[rel='pop-up']").click(function () {
          nueva=window.open(this.href, 'Reserva','height=700,width=800,resizable=false,scrollbars=true,location=false');
          return false;
        });

      });

      $(document).ready( function() {
        $("a[rel='pp']").click(function () {
          nova=window.open(this.href, 'Eliminar Imagen Cancha','height=700,width=800,resizable=false,scrollbars=true,location=false');
          return false;
        });

      });

      $(document).ready( function() {
        $("a[rel='pop']").click(function () {
          nuevo=window.open(this.href, 'Info-Reserva','height=700,width=800,resizable=false,scrollbars=true,location=false');
          return false;
        });
      });

      $(function() {
        $("#ventana").tabs({
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
          <li><a href="#ventana-1">Cancha</a></li>
          <li><a href="#ventana-5">Caracter&iacute;sticas</a></li>
          <li><a href="#ventana-2">Horario</a></li>
          <li><a href="#ventana-3">Multimedia</a></li>
        </ul>
        <div id="ventana-1">
          <div class="row">
          
            <div class="col-md-5">
              <?php
                
                $auxi = mysqli_connect($host,$user,$pass,$db);
                $resultado=mysqli_query($auxi,"CALL datos_cancha('$_GET[idc]');")
                or die(mysqli_error($auxi));

                if($rew=mysqli_fetch_array($resultado)) 
                { 

                  echo "<h3>Nombre: $rew[nombre_recinto]</h3>";
                  echo "<h3>Direcci&oacute;n: $rew[direccion]</h3>";
                  echo "<h3>Telefono: $rew[telefono_recinto]</h3>";
                  echo "<h3>Correo Electronico : $rew[correo_recinto]</h3>";

                  echo "<div class='row'>
                  <div class='col-md-2'></div>";
                  
                  echo "</div>";
                } 
                mysqli_close($auxi);
              ?>
            </div>
          </div>
        </div>
        <div id="ventana-5">
          <div class="row">
            <div class="col-sm-10">
              <?php

                echo "<h3>Numero de cancha: # $rew[numero_cancha]</h3>
                <h3>Tipo: $rew[tipo_cancha]</h3>
                <h3>Jugadores por lado: $rew[jugadores_lado]</h3>
                <h3>Precio horario dia: $ $rew[precio_cancha_hora_dia]</h3>
                <h3>Precio horario nocturno: $ $rew[precio_cancha_hora_noche]</h3>";
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
                $imagenes = mysqli_query($conector,"CALL multimedias_Cancha('$_GET[idc]');")
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
                <div class="col-md-6">
                  <?php
                     if(isset($_SESSION['rut']))
                    {
                      if($_SESSION['rut']==$rew['Administrador_rut_administrador'] && $_SESSION['tipo']==1)
                      {
                        echo "<form name='cargador' id='cargador' method='post' action='subida_cancha.php' enctype='multipart/form-data'>
                          <input type='text' name='cancha' value='$_GET[idc]' hidden>
                          <input type='file' id='fileLoader' name='img[]' multiple accept='image/*' title='Load File' onchange='javascript:this.form.submit();'/>
                          <input type='button' class='btn btn-info' id='btnOpenFileDialog' value = 'Añadir Imagenes' onclick='openfileDialog();'/> 
                        </form>";
                      }
                    }
                  ?>
                </div>
                <div class="col-md-5 col-md-offset-1">
                  <?php
                     if(isset($_SESSION['rut']))
                    {
                      if($_SESSION['rut']==$rew['Administrador_rut_administrador'] && $_SESSION['tipo']==1)
                      {
                        echo "<a href='elimagen_cancha.php?idc=$_GET[idc]' class='btn btn-danger' style='color:white;' rel='pp'>Eliminar Imagen</a>";
                      }
                    }
                  ?> 
                </div>
              </div>
            </div>
          </div> 
        </div>
        <div id="ventana-2">
          <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
              <h2 class="text-center">Detalles cancha</h2>
                <?php
                  $time = time();
                ?>
                <table class="table table-bordered text-center">
                  <tr>
                    <td>Hora</td>
                    <?php
                      $cont=0;  
                      for($i=(date("N", $time)-1); $i<7;$i++){
                      $dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
                      $fecha = $dias[$i];

                      echo "<td>$fecha<br>".($cont+date("d", $time)).date("-M", $time)."</td>";
                      $cont++;
                      }
                      for ($x=0; $x <(date("N", $time)-1) ; $x++) { 
                        $fecha = $dias[$x];
                        echo "<td>$fecha<br>".($cont+date("d", $time)).date("-M", $time)."</td>";
                        $cont++;
                      }
                    ?>
                  </tr>

                  <?php

                    $conexion_aux = mysqli_connect($host,$user,$pass,$db);  
                    if (isset($_SESSION['rut'])) {
                      $rut=$_SESSION['rut'];
                      $idc=$_GET['idc'];

                      $resultado=mysqli_query($conexion_aux,"SELECT administrador_de_cancha($rut,$idc)") 
                      or die(mysqli_error($conexion_aux));
                        
                      if($row=mysqli_fetch_array($resultado)){
                        $admin=$row[0];
                      }
                      mysqli_close($conexion_aux);
                    }

                    for ($i=0; $i <=22 ; $i++){ 
                      echo "<tr> <td>$i:00-".($i+1).":00</td>";
                      for ($l=1; $l <=7 ; $l++) { 

                        if (empty($_SESSION['tipo'])) {
                          echo "<td><a href='ingreso.php' class='btn btn-info'>Registrarse</a></td>";
                        }else if ($_SESSION['tipo']==1 && $admin==1 ) { // If que dice ser Arministrador de la cancha.

                          $aux = mysqli_connect($host,$user,$pass,$db);

                          $resultado=mysqli_query($aux,"CALL `horario_cancha`($idc,$l,$i)") or die(mysqli_error($aux));

                          if($row=mysqli_fetch_array($resultado)){
                                
                            $id_hora=$row['idHorario'];
                                
                            if ($row['diaOnoche']==2) {
                              echo "<td>
                              <h5 color:'red'>CERRADO</h5>
                              </td>";
                            }else if($row['diaOnoche']==1 || $row['diaOnoche']==0){

                              if($row[1]==0){
                                echo "<td><a class='btn btn-info' disabled>Libre</a></td>";
                              }else{
                                echo "<td>
                                <a href='info_reserva.php?id_horario=$id_hora' rel='pop' class='btn btn-success'>Reservada</a>
                                </td>";
                              }
                            }
                          }
                          }else if ($_SESSION['tipo']==1 && $admin==0 ) {//If que dice ser administrador pero no de esta cancha
                            echo "<td><a class='btn btn-warning' disabled>No Disponible</a></td>";
                          }else if ($_SESSION['tipo']==2) { // if que dice ser usuario
                            $aux = mysqli_connect($host,$user,$pass,$db);
                            $resultado=mysqli_query($aux,"CALL `horario_cancha`($idc,$l,$i);");
                            if($row=mysqli_fetch_array($resultado)){
                              $id_hora=$row['idHorario'];
                              if ($row['diaOnoche']==2) {
                                echo "<td>
                                <h5 color:red>CERRADO</h5>
                                </td>";
                              }else if($row['diaOnoche']==1 || $row['diaOnoche']==0  ){

                                if($row[1]==0){
                                  echo "<td><a href='reserva.php?idc=$_GET[idc]&id_horario=$id_hora' class='btn btn-success' rel='pop-up'>Reservar</a></td>";
                                }else{
                                  $con_res = mysqli_connect($host,$user,$pass,$db);
                                  $resultad=mysqli_query($con_res,"CALL datos_usuario_idhorario($id_hora)");
                                  $resp = mysqli_fetch_row($resultad);
                                  if(!empty($resp[0]) && $resp[0]==$_SESSION['rut']){
                                    echo "<td>
                                    <a href='info_reserva.php?id_horario=$id_hora' rel='pop' class='btn btn-info'>Reservada
                                    </a>
                                    </td>";
                                  }else{  
                                    echo "<td>
                                    <a class='btn btn-danger' disabled>Reservada</a>
                                    </td>";
                                  }
                                }
                              }
                            }
                          }
                        }
                        echo "</tr>";
                      }

                      echo "<tr><td>23:00-00:00</td>";
                      for ($l=1; $l <=7 ; $l++) { 
                        if (empty($_SESSION['tipo'])) {
                          echo "<td><a href='ingreso.php' class='btn btn-info'>Registrarse</a></td>";
                        }else if ($_SESSION['tipo']==1 && $admin==1 ) {// If que dice ser Arministrador de la cancha.
                          $aux = mysqli_connect($host,$user,$pass,$db);

                          $resultado=mysqli_query($aux,"CALL `horario_cancha`($idc,$l,$i)") or die(mysqli_error($aux));

                          if($row=mysqli_fetch_array($resultado)){
                            $id_hora=$row['idHorario'];
                                
                            if ($row['diaOnoche']==2) {
                              echo "<td>
                                    <h5 color:'red'>CERRADO</h5>
                                    </td>";
                            }else if($row['diaOnoche']==1 || $row['diaOnoche']==0){
                              if($row[1]==0){
                                echo "<td><a class='btn btn-info' disabled>Libre</a></td>";
                              }else{
                                 echo "<td>
                                <a href='info_reserva.php?id_horario=$id_hora' rel='pop' class='btn btn-success'>Reservada
                                </a>
                                </td>";
                              }
                            }
                          }
                        }else if ($_SESSION['tipo']==1 && $admin==0 ) { //If que dice ser administrador pero no de esta cancha
                          echo "<td><a class='btn btn-warning'>No Disponible</a></td>";
                        }else if ($_SESSION['tipo']==2) { // if que dice ser usuario
                          $aux = mysqli_connect($host,$user,$pass,$db);
                          $resultado=mysqli_query($aux,"CALL `horario_cancha`($idc,$l,$i);");
                          if($row=mysqli_fetch_array($resultado)){
                            $id_hora=$row['idHorario'];
                            if ($row['diaOnoche']==2) {
                              echo "<td>
                              <h5 color:red>CERRADO</h5>
                              </td>";
                            }else if($row['diaOnoche']==1 || $row['diaOnoche']==0  ){
                              if($row[1]==0){
                                echo "<td><a href='reserva.php?idc=$_GET[idc]&id_horario=$id_hora' class='btn btn-success' rel='pop-up'>Reservar</a></td>";
                              }else{

                                $con_res = mysqli_connect($host,$user,$pass,$db);
                                $resultad=mysqli_query($con_res,"CALL datos_usuario_idhorario($id_hora)");
                                $resp = mysqli_fetch_row($resultad);
                                if(!empty($resp[0]) && $resp[0]==$_SESSION['rut']){
                                  echo "<td>
                                  <a href='info_reserva.php?id_horario=$id_hora' rel='pop' class='btn btn-info'>Reservada</a>
                                  </td>";
                                }else{  
                                  echo "<td>
                                  <a class='btn btn-danger' disabled>Reservada</a>
                                  </td>";
                                }
                              }
                            }
                          }
                        }
                      }

                      echo "</tr>";
                    ?>
                  </table>
                  
                </div><?php //fin de col-sm-7?>
              </div> <?php //fin de row?>
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