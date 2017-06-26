$(document).ready(function() {
    $(document).on('click', '.memo_remove', function(e) {
        $.post('/memo/destroy', { _token: $(this).data().token, id: $(this).data().id }, function(memo) {
            if (memo.result) {
                $('.memo_list').load( "/ #memo_panel" );
            } else {
                alert(memo.message);
            }
        });
    });
});
