$(document).ready(function () {
    // Make sure that the "next" and "prev" buttons are translated into Dutch
    jQuery('.page-next').text('Volgende');
    jQuery('.page-prev').text('Vorige');

    // Homepage read more button
    $(".more-text").hide();
    $(".show_hidden").on("click", function () {
        var txt = $(".content").is(':visible') ? 'Read More' : 'Read Less';
        $(".show_hidden").text(txt);
        $(this).next('.more-text').slideToggle(200);
    });

});