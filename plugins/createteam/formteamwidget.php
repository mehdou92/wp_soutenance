<?php
/**
 * Created by PhpStorm.
 * User: Mehdi Le Trésor
 * Date: 14/03/2018
 * Time: 14:47
 */

class Form_Team_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct('form_widget', 'Créateur Equipe', array('description' => 'Formulaire pour créer une équipe de joueur'));
    }
    function form($instance) {
        $title = isset($instance['soccerName']) ? $instance['soccerName'] : '';

        echo '
            <label for="' .$this->get_field_name('soccer_name').'">Nom du joueur:</label>
            <select id="'.$this->get_field_id('soccer_name').'" name="'.$this->get_field_name('soccer_name').'" value="'.$title.'" >
        ';

    }

    public function widget ($args, $instance) {
        echo $args['before_widget'];
        echo $args['before_title'];
        echo apply_filters('widget_title', $instance['soccerName']);
        echo $args['after_title'];

        echo '
		<form action="" method="post">
			<label for="soccer-name">Nom du joueur:</label>
			<select id="soccer-name" name="soccer-name"/>
			<input type="submit"/>
		</form>
		';

        echo $args['after_widget'];
    }


}