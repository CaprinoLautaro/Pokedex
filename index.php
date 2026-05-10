<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pokedex</title>

    <!-- Bootstrap -->

    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
            rel="stylesheet"
    >

    <!-- CSS -->

    <link
            rel="stylesheet"
            href="styles/index.css"
    >

</head>

<body>

<nav class="navbar navbar-dark bg-danger">

    <div class="container">

        <span class="navbar-brand mb-0 h1">
            Pokédex
        </span>

    </div>

</nav>

<div class="container mt-4">

    <?php

    include $_SERVER['DOCUMENT_ROOT'].'/includes/db.php';

    $conexion = get_db_connection();

    $sql = " SELECT
    p.*,

    t1.nombre AS tipo1_nombre,
    t1.imagen AS tipo1_imagen,
    t2.nombre AS tipo2_nombre,
    t2.imagen AS tipo2_imagen

FROM pokemons p

JOIN tipos t1
ON p.tipo1_id = t1.id

LEFT JOIN tipos t2
ON p.tipo2_id = t2.id 
ORDER BY p.numero_pokedex ASC ";
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
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php while($pokemon = $resultado->fetch_assoc()) { ?>
                <tr class="fila-pokemon" onclick="window.location='pokemon.php?id=<?php echo $pokemon['id']; ?>';">
                    <td>
                        <img src="uploads/pokemon/<?php echo $pokemon['imagen']; ?>"
                             alt="<?php echo $pokemon['nombre']; ?>"
                             style="width: 50px; height: 50px; object-fit: contain;">
                    </td>

                    <td>
                        <div class="d-flex gap-1">
                            <span class="badge-tipo tipo-<?php echo strtolower($pokemon['tipo1_nombre']); ?>">
                                <img src="assets/types/<?php echo $pokemon['tipo1_imagen']; ?>" width="20">
                                <?php echo $pokemon['tipo1_nombre']; ?>
                            </span>

                            <?php if($pokemon['tipo2_nombre']) { ?>
                                <span class="badge-tipo tipo-<?php echo strtolower($pokemon['tipo2_nombre']); ?>">
                                    <img src="assets/types/<?php echo $pokemon['tipo2_imagen']; ?>" width="20">
                                    <?php echo $pokemon['tipo2_nombre']; ?>
                                </span>
                            <?php } ?>
                        </div>
                    </td>

                    <td>#<?php echo $pokemon['numero_pokedex']; ?></td>

                    <td class="fw-bold"><?php echo $pokemon['nombre']; ?></td>

                    <td class="text-center">
                        <a href="editar.php?id=<?php echo $pokemon['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="eliminar.php?id=<?php echo $pokemon['id']; ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('¿Seguro querés borrar a <?php echo $pokemon['nombre']; ?>?')">
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>


<?php include("includes/footer.php"); ?>