<?php
include_once 'conex.php';//INCLUIR CONEXION DE BASE DE DATOS
 
class puntosDao
{
    private $r;
    public function __construct()
    {
        $this->r = array();
    }
    public function listar_todo()
    {
        $q = "select * from Recinto;";
        $con = conex::con();
        $rpta = mysql_query($q,$con);
        mysql_close($con);
        while($fila = mysql_fetch_assoc($rpta))
        {
            $this->r[] = $fila;
        }
        return $this->r;
        
    }
 }
?>