
# 🌐 Módulo Web: Gestión de Acceso Seguro (TFG ASIR 2026)

Este directorio contiene la interfaz de usuario y el motor de autenticación del sistema. Se ha implementado una arquitectura de **Separación de Responsabilidades** en tres capas para garantizar la seguridad y la limpieza del código.

## 🏗️ Arquitectura de 3 Capas

Para maximizar la seguridad, el sistema se divide de la siguiente forma:

1. **La Cara (`index.php`) - Frontend**
   - **Responsable:** Asier Miguel.
   - **Función:** Interfaz visual y formulario de captura. No procesa datos ni conoce la base de datos.
   - **Flujo:** Envía las credenciales al "Músculo" via POST.

2. **El Músculo (`login.php`) - Middleware**
   - **Responsable:** Pamela Alcarras.
   - **Función:** Procesa la lógica de negocio. Valida credenciales contra el "Cerebro", gestiona sesiones seguras y redirige al usuario.
   - **Seguridad:** Uso de `password_verify()` y `session_regenerate_id()`.

3. **El Cerebro (`config.php`) - Backend/Seguridad**
   - **Responsable:** Pamela Alcarras.
   - **Función:** Único punto de conexión PDO. Carga las credenciales de forma "ciega" desde el entorno (`.env`).
   - **Aislamiento:** Mantiene las claves de Alberto fuera del alcance del frontend.

## 🛠️ Requisitos de Despliegue

Para que el sistema funcione en local:

1. **Archivo de Entorno**: Crear un archivo `.env` en la raíz (un nivel arriba de `/www`) con las variables `DB_HOST`, `DB_NAME`, `DB_USER` y `DB_PASS`.
2. **Base de Datos**: Importar `estructura_bbdd.sql`. La tabla utilizada es `usuarios_web`.
3. **Versión PHP**: Requiere soporte para PDO y PHP 8.0+.

## 🔐 Notas Técnicas
- El acceso está restringido a usuarios con el campo `estado = 'Activo'`.
- Las contraseñas se validan contra el campo `password_hash` de la tabla `usuarios_web`.

---
**Proyecto TFG ASIR 2026**