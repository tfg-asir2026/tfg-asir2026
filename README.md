# 🌐 Gestor Web para la Configuración Automatizada de Routers
## 🛡️ PROYECTO: PLAN 0 INCIDENCIAS (ASIR 2026)

### 📄 Descripción del Proyecto
Este sistema nace para eliminar el error humano en la administración de redes de Capa 3. A través de una interfaz web segura, permitimos realizar configuraciones precisas en entornos virtualizados (GNS3) sin intervención manual directa en la CLI de los routers.

### 🎯 Objetivos Principales
* **Automatización Real:** Configurar nodos de red de forma centralizada mediante scripts de Python y PHP.
* **Seguridad:** Acceso restringido vía VPN y credenciales específicas para garantizar la integridad del sistema.
* **Trazabilidad:** Registro exhaustivo (Logs) de todos los cambios realizados, incluyendo usuario y fecha, almacenados en una base de datos.
* **Laboratorio Virtualizado:** Simulación robusta de infraestructuras de red mediante GNS3 para pruebas pre-producción.
---

### 📂 Organización del Repositorio
* **`/www`**: Interfaz de usuario y lógica de gestión web (PHP).
* **`/scripts`**: Motores de automatización y comandos de configuración (Python/Netmiko).
* **`/db`**: Estructura de la base de datos para la persistencia de logs y usuarios.
* **`/docs`**: Documentación técnica, anteproyecto y manuales de topología GNS3.


### ⚠️ SEGURIDAD CRÍTICA - LEER ANTES DE SUBIR

> **REGLA DE ORO:** Está terminantemente prohibido subir archivos que contengan contraseñas reales, IPs públicas o credenciales de acceso (SSH/Database).
> 
> * **No subir:** Archivos de configuración con claves reales.
> * **Alternativa:** Subir un archivo de ejemplo llamado `config.php.example` con los campos vacíos para que cada uno lo rellene en su PC local.

---

### 👥 Equipo de Trabajo
| Miembro | Rol Principal |
| :--- | :--- |
| **Pamela Alcarras** | Middleware, Integración de Sistemas y Seguridad |
| **Asier Miguel** | Frontend y Diseño de Interfaz |
| **Alberto José Delgado** | Backend y Administración de Base de Datos |
| **Jorge Alejandro Loayza** | Infraestructura de Red (GNS3) y Pruebas |

---
**Centro:** IES Cañaveral (Móstoles) | **Tutor:** Óscar López Fernández
