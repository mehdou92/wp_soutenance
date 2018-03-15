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
                add_meta_box('soccer_goal', 'Selectionnez un Gardien', 'meta_joueur', 'team_creator', 'normal');
                add_meta_box('soccer_defg', 'Selectionnez le Défenseur gauche', 'meta_joueur', 'team_creator', 'normal');
                add_meta_box('soccer_defd', 'Selectionnez le Défenseur droit', 'meta_joueur', 'team_creator', 'normal');
                add_meta_box('soccer_defcg', 'Selectionnez le Défenseur central gauche', 'meta_joueur', 'team_creator', 'normal');
                add_meta_box('soccer_defcd', 'Selectionnez le Défenseur central droite', 'meta_joueur', 'team_creator', 'normal');
                add_meta_box('soccer_md', 'Selectionnez le Milieu droit', 'meta_joueur', 'team_creator', 'normal');
                add_meta_box('soccer_mg', 'Selectionnez le Milieu gauche', 'meta_joueur', 'team_creator', 'normal');
                add_meta_box('soccer_mc', 'Selectionnez le Milieu central', 'meta_joueur', 'team_creator', 'normal');
                add_meta_box('soccer_ad', 'Selectionnez l\'attaquant droit', 'meta_joueur', 'team_creator', 'normal');
                add_meta_box('soccer_ag', 'Selectionnez l\'attaquant gauche', 'meta_joueur', 'team_creator', 'normal');
                add_meta_box('soccer_ac', 'Selectionnez l\'attaquant central', 'meta_joueur', 'team_creator', 'normal');
                //add_meta_box('position', 'Position', 'meta_position', 'team_creator', 'normal');
            }

            function meta_joueur($post)
            {
                global $wpdb;

                $results_joueur = $wpdb->get_results("SELECT soccer_name FROM {$wpdb->prefix}stats_joueurs");

                $results_position = $wpdb->get_results("SELECT position FROM {$wpdb->prefix}position_joueur");


                $real = get_post_meta($post->ID, 'joueur', true);
                echo '<label for="soccer_1">Nom du joueur : </label>';
                echo '<select id="soccer_1" name="soccer-name" >';
                foreach ( $results_joueur as $result ) {
                    echo '<option>'.$result->soccer_name.'</option>';
                }
                echo '</select>';
            }


            add_action('save_post','save_metaboxes');

            function save_metaboxes(){

                global $post;
                if(isset($_POST["soccer_1"])){
                    //UPDATE:
                    $meta_element_class = $_POST['soccer_1'];
                    //END OF UPDATE

                    update_post_meta($post->ID, 'meta_joueur', $meta_element_class);
                    //print_r($_POST);
                }

            }
        }
    }





    public static function install()
    {
        global $wpdb;
        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}stats_joueurs (id INT AUTO_INCREMENT PRIMARY KEY,`soccer_name` varchar(255) NOT NULL,
                      `nb_matches` int(11) DEFAULT NULL,
                      `nb_buts` int(11) DEFAULT NULL,
                      `poste` varchar(255) NOT NULL,
                      `img_blob` blob NOT NULL,);");
        $wpdb->query("");
    }

    public static function uninstall()
    {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}stat_joueur;");
    }
}

New Create_Team();