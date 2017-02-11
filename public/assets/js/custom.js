/* -----------------------------------------------------------------------------
	Trener - Multipurpose Coaching & Training HTML/CSS Bootstrap Theme
	v.1.02
------------------------------------------------------------------------------- */

"use strict";

var Trener = {
	init: function() {
		
		var self = this;
		
		$('#page-loader').append('<div class="loader-part loader-part-one"></div><div class="loader-part loader-part-two"></div>');
		self.pageLoader();
	
		// Page Curtain
		$('#page-curtain').append('<div class="curtain-part curtain-part-one"></div><div class="curtain-part curtain-part-two"></div>')
		
		// Smooth Scrolling
		var navHeight = $('#header').find('.nav-bar').outerHeight();
		$('[data-target="local-scroll"], #header').localScroll({
			offset: -navHeight
		});   
		  		
		if($('#page-curtain').length>0) {
			self.pageCurtain();
		}

		// Detect Safari / Chrome
		var ua = navigator.userAgent.toLowerCase(); 
		if (ua.indexOf('safari') != -1) { 
			if (ua.indexOf('chrome') > -1) {
			  $('html').addClass('chrome');
			} else {
			  $('html').addClass('safari');
			}
		}

		// Mobile Menu 
		
		var navContent = $('#header .nav-main').html();
		var menuCache;
		$('#header .mobile-menu').append('<ul></ul>');
		$('#header .mobile-menu > ul').append(navContent);
		$('#header .mobile-menu > ul > li.has-dropdown > div > ul').unwrap();
		$('#header .mobile-menu > ul > li.has-dropdown-wide > div ul').unwrap().unwrap().parent();
		$('#header .mobile-menu > ul li a').on('click', function(e) {
			if($(this).next().length>0) {
				$(this).next().slideToggle(500,"easeOutCubic");
				$(this).parent('li').toggleClass('active');
				return false;
			}
		});
		
		$('.mobile-menu-toggle').on('click', function(e) {
			$('#header .mobile-menu > ul').slideToggle(500,"easeOutCubic");
			$(this).toggleClass('active');
			return false;
		});
	
		// Opacity 
		$('.editable-alpha').each(function() {
			$(this).css('opacity',$(this).attr('data-alpha')/100);
		});
		
		// Buttons 
		$('.btn').each(function() {
			var btnHTML = $(this).html();
			$(this).html('').prepend('<span class="btn-inner">'+btnHTML+'</span>');
		});
		
		// Cutsom Checkbox 
		$('input[type="checkbox"]').each(function() {
			if($(this).is(":checked")) {
				$(this).siblings('.checkbox-label').addClass('checked')
			} else {
				$(this).siblings('.checkbox-label').removeClass('checked')
			}
		});  
		$('input[type="checkbox"]').change(function(e) {
			if($(this).is(":checked")) {
				$(this).siblings('.checkbox-label').addClass('checked')
			} else {
				$(this).siblings('.checkbox-label').removeClass('checked')
			}
		});
	
		// Counters 
		$('.counter-value').counterUp({
			delay: 10,
			time: 1000
		});
		
		// Parallax
		$('.parallax').parallax("50%", 0.6);
		
		// Owl Carousel
		$('.owl-carousel').owlCarousel({
			items : $(this).data('items'),
			itemsDesktop : $(this).data('items-desktop'),
			itemsDesktopSmall : false,
			itemsTablet : $(this).data('items-tablet'),
			itemsMobile : $(this).data('items-mobile'),
			singleItem : $(this).data('single-item'),
			autoPlay : $(this).data('auto-play'),
			autoplaySpeed : 4000,
			navSpeed : 4000,
			paginationSpeed : 400,
			pagination : $(this).data('pagination')
		});
		
		// Owl Slideshow
		$('.owl-slideshow').owlCarousel({
			singleItem : true,
			autoPlay : $(this).data('data-auto-play'),
			slideSpeed : 300,
			pagination : false,
			transitionStyle : "fade"
		});
	
		// Twitter 
		$(".tweet").tweet({
			modpath: './php/twitter/',
			username:"bidfps",
			join_text: "auto",
			count: 2,
			auto_join_text_default: "Dissemos,",
			auto_join_text_ed: "Nós",
			auto_join_text_ing: "Nós somos",
			auto_join_text_reply: "Respondemos para",
			auto_join_text_url: "Fizemos o checkout",
			loading_text: "Carregando tweets..."
		});
	
		// Colorbox 
		$('a[data-target="lightbox"]').colorbox({
			opacity: 0.80,
			maxWidth: "90%",
			maxHeight: "90%"
		});
		
		self.setSizes();
		self.verticalCenter();
		self.forms();
		if($('body').hasClass('sticky-nav')) self.stickyNav();
		
		$(window).resize(function() {
			self.setSizes();
			self.verticalCenter();
		});

	},
	verticalCenter: function() {
		
		$('.vertical-center').each(function() {	
			var parentWidth = $(this).parent().width()-(2*($(this).css('padding-left').replace('px','')));
			console.info(parentWidth);
			if(parentWidth!=$(this).width()||$(this).hasClass('container')) {
				$(this).css({
					'margin-top': ($(this).parent().height()/2)-($(this).height()/2)+'px'
				});
			}
		});

	},
	setSizes: function() {
		var winHeight = $(window).height();
		var headerHeight = $('#header').height();
		$('#header .mobile-menu > ul').css({
			'height': winHeight-headerHeight+'px'
		});
		$('#header .mobile-menu').css({
			'margin-top': headerHeight+'px'
		});
		if($('#header').hasClass('transparent')) $('.home-viewport, .home-viewport .bg-image').css('min-height',winHeight+'px');
		else $('.home-viewport, .home-viewport .bg-image').css('min-height',winHeight-headerHeight+'px');
	
		$('.home-full-carousel').find('.owl-item').css('height',$('#home').height());

	},
	stickyNav: function() {
		
		var stickyNavTop = $('#header .nav-bar').offset().top+400;
		var isSticky = false;  
		var headerHeight = $('#header').height();
		var topBarHeight = $('#header').find('.top-bar').outerHeight();
		console.info(headerHeight); 
	
		$(window).scroll(function() {  
			var scrollTop = $(window).scrollTop();  
	
			if ((scrollTop > stickyNavTop)&&(!isSticky)) {   
				isSticky = true;
				if(!$('#header').hasClass('transparent')) $('body').css('padding-top',headerHeight+'px');
				$('#header').stop().css('margin-top',-headerHeight+'px').addClass('sticky').animate({
					'margin-top': -topBarHeight+'px'
				},300,'easeOutCubic');
				console.info(isSticky);
			} else if ((scrollTop <= topBarHeight)&&(isSticky)) {
				$('body').css('padding-top',0);
				$('#header').css('margin-top',0);
				$('#header').removeClass('sticky');
				isSticky = false;
				console.info(isSticky);
			}
		}); 

	},
	animations: function() {
		
		$('.animated').appear(function() {
			$(this).each(function(){ 
					var $target =  $(this);
					var delay = $(this).data('animation-delay');
					setTimeout(function() {
						$target.addClass($target.data('animation')).addClass('visible')
					}, delay);
			});
		});

		$('.sep-animated').appear(function() {
			jQuery(this).each(function(){ jQuery(this).addClass('sep-animation').addClass('visible') });
		});

	},
	pageCurtain: function() {
		
		$('a').on('click', function(e) {

			if($(this).attr('href')&&($(this).data('curtain')!="blocked")&&($(this).attr('href').substr(0,1)!='#')&&($(this).attr('target')!="_blank")&&($(this).data('target')!="lightbox")) {
			  
				var goToURL= $(this).attr('href');
	
				$('#page-curtain').show();
				$('.curtain-part-one').delay(50).animate({
					  'top': '0'
				  },800,'easeInOutQuart');
				$('.curtain-part-two').delay(50).animate({
					  'bottom': '0'
				},800,'easeInOutQuart', function() {
						window.location.href = goToURL;
						$('#page-curtain').delay(500).fadeOut(500, function() { 
							$('.curtain-part-one').css('top','-50%');
							$('.curtain-part-two').css('bottom','-50%');
						});
					});
				 
				return false;
			 
			}
			
		});

	},
	pageLoader: function() {
			
		Pace.on("done", function() {
			$('.pace-progress').delay(1000).fadeOut(100, function() {
			  
			  $(".loader-part-one").delay(50).animate({
					'top': '-50%',
					'border-radius': '50%',
					'-webkit-border-radius': '50%',
					'-moz-border-radius': '50%',
					'transform': 'scaleY(0.5)',
					'-ms-transform': 'scaleY(0.5)',
					'-moz-transform': 'scaleY(0.5)',
					'-webkittransform': 'scaleY(0.5)'
				},800,'easeInOutQuart');
		   $(".loader-part-two").delay(50).animate({
					'bottom': '-50%',
					'border-radius': '50%',
					'-webkit-border-radius': '50%',
					'-moz-border-radius': '50%',
					'transform': 'scaleY(0.5)',
					'-ms-transform': 'scaleY(0.5)',
					'-moz-transform': 'scaleY(0.5)',
					'-webkittransform': 'scaleY(0.5)'
			   },800,'easeInOutQuart', function() { 
					$('#page-loader').fadeOut(50);
					Trener.animations();
				 });
			  
		  });
		});

	},
	forms: function() {
		
		var $alertModal = $('#alertModal');
		var response, alertLabel;
		
		//Sign In Form
		
		var $signInForm  = $('#sign-in-form');	
		
		$signInForm.validate({
			rules: {
				emailSigned: {
					required : true,
					email : true
				},
				acceptRules: {
					required : true
				}
			},
			messages: {
				emailSigned: {
					required : "Por favor, digite seu e-mail",
					minlength : "Você digitou um e-mail inválido."
				},
				acceptRules: {
					required : "Por favor aceite os termos."
				}
			}
		});
	
		$signInForm.submit(function(){
			$alertModal.find('#alertModalLabel').html('');
			$alertModal.find('.modal-alert-content').html('');
			if ($signInForm.valid()){
				$.ajax({
					type: "POST",
					url: "php/sign-in-form.php",
					data: $(this).serialize(),
					success: function(msg) {
						if (msg === 'SEND') {
							alertLabel = "Enviado!";
							response = '<div><span class="icon icon-lg"><i class="fa fa-download text-primary"></i></span></div>Enviado! Por favor <strong>cheque sua caixa de e-mail</strong>. Obrigado! ';
						}
						else {
							alertLabel = "Vish! Deu Ruim!";
							response = '<div><span class="icon icon-lg"><i class="fa fa-times text-muted"></i></span></div>Ooops... Houston nós temos um problema!';
						}
						$alertModal.find('#alertModalLabel').prepend(alertLabel);
						$alertModal.find('.modal-alert-content').prepend(response);
						$alertModal.modal('show');
					}
				 });
				return false;
			}
			return false;
		});
	
		/* Contact Form */
		
		var $contactForm  = $('#contact-form, #contact-form-extended');
	
		$contactForm.validate({
			rules: {
				name: {
					required    : true,
					minlength   : 2
				},
				email: {
					required    : true,
					email       : true
				},
				message: {
					required    : true,
					minlength   : 10
				}
			},
			messages: {
				name: {
					required    : "Por favor,  digite seu nome.",
					minlength   : "Seu nome precisa ter pelo menos 2 caracteres"
				},
				email: {
					required    : "Por favor,  digite um e-mail válido.",
					minlength   : "Você digitou um e-mail inválido."
				},
				message: {
					required    : "Por favor,  digite sua mensagem.",
					minlength   : "Digite pelo menos 10 caracteres."
				}
			},
		});
	
		$contactForm.submit(function() {
			$alertModal.find('#alertModalLabel').html('');
			$alertModal.find('.modal-alert-content').html('');
			var response;
			if ($contactForm.valid()){
				$.ajax({
					type: "POST",
					url: "php/contact-form.php",
					data: $(this).serialize(),
					success: function(msg) {
						if (msg === 'SEND') {
							alertLabel = "Mensagem Enviada!";
							response = '<div><span class="icon icon-lg"><i class="fa fa-check text-primary"></i></span></div>Obrigado! Sua mensagem vale muito para nós - Em breve entraremos em contato';
						}
						else {
							alertLabel = "Vish! Deu ruim!!";
							response = '<div><span class="icon icon-lg"><i class="fa fa-times text-muted"></i></span></div>Ooops... Parece que algo não deu certo.';
						}
						$alertModal.find('#alertModalLabel').prepend(alertLabel);
						$alertModal.find('.modal-alert-content').prepend(response);
						$alertModal.modal('show');
					}
				 });
				return false;
			}
			return false;
		});

	},
	tooltipIni: function() {
		$("[data-toggle='tooltip']").tooltip();
	},
	popoverIni: function() {
		$("[rel='popover']").popover();
	}
}

$(document).ready(function (){

	Trener.init();

});


