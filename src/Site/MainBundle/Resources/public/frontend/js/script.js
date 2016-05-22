$(function(){
    if($('.partners-block').height() > 344){
        $('.wrap_footer').css({
            'margin-top' : -($('.partners-block').height() + $('.footer').height() + 4) + 'px'
        });
        $('.wrap_content').css({
            'padding-bottom' : ($('.partners-block').height() + $('.footer').height() + 4) + 'px'
        });
        if($('.main-moment').length > 0){
            $('.main-moment').css({
                'padding-bottom' : ($('.partners-block').height() + $('.footer').height() + 4) + 'px'
            });
        }  
    }

//  Слайдер новостей
    $('.content-left-block .content-slide-block.second').click(function(){
        var object = $(this);
        $('.content-left-block .content-slide-block.second').removeClass('current');
        object.addClass('current');
        $('.content-left-block .content-slide-block.first *').fadeOut(200, function(){
            $('.content-left-block .content-slide-block.first').html(object.html()).find('*').hide();
            $('.content-left-block .content-slide-block.first img.little').remove();
            $('.content-left-block .content-slide-block.first img.big').removeClass('hide');
            $('.content-left-block .content-slide-block.first img.big').wrap('<a href="' + object.find('a').attr('href') + '"></a>');
            $('.content-left-block .content-slide-block.first *').fadeIn(200);
        });
    });

//  Всплывающее окошко при наведении на кубок
    $(".kubok").on('mouseenter', function(){
        var $object = $(this);
        $object.find('.kubok_wrap_window').clone().appendTo('body');
        $('body').find(' > .kubok_wrap_window')
            .css({
                top: $object.offset().top - $('body').find(' > .kubok_wrap_window').height() + 20,
                left: $object.offset().left - ($('body').find(' > .kubok_wrap_window').width()/2 - $object.width()/2)
            })
            .show();
    }).on('mouseleave', function(){
        $('body').find(' > .kubok_wrap_window').remove();
    });
});