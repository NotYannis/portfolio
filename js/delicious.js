var target_elt2 = $('#liste2');
var url = "http://feeds.delicious.com/v2/json/notyannis/oculus?count={1.100}";
var request2 = $.get(url, {}, function() {}, 'jsonp');
request2.done(function(data) {
    var ul = $('<ul/>').addClass('star-liste').appendTo(target_elt2);
    $.each(data, function(i, item) {
        var li = $('<li/>').appendTo(ul);
        $("<a/>").attr("href", item.u)
            .attr("title", "un projet que j’affectionne")
            .html(item.d)
            .appendTo(li);
        if ( i === 10 ) {  // max items
            return false;
        }
    });
});
