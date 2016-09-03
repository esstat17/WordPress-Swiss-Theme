<?php
/**
 * The template for displaying WooCommerce Products
 *
 * This is the template that displays all WooCommerce Related Posts.
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
					if( have_posts() ) :	

						// Woocommerce template.
						woocommerce_content();

						// get_template_part( 'content', 'page' );	

					endif;
				?>	

			</div><!-- #content -->
		</div><!-- #primary -->
		<?php get_sidebar( 'content' ); ?>
	</div><!-- #main-content -->

<?php get_sidebar(); ?>
</div> <!-- .row -->
</div> <!-- .container -->
<?php get_footer();
