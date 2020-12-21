<?php
if(is_user_logged_in()){
    wp_redirect(home_url());
    die();
}

get_header();

?>
<div id="login" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bglogin.png')">
    <div class="overlay login">
        <div class="contentlogin">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/LucilaFit-logo.png" alt="lucila">
            <h3>ELIGE TU PLAN Y ENTRENATE CON LAS MEJORES RUTINAS</h3>
            <p>Para ingresar debes estar suscripto</p>
        </div>
        <form action="" id="login-form" name="login-form">
            <input type="email" id="email" class="input-register" pattern=".+@globex.com" name="email" placeholder="Correo eléctronico" required/>
            <input type="password" class="input-register" id="password" name="password" placeholder="Contraseña" required />
            <button type="button" class="btn-login" id="btnLogin">Iniciar Sesión</button>
            <div class="hidden error alert alert-danger" id="errorLogin">
              Hay un error en alguno de sus datos:
            </div>
        </form>
    </div>
</div>
<?php get_footer(); ?>