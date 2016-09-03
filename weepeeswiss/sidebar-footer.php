<?php
/**
 * The Footer Sidebar
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

if ( ! is_active_sidebar( 'sidebar-3' ) && ! is_active_sidebar( 'sidebar-4' ) && ! is_active_sidebar( 'sidebar-5' ) ){
	return;
}
?>

<div class="footer-widget row">
	<div class="widget-area col-xs-6 col-sm-3" role="complementary">
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
	</div>
	<div class="widget-area col-xs-6 col-sm-3" role="complementary">
		<?php dynamic_sidebar( 'sidebar-4' ); ?>
	</div>
	<div class="clearfix visible-xs-block"></div>
	<div class="widget-area col-xs-6 col-sm-3" role="complementary">
		<?php dynamic_sidebar( 'sidebar-5' ); ?>
	</div>
	<div class="widget-area col-xs-6 col-sm-3" role="complementary">
		<?php dynamic_sidebar( 'sidebar-6' ); ?>
	</div>
</div>