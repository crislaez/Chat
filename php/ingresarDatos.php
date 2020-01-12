<?php
    ini_set('display_errors','On');
    error_reporting(E_ALL);
    require_once 'funciones.php';
    if(isset($_POST)){
        $nombre = $_POST['nombre'];
        $mensaje = $_POST['mensaje'];
        $fecha = $_POST['fecha'];
        ingresar($nombre,$mensaje,$fecha);
    }
   
?>