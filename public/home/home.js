$(function(){

    //
    var addLink = function(label, icon, href){
        var html = '<a href="' + href + '"><span class="' + icon + '"></span><span class="label">' + label + '</span></a>';
        $('#home-container').append(html);
    }

    //
    var apps = $('#sidebar-wrapper ul.sidebar-nav > li:not(li:first, li:contains("Home")) > a');

    //
    apps.each(function(index, el){
        var icon = $('span', el).attr('class');
        var href = $(el).data('route-index');
        var label = $(el).text();

        addLink(label, icon, href);
    });
});
