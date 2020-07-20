$(document).ready(function () {
    $('.link-to').click(function () {
        window.location.href = $(this).data('href');
    });


});
