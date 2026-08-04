<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <section>
        <div class="form-cont">
            <h2>Iniciar Sesión</h2>
            <form action="login.php" method="post">
                <div class="input-box">
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" id="correo" name="correo" required>
                </div>
                <div class="input-box">
                    <label for="pass">Contraseña:</label>
                    <input type="password" id="pass" name="pass" required>
                </div>
                <button type="submit">Iniciar Sesión</button>
            </form>
            <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
        </div>
    </section>
</body>
</html>
