<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="styles/index.css">
</head>

<body>

<?php
include("../includes/db.php");

$conexion = get_db_connection();

$numero = $_POST['numero'];
$nombre = $_POST['nombre'];
$tipo1_id = $_POST['tipo1'];
$tipo2_id = !empty($_POST['tipo2']) ? $_POST['tipo2'] : null;
$descripcion = $_POST['descripcion'];
$imagen = $_FILES['imagen']['name'];

move_uploaded_file(
        $_FILES['imagen']['tmp_name'],
        "../assets/pokemon/" . $imagen
);

$imagen_final = $imagen;

// Verifico si existe
$sql = "SELECT * FROM pokemons WHERE numero_pokedex = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $numero);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<div class="container d-flex justify-content-center align-items-center min-vh-100 flex-column py-5">

    <?php
    // CASO 1: no existe el pokemon
    if ($resultado->num_rows == 0) {

        $insertoPokemon = "INSERT INTO pokemons (numero_pokedex, nombre, tipo1_id, tipo2_id, descripcion, imagen)
                       VALUES (?, ?, ?, ?, ?, ?)";

        $validoInsercionEnBD = $conexion->prepare($insertoPokemon);

        $validoInsercionEnBD->bind_param(
                "isiiss",
                $numero,
                $nombre,
                $tipo1_id,
                $tipo2_id,
                $descripcion,
                $imagen_final
        );

        if ($validoInsercionEnBD->execute()) {
            ?>

            <div class="card shadow p-4 bg-primary-subtle mb-4" style="width: 500px; border-radius: 20px;">
                <h2 class="p-3 text-center">
                    El Pokémon #<?php echo $numero . " " . $nombre ?> se agregó correctamente
                </h2>
            </div>

            <?php
        } else {
            ?>

            <div class="card shadow p-4 bg-danger-subtle mb-4" style="width: 500px; border-radius: 20px;">
                <h2 class="p-3 text-center">
                    Error al agregar el Pokémon #<?php echo $numero . " " . $nombre ?>
                </h2>
            </div>

            <?php
        }

// CASO 2: ya existe
    } else {
        ?>

        <div class="card shadow p-4 bg-warning-subtle mb-4" style="width: 500px; border-radius: 20px;">
            <h2 class="p-3 text-center">
                Ese número de Pokémon ya existe
            </h2>
        </div>

    <?php } ?>

    <!-- BOTÓN SIEMPRE CENTRADO -->
    <button type="button" class="btn btn-primary" onclick="window.location.href='../index.php'">
        Volver
    </button>

</div>

</body>
</html>