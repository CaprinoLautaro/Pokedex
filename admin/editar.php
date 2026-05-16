<?php
session_start();
include("../includes/db.php");
$conexion = get_db_connection();

/* =========================
   PROCESAR FORM (UPDATE)
========================= */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $tipo1 = $_POST['tipo1_id'];
    $tipo2 = !empty($_POST['tipo2_id']) ? $_POST['tipo2_id'] : NULL;
    $descripcion = $_POST['description'];

    // caso: nueva imagen
    if (!empty($_FILES['imagen']['name'])) {

        $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $imagen_final = uniqid("poke_") . "." . $ext;

        move_uploaded_file(
                $_FILES['imagen']['tmp_name'],
                "../assets/pokemon/" . $imagen_final
        );

        $sql = "UPDATE pokemons 
                SET nombre=?, tipo1_id=?, tipo2_id=?, descripcion=?, imagen=? 
                WHERE id=?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param(
                "siissi",
                $nombre,
                $tipo1,
                $tipo2,
                $descripcion,
                $imagen_final,
                $id
        );

    } else {

        $sql = "UPDATE pokemons 
                SET nombre=?, tipo1_id=?, tipo2_id=?, descripcion=? 
                WHERE id=?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param(
                "siisi",
                $nombre,
                $tipo1,
                $tipo2,
                $descripcion,
                $id
        );
    }

    if ($stmt->execute()) {
        header("Location: ../pages/pokedex.php?update=success");
        exit();
    } else {
        echo "Error al actualizar: " . $conexion->error;
        exit();
    }
}

/* =========================
   CARGAR DATOS (FORM GET)
========================= */

if (!isset($_GET['id'])) {
    header("Location: ../pages/pokedex.php");
    exit();
}

$id = base64_decode($_GET['id']);

$sql = "SELECT * FROM pokemons WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$pokemon = $stmt->get_result()->fetch_assoc();

if (!$pokemon) {
    die("Pokémon no encontrado.");
}

$resultadoTipos = $conexion->query("SELECT id, nombre FROM tipos ORDER BY nombre ASC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar - <?php echo $pokemon['nombre']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/pokedex.css">
</head>

<body class="bg-light">

<div class="container py-4 py-md-5">

    <div class="card shadow border-0" style="border-radius: 20px; overflow: hidden;">

        <form method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?php echo $pokemon['id']; ?>">

            <div class="row g-0">

                <div class="col-md-5 bg-white p-4 text-center border-end">
                    <h6 class="text-muted fw-bold mb-3">IMAGEN ACTUAL</h6>

                    <img src="../assets/pokemon/<?php echo $pokemon['imagen']; ?>"
                         id="imgPreview"
                         class="img-fluid mb-3"
                         style="max-height: 250px; object-fit: contain;">

                    <input type="file" name="imagen" class="form-control" onchange="preview(this)">
                </div>

                <div class="col-md-7 p-4 p-md-5">

                    <h3 class="mb-4 text-primary">Editar Datos</h3>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nombre</label>
                        <input type="text" name="nombre" class="form-control"
                               value="<?php echo $pokemon['nombre']; ?>" required>
                    </div>

                    <div class="row g-3 mb-3">

                        <div class="col-6">
                            <label class="form-label fw-bold">Tipo 1</label>
                            <select name="tipo1_id" class="form-select">
                                <?php while($t = $resultadoTipos->fetch_assoc()): ?>
                                    <option value="<?php echo $t['id']; ?>"
                                            <?php if($t['id'] == $pokemon['tipo1_id']) echo 'selected'; ?>>
                                        <?php echo $t['nombre']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="col-6">
                            <label class="form-label fw-bold">Tipo 2</label>
                            <select name="tipo2_id" class="form-select">
                                <option value="">Ninguno</option>
                                <?php $resultadoTipos->data_seek(0); ?>
                                <?php while($t = $resultadoTipos->fetch_assoc()): ?>
                                    <option value="<?php echo $t['id']; ?>"
                                            <?php if($t['id'] == $pokemon['tipo2_id']) echo 'selected'; ?>>
                                        <?php echo $t['nombre']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Descripción</label>
                        <textarea name="description" class="form-control" rows="3"><?php echo $pokemon['descripcion']; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-lg">
                        Terminar y Guardar
                    </button>

                    <a href="../pages/pokedex.php"
                       class="btn btn-link w-100 mt-2 text-muted text-decoration-none">
                        Cancelar
                    </a>

                </div>
            </div>

        </form>

    </div>
</div>

<script>
    function preview(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => document.getElementById('imgPreview').src = e.target.result;
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</body>
</html>