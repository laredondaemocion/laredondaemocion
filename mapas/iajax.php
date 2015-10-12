<?php
header('content-type: application/json; charset=utf-8');//HEADER PARA JSON
include_once 'puntosDAO.php';
$ac = isset($_POST["tipo"])?$_POST["tipo"]:"x"; //PARAMETRO PARA DETERMINAR LA ACCION
 
switch ($ac) { 
    case "listar":
        $p = new puntosDao();
        $resultados = $p->listar_todo();
        if(sizeof($resultados)>0)
        {
            $r["estado"] = "ok";
            $r["mensaje"] = $resultados;
        }
        else
        {
            $r["estado"] = "error";
            $r["mensaje"] = "No hay registros";
        }
    break;
}
echo json_encode($r);//IMPRIMIR JSON
?>