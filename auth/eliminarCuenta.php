<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

$conexion = get_db_connection();

$stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $_SESSION['usuario_id']);
$stmt->execute();

session_destroy();
header("Location: ../index.php");
exit;