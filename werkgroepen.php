    <?php 

    function werkgroep_function() {
        $args = array( 'post_type' => 'werkgroepen', 'posts_per_page' => 100, 'orderby'=>'title', 'order'=>'ASC');
        $loop = new WP_Query( $args );

        $html .= '<div class="werkgroepen">';
        
        foreach ($loop->posts as $post)
        {
            $html .= '
            <div id="' . (str_replace(' ', '-', strtolower($post->post_title))) . '" class="werkgroep">
                <h2>' . $post->post_title . '</h2> ';

                if( get_field("beschrijving",$post->ID) ) {
                    $html .= '<p>' . get_field("beschrijving",$post->ID) . '</p>';
                };

                
                if( have_rows('contactpersonen',$post->ID) ):
                    $html .= '<div class="personen__container">';
                    // Loop through rows.
                        while( have_rows('contactpersonen',$post->ID) ) : the_row();

                        $html .= '<div class="contactpersonen__persoon">';

                        // Load sub field value.
                        $sub_value = get_sub_field('naam');

                        
                        $html .= '
                        
                        <h5 class="functie"> ' . get_sub_field('functie') . ' </h5>
                        <p class="contactpersoon__name">' . get_sub_field('naam') .'</p>
                        
                        <ul class="werkgroep-contact">';
                            
                            if( get_sub_field('telefoonnummer') ) {
                                $html .= '<li><ion-icon name="call-outline"></ion-icon>' . get_sub_field('telefoonnummer') .'</li>';
                            };

                            if( get_sub_field('mobiel_nummer') ) {
                                $html .= '<li><ion-icon name="phone-portrait-outline">' . get_sub_field('mobiel_nummer') .'</li>';
                            };

                            if( get_sub_field('email') ) {
                                $html .= '<li><ion-icon name="mail-outline"></ion-icon></ion-icon>
                                <a href="mailto:' . get_sub_field('email') .'">'

                                . get_sub_field('email') .
                                
                                '</a></li>';
                            };

                        $html .= '
                        </ul>
                        ';
                        // Do something...

                        $html .= '</div>';
                        //end div
                    
                    // End loop.
                    endwhile;
                    $html .= '</div>';
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