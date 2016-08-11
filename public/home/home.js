$(function(){

    //
    var addLink = function(label, icon, href){
        var html = '<a href="' + href + '"><span class="' + icon + '"></span>' + label + '</a>';
        $('#home-container').append(html);
    }

    // pega todos os itens menu, não ignorando
    // header, home
    var apps = $('#sidebar-wrapper ul.sidebar-nav > li:not(li:first, li:contains("Home"))');

    apps.each(function(index, el){
        var icon = $('a span', el).attr('class');
        var href = $('a', el).data('href-index');
        var label = $('a', el).text();

        addLink(label, icon, href);
    });
});
