# Guía de Inicio: Configuración de Entorno y Git (TFG-ASIR)

---

## 1. Preparación del "Motor" de Versiones
Antes de tocar una sola línea de código, el sistema necesita el motor de Git instalado.
1. **Descarga:** Ve a git-scm.com e instala la versión para Windows.
2. **Instalación:** Dale a "Next" en todo. Es vital dejar las opciones por defecto para evitar conflictos de rutas.
3. **Reinicio:** Cierra Visual Studio Code por completo y vuélvelo a abrir. Si no lo haces, VS Code estará "sordo" a la instalación de Git.

## 2. Clonación del Repositorio (Entorno Limpio)
Regla de oro: No trabajes en OneDrive o Escritorio. Crea una ruta raíz para evitar errores de permisos.
1. Abre la terminal de VS Code (`Terminal` -> `New Terminal`).
2. Muévete a la raíz del disco: `cd C:\`
3. Crea y entra en tu carpeta de trabajo:
`mkdir proyectos` y luego `cd proyectos`.
4. Clona el proyecto:
`git clone https://github.com/tfg-asir2026/TFG-ASIR2026.git`

**Autenticación**: Si se abre el navegador, dale a "Authorize Git Ecosystem". Si no, asegúrate de estar logueado en tu cuenta de GitHub.

## 3.  Verificación de Conexión
Para saber si Git está "vigilando" tu carpeta, escribe:
`git status`


**Error: Si dice Not a git repository, asegúrate de haber entrado en la carpeta con cd TFG-ASIR2026.**

## 4. Creación de Entorno de Trabajo Seguro (Branching)
**Nunca trabajes directamente sobre main**. Vamos a crear tu rama personal.
En la terminal escribe:
`git checkout -b dev-nombre`  (Ejemplo: dev-pamela)

Confirma que el nombre de la rama ha cambiado en la esquina inferior izquierda de VS Code.

## 5. Configuración de Identidad (Solo la primera vez)
Si al intentar subir cambios te sale el error "Make sure you configure your user.name", es porque Git no sabe quién eres.

**Solución:** Ejecuta estos dos comandos en la terminal con tus datos reales:
En la Terminal de VS Code (la parte de abajo). Copia y pega estos dos comandos, uno por uno, cambiando mis datos por los tuyos:
Dile tu nombre: 
`git config --global user.name "Tu_nombre"`
Dile tu email (el que usas en GitHub): 
`git config --global user.email "tu_email@ejemplo.com"`

## 6. Flujo de Trabajo: Guardar y Subir Cambios (Commit & Push)
Cuando termines una tarea, sigue este orden:
Stage: En el panel de "Source Control" (icono de los tres círculos), dale al símbolo + al lado de tus archivos.
**Commit:** Escribe un mensaje descriptivo (ej: "Añadida configuración de seguridad") y dale al botón azul de Commit.
Push: Dale al botón "Sync Changes" o "Publish Branch" para subirlo a la nube.

## 7. Autorización y Sincronización (El último paso)
Una vez que le des al botón de "Publish Branch", VS Code necesita conectarse oficialmente a tu cuenta de GitHub.
Conexión al Navegador: Aparecerá una ventana de "Connect to GitHub". Dale a "Sign in with your browser".

**Autorización:** En el navegador, pulsa el botón verde "Authorize git-ecosystem".


Verificación de Seguridad (2FA): Si tienes activada la seguridad en GitHub, te pedirá confirmación por móvil o email. Hazlo inmediatamente para que VS Code reciba el permiso.


Aceptar en VS Code: Si el navegador te pregunta si quieres abrir Visual Studio Code, dale a "Abrir enlace".

## 8. Automatización de Cambios (Git Fetch)
Es probable que te salga un aviso preguntando: "Would you like Visual Studio Code to periodically run git fetch?".
**Respuesta:** Dale a YES.
Por qué: Esto hará que VS Code mire automáticamente si Alberto o Asier han subido algo nuevo, ahorrándote fallos de sincronización en el futuro.

## 9. Comprobación Final de éxito
Tu trabajo no está terminado hasta que no veas la confirmación en la web de GitHub.
Entra en el enlace del repositorio.
Si ves un cartel amarillo que dice: "dev-tu_nombre had recent pushes X minutes ago", ¡enhorabuena! Has subido los cambios correctamente.
Si no ves el cartel, haz clic en el botón de ramas (que suele poner main) y selecciona tu rama (ej. dev-pamela). Si tus archivos están ahí, la nube ya los tiene.

