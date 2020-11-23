(function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
        if (this.href === path) {
            $(this).addClass("active");
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);

$(document).ready(function() {

    //quen mat khau - password.php
    $('#inputEmailAddress').click(function() {
        $('#error-recover-pass').remove();
    });
    // xoa lop
    $('#deleClass').click(function(id) {
        if (confirm('are you sure')) {
            window.location.href = 'deleteClass.php?id='.id;
            return true;
        }
    });
    //phân quyền
    $('.btnEditUser').on('click', function() {

        $('#editmodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();


        $('#Name').val(data[0]);
        $('#Email').val(data[1]);

        if (data[2].trim() == 'Admin') {
            $('#AD').attr('selected', 'selected');
        } else if (data[2].trim() == 'Giáo viên') {
            $('#GV').attr('selected', 'selected');
        } else {
            $('#HS').attr('selected', 'selected');
        }
    });

});