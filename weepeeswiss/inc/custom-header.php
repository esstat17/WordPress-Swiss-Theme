<?php
/**
 * Implement Custom Header functionality for Weepee Swiss
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

/**
 * Set up the WordPress core custom header settings.
 *
 * @since Weepee Swiss 1.0
 *
 * @uses weepeeswiss_header_style()
 * @uses weepeeswiss_admin_header_style()
 * @uses weepeeswiss_admin_header_image()
 */
function weepeeswiss_custom_header_setup() {
	/**
	 * Filter Weepee Swiss custom-header support arguments.
	 *
	 * @since Weepee Swiss 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type bool   $header_text            Whether to display custom header text. Default false.
	 *     @type int    $width                  Width in pixels of the custom header image. Default 1260.
	 *     @type int    $height                 Height in pixels of the custom header image. Default 240.
	 *     @type bool   $flex_height            Whether to allow flexible-height header images. Default true.
	 *     @type string $admin_head_callback    Callback function used to style the image displayed in
	 *                                          the Appearance > Header screen.
	 *     @type string $admin_preview_callback Callback function used to create the custom header markup in
	 *                                          the Appearance > Header screen.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'weepeeswiss_custom_header_args', array(
		'default-text-color'     => 'fff',
		'flex-width'    		 => true,
		 'width'                  => 1260,
		// 'height'                 => 240,
		'flex-height'            => true,
		'wp-head-callback'       => 'weepeeswiss_header_style',
		'admin-head-callback'    => 'weepeeswiss_admin_header_style',
		'admin-preview-callback' => 'weepeeswiss_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'weepeeswiss_custom_header_setup' );

if ( ! function_exists( 'weepeeswiss_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see weepeeswiss_custom_header_setup().
 *
 */
function weepeeswiss_header_style() {
	// If we get this far, we have custom styles.
	if ( get_header_image() ) :
	?>
<style type="text/css" id="weepeeswiss-header-css">
	#primary-navigation{background-size: cover;}
</style>
	<?php
	endif;
}
endif; // weepeeswiss_header_style


if ( ! function_exists( 'weepeeswiss_admin_header_style' ) ) :
/**
 * Style the header image displayed on the Appearance > Header screen.
 *
 * @see weepeeswiss_custom_header_setup()
 *
 * @since Weepee Swiss 1.0
 */
function weepeeswiss_admin_header_style() {
	if ( get_header_image() ) :
?>
<style type="text/css" id="weepeeswiss-admin-header-css">
	#primary-navigation { background-size: cover; }
</style>
<?php
	endif;
}
endif; // weepeeswiss_admin_header_style

if ( ! function_exists( 'weepeeswiss_admin_header_image' ) ) :
/**
 * Create the custom header image markup displayed on the Appearance > Header screen.
 *
 * @see weepeeswiss_custom_header_setup()
 *
 * @since Weepee Swiss 1.0
 */
function weepeeswiss_admin_header_image() {
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
		<h5 class="displaying-header-text"><a id="name" style="<?php echo esc_attr( sprintf( 'color: #%s;', get_header_textcolor() ) ); ?>" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>" tabindex="-1"><?php bloginfo( 'name' ); ?></a></h5>
	</div>
<?php
}
endif; // weepeeswiss_admin_header_image
