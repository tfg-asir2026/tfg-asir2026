<?php
require_once 'includes/config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['usuario'] ?? '';
    $pass = $_POST['password'] ?? '';

    if (empty($user) || empty($pass)) {
        header("Location: index.php?error=1");
        exit;
    }

    try {
        // CORRECCIÓN: Tabla 'usuarios_web', columna 'usuario' y verificamos que esté 'Activo'
        $stmt = $pdo->prepare("SELECT id_usuario, password_hash, rol FROM usuarios_web WHERE usuario = ? AND estado = 'Activo'");
        $stmt->execute([$user]);
        $datos_usuario = $stmt->fetch();

        if ($datos_usuario && password_verify($pass, $datos_usuario['password_hash'])) {
            session_start();
            $_SESSION['id_usuario'] = $datos_usuario['id_usuario'];
            $_SESSION['user'] = $user;
            $_SESSION['rol'] = $datos_usuario['rol'];
            
            header("Location: dashboard.php"); 
            exit;
        } else {
            header("Location: index.php?error=1");
            exit;
        }
    } catch (Exception $e) {
        error_log("Error en login: " . $e->getMessage());
        die("Error interno del servidor. Consulte con el administrador.");
    }
}