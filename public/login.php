<?php
session_start();
require_once 'includes/config.php';

// Si ya está logueado, mandarlo directamente a la consola
if (isset($_SESSION['id_usuario'])) {
    header("Location: consola.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_input = $_POST['usuario'] ?? '';
    $pass_input = $_POST['password'] ?? '';

    if (!empty($user_input) && !empty($pass_input)) {
        try {
            // 1. Buscamos al usuario en la BBDD de Alberto
            $stmt = $pdo->prepare("SELECT id_usuario, usuario, password_hash, rol, estado FROM usuarios_web WHERE usuario = ? LIMIT 1");
            $stmt->execute([$user_input]);
            $user = $stmt->fetch();

            // 2. Verificación de seguridad
            if ($user) {
                // Comprobamos si el usuario está activo (Gestión de Identidades)
                if ($user['estado'] !== 'Activo') {
                    $error = "Su cuenta está " . $user['estado'] . ". Contacte con el administrador.";
                } 
                // VERIFICACIÓN DEL HASH (Aquí ocurre la magia de seguridad)
                elseif (password_verify($pass_input, $user['password_hash'])) {
                    
                    // 3. Login exitoso: Creamos la sesión
                    $_SESSION['id_usuario'] = $user['id_usuario'];
                    $_SESSION['usuario']    = $user['usuario'];
                    $_SESSION['rol']        = $user['rol'];

                    // Opcional: Registrar el acceso exitoso en los logs
                    $stmtLog = $pdo->prepare("INSERT INTO registro_logs (id_usuario, usuario_nombre_snapshot, evento, resultado, detalles_tecnicos, ip_origen_acceso) VALUES (?, ?, 'Login', 'Exitoso', 'Acceso al panel de control', ?)");
                    $stmtLog->execute([$user['id_usuario'], $user['usuario'], $_SERVER['REMOTE_ADDR']]);

                    header("Location: consola.php");
                    exit;
                } else {
                    $error = "Contraseña incorrecta.";
                }
            } else {
                $error = "El usuario no existe.";
            }
        } catch (PDOException $e) {
            $error = "Error de conexión con el servidor de autenticación.";
        }
    } else {
        $error = "Por favor, rellene todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | NetManager Pro</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Estilo rápido para el login si Asier no te lo ha pasado aún */
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f0f2f5; }
        .login-card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 350px; }
        .error-msg { color: #d93025; background: #f8d7da; padding: 10px; border-radius: 4px; margin-bottom: 1rem; font-size: 14px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #004695; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>

<div class="login-card">
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="img/logo.png" alt="NetManager" style="width: 120px;">
        <h3>Acceso Técnico</h3>
    </div>

    <?php if ($error): ?>
        <div class="error-msg"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Usuario</label>
        <input type="text" name="usuario" required autofocus>
        
        <label>Contraseña</label>
        <input type="password" name="password" required>
        
        <button type="submit">Entrar al Sistema</button>
    </form>
</div>

</body>
</html>