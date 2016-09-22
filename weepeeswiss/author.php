<?php
/**
 * The template for displaying Author archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

			<?php if ( have_posts() ) : ?>

			<div class="archive-header">
				<h1 class="archive-title">
					<?php
						/*
						 * Queue the first post, that way we know what author
						 * we're dealing with (if that is the case).
						 *
						 * We reset this later so we can run the loop properly
						 * with a call to rewind_posts().
						 */
						the_post();

						// printf( __( 'Published by %s', 'weepeeswiss' ), get_the_author() );
					?>
				</h1>

				<?php if ( get_the_author_meta('description') != '' && is_author() ) : ?>
                    
                <div id="author-meta">
                  
                        
                    <div class="panel panel-default">
  						<div class="panel-body">
  							<div class="author-foto pull-left"> 
  							<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '80' ); } ?> 
  							</div>
  							<div class="author-bio"> 
  								<?php the_author_meta('description') ?>
  							</div>
  						</div>
  						<div class="panel-footer">
  							<div class="about-author"><?php _e('About','weepeeswiss'); ?>               
                        		<a href="<?php the_author_meta('url') ?>" rel="me"><?php echo get_the_author(); ?></a>               
                        	</div>
                    	</div>
					</div>
				</div>
        		<?php endif; // no description, no author's meta ?>

			</div><!-- .archive-header -->

			<?php
					/*
					 * Since we called the_post() above, we need to rewind
					 * the loop back to the beginning that way we can run
					 * the loop properly, in full.
					 */
					rewind_posts();

					// Start the Loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );

					endwhile;
					// Previous/next page navigation.
					weepeeswiss_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_sidebar( 'content' ); ?>
<?php get_sidebar(); ?>
</div> <!-- .row -->
</div> <!-- .container -->
<?php get_footer(); ?>
