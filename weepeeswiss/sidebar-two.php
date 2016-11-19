<?php
/**
 * The Content Sidebar
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>
<div id="secondary-2" class="secondary-2 <?php apply_filters('secondary2_class', ''); ?>">
	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div id="right-sidebar-2" class="right-sidebar-2 widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div><!-- #primary-sidebar -->
	<?php endif; ?>
</div><!-- #secondary -->
