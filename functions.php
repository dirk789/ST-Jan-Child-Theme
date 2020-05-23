<?php
/**
 * ST Jan Breezand Child Theme
 * Functions.php
 *
 * ===== NOTES ==================================================================
 * 
 * Unlike style.css, the functions.php of a child theme does not override its 
 * counterpart from the parent. Instead, it is loaded in addition to the parent's 
 * functions.php. (Specifically, it is loaded right before the parent's file.)
 * 
 * In that way, the functions.php of a child theme provides a smart, trouble-free 
 * method of modifying the functionality of a parent theme. 
 * 
 * 
 * =============================================================================== */
 
function divichild_enqueue_scripts() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'divichild_enqueue_scripts' );




function et_custom_login_logo() {
  // Path URL to your own logo. Method get_stylesheet_directory_uri() will return
  // current theme path URL.
  $logo_url   = get_stylesheet_directory_uri() . '/images/logo.png';  // Set logo background image. esc_url() method is needed to check and clean the
  // logo URL. You can resize the logo as well by adjusting the background size,
  // height, and width.
  $logo_style = '.login h1 a { background-image: url(' . esc_url( $logo_url ) . '); background-size: 186px 86px; width: 186px; height: 86px; }';  // Render custom logo style above. 'login' is the registered stylesheet for
  // default WordPress login page. By using wp_add_inline_style() method we no
  // longer need to specify <style> tag, has unique ID, and it will be fired as
  // soon as WordPress login stylesheet is loaded.
  wp_add_inline_style( 'login', $logo_style );
	
	wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/login.css' );
}
add_action( 'login_enqueue_scripts', 'et_custom_login_logo' );/* Code explanation - End Here */

function ds_translate_text($translated) { 
  $translated = str_ireplace('read more', 'Lees meer', $translated); 
  return $translated; 


}
add_filter('gettext', 'ds_translate_text');
add_filter('ngettext', 'ds_translate_text');


/* hier registreer ik de custom posttype voor "in memoriam" */
function create_posttype() {
  register_post_type( 'memoriam',
    // Opties voor de custom post type
    array(
      'labels' => array(
      'name' => __( 'In Memoriam' ),
         'singular_name' => __( 'In Memoriam' )
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'memoriam'),
        'show_in_rest' => true,
        'supports' => array('editor'),
       )
      );
      }
      // Voeg actie toe
      add_action( 'init', 'create_posttype' );
      /* Einde toevoegen van custom post types */


?>