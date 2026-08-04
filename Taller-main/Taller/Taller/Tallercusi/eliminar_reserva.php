<?php
// Conectar a la base de datos
include('conexion.php'); // Asegúrate de tener este archivo configurado con tu conexión

// Verificar si se ha enviado una solicitud de eliminación
if (isset($_GET['id'])) {
    $reserva_id = $_GET['id'];

    // Eliminar la reserva con el ID proporcionado
    $sql = "DELETE FROM Reservas WHERE reserva_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $reserva_id);

    if ($stmt->execute()) {
        echo "Reserva eliminada correctamente.";
    } else {
        echo "Error al eliminar la reserva: " . $conn->error;
    }
    $stmt->close();
}

// Obtener todas las reservas
$sql = "SELECT Reservas.reserva_id, Clientes.nombre AS cliente, Vehiculos.marca, Vehiculos.modelo, 
        Reservas.fecha_reserva, TiposServicio.nombre_servicio, Reservas.estado
        FROM Reservas
        INNER JOIN Vehiculos ON Reservas.vehiculo_id = Vehiculos.vehiculo_id
        INNER JOIN Clientes ON Vehiculos.cliente_id = Clientes.cliente_id
        INNER JOIN TiposServicio ON Reservas.servicio_id = TiposServicio.servicio_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Reservas</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <h2>Eliminar Reservas</h2>
    <table border="1">
        <tr>
            <th>Cliente</th>
            <th>Vehículo</th>
            <th>Fecha de Reserva</th>
            <th>Tipo de Servicio</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['cliente']; ?></td>
                <td><?php echo $row['marca'] . " " . $row['modelo']; ?></td>
                <td><?php echo $row['fecha_reserva']; ?></td>
                <td><?php echo $row['nombre_servicio']; ?></td>
                <td><?php echo $row['estado']; ?></td>
                <td>
                    <a href="eliminar_reserva.php?id=<?php echo $row['reserva_id']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta reserva?');">Eliminar</a>
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
