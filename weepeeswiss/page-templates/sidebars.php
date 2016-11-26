<?php
/**
 * Template Name: Page With Sidebars
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

get_header(); ?>

<div id="page-content" class="page-content container-page-<?php the_ID(); ?>">

<?php
	if ( is_front_page() && weepeeswiss_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
<div class="container">
<div class="row">
	<div id="main-content" class="main-content <?php apply_filters( 'primary_class', array(get_the_ID())); ?>">		
	<?php
		if ( is_front_page() && weepeeswiss_has_featured_posts() ) {
			// Include the featured content template.
			get_template_part( 'featured-content' );
		}
	?>
		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
				<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();	

						// Include the page content template.
						get_template_part( 'content', 'page' );	

						// If comments are open or we have at least one comment, load up the comment template.
						
						// if ( comments_open() || get_comments_number() ) {
							// comments_template();
						// }
					endwhile;
				?>	

			</div><!-- #content -->
		</div><!-- #primary -->
	</div><!-- #main-content -->
<?php get_sidebar(); ?>
<?php get_sidebar( 'two' ); ?>
</div> <!-- .row -->
</div> <!-- .container -->
</div><!-- #page-content -->
<?php get_footer();