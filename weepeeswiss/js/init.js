(function($){

	"use strict";

	$(document).ready(function() {

		/* ---------------------------------------------- /*
		 * Initialization general scripts for all pages
		/* ---------------------------------------------- */

		var moduleHero  = $('#hero'),
			headSection = $('.head-section-1'),
			navbar      = $('.navbar-custom'),
			modules     = $('.module-hero, .module, .module-small'),
			windowWidth = Math.max($(window).width(), window.innerWidth),
			prevScroll = 0;
		
		/* ---------------------------------------------- /*
		 * Full height module
		/* ---------------------------------------------- */

		function buildModuleHero() {
			if (moduleHero.length > 0) {
				if (moduleHero.hasClass('module-full-height')) {
					moduleHero.height($(window).height());
				} else {
					moduleHero.height($(window).height() * 0.85);
				}
			}
		}

		function initModuleHero(){
			var windowWidth = Math.max($(window).width(), window.innerWidth);
			buildModuleHero();
		}
		
		$(window).ready(initModuleHero).resize(initModuleHero);

		function hideIfScrollDown(me){
			var scrolling = $(me).scrollTop();
   			if (scrolling < prevScroll){
   				// scroll down
   				$("#primary-navigation").show();
   			} else {
   				// scroll up!
   				$("#primary-navigation").hide();
   			}
   			prevScroll = scrolling;
		}

		// Hiding upper section of the navigation
		function scrollHide(me) {
			var scrolling = $(window).scrollTop();
			var section2 = $('.head-section-2'),
				naviLeft = $('.navi-scroll-left'),
				naviRight = $('.navi-scroll-right.navi-scroll-show');
					
			if (scrolling >= 5) {
				hideIfScrollDown(me);
				// Hide Section 1
				headSection.hide();
				naviLeft.show();
				naviRight.show();
				if(!section2.hasClass('scrolled-down')){
 					section2.addClass('scrolled-down');
 				}

 				// Nav Scroll animation
 				if(navbar.hasClass('navbar-transparent')){
					navbar.removeClass('navbar-transparent');
				}
				if(!navbar.hasClass('navbar-fixed-top')){
					navbar.addClass('navbar-fixed-top');
				}

			} else {

				// Hide Section 1
				headSection.show();
				naviLeft.hide();
				naviRight.hide();
				if(section2.hasClass('scrolled-down')){
 					section2.removeClass('scrolled-down');
 				}

 				// Nav Scroll animation
 				if(!navbar.hasClass('navbar-transparent')){
					navbar.addClass('navbar-transparent');
				}
				if(navbar.hasClass('navbar-fixed-top')){
					navbar.removeClass('navbar-fixed-top');
				}
			}		
		}


		$(window).scroll(function() {
			scrollHide(this);
		});
				
		// Navigation Menu
		$('#primary-menu').superfish();
		
		// Setting background of modules

		modules.each(function() {
			if ($(this).attr('data-background')) {
				$(this).css('background-image', 'url(' + $(this).attr('data-background') + ')');
			}
		});

		// Scroll top
		$(window).scroll(function() {
			if ($(this).scrollTop() > 100) {
				$('.scroll-up').fadeIn();
			} else {
				$('.scroll-up').fadeOut();
			}
		});

		$('a[href="#totop"]').click(function() {
			$('html, body').animate({ scrollTop: 0 }, 'slow');
			return false;
		});

	});

})(jQuery);