<?php
if(!defined('ABSPATH')) exit('No direct script access allowed');
/*
* Adds styles and javascript to the frontend
*/

function quizbook_frontend_styles(){
    wp_enqueue_style('quizbook_css', plugins_url('../assets/css/quizbook.css', __FILE__ ));

    wp_enqueue_script('quizbookjs', plugins_url('../assets/js/quizbook.js', __FILE__ ), array('jquery'), 1.0, true );

    wp_localize_script('quizbookjs', 'admin_url', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'quizbook_frontend_styles');


/*
* Adds styles and javascript to the frontend of the admin when creating a quiz
*/
function quizbook_admin_styles( $hook ) {
    global $post;
    if($hook == 'post_new.php' || $hook == 'post.php') {
        if($post->post_type == 'quizes'){
            wp_enqueue_style('quizbookcss', plugins_url('../assets/css/admin-quizbook.css', __FILE__ ));
        }
        
    }
}
add_action('admin_enqueue_scrips', 'quizbook_admin_styles');