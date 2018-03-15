<?php
/**
 * Created by PhpStorm.
 * User: Mehdi Le Trésor
 * Date: 15/03/2018
 * Time: 17:24
 */

// get_header();

/*while(have_posts()){
    the_post();
    the_content();
    echo '<strong>';
    the_title();
    echo'</strong>';
}
*/
$args = array( 'post_type' => 'createteam', 'posts_per_page' => 10 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
    echo '</br>';
    the_title();
    //echo '<div class="entry-content">';
    echo '<h1>';
    the_content();

// dynamic_sidebar();
// get_footer();