<?php

require_once "../includes/db.php";

$admins = [
    "admin1",
    "admin2",
    "admin3"
];

foreach ($admins as $admin) {

    $password = password_hash("1234", PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (username, password, is_admin)
            VALUES (?, ?, 1)";

    $stmt = $conexion->prepare($sql);

    $stmt->bind_param("ss", $admin, $password);

    $stmt->execute();
}

echo "Administradores creados correctamente";

?>