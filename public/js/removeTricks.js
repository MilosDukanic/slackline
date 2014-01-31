$(document).ready(function(){
    $('.selectedTrick').change(function(){
        var trick=$(this).find(':selected').text();
        if(trick=='Select trick...'){
            return ;
        }
        $(this).find(':selected').remove();
        var allTricks='<script src="/js/removeTrick.js"></script>';
        allTricks=$('.done_tricks.new_done_tricks').html();
        trick="<a href='#' class='box-icon' title='' data-toggle='tooltip' data-original-title='Click to remove'>"+trick+"</a>";
        allTricks+=trick;
        $('.new_done_tricks').html(allTricks);
    });
});


