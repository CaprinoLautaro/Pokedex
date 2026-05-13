<?php

include_once '../includes/db.php';
$conexion = get_db_connection();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM pokemons
            WHERE id = $id";

    if(mysqli_query($conexion, $sql)){
        header('Location: ../index.php');
        exit();
    }else{
        echo "Error al intentar eliminar el pokemon: " . mysqli_error($conexion);
    }
}else{
    header('location: ../index.php');
    exit();
}
?>
