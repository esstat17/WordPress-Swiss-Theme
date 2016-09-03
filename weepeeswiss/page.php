<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

get_header(); ?>

<div class="container container-page-<?php the_ID(); ?>">
<div class="row">
	<div id="main-content" class="main-content <?php apply_filters( 'primary_class', array()); ?>">	
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
		<?php get_sidebar( 'content' ); ?>
	</div><!-- #main-content -->

<?php get_sidebar(); ?>
</div> <!-- .row -->
</div> <!-- .container -->
<?php get_footer();
