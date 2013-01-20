$(function() {
    var sPath = window.location.pathname;
    var pageName = sPath.substring(sPath.lastIndexOf('/') + 1);
    if (pageName === "") pageName = "all";

    $.getJSON(pageName + '/load', function(data) {
        var $data = $(data);

        for (var i=0;i<data.length;i++) {

            addOneBlock(data[i]);

        }
    });

    wait(1);

});


