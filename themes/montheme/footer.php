<h2>Pied de page</h2>
<?php 
//Affichage de la zone de widget du pied de page
dynamic_sidebar('footer_widgets');

//Affichage du menu
wp_nav_menu(array(
	'theme_location' => 'footer_menu'
));

wp_footer();
?>

</body>
</html>