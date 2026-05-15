<?php
session_start();
include("../includes/db.php");
$conexion = get_db_connection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $tipo1 = $_POST['tipo1_id'];
    $tipo2 = !empty($_POST['tipo2_id']) ? $_POST['tipo2_id'] : NULL;
    $descripcion = $_POST['description'];

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombre_imagen = strtolower($nombre) . ".png";
        move_uploaded_file($_FILES['imagen']['tmp_name'], "../assets/pokemon/" . $nombre_imagen);

        $sql = "UPDATE pokemons SET nombre = ?, tipo1_id = ?, tipo2_id = ?, descripcion = ?, imagen = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("siissi", $nombre, $tipo1, $tipo2, $descripcion, $nombre_imagen, $id);
    } else {
        $sql = "UPDATE pokemons SET nombre = ?, tipo1_id = ?, tipo2_id = ?, descripcion = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("siisi", $nombre, $tipo1, $tipo2, $descripcion, $id);
    }

    if ($stmt->execute()) {
        header("Location: ../pages/pokedex.php?update=success");
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }
}