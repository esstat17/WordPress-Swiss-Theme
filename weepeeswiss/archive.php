<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Weepee Swiss
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

get_header(); ?>
<div class="content-skin archive-skin">
<div class="container">
<div class="row">
	<div id="main-content" class="main-content <?php apply_filters( 'primary_class', array(get_the_ID())); ?>">	
		<?php weepeeswiss_breadcrumb_lists(); ?>
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

			<div class="page-header">
				<h1 class="page-title">
					<?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'weepeeswiss' ), get_the_date() );

						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'weepeeswiss' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'weepeeswiss' ) ) );

						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'weepeeswiss' ), get_the_date( _x( 'Y', 'yearly archives date format', 'weepeeswiss' ) ) );

						else :
							_e( 'Archives', 'weepeeswiss' );

						endif;
					?>
				</h1>
			</div><!-- .page-header -->

			<?php
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

<?php get_sidebar(); ?>
<?php get_sidebar( 'two' ); ?>
</div> <!-- .row -->
</div> <!-- .container -->
</div>
<?php get_footer(); ?>
