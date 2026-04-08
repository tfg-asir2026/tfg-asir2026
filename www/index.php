<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NetManager v1.0 | Acceso Técnico</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="page-split-container">
    <div class="image-side">
        <div class="overlay-text">
            </div>
    </div>

    <div class="form-side">
        <div class="form-wrapper">
            <img src="img/logo.png" alt="NetManager" class="main-logo">
            
            <h2>Acceso Técnico</h2>
            <p class="subtitle">Ingrese sus credenciales para gestionar la red.</p>

            <form action="procesar_login.php" method="POST">
                <div class="input-entry">
                    <label for="usuario">ID de Operador</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Usuario técnico" required>
                </div>

                <div class="input-entry">
                    <label for="password">Clave de Acceso</label>
                    <input type="password" name="password" id="password" placeholder="********" required>
                </div>

                <button type="submit" class="btn-login">Iniciar Sesión</button>
            </form>

            <?php if(isset($_GET['error'])): ?>
                <div class="error-msg">
                    <strong>Acceso denegado:</strong> Credenciales no válidas o cuenta inactiva.
                </div>
            <?php endif; ?>

            <div class="form-footer">
                &copy; 2026 NetManager v1.0 - Seguridad Operativa
            </div>
        </div>
    </div>
</div>

</body>
</html>