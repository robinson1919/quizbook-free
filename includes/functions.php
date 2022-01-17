<?php

function quizbook_filter_questions($key){
    return strpos($key, 'qb_');
}