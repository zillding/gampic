$(document).ready(function() {
    var sPath = window.location.pathname;
    var pageName = sPath.substring(sPath.lastIndexOf('/') + 1);
    if (pageName == "") pageName = "all";

    $footer = $('#more');
    opts = {
        offset: 'bottom-in-view'
    };
    /* When the 'footer' element comes in view,
    the following code is executed */
    $footer.waypoint(function(event, direction) {
        $footer.waypoint('remove');
        /* We get additional data from a php page and
        append the same to the end of the page. */
        $.getJSON(pageName + '/loading', function(data) {
            var $data = $(data);
            //alert(data.length);
            for (var i=0;i<data.length;i++) {
                addOneBlock(data[i]);
            }
            setupBlocks();
            $('.pin').ready($footer.waypoint(opts));
        });
    },opts);

});
