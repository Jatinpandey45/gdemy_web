$(document).ready(function() {
    $(document).on('click', '.collapse-drawer' , function() {
        if ($('body').hasClass('page-sidebar-closed')) {
            $('body').removeClass('page-sidebar-closed');
        } else {
            $('body').addClass('page-sidebar-closed');
        }
    });
});
