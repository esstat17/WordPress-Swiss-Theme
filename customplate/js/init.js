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
			navbarTrans = true;
		
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

		// Transparent navbar animation
		function navAnimate(navbar) {
			var topScroll = $(window).scrollTop();
			if (navbar.length > 0) {
				if (topScroll >= 5) {
					if(navbar.hasClass('navbar-transparent')){
						navbar.removeClass('navbar-transparent');
					}
					if(!navbar.hasClass('navbar-fixed-top')){
						navbar.addClass('navbar-fixed-top');
					}
				} else {
					if(!navbar.hasClass('navbar-transparent')){
						navbar.addClass('navbar-transparent');
					}
					if(navbar.hasClass('navbar-fixed-top')){
						navbar.removeClass('navbar-fixed-top');
					}
				}
			}
		}

		function scrollHide(section) {
			var topScroll = $(window).scrollTop();
			if (section.length > 0) {
				var section2 = $('.head-section-2'),
					naviLeft = $('.navi-scroll-left'),
					naviRight = $('.navi-scroll-right.navi-scroll-show');
				if (topScroll >= 5) {
					section.hide();
					naviLeft.show(180);
					naviRight.show(180);
					if(!section2.hasClass('scrolled-down')){
 						section2.addClass('scrolled-down');
 					}
				} else {
					section.show(300);
					naviLeft.hide();
					naviRight.hide();
					if(section2.hasClass('scrolled-down')){
 						section2.removeClass('scrolled-down');
 					}
				}
			}
		}
		
		$(window).scroll(function() {
			navAnimate(navbar);
			scrollHide(headSection);
		}).scroll();
		
		// Woocomerce Fixes
		// $('.woocommerce #content').addClass( 'col-md-7 woocss-fix' );
		
		
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