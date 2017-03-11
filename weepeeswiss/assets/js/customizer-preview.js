/**
 * Weepee Swiss Preview
 * Live-update changed settings in real time in the Customizer preview.
 * Contains handlers to make Customizer preview reload changes asynchronously.
 */
( function( $ ) {
	var api = wp.customize;

	/**
	 * Create Style Tag for each color
	 *
	 * param string setting_id Theme Setting ID
	 * param string selector HTML selector w/o prefix such as `.` and `#`
	 * param string to actual dynamic value, live updates
	 */ 
	var addStyle = function(setting_id, selector, to){
		if($('#' + setting_id).length > 0){
			$('#' + setting_id).remove();
		}
		var div = document.createElement('div'),
  		head = document.getElementsByTagName('head')[0],
  		cssStyles = '';
  		div.id = setting_id;
        div.style.display = 'none';

        // Link Color
		if(setting_id=='link_color' || setting_id=='htags_color'){
			cssStyles += selector + ' {color:' + to +';} ';
		}

		// Background Color
		if(setting_id=='well_bg' || setting_id=='top_toolbar_bg' ) {
			cssStyles += '.' + selector + ' {background-color:' + to +';} ';
		}

		if(setting_id=='header_bg') {
			var headerBgFixed = to == '#f5f5f5' ? 'initial' : to;
			cssStyles += '.' + selector + ' {background-color:' + headerBgFixed  +';} ';
		}

		if(setting_id=='footer_bg'){
			cssStyles += '.' + selector + ' {background-color:' + to +';} ',
			cssStyles += '.' + selector + '-rgba {background-color:' + to +'; opacity: 0.98;} ';
		}

		// 5 Custom Colors
		if(setting_id=='color_1' || setting_id=='color_3' || setting_id=='color_4' || setting_id=='color_5'){
			cssStyles += '.' + selector + ',.' +selector + ' a,.' +selector + ':hover {color:' + to +';} ',
			cssStyles += '.bg-' + selector + ', .bg-' +selector + ' a, .bg-' +selector + ':hover {background-color:' + to +';} ',
			cssStyles += '.border-' + selector + ' {border-color:' + to +';} ';
		}

		if(setting_id=='color_2'){
			cssStyles += '.' + selector + ',.' +selector + ' a,.' +selector + ':hover {color:' + to +'!important;} ',
			cssStyles += '.bg-' + selector + ', .bg-' +selector + ' a, .bg-' +selector + ':hover {background-color:' + to +'!important;} ',
			cssStyles += '.border-' + selector + ' {border-color:' + to +'!important;} ';
		}

		// Text Colors
		if(setting_id == 'top_toolbar_txt'){
			cssStyles += '.' + selector + ',.' +selector + ' a {color:' + to +';} ';
		}

		if(setting_id=='text_color'){
			cssStyles += '.' + selector + ' {color:' + to +';} ';
		}

		if(setting_id=='header_txt'){
			cssStyles += '.' + selector + ',.' +selector + ' a {color:' + to +';} ',
			cssStyles += '.' + selector + '.scrolling-down.nav-on, .' +selector + '.scrolling-down.nav-on a, .' +selector + '.scrolling-down.nav-on span {color:' + to +';} ';
		}

		if( setting_id=='home_header_txt' ){
			cssStyles += '.home .' + selector + ', .home .' +selector + ' a, .home .' +selector + ' span {color:' + to +';} ';
		}

		if(setting_id=='footer_txt'){
			var color = to, 
			rgbaColor = 'rgba(' + parseInt(color.slice(-6,-4),16)
    					+ ',' + parseInt(color.slice(-4,-2),16)
    					+ ',' + parseInt(color.slice(-2),16)
    					+',0.72)';
			cssStyles += '.' + selector + ', .' +selector + ' a {color:' + to +';} ',
			cssStyles += '.' + selector + '-rgba, .' +selector + '-rgba a {color:' + rgbaColor +';} ';
		}

  		div.innerHTML = '<style type="text/css">' + cssStyles + '</style>';
		head.appendChild(div);
	}

	/**
	 * 5 Color Types
	 *
	 * param string setting_id Theme Setting ID
	 * param string selector HTML Selector w/o prefix such as `.` and `#`
	 */ 
	var asyncPreview = function(setting_id, selector){
		api( setting_id, function( value ) {
			value.bind( function( to ) {

				addStyle(setting_id, selector, to);

				// Site title and description.
				if(setting_id=='blogname'){
					$( '.site-name' ).html( to );
				}
				if(setting_id=='blogdescription'){
					$( '.site-desc' ).html( to );
				}

			});
		});
	}
	asyncPreview('link_color','a');
	asyncPreview('htags_color','h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a');
	asyncPreview('top_toolbar_bg','top-toolbar-bg');
	asyncPreview('top_toolbar_txt','top-toolbar-txt');
	asyncPreview('header_bg','header-bg');
	asyncPreview('header_txt','header-txt');
	asyncPreview('home_header_txt','header-txt');
	asyncPreview('footer_bg','footer-bg');
	asyncPreview('footer_txt','footer-txt');
	asyncPreview('well_bg','well-bg');
	asyncPreview('text_color','text-color');
	asyncPreview('color_1','color-1');
	asyncPreview('color_2','color-2');
	asyncPreview('color_3','color-3');
	asyncPreview('color_4','color-4');
	asyncPreview('color_5','color-5');

	// Site title and description.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-name' ).html( to );
		} );
	} );
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-desc' ).html( to );
		} );
	} );
	api( 'footer_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.copyright-notice span' ).html( to );
		} );
	} );

	api( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-name, .site-desc' ).css( {
					'clip': 'auto',
					'position': 'static',
					'color': to
				} );
			} else {
				$( '.site-name,	.site-desc' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			}
		} );
	} );
 

} )( jQuery ); 