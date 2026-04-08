<div class="sidebar-top-brand">
    <img src="img/logo.png" alt="NetworkAdministrator Logo" style="width: 140px; padding: 20px; display: block; margin: 0 auto;">
</div>

<form action="lanzar_configuracion.php" method="POST">
    <section class="content-card">
        <div class="card-header">
            <h2><i class="fa-solid fa-network-wired"></i> Orquestación de Nodos</h2>
            <div class="bulk-actions">
                <label>Acción sobre la red:</label>
                <select name="tarea_id" class="select-modern" required>
                    <option value="">-- Seleccionar Tarea de Automatización --</option>
                    <option value="1">Respaldo de Configuración (Backup)</option>
                    <option value="2">Actualización Global de Banner MotD</option>
                    <option value="3">Auditoría de Protocolos NTP/SNMP</option>
                    <option value="4">Hardening: Cierre de puertos vulnerables</option>
                </select>
                <button type="submit" class="btn-deploy" style="background-color: #004695;">
                    <i class="fa-solid fa-play"></i> Desplegar en Selección
                </button>
            </div>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Hostname (ID Nodal)</th>
                    <th>Dirección IP Gestión</th>
                    <th>Tipo de Activo</th>
                    <th>Estado Operativo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dispositivos as $disp): ?>
                <tr>
                    <td><input type="checkbox" name="nodos[]" value="<?php echo $disp['id_dispositivo']; ?>"></td>
                    <td><strong><?php echo $disp['hostname']; ?></strong></td>
                    <td><code><?php echo $disp['ip_gestion']; ?></code></td>
                    <td><span class="tag-blue"><?php echo $disp['tipo']; ?></span></td>
                    <td><span class="status-pill ok"><i class="fa-solid fa-check"></i> Activo</span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</form>