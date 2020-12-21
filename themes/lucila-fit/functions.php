<?php
@ini_set('upload_max_size', '256M');
@ini_set('post_max_size', '256M');
@ini_set('max_execution_time', '300');


/*-----------------------------------------------------------------------------------*/
/*	Enqueue Scripts
/*-----------------------------------------------------------------------------------*/

add_action('wp_enqueue_scripts', 'enqueue_parent_styles');

function enqueue_parent_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('lucila-style', get_stylesheet_directory_uri() . '/style.css', array());
    wp_register_script('main', get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'));
    wp_localize_script('main', 'settings', array('ajax_url' => admin_url('admin-ajax.php')));
    wp_enqueue_script('main');
    /*Bootstrap*/
    wp_enqueue_script('popper.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array('jquery'));
    wp_enqueue_script('bootstrap', get_stylesheet_directory_uri() . '/assets/bootstrap/bootstrap.min.js', array('jquery'));
    wp_enqueue_script('bootstrap.bundle', get_stylesheet_directory_uri() . '/assets/bootstrap/bootstrap.bundle.min.js.map', array('jquery-slim'));
    wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/assets/bootstrap/bootstrap.min.css');
    //Fontawesome
    wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/80fdb2ae94.js');
    //Animate
    //Animate
    wp_enqueue_style('animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
    wp_enqueue_script('animate', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js');
}


function register_post_types_and_taxonomies()
{
    //Register cpt
    require_once('includes/custom-posts-type.php');
    require_once('includes/custom-taxonomies.php');
}

add_action('init', 'register_post_types_and_taxonomies');
/*-----------------------------------------------------------------------------------*/
/*	Adding icons to menu
/*-----------------------------------------------------------------------------------*/

add_filter('wp_nav_menu_objects', function ($items) {
    foreach ($items as &$item) {
        $icon = get_field('lucila_icon_menu', $item);
        if ($icon) {
            $item->title = $icon;
        }
    }
    return $items;
});

/*-----------------------------------------------------------------------------------*/
/*	Login user in frontend
/*-----------------------------------------------------------------------------------*/

function lucila_login_fronted()
{
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $status = 'error';
    $message = "";
    $url = null;
    if (!empty($email) && !empty($pass)) {
        if (email_exists($email)) {
            $creds = array(
                'user_login' => $email,
                'user_password' => $pass,
            );
            $autologin_user = wp_signon($creds, is_ssl());
            if (!is_wp_error($autologin_user)) {
                $message = "Inicio de sesión exitoso";
                $status = "success";
                $url = home_url();
            } else {
                $message = "correo eléctronico o contraseña invalida";
            }
        } else {
            $message = "Su correo eléctronico no esta asociado a ninguna cuenta";
        }
    }


    echo json_encode(array('status' => $status, 'message' => $message, 'url' => $url));
    wp_die();
}

add_action('wp_ajax_nopriv_lucila_login_fronted', 'lucila_login_fronted');

/*-----------------------------------------------------------------------------------*/
/*	User video start
/*-----------------------------------------------------------------------------------*/


function save_video_data()
{
    $post_id = (int) $_POST['post-id'];
    $user_id = $_POST['user-id'];
    $status = "error";
    if (!empty($user_id) && !empty($post_id)) {
        $user_post_videos = get_user_meta($user_id, 'user_start_video', true);
        if (empty($user_post_videos)) {
            $user_postids = array();
            $user_postids[$post_id] = $post_id;
            $meta_key = update_user_meta($user_id, 'user_start_video', $user_postids);
        } else {
            if (in_array($post_id, $user_post_videos)) {
                $status = 'success';
            } else {
                $user_post_videos[$post_id] = $post_id;
                $meta_key = update_user_meta($user_id, 'user_start_video', $user_post_videos);
            }

        }
        if ($meta_key) {
            $status = "success";
        }


    }
    echo json_encode(array('status' => $status));
    wp_die();

}

add_action('wp_ajax_save_video_data', 'save_video_data');
/*-----------------------------------------------------------------------------------*/
/*	User video end
/*-----------------------------------------------------------------------------------*/

function lucila_video_end()
{
    $post_id = $_POST['post-id'];
    $user_id = $_POST['user-id'];
    $status = "error";
    if (!empty($user_id) && !empty($post_id)) {
        $user_post_videos = get_user_meta($user_id, 'user_ended_video', true);
        if (empty($user_post_videos)) {
            $meta_key = update_user_meta($user_id, 'user_ended_video', array($post_id));
        } else {
            if (in_array($post_id, $user_post_videos)) {
                $status = "success";
            } else {
                $user_post_videos[] = $post_id;
                $meta_key = update_user_meta($user_id, 'user_ended_video', $user_post_videos);
            }
        }
        if ($meta_key) {
            $status = "sucess";
        }
    }
    echo json_encode(array('status' => $status));
    wp_die();

}

add_action('wp_ajax_lucila_video_end', 'lucila_video_end');

/*-----------------------------------------------------------------------------------*/
/*	Body Class
/*-----------------------------------------------------------------------------------*/
add_filter( 'body_class', function( $classes ) {
    if(is_page('login')){
        $classes = array_merge( $classes, array( 'page-login' ));
    }
    return  $classes;
} );