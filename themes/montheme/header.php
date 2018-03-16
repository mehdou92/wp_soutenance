<!DOCTYPE html>
<html>
	<head>
		<?php wp_head(); ?>
	</head>
<body>

<h1><?php bloginfo('name'); ?></h1>
<h2><?php bloginfo('description'); ?></h2>

<?php 
//Affichage du menu
wp_nav_menu(array(
	'theme_location' => 'main_menu'
));
?>