jQuery(document).ready(function () {
    // Make sure that the "next" and "prev" buttons are translated into Dutch
    jQuery('.page-next').text('Volgende');
    jQuery('.page-prev').text('Vorige');

    // Homepage read more button
    jQuery(".more-text").hide();
    jQuery(".show_hidden").on("click", function () {
        var txt = jQuery(".content").is(':visible') ? 'Read More' : 'Read Less';
        jQuery(".show_hidden").text(txt);
        jQuery(this).next('.more-text').slideToggle(200);
    });

});