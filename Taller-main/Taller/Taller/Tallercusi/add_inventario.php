<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_pieza = $_POST['nombre_pieza'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];

    $sql = "INSERT INTO Inventario (nombre_pieza, descripcion, cantidad, precio_unitario) VALUES ('$nombre_pieza', '$descripcion', '$cantidad', '$precio_unitario')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Pieza añadida al inventario correctamente</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Piezas al Inventario - Taller</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Agregar Nueva Pieza al Inventario</h1>
    </header>

    <section class="form-section">
        <form action="add_inventario.php" method="POST">
            <label for="nombre_pieza">Nombre de la Pieza:</label>
            <input type="text" name="nombre_pieza" id="nombre_pieza" required>

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="4"></textarea>

            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" required>

            <label for="precio_unitario">Precio Unitario:</label>
            <input type="number" name="precio_unitario" id="precio_unitario" step="0.01" required>

            <button type="submit">Agregar Pieza</button>
        </form>
    </section>
    <section class="button-section">
        <button onclick="location.href='pag_principal.php'">Inicio</button>
    </section>
    <footer>
        <p>&copy; 2024 Taller de Confianza - Sistema de Inventario</p>
    </footer>
</body>
</html>
