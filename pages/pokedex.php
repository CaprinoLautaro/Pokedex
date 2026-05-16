<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

$es_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : false;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/pokedex.css">
</head>

<body class="d-flex flex-column min-vh-100">
<main class="flex-grow-1">

    <?php include("../includes/header.php"); ?>

    <div class="container mt-4 mb-5">

        <?php
        include("../includes/db.php");
        $conexion = get_db_connection();

        $busqueda = isset($_GET['busqueda']) ? mysqli_real_escape_string($conexion, $_GET['busqueda']) : '';

        if(!empty($busqueda)){
            $sql = "SELECT p.*,
                t1.nombre AS tipo1_nombre, t1.imagen AS tipo1_imagen,
                t2.nombre AS tipo2_nombre, t2.imagen AS tipo2_imagen
            FROM pokemons p
            JOIN tipos t1 ON p.tipo1_id = t1.id
            LEFT JOIN tipos t2 ON p.tipo2_id = t2.id
            WHERE p.nombre LIKE '%$busqueda%'
            ORDER BY p.numero_pokedex ASC";
        } else {
            $sql = "SELECT p.*,
                t1.nombre AS tipo1_nombre, t1.imagen AS tipo1_imagen,
                t2.nombre AS tipo2_nombre, t2.imagen AS tipo2_imagen
            FROM pokemons p
            JOIN tipos t1 ON p.tipo1_id = t1.id
            LEFT JOIN tipos t2 ON p.tipo2_id = t2.id
            ORDER BY p.numero_pokedex ASC";
        }

        $resultado = $conexion->query($sql);

        if(mysqli_num_rows($resultado) == 0){
            echo '<div class="container mt-5 d-flex justify-content-center">
                <div class="alert alert-danger text-center shadow-sm w-100" style="max-width: 500px;">
                No se encontraron Pokémones que coincidan con tu búsqueda.
                </div>
              </div>';
        }
        ?>

        <?php if (mysqli_num_rows($resultado) > 0): ?>
            <div class="table-responsive card shadow-sm border-0 bg-white" style="transform: none !important; overflow-x: auto;">
                <table class="table align-middle mb-0" style="min-width: 600px;">
                    <thead class="table-dark">
                    <tr>
                        <th class="ps-5 pe-1">Imagen</th>
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
                            onclick="window.location='pokemon.php?id=<?php echo base64_encode($pokemon['id']); ?>';">

                            <td class="ps-5 pe-1">
                                <img src="../assets/pokemon/<?php echo $pokemon['imagen']; ?>"
                                     alt="<?php echo $pokemon['nombre']; ?>"
                                     style="width: 50px; height: 50px; object-fit: contain;">
                            </td>

                            <td>
                                <div class="d-inline-flex flex-wrap gap-1">
                            <span class="badge-tipo tipo-<?php echo strtolower($pokemon['tipo1_nombre']); ?>">
                                <img src="../assets/types/<?php echo $pokemon['tipo1_imagen']; ?>" width="18">
                                <?php echo $pokemon['tipo1_nombre']; ?>
                            </span>

                                    <?php if ($pokemon['tipo2_nombre']) { ?>
                                        <span class="badge-tipo tipo-<?php echo strtolower($pokemon['tipo2_nombre']); ?>">
                                    <img src="../assets/types/<?php echo $pokemon['tipo2_imagen']; ?>" width="18">
                                    <?php echo $pokemon['tipo2_nombre']; ?>
                                </span>
                                    <?php } ?>
                                </div>
                            </td>

                            <td class="text-muted">#<?php echo $pokemon['numero_pokedex']; ?></td>

                            <td class="fw-bold text-dark"><?php echo $pokemon['nombre']; ?></td>

                            <?php if ($es_admin): ?>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-1">
                                        <a href="../admin/editar.php?id=<?php echo base64_encode($pokemon['id']); ?>"
                                           class="btn btn-sm btn-warning fw-bold"
                                           onclick="event.stopPropagation();">
                                            Editar
                                        </a>
                                        <a href="../admin/eliminar.php?id=<?php echo $pokemon['id']; ?>"
                                           class="btn btn-sm btn-danger fw-bold"
                                           onclick="event.stopPropagation(); return confirm('¿Estás seguro de que querés eliminar a este Pokémon?');">
                                            Eliminar
                                        </a>
                                    </div>
                                </td>
                            <?php endif; ?>

                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <?php if ($es_admin): ?>
                <div class="text-center mt-4 mb-4">
                    <a href="../pages/crearPokemon.php" class="btn btn-warning shadow fw-bold px-4 py-2">
                        + Agregar Pokémon
                    </a>
                </div>
            <?php endif; ?>

        <?php endif; ?>

    </div>
</main>
<?php include("../includes/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>