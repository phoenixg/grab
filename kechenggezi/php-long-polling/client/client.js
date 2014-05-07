
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
                var html = '<tr>' + 
                            '<td>' + obj.report + '</td>' +
                            '<td>' + obj.userId + '</td>' +
                            '<td>' + obj.uid + '</td>' +
                            '<td>' + obj.geziId + '</td>' +
                            '<td>' + obj.major + '</td>' +
                            '<td>' + obj.department + '</td>' +
                            '<td>' + obj.grade + '</td>' +
                            '<td>' + obj.sex + '</td>' +
                            '<td>' + obj.school + '</td>' +
                            '<td>' + obj.last_login_time + '</td>' +
                            '<td>' + obj.birthday + '</td>' +
                            '<td><img src="' + obj.origin_avatar_url + '" />' + '</td>' +
                            '</tr>';

                $('#response').append(html);

                var newUserId = obj.userId + 1;
                getContent(newUserId);
            }
        }
    );
}

$(function() {
    getContent();
});
