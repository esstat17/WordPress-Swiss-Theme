/**
 * Custom Plate Preview
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
					$('.'+selector).css({ 'color': to });
					$('.bg-'+selector).css({ 'background-color': to });
				}
				// Link Colors
				if(setting_id=='link_color'){
					$(selector).css({ 'color': to });
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
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-name,	.site-desc' ).css( {
					'clip': 'auto',
					'position': 'static'
				} );
				$( '.site-name,	.site-desc' ).css( {
					'color': to
				} );
			}
		} );
	} );


} )( jQuery ); 