
function getContent(userId)
{
    var queryString = {'userId' : userId};

    $.ajax(
        {
            type: 'GET',
            url: 'http://95.85.17.20/mine/grab/kechenggezi/php-long-polling/server/server.php',
            data: queryString,
            success: function(data){
                var obj = jQuery.parseJSON(data);
                $('#response').html(obj.data_from_file);

                var newUserId = obj.userId + 1;
                getContent(newUserId);
            }
        }
    );
}

// initialize jQuery
$(function() {
    getContent();
});
