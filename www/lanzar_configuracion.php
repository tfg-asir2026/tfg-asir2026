<?php
session_start();
require_once 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id_usuario'])) {
    
    $tarea_id = $_POST['tarea_id'] ?? null;
    $nodos_seleccionados = $_POST['nodos'] ?? []; // Array con los IDs de los 100 routers
    $id_tecnico = $_SESSION['id_usuario'];

    if (!$tarea_id || empty($nodos_seleccionados)) {
        header("Location: consola.php?error=seleccion_vacia");
        exit;
    }

    try {
        $pdo->beginTransaction();

        // 1. Preparamos la inserción masiva en los logs
        $sqlLog = "INSERT INTO registro_logs (id_usuario, id_dispositivo, accion_realizada, resultado, detalles_tecnicos) 
                   VALUES (?, ?, ?, 'PROCESANDO', 'Orden enviada al orquestador Python...')";
        $stmtLog = $pdo->prepare($sqlLog);

        // Mapeo simple de nombres de tareas (Esto lo podrías tener en otra tabla)
        $tareas = [
            1 => "Backup de Configuración",
            2 => "Actualización Banner MotD",
            3 => "Sincronización NTP",
            4 => "Hardening de Interfaces"
        ];
        $nombre_tarea = $tareas[$tarea_id] ?? "Tarea Desconocida";

        foreach ($nodos_seleccionados as $id_dispositivo) {
            $stmtLog->execute([$id_tecnico, $id_dispositivo, $nombre_tarea]);
        }

        $pdo->commit();

        // 2. LLAMADA AL ORQUESTADOR (La parte de Alejandro)
        // Pasamos los IDs como argumento al script de Python
        $ids_string = implode(',', $nodos_seleccionados);
        
        // Ejecución en segundo plano para no bloquear la web
        // 'python3 orquestador.php [tarea] [ids_dispositivos]'
        exec("python3 /home/alejandro/scripts/orquestador.py $tarea_id $ids_string > /dev/null 2>&1 &");

        // 3. Redirigimos a una página de "Éxito" o de "Logs"
        header("Location: consola.php?status=lanzado");
        exit;

    } catch (Exception $e) {
        $pdo->rollBack();
        error_log("Error al lanzar configuración masiva: " . $e->getMessage());
        header("Location: consola.php?error=db");
    }
}