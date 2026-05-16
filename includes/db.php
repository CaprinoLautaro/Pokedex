<?php
function get_db_connection() {
    $host = "localhost";
    $usuario = "root";
    $password = "";
    $base_de_datos = "pokedex";
    $puerto = 3306;

    $conexion = new mysqli(
        $host,
        $usuario,
        $password,
        $base_de_datos,
        $puerto
    );

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    return $conexion;
}

?>
