<?php
/**
 * All wp_footer Hooks goes here
 * 
 * @see Widget API at https://developer.wordpress.org/reference/functions/wp_footer/
 * @since  1.0.2       
 */

function weepeeswiss_foot_scripts(){
?>
<script type="text/javascript">
  jQuery(document).ready(function($) { 
  	$('#navi-mobil').mlmenu({
    	extensions: ['slide-effects', 'pageshadow'],
        	slidemenu: {
            	navtitle: '<a class="mobile-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php $wps_logo_uri = apply_filters( 'wps_logo', get_template_directory_uri().'/images/mlogo@2x.png'); ?><img src="<?php echo esc_url($wps_logo_uri); ?>"></a>'
            }
      	});
		$('.topmost-navigation ul.menu').addClass('sf-menu');
  })
</script>
<?php   
// Php goes here
}
add_action('wp_footer', 'weepeeswiss_foot_scripts');