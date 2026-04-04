#🌐 Guía de Inicio: Configuración de Entorno y Git (TFG-ASIR)

## 1. Instalación y Configuración de Identidad (Paso Único)
Antes de tocar el código, Git tiene que saber quién eres. Si no haces esto, te dará error al intentar subir cambios al final.

**Descarga:** Instala Git desde git-scm.com. Dale a "Next" a todo.

**Configura tu firma**: Abre la terminal de VS Code y escribe estos dos comandos con tus datos reales:

```Bash
git config --global user.name "Tu Nombre Real"
git config --global user.email "tu-email@ejemplo.com"
```
**Reinicio:** Cierra y abre VS Code para que reconozca la instalación.

## 2. Clonación y Preparación del Entorno
Ruta de trabajo: No uses OneDrive. En la terminal de VS Code:

```Bash
cd C:\
mkdir proyectos
cd proyectos
git clone https://github.com/tfg-asir2026/TFG-ASIR2026.git
cd TFG-ASIR2026 
```
**Sincronización inicial:** Asegúrate de tener lo último de la nube antes de empezar:

```Bash
git checkout main
git pull origin main
```
Si se abre el navegador, dale a "Authorize Git Ecosystem".

## 3. Protocolo de Trabajo Diario (Ramas)

**REGLA DE ORO:** Nunca trabajes en main. Para cada tarea, crea una rama nueva.

**Crear rama:** `git checkout -b nombre-de-tu-tarea` (Ej: feat-login-pamela).

**Verificar:** Mira la esquina inferior izquierda de VS Code; debe poner el nombre de tu rama, NO main.

## 4. Guardar y Subir Cambios (El Ciclo de Trabajo)

Cuando termines tu código, sigue este orden exacto:

**Stage:** En el panel de "Source Control" (icono de círculos), dale al + en los archivos modificados.

**Commit:** Escribe un mensaje directo (ej: "Añadida tabla de logs") y dale al botón azul de Commit.

**Publish/Push:** Dale al botón "Publish Branch".

La primera vez te pedirá "Sign in with your browser". Dale a Autorizar y vuelve a VS Code.

## 5. El Momento de la Verdad: Pull Request (Web)

Tu código ya está en la nube, pero no en el proyecto principal.

Entra en el repositorio en GitHub.com.

**Verás un cartel amarillo:** "Compare & pull request". Dale al botón verde.

Escribe qué has hecho y dale a "Create pull request".

**AVISO:** Pon el enlace en el grupo de WhatsApp. No hagas el Merge tú mismo. Un compañero debe revisarlo para evitar errores.

## 6. Comprobación de Éxito

Entra en la web de GitHub, al cambiar de rama a la tuya, veras tus archivos

Si VS Code te pregunta por el "Git Fetch" automático: DALE A YES. Así sabrás siempre si alguien ha subido algo nuevo sin tener que preguntar.