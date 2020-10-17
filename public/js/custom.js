
$(function(){ 'use strict';

    // Alert Card
    $('.alert-card').click(function(e){
        e.preventDefault();
        $(this).fadeOut(300, function(){ $(this).remove(); });
    });


    // Table Form
    if($('form#table_form').length){
        $('form#table_form').each(function(){
            var self = $(this);
            self.find('.pagination .pagination__link').click(function(e){
                e.preventDefault();
                self.find('[name="page"]').val($(this).data('page'));
                self[0].submit();
            });
            self.find('select.pp').change(function(){
                self.find('[name="pp"]').val(this.value);
                self[0].submit();
            });
        });
    }

});
