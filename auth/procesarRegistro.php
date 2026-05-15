<?php
session_start();
include("../includes/db.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: registro.php");
    exit;
}

$username = trim(isset($_POST['username']) ? $_POST['username'] : '');
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (empty($username) || empty($password)) {
    header("Location: registro.php?error=campos");
    exit;
}

$conexion = get_db_connection();

// Verificar si el usuario ya existe
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->get_result()->fetch_assoc() && header("Location: registro.php?error=existe") && exit();

// Recheck limpio
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    header("Location: registro.php?error=existe");
    exit;
}

// Hashear contraseña e insertar
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conexion->prepare("INSERT INTO usuarios (username, password, is_admin) VALUES (?, ?, FALSE)");
$stmt->bind_param("ss", $username, $hash);

if ($stmt->execute()) {
    // Loguearlo automáticamente
    $_SESSION['usuario_id'] = $conexion->insert_id;
    $_SESSION['username']   = $username;
    $_SESSION['is_admin']   = false;
    header("Location: ../pages/pokedex.php");
} else {
    header("Location: registro.php?error=campos");
}
exit;