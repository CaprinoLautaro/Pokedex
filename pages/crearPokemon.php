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
?>

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4 bg-primary-subtle" style="width: 500px; border-radius: 20px;">
<form action="./pokemonGuardado.php" method="post" enctype="multipart/form-data">

    <h2 class="p-3 text-center">Agregar Pokemon</h2>

    <div class="p-3">
        <label for="numero">Numero Pokedex:</label>
        <input type="number" id="numero" name="numero" class="form-control form-control-m">
    </div>

    <div class="p-3">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" class="form-control form-control-m">
    </div>

    <div class="p-3">
        <label for="tipo1">Tipo Principal:</label>
        <select name="tipo1" id="tipo1" class="form-control form-control-m" required>
            <option value="">Seleccionar tipo</option>
            <?php while ($tipo = $resultado->fetch_assoc()) {
                echo "<option value='" . $tipo['id'] .  "'>" . $tipo['nombre'] ."</option>";
            } ?>
        </select>
    </div>

    <div class="p-3">
        <label for="tipo2">Tipo Secundario:</label>
        <select name="tipo2" id="tipo2" class="form-control form-control-m">
            <option value="">Seleccionar tipo</option>
            <?php
            $resultado->data_seek(0);
            while ($tipo = $resultado->fetch_assoc()) {
                echo "<option value='" . $tipo['id'] .  "'>" . $tipo['nombre'] ."</option>";
            } ?>
        </select>
    </div>

    <div class="p-3">
        <label for="descripcion">Descripcion:</label>
        <textarea class="form-control" id="descripcion" name="descripcion" class="form-control form-control-m" rows="3"></textarea>
    </div>


    <div class="p-3">
        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen" class="form-control form-control-m" placeholder="Seleccionar imagen" accept="image/*">
    </div>

    <div class="w-100 p-3 btn-group" role="group" aria-label="Basic radio toggle button group">
        <button type="submit" class="btn-check" name="btnradio" id="btnradio1"></button>
        <label class="btn btn-primary" for="btnradio1">Guardar</label>
        <button type="reset" class="btn-check" name="btnradio" id="btnradio2"></button>
        <label class="btn btn-outline-primary" for="btnradio2">Borrar</label>

        <button type="button" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" onclick="window.location.href='../index.php'">Volver</button>
        <label class="btn btn-outline-primary" for="btnradio3">Volver</label>
    </div>


</form>
</div>
</div>

</body>
</html>


<?php
