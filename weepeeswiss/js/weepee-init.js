/*	
 * Direct JS call and initialize the scripts.js
 */

(function($){

	"use strict";

	$(document).ready(function() {

		                
      //  $('#navi-mobil').mlmenu({
//        	extensions: ['slide-effects', 'pageshadow'],
//           	slidemenu: {
//            	navtitle: '<div id="ml-logo">LOGO</div>'
//            }
//      	});
		// $('.topmost-navigation ul').addClass('sf-menu sf-arrows');

		/* ---------------------------------------------- /*
		 * App variables
		/* ---------------------------------------------- */

		var moduleHero  = $('#hero'),
			primeNav  = "#primary-navigation",
			contentBody = "#content-body",
			searchWidget = "#primary-navigation .widget_search",
			navHeight = $(primeNav).height(),
			winHeight = $(window).height(),
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

			// scroll down!
   			if (scrolling > prevScroll){
   				if(scrolling - 10 > prevScroll){
   					if($(primeNav).hasClass('nav-on')){
   						$(primeNav).removeClass('nav-on').addClass('nav-off').css({'top':-navHeight});
   					}
   				}
			// scroll up!
   			} else {
   				if(scrolling + 10 < prevScroll){
   					if($(primeNav).hasClass('nav-off')){
	   					$(primeNav).removeClass('nav-off').addClass('nav-on').css({'top':'0'});
	   				}
   				}
   			}
   			prevScroll = scrolling;
		}

		// Hiding upper section of the navigation
		function scrollHide(me) {
			var scrolling = $(window).scrollTop(),
				headSection = $('.head-section-1'),
				section2 = $('.head-section-2'),
				naviLeft = $('.navi-scroll-left'),
				naviRight = $('.navi-scroll-right.navi-scroll-show');
			
			// Kicks After Navigation
			if (scrolling > navHeight) {
				$(contentBody).css({'padding-top':navHeight})
				hideIfScrollDown(me);
				// Hide Section 1
				headSection.hide();
				naviLeft.show();
				naviRight.show();
				if(!$(primeNav).hasClass('scrolled-down')){
 					$(primeNav).addClass('scrolled-down').css({'top':-navHeight }).addClass('navbar-fixed-top');
 				}
			} else {
				$(contentBody).css({'padding-top':'inherit'})
				// Hide Section 1
				headSection.show();
				naviLeft.hide();
				naviRight.hide();
				if( $(primeNav).hasClass('scrolled-down')){
 					$(primeNav).removeClass('scrolled-down').css({'top':0 }).removeClass('navbar-fixed-top'); 
 				}
			}		
		}
		// Min Height Fixes
		$(contentBody).css({'min-height':winHeight+.25*winHeight});

		$(window).scroll(function() {
			scrollHide(this);
		});

		// Search Form Modal
		if (searchWidget.length > 0) {
			$(searchWidget).each(function(){
				$(this).append('<button type="button" class="btn btn-circle color-2 bg-color-1" data-toggle="modal" data-target="#login-modal"><i class="glyphicon glyphicon-search"></i></button>');			
			});
			$("#primary-navigation #searchform:first").appendTo('#modal-body');
		}
				
		// Navigation Menu
		$('#primary-menu').superfish();
		
		// Setting background of modules
		modules.each(function() {
			if ($(this).attr('data-background')) {
				$(this).css('background-image', 'url(' + $(this).attr('data-background') + ')');
			}
		});

		// Back on top
		$(window).scroll(function() {
			if ($(this).scrollTop() > navHeight) {
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