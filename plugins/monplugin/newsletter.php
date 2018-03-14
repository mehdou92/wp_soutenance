<?php
/**
 * Created by PhpStorm.
 * User: Mehdi Le Trésor
 * Date: 13/03/2018
 * Time: 15:29
 */

include_once plugin_dir_path(__FILE__).'/newsletterwidget.php';

class Ma_Newsletter
{
   public function __construct(){
        add_action('widgets_init', function(){register_widget('Ma_Newsletter_Widget');});
    }

}
new Ma_Newsletter();