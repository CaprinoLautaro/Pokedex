<?php
function get_db_connection() {
    $host = "localhost";
    $usuario = "root";
    $password = "";
    $base_de_datos = "pokedex";
    $puerto = 3307;

    // Creamos la conexión
    $conexion = new mysqli(
        $host,
        $usuario,
        $password,
        $base_de_datos,
        $puerto
    );

    // Manejo de errores
    if ($conexion->connect_error) {
        // En un entorno real, querrías registrar esto, no solo morir.
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Retornamos la variable $conexion para que el archivo que nos llama pueda usarla.
    return $conexion;
}

?>
