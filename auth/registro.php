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

    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
            rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 100%; max-width: 420px;">

        <h2 class="text-center mb-4 text-danger">Crear cuenta</h2>

        <?php if ($error === 'existe'): ?>
            <div class="alert alert-danger" role="alert">
                Ese nombre de usuario ya está en uso.
            </div>
        <?php elseif ($error === 'campos'): ?>
            <div class="alert alert-danger" role="alert">
                Completá todos los campos.
            </div>
        <?php endif; ?>

        <form action="procesarRegistro.php" method="POST">

            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input
                        type="text"
                        name="username"
                        class="form-control"
                        required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input
                        type="password"
                        name="password"
                        class="form-control"
                        required
                >
            </div>

            <button type="submit" class="btn btn-danger w-100">
                Registrarse
            </button>

        </form>

        <div class="text-center mt-3">
            <a href="../index.php" class="text-decoration-none">
                ¿Ya tenés cuenta? Iniciá sesión
            </a>
        </div>

    </div>

</div>

</body>
</html>