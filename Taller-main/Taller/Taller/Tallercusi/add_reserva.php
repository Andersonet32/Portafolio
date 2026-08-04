<?php
include 'db.php';

$vehiculos = $conn->query("SELECT vehiculo_id, CONCAT(marca, ' ', modelo, ' - ') AS vehiculo FROM Vehiculos");
$servicios = $conn->query("SELECT servicio_id, nombre_servicio FROM TiposServicio");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehiculo_id = $_POST['vehiculo_id'];
    $servicio_id = $_POST['servicio_id'];
    $fecha_reserva = $_POST['fecha_reserva'];
    $observaciones = $_POST['observaciones'];

    $sql = "INSERT INTO Reservas (vehiculo_id, servicio_id, fecha_reserva, observaciones) VALUES ('$vehiculo_id', '$servicio_id', '$fecha_reserva', '$observaciones')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Reserva añadida correctamente</p>";
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
    <title>Agregar Reserva - Taller</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Agregar Nueva Reserva</h1>
    </header>

    <section class="form-section">
        <form action="add_reserva.php" method="POST">
            <label for="vehiculo_id">Vehículo:</label>
            <select name="vehiculo_id" id="vehiculo_id" required>
                <?php while ($row = $vehiculos->fetch_assoc()) { ?>
                    <option value="<?= $row['vehiculo_id'] ?>"><?= $row['vehiculo'] ?></option>
                <?php } ?>
            </select>

            <label for="servicio_id">Tipo de Servicio:</label>
            <select name="servicio_id" id="servicio_id" required>
                <?php while ($row = $servicios->fetch_assoc()) { ?>
                    <option value="<?= $row['servicio_id'] ?>"><?= $row['nombre_servicio'] ?></option>
                <?php } ?>
            </select>

            <label for="fecha_reserva">Fecha de Reserva:</label>
            <input type="date" name="fecha_reserva" id="fecha_reserva" required>

            <label for="observaciones">Observaciones:</label>
            <textarea name="observaciones" id="observaciones" rows="4"></textarea>

            <button type="submit">Agregar Reserva</button>
        </form>
    </section>
    <section class="button-section">
        <button onclick="location.href='pag_principal.php'">Inicio</button>
    </section>
    <footer>
        <p>&copy; 2024 Taller de Confianza - Sistema de Reservas</p>
    </footer>
</body>
</html>
