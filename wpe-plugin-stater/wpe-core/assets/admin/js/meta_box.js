(function($) {
	'use strict';
	$(document).ready(function(){
        // meta_box tab
        $.each($('[tab="tab"]'),function(){
            if($(this).attr('tab-value') != $('[name="'+$(this).attr('tab-element')+'"]:checked').val() ) {
                $(this).addClass('bb_tab_hiden');
            }else{
                $(this).removeClass('bb_tab_hiden');
            }
        })
        $('.bb-tab-parent').on('change',function(){
            var valeData = $(this).val();
            $.each($('[tab-element="'+$(this).attr('name')+'"]'),function(){
                if($(this).attr('tab-value')!= valeData) {
                    $(this).addClass('bb_tab_hiden');
                }else{
                    $(this).removeClass('bb_tab_hiden');
                }
            })
        })
    });
}(window.jQuery));
