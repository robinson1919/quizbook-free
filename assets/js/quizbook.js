(function($){
    let option = $('#quizbook ul li ol li.answer');
    let amountOfQuestions = $('#quizbook ul li ol').length;
    option.on('click', function() {
        $(this).removeAttr('data-selected');
        $(this).siblings().removeClass('selected');
        $(this).addClass('selected');
        $(this).attr('data-selected', true);
    })

    $('#send_quizbook').on('submit', function(e) {
        e.preventDefault();

        let answers = $('[data-selected');
        const id_answers = [];

        $.each(answers, function(index, answer) {
            id_answers.push(answer.id)
        })

        const dataResult = {
            action: 'quizbook_results',
            result: id_answers,
            count: amountOfQuestions
        }              
        
        $.ajax({
            url: admin_url.ajax_url, 
            type: 'POST',
            data: dataResult
        }).done(function(result) {
            var outcome;
            if(amountOfQuestions > 3){
                if(result.total > 75) {
                    outcome = 'aproved';
                }else {
                    outcome = 'noaproved'
                }
            }else{
                if(result.total > 50) {
                    outcome = 'aproved';
                }else {
                    outcome = 'noaproved'
                }
            }     
            
            $('#quizbook_result').append("Total: "+ result.total).addClass(outcome);
            $('#quizbook_btn_submit').remove();
        });
    });
})(jQuery)