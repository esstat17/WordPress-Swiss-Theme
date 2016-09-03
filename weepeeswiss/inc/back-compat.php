<?php
/**
 * Weepee Swiss back compat functionality
 *
 * Prevents Weepee Swiss from running on WordPress versions prior to 3.6,
 * since this theme is not meant to be backward compatible beyond that
 * and relies on many newer functions and markup changes introduced in 3.6.
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

/**
 * Prevent switching to Weepee Swiss on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Weepee Swiss 1.0
 */
function weepeeswiss_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'weepeeswiss_upgrade_notice' );
}
add_action( 'after_switch_theme', 'weepeeswiss_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Weepee Swiss on WordPress versions prior to 3.6.
 *
 * @since Weepee Swiss 1.0
 */
function weepeeswiss_upgrade_notice() {
	$message = sprintf( __( 'Weepee Swiss requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'weepeeswiss' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Customizer from being loaded on WordPress versions prior to 3.6.
 *
 * @since Weepee Swiss 1.0
 */
function weepeeswiss_customize() {
	wp_die( sprintf( __( 'Weepee Swiss requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'weepeeswiss' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'weepeeswiss_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 3.4.
 *
 * @since Weepee Swiss 1.0
 */
function weepeeswiss_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Weepee Swiss requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'weepeeswiss' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'weepeeswiss_preview' );
