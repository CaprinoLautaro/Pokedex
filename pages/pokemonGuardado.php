<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

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

<?php

// include $_SERVER['DOCUMENT_ROOT'].'/includes/db.php';
include("../includes/db.php");

$conexion = get_db_connection();

$sql = " select id, nombre
from tipos
ORDER BY nombre ASC ";
$resultado = $conexion->query($sql);


$numero = $_POST['numero'];
$nombre = $_POST['nombre'];
$tipo1_id = $_POST['tipo1'];
$tipo2_id = !empty($_POST['tipo2'])
        ? $_POST['tipo2']
        : null;
$descripcion = $_POST['descripcion'];
$imagen = $_FILES['imagen']['name'];

move_uploaded_file(
        $_FILES['imagen']['tmp_name'],
        "../assets/pokemon/" . $imagen
);

$imagen_final =  $imagen;

//Valido que no exista el pokemon en la base de datos
$sql = "SELECT * FROM pokemons WHERE numero_pokedex = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $numero);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    $insertoPokemon = "INSERT INTO pokemons (numero_pokedex, nombre, tipo1_id, tipo2_id,descripcion, imagen) VALUES (?, ?, ?, ?, ?, ?)";

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
    if ($validoInsercionEnBD->execute()) { ?>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card shadow p-4 bg-primary-subtle" style="width: 500px; border-radius: 20px;">
            <h2 class="p-3 text-center"> El Pokemon #<?php echo $numero . " " . $nombre ?> se agregó
                correctamente </h2>
        </div>
    </div>
    <?php } else { ?>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card shadow p-4 bg-primary-subtle" style="width: 500px; border-radius: 20px;">
            <h2 class="p-3 text-center"> Error al agregar el Pokemon #<?php echo $numero . " " . $nombre ?> se
                agregó correctamente </h2>
        </div>
    </div>
<?php }
    } else {
?>
<div class="container d-flex justify-content-center align-items-center">
    <div class="card shadow p-4 bg-primary-subtle" style="width: 500px; border-radius: 20px;">
        <h2 class="p-3 text-center"> Ese numero de Pokemón ya existe</h2>
    </div>
</div>
<?php } ?>

<br><br>
<div class="container d-flex justify-content-center align-items-center">
    <button type="button" class="btn btn-primary" onclick="window.location.href='../index.php'">Volver</button>
</div>
</body>
</html>



