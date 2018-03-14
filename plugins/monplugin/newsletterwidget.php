<?php
/**
 * Created by PhpStorm.
 * User: Mehdi Le Trésor
 * Date: 13/03/2018
 * Time: 15:32
 */

class Ma_Newsletter_Widget extends WP_Widget
{

    function __construct(){
        parent::__construct('ma_newsletter', 'Newsletter', array('description' => 'Pour afficher le formulaire d\'inscription à la mailing list'));
    }

    function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';

        echo '
            <label for="' .$this->get_field_name('title').'">Titre:</label>
            <input id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" value="'.$title.'" type="text">
        ';
        
    }

    public function widget ($args, $instance) {
        echo $args['before_widget'];
        echo $args['before_title'];
        echo apply_filters('widget_title', $instance['title']);
        echo $args['after_title'];

        echo '
		<form action="" method="post">
			<label for="ma_newsletter_email">Votre email:</label>
			<input id="ma_newsletter_email" name="ma_newsletter_email" type="email"/>
			<input type="submit"/>
		</form>
		';

        echo $args['after_widget'];
    }
}