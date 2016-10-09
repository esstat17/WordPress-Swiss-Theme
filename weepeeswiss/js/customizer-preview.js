/**
 * Weepee Swiss Preview
 * Live-update changed settings in real time in the Customizer preview.
 * Contains handlers to make Customizer preview reload changes asynchronously.
 */
( function( $ ) {
	var api = wp.customize;

	/**
	 * 5 Color Types
	 *
	 * param string setting_id Theme Setting ID
	 * param string selector HTML Selector w/o prefix such as `.` and `#`
	 */ 
	var asyncPreview = function(setting_id, selector){
		api( setting_id, function( value ) {
			value.bind( function( to ) {
				if(setting_id=='color_1' || 
					setting_id=='color_2' || 
					setting_id=='color_3' ||
					setting_id=='color_4' ||
					setting_id=='color_5')
				{
					$('.'+selector+', .'+selector+' a').css({ 'color': to });
					$('.border-'+selector).css({ 'border-color': to });
					$('.bg-'+selector).css({ 'background-color': to });
				}
				// Header Inline CSS
				if(setting_id=='header_bg') {
					$('.'+selector).css({ 'background-color': to });

				}
				// Footer Inline CSS
				if(setting_id=='footer_bg'){
					$('.'+selector).css({ 'background-color': to });
					$('.'+selector+'-rgba').css({ 'background-color': to, 'opacity': 0.95});
				}
				// Link Colors and H-Tags Colors
				if(setting_id=='link_color' || setting_id=='htags_color'){
					$(selector).css({ 'color': to });
				}
				// Text Color
				if(setting_id=='text_color' || setting_id=='header_txt'){
					$('.'+selector).css({ 'color': to });
				}
				// Footer Text Color
				if(setting_id=='footer_txt'){
					var color = to, 
						rgbaColor = 'rgba(' + parseInt(color.slice(-6,-4),16)
    					+ ',' + parseInt(color.slice(-4,-2),16)
    					+ ',' + parseInt(color.slice(-2),16)
    					+',0.85)';
					$('.'+selector).css({ 'color': to });
					$('.'+selector+'-rgba, .'+selector+'-rgba a').css({ 'color': rgbaColor});
				}
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
	asyncPreview('header_bg','header-bg');
	asyncPreview('header_txt','header-txt');
	asyncPreview('footer_bg','footer-bg');
	asyncPreview('footer_txt','footer-txt');
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