<?php 
	## Borrado imagen de bd
	## @autor : Victor Toledo
	## @fecha : revision 20/08

    include("conexionbd.php");
    session_start();
 
    $lista=$_POST['borrado'];
    $dir = $_POST['direc'];
    $largo=count($lista);

    if(!empty($lista))
    {
    
        for($i=0;$i<$largo;$i++)
        {
            $id=$lista[$i];
            $ruta=$dir[$i];

            $consl=mysqli_query($conexion,"SELECT eliminar_multimedia_cancha('$id');") or die(mysqli_error($conexion));
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