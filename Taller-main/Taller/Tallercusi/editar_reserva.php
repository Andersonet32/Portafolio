<?php
include 'db.php';

if (isset($_POST['update'])) {
    $reserva_id = $_POST['reserva_id'];
    $fecha_reserva = $_POST['fecha_reserva'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $estado = $_POST['estado'];
    $observaciones = $_POST['observaciones'];

    $sql = "UPDATE Reservas SET fecha_reserva='$fecha_reserva', fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin', estado='$estado', observaciones='$observaciones' WHERE reserva_id='$reserva_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Reserva actualizada exitosamente";
    } else {
        echo "Error al actualizar la reserva: " . $conn->error;
    }
}

// muestra todas las reservass para modificar
$sql = "SELECT Reservas.reserva_id, Clientes.nombre AS cliente, Vehiculos.marca, Vehiculos.modelo 
        FROM Reservas
        INNER JOIN Vehiculos ON Reservas.vehiculo_id = Vehiculos.vehiculo_id
        INNER JOIN Clientes ON Vehiculos.cliente_id = Clientes.cliente_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Reserva</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Modificar Reserva</h2>
    <form method="post" action="editar_reserva.php">
        <label for="reserva_id">Seleccione una Reserva:</label>
        <select name="reserva_id" id="reserva_id" onchange="this.form.submit()">
            <option value="">-- Seleccione --</option>
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?php echo $row['reserva_id']; ?>">
                    <?php echo $row['cliente'] . " - " . $row['marca'] . " " . $row['modelo']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>
    <?php
    // muestra los datos de una reserva para editar
    if (isset($_POST['reserva_id'])) {
        $reserva_id = $_POST['reserva_id'];
        $sql = "SELECT * FROM Reservas WHERE reserva_id='$reserva_id'";
        $result = $conn->query($sql);
        $reserva = $result->fetch_assoc();
    ?>

    <form method="post" action="editar_reserva.php">
        <input type="hidden" name="reserva_id" value="<?php echo $reserva['reserva_id']; ?>">
        <label>Fecha de Reserva:</label>
        <input type="date" name="fecha_reserva" value="<?php echo $reserva['fecha_reserva']; ?>" required><br>
        <label>Fecha de Inicio:</label>
        <input type="date" name="fecha_inicio" value="<?php echo $reserva['fecha_inicio']; ?>"><br>
        <label>Fecha de Fin:</label>
        <input type="date" name="fecha_fin" value="<?php echo $reserva['fecha_fin']; ?>"><br>
        <label>Estado:</label>
        <select name="estado">
            <option value="Pendiente" <?php if($reserva['estado'] == 'Pendiente') echo 'selected'; ?>>Pendiente</option>
            <option value="En proceso" <?php if($reserva['estado'] == 'En proceso') echo 'selected'; ?>>En proceso</option>
            <option value="Completado" <?php if($reserva['estado'] == 'Completado') echo 'selected'; ?>>Completado</option>
        </select><br>
        <label>Observaciones:</label>
        <textarea name="observaciones"><?php echo $reserva['observaciones']; ?></textarea><br>
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