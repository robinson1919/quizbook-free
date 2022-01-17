<?php
/* --------------------------------
    Plugin Name: Quizbook
    Plugin URI: https://github.com/
    Description: Plugin for editing quizes or questionaries
    Version: 1.0.
    Author: Robinson Batista Madrigal
    Author URI: https://github.com/
    License: GPL2
    License URI: https://gnu.org/licenses/gpl-2.0.html
    Text Domain: quizbook
*/


require_once plugin_dir_path(__FILE__) . 'includes/posttype.php';


/*
*   Regenerate the rules for the URLS when activating plugin
*/

register_activation_hook(__FILE__, 'quizbook_rewrite_flush');


/*
*   Adds metaboxes to the quizes
*/

require_once plugin_dir_path(__FILE__) . 'includes/metaboxes.php';


/*
*   Adds Roles to the quizes
*/
require_once plugin_dir_path(__FILE__) . 'includes/roles.php';

register_activation_hook(__FILE__, 'quizbook_create_role');
register_deactivation_hook(__FILE__, 'quizbook_remover_role');


/*
*   Adds Capabilities to the quizes
*/
register_activation_hook(__FILE__, 'quizbook_add_capabilities');
register_deactivation_hook(__FILE__, 'quizbook_remover_capabilities');



/*
* Adds a Shortcode
*/
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';


/*
* Adds a the file of functions
*/
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';


/*
* Adds a the scripts and css
*/
require_once plugin_dir_path(__FILE__) . 'includes/scripts.php';


/*
* Results of the exam
*/
require_once plugin_dir_path(__FILE__) . 'includes/results.php';

?>
