$(document).ready(function() {
    
	$(".anchorLink").click(function(){
	        
	    var id     = $(this).attr("href");
	    var offset = $(id).offset();

	    $("html, body").animate({
	        scrollTop: offset.top
	    }, 'slow');

	});

});