<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cisco Login - Estilo Personalizado</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="page-split-container">
        <div class="image-side"> </div>
        <div class="form-side">
            <div class="form-wrapper">
                <img src="img/logo.jpg" alt="Logo">
                
                <form action="login.php" method="POST">
                    <h2>Bienvenido</h2>

                    <div class="nombre">        
                        <label for="nombre">Usuario:</label>
                        <input type="text" name="usuario" id="nombre" required>
                    </div>

                    <div class="contraseña"> 
                        <label for="contraseña">Contraseña:</label>
                        <input type="password" name="password" id="contraseña" required>
                    </div>

                    <div class="Recordar">
                        <label>
                            <input type="checkbox" name="remember"> Recordar Contraseña
                        </label>
                    </div>

                    <input type="submit" value="Enviar" class="btn-login"/>
                </form>

                <?php if(isset($_GET['error'])): ?>
                    <p style="color: red; margin-top: 10px;">Credenciales incorrectas.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>