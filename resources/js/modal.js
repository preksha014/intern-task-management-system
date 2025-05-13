$(function () {
    $('[data-action-open]').on('click', function () {
        var deleteUrl = $(this).data('url');
        $('#deleteForm').attr('action', deleteUrl);
        $('#deleteModal').removeClass('hidden');
    });

    $('#cancelDelete').on('click', function () {
        $('#deleteModal').addClass('hidden');
    });
});