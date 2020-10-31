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
            <h3>' . $post->post_title .'</h3>
        </div>
        
        '; 
}   

    $html .= '</div>';

return $html;
wp_reset_query();

} 

add_shortcode('werkgroepen', 'werkgroep_function');