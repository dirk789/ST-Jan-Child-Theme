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


// Custom Admin footer
function wpexplorer_remove_footer_admin () {
	echo '<span id="footer-thankyou">Built with love by <a href="https://techvandaag.nl/" target="_blank">Techvandaag</a></span>';
}
add_filter( 'admin_footer_text', 'wpexplorer_remove_footer_admin' );

//login logo
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

//load custom stylesheet
function my_custom_scripts() {
  wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/script.js', array( 'jquery' ),'',true );
}
add_action( 'wp_enqueue_scripts', 'my_custom_scripts' );


/* In memoriam CPT */
function cw_post_type() {

  register_post_type( 'memoriam',
      array(
          'labels' => array(
              'name' => __( 'In Memoriam' ),
              'singular_name' => __( 'In Memoriam' )
          ),
          'has_archive' => true,
          'public' => true,
          'rewrite' => array('slug' => 'memoriam'),
          'show_in_rest' => true,
          'supports' => array('title', 'editor')
      )
  );
	
	register_post_type( 'contactpersonen',
      array(
          'labels' => array(
              'name' => __( 'Contactpersonen' ),
              'singular_name' => __( 'Contactpersonen' )
          ),
          'has_archive' => true,
          'public' => true,
          'rewrite' => array('slug' => 'contactpersonen'),
          'show_in_rest' => true,
          'supports' => array('title')
      )
  );

  register_post_type( 'werkgroepen',
  array(
      'labels' => array(
          'name' => __( 'Werkgroepen' ),
          'singular_name' => __( 'Werkgroep' )
      ),
      'has_archive' => true,
      'public' => true,
      'rewrite' => array('slug' => 'werkgroep'),
      'show_in_rest' => true,
      'supports' => array('title'),
      'menu_icon' => 'dashicons-image-filter',
  )
);
}

add_action( 'init', 'cw_post_type' );

/* Add custom support widget to WP Dashboard */
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
  
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
 
wp_add_dashboard_widget('custom_help_widget', 'Techvandaag - welkom', 'custom_dashboard_help');
}
 
function custom_dashboard_help() {
echo '
<div style="text-align: center">
<img src="https://i.imgur.com/HPVpPwl.jpg" width="180" alt="TVD logo">
</div>
<p>Welkom bij het ST Jan Dashboard. Deze website wordt onderhouden door Techvandaag. Mocht u vragen hebben over over de werking van deze website, kunt u <a href="https://www.notion.so/techvandaag/0bddd937d13d4692b776ec560d68c46e?v=2be1f34d3f9b42d49c99943b63e6384c">
hier de documentatie</a> lezen of een WhatsApp bericht sturen door <a href="https://wa.me/31623256611">hier te klikken</a>.</p>


<a class="button" href="https://www.notion.so/techvandaag/0bddd937d13d4692b776ec560d68c46e?v=2be1f34d3f9b42d49c99943b63e6384c">Documentatie</a>
<a class="button" href="https://wa.me/31623256611">Stuur een Whatsappje</a>
';
}

function contact_function() {
        $args = array( 'post_type' => 'contactpersonen', 'posts_per_page' => 100);
        $loop = new WP_Query( $args );
    
       	$html .= '<div class="contact">';
        
        foreach ($loop->posts as $post)
        {
            $html .= '
			<div class="' . get_field("categorie",$post->ID) . ' person">
                <h4>' . get_field("functie",$post->ID) . '</h4>
				<h3>' . $post->post_title .'</h3>';
				
				if( get_field("opmerking",$post->ID) ): 
					$html .= '<p class="contact__opmerking">' . get_field("opmerking",$post->ID) . '</p>';
				endif;

				$html .= '
				
				<ul class="contact__list">';
			
				if( get_field("telefoonnummer",$post->ID) ): 
					$html .= '<li class="contact__phone"><ion-icon name="call-outline"></ion-icon>' . get_field("telefoonnummer",$post->ID) . '</li>';
				endif;

				if( get_field("telefoonnummer_06",$post->ID) ):
					$html .= '<li class="contact__phone_06"><ion-icon name="phone-portrait-outline"></ion-icon>' . get_field("telefoonnummer_06",$post->ID) . '</li>';
				endif;
			
				if( get_field("email",$post->ID) ):
					$html .= '
				<li class="contact__mail"><ion-icon name="mail-outline"></ion-icon><a href="mailto:' . get_field("email",$post->ID) . '">' . get_field("email",$post->ID) . '</a></li>';
			
			endif;
			
			$html .=	'
			
			</ul>
			</div>
            '; 
    }   

    	$html .= '</div>';

    return $html;
    wp_reset_query();
} 

add_shortcode('contact', 'contact_function');


/* Google zal alle pagina's proberen te indexeren. Ook de pagina's voor contactpersonen. 
Met dit stukje code zorg ik er voor dat privacy van de contactpersonen wordt gewaarborgd. */
function noindex_for_companies()
{
    if ( is_singular( 'Contactpersonen' ) ) {
        return '<meta name="robots" content="noindex, follow">';
    }
}

add_action('wp_head', 'noindex_for_companies');

//get contactpersonen functie
include get_template_directory() . '/werkgroepen.php';

?>