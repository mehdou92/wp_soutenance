<?php
/*
Plugin Name: monslider
Plugin URI: http://monslider.org
Description: Mon slidder
Author: Moi
Author URI: http://slidder.com
Version: 0.1
License: CC
*/

//hook
add_action('init', 'monslider_init');
add_action('add_meta_boxes','monslider_metaboxes');
add_action('save post','monslider_savepost',10,2);




/**
*Permet d'initialiser es fonctionnaiités liées au slider
**/
function monslider_init(){
    
    $labels = array(
    'name' => 'Slide',
    'singular_name' => 'Slide',
     'add_new' => 'Ajouter un Slide',
      'add_new' => 'Ajouter un nouveau Slide',
     'edit_item' => 'Editer un Slide',
      'new_item' => 'Nouvelle slide',
        'view_item' => 'Voir 1 slide',
        'search_items' =>'Rechercher un Slide',
        'not_found' => 'Aucun slide',
        'not_found_in_trash'=>'Auncun Slide dans la corbeille',
        'parent_item_colon' =>'',
        'menu_name ' =>'Slides'
    
    
    
    
    );
    
  
    
    
 register_post_type('slide', array(
 'public' => true,
 'piblicity_queryable' => false,/* pas accesible au niveau du front   */
 'labels' => $labels,
   'menu_position' => 9,
   'capability_type'=>'post',
   'supports' => array('title','thumbnail')  
 
 ));
 add_image_size('slider',1000,300,true);  

}
/**
*Permet la gestion des metaboxes
**/
function monslider_metaboxes(){
add_meta_box('monslider','Lien','monslider_metabox','slide','normal','high');

}
/**
*Metaboxes pour gerer le lien 
**/

function monslider_metabox($object){

?>

<div class="meta-box-item-title">
  <h4> Lien de ce Slide </h4>
</div>

  <div class="meta-box-item-content">
    <input type="text" name="monslider_link" style="width:100%; "value="<?= esc_attr(get_post_meta($object->ID,'_link', true)); ?>" >

  </div>

<?php 

}


function monslider_savepost($post_id, $post){
 
if (!isset($_POST['monslider_link'])){
  return $post_id;
  update_post_meta($post_id,'_link',$_POST['monslider_link']);

}


}





/**
*Permet d'afficher le slider
**/

function monslider_show($limit = 10){
  //Import de javascript
  wp_deregister_script('jquery');
  wp_enqueue_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js',null,'3.3.1',true);
  wp_enqueue_script('carouFredSel',plugins_url().'/monslider/js/jquery.carouFredSel-6.2.1-packed.js',array('jquery'),'6.2.1',true);
  
  add_action ('wp_footer','monslider_script',30);

  // Ecriture du html

    $slides = new WP_query("post_type=slide&posts_per_page=$limit",true);
    echo '<div id="monslider">';
    while($slides->have_posts()){
      $slides->the_post();
      //recuperer
      global $post;
      //affiche les images
      the_post_thumbnail('slider', array('style' => 'width:1000Px!important;'));
      


    }
echo '</div>';
    function monslider_script(){

   ?>
   <script type="text/javascript">
   (function($){
    $('#monslider').carouFredSel();

   })(jQuery);
   </script>
   <?php

    }
    
}
