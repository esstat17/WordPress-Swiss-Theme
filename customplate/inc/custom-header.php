<?php
/**
 * Implement Custom Header functionality for Custom Plate
 *
 * @package WordPress
 * @subpackage Custom_Plate
 * @since Custom Plate 1.0
 */

/**
 * Set up the WordPress core custom header settings.
 *
 * @since Custom Plate 1.0
 *
 * @uses customplate_header_style()
 * @uses customplate_admin_header_style()
 * @uses customplate_admin_header_image()
 */
function customplate_custom_header_setup() {
	/**
	 * Filter Custom Plate custom-header support arguments.
	 *
	 * @since Custom Plate 1.0
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
	add_theme_support( 'custom-header', apply_filters( 'customplate_custom_header_args', array(
		'default-text-color'     => 'fff',
		'flex-width'    		 => true,
		 'width'                  => 1260,
		// 'height'                 => 240,
		'flex-height'            => true,
		'wp-head-callback'       => 'customplate_header_style',
		'admin-head-callback'    => 'customplate_admin_header_style',
		'admin-preview-callback' => 'customplate_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'customplate_custom_header_setup' );

if ( ! function_exists( 'customplate_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see customplate_custom_header_setup().
 *
 */
function customplate_header_style() {
	// If we get this far, we have custom styles.
	if ( get_header_image() ) :
	?>
<style type="text/css" id="customplate-header-css">
	#primary-navigation{background-size: cover;}
</style>
	<?php
	endif;
}
endif; // customplate_header_style


if ( ! function_exists( 'customplate_admin_header_style' ) ) :
/**
 * Style the header image displayed on the Appearance > Header screen.
 *
 * @see customplate_custom_header_setup()
 *
 * @since Custom Plate 1.0
 */
function customplate_admin_header_style() {
	if ( get_header_image() ) :
?>
<style type="text/css" id="customplate-admin-header-css">
	#primary-navigation { background-size: cover; }
</style>
<?php
	endif;
}
endif; // customplate_admin_header_style

if ( ! function_exists( 'customplate_admin_header_image' ) ) :
/**
 * Create the custom header image markup displayed on the Appearance > Header screen.
 *
 * @see customplate_custom_header_setup()
 *
 * @since Custom Plate 1.0
 */
function customplate_admin_header_image() {
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
		<h5 class="displaying-header-text"><a id="name" style="<?php echo esc_attr( sprintf( 'color: #%s;', get_header_textcolor() ) ); ?>" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>" tabindex="-1"><?php bloginfo( 'name' ); ?></a></h5>
	</div>
<?php
}
endif; // customplate_admin_header_image
