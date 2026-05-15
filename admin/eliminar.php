<?php

include_once '../includes/db.php';
$conexion = get_db_connection();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 1. IMPORTANTE: Primero buscamos el nombre de la imagen antes de borrar el registro
    $sql_imagen = "SELECT imagen FROM pokemons WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql_imagen);
    $pokemon = mysqli_fetch_assoc($resultado);

    if ($pokemon) {
        $nombre_archivo = $pokemon['imagen'];
        // Ajustamos la ruta según donde tengas las fotos (ej: assets/pokemon/ o uploads/)
        $ruta_foto = "../assets/pokemon/" . $nombre_archivo;

        // 2. Borramos el archivo físico del servidor
        if (file_exists($ruta_foto)) {
            unlink($ruta_foto);
        }

        // 3. Ahora que ya no hay foto, borramos el registro de la BD
        $sql = "DELETE FROM pokemons WHERE id = $id";

        if(mysqli_query($conexion, $sql)){
            header('Location: ../index.php');
            exit();
        } else {
            echo "Error al intentar eliminar el pokemon: " . mysqli_error($conexion);
        }
    } else {
        echo "El Pokémon no existe.";
    }
} else {
    header('location: ../index.php');
    exit();
}
?>