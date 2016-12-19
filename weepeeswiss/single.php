<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

get_header(); ?>

<?php do_action( 'wps_content_top', get_the_ID()); ?>

<div class="content-skin single-skin">
<div class="container">
<div class="row">
	<div id="main-content" class="main-content <?php apply_filters( 'primary_class', array(get_the_ID())); ?>">	
		<?php do_action( 'wps_content_right', get_the_ID()); ?>	
		<div id="content" class="site-content" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );

					// Previous/next post navigation.
					weepeeswiss_post_nav();

					weepeeswiss_author_meta();

					do_action( 'wps_content_comment_above', get_the_ID());

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}

				endwhile;
			?>
<?php do_action( 'wps_content_comment_bottom', get_the_ID()); ?>
		</div><!-- #content -->
	</div><!-- #main-content -->                                       
<?php get_sidebar(); ?>
<?php get_sidebar( 'two' ); ?>
</div> <!-- .row -->
</div> <!-- .container -->
</div>
<?php do_action( 'wps_content_bottom', get_the_ID()); ?>
<?php get_footer(); ?>
