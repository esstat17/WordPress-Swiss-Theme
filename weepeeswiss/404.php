<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

get_header(); ?>
<div class="content-skin 404-skin">
<div class="container">
<div class="row">
	<div id="main-content" class="main-content <?php apply_filters( 'primary_class', array(get_the_ID())); ?>">	
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
<?php get_footer(); ?>
