<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

if ( is_singular() && is_single() && "aside" == get_post_format() 
	|| is_singular() && is_page() && 'page-templates/sidebars.php' != get_page_template_slug( get_the_ID() ) 
	|| is_home() && '' != get_page_template_slug( get_the_ID() ) 
	){
	return;
}
?>
<div id="secondary" class="secondary <?php apply_filters('secondary_class', ''); ?>">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="right-sidebar" class="right-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #primary-sidebar -->
	<?php endif; ?>
</div><!-- #secondary -->
