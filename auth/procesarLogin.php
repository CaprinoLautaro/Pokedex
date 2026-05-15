<?php
session_start();
include("../includes/db.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit;
}

$username = trim(isset($_POST['username']) ? $_POST['username'] : '');
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (empty($username) || empty($password)) {
    header("Location: ../index.php?error=credenciales");
    exit;
}

$conexion = get_db_connection();

$stmt = $conexion->prepare("SELECT id, username, password, is_admin FROM usuarios WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

if (!$usuario || !password_verify($password, $usuario['password'])) {
    header("Location: ../index.php?error=credenciales");
    exit;
}

// Guardar datos en sesión
$_SESSION['usuario_id'] = $usuario['id'];
$_SESSION['username']   = $usuario['username'];
$_SESSION['is_admin']   = (bool) $usuario['is_admin'];

header("Location: ../pages/pokedex.php");
exit;