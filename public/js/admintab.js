$(document).ready(function() {
    $(document).on('click', '.collapse-drawer' , function() {
        if ($('body').hasClass('page-sidebar-closed')) {
            $('body').removeClass('page-sidebar-closed');
        } else {
            $('body').addClass('page-sidebar-closed');
        }
    });
});
$(document).on('click', '.link-levelone > a.link', function(e) {
    if ($(this).parent().hasClass('has_submenu')) {
        e.preventDefault();
        $(this).parent().find('.submenu').slideToggle();
        return false;
    }
});
