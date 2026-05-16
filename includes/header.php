<?php
$busqueda = isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm">
    <div class="container">
        <span class="navbar-brand mb-0 h1 fw-bold">Pokédex</span>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPokedex" aria-controls="navbarPokedex" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarPokedex">
            <div class="mx-auto my-3 my-lg-0 px-0 px-lg-4 w-100" style="max-width: 600px;">
                <form action="pokedex.php" method="GET" class="d-flex gap-2 w-100">
                    <input type="text"
                           name="busqueda"
                           class="form-control"
                           placeholder="Buscar Pokémon por nombre..."
                           value="<?php echo $busqueda; ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <?php if ($busqueda !== ''): ?>
                        <a href="pokedex.php" class="btn btn-secondary">Limpiar</a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-2 mt-2 mt-lg-0">
                <a href="../auth/logout.php"
                   class="btn btn-sm btn-outline-light text-center px-3"
                   style="white-space: nowrap;">
                    Cerrar sesión
                </a>

                <a href="../auth/eliminarCuenta.php"
                   class="btn btn-sm btn-light text-danger fw-bold text-center px-4"
                   style="white-space: nowrap; min-width: 150px;"
                   onclick="return confirm('¿Seguro querés eliminar tu cuenta? Esta acción no se puede deshacer.')">
                    Eliminar cuenta
                </a>
            </div>
        </div>
    </div>
</nav>