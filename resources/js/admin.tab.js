$(document).on('click', '.link-levelone ', function(e) {
    if ($(this).hasClass('submenu')) {
        e.preventDefault();
        $(this).find('.submenu').slideDown();
    }
})