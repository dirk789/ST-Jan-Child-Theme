<?php 

function werkgroep_function() {
    $args = array( 'post_type' => 'werkgroepen', 'posts_per_page' => 100);
    $loop = new WP_Query( $args );

       $html .= '<div class="werkgroepen">';
    
    foreach ($loop->posts as $post)
    {
        $html .= '
        <div id="' . (str_replace(' ', '-', strtolower($post->post_title))) . '" class="werkgroep">
            <h2>' . $post->post_title . '</h2> 

            <p>' . get_field("beschrijving",$post->ID) . '</p>';

            
            if( have_rows('contactpersonen',$post->ID) ):

                 // Loop through rows.
                    while( have_rows('contactpersonen',$post->ID) ) : the_row();

                    // Load sub field value.
                    $sub_value = get_sub_field('naam');

                    
                    $html .= '
                    
                    <h5 class="functie"> ' . get_sub_field('functie') . ' </h5>
                    <p><strong>' . get_sub_field('naam') .'</strong></p>
                    
                    <ul class="werkgroep-contact">';
                        
                        if( get_sub_field('telefoonnummer') ) {
                            $html .= '<li><ion-icon name="call-outline"></ion-icon>' . get_sub_field('telefoonnummer') .'</li>';
                        };

                        if( get_sub_field('mobiel_nummer') ) {
                            $html .= '<li><ion-icon name="phone-portrait-outline">' . get_sub_field('mobiel_nummer') .'</li>';
                        };

                        if( get_sub_field('email') ) {
                            $html .= '<li><ion-icon name="mail-outline"></ion-icon></ion-icon>' . get_sub_field('email') .'</li>';
                        };

                    $html .= '
                    </ul>
                    ';
                    // Do something...

                // End loop.
                endwhile;

            endif;

            $html .= '
        </div>
        
        '; 
}   

    $html .= '</div>';

return $html;
wp_reset_query();

} 

add_shortcode('werkgroepen', 'werkgroep_function');