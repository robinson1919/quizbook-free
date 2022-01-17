<?php
if(!defined('ABSPATH')) exit('No direct script access allowed');


/*
*   Recives parameters through quizbook.js and return an ajax result
*/

function quizbook_results() {
    if(isset($_POST['result'])) {
        $answers = $_POST['result'];
    }

    if(isset($_POST['count'])) {
        $questionsCount = $_POST['count'];
        $percentage = 100 / $questionsCount;
    }
    
    $score = 0;
    $scoreArr = [];
    foreach($answers as $ans) {
        $question = explode(':', $ans);
        /*
        *   $question[0] = post_id
        *   $question[1] = user's answer
        */

        $correct_answer = get_post_meta($question[0], 'quizbook_correct', true);
        $correct_value = explode(':', $correct_answer);
        /*
        *   $correct_value[0] = db_correct
        *   $correct_value[1] = correct choice
        */

        if($correct_value[1] === $question[1]) {
            
            array_push($scoreArr, $correct_value[1]);
            $score += 10;
        }
        
    }

    $realScore = (float)toFixed(count($scoreArr) / $questionsCount * 100, 1);


    $total_score = array(
        // 'total' => (float)toFixed($score, 1)
        'total' => $realScore
    );
    header('Content-Type: application/json');
    echo json_encode($total_score);
    die();
}

function toFixed($number, $decimals) {
    return number_format($number, $decimals, '.', "");
}
  
add_action( 'wp_ajax_nopriv_quizbook_results', 'quizbook_results' );
add_action( 'wp_ajax_quizbook_results', 'quizbook_results' );