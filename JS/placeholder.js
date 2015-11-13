//fix placeholder for IE7 and IE8
jQuery(document).ready(    
    function () {
        if (!jQuery.support.placeholder) {
            jQuery("[placeholder]").focus(function () {
                if (jQuery(this).val() == jQuery(this).attr("placeholder")) jQuery(this).val("");
            }).blur(function () {
                if (jQuery(this).val() == "") jQuery(this).val(jQuery(this).attr("placeholder"));
            }).blur();

            jQuery("[placeholder]").parents("form").submit(function () {
                jQuery(this).find('[placeholder]').each(function() {
                    if (jQuery(this).val() == jQuery(this).attr("placeholder")) {
                        jQuery(this).val("");
                    }
                });
            });
        }    
});
