<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/db.php';
$conexion = get_db_connection();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = base64_decode($_GET['id']);

$sql = "SELECT p.*, 
               t1.nombre AS tipo1_nombre, t1.imagen AS tipo1_imagen,
               t2.nombre AS tipo2_nombre, t2.imagen AS tipo2_imagen
        FROM pokemons p
        JOIN tipos t1 ON p.tipo1_id = t1.id
        LEFT JOIN tipos t2 ON p.tipo2_id = t2.id
        WHERE p.id = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$pokemon = $resultado->fetch_assoc();

if (!$pokemon) {
    die("El Pokémon no existe.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex - <?php echo $pokemon['nombre']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <a href="index.php" class="btn btn-outline-danger mb-4">
                ← Volver a la Pokédex
            </a>

            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="row g-0">

                    <div class="col-md-5 bg-light d-flex align-items-center justify-content-center p-4">
                        <img src="uploads/pokemon/<?php echo $pokemon['imagen']; ?>"
                             class="img-fluid"
                             style="max-height: 400px; filter: drop-shadow(5px 5px 15px rgba(0,0,0,0.1));"
                             alt="<?php echo $pokemon['nombre']; ?>">
                    </div>

                    <div class="col-md-7">
                        <div class="card-body p-5">

                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="h4 text-muted fw-light">#<?php echo $pokemon['numero_pokedex']; ?></span>
                            </div>

                            <h1 class="display-4 fw-bold mb-4"><?php echo $pokemon['nombre']; ?></h1>

                            <div class="mb-4">
                                <h5 class="text-uppercase text-muted small fw-bold">Tipo</h5>

                                <div class="d-flex align-items-center gap-3 mt-2" style="height: 100px;">

                                    <div class="badge-tipo tipo-<?php echo strtolower($pokemon['tipo1_nombre']); ?> d-flex align-items-center justify-content-center">
                                        <img src="assets/types/<?php echo $pokemon['tipo1_imagen']; ?>"
                                             style="width: 25px; height: 25px; object-fit: contain; flex-shrink: 0;"
                                             class="me-2">
                                        <span style="line-height: 1;"><?php echo $pokemon['tipo1_nombre']; ?></span>
                                    </div>

                                    <?php if($pokemon['tipo2_nombre']) { ?>
                                        <div class="badge-tipo tipo-<?php echo strtolower($pokemon['tipo2_nombre']); ?> d-flex align-items-center justify-content-center">
                                            <img src="assets/types/<?php echo $pokemon['tipo2_imagen']; ?>"
                                                 style="width: 25px; height: 25px; object-fit: contain; flex-shrink: 0;"
                                                 class="me-2">
                                            <span style="line-height: 1;"><?php echo $pokemon['tipo2_nombre']; ?></span>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="text-uppercase text-muted small fw-bold">Descripción</h5>
                                <p class="lead text-dark" style="line-height: 1.6;">
                                    <?php echo $pokemon['descripcion']; ?>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>