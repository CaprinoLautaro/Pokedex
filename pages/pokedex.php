<?php
session_start();

// Evita cache: si cerrás sesión, no deja volver con el botón atrás
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

$es_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex</title>

    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
            rel="stylesheet"
    >

    <link
            rel="stylesheet"
            href="../styles/pokedex.css"
    >
</head>

<body>

<nav class="navbar navbar-dark bg-danger">
    <div class="container d-flex justify-content-between align-items-center">
        <span class="navbar-brand mb-0 h1">Pokédex</span>

        <div class="d-flex align-items-center gap-3">
            <a href="../auth/logout.php" class="btn btn-sm btn-outline-light">Cerrar sesión</a>

            <a href="../auth/eliminarCuenta.php"
               class="btn btn-sm btn-light text-danger fw-bold"
               onclick="return confirm('¿Seguro querés eliminar tu cuenta? Esta acción no se puede deshacer.')">
                Eliminar cuenta
            </a>
        </div>
    </div>
</nav>

<div class="container mt-4">

    <?php
    include("../includes/db.php");

    $conexion = get_db_connection();

    $sql = "SELECT
                p.*,
                t1.nombre AS tipo1_nombre,
                t1.imagen AS tipo1_imagen,
                t2.nombre AS tipo2_nombre,
                t2.imagen AS tipo2_imagen
            FROM pokemons p
            JOIN tipos t1 ON p.tipo1_id = t1.id
            LEFT JOIN tipos t2 ON p.tipo2_id = t2.id
            ORDER BY p.numero_pokedex ASC";

    $resultado = $conexion->query($sql);
    ?>

    <div class="table-responsive">
        <table class="table table-hover align-middle shadow-sm">
            <thead class="table-dark">
            <tr>
                <th>Imagen</th>
                <th>Tipo</th>
                <th>Número</th>
                <th>Nombre</th>

                <?php if ($es_admin): ?>
                    <th class="text-center">Acciones</th>
                <?php endif; ?>
            </tr>
            </thead>

            <tbody>
            <?php while ($pokemon = $resultado->fetch_assoc()) { ?>
                <tr class="fila-pokemon"
                    onclick="window.location='../pokemon.php?id=<?php echo base64_encode($pokemon['id']); ?>';">

                    <td>
                        <img src="../assets/pokemon/<?php echo $pokemon['imagen']; ?>"
                             alt="<?php echo $pokemon['nombre']; ?>"
                             style="width: 50px; height: 50px; object-fit: contain;">
                    </td>

                    <td>
                        <div class="d-flex gap-1">

                            <span class="badge-tipo tipo-<?php echo strtolower($pokemon['tipo1_nombre']); ?>">
                                <img src="../assets/types/<?php echo $pokemon['tipo1_imagen']; ?>" width="20">
                                <?php echo $pokemon['tipo1_nombre']; ?>
                            </span>

                            <?php if ($pokemon['tipo2_nombre']) { ?>
                                <span class="badge-tipo tipo-<?php echo strtolower($pokemon['tipo2_nombre']); ?>">
                                    <img src="../assets/types/<?php echo $pokemon['tipo2_imagen']; ?>" width="20">
                                    <?php echo $pokemon['tipo2_nombre']; ?>
                                </span>
                            <?php } ?>

                        </div>
                    </td>

                    <td>#<?php echo $pokemon['numero_pokedex']; ?></td>

                    <td class="fw-bold"><?php echo $pokemon['nombre']; ?></td>

                    <?php if ($es_admin): ?>
                        <td class="text-center">

                            <a href="../admin/editar.php?id=<?php echo base64_encode($pokemon['id']); ?>"
                               class="btn btn-warning"
                               onclick="event.stopPropagation();">
                                Editar
                            </a>

                            <a href="../admin/eliminar.php?id=<?php echo $pokemon['id']; ?>"
                               class="btn btn-danger"
                               onclick="event.stopPropagation(); return confirm('¿Estás seguro de que querés eliminar a este Pokémon?');">
                                Eliminar
                            </a>

                        </td>
                    <?php endif; ?>

                </tr>
            <?php } ?>
            </tbody>
        </table>

        <?php if ($es_admin): ?>
            <div class="contenedor-boton-sticky">
                <button
                        type="button"
                        class="btn btn-warning shadow-sm fw-bold"
                        onclick="window.location.href='crearPokemon.php'">
                    Agregar Pokémon
                </button>
            </div>
        <?php endif; ?>

    </div>

</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>