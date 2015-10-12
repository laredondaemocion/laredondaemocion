<?php 
	## Borrado imagen de bd
	## @autor : Victor Toledo
	## @fecha : revision 20/08

    include("conexionbd.php");
    session_start();
 
    $lista=$_POST['borra'];
    $dir = $_POST['dire'];
    $largo=count($lista);



    if(!empty($lista))
    {

    
        for($i=0;$i<$largo;$i++)
        {

            $id=$lista[$i];
            $ruta=$dir[$i];
            

            $consl=mysqli_query($conexion,"SELECT eliminar_multimedia_recinto('$id');") or die(mysqli_error($conexion));
            $resp=mysqli_fetch_row($consl);
             
            if($resp[0]==1)
            {
                if(file_exists($ruta)){
                    unlink($ruta);
                }
                echo "<script language=javascript>
                alert('Imagen Eliminada Satisfactoriamente');
                window.opener.location.reload();
                window.close();
                </script>";

                
            }
        }
        mysqli_close($conexion);
    }
?>