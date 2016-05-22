$(function(){
    $('.video a').click(function(){
        $(this).parent().html(JSON.parse($('.video a').attr('href')));
        return false;
    });
});