<?php
session_start();
require_once 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id_usuario'])) {
    
    $tarea_id = $_POST['tarea_id'] ?? null;
    $nodos_seleccionados = $_POST['nodos'] ?? []; 
    $id_usuario = $_SESSION['id_usuario'];
    $nombre_usuario_sesion = $_SESSION['usuario']; 
    $ip_origen_pc = $_SERVER['REMOTE_ADDR']; 

    if (!$tarea_id || empty($nodos_seleccionados)) {
        header("Location: consola.php?status=error_seleccion");
        exit;
    }

    try {
        $pdo->beginTransaction();

        // Query adaptada a la tabla de Alberto (columnas: evento, snapshots, etc)
        $sqlLog = "INSERT INTO registro_logs 
                   (id_usuario, id_dispositivo, usuario_nombre_snapshot, ip_dispositivo_snapshot, evento, resultado, detalles_tecnicos, ip_origen_acceso) 
                   VALUES (?, ?, ?, ?, ?, 'Procesando', 'Tarea enviada a la cola del orquestador', ?)";
        
        $stmtLog = $pdo->prepare($sqlLog);

        // Mapa de tareas para el log
        $nombres_tareas = [
            1 => "Backup de Configuración",
            2 => "Actualización Banner MotD",
            3 => "Auditoría NTP/SNMP",
            4 => "Hardening SSH"
        ];
        $nombre_evento = $nombres_tareas[$tarea_id] ?? "Acción Masiva";

        foreach ($nodos_seleccionados as $id_dispositivo) {
            // Buscamos la IP del dispositivo en ese instante para el Snapshot
            $stmtIP = $pdo->prepare("SELECT ip_gestion FROM dispositivos WHERE id_dispositivo = ?");
            $stmtIP->execute([$id_dispositivo]);
            $ip_del_router = $stmtIP->fetchColumn();

            // Insertamos la auditoría obligatoria por Óscar
            $stmtLog->execute([
                $id_usuario, 
                $id_dispositivo, 
                $nombre_usuario_sesion, 
                $ip_del_router, 
                $nombre_evento, 
                $ip_origen_pc
            ]);
        }

        $pdo->commit();

        // 2. LLAMADA AL SCRIPT DE ALEJANDRO
        // Enviamos tarea, lista de IDs y el ID de usuario para que Alejandro actualice el log al final
        $ids_string = implode(',', $nodos_seleccionados);
        exec("python3 /home/alejandro/scripts/orquestador.py $tarea_id $ids_string $id_usuario > /dev/null 2>&1 &");

        header("Location: consola.php?status=proceso_lanzado");

    } catch (Exception $e) {
        $pdo->rollBack();
        die("ERROR DE AUDITORÍA: El sistema no pudo registrar la acción. Operación cancelada por seguridad.");
    }
} else {
    header("Location: consola.php");
}