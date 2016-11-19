<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

get_header(); ?>

<?php do_action( 'weepeeswiss_content_top', get_the_ID()); ?>

<div class="content-skin 404-skin">
<div class="container">
<div class="row">
	<div id="primary" class="content-area <?php apply_filters('primary_class', ''); ?>">
		<?php do_action( 'weepeeswiss_content_right', get_the_ID()); ?>	
		<div id="content" class="site-content" role="main">

			<div class="page-header">
				<h1 class="page-title"><?php _e( 'Not Found', 'weepeeswiss' ); ?></h1>
			</div>

			<div class="page-content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'weepeeswiss' ); ?></p>

				<?php get_search_form(); ?>
			</div><!-- .page-content -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_sidebar( 'two' ); ?>
</div> <!-- .row -->
</div> <!-- .container -->
</div>
<?php do_action( 'weepeeswiss_content_bottom', get_the_ID()); ?>
<?php get_footer(); ?>
