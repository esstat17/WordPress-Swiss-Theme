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

<?php
	do_action( 'wps_front_section_before' );
	if ( 'posts' == get_option( 'show_on_front' ) ):
    	include( get_home_template() );
	else: 
		if ( is_front_page() && weepeeswiss_has_featured_posts() ) {
				// Include the featured content template.
			get_template_part( 'featured-content' );
		}
?>
<section class="section-front front-page-<?php the_ID(); ?>">
<div class="container container-page-<?php the_ID(); ?>">
	<div class="row">
		<div id="main-content" class="main-content <?php apply_filters( 'primary_class', array()); ?>">	
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">
					<?php
						while ( have_posts() ) : the_post();
							// Include the page content template.
							get_template_part( 'content', 'page' );
						endwhile;
					?>		
				</div><!-- #content -->
			</div><!-- #primary -->
		</div><!-- #main-content -->	
	</div> <!-- .row -->
</div> <!-- .container -->
</section>
<?php
		do_action( 'wps_front_section_after' );
	endif;
get_footer();
