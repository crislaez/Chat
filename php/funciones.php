<?php
		   
define('SERVIDOR', 'localhost'); //el servidor local
define('BBDD', 'salachat'); //la base de datos
define('USUARIO', 'root'); //el usuario
define('CLAVE', ''); //la clave del usuario

function mostrarDatos(){

    @$conexion = mysqli_connect(SERVIDOR, USUARIO, CLAVE, BBDD) or
    die("<p>Error de BBDD: ERROR ".mysqli_connect_errno().":".mysqli_connect_error()."</p>\n");

    mysqli_set_charset($conexion, 'utf8');

    $sql = "SELECT * FROM `chat`";

    @$resultado = mysqli_query($conexion, $sql) or die ("<p>Error de BBDD: ERROR ".mysqli_connect_errno($conexion).":".mysqli_connect_error($conexion)."</p>\n");

    mysqli_data_seek($resultado, 0);
    $todo = mysqli_fetch_all($resultado, MYSQLI_ASSOC);


    mysqli_free_result($resultado);
    mysqli_close($conexion);

    echo json_encode($todo);
}

function ingresar($nombre,$mensaje,$fecha){    

    @$conexion = mysqli_connect(SERVIDOR, USUARIO, CLAVE, BBDD) or
    die("<p>Error de BBDD: ERROR ".mysqli_connect_errno().":".mysqli_connect_error()."</p>\n");

    mysqli_set_charset($conexion, 'utf8');

    $buscar = mysqli_real_escape_string($conexion,$nombre,);
    $buscar2 = mysqli_real_escape_string($conexion,$mensaje);
    $buscar3 = mysqli_real_escape_string($conexion,$fecha);

    $sql = "INSERT INTO chat (cod_mensaje, usuario, mensaje, hora) VALUES ('','$buscar','$buscar2','$buscar3')";

    $querie = $conexion->query($sql); 

    if($querie == true){
        echo "registro exitoso";
    }
    else{
        echo "registro fallo";
    }
    mysqli_close($conexion);
}
            

?>