<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    header("Location: ../pages/pokedex.php");
    exit;
}

$error = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrarse - Pokédex</title>
</head>
<body>
<h1>Crear cuenta</h1>

<?php if ($error === 'existe'): ?>
    <p style="color:red;">Ese nombre de usuario ya está en uso.</p>
<?php elseif ($error === 'campos'): ?>
    <p style="color:red;">Completá todos los campos.</p>
<?php endif; ?>

<form action="procesarRegistro.php" method="POST">
    <label>Usuario:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Registrarse</button>
</form>

<br>
<a href="../index.php">¿Ya tenés cuenta? Iniciá sesión</a>
</body>
</html>