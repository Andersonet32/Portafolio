<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Stock y Reservas - Taller</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Control de Stock y Reservas de Reparación</h1>
        <p>Administración de reservas para reparación de autos y piezas en el taller</p>
    </header>

    <section class="table-section">
        <h2>Reservas Actuales</h2>
        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Vehículo</th>
                    <th>Fecha de Reserva</th>
                    <th>Tipo de Servicio</th>
                    <th>Estado</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT Clientes.nombre AS cliente, Vehiculos.marca, Vehiculos.modelo, 
                        Reservas.fecha_reserva, TiposServicio.nombre_servicio, Reservas.estado, Reservas.observaciones
                        FROM Reservas
                        INNER JOIN Vehiculos ON Reservas.vehiculo_id = Vehiculos.vehiculo_id
                        INNER JOIN Clientes ON Vehiculos.cliente_id = Clientes.cliente_id
                        INNER JOIN TiposServicio ON Reservas.servicio_id = TiposServicio.servicio_id";
                        
                    $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['cliente']}</td>
                                <td>{$row['marca']} {$row['modelo']}</td>
                                <td>{$row['fecha_reserva']}</td>
                                <td>{$row['nombre_servicio']}</td>
                                <td>{$row['estado']}</td>
                                <td>{$row['observaciones']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay reservas</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <section class="button-section">
            <button onclick="location.href='add_reserva.php'">Agregar Nueva Reserva</button>
        </section>

        <h2>Inventario de Piezas</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre de Pieza</th>
                    <th>Descripción</th>
                    <th>Cantidad Disponible</th>
                    <th>Precio Unitario</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $sql = "SELECT nombre_pieza, descripcion, cantidad, precio_unitario FROM Inventario";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['nombre_pieza']}</td>
                                <td>{$row['descripcion']}</td>
                                <td>{$row['cantidad']}</td>
                                <td>\${$row['precio_unitario']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay piezas en el inventario</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <section class="button-section">
            <button onclick="location.href='add_inventario.php'">Agregar Nueva Pieza al Inventario</button>
        </section>
    </section>

    <footer>
        <p>&copy; 2024 Taller de Confianza - Sistema de Control de Stock</p>
    </footer>
</body>
</html>
