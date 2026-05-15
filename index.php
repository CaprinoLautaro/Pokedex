<?php
session_start();

// Si ya está logueado, mandarlo al pokedex
if (isset($_SESSION['usuario_id'])) {
    header("Location: pages/pokedex.php");
    exit;
}

$error = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Pokédex</title>
</head>
<body>
<h1>Pokédex - Iniciar Sesión</h1>

<?php if ($error === 'credenciales'): ?>
    <p style="color:red;">Usuario o contraseña incorrectos.</p>
<?php endif; ?>

<form action="auth/procesarLogin.php" method="POST">
    <label>Usuario:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Iniciar sesión</button>
</form>

<br>
<a href="auth/registro.php">¿No tenés cuenta? Registrate acá</a>
</body>
</html>