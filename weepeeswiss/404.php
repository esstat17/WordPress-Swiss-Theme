<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

get_header(); ?>

<div class="container">
<div class="row">
	<div id="primary" class="content-area <?php apply_filters('primary_class', ''); ?>">
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

<?php
	get_sidebar( 'content' );
	get_sidebar();
?>
</div> <!-- .row -->
</div> <!-- .container -->
<?php get_footer(); ?>
