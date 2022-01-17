<?php
if(!defined('ABSPATH')) exit('No direct script access allowed');

/*
* Adds a Shortcode, use: [quizbook]
*/

function quizbook_shortcode( $atts ) {
    $args = array(
        'post_type' => 'quizes',
        'posts_per_page' => $atts['questions'],
        'orderby' => $atts['order']
    );
    $quizbook = new WP_Query($args);
?>
    <form name="send_quizbook" id="send_quizbook">
        <div id="quizbook" class="quizbook">
            <ul>
                <?php while ($quizbook->have_posts()): $quizbook->the_post(); ?>      
                    <li data-question="<?php echo get_the_ID(); ?>">
                        <?php 
                            the_title('<h4>', '</h4>'); 
                            the_content('<strong>', '</strong>'); 
                        ?>
                        <ol>
                        <?php
                            $options = get_post_meta(get_the_ID());
                            foreach ($options as $key => $option) {
                                $result = quizbook_filter_questions($key);
                                

                                if($result === 0){
                                    $number = explode('_', $key);?>

                                    <li id="<?php echo get_the_ID() . ":" . $number[2]; ?>" class="answer">
                                        <?php echo $option[0] ?>
                                    </li>
                                <?php }
                            }
                        ?>
                        </ol>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
        <input type="submit" value="send" id="quizbook_btn_submit">
        <div id="result"></div>
    </form>
    <?php wp_reset_postdata(); ?>
<?php
}
add_shortcode('quizbook', 'quizbook_shortcode');


