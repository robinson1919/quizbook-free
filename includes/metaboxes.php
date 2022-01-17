<?php

if(!defined('ABSPATH')) exit('No direct script access allowed');

function quizbook_add_metaboxes() {
    add_meta_box('quizbook_meta_box', 'Respuestas', 'quizbook_metaboxes', 'quizes', 'normal', 'high', $callback_args = null );
}

add_action('add_meta_boxes', 'quizbook_add_metaboxes');

/*
* Shows the content of the metaboxes in the HTML document
*/

function quizbook_metaboxes($post){
    wp_nonce_field(basename(__FILE__), 'quizbook_nonce');
    ?>
    <table class="form-table">
        <tr>
            <th class="row-title">
                <h2 ><strong>Add the answers here:</strong></h2>
            </th>
        </tr>
        <tr>
            <th class="row-title">
                <label for="answer_a">a)</label>
            </th>
            <td>
                <input value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_answer_a', true)); ?>" type="text" id="answer_a" name="qb_answer_a" class="regular-text">
            </td>
        </tr>

        <tr>
            <th class="row-title">
                <label for="answer_b">b)</label>
            </th>
            <td>
                <input value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_answer_b', true)); ?>" type="text" id="answer_b" name="qb_answer_b" class="regular-text">
            </td>
        </tr>

        <tr>
            <th class="row-title">
                <label for="answer_c">c)</label>
            </th>
            <td>
                <input value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_answer_c', true)); ?>" type="text" id="answer_c" name="qb_answer_c" class="regular-text">
            </td>
        </tr>

        <tr>
            <th class="row-title">
                <label for="answer_d">d)</label>
            </th>
            <td>
                <input value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_answer_d', true)); ?>" type="text" id="answer_d" name="qb_answer_d" class="regular-text">
            </td>
        </tr>

        <tr>
            <th class="row-title">
                <label for="answer_e">e)</label>
            </th>
            <td>
                <input value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_answer_e', true)); ?>" type="text" id="answer_e" name="qb_answer_e" class="regular-text">
            </td>
        </tr>

        <tr>
            <th class="row-title">
                <label for="correct_anwer">Correct answer</label>
            </th>
            <td>
                <select value="<?php $answer = esc_html(get_post_meta($post->ID, 'quizbook_correct', true)); ?>" name="quizbook_correct" id="correct_anwer" class="postbox">
                    <option value="">Choose the right answer</option>
                    <option <?php selected($answer, 'qb_correct:a'); ?>value="qb_correct:a">A</option>
                    <option <?php selected($answer, 'qb_correct:b'); ?>value="qb_correct:b">B</option>
                    <option <?php selected($answer, 'qb_correct:c'); ?>value="qb_correct:c">C</option>
                    <option <?php selected($answer, 'qb_correct:d'); ?>value="qb_correct:d">D</option>
                    <option <?php selected($answer, 'qb_correct:e'); ?>value="qb_correct:e">E</option>
                </select>
            </td>
        </tr>
    </table>


<?php
}


function quizbook_guardar_metaboxes($post_id, $post, $update) {

    if(!isset($_POST['quizbook_nonce']) || !wp_verify_nonce($_POST['quizbook_nonce'], basename(__FILE__))) return $post_id;

    if(!current_user_can('edit_post', $post)) return $post_id;

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;


    $answer_a = $answer_b = $answer_c = $answer_d = $answer_e = $correct_anwer = '';

    if(isset($_POST['qb_answer_a'])) {
        $answer_a = sanitize_text_field($_POST['qb_answer_a']);
    }  
    update_post_meta($post_id, 'qb_answer_a', $answer_a);

    if(isset($_POST['qb_answer_b'])){
        $answer_b = sanitize_text_field($_POST['qb_answer_b']);
    } 
    update_post_meta($post_id, 'qb_answer_b', $answer_b);

    if(isset($_POST['qb_answer_c'])){
        $answer_c = sanitize_text_field($_POST['qb_answer_c']);
    } 
    update_post_meta($post_id, 'qb_answer_c', $answer_c);

    if(isset($_POST['qb_answer_d'])){
        $answer_d = sanitize_text_field($_POST['qb_answer_d']);
    } 
    update_post_meta($post_id, 'qb_answer_d', $answer_d);

    if(isset($_POST['qb_answer_e'])){
        $answer_e = sanitize_text_field($_POST['qb_answer_e']);
    } 
    update_post_meta($post_id, 'qb_answer_e', $answer_e);

    if(isset($_POST['quizbook_correct'])){
        $correct_anwer = sanitize_text_field($_POST['quizbook_correct']);
    } 
    update_post_meta($post_id, 'quizbook_correct', $correct_anwer);
    
}

add_action('save_post', 'quizbook_guardar_metaboxes', 10, 3);