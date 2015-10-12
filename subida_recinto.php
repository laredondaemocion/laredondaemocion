<?php 
   include("conexionbd.php");

   if (isset ($_FILES["img"])) {
      $tot = count($_FILES["img"]["name"]);
      if(!(is_dir("/XAMPP/htdocs/laredonda/img/recintos/".$_POST["recinto"]))){
         mkdir("/XAMPP/htdocs/laredonda/img/recintos/".$_POST["recinto"], 0775);
      }
      for ($i = 0; $i < $tot; $i++){ 
         $tmp_name = $_FILES["img"]["tmp_name"][$i];
         $name = $_FILES["img"]["name"][$i];
         $type = $_FILES["img"]["type"][$i];
         /*echo "<b>Archivo </b> $i ";
         echo "<br />";
         echo "<b>el nombre original:</b> ";
         echo $name;
         echo "<br />";
         echo "<b>el nombre temporal:</b> \n";
         echo $tmp_name;
         echo "<br />"; 
         echo "<b>Tipo :</b>";
         echo $type;*/
         $ruta= "img/recintos/".$_POST["recinto"]."/".$_FILES['img']['name'][$i];

         if(!file_exists($ruta)){

            move_uploaded_file($_FILES['img']['tmp_name'][$i],$ruta);

            $guardado = mysqli_query($conexion,"SELECT insertar_multimedia_recinto('$_POST[recinto]','$ruta',1);")
            or die(mysqli_error($conexion));

            $resp = mysqli_fetch_row($guardado);

            if($resp[0]==1)
            {
               echo "<script>
               window.location.href='perfil_recinto.php?id_recinto=$_POST[recinto]';
               </script>";
            }
         }
      }
   }
?>