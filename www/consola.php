<?php
session_start();
require_once 'includes/config.php';

// Seguridad: Si no hay sesión iniciada, expulsar al login
if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit;
}

// Obtener los dispositivos que Alberto tiene en su tabla
try {
    $stmt = $pdo->query("SELECT id_dispositivo, hostname, ip_gestion, tipo, estado FROM dispositivos WHERE estado != 'Retirado' ORDER BY hostname ASC");
    $dispositivos = $stmt->fetchAll();
} catch (PDOException $e) {
    $error_db = "No se pudieron cargar los dispositivos: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consola de Orquestación | ASIR Network</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css"> </head>
<body>

<div class="sidebar-top-brand">
    <img src="img/logo.png" alt="Logo" style="width: 140px; padding: 20px; display: block; margin: 0 auto;">
</div>

<form action="lanzar_configuracion.php" method="POST">
    <section class="content-card">
        <div class="card-header">
            <h2><i class="fa-solid fa-network-wired"></i> Orquestación de Nodos (Masiva)</h2>
            <div class="bulk-actions">
                <label>Acción sobre la red:</label>
                <select name="tarea_id" class="select-modern" required>
                    <option value="">-- Seleccionar Tarea de Automatización --</option>
                    <option value="1">Respaldo de Configuración (Backup)</option>
                    <option value="2">Actualización Global de Banner MotD</option>
                    <option value="3">Sincronización NTP (Hora Oficial)</option>
                    <option value="4">Hardening: Seguridad de SSH e Interfaces</option>
                </select>
                <button type="submit" class="btn-deploy" style="background-color: #004695; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px;">
                    <i class="fa-solid fa-play"></i> Desplegar en Selección
                </button>
            </div>
        </div>

        <?php if (isset($error_db)): ?>
            <div style="color: red; padding: 20px;"><?php echo $error_db; ?></div>
        <?php endif; ?>

        <table class="data-table" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #f4f4f4; text-align: left;">
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Hostname (ID Nodal)</th>
                    <th>Dirección IP Gestión</th>
                    <th>Tipo de Activo</th>
                    <th>Estado Operativo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dispositivos as $disp): ?>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td><input type="checkbox" name="nodos[]" value="<?php echo $disp['id_dispositivo']; ?>"></td>
                    <td><strong><?php echo htmlspecialchars($disp['hostname']); ?></strong></td>
                    <td><code><?php echo htmlspecialchars($disp['ip_gestion']); ?></code></td>
                    <td><span class="tag-blue" style="background: #e1efff; padding: 4px 8px; border-radius: 4px;"><?php echo $disp['tipo']; ?></span></td>
                    <td>
                        <?php if ($disp['estado'] == 'Activo'): ?>
                            <span class="status-pill ok" style="color: green;"><i class="fa-solid fa-check"></i> Activo</span>
                        <?php else: ?>
                            <span class="status-pill warning" style="color: orange;"><i class="fa-solid fa-clock"></i> <?php echo $disp['estado']; ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</form>

<script>
    // Script para seleccionar todos los checkboxes a la vez
    document.getElementById('select-all').onclick = function() {
        var checkboxes = document.getElementsByName('nodos[]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    }
</script>

</body>
</html>