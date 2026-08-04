CREATE DATABASE TallerReparaciones;
USE TallerReparaciones;


CREATE TABLE Clientes (
    cliente_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    telefono VARCHAR(15),
    email VARCHAR(100),
    direccion VARCHAR(255)
);

CREATE TABLE Vehiculos (
    vehiculo_id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    año INT,
    FOREIGN KEY (cliente_id) REFERENCES Clientes(cliente_id) ON DELETE CASCADE
);


CREATE TABLE TiposServicio (
    servicio_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_servicio VARCHAR(50) NOT NULL,
    descripcion TEXT
);


CREATE TABLE Reservas (
    reserva_id INT AUTO_INCREMENT PRIMARY KEY,
    vehiculo_id INT,
    servicio_id INT,
    fecha_reserva DATE NOT NULL,
    fecha_inicio DATE,
    fecha_fin DATE,
    estado ENUM('Pendiente', 'En proceso', 'Completado') DEFAULT 'Pendiente',
    observaciones TEXT,
    FOREIGN KEY (vehiculo_id) REFERENCES Vehiculos(vehiculo_id) ON DELETE CASCADE,
    FOREIGN KEY (servicio_id) REFERENCES TiposServicio(servicio_id)
);


CREATE TABLE Inventario (
    inventario_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_pieza VARCHAR(100) NOT NULL,
    descripcion TEXT,
    cantidad INT DEFAULT 0,
    precio_unitario DECIMAL(10, 2)
);


CREATE TABLE UsoPiezas (
    uso_id INT AUTO_INCREMENT PRIMARY KEY,
    reserva_id INT,
    inventario_id INT,
    cantidad_usada INT NOT NULL,
    FOREIGN KEY (reserva_id) REFERENCES Reservas(reserva_id) ON DELETE CASCADE,
    FOREIGN KEY (inventario_id) REFERENCES Inventario(inventario_id)
);
