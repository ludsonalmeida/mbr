
$(document).ready(function(){
    /*$('.event-list li').click(function(){
        $(this).css('backgroundColor','#ab0224');
    });*/

    //navegação de videos
   /* var outrasLis = $('.event-list li');

    //encapsular titulo h3
    var tituloVideo = $('.titulo h3');
    var data =  $('.titulo .disp p');

    //encapsular titulo do video
    var videoText1 = $('.event-list li:eq(0) h2').text()
    var dataDisp1 = 'Dispon&iacute;vel at&eacute; 25/05 de 2017';

    //encapsular titulo do video 2
    var videoText2 = $('.event-list li:eq(1) h2').text();
    var dataDisp2 = 'Dispon&iacute;vel at&eacute; 25/05 de 2017';

    //encapsular titulo do video 3
    var videoText3 = $('.event-list li:eq(2) h2').text();
    var dataDisp3 = 'Dispon&iacute;vel at&eacute;';

    //encapsular titulo do video 4
    var videoText4 = $('.event-list li:eq(3) h2').text();
    var dataDisp4 = 'Dispon&iacute;vel at&eacute;';


    //intrinsic-container-4x3 class video
    $('.event-list li:eq(0)').css('backgroundColor','#ab0224');
    //$('.video2').hide();
    $('.video3').hide();
    $('.video4').hide();

    $('.event-list li:eq(0)').click(function(e){
        e.preventDefault();
        $('.video1').fadeIn(2000).show();
        tituloVideo.text(videoText1);
        data.html(dataDisp1);
        $('.video2').hide();
        $('.video3').hide();
        $('.video4').hide();

        outrasLis.css('backgroundColor','#380b37');
        $(this).css('backgroundColor','#ab0224');
        scrollToAnchor('intrinsic-container-4x3');
    }).stop();

    $('.event-list li:eq(1)').click(function(e){
        e.preventDefault();
        $('.video1').hide();

        tituloVideo.text(videoText2);
        data.html(dataDisp2);
        $('.video2').fadeIn(2000).show();

        $('.video3').hide();
        $('.video4').hide();
        outrasLis.css('backgroundColor','#380b37');
        $(this).css('backgroundColor','#ab0224');
        scrollToAnchor('intrinsic-container-4x3');
    });

    /*$('.event-list li:eq(2)').click(function(e){
        e.preventDefault();
        $('.video1').hide();
        $('.video2').hide();
        tituloVideo.html(videoText3);
        $('.video3').fadeIn(2000).show();
        $('.video4').hide();
    });

    $('.event-list li:eq(3)').click(function(e){
        e.preventDefault();
        $('.video1').hide();
        $('.video2').hide();
        $('.video3').hide();
        tituloVideo.html(videoText4);
        $('.video4').fadeIn(2000).show();
    });*/

    $(".anchorLink").click(function(e){
        e.preventDefault();

        var id     = $(this).attr("href");
        var offset = $(id).offset();

        $("html, body").animate({
            scrollTop: offset.top
        }, 'slow');
    });

});


