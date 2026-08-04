<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Usuario</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <section>
        <div class="form-cont">
            <h2>Registrarse</h2>
            <form action="add.administrador.php" method="post">
                <div class="input-box">
                    <label for="nombre"> Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="input-box">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" required>
                </div>
                <div class="input-box">
                    <label for="name-user">Nombre de Usuario::</label>
                    <input type="text" id="name-user" name="nombre-usuario" required>
                </div>
                <div class="input-box">
                    <label for="tel">Telefono:</label>
                    <input type="number" id="tel" name="tel" required>
                </div>
                <div class="input-box">
                    <label for="dni">DNI:</label>
                    <input type="number" id="dni" name="dni" required>
                </div>
                <div class="input-box">
                    <label for="correo">Correo Electrónico::</label>
                    <input type="email" id="correo" name="correo" required>
                </div>
                <div class="input-box">
                    <label for="pass">Contraseña:</label>
                    <input type="password" id="pass" name="pass" required>
                </div>
                <button type="submit"> Registrarse</button>
                <p>¿Ya tienes cuenta? <a href="index.php">Regístrate aquí</a></p>
            </form>
        </div>
    </section>
</body>
</html>
