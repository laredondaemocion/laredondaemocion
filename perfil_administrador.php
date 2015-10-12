<?php 

  ## Perfil Arrendatario
  ## @autor : Victor Toledo
  ## @fecha : revision 17/08
  ## obs: 
      
  session_start();
  include("conexionbd.php");

  if(isset($_SESSION['rut']))
  {
    if($_SESSION['tipo']==2)
    {
      header("location:perfil_arrendatario.php");
    }
  }
  else
  {
    echo "<script>alert('Debe iniciar sesion como administrador');
    window.location.href='ingreso.php';
    </script>";
  }
?>
<html>
  <head>
    <title>La Redonda Emoci&oacute;n : Perfil Administrador</title>
    <?php include("header_comun.php");?>

    <script type="text/javascript">
      $(function() {
        $( "#ventana" ).tabs({
        });
      });
       function eliminar(){
        confirmacion=confirm("¿Está seguro que desea eliminar su cuenta?");
        if (confirmacion) {
          window.location="eliminar_administrador.php ";
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
          <li><a href="#ventana-2">Recintos</a></li>
        </ul>
        <div id="ventana-1">
          <div class="row">

            <div class="col-md-2">
              <img class='img-rounded' aling="left" width="100%" height="200px" border="2" <?php echo 'src="img/perfiles/admin/'.$_SESSION['rut'].'/perfil.png"';?> alt="perfil">
            </div>
            <div class="col-md-5">
              <?php
              
                $resultado=mysqli_query($conexion,"CALL datos_administrador_por_rut('$_SESSION[rut]');")
                or die(mysqli_error($conexion));

                if($row=mysqli_fetch_array($resultado)) 
                {
                  $fecha=split("-",$row[1]);

                  echo "<h3>Nombre: $row[0]</h3>";
                  echo "<h3>Rut: $row[2]-$row[3]</h3>";
                  echo "<h3>F. Nacimiento: $fecha[2]/$fecha[1]/$fecha[0]</h3>";
                  echo "<div class='row'>
                  <div class='col-md-2'></div>
                  <a href='editar_administrador.php' class='btn btn-success' rel='pop-up'>Editar Datos</a>
                  <a class='btn btn-danger' onclick='eliminar()'>Eliminar Cuenta</a>
                  </div>";
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
                  $resultado=mysqli_query($aux,"CALL recintos_administrador('$_SESSION[rut]');") 
                  or die(mysqli_error($aux));
                  while($rew=mysqli_fetch_array($resultado)){
                   
                    $foto_conexion = mysqli_connect($host,$user,$pass,$db);
                    $ale=mysqli_query($foto_conexion,"CALL multimedia_recinto_random('$rew[0]');") 
                    or die(mysqli_error($foto_conexion));

                    $fot=mysqli_fetch_row($ale);

                    if($fot[3]==null)
                    { echo "<h4 style='color:white;'>$rew[nombre_recinto]</h4>";
                      echo "<img class='img-rounded ' src='img/recursos/default.jpg' WIDTH=100% HEIGHT=200px  BORDER=2 >";
                      echo "<a class='btn btn-info' href='perfil_recinto.php?id_recinto=$rew[0]'>Ver Perfil<a>   ";
                      echo "<a class='btn btn-danger' href='eliminar_recinto.php?id_recinto=$rew[0]'>Eliminar Recinto<a>";
                      
                    }
                    else
                    {

                      echo "<img class='img-rounded ' src='$fot[3]' WIDTH=100% HEIGHT=200px  BORDER=2 >";
                      echo "<a class='btn btn-info' href='perfil_recinto.php?id_recinto=$rew[0]'>Ver Perfil<a>   ";
                      echo "<a class='btn btn-danger' href='eliminar_recinto.php?id_recinto=$rew[0]'>Eliminar Recinto<a>";
                      
                    }
                    $cont++;
                    mysqli_close($foto_conexion);
                  }
                  if ($cont==0) {
                    echo "<h3 class='text-center' style='margin-top:40%;'>No existen recintos asociados.</h3>";
                  }
                ?>  
              </div>
              <div class="col-md-5">
                <?php
                  echo "<br>";
                  echo "<a class='btn btn-info' style='color: white;' href='registro_recinto.php'>Agregar Recinto</a>";
                ?>
              </div>
            </div> 
          </div>
        </div>
        <div class="clearfooter"></div>
      </div>
      <?php include("footer.php"); ?>
      <?php include("footer_comun.php"); ?>
  </body>
</html>