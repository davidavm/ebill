        <?php
        if (empty($_SESSION["authenticated_id_user"]) && $security_in == 1) {
            ?>        
        <!-- Errors container -->
        <div class="row">
            <div class="col-sm-6">            
                <div class="errors-container">
                    <div class="alert alert-danger">
                        <strong>Datos de ingreso incorrectos.</strong> Por favor vuelva a intentar nuevamente.
                    </div>
                </div>
            </div>
        </div>
        <?php } ?> 
            
<div class="row">

    <div class="col-sm-6">

        <!-- Add class "fade-in-effect" for login form effect -->
        <form method="post" role="form" id="login" class="login-form fade-in-effect" action="index.php?security_administrator=login">

            <div class="login-header">
                <a href="index.php" class="logo">
                    <img src="<?php echo IMG_RELATIVE_PATH . "ebil/logo_ebil.png"; ?>" alt="Ebil" width="160" />
                </a>
                <p>Ingrese su usuario y contraseña, Sistema de Facturación Ebil.</p>
            </div>

            <div class="form-group">
                <label class="control-label" for="user">Usuario</label>
                <input type="text" class="form-control" name="user" id="user" autocomplete="off" />
            </div>

            <div class="form-group">
                <label class="control-label" for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" id="password" autocomplete="off" />
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary  btn-block text-left">
                    <i class="fa-lock"></i>
                    Ingresar
                </button>
            </div>

            <div class="login-footer">
                <a href="#">¿Olvido su password?</a>

                <div class="info-links">
                    <a href="#">Ebill</a> -
                    <a href="#">Pol&iacute;tica de privacidad</a>
                </div>

            </div>

        </form>

    </div>

</div>