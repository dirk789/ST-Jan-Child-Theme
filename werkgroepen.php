<?php 

function werkgroep_function() {
    $args = array( 'post_type' => 'werkgroepen', 'posts_per_page' => 100);
    $loop = new WP_Query( $args );

       $html .= '<div class="werkgroepen">';
    
    foreach ($loop->posts as $post)
    {
        $html .= '
        <div class="' . get_field("beschrijving",$post->ID) . ' person">
            <h4>' . get_field("beschrijving",$post->ID) . '</h4>
            <h3>' . $post->post_title .'</h3>';

            if( have_rows('contactpersonen',$post->ID) ):

                echo 'yo';
                 // Loop through rows.
                    while( have_rows('contactpersonen',$post->ID) ) : the_row();

                    // Load sub field value.
                    $sub_value = get_sub_field('naam',$post->ID);
                    // D    o something...

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