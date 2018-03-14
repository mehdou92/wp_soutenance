<?php
//Include header.php
get_header();

//The Loop
	while (have_posts()) {
		the_post();
		the_title();
		the_excerpt();
		the_content();
	}

//Affichage de la zone de widgets
dynamic_sidebar();

//Include footer.php
get_footer();
?>