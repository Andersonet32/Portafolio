<?php
include 'db.php';

if (isset($_POST['update'])) {
    $inventario_id = $_POST['inventario_id'];
    $nombre_pieza = $_POST['nombre_pieza'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];

    $sql = "UPDATE Inventario SET nombre_pieza='$nombre_pieza', descripcion='$descripcion', cantidad='$cantidad', precio_unitario='$precio_unitario' WHERE inventario_id='$inventario_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Inventario actualizado exitosamente";
    } else {
        echo "Error al actualizar el inventario: " . $conn->error;
    }
}

// todos los elementos de la tabla
$sql = "SELECT * FROM Inventario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Inventario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Modificar Inventario</h2>
    <form method="post" action="editar_inventario.php">
        <label for="inventario_id">Seleccione una Pieza:</label>
        <select name="inventario_id" id="inventario_id" onchange="this.form.submit()">
            <option value="">-- Seleccione --</option>
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?php echo $row['inventario_id']; ?>">
                    <?php echo $row['nombre_pieza']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>
    
    <?php
    //seleciona un elemento de la tabla para modificar
    if (isset($_POST['inventario_id'])) {
        $inventario_id = $_POST['inventario_id'];
        $sql = "SELECT * FROM Inventario WHERE inventario_id='$inventario_id'";
        $result = $conn->query($sql);
        $pieza = $result->fetch_assoc();
    ?>

    <form method="post" action="editar_inventario.php">
        <input type="hidden" name="inventario_id" value="<?php echo $pieza['inventario_id']; ?>">
        <label>Nombre de la Pieza:</label>
        <input type="text" name="nombre_pieza" value="<?php echo $pieza['nombre_pieza']; ?>" required><br>
        <label>Descripción:</label>
        <textarea name="descripcion"><?php echo $pieza['descripcion']; ?></textarea><br>
        <label>Cantidad:</label>
        <input type="number" name="cantidad" value="<?php echo $pieza['cantidad']; ?>" required><br>
        <label>Precio Unitario:</label>
        <input type="text" name="precio_unitario" value="<?php echo $pieza['precio_unitario']; ?>" required><br>
        <button type="submit" name="update">Actualizar</button>
    </form>
    
    <?php
    } 
    ?>
    <section class="button-section">
        <button onclick="location.href='index.php'">Inicio</button>
    </section>
</body>
</html>
