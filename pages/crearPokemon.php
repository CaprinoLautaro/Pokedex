<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokédex - Agregar Pokémon</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Tu CSS Personalizado -->
    <link rel="stylesheet" href="../styles/index.css">
</head>
<body class="bg-light">

<?php
include("../includes/db.php");
$conexion = get_db_connection();

$sql = "SELECT id, nombre FROM tipos ORDER BY nombre ASC";
$resultado = $conexion->query($sql);
?>

<div class="container py-5">
    <!-- Tarjeta con el mismo estilo que editar.php (shadow, border-radius, g-0) -->
    <div class="card shadow border-0" style="border-radius: 20px; overflow: hidden;">
        
        <form action="./pokemonGuardado.php" method="post" enctype="multipart/form-data">
            
            <div class="row g-0">
                <!-- Columna Izquierda: Previsualización de Imagen -->
                <div class="col-md-5 bg-white p-4 text-center border-end d-flex flex-column justify-content-center align-items-center">
                    <h6 class="text-muted fw-bold mb-3 text-uppercase">Previsualización</h6>
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="min-height: 300px;">
                        <img src="../assets/pokemon/placeholder.png" id="imgPreview" class="img-fluid" style="max-height: 300px; object-fit: contain;" alt="Previsualización">
                    </div>
                    <div class="px-3 w-100">
                        <label for="imagen" class="form-label fw-bold">Seleccionar Imagen</label>
                        <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*" onchange="preview(this)" required>
                    </div>
                </div>

                <!-- Columna Derecha: Formulario de Datos -->
                <div class="col-md-7 p-5">
                    <h3 class="mb-4 text-primary fw-bold">Agregar Nuevo Pokémon</h3>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="numero" class="form-label fw-bold">N° Pokedex</label>
                            <input type="number" id="numero" name="numero" class="form-control" placeholder="Ej: 25" required>
                        </div>
                        <div class="col-md-8">
                            <label for="nombre" class="form-label fw-bold">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre del Pokémon" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="tipo1" class="form-label fw-bold">Tipo Principal</label>
                            <select name="tipo1" id="tipo1" class="form-select" required>
                                <option value="">Seleccionar...</option>
                                <?php 
                                $resultado->data_seek(0);
                                while ($tipo = $resultado->fetch_assoc()) {
                                    echo "<option value='" . $tipo['id'] . "'>" . $tipo['nombre'] . "</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="tipo2" class="form-label fw-bold">Tipo Secundario</label>
                            <select name="tipo2" id="tipo2" class="form-select">
                                <option value="">Ninguno</option>
                                <?php
                                $resultado->data_seek(0);
                                while ($tipo = $resultado->fetch_assoc()) {
                                    echo "<option value='" . $tipo['id'] . "'>" . $tipo['nombre'] . "</option>";
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="form-label fw-bold">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="form-control" rows="4" placeholder="Escribe algo sobre este Pokémon..."></textarea>
                    </div>

                    <!-- Botones -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm">Guardar Pokémon</button>
                        <a href="pokedex.php" class="btn btn-link text-muted">Cancelar y Volver</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Script para la previsualización de la imagen igual que en editar.php -->
<script>
    function preview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) { 
                document.getElementById('imgPreview').src = e.target.result; 
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</body>
</html>