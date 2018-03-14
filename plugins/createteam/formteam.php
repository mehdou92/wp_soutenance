<?php
/**
 * Created by PhpStorm.
 * User: Mehdi Le Trésor
 * Date: 14/03/2018
 * Time: 14:46
 */

include_once plugin_dir_path(__FILE__).'/formteamwidget.php';

class Form_Team
{
    public function __construct(){
        add_action('widgets_init', function(){register_widget('Form_Team_Widget');});
    }

}
new Form_Team();