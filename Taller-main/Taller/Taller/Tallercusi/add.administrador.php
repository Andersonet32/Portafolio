<?php 
include 'db.php';

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$dni = $_POST["dni"];
$nombreUsuario = $_POST["nombre-usuario"];
$telefono = $_POST["tel"];
$correo = $_POST["correo"];
$pass = $_POST["pass"];

        $sql = $conn->query("INSERT INTO usuario (nombre, apellido, dni, nombre_usuario, telefono, correo_electronico, contraseña, id_cargo) 
                             VALUES ('$nombre', '$apellido', '$dni', '$nombreUsuario', '$telefono', '$correo', '$pass', 1)");

        if ($sql) {
            echo 'Usuario registrado correctamente ';
            header("location:pag_principal.php"); 
        } else {
            echo 'Error al registrar';
        }
    

?>
