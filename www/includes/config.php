<?php
/**
 * TFG ASIR 2026 - MÓDULO DE SEGURIDAD Y CONEXIÓN
 * Responsable: Pamela Alcarras
 * * Este archivo gestiona la conexión a la BBDD de Alberto de forma ciega.
 * NO contiene contraseñas. Solo lee del entorno (.env).
 */

// 1. FUNCIÓN DE CARGA DE ENTORNO DESDE .env
function loadEnv($path) {
    if (!file_exists($path)) {
        // Si no hay .env, el sistema es inseguro y debe detenerse
        die("FATAL ERROR: Archivo de configuración .env no encontrado en la raíz.");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignorar comentarios
        if (strpos(trim($line), '#') === 0) continue;

        // Validar formato NOMBRE=VALOR
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            
            // Definir en el sistema y en el array global $_ENV
            putenv("{$name}={$value}");
            $_ENV[$name] = $value;
        }
    }
}

// 2. EJECUCIÓN: Localizamos el .env un nivel arriba de /www
loadEnv(__DIR__ . '/../.env');

// 3. EXTRACCIÓN DE DATOS (SIN VALORES POR DEFECTO SENSIBLES)
// Si getenv() devuelve false, usamos un string vacío para forzar el error de PDO
define('DB_HOST', getenv('DB_HOST') ?: '');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: '');
define('DB_USER', getenv('DB_USER') ?: '');
define('DB_PASS', getenv('DB_PASS') ?: '');

// 4. CONEXIÓN SEGURA MEDIANTE PDO
try {
    // DSN (Data Source Name)
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    
    // Opciones de seguridad para la conexión
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Errores como excepciones
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Resultados como arrays asociativos
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Seguridad real contra Inyección SQL
    ];

    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

} catch (\PDOException $e) {
    /**
     * Nunca mostramos $e->getMessage() al usuario, porque revelaría la IP
     * o el usuario de Alberto. Solo registramos en el log interno.
     */
    error_log("FALLO DE CONEXIÓN BBDD: " . $e->getMessage());
    die("ERROR: El sistema de registro no está disponible en este momento. (SEC-ERR-01)");
}