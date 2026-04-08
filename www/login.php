<div class="page-split-container">
    <div class="image-side">
        <div class="overlay-text">
            </div>
    </div>

    <div class="form-side">
        <div class="form-wrapper">
            <img src="img/logo.png" alt="NetManager" class="main-logo">
            
            <h2>Acceso Técnico</h2>
            <p class="subtitle">Ingrese sus credenciales de operador.</p>

            <form action="procesar_login.php" method="POST">
                <div class="input-entry">
                    <label for="usuario">ID de Operador</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Usuario" required>
                </div>

                <div class="input-entry">
                    <label for="password">Clave de Acceso</label>
                    <input type="password" name="password" id="password" placeholder="********" required>
                </div>

                <button type="submit" class="btn-login">Iniciar Sesión</button>
            </form>

            <?php if(isset($_GET['error'])): ?>
                <div class="error-msg">Error de autenticación. Verifique sus credenciales.</div>
            <?php endif; ?>
        </div>
    </div>
</div>