<?php
session_start();

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

    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
            rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 100%; max-width: 420px;">

        <h2 class="text-center mb-4 text-danger">Pokédex</h2>

        <?php if ($error === 'credenciales'): ?>
            <div class="alert alert-danger" role="alert">
                Usuario o contraseña incorrectos.
            </div>
        <?php endif; ?>

        <form action="auth/procesarLogin.php" method="POST">

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
                Iniciar sesión
            </button>

        </form>

        <div class="text-center mt-3">
            <a href="auth/registro.php" class="text-decoration-none">
                ¿No tenés cuenta? Registrate acá
            </a>
        </div>

    </div>

</div>

</body>
</html>