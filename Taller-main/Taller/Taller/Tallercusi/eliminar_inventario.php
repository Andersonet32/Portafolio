<?php

include('db.php');

if (isset($_GET['id'])) {
    $inventario_id = $_GET['id'];

    // Eliminar la pieza con el ID proporcionado
    $sql = "DELETE FROM Inventario WHERE inventario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $inventario_id);

    if ($stmt->execute()) {
        echo "Pieza eliminada correctamente.";
    } else {
        echo "Error al eliminar la pieza: " . $conn->error;
    }
    $stmt->close();
}

// Obtener todas las piezas del inventario
$sql = "SELECT inventario_id, nombre_pieza, descripcion, cantidad, precio_unitario FROM Inventario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Inventario</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <h2>Eliminar Piezas del Inventario</h2>
    <table border="1">
        <tr>
            <th>Nombre de la Pieza</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['nombre_pieza']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <td><?php echo $row['cantidad']; ?></td>
                <td><?php echo $row['precio_unitario']; ?></td>
                <td>
                    <a href="eliminar_inventario.php?id=<?php echo $row['inventario_id']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta pieza?');">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <section class="button-section">
        <button onclick="location.href='pag_principal.php'">Inicio</button>
    </section>
</body>
</html>
<?php
// Cerrar la conexión
$conn->close();
?>
