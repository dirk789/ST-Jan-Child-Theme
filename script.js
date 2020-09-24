jQuery(document).ready(function () {
    // Make sure that the "next" and "prev" buttons are translated into Dutch
    jQuery('.page-next').text('Volgende');
    jQuery('.page-prev').text('Vorige');

    // Homepage read more button
    jQuery(".more-text").hide();
    jQuery(".show-hidden").on("click", function () {
        var txt = jQuery(".more-text").is(':visible') ? 'Lees meer' : 'Lees Minder';
        jQuery(".show-hidden").text(txt);
        jQuery('.more-text').slideToggle(200);
    });

});