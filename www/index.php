<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NetworkAdministrator v1.0 | Acceso Seguro</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <main class="page-split-container">
        <div class="image-side">
            <div class="overlay-text">
                <h1>NetworkAdministrator v1.0</h1>
                <p>Infraestructura LAN/WAN, Servidores y Seguridad Operativa</p>
            </div>
        </div>

        <div class="form-side">
            <div class="form-wrapper">
                <div class="brand-container">
                    <img src="img/logo.png" alt="NetworkAdministrator Logo" class="main-logo">
                </div>
                
                <form action="login.php" method="POST">
                    <h2>Panel de Control</h2>
                    <p class="subtitle">Identifíquese para gestionar la infraestructura crítica.</p>

                    <div class="input-entry">        
                        <label for="usuario"><i class="fa-solid fa-user-shield"></i> ID de Operador</label>
                        <input type="text" name="usuario" id="usuario" placeholder="Usuario técnico" required>
                    </div>

                    <div class="input-entry"> 
                        <label for="password"><i class="fa-solid fa-key"></i> Clave de Acceso</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" required>
                    </div>

                    <div class="Recordar">
                        <label class="checkbox-container">
                            <input type="checkbox" name="remember_user"> 
                            <span class="checkmark"></span> Mantener sesión activa
                        </label>
                    </div>

                    <button type="submit" class="btn-login">INICIAR SESIÓN TÉCNICA</button>
                </form>

                <?php if(isset($_GET['error'])): ?>
                    <div class="error-msg">
                        <i class="fa-solid fa-triangle-exclamation"></i> 
                        <strong>Error de Acceso:</strong> Credenciales no válidas en el directorio de red.
                    </div>
                <?php endif; ?>
                
                <footer class="form-footer">
                    <p>&copy; 2026 <strong>NetworkAdministrator v1.0</strong></p>
                    <p style="font-size: 10px; margin-top: 5px; opacity: 0.8;">
                        <i class="fa-solid fa-shield-halved"></i> Seguridad bajo estándar ISO 27001 - Acceso Auditado
                    </p>
                </footer>
            </div>
        </div>
    </main>
</body>
</html>