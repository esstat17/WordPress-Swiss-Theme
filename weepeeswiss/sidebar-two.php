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
 
if ( is_singular() && is_single() && "aside" == get_post_format() 
	|| is_singular() && is_page() && 'page-templates/sidebars.php' != get_page_template_slug( get_the_ID() ) 
	|| is_home() && '' != get_page_template_slug( get_the_ID() ) 
	){
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
