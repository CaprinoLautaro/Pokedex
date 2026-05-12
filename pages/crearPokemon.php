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
<h1>Crear Pokemon</h1>
<br><br>
<form action="./">
    <label for="nombre">Nombre:</label>

    <input type="text" id="nombre" name="nombre">
    <br><br>
    <label for="tipo">Tipo:</label>
    <select name="tipo" id="tipo">
        <option value="">Seleccionar tipo</option>
        <option value="bug">Bug</option>
        <option value="dark">Dark</option>
        <option value="dragon">Dragon</option>
        <option value="electric">Electric</option>
        <option value="fairy">Fairy</option>
        <option value="fighting">Fighting</option>
        <option value="fire">Fire</option>
        <option value="flying">Flying</option>
        <option value="ghost">Ghost</option>
        <option value="grass">Grass</option>
        <option value="ground">Ground</option>
        <option value="ice">Ice</option>
        <option value="normal">Normal</option>
        <option value="poison">Poison</option>
        <option value="psychic">Psychic</option>
        <option value="rock">Rock</option>
        <option value="steel">Steel</option>
        <option value="water">Water</option>

    </select>
    <br><br>
    <label for="numero">Numero:</label>
    <input type="number" id="numero" name="numero">
    <br><br>
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="imagen" placeholder="Seleccionar imagen" accept="image/*">

    <button type="submit">
        <b>Guardar</b>
    </button>
    <button type="reset">
        <b>Borrar</b>
    </button>
    <button type="button" onclick="window.location.href='./'">
        <b>Volver</b>
    </button>
    <br><br>


</form>


</body>
</html>


<?php
