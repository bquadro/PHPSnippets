// placeholder focus
$.fn.togglePlaceholder = function() {
    return this.each(function() {
            $(this)
            .data("holder", $(this).attr("placeholder"))
            .focusin(function(){
                    $(this).attr('placeholder','');
            })
            .focusout(function(){
                    $(this).attr('placeholder',$(this).data('holder'));
            });
    });
};

jQuery(document).ready(function () {
    // placeholder toggle
    jQuery("[placeholder]").togglePlaceholder();   
});
