
$(function(){ 'use strict';

    // Alert Card
    $('.alert-card').click(function(e){
        e.preventDefault();
        $(this).fadeOut(300, function(){ $(this).remove(); });
    });

});
