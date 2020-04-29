$(document).ready(function() {
    $('.Ajax').click(function(e) {
        e.preventDefault();
        var url = $(this).find('#url').text();
        var _token = $("input[name='_token']").val();
        $.ajax({
            method: "GET",
            url: url,
            data: {
                _token: _token,
            },

            success: function(data, status, xhr) {
                // alert('Item Added!');
                var totalQuantity = data.totalQuantity;
                $('#totalQuantity').text(totalQuantity);
            },
            error: function(xhr, status, error) {
                alert(error);
            }
        });
    });
});