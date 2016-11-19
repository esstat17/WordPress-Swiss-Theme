<?php
/**
 * Template Name: Contributor Page
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

get_header(); ?>

<?php do_action( 'weepeeswiss_content_top', get_the_ID()); ?>

<div class="content-skin page-skin page-<?php the_ID(); ?>">
<?php
	if ( is_front_page() && weepeeswiss_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
<div class="container">
<div class="row">
	<div id="main-content" class="main-content col-lg-12">
	<?php do_action( 'weepeeswiss_content_right', get_the_ID()); ?>	
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
					the_title( '<div class="entry-header"><h1 class="entry-title">', '</h1></div><!-- .entry-header -->' );

					// Output the authors list.
					weepeeswiss_list_authors();

					edit_post_link( __( 'Edit', 'weepeeswiss' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' );
				?>
			</article><!-- #post-## -->

			<?php
					// If comments are open or we have at least one comment, load up the comment template.
					// if ( comments_open() || get_comments_number() ) {
						// comments_template();
					// }
				endwhile;
			?>
			</div><!-- #content -->
		</div><!-- #primary -->
	</div><!-- #main-content -->
</div> <!-- .row -->
</div> <!-- .container -->
</div>
<?php do_action( 'weepeeswiss_content_bottom', get_the_ID()); ?>
<?php get_footer();


