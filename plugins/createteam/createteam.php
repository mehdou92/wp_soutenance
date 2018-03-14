<?php
/*
    Plugin Name: Create Team
    Plugin URI: http://pasg-actu.com
    Description: Plugin de création d'équipe
    Author: Mehdi Bg
    Author URI: http://mehdi92i.com
    Version: 0.1
    License: CC
  */

Class Create_Team
{
    public function __construct()
    {
        include_once plugin_dir_path(__FILE__) . '/formTeam.php';
        register_activation_hook(__FILE__, array('Create_Team', 'install'));
        register_uninstall_hook(__FILE__, array('Create_Team', 'uninstall'));
        //add_action('wp_loaded', array($this, 'display_team'));

        add_action('init', 'my_custom_init');
        function my_custom_init()
        {
            /* notre code PHP pour rajouter les custom post type */
            register_post_type(
                'team_creator',
                array(
                    'label' => 'Créateur d\'équipe',
                    'labels' => array(
                        'name' => 'Créateur d\'équipe',
                        'singular_name' => 'Créateur d\'équipe',
                        'all_items' => 'Tous les équipe',
                        'add_new_item' => 'Ajouter une équipe',
                        'edit_item' => 'Éditer le équipe',
                        'new_item' => 'Nouvelle équipe',
                        'view_item' => 'Voir léquipe',
                        'search_items' => 'Rechercher parmi les projets',
                        'not_found' => 'Pas de projet trouvé',
                        'not_found_in_trash'=> 'Pas de projet dans la corbeille'
                    ),
                    'public' => true,
                    'capability_type' => 'post',
                    'supports' => array(
                        'title',
                        'editor',
                        'thumbnail'
                    ),
                    'has_archive' => true
                )
            );


            add_action('add_meta_boxes','initialisation_metaboxes');


            function initialisation_metaboxes(){
                add_meta_box('soccer-name', 'Nom du joueur', 'meta_joueur', 'team_creator', 'normal');
                add_meta_box('film_duree', 'Durée', 'meta_duree', 'team_creator', 'normal');
            }

            function meta_joueur($post){
                $real = get_post_meta($post->ID,'joueur',true);
                echo '<label for="soccer-name">Nom du joueur : </label>';
                echo '<select id="soccer-name" name="soccer-name" />';
            }
            function meta_duree($post){
                $duree = get_post_meta($post->ID,'duree',true);
                echo '<label for="duree">Durée : </label>';
                echo '<input id="duree" type="text" name="duree" placeholder="Entrer la durée du film" value="'.$duree.'" required/>';
                // echo '<input id="duree2" type="range" min="60" max="240" value="'.$duree.'"';
            }

            add_action('save_post','save_metaboxes');
            function save_metaboxes($post_id){

                // si la metabox est définie, on sauvegarde sa valeur
                if(isset($_POST['realisateur'])){
                    update_post_meta($post_id,'realisateur', esc_html($_POST['realisateur']));
                }
                if(isset($_POST['duree'])){
                    update_post_meta($post_id,'duree', esc_html($_POST['duree']));
                }
            }
        }
    }





    public static function install()
    {
        global $wpdb;
        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}stat_joueur (id INT AUTO_INCREMENT PRIMARY KEY, name_player VARCHAR(255) NOT NULL);");
    }

    public static function uninstall()
    {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}stat_joueur;");
    }
}


/*

// ajout metabox


add_action('add_meta_boxes', 'initialisation_metaboxes');
function init_metaboxes()
{
    //on utilise la fonction add_metabox() pour initialiser une metabox
    add_meta_box('1', 'Creation Equipe', 'create_team_function', 'post', 'side', 'high');
}

function create_team_function($post){

    $soccerName = get_post_meta($post->ID,'soccer-name',true);
    $position = get_post_meta($post->ID,'position',true);

    echo '<label for="soccer-name">Nom du joueur : </label>';
    echo '<select id="soccer-name" name="soccer-name" />';

    echo '<label for="position">Poste du joueur :</label>';
    echo '<select id="position" name="position" />';

}

//sauvegarde de la metabox

add_action('save_post','save_metaboxes');
function save_metaboxes($post_ID){

}
*/




New Create_Team();