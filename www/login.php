<?php
require_once 'includes/config.php'; // Aquí invocamos tu archivo de conexión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['usuario'] ?? '';
    $pass = $_POST['password'] ?? '';

    if (empty($user) || empty($pass)) {
        header("Location: index.php?error=1");
        exit;
    }

    try {
        // Consulta preparada para evitar Inyección SQL (aprovechando tu PDO)
        $stmt = $pdo->prepare("SELECT password_hash FROM usuarios WHERE username = ?");
        $stmt->execute([$user]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($pass, $usuario['password_hash'])) {
            // ÉXITO: Iniciar sesión
            session_start();
            $_SESSION['user'] = $user;
            header("Location: dashboard.php"); // Cambia esto a tu página de destino
        } else {
            // FALLO
            header("Location: index.php?error=1");
        }
    } catch (Exception $e) {
        error_log("Error en login: " . $e->getMessage());
        die("Error interno del servidor.");
    }
}